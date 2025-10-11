<?php
require_once __DIR__ . '/vendor/autoload.php';

use Source\Core\Connect;
use Source\Core\JWTToken;
use Source\Models\Users\User;

try {
    $pdo = Connect::getInstance();

    // Pega apenas usuários não confirmados que têm token
    $stmt = $pdo->prepare("SELECT id, confirmationToken FROM users WHERE isConfirmed = 0 AND confirmationToken IS NOT NULL");
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $jwt = new JWTToken();

    foreach ($users as $row) {
        $user = new User();
        if (!$user->findById($row['id'])) {
            continue; // usuário não encontrado, pula
        }

        $decoded = $jwt->decode($row['confirmationToken']);
        if (!$decoded) {
            // token expirou, deleta o usuário
            $user->deleteById($user->getId());
            echo date('Y-m-d H:i:s') . " - Usuário ID {$user->getId()} removido por token expirado.\n";
        }
    }

} catch (\Exception $e) {
    echo date('Y-m-d H:i:s') . " - Erro: " . $e->getMessage() . "\n";
}