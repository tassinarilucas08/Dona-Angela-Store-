<?php

namespace Source\Models\Products;

use Source\Core\Model;

class PhotoProduct extends Model
{
    private $id;
    private $idProduct;
    private $photo;

    public function __construct(int $id = null, int $idProduct = null, string $photo = null)
    {
        $this->id = $id;
        $this->idProduct = $idProduct;
        $this->photo = $photo;
        $this->table = "photos_products";
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getIdProduct(): ?int
    {
        return $this->idProduct;
    }

    public function setIdProduct(?int $idProduct): void
    {
        $this->idProduct = $idProduct;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): void
    {
        $this->photo = $photo;
    }
}
