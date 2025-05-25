<?php

namespace Source\Models\Faq;

require  __DIR__ . "/../vendor/autoload.php";

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
        $this->id = $id;
        $this->idCatergoryQuestion = $idCategoryQuestion;
        $this->question = $question;
        $this->answer = $answer;
        $this->table = "questions";
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getIdCategoryQuestion(): ?int
    {
        return $this->idCategoryQuestion;
    }

    public function setIdCategoryQuestion(?int $idCategoryQuestion): void
    {
        $this->idCategoryQuestion = $idCategoryQuestion;
    }

    public function getQuestion(): ?string
    {
        return $this->question;
    }

    public function setQuestion(?string $question): void
    {
        $this->question = $question;
    }

    public function getAnswer(): ?string
    {
        return $this->answer;
    }

    public function setAnswer(?string $answer): void
    {
        $this->answer = $answer;
    }

}