<?php

namespace Source\Models\Users;

require  __DIR__ . "/../vendor/autoload.php";

class UserCategory extends Model
{
    private $id;
    private $description;

    public function __construct (int $id = null, String $description = null){
        $this->id = $id;
        $this->description = $description;
    }

    public function getId (): ?int
    {
        return $this->id;
    }

    public function setId (?int $id): void
    {
        $this->id = $id;
    }

    public function getDescription (): ?String
    {
        return $this->description;
    }

    public function setDescription (?String $description): void
    {
        $this->description = $description;
    }}