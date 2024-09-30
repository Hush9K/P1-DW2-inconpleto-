<?php

namespace Alunos\Karyan\Model;

use PDO;
use Exception;

class produto {
    private $conn;
    private $table = "PRODUTO";

    public function __construct($db) {
        $this->conn = $db;
    }

    // CREATE
    public function create($nome_produto, $descricao, $preco, $estoque, $user_insert) {
 
        if (empty($nome_produto) || strlen($nome_produto) < 3) {
            return "O nome do produto deve ter no mínimo 3 caracteres.";
        }
        if ($preco < 0) {
            return "O preço deve ser um valor positivo.";
        }
        if ($estoque < 0) {
            return "O estoque deve ser um número inteiro maior ou igual a zero.";
        }

        $query = "INSERT INTO $this->table (nome_produto, descricao, preco, estoque, user_insert) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        
        try {
            return $stmt->execute([$nome_produto, $descricao, $preco, $estoque, $user_insert]);
        } catch (Exception $e) {
            return "Erro ao criar produto: " . $e->getMessage();
        }
    }

    // READ 
    public function findAll() {
        $query = "SELECT * FROM $this->table";
        try {
            return $this->conn->query($query)->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return "Erro ao buscar produtos: " . $e->getMessage();
        }
    }

    public function getLastInsertedId() {
        return $this->conn->lastInsertId();
    }

    // READ
    public function findById($id_produto) {
        $query = "SELECT * FROM $this->table WHERE id_produto = ?";
        $stmt = $this->conn->prepare($query);
        try {
            $stmt->execute([$id_produto]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return "Erro ao buscar produto: " . $e->getMessage();
        }
    }

    // UPDATE
    public function update($id_produto, $nome_produto, $descricao, $preco, $estoque, $user_insert) {
        
        if (empty($nome_produto) || strlen($nome_produto) < 3) {
            return "O nome do produto deve ter no mínimo 3 caracteres.";
        }
        if ($preco < 0) {
            return "O preço deve ser um valor positivo.";
        }
        if ($estoque < 0) {
            return "O estoque deve ser um número inteiro maior ou igual a zero.";
        }

        $query = "UPDATE $this->table SET nome_produto = ?, descricao = ?, preco = ?, estoque = ?, user_insert = ? WHERE id_produto = ?";
        $stmt = $this->conn->prepare($query);
        
        try {
            return $stmt->execute([$nome_produto, $descricao, $preco, $estoque, $user_insert, $id_produto]);
        } catch (Exception $e) {
            return "Erro ao atualizar produto: " . $e->getMessage();
        }
    }
    // DELETE
    public function delete($id_produto) {
        $query = "DELETE FROM $this->table WHERE id_produto = ?";
        $stmt = $this->conn->prepare($query);
        
        try {
            return $stmt->execute([$id_produto]);
        } catch (Exception $e) {
            return "Erro ao deletar produto: " . $e->getMessage();
        }
    }
}