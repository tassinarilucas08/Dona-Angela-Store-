<?php

require  __DIR__ . "/../vendor/autoload.php";

namespace Source\WebService;

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
                protected $id;  
    protected $idForeign;
    protected $zipCode;
    protected $street;
    protected $number;
    protected $complement;
            null,
            $data["id"] ?? null,
            $data["idForeign"] ?? null,
            $data["zipCode"] ?? null,
            $data["number"] ?? null,
            $data["complement"] ?? null,
        );

        if(!$question->insert()){
            $this->call(500, "internal_server_error", $questions->getErrorMessage(), "error")->back();
            return;
        }
        // montar $response com as informações necessárias para mostrar no front
        $response = [
            "Pergunta" => $question->getQuestion(),
            "Resposta" => $question->getAnswer(),
        ];

        $this->call(201, "created", "Pergunta criada com sucesso", "success")
            ->back($response);

    }

    public function listQuestionById (array $data): void
    {

        if(!isset($data["id"])) {
            $this->call(400, "bad_request", "ID inválido", "error")->back();
            return;
        }

        if(!filter_var($data["id"], FILTER_VALIDATE_INT)) {
            $this->call(400, "bad_request", "ID inválido", "error")->back();
            return;
        }

        $question = new Question();
        if(!$question->findById($data["id"])){
            $this->call(200, "error", "Pergunta não encontrada", "error")->back();
            return;
        }
        $response = [
            "Pergunta" => $user->getQuestion(),
            "Resposta" => $user->getAnswer()
        ];
        $this->call(200, "success", "Pergunta encontrada com sucesso", "success")->back($response);
    }
}