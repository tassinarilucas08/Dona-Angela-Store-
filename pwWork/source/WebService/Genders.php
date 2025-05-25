<?php

namespace Source\WebService;

require  __DIR__ . "/../vendor/autoload.php";

use Source\Models\Products\Gender;

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
}