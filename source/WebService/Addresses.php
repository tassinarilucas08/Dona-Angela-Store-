<?php

namespace Source\WebService;

use Source\Models\Users\Address;

class Addresses extends Api
{
    public function createAddress(): void
    {
        $this->auth();

        $data = json_decode(file_get_contents("php://input"), true);
        if (!is_array($data)) {
            $this->call(400, "bad_request", "JSON inválido", "error")->back();
            return;
        }

        $required = ["idUser", "zipCode", "street", "neighborhood", "number", "state", "city"];
        foreach ($required as $field) {
            if (empty($data[$field])) {
                $this->call(400, "bad_request", "O campo '$field' é obrigatório", "error")->back();
                return;
            }
        }

        if (!filter_var($data["idUser"], FILTER_VALIDATE_INT)) {
            $this->call(400, "bad_request", "ID de usuário inválido", "error")->back();
            return;
        }

        if (!preg_match('/^\d{5}-\d{3}$/', $data["zipCode"])) {
            $this->call(400, "bad_request", "CEP inválido. Use o formato XXXXX-XXX", "error")->back();
            return;
        }

        if (!preg_match('/^\d+$/', $data["number"])) {
            $this->call(400, "bad_request", "Número deve conter somente dígitos", "error")->back();
            return;
        }

        if (!preg_match('/^[A-Z]{2}$/', strtoupper($data["state"]))) {
            $this->call(400, "bad_request", "UF inválida. Use 2 letras (ex: RS)", "error")->back();
            return;
        }

        $address = new Address(
            null,
            (int)$data["idUser"],
            $data["zipCode"],
            $data["street"],
            (string)$data["number"],
            $data["complement"] ?? null,
            $data["neighborhood"],
            strtoupper($data["state"]),
            $data["city"]
        );

        if (!$address->insert()) {
            $this->call(500, "internal_server_error", $address->getErrorMessage() ?? "Erro ao criar endereço", "error")->back();
            return;
        }

        $this->call(201, "created", "Endereço criado com sucesso", "success")->back([
            "id" => $address->getId(),
            "zipCode" => $address->getZipCode(),
            "street" => $address->getStreet(),
            "number" => $address->getNumber(),
            "complement" => $address->getComplement(),
            "neighborhood" => $address->getNeighborhood(),
            "state" => $address->getState(),
            "city" => $address->getCity()
        ]);
    }

    public function updateAddress(): void
    {
        $this->auth();

        $data = json_decode(file_get_contents("php://input"), true);
        if (!is_array($data) || empty($data["id"])) {
            $this->call(400, "bad_request", "JSON inválido ou ID ausente", "error")->back();
            return;
        }

        if (!filter_var($data["id"], FILTER_VALIDATE_INT)) {
            $this->call(400, "bad_request", "ID de endereço inválido", "error")->back();
            return;
        }

        $address = new Address();
        if (!$address->findById((int)$data["id"])) {
            $this->call(404, "not_found", "Endereço não encontrado", "error")->back();
            return;
        }

        if ($address->getIdUser() !== $this->userAuth->id && $this->userAuth->idUserCategory !== 3) {
            $this->call(403, "forbidden", "Você não tem permissão para atualizar este endereço", "error")->back();
            return;
        }

        if (isset($data["zipCode"]) && !preg_match('/^\d{5}-\d{3}$/', $data["zipCode"])) {
            $this->call(400, "bad_request", "CEP inválido. Use o formato XXXXX-XXX", "error")->back();
            return;
        }

        if (isset($data["number"]) && !preg_match('/^\d+$/', (string)$data["number"])) {
            $this->call(400, "bad_request", "Número deve conter somente dígitos", "error")->back();
            return;
        }

        if (isset($data["state"]) && !preg_match('/^[A-Z]{2}$/', strtoupper($data["state"]))) {
            $this->call(400, "bad_request", "UF inválida. Use 2 letras (ex: RS)", "error")->back();
            return;
        }

        if (isset($data["zipCode"])) {
            $address->setZipCode($data["zipCode"]);
        }      
        if (isset($data["street"])) {
            $address->setStreet($data["street"]);
        }
        if (isset($data["number"])) {
            $address->setNumber((string)$data["number"]);
        }
        if (isset($data["complement"])) {
            $address->setComplement($data["complement"]);
        }
        if (isset($data["neighborhood"])) {
            $address->setNeighborhood($data["neighborhood"]);
        }
        if (isset($data["state"])) {
            $address->setState(strtoupper($data["state"]));
        }
        if (isset($data["city"])) {
            $address->setCity($data["city"]);
        }

        if (!$address->updateById()) {
            $this->call(500, "internal_server_error", $address->getErrorMessage() ?? "Erro ao atualizar endereço", "error")->back();
            return;
        }

        $this->call(200, "success", "Endereço atualizado com sucesso", "success")->back([
            "id" => $address->getId(),
            "zipCode" => $address->getZipCode(),
            "street" => $address->getStreet(),
            "number" => $address->getNumber(),
            "complement" => $address->getComplement(),
            "neighborhood" => $address->getNeighborhood(),
            "state" => $address->getState(),
            "city" => $address->getCity()
        ]);
    }

 public function deleteAddress(array $data): void
{
    // Autentica o usuário
    $this->auth();

    // Verifica se o ID do endereço foi passado e é válido
    if (empty($data["id"]) || !filter_var($data["id"], FILTER_VALIDATE_INT)) {
        $this->call(400, "bad_request", "ID inválido", "error")->back();
        return;
    }

    // Instancia o objeto e tenta carregar pelo ID
    $address = new Address();
    if (!$address->findById($data["id"])) {
        $this->call(404, "not_found", "Endereço não encontrado", "error")->back();
        return;
    }

    // Verifica se o endereço pertence ao usuário autenticado ou se ele é admin (categoria 3)
    if ($address->getIdUser() !== $this->userAuth->id && $this->userAuth->idUserCategory !== 3) {
        $this->call(403, "forbidden", "Você não tem permissão para deletar este endereço", "error")->back();
        return;
    }

    // Tenta deletar
    if (!$address->deleteById($address->getId())) {
        $this->call(500, "internal_server_error", $address->getErrorMessage(), "error")->back();
        return;
    }

    $this->call(200, "success", "Endereço deletado com sucesso", "success")->back();
 }
}