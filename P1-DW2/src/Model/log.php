<?php

namespace Alunos\Karyan\Model;

use PDO;
use Exception;

class log {
    private $db;
    private $table='LOG';

    public function __construct($db) {
        $this->db = $db;
    }

    public function create($acao, $id_produto, $user_insert) {

        $sql = "INSERT INTO $this->table (acao, id_produto, user_insert) VALUES (?, ?, ?)";
        $stmt = $this->db->getPdo()->prepare($sql);
        $stmt->execute([$acao, $id_produto, $user_insert]);
    }

    public function findAll() {
        $sql = "SELECT * FROM $this->table";
        $stmt = $this->db->getPdo()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findByProductId($id_produto) {
        $sql = "SELECT * FROM $this->table WHERE id_produto = ?";
        $stmt = $this->db->getPdo()->prepare($sql);
        $stmt->execute([$id_produto]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}