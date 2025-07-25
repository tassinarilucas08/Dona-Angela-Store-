<?php

namespace Source\WebService;

use Source\Models\Faq\Question;

class Questions extends Api
{
    public function listQuestions (): void
    {
        $question = new Question();
        //var_dump($users->findAll());
        $this->call(200, "success", "Lista de perguntas e respostas", "success")
            ->back($question->findAll());
    }

    public function createQuestion(array $data)
    {

        // verifica se os dados estão preenchidos
        if(in_array("", $data)){
            $this->call(400, "bad_request", "Dados inválidos", "error")->back();
            return;
        }

        $question = new Question(
            null,
            $data["idCategoryQuestion"] ?? null,
            $data["question"] ?? null,
            $data["answer"] ?? null
        );

        if(!$question->insert()){
            $this->call(500, "internal_server_error", $question->getErrorMessage(), "error")->back();
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
            "Pergunta" => $question->getQuestion(),
            "Resposta" => $question->getAnswer()
        ];
        $this->call(200, "success", "Pergunta encontrada com sucesso", "success")->back($response);
    }
    public function listQuestionByIdCategory (array $data): void
    {
        if(!isset($data["idCategory"])) {
            $this->call(400, "bad_request", "ID inválido", "error")->back();
            return;
        }

        if(!filter_var($data["idCategory"], FILTER_VALIDATE_INT)) {
            $this->call(400, "bad_request", "ID inválido", "error")->back();
            return;
        }

        $question = new Question();
        if(!$question->findById($data["idCategory"])){
            $this->call(200, "error", "Pergunta não encontrada", "error")->back();
            return;
        }
        $response = [
            "Pergunta" => $question->getQuestion(),
            "Resposta" => $question->getAnswer()
        ];
        $this->call(200, "success", "Pergunta encontrada com sucesso", "success")->back($response);
    }

    public function updateQuestion (array $data): void
    {
       $this->auth();
       var_dump($data);
       var_dump($this->questionAuth);
       var_dump($this->questionAuth->id, $this->questionAuth->question, $this->questionAuth->answer, $this->questionAuth->idCategoryQuestion);
    }

    function deleteQuestion(array $data)
  {
      var_dump($data);
  }
}