<?php

namespace Alunos\Karyan\DB;

use PDO;
use PDOException;

class database {
    private $path = __DIR__ . '/../SQL/produtos_p1.sqbpro'; // Caminho para o arquivo SQLite

    public function conecta() {
        try {
            $pdo = new PDO("sqlite:$this->path", null, null, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]);
            echo "Conexão bem-sucedida com SQLite!\n";
            return $pdo;
        } catch (PDOException $e) {
            echo "Erro ao conectar: " . $e->getMessage();
        }
    }
}