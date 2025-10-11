<?php
// cleanup_users.php
require_once __DIR__ . '/vendor/autoload.php';

use Source\Core\Connect;
use Source\Core\JWTToken;
use Source\Models\Users\User;

try {
    $pdo = Connect::getInstance();

    // Pega todos os usuários não confirmados
    $stmt = $pdo->prepare("SELECT id, confirmationToken FROM users WHERE isConfirmed = 0");
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $jwt = new JWTToken();

    foreach ($users as $row) {
        $user = new User();
        if (!$user->findById($row['id'])) {
            continue; // não achou, pula
        }

        $token = $row['confirmationToken'] ?? null;
        if (!$token) {
            // sem token, deleta direto
            $user->deleteById($user->getId());
            continue;
        }

        $decoded = $jwt->decode($token);
        if (!$decoded) {
            // token expirou, deleta o usuário
            $user->deleteById($user->getId());
            echo "Usuário ID {$user->getId()} removido por token expirado.\n";
        }
    }

    echo "Limpeza de usuários não confirmados concluída.\n";

} catch (\Exception $e) {
    echo "Erro: " . $e->getMessage() . "\n";
}
