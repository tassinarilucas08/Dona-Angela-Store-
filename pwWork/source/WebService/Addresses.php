<?php

namespace Source\WebService;

use Source\Models\Users\Address;
use Source\Core\JWTToken;

class Addresses extends Api
{
    public function listAddresses (): void
    {
        $address = new Address();
        //var_dump($users->findAll());
        $this->call(200, "success", "Lista de endereços", "success")
            ->back($address->findAll());
    }

    public function createAddress(array $data)
    {
        // verifica se os dados estão preenchidos
        if(in_array("", $data)){
            $this->call(400, "bad_request", "Dados inválidos", "error")->back();
            return;
        }

        $address = new Address(
            null,
            $data["idUser"] ?? null,
            $data["zipCode"] ?? null,
            $data["street"] ?? null,
            $data["number"] ?? null,
            $data["complement"] ?? null,
            $data["state"] ?? null,
            $data["city"] ?? null
        );

        if(!$address->insert()){
            $this->call(500, "internal_server_error", $address->getErrorMessage(), "error")->back();
            return;
        }
        // montar $response com as informações necessárias para mostrar no front
        $response = [
            "ZipCode" => $address->getZipCode(),
            "Street" => $address->getStreet(),
            "Number" => $address->getNumber(),
            "Complement" => $address->getComplement(),
            "State" => $address->getState(),
            "City" => $address->getCity()
        ];

        $this->call(201, "created", "Endereço criado com sucesso", "success")
            ->back($response);

    }

    public function listAddressById (array $data): void
    {

        if(!isset($data["id"])) {
            $this->call(400, "bad_request", "ID inválido", "error")->back();
            return;
        }

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
    // Autentica o usuário
    $this->auth();

    // Verifica se o ID do endereço foi passado
    if (!isset($data["id"])) {
        $this->call(400, "bad_request", "ID do endereço não informado", "error")->back();
        return;
    }

    // Cria a instância do Address e busca o endereço
    $address = new Address();
    if (!$address->findById($data["id"])) {
        $this->call(404, "not_found", "Endereço não encontrado", "error")->back();
        return;
    }

    // Verifica se o endereço pertence ao usuário autenticado
    if ($address->getIdUser() !== $this->userAuth->id && $this->userAuth->idUserCategory !== 3) {
        $this->call(403, "forbidden", "Você não tem permissão para atualizar este endereço", "error")->back();
        return;
    }

    // Atualiza somente os campos enviados
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

    // Salva a atualização no banco
    if (!$address->updateById()) {
        $this->call(500, "internal_server_error", $address->getErrorMessage(), "error")->back();
        return;
    }

    $this->call(200, "success", "Endereço atualizado com sucesso", "success")->back();
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