<?php

namespace Source\Models\Users;

use Source\Core\Model;
use Source\Core\Connect;
use Source\Models\Users\Address;

class User extends Model
{
    protected $id;
    protected $idUserCategory;
    protected $name;
    protected $email;
    protected $password;
    protected $phone;

    public function __construct(
        int $id = null,
        int $idUserCategory = null,
        String $name = null,
        String $email = null,
        String $password = null,
        String $phone = null
    )
    {
        $this->id = $id;
        $this->idUserCategory = $idUserCategory;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->phone = $phone;
        $this->table = "users";
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

    public function insert (): bool
    {
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->errorMessage = "E-mail inválido";
            return false;
        }

        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = Connect::getInstance()->prepare($sql);
        $stmt->bindValue(":email", $this->email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $this->errorMessage = "E-mail já cadastrado";
            return false;
        }

        $this->password = password_hash($this->password, PASSWORD_DEFAULT);

        if(!parent::insert()){
            $this->errorMessage = "Erro ao inserir o registro: {$this->getErrorMessage()}";
            return false;
        }

        return true;
    }

    public function findByEmail (string $email): bool
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = Connect::getInstance()->prepare($sql);
        $stmt->bindValue(":email", $email);

        try {
            $stmt->execute();
            $result = $stmt->fetch(\PDO::FETCH_OBJ);
            if (!$result) {
                return false;
            }
            $this->id = $result->id;
            $this->idUserCategory = $result->idUserCategory;
            $this->name = $result->name;
            $this->email = $result->email;
            $this->password = $result->password;
            $this->phone = $result->phone;

            return true;
        } catch (PDOException $e) {
            $this->errorMessage = "Erro ao buscar o registro: {$e->getMessage()}";
            return false;
        }

    }
    public function findByPhone(string $phone): bool
{
    $sql = "SELECT * FROM users WHERE phone = :phone";
    $stmt = Connect::getInstance()->prepare($sql);
    $stmt->bindValue(":phone", $phone);

    try {
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_OBJ);
        if (!$result) {
            return false;
        }
        $this->id = $result->id;
        $this->idUserCategory = $result->idUserCategory;
        $this->name = $result->name;
        $this->email = $result->email;
        $this->password = $result->password;
        $this->phone = $result->phone;

        return true;
    } catch (PDOException $e) {
        $this->errorMessage = "Erro ao buscar o registro: {$e->getMessage()}";
        return false;
    }
}

}