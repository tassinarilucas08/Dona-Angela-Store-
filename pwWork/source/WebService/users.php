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

public function createUser(array $data)
{
    // Verifica se todos os campos obrigatórios estão preenchidos
    $required = ["idUserCategory", "name", "email", "password", "phone"];
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
    $userCheck = new User();
    if ($userCheck->findByPhone($data["phone"])) {
    $this->call(409, "conflict", "Telefone já cadastrado", "error")->back();
    return;
    }


    // Valida senha (mínimo 6 caracteres)
    if (strlen($data["password"]) < 6) {
        $this->call(400, "bad_request", "A senha deve ter no mínimo 6 caracteres", "error")->back();
        return;
    }

    // Criação do usuário
    $user = new User(
        null,
        $data["idUserCategory"] ?? null,
        $data["name"] ?? null,
        $data["email"] ?? null,
        $data["password"] ?? null, 
        $data["phone"] ?? null
    );

    if (!$user->insert()) {
        $this->call(500, "internal_server_error", $user->getErrorMessage(), "error")->back();
        return;
    }

    // Retorno personalizado
    $response = [
        "id"    => $user->getId(),
        "name"  => $user->getName(),
        "email" => $user->getEmail()
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

    public function updateUser(array $data): void
{
    // Verifica autenticação via token
    $this->auth();

    // Verifica se há pelo menos um campo para atualizar
    if (empty($data)) {
        $this->call(400, "bad_request", "Nenhum dado enviado para atualização", "error")->back();
        return;
    }

    $user = new User();

    // Busca o usuário atual pelo ID do token JWT
    if (!$user->findById($this->userAuth->id)) {
        $this->call(404, "not_found", "Usuário não encontrado", "error")->back();
        return;
    }

    // Verifica e aplica os campos recebidos
    if (isset($data["name"])) {
        if (empty($data["name"])) {
            $this->call(400, "bad_request", "O nome não pode ser vazio", "error")->back();
            return;
        }
        $user->setName($data["name"]);
    }

    if (isset($data["email"])) {
        if (!filter_var($data["email"], FILTER_VALIDATE_EMAIL)) {
            $this->call(400, "bad_request", "Formato de e-mail inválido", "error")->back();
            return;
        }
        // Verifica se o novo email já está sendo usado por outro usuário
        $userCheck = new User();
        if ($userCheck->findByEmail($data["email"])) {
        $this->call(409, "conflict", "E-mail já cadastrado", "error")->back();
        return;
        }
        $user->setEmail($data["email"]);
    }

    if (isset($data["phone"])) {
    if (empty($data["phone"])) {
        $this->call(400, "bad_request", "O telefone não pode ser vazio", "error")->back();
        return;
    }

    $userCheck = new User();
    if ($userCheck->findByPhone($data["phone"])) {
        $this->call(409, "conflict", "Telefone já cadastrado", "error")->back();
        return;
    }

    $user->setPhone($data["phone"]);
}

    if (isset($data["password"])) {
    if (strlen($data["password"]) < 6) {
        $this->call(400, "bad_request", "A senha deve ter pelo menos 6 caracteres", "error")->back();
        return;
    }
    $hashedPassword = password_hash($data["password"], PASSWORD_DEFAULT);
    $user->setPassword($hashedPassword);
}

    // Tenta atualizar usando o método inteligente
    if (!$user->updateById()) {
        $this->call(500, "internal_server_error", $user->getErrorMessage() ?? "Erro ao atualizar usuário", "error")->back();
        return;
    }

    // Sucesso!
    $this->call(200, "success", "Usuário atualizado com sucesso", "success")->back([
        "id" => $user->getId(),
        "name" => $user->getName(),
        "email" => $user->getEmail(),
        "phone" => $user->getPhone()
    ]);
}

    public function login(array $data): void
    {
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
    $isAdmin = $this->userAuth->idUserCategory == 1;

    if (!$isOwner && !$isAdmin) {
        $this->call(403, "forbidden", "Você não tem permissão para deletar este usuário", "error")->back();
        return;
    }

    // Tenta deletar
    if (!$user->deleteById($data["id"])) {
        $this->call(500, "internal_server_error", $user->getErrorMessage() ?? "Erro ao deletar usuário", "error")->back();
        return;
    }

    $this->call(200, "success", "Usuário deletado com sucesso", "success")->back();
    }

  }