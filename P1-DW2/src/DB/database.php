<?php

namespace Alunos\Karyan\DB;

use PDO;
use PDOException;

class database {

    private $path = __DIR__ . '/../SQL/produtos_p1.db';
    private $pdo;

    public function __construct() {
        try {
            $this->pdo = new PDO("sqlite:$this->path", null, null,[PDO::ATTR_PERSISTENT => true]);
        } catch (PDOException $e) {
            echo "Erro ao conectar: " . $e->getMessage();
        }
    }
    public function getPdo(){
        return $this->pdo;
    }
 }


