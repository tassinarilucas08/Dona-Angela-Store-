<?php

namespace Source\Models\Products;

use Source\Core\Model;

class Brand extends Model
{
    private $id;
    private $description;

    public function __construct(int $id = null, string $description = null)
    {
        $this->id = $id;
        $this->description = $description;
        $this->table = "brands";
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getDescription(): ?string
    {
        return $this->description;  
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }
}