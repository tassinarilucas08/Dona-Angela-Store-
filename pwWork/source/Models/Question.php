<?php

namespace Source\Models\Faq;

use Source\Core\Model;

class Question extends Model
{
    private $id;
    private $idCategoryQuestion;
    private $question;
    private $answer;

    public function __construct (
        int $id = null,
        int $idCategoryQuestion = null,
        string $question = null,
        string $answer = null
    )
    {
        $this->table = "questions";
        $this->id = $id;
        $this->idCatergoryQuestion = $idCategoryQuestion;
        $this->question = $question;
        $this->answer = $answer;
    }

    $question = new Question();

    var_dump($question->findAll());

    $get = $_GET;
    var_dump($get["question"], $get["answer"]);

    // public function getId(): ?int
    // {
    //     return $this->id;
    // }

    // public function setId(?int $id): void
    // {
    //     $this->id = $id;
    // }

    // public function getIdType(): ?int
    // {
    //     return $this->idType;
    // }

    // public function setIdType(?int $idType): void
    // {
    //     $this->idType = $idType;
    // }

    // public function getQuestion(): ?string
    // {
    //     return $this->question;
    // }

    // public function setQuestion(?string $question): void
    // {
    //     $this->question = $question;
    // }

    // public function getAnswer(): ?string
    // {
    //     return $this->answer;
    // }

    // public function setAnswer(?string $answer): void
    // {
    //     $this->answer = $answer;
    // }

}