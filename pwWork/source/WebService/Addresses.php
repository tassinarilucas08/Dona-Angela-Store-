<?php

namespace Source\WebService;

use Source\Models\Users\Address;
use Source\Core\JWTToken;

class Addresses extends Api
{
    public function listAddresses (): void
    {
        $address = new Address();
        $result = $address->findAll();

    if (empty($result)) {
        $this->call(404, "not_found", "Nenhum endereço encontrado", "error")->back();
        return;
    }
        //var_dump($users->findAll());
        $this->call(200, "success", "Lista de endereços encontrada com sucesso", "success")->back([
        "count" => count($result),
        "endereços" => $result
    ]);
    }

    public function createAddress(array $data): void
{
    $this->auth();

    // Campos obrigatórios
    $required = ["idUser", "zipCode", "street", "number", "state", "city"];
    foreach ($required as $field) {
        if (empty($data[$field])) {
            $this->call(400, "bad_request", "O campo '$field' é obrigatório", "error")->back();
            return;
        }
    }

    // Validação de ID do usuário
    if (!filter_var($data["idUser"], FILTER_VALIDATE_INT)) {
        $this->call(400, "bad_request", "ID de usuário inválido", "error")->back();
        return;
    }

    // CEP (somente números, com 8 dígitos)
     if (!preg_match('/^\d{5}-\d{3}$/', $data["zipCode"])) {
        $this->call(400, "bad_request", "CEP inválido. Use o formato XXXXX-XXX", "error")->back();
        return;
    }

    // Número (somente dígitos)
    if (!preg_match('/^\d+$/', $data["number"])) {
        $this->call(400, "bad_request", "Número da casa deve conter apenas dígitos", "error")->back();
        return;
    }

    // Estado (2 letras maiúsculas)
    if (!preg_match('/^[A-Z]{2}$/', strtoupper($data["state"]))) {
        $this->call(400, "bad_request", "Estado inválido. Deve conter 2 letras (ex: SP)", "error")->back();
        return;
    }

    $address = new Address(
        null,
        $data["idUser"] ?? null,
        $data["zipCode"] ?? null,
        $data["street"] ?? null,
        $data["number"] ?? null,
        $data["complement"] ?? null,
        strtoupper($data["state"]) ?? null,
        $data["city"] ?? null
    );

    if (!$address->insert()) {
        $this->call(500, "internal_server_error", $address->getErrorMessage(), "error")->back();
        return;
    }

    $response = [
        "id" => $address->getId(),
        "zipCode" => $address->getZipCode(),
        "street" => $address->getStreet(),
        "number" => $address->getNumber(),
        "complement" => $address->getComplement(),
        "state" => $address->getState(),
        "city" => $address->getCity()
    ];

    $this->call(201, "created", "Endereço criado com sucesso", "success")->back($response);
}

    public function listAddressById (array $data): void
    {

        if(!filter_var($data["id"], FILTER_VALIDATE_INT)) {
            $this->call(400, "bad_request", "ID inválido", "error")->back();
            return;
        }

        $address = new Address();
        if(!$address->findById($data["id"])){
            $this->call(200, "error", "Endereço não encontrado", "error")->back();
            return;
        }
        $response = [
            "ZipCode" => $address->getZipCode(),
            "Street" => $address->getStreet(),
            "Number" => $address->getNumber(),
            "Complement" => $address->getComplement(),
            "State" => $address->getState(),
            "City" => $address->getCity()
        ];
        $this->call(200, "success", "Endereço encontrado com sucesso", "success")->back($response);
    }
      
    public function updateAddress(array $data): void
{
    $this->auth();

    // Verifica ID
    if (empty($data["id"]) || !filter_var($data["id"], FILTER_VALIDATE_INT)) {
        $this->call(400, "bad_request", "ID de endereço inválido", "error")->back();
        return;
    }

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

    // Validações simples
     if (!preg_match('/^\d{5}-\d{3}$/', $data["zipCode"])) {
        $this->call(400, "bad_request", "CEP inválido. Use o formato XXXXX-XXX", "error")->back();
        return;
    }

    if (isset($data["number"]) && !is_numeric($data["number"])) {
        $this->call(400, "bad_request", "Número deve ser numérico", "error")->back();
        return;
    }

    if (isset($data["state"]) && (!preg_match('/^[A-Z]{2}$/', strtoupper($data["state"])))) {
        $this->call(400, "bad_request", "Estado deve conter 2 letras (ex: SP)", "error")->back();
        return;
    }

    // Atualização dos campos
    if (isset($data["zipCode"])) $address->setZipCode($data["zipCode"]);
    if (isset($data["street"])) $address->setStreet($data["street"]);
    if (isset($data["number"])) $address->setNumber($data["number"]);
    if (isset($data["complement"])) $address->setComplement($data["complement"]);
    if (isset($data["state"])) $address->setState(strtoupper($data["state"]));
    if (isset($data["city"])) $address->setCity($data["city"]);

    // Atualiza no banco
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

 public function deleteAddress(array $data): void
{
    // Autentica o usuário
    $this->auth();

    // Verifica se o ID do endereço foi passado e é válido
    if (empty($data["id"]) || !filter_var($data["id"], FILTER_VALIDATE_INT)) {
        $this->call(400, "bad_request", "ID inválido", "error")->back();
        return;
    }

    // Instancia o objeto e tenta carregar pelo ID
    $address = new Address();
    if (!$address->findById($data["id"])) {
        $this->call(404, "not_found", "Endereço não encontrado", "error")->back();
        return;
    }

    // Verifica se o endereço pertence ao usuário autenticado ou se ele é admin (categoria 3)
    if ($address->getIdUser() !== $this->userAuth->id && $this->userAuth->idUserCategory !== 3) {
        $this->call(403, "forbidden", "Você não tem permissão para deletar este endereço", "error")->back();
        return;
    }

    // Tenta deletar
    if (!$address->deleteById($address->getId())) {
        $this->call(500, "internal_server_error", $address->getErrorMessage(), "error")->back();
        return;
    }

    $this->call(200, "success", "Endereço deletado com sucesso", "success")->back();
 }
}