<?php

namespace Source\Models\Products;

use Source\Core\Model;
use Source\Core\Connect;

class Product extends Model
{   
    private $id; 
    private $idCategory;
    private $idBrand;
    private $name;
    private $price;
    private $salePrice;
    private $description;
    private $photo;
    private $quantity;
    private $idStatus;

    public function __construct(int $id = null, int $idCategory = null, int $idBrand = null, String $name = null, float $price = null, float $salePrice = null, String $description = null, int $photo = null, int $quantity = null, int $idStatus = null)
{    
    $this->id = $id;
    $this->idCategory = $idCategory;
    $this->idBrand = $idBrand;
    $this->name = $name;
    $this->price = $price;
    $this->salePrice = $salePrice;
    $this->description = $description;
    $this->photo = $photo;
    $this->quantity = $quantity;
    $this->idStatus = $idStatus;
    $this->table = "products";
 }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getIdCategory(): ?int
    {
        return $this->idCategory;
    }
    public function setIdCategory(?int $idCategory): void
    {
        $this->idCategory = $idCategory;
    }
       public function getIdBrand(): ?int
    {
        return $this->idBrand;
    }
    public function setIdBrand(?int $idBrand): void
    {
        $this->idBrand = $idBrand;
    }

    public function getName(): ?String
    {
        return $this->name;
    }

    public function setName(?String $name): void
    {
        $this->name = $name;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): void
    {
        $this->price = $price;
    }
    public function getSalePrice(): ?float
    {
        return $this->salePrice;
    }
    public function setSalePrice(?float $salePrice): void
    {
        $this->salePrice = $salePrice;
    }

    public function getDescription(): ?String
    {
        return $this->description;
    }

    public function setDescription(?String $description): void
    {
        $this->description = $description;
    }

    public function getPhoto(): ?int
    {
        return $this->photo;
    }

    public function setPhoto(?int $photo): void
    {
        $this->photo = $photo;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function getIdStatus(): ?int
    {
        return $this->idStatus;
    }

    public function setIdStatus(?int $idStatus): void
    {
        $this->idStatus = $idStatus;
    }
    public function findByName(string $name): bool
{
    $sql = "SELECT id FROM products WHERE name = :name LIMIT 1";
    $stmt = \Source\Core\Connect::getInstance()->prepare($sql);
    $stmt->bindValue(":name", $name, \PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount()) {
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);
        $this->id = $data["id"];
        return true;
    }
    return false;
    }

    public function findAllWithDetails(): array
{
    $sql = "
        SELECT 
            p.id AS product_id,
            p.name AS product_name,
            p.price,
            p.salePrice,
            p.description AS product_description,
            p.quantity,
            p.photo AS product_photo,
            b.id AS brand_id,
            b.description AS brand_description,
            c.id AS category_id,
            c.description AS category_description,
            g.id AS gender_id,
            g.description AS gender_description
        FROM products p
        LEFT JOIN brands b ON p.idBrand = b.id
        LEFT JOIN products_categories c ON p.idCategory = c.id
        LEFT JOIN genders g ON c.idGender = g.id
    ";

    try {
        $stmt = Connect::getInstance()->prepare($sql);
        $stmt->execute();
        $products = $stmt->fetchAll(\PDO::FETCH_OBJ);

        return $products ?: [];
    } catch (\PDOException $e) {
        $this->errorMessage = "Erro ao buscar produtos: {$e->getMessage()}";
        return [];
    }
}

public function findByIdWithDetails(int $id): bool
{
    $sql = "
        SELECT 
            p.id,
            p.name,
            p.price,
            p.salePrice,
            p.description,
            p.quantity,
            b.description AS brand,
            c.description AS category,
            GROUP_CONCAT(pp.photo) AS photos
        FROM products p
        LEFT JOIN brands b ON p.idBrand = b.id
        LEFT JOIN products_categories c ON p.idCategory = c.id
        LEFT JOIN photos_products pp ON pp.idProduct = p.id
        WHERE p.id = :id
        GROUP BY p.id
    ";

    try {
        $stmt = \Source\Core\Connect::getInstance()->prepare($sql);
        $stmt->bindValue(":id", $id, \PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$result) {
            return false;
        }

        // converte fotos em array
        $result['photos'] = $result['photos'] ? explode(",", $result['photos']) : [];

        // popula as propriedades do objeto (opcional)
        foreach ($result as $key => $value) {
            $this->$key = $value;
        }

        return true;
    } catch (\PDOException $e) {
        $this->errorMessage = "Erro ao buscar produto: {$e->getMessage()}";
        return false;
    }
}}  