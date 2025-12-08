<?php

namespace Source\WebService;

use Source\Models\Products\Product;
use Source\Models\Products\Brand;
use Source\Models\Products\ProductCategory;
use Source\Models\Products\Gender;
use Source\Models\Products\PhotoProduct;
use Source\Core\JWTToken;
use SorFabioSantos\Uploader\Uploader;

use Source\Core\Connect;
use PDO;
use PDOException;

class Products extends Api
{
    
public function createProduct(): void
    {
    $this->auth();

    $data = json_decode(file_get_contents("php://input"), true);
    if (!is_array($data)) {
        $this->call(400, "bad_request", "JSON inválido", "error")->back();
        return;
    }

    $required = ["idCategory", "idBrand", "name", "description", "price", "quantity", "idStatus"];
    foreach ($required as $field) {
        if (empty($data[$field])) {
            $this->call(400, "bad_request", "O campo '$field' é obrigatório", "error")->back();
            return;
        }
    }

    // normaliza preço
    if (isset($data["price"])) {
        $price = str_replace(',', '.', $data["price"]);
        if (!is_numeric($price) || $price < 0) {
            $this->call(400, "bad_request", "Preço inválido", "error")->back();
            return;
        }
        $data["price"] = (float)$price;
    }

    // if (isset($data["salePrice"])) {
    //     $salePrice = str_replace(',', '.', $data["salePrice"]);
    //     if (!is_numeric($salePrice) || $salePrice < 0) {
    //         $this->call(400, "bad_request", "Preço promocional inválido", "error")->back();
    //         return;
    //     }
    //     $data["salePrice"] = (float)$salePrice;
    //}
    if (!filter_var($data["idCategory"], FILTER_VALIDATE_INT)) {
        $this->call(400, "bad_request", "ID de categoria inválido", "error")->back();
        return;
    }
       
    if (!filter_var($data["idBrand"], FILTER_VALIDATE_INT)) {
        $this->call(400, "bad_request", "ID de marca inválido", "error")->back();
        return;
    }
    if (!filter_var($data["idStatus"], FILTER_VALIDATE_INT)) {
        $this->call(400, "bad_request", "ID de status inválido", "error")->back();
        return;
    }

       if (!filter_var($data["quantity"], FILTER_VALIDATE_INT) || $data["quantity"] < 0) {
        $this->call(400, "bad_request", "Quantidade inválida", "error")->back();
        return;
    }

    if (strlen($data["name"]) < 3 || strlen($data["name"]) > 255) {
        $this->call(400, "bad_request", "Nome do produto deve ter entre 3 e 255 caracteres", "error")->back();
        return;
    }
    if (strlen($data["description"]) < 20) {
        $this->call(400, "bad_request", "Descrição do produto deve ter no mínimo 20 caracteres", "error")->back();
        return;
    }

    $name = mb_convert_case(trim($data["name"]), MB_CASE_TITLE, "UTF-8");

    $productCheck = new Product();
    if ($productCheck->findByName($name)) {
    $this->call(400, "bad_request", "Produto com este nome já existe", "error")->back();
    return;
    }

    $product = new Product(
        null,
        $data["idCategory"],
        $data["idBrand"],
        $name,
        $price,
        null,
        $data["description"],
        null,
        $data["quantity"],
        $data["idStatus"]
    );

    if (!$product->insert()) {
        $this->call(500, "internal_server_error", $product->getErrorMessage() ?? "Erro ao criar produto", "error")->back();
        return;
    }

    $this->call(201, "created", "Produto criado com sucesso", "success")->back([
        "id" => $product->getId(),
        "name" => $product->getName(),
        "description" => $product->getDescription(),
        "idCategory" => $product->getIdCategory(),
        "idBrand" => $product->getIdBrand(),
        "price" => $product->getPrice(),
        "quantity" => $product->getQuantity(),
        "idStatus" => $product->getIdStatus()
    ]);
}

public function updatePhotos(): void
{
    $this->auth();

    if (empty($_POST["id"]) || !filter_var($_POST["id"], FILTER_VALIDATE_INT)) {
        $this->call(400, "bad_request", "ID do produto inválido", "error")->back();
        return;
    }

    $productId = (int)$_POST["id"];

    $product = new Product();
    if (!$product->findById($productId)) {
        $this->call(404, "not_found", "Produto não encontrado", "error")->back();
        return;
    }

    $upload = new Uploader();
    $photosSaved = [];
    $coverSet = false; 

    if (isset($_FILES["photos"])) {
        foreach ($_FILES["photos"]["name"] as $key => $name) {
            if ($_FILES["photos"]["error"][$key] === UPLOAD_ERR_OK) {
                $file = [
                    "name" => $name,
                    "type" => $_FILES["photos"]["type"][$key],
                    "tmp_name" => $_FILES["photos"]["tmp_name"][$key],
                    "error" => $_FILES["photos"]["error"][$key],
                    "size" => $_FILES["photos"]["size"][$key],
                ];

                $path = $upload->Image($file);

                if (!$path) {
                    $this->call(400, "bad_request", $upload->getMessage(), "error")->back();
                    return;
                }

                // salva na photos_products
                $stmt = Connect::getInstance()->prepare("
                    INSERT INTO photos_products (idProduct, photo) 
                    VALUES (:idProduct, :photo)
                ");
                $stmt->bindValue(":idProduct", $productId, \PDO::PARAM_INT);
                $stmt->bindValue(":photo", $path, \PDO::PARAM_STR);

                if ($stmt->execute()) {
                    $photosSaved[] = $path;

                    // 👇 primeira foto vira capa na tabela products
                    if (!$coverSet) {
                        $coverSet = true;
                        $stmtCover = Connect::getInstance()->prepare("
                            UPDATE products 
                            SET photo = :photo 
                            WHERE id = :id
                        ");
                        $stmtCover->bindValue(":photo", $path, \PDO::PARAM_STR);
                        $stmtCover->bindValue(":id", $productId, \PDO::PARAM_INT);
                        $stmtCover->execute();
                    }
                }
            }
        }
    }

    if (empty($photosSaved)) {
        $this->call(400, "bad_request", "Nenhuma foto válida enviada", "error")->back();
        return;
    }

    $this->call(200, "success", "Fotos adicionadas com sucesso", "success")->back([
        "productId" => $productId,
        "photos" => $photosSaved
    ]);
}


    public function listProducts(): void
    {
        $product = new Product();
        $all = $product->findAllWithDetails(); // usa a versão detalhada

        $this->call(200, "success", "Lista de produtos", "success")->back([
        "products" => $all
    ]);
}
    
public function listProductById(array $data): void
{
    // valida ID vindo da rota /Products/id/{id}
    if (empty($data["id"]) || !filter_var($data["id"], FILTER_VALIDATE_INT)) {
        $this->call(400, "bad_request", "ID inválido", "error")->back();
        return;
    }

    $id = (int)$data["id"];

    $productModel = new Product();
    $product = $productModel->findByIdWithDetails($id);

    if (!$product) {
        $this->call(404, "not_found", "Produto não encontrado", "error")->back();
        return;
    }

    $this->call(200, "success", "Produto encontrado", "success")->back([
        "product" => $product
    ]);
}

public function getProductByName(array $data): void
{
    $this->auth();

    if (empty($data["name"])) {
        $this->call(400, "bad_request", "Nome não informado", "error")->back();
        return;
    }

    // nome vem urlencoded
    $name = urldecode($data["name"]);
    $name = mb_convert_case(trim($data["name"]), MB_CASE_TITLE, "UTF-8");

    $product = new Product();
    if (!$product->findByName($name)) {
        $this->call(404, "not_found", "Produto não encontrado", "error")->back();
        return;
    }

    $this->call(200, "success", "Produto encontrado", "success")->back([
        "product" => [
            "id"          => $product->getId(),
            "idCategory"  => $product->getIdCategory(),
            "idBrand"     => $product->getIdBrand(),
            "name"        => $product->getName(),
            "description" => $product->getDescription(),
            "price"       => $product->getPrice(),
            "salePrice"   => $product->getSalePrice(),
            "photo"       => $product->getPhoto(),
            "quantity"    => $product->getQuantity(),
            "idStatus"    => $product->getIdStatus()
        ]
    ]);
}


public function updateProduct(): void
{
    $this->auth();

    $data = json_decode(file_get_contents("php://input"), true);
    if (!is_array($data)) {
        $this->call(400, "bad_request", "JSON inválido", "error")->back();
        return;
    }

    if (empty($data["id"]) || !filter_var($data["id"], FILTER_VALIDATE_INT)) {
        $this->call(400, "bad_request", "ID inválido", "error")->back();
        return;
    }

    $required = ["idCategory", "idBrand", "name", "description", "price", "quantity", "idStatus"];
    foreach ($required as $field) {
        if (!isset($data[$field]) || $data[$field] === "") {
            $this->call(400, "bad_request", "O campo '$field' é obrigatório", "error")->back();
            return;
        }
    }

    $id = (int)$data["id"];

    // normaliza preço
    $price = str_replace(',', '.', $data["price"]);
    if (!is_numeric($price) || $price < 0) {
        $this->call(400, "bad_request", "Preço inválido", "error")->back();
        return;
    }
    $price = (float)$price;

    if (!filter_var($data["idCategory"], FILTER_VALIDATE_INT)) {
        $this->call(400, "bad_request", "ID de categoria inválido", "error")->back();
        return;
    }

    if (!filter_var($data["idBrand"], FILTER_VALIDATE_INT)) {
        $this->call(400, "bad_request", "ID de marca inválido", "error")->back();
        return;
    }

    if (!filter_var($data["idStatus"], FILTER_VALIDATE_INT)) {
        $this->call(400, "bad_request", "ID de status inválido", "error")->back();
        return;
    }

    if (!filter_var($data["quantity"], FILTER_VALIDATE_INT) || $data["quantity"] < 0) {
        $this->call(400, "bad_request", "Quantidade inválida", "error")->back();
        return;
    }

    $name = mb_convert_case(trim($data["name"]), MB_CASE_TITLE, "UTF-8");

    if (strlen($name) < 3 || strlen($name) > 255) {
        $this->call(400, "bad_request", "Nome do produto deve ter entre 3 e 255 caracteres", "error")->back();
        return;
    }

    if (strlen($data["description"]) < 20) {
        $this->call(400, "bad_request", "Descrição do produto deve ter no mínimo 20 caracteres", "error")->back();
        return;
    }

    // garante que não exista outro produto com o mesmo nome
    $check = new Product();
    if ($check->findByName($name) && $check->getId() !== $id) {
        $this->call(400, "bad_request", "Já existe outro produto com este nome", "error")->back();
        return;
    }

    // carrega o produto atual
    $product = new Product();
    if (!$product->findById($id)) {
        $this->call(404, "not_found", "Produto não encontrado", "error")->back();
        return;
    }

    // atualiza os campos
    $product->setIdCategory((int)$data["idCategory"]);
    $product->setIdBrand((int)$data["idBrand"]);
    $product->setName($name);
    $product->setPrice($price);
    $product->setSalePrice(isset($data["salePrice"]) ? (float)$data["salePrice"] : null);
    $product->setDescription($data["description"]);
    // photo aqui deixei como está (só observação)
    $product->setQuantity((int)$data["quantity"]);
    $product->setIdStatus((int)$data["idStatus"]);

    if (!$product->update()) {
        $this->call(500, "internal_server_error", $product->getErrorMessage() ?? "Erro ao atualizar produto", "error")->back();
        return;
    }

    $this->call(200, "success", "Produto atualizado com sucesso", "success")->back([
        "id"          => $product->getId(),
        "name"        => $product->getName(),
        "description" => $product->getDescription(),
        "idCategory"  => $product->getIdCategory(),
        "idBrand"     => $product->getIdBrand(),
        "price"       => $product->getPrice(),
        "quantity"    => $product->getQuantity(),
        "idStatus"    => $product->getIdStatus()
    ]);
}



    public function deleteProduct(array $data): void
    {
        $this->auth();

        if (empty($data["id"]) || !filter_var($data["id"], FILTER_VALIDATE_INT)) {
            $this->call(400, "bad_request", "ID inválido", "error")->back();
            return;
        }

        $product = new Product();
        if (!$product->findById((int)$data["id"])) {
            $this->call(404, "not_found", "Produto não encontrado", "error")->back();
            return;
        }

        if (!$product->deleteById($product->getId())) {
            $this->call(500, "internal_server_error", $product->getErrorMessage() ?? "Erro ao deletar produto", "error")->back();
            return;
        }

        $this->call(200, "success", "Produto deletado com sucesso", "success")->back();
    }
}
