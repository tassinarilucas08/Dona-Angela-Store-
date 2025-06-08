<?php

namespace Source\WebService;

use Source\Models\Products\Gender;
use Source\Core\JWTToken;

class Genders extends Api
{
    public function listGenders (): void
    {
        $gender = new Gender();
        //var_dump($users->findAll());
        $this->call(200, "success", "Lista de gêneros encontrada com sucesso", "success")
            ->back($gender->findAll());
    }

    public function createGender(array $data)
    {
        $this->auth();

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

        if(!isset($data["id"])) {
            $this->call(400, "bad_request", "ID inválido", "error")->back();
            return;
        }

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
public function updateAddress(array $data): void
{
    $this->auth();
    
    $addressModel = new Address();
    $address = $addressModel->findById($data["id"]);
    
    if (!$address) {
    $this->call(404, "not_found", "Endereço não encontrado", "error")->back();
    return;
    }

    if ($address->getIdUser() !== $this->userAuth->id && $this->userAuth->idUserCategory !== 3) {
    $this->call(403, "forbidden", "Você não tem permissão para atualizar este endereço", "error")->back();
    return; 
    }

    // Atualiza os campos recebidos
    if (isset($data["zipCode"])) {
        $address->setZipCode($data["zipCode"]);
    }
    if (isset($data["street"])) {
        $address->setStreet($data["street"]);
    }
    if (isset($data["number"])) {
        $address->setNumber($data["number"]);
    }
    if (isset($data["complement"])) {
        $address->setComplement($data["complement"]);
    }
    if (isset($data["state"])) {
        $address->setState($data["state"]);
    }
    if (isset($data["city"])) {
        $address->setCity($data["city"]);
    }

    // Salva no banco
    if (!$address->updateById()) {
        $this->call(500, "internal_server_error", "Erro ao atualizar endereço", "error")->back();
        return;
    }

    $this->call(200, "success", "Endereço atualizado com sucesso", "success")->back([
        "id" => $address->getId(),
        "zipCode" => $address->getZipCode(),
        "street" => $address->getStreet(),
        "number" => $address->getNumber(),
        "complement" => $address->getComplement(),
        "state" => $address->getState(),
        "city" => $address->getCity()
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