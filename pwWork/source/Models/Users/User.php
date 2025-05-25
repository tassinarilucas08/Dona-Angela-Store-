<?php

namespace Source\Models\Users;

use Source\Core\Model;
use Source\Models\Users\Address;

class User extends Model
{
    protected $id;
    protected $idUserCategory;
    protected $name;
    protected $email;
    protected $password;
    protected $address;
    protected $phone;

    public function __construct(
        int $id = null,
        int $idUserCategory = null,
        String $name = null,
        String $email = null,
        String $password = null,
        Address $address = null,
        String $phone = null
    )
    {
        $this->table = "users";
        $this->id = $id;
        $this->idUserCategory = $idUserCategory;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->address = $address;
        $this->phone = $phone;
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

    public function getPhone(): ?String
    {
        return $this->phone;
    }

    public function setPhone(?String $phone): void
    {
        $this->phone = $phone;

    }
}