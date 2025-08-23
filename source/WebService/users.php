<?php

namespace Source\WebService;

use Source\Models\Users\User;
use Source\Core\JWTToken;

class Users extends Api
{

    // Controller -> Usa as coisas que tu define no model para criar a funçao da rota em si.
   public function listUsers(): void
    {
        $users = new User();
        $result = $users->findAll();

        if (empty($result)) {
            $this->call(404, "not_found", "Nenhum usuário encontrado", "error")->back();
            return;
        }

        $this->call(200, "success", "Lista de usuários", "success")->back([
            "count" => count($result),
            "users" => $result
        ]);
}

public function createUser(): void
{
    $data = json_decode(file_get_contents("php://input"), true);

    if (!is_array($data)) {
        $this->call(400, "bad_request", "JSON inválido", "error")->back();
        return;
    }

    // Verifica se todos os campos obrigatórios estão preenchidos
    $required = ["name", "email", "password", "phone", "passwordConfirm"];
    foreach ($required as $field) {
        if (empty($data[$field])) {
            $this->call(400, "bad_request", "O campo '$field' é obrigatório", "error")->back();
            return;
        }
    }

    // Valida e-mail
    if (!filter_var($data["email"], FILTER_VALIDATE_EMAIL)) {
        $this->call(400, "bad_request", "E-mail inválido", "error")->back();
        return;
    }

    // Verifica se o e-mail já está em uso
    $userCheck = new User();
    if ($userCheck->findByEmail($data["email"])) {
        $this->call(409, "conflict", "E-mail já cadastrado", "error")->back();
        return;
    }

    // Verifica se o telefone já está em uso
    if ($userCheck->findByPhone($data["phone"])) {
        $this->call(409, "conflict", "Telefone já cadastrado", "error")->back();
        return;
    }

    // Valida senha (mínimo 6 caracteres)
    if (strlen($data["password"]) < 6) {
        $this->call(400, "bad_request", "A senha deve ter no mínimo 6 caracteres", "error")->back();
        return;
    }
    // Validação de senha e confirmação
    if ($data["password"] !== $data["passwordConfirm"]) {
    $this->call(400, "bad_request", "As senhas não coincidem", "error")->back();
    return;
    }

    // Criação do usuário
    $user = new User(
        null, // id (vai ser gerado)
        1,    // categoria padrão
        $data["name"],
        $data["email"],
        $data["password"], // senha criptografada
        $data["phone"]
    );

    if (!$user->insert()) {
        $this->call(500, "internal_server_error", $user->getErrorMessage() ?? "Erro ao criar usuário", "error")->back();
        return;
    }

    // Retorno personalizado
    $response = [
        "id" => $user->getId(),
        "name" => $user->getName(),
        "email" => $user->getEmail(),
        "phone" => $user->getPhone()
    ];

    $this->call(201, "created", "Usuário criado com sucesso", "success")->back($response);
}

    public function listUserById (array $data): void
    {
        if(!filter_var($data["id"], FILTER_VALIDATE_INT)) {
            $this->call(400, "bad_request", "ID inválido", "error")->back();
            return;
        }

        $user = new User();
        if(!$user->findById($data["id"])){
            $this->call(400, "bad_request", "Usuário não encontrado", "error")->back();
            return;
        }
        $response = [
            "name" => $user->getName(),
            "email" => $user->getEmail()
        ];
        $this->call(200, "success", "Encontrado com sucesso", "success")->back($response);
    }

public function updateUser(): void
{
    // Verifica autenticação via token
    $this->auth();

    // Pega os dados enviados pelo fetch
    $input = json_decode(file_get_contents("php://input"), true);

    if (empty($input)) {
        $this->call(400, "bad_request", "Nenhum dado enviado para atualização", "error")->back();
        return;
    }    

    $user = new User();

    // Busca o usuário atual pelo ID do token JWT
    if (!$user->findById($this->userAuth->id)) {
        $this->call(404, "not_found", "Usuário não encontrado", "error")->back();
        return;
    }

    // Permissão: só o próprio usuário ou admin (idUserCategory === 3)
    if ($user->getId() !== $this->userAuth->id && $this->userAuth->idUserCategory !== 3) {
        $this->call(403, "forbidden", "Você não tem permissão para atualizar este usuário", "error")->back();
        return;
    }

    // Atualiza campos se enviados
    if (isset($input["name"])) {
        if (empty($input["name"])) {
            $this->call(400, "bad_request", "O nome não pode ser vazio", "error")->back();
            return;
        }
        $user->setName($input["name"]);
    }

    if (isset($input["email"])) {
        if (!filter_var($input["email"], FILTER_VALIDATE_EMAIL)) {
            $this->call(400, "bad_request", "Formato de e-mail inválido", "error")->back();
            return;
        }

        $userCheck = new User();
        if ($userCheck->findByEmail($input["email"]) && $userCheck->getId() !== $user->getId()) {
            $this->call(409, "conflict", "E-mail já cadastrado", "error")->back();
            return;
        }

        $user->setEmail($input["email"]);
    }

    if (isset($input["phone"])) {
        if (empty($input["phone"])) {
            $this->call(400, "bad_request", "O telefone não pode ser vazio", "error")->back();
            return;
        }

        $userCheck = new User();
        if ($userCheck->findByPhone($input["phone"]) && $userCheck->getId() !== $user->getId()) {
            $this->call(409, "conflict", "Telefone já cadastrado", "error")->back();
            return;
        }

        $user->setPhone($input["phone"]);
    }

    // ID do usuário vindo do token
    $user->setId($this->userAuth->id);

    // Tenta atualizar no banco
    if (!$user->updateById()) {
        $this->call(500, "internal_server_error", $user->getErrorMessage() ?? "Erro ao atualizar usuário", "error")->back();
        return;
    }

    // Atualiza o retorno para o JS e localStorage
    $this->call(200, "success", "Usuário atualizado com sucesso", "success")->back([
        "id" => $user->getId(),
        "name" => $user->getName(),
        "email" => $user->getEmail(),
        "phone" => $user->getPhone()
    ]);
}

public function sendResetPasswordEmail(): void
{
    $input = json_decode(file_get_contents("php://input"), true);

    if (empty($input["email"])) {
        $this->call(400, "bad_request", "Email não fornecido", "error")->back();
        return;
    }

    $email = $input["email"];
    $user = new User();

    if (!$user->findByEmail($email)) {
        $this->call(404, "not_found", "Usuário não encontrado", "error")->back();
        return;
    }

    // Gera um token temporário (pode ser JWT ou UUID)
    $jwt = new JWTToken();
    $token = $jwt->encode(["id" => $user->getId()], 3600); // expira em 1 hora

    // Monta o link de reset
    $resetLink = "http://seusite.com/reset-password?token=" . $token;

    // Envia o email
    $subject = "Redefinição de senha";
    $message = "Olá, clique no link abaixo para redefinir sua senha:\n\n$resetLink\n\nEste link expira em 1 hora.";
    $headers = "From: no-reply@seusite.com\r\n";

    if (!mail($email, $subject, $message, $headers)) {
        $this->call(500, "internal_server_error", "Erro ao enviar email", "error")->back();
        return;
    }

    $this->call(200, "success", "Email de redefinição enviado com sucesso", "success")->back();
}


    public function updatePassword(): void
 {
    // Pega os dados enviados pelo fetch
    $input = json_decode(file_get_contents("php://input"), true);

    if (empty($input) || !isset($input["token"]) || !isset($input["password"])) {
        $this->call(400, "bad_request", "Token ou senha não fornecidos", "error")->back();
        return;
    }

    $token = $input["token"];
    $newPassword = $input["password"];

    // Validação da senha
    if (strlen($newPassword) < 6) {
        $this->call(400, "bad_request", "A senha deve ter pelo menos 6 caracteres", "error")->back();
        return;
    }

    // Decodifica e valida o token temporário (JWT ou UUID armazenado no banco)
    $jwt = new JWTToken();
    $decoded = $jwt->decode($token);

    if (!$decoded) {
        $this->call(401, "unauthorized", "Token inválido ou expirado", "error")->back();
        return;
    }

    $user = new User();
    if (!$user->findById($decoded->data->id)) {
        $this->call(404, "not_found", "Usuário não encontrado", "error")->back();
        return;
    }

    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    $user->setPassword($hashedPassword);

    if (!$user->updateById()) {
        $this->call(500, "internal_server_error", $user->getErrorMessage() ?? "Erro ao atualizar senha", "error")->back();
        return;
    }

    $this->call(200, "success", "Senha atualizada com sucesso", "success")->back();
}


    public function login(array $data): void
    {

        $data = json_decode(file_get_contents("php://input"), true);

        // Verificar se os dados de login foram fornecidos
        if (empty($data["email"]) || empty($data["password"])) {
            $this->call(400, "bad_request", "Credenciais inválidas", "error")->back();
            return;
        }

        $user = new User();

        if(!$user->findByEmail($data["email"])){
            $this->call(401, "unauthorized", "Usuário não encontrado", "error")->back();
            return;
        }
        
        if(!password_verify($data["password"], $user->getPassword())){
            $this->call(401, "unauthorized", "Senha inválida", "error")->back();
            return;
        }

        // Gerar o token JWT
        $jwt = new JWTToken();
        $token = $jwt->create([
            "id" => $user->getId(),
            "email" => $user->getEmail(),
            "idUserCategory" => $user->getIdUserCategory()
        ]);

        // Retornar o token JWT na resposta
        $this->call(200, "success", "Login realizado com sucesso", "success")
            ->back([
                "token" => $token,
                "user" => [
                    "id" => $user->getId(),
                    "name" => $user->getName(),
                    "email" => $user->getEmail(),
                    "phone" => $user->getPhone()
                ]
            ]);
}
    function deleteUser(array $data)
  {
    $this->auth(); // autentica e define $this->userAuth

    // Verifica se o ID foi enviado e é válido
    if (!isset($data["id"]) || !filter_var($data["id"], FILTER_VALIDATE_INT)) {
        $this->call(400, "bad_request", "ID inválido", "error")->back();
        return;
    }

    $user = new User();

    // Verifica se o usuário existe
    if (!$user->findById($data["id"])) {
        $this->call(404, "not_found", "Usuário não encontrado", "error")->back();
        return;
    }

    // Só o próprio usuário ou um admin pode deletar
    $isOwner = $this->userAuth->id == $data["id"];
    $isAdmin = $this->userAuth->idUserCategory == 3;

    if (!$isOwner && !$isAdmin) {
        $this->call(403, "forbidden", "Você não tem permissão para deletar este usuário", "error")->back();
        return;
    }

    // Tenta deletar
    if (!$user->deleteById($data["id"])) {
        $this->call(500, "internal_server_error", $user->getErrorMessage() ?? "Erro ao deletar usuário", "error")->back();
        return;
    }

    $this->call(200, "success", "Usuário deletado com sucesso", "success")->back();}}