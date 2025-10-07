<?php

namespace Source\WebService;

use Source\Models\Users\User;
use Source\Core\JWTToken;
use SorFabioSantos\Uploader\Uploader;
use Dotenv\Dotenv;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
   
$dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();
    
class Users extends Api
{

    // Controller -> Usa as coisas que tu define no model para criar a funçao da rota em si.
   public function listUsers(): void
    {
        $users = new User();
        $result = $users->findAll();

        if (empty($result)) {
            $this->call(404, "not_found", "Nenhum usuário encontrado", "error")->back();
            return;
        }

        $this->call(200, "success", "Lista de usuários", "success")->back([
            "count" => count($result),
            "users" => $result
        ]);
}

public function createUser(): void
{
    $data = json_decode(file_get_contents("php://input"), true);

    if (!is_array($data)) {
        $this->call(400, "bad_request", "JSON inválido", "error")->back();
        return;
    }

    // Verifica se todos os campos obrigatórios estão preenchidos
    $required = ["name", "email", "password", "phone", "passwordConfirm"];
    foreach ($required as $field) {
        if (empty($data[$field])) {
            $this->call(400, "bad_request", "O campo '$field' é obrigatório", "error")->back();
            return;
        }
    }

    // Valida e-mail
    if (!filter_var($data["email"], FILTER_VALIDATE_EMAIL)) {
        $this->call(400, "bad_request", "E-mail inválido", "error")->back();
        return;
    }

    // Verifica se o e-mail já está em uso
    $userCheck = new User();
    if ($userCheck->findByEmail($data["email"])) {
        $this->call(409, "conflict", "E-mail já cadastrado", "error")->back();
        return;
    }

    // Verifica se o telefone já está em uso
    if ($userCheck->findByPhone($data["phone"])) {
        $this->call(409, "conflict", "Telefone já cadastrado", "error")->back();
        return;
    }

    // Valida senha (mínimo 6 caracteres)
    if (strlen($data["password"]) < 6) {
        $this->call(400, "bad_request", "A senha deve ter no mínimo 6 caracteres", "error")->back();
        return;
    }
    // Validação de senha e confirmação
    if ($data["password"] !== $data["passwordConfirm"]) {
    $this->call(400, "bad_request", "As senhas não coincidem", "error")->back();
    return;
    }

    // Criação do usuário
    $user = new User(
        null, // id (vai ser gerado)
        1,    // categoria padrão
        $data["name"],
        $data["email"],
        $data["password"], // senha criptografada
        $data["phone"]
    );

    if (!$user->insert()) {
        $this->call(500, "internal_server_error", $user->getErrorMessage() ?? "Erro ao criar usuário", "error")->back();
        return;
    }

    // Retorno personalizado
    $jwt = new JWTToken();
    $token = $jwt->create([
        "id" => $user->getId(),
        "email" => $user->getEmail(),
    ], "+10 minutes");

    $user->setConfirmationToken($token);
    $user->setIsConfirmed(0);
    $user->updateById();
    
    $mail = new PHPMailer(true);
    try {
    $mail->isSMTP();
    $mail->Host       = $_ENV['MAIL_HOST'];
    $mail->SMTPAuth   = true;
    $mail->Username   = $_ENV['MAIL_USERNAME'];
    $mail->Password   = $_ENV['MAIL_PASSWORD'];
    $mail->SMTPSecure = $_ENV['MAIL_ENCRYPTION'];
    $mail->Port       = $_ENV['MAIL_PORT'];

    $mail->setFrom($_ENV['MAIL_USERNAME'], 'Dona Angela Store');
    $mail->addAddress($user->getEmail(), $user->getName());

    $confirmationLink = "http://localhost/Dona-Angela-Store-/confirm-email?token={$token}";

    $mail->isHTML(true);
    $mail->Subject = 'Confirme seu e-mail na Dona Angela Store';
    $mail->Body    = "Olá {$user->getName()},<br><br>
                      Clique no link abaixo para confirmar seu e-mail:<br>
                      <a href='{$confirmationLink}'>{$confirmationLink}</a>";
    $mail->send();    
    
    $response = [
        "id" => $user->getId(),
        "name" => $user->getName(),
        "email" => $user->getEmail(),
        "phone" => $user->getPhone()
    ];    
    $this->call(201, "created", "Usuário criado com sucesso", "success")->back($response);
}
    catch (Exception $e) {
        $user->deleteById($user->getId());
        $this->call(500, "internal_server_error", "Erro ao enviar e-mail de confirmação: {$mail->ErrorInfo}", "error")->back();
    }
}
    public function listUserById (array $data): void
    {
        if(!filter_var($data["id"], FILTER_VALIDATE_INT)) {
            $this->call(400, "bad_request", "ID inválido", "error")->back();
            return;
        }

        $user = new User();
        if(!$user->findById($data["id"])){
            $this->call(400, "bad_request", "Usuário não encontrado", "error")->back();
            return;
        }
        $response = [
            "name" => $user->getName(),
            "email" => $user->getEmail()
        ];
        $this->call(200, "success", "Encontrado com sucesso", "success")->back($response);
    }

public function updateUser(): void
{
    // Verifica autenticação via token
    $this->auth();

    // Pega os dados enviados pelo fetch
    $input = json_decode(file_get_contents("php://input"), true);

    if (empty($input)) {
        $this->call(400, "bad_request", "Nenhum dado enviado para atualização", "error")->back();
        return;
    }    

    $user = new User();

    // Busca o usuário atual pelo ID do token JWT
    if (!$user->findById($this->userAuth->id)) {
        $this->call(404, "not_found", "Usuário não encontrado", "error")->back();
        return;
    }

    // Permissão: só o próprio usuário ou admin (idUserCategory === 3)
    if ($user->getId() !== $this->userAuth->id && $this->userAuth->idUserCategory !== 3) {
        $this->call(403, "forbidden", "Você não tem permissão para atualizar este usuário", "error")->back();
        return;
    }

    // Atualiza campos se enviados
    if (isset($input["name"])) {
        if (empty($input["name"])) {
            $this->call(400, "bad_request", "O nome não pode ser vazio", "error")->back();
            return;
        }
        $user->setName($input["name"]);
    }

    if (isset($input["email"])) {
        if (!filter_var($input["email"], FILTER_VALIDATE_EMAIL)) {
            $this->call(400, "bad_request", "Formato de e-mail inválido", "error")->back();
            return;
        }

        $userCheck = new User();
        if ($userCheck->findByEmail($input["email"]) && $userCheck->getId() !== $user->getId()) {
            $this->call(409, "conflict", "E-mail já cadastrado", "error")->back();
            return;
        }

        $user->setEmail($input["email"]);
    }

    if (isset($input["phone"])) {
        if (empty($input["phone"])) {
            $this->call(400, "bad_request", "O telefone não pode ser vazio", "error")->back();
            return;
        }

        $userCheck = new User();
        if ($userCheck->findByPhone($input["phone"]) && $userCheck->getId() !== $user->getId()) {
            $this->call(409, "conflict", "Telefone já cadastrado", "error")->back();
            return;
        }

        $user->setPhone($input["phone"]);
    }

    // ID do usuário vindo do token
    $user->setId($this->userAuth->id);

    // Tenta atualizar no banco
    if (!$user->updateById()) {
        $this->call(500, "internal_server_error", $user->getErrorMessage() ?? "Erro ao atualizar usuário", "error")->back();
        return;
    }

    // Atualiza o retorno para o JS e localStorage
    $this->call(200, "success", "Usuário atualizado com sucesso", "success")->back([
        "id" => $user->getId(),
        "name" => $user->getName(),
        "email" => $user->getEmail(),
        "phone" => $user->getPhone()
    ]);
}

public function sendResetPasswordEmail(): void
{
    $input = json_decode(file_get_contents("php://input"), true);

    if (empty($input["email"])) {
        $this->call(400, "bad_request", "Email não fornecido", "error")->back();
        return;
    }

    $email = $input["email"];
    $user = new User();

    if (!$user->findByEmail($email)) {
        $this->call(404, "not_found", "Usuário não encontrado", "error")->back();
        return;
    }

    // Gera um token temporário (JWT)
    $jwt = new \Source\Core\JWTToken();
    $token = $jwt->create(["id" => $user->getId()]); // você pode ajustar a validade no JWTToken

    // Monta o link de reset
    $resetLink = "http://localhost/Dona-Angela-Store-/nova-senha?token=" . $token;

    // Configura o PHPMailer
    $mail = new \PHPMailer\PHPMailer\PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = $_ENV['MAIL_HOST'];
        $mail->SMTPAuth   = true;
        $mail->Username   = $_ENV['MAIL_USERNAME'];
        $mail->Password   = $_ENV['MAIL_PASSWORD'];
        $mail->SMTPSecure = $_ENV['MAIL_ENCRYPTION'];
        $mail->Port       = $_ENV['MAIL_PORT'];

        $mail->setFrom($_ENV['MAIL_USERNAME'], 'Dona Angela Store');
        $mail->addAddress($email, $user->getName());

        $mail->isHTML(true);
        $mail->Subject = 'Redefinição de senha';
        $mail->Body    = "Olá {$user->getName()},<br><br>
                          Clique no link abaixo para redefinir sua senha:<br>
                          <a href='{$resetLink}'>{$resetLink}</a><br><br>
                          Este link expira em 1 hora.";
        $mail->AltBody = "Olá {$user->getName()},\n\n
                          Clique no link abaixo para redefinir sua senha:\n
                          {$resetLink}\n\n
                          Este link expira em 1 hora.";

        $mail->send();
        $this->call(200, "success", "Email de redefinição enviado com sucesso", "success")->back();

    } catch (\PHPMailer\PHPMailer\Exception $e) {
        $this->call(500, "internal_server_error", "Erro ao enviar email: {$mail->ErrorInfo}", "error")->back();
    }
}

   public function updatePassword(): void
{
    $input = json_decode(file_get_contents("php://input"), true);

    if (empty($input['token']) || empty($input['password'])) {
        $this->call(400, "bad_request", "Token ou senha não fornecidos", "error")->back();
        return;
    }

    $jwt = new \Source\Core\JWTToken();
    $decoded = $jwt->decode($input['token']);

    if (!$decoded) {
        $this->call(401, "unauthorized", "Token inválido ou expirado", "error")->back();
        return;
    }

    $user = new User();
    if (!$user->findById($decoded->data->id)) {
        $this->call(404, "not_found", "Usuário não encontrado", "error")->back();
        return;
    }

    if (strlen($input['password']) < 6) {
        $this->call(400, "bad_request", "A senha deve ter pelo menos 6 caracteres", "error")->back();
        return;
    }

    $user->setPassword(password_hash($input['password'], PASSWORD_DEFAULT));

    if (!$user->updateById()) {
        $this->call(500, "internal_server_error", "Erro ao atualizar senha", "error")->back();
        return;
    }

    $this->call(200, "success", "Senha atualizada com sucesso", "success")->back();
}

    public function login(array $data): void
    {

        $data = json_decode(file_get_contents("php://input"), true);

        // Verificar se os dados de login foram fornecidos
        if (empty($data["email"]) || empty($data["password"])) {
            $this->call(400, "bad_request", "Credenciais inválidas", "error")->back();
            return;
        }

        $user = new User();

        if(!$user->findByEmail($data["email"])){
            $this->call(401, "unauthorized", "Usuário não encontrado", "error")->back();
            return;
        }
        
        if(!password_verify($data["password"], $user->getPassword())){
            $this->call(401, "unauthorized", "Senha inválida", "error")->back();
            return;
        }
          if (!$user->getIsConfirmed()) {
            $jwt = new JWTToken();
            $decoded = $jwt->decode($user->getConfirmationToken());

        if (!$decoded) {
            // Token expirou, usuário não confirmou, apaga
            $user->deleteById($user->getId());
            $this->call(401, "unauthorized", "Usuário não confirmado e expirado. Por favor, registre-se novamente.", "error")->back();
            return;
        }
    }

        // Gerar o token JWT
        $jwt = new JWTToken();
        $token = $jwt->create([
            "id" => $user->getId(),
            "email" => $user->getEmail(),
            "idUserCategory" => $user->getIdUserCategory(),
        ]);

        // Retornar o token JWT na resposta
        $this->call(200, "success", "Login realizado com sucesso", "success")
            ->back([
                "token" => $token,
                "user" => [
                    "id" => $user->getId(),
                    "idUserCategory" => $user->getIdUserCategory(),
                    "name" => $user->getName(),
                    "email" => $user->getEmail(),
                    "phone" => $user->getPhone(),
                    "photo" => $user->getPhoto()
                ]
            ]);
}
    public function updateFile():void
    {
        $this->auth();

        $file = (!empty($_FILES["file"]["name"]) ? $_FILES["file"] : null);

        $upload = new Uploader();
        $path = $upload->File($file);
        if(!$path) {
            $this->call(400, "bad_request", $upload->getMessage(), "error")->back();
            return;
        }

        $user = new User();
        $user->findByEmail($this->userAuth->email);
        $user->setPhoto($path);
        if(!$user->updateById()){
            $this->call(500, "internal_server_error", $user->getErrorMessage(), "error")->back();
            return;
        }

        $this->call(200, "success", "Arquivo atualizado com sucesso", "success")->back();
    }

    public function updatePhoto (): void
    {
        $this->auth();

        $photo = (!empty($_FILES["photo"]["name"]) ? $_FILES["photo"] : null);

        $upload = new Uploader();
        // /storage/images/091da97a9aec86fe9905ecf532508cd4.png
        $path = $upload->Image($photo);
        if(!$path) {
            $this->call(400, "bad_request", $upload->getMessage(), "error")->back();
            return;
        }

        $user = new User();
        $user->findByEmail($this->userAuth->email);

        // foto antiga
        $oldPhoto = $user->getPhoto();

        // nome do arquivo antigo (tira ../ etc)
        $oldFilename = $oldPhoto ? basename($oldPhoto) : null;

        // caminho absoluto da pasta de imagens
        $storageDir = dirname(__DIR__, 2) . "/storage/images/";

        // se existe uma foto antiga, não é a padrão e não é igual à nova, exclui
        if (!empty($oldFilename) && $oldFilename !== "user.png" && $oldFilename !== basename($path)) {
            $oldPath = $storageDir . $oldFilename;
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }
        }

        $user->setPhoto($path);
        if(!$user->updateById()){
            $this->call(500, "internal_server_error", $user->getErrorMessage(), "error")->back();
            return;
        }
        $this->call(200, "success", "Foto atualizada com sucesso", "success")->back(["photo" => $user->getPhoto()]);
    }
    
    function deleteUser(array $data)
  { 
    $input = json_decode(file_get_contents("php://input"), true);

    $this->auth(); // autentica e define $this->userAuth

    // Verifica se o ID foi enviado e é válido
    if (!isset($data["id"]) || !filter_var($data["id"], FILTER_VALIDATE_INT)) {
        $this->call(400, "bad_request", "ID inválido", "error")->back();
        return;
    }

    $user = new User();

    // Verifica se o usuário existe
    if (!$user->findById($data["id"])) {
        $this->call(404, "not_found", "Usuário não encontrado", "error")->back();
        return;
    }

    // Só o próprio usuário ou um admin pode deletar
    $isOwner = $this->userAuth->id == $data["id"];
    $isAdmin = $this->userAuth->idUserCategory == 3;

    if (!$isOwner && !$isAdmin) {
        $this->call(403, "forbidden", "Você não tem permissão para deletar este usuário", "error")->back();
        return;
    }

    // Tenta deletar
    if (!$user->deleteById($data["id"])) {
        $this->call(500, "internal_server_error", $user->getErrorMessage() ?? "Erro ao deletar usuário", "error")->back();
        return;
    }

    $this->call(200, "success", "Usuário deletado com sucesso", "success")->back();
}

    public function confirmEmail(): void {
    $input = $_GET['token'] ?? null;
    if (!$input) {
        $this->call(400, "bad_request", "Token não fornecido", "error")->back();
        return;
    }

    $jwt = new JWTToken();
    $decoded = $jwt->decode($input);

    if (!$decoded) {
        $this->call(401, "unauthorized", "Token inválido ou expirado", "error")->back();
        return;
    }

    $user = new User();
    if (!$user->findById($decoded->data->id)) {
        $this->call(404, "not_found", "Usuário não encontrado", "error")->back();
        return;
    }

    $user->setIsConfirmed(1);
    $user->setConfirmationToken(null);
    $user->updateById();

    // Redireciona para login (front-end decide)
    header("Location: /login");
    exit;
    }
}