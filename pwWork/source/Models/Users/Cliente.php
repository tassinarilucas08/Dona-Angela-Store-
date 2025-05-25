<?php

namespace Source\Models\Users;

require  __DIR__ . "/../vendor/autoload.php";

use Source\Core\Model;
use Source\Models\Users\Address;

class Cliente extends User
{
    protected $compras;

    public function __construct(
        int $id = null,
        int $idUserCategory = null,
        string $name = null,
        string $email = null,
        string $password = null,
        Address $address = null
    )
    {
        $this->table = "users";
        $this->id = $id;
        $this->idUserCategory = $idUserCategory;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->address = $address;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getIdUserCategory(): ?int
    {
        return $this->idUserCategory;
    }

    public function setIdUserCategory(?int $idUserCategory): void
    {
        $this->idUserCategory = $idUserCategory;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    public function getPhoto(): ?String
    {
        return $this->photo;
    }

    public function setPhoto(?String $photo): void
    {
        $this->photo = $photo;
    }
}