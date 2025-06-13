<?php

namespace Source\WebService;

use Source\Models\Products\Gender;
use Source\Core\JWTToken;

class Genders extends Api
{
    public function listGenders (): void
    {
        $gender = new Gender();
        $result = $gender->findAll();

    if (empty($result)) {
        $this->call(404, "not_found", "Nenhum gênero encontrado", "error")->back();
        return;
    }
        //var_dump($users->findAll());
        $this->call(200, "success", "Lista de gêneros encontrada com sucesso", "success")->back([
        "count" => count($result),
        "users" => $result
    ]);
}
    public function createGender(array $data)
    {
        $this->auth();

        if (empty($data["description"])) {
            $this->call(400, "bad_request", "O campo 'description' é obrigatório", "error")->back();
            return;
        }
        if (!in_array($this->userAuth->idUserCategory, [2, 3])) {
        $this->call(403, "forbidden", "Apenas administradores e vendedores podem realizar esta ação", "error")->back();
        return;
        }

        // verifica se os dados estão preenchidos
        if(in_array("", $data)){
            $this->call(400, "bad_request", "Dados inválidos", "error")->back();
            return;
        }

        $gender = new Gender(
            null,
            $data["description"] ?? null
        );

        if(!$gender->insert()){
            $this->call(500, "internal_server_error", $gender->getErrorMessage(), "error")->back();
            return;
        }
        // montar $response com as informações necessárias para mostrar no front
        $response = [
            "id" => $gender->getId(),
            "description" => $gender->getDescription()
        ];

        $this->call(201, "created", "Gênero criado com sucesso", "success")
            ->back($response);

    }

    public function listGenderById (array $data): void
    {

        if(!filter_var($data["id"], FILTER_VALIDATE_INT)) {
            $this->call(400, "bad_request", "ID inválido", "error")->back();
            return;
        }

        $gender = new Gender();
        if(!$gender->findById($data["id"])){
            $this->call(200, "error", "Gênero não encontrado", "error")->back();
            return;
        }
        $response = [
            "description" => $gender->getDescription()
        ];
        $this->call(200, "success", "Gênero encontrado com sucesso", "success")->back($response);
    }

 public function updateGender(array $data): void
{
    $this->auth();

    if (!in_array($this->userAuth->idUserCategory, [2, 3])) {
        $this->call(403, "forbidden", "Apenas administradores e vendedores podem realizar esta ação", "error")->back();
        return;
    }

    if (!isset($data["id"]) || !filter_var($data["id"], FILTER_VALIDATE_INT)) {
        $this->call(400, "bad_request", "ID inválido", "error")->back();
        return;
    }

    if (empty($data["description"])) {
        $this->call(400, "bad_request", "O campo 'description' é obrigatório", "error")->back();
        return;
    }

    $gender = new Gender();
    if (!$gender->findById($data["id"])) {
        $this->call(404, "not_found", "Gênero não encontrado", "error")->back();
        return;
    }

    $gender->setDescription($data["description"]);

    if (!$gender->updateById()) {
        $this->call(500, "internal_server_error", "Erro ao atualizar gênero", "error")->back();
        return;
    }

    $this->call(200, "success", "Gênero atualizado com sucesso", "success")->back([
        "id" => $gender->getId(),
        "description" => $gender->getDescription()
    ]);
}
 


public function deleteGender(array $data): void
{
    $this->auth(); // Se quiser proteger com token, como no Users

    if (!in_array($this->userAuth->idUserCategory, [2, 3])) {
        $this->call(403, "forbidden", "Apenas administradores e vendedores podem realizar esta ação", "error")->back();
        return;
        }

    if (!isset($data["id"]) || !filter_var($data["id"], FILTER_VALIDATE_INT)) {
        $this->call(400, "bad_request", "ID inválido", "error")->back();
        return;
    }

    $gender = new Gender();

    if (!$gender->findById($data["id"])) {
        $this->call(404, "not_found", "Gênero não encontrado", "error")->back();
        return;
    }

    if (!$gender->deleteById($data["id"])) {
        $this->call(500, "internal_server_error", "Erro ao deletar gênero", "error")->back();
        return;
    }

    $this->call(200, "success", "Gênero deletado com sucesso", "success")->back();
 }
}