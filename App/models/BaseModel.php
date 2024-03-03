<?php
namespace App\models;

require_once __DIR__ . '/../config/config.php';

class BaseModel {
    protected $pdo;

    public function __construct() {
        try {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME;
            $this->pdo = new \PDO($dsn, DB_USER, DB_PASS);
        } catch (\PDOException $e) {
            die("Erro na conexão: " . $e->getMessage());
        }
    }
}
