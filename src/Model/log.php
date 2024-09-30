<?php

namespace Alunos\Karyan\Model;

use PDO;
use Exception;

class log {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function create($acao, $id_produto, $user_insert) {

        $sql = "INSERT INTO log (acao, id_produto, user_insert) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$acao, $id_produto, $user_insert]);
    }

    public function findAll() {
        $sql = "SELECT * FROM log";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findByProductId($id_produto) {
        $sql = "SELECT * FROM log WHERE id_produto = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id_produto]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}