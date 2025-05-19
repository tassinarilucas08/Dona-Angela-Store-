<?php

require  __DIR__ . "/../vendor/autoload.php";

namespace Source\Models;

//use Source\Core\Connect;
use Source\Core\Model;
//use Source\Models\Records\Address;

class User extends Model
{
    protected $id;
    protected $idType;
    protected $name;
    protected $email;
    protected $password;
    protected $address;

    public function __construct(
        int $id = null,
        int $idType = null,
        string $name = null,
        string $email = null,
        string $password = null,
        Address $address = null
    )
    {
        $this->table = "users";
        $this->id = $id;
        $this->idType = $idType;
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

    public function getIdType(): ?int
    {
        return $this->idType;
    }

    public function setIdType(?int $idType): void
    {
        $this->idType = $idType;
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

    public function insert():bool{
        //verificar a existência do email
        //se não existir
    }

    // Model cuida das regras
    public function createUser(nome, email, senha) {
        // logica de banco
        // return DADOS_DO_INSERT
    }
}