<?php
    namespace Source\Core;
    require __DIR__ . '/../../vendor/autoload.php';
    use Dotenv\Dotenv;

    // Caminho para a pasta onde está o .env
    $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
    $dotenv->load();

    use PDO;
    use PDOException;

    abstract class Connect
    { 
    
    private static $instance;

    private static $dbHost;
    private static $dbName;
    private static $dbUser;
    private static $dbPass;

    public static function init(): void
    {
        self::$dbHost = $_ENV['DB_HOST'];
        self::$dbName = $_ENV['DB_NAME'];
        self::$dbUser = $_ENV['DB_USER'];
        self::$dbPass = $_ENV['DB_PASS'];
    }

        private const OPTIONS = [
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_CASE => PDO::CASE_NATURAL
        ];

        public static function getInstance(): ?PDO
{
    if (empty(self::$instance)) {

        // Garante que as variáveis do .env estejam carregadas
        if (empty(self::$dbHost)) {
            self::init();
        }

        try {
            self::$instance = new PDO(
                "mysql:host=" . self::$dbHost . ";dbname=" . self::$dbName,
                self::$dbUser,
                self::$dbPass,
                self::OPTIONS
            );

        } catch (PDOException $exception) {
            //redirect("/ops/problemas");
            echo "Problemas ao Conectar! ";
            echo $exception->getMessage();
                }
            }

            return self::$instance;
        }

        final private function __construct()
        {
        }

        private function __clone()
        {
        }
    }