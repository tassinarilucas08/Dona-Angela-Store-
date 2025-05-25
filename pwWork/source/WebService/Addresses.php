<?php

namespace Source\WebService;

require  __DIR__ . "/../vendor/autoload.php";

use Source\Models\User;

class Addresses extends Api
{
    public function listAdresses (): void
    {
        $address = new Address();
        //var_dump($users->findAll());
        $this->call(200, "success", "Lista de endereços", "success")
            ->back($question->findAll());
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
            $data["id"] ?? null,
            $data["idForeign"] ?? null,
            $data["zipCode"] ?? null,
            $data["street"] ?? null,
            $data["number"] ?? null,
            $data["complement"] ?? null,
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
            "Complement" => $address->getComplement()
        ];
        $this->call(200, "success", "Endereço encontrado com sucesso", "success")->back($response);
    }
}