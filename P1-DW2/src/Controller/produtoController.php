<?php

namespace Alunos\Karyan\Controller;

use Alunos\Karyan\Model\produto;
use Alunos\Karyan\DB\database;

class produtoController {
    private $produto;
    private $logController;
    private $db;

    public function __construct($db) {
        $this->produto = new produto($db); // Instancia a model produto com a conexão do banco de dados
        $this->logController = new logController($db); // Instancia olLogController
    }

    // Criar um novo produto
    public function createProduto($nome_produto, $descricao, $preco, $estoque, $user_insert) {
        // Validações de entrada
        if (strlen($nome_produto) < 3) {
            return ["status" => "error", "message" => "O nome do produto deve ter no mínimo 3 caracteres"];
        }
        if ($preco <= 0) {
            return ["status" => "error", "message" => "O preço deve ser um valor positivo"];
        }
        if ($estoque < 0) {
            return ["status" => "error", "message" => "O estoque deve ser um número inteiro maior ou igual a zero"];
        }

        // Chama a função de criação do produto no model
        $result = $this->produto->create($nome_produto, $descricao, $preco, $estoque, $user_insert);
        if ($result) {
            // Registra o log de criação
            $this->logController->createLog('criação', $this->produto->getLastInsertedId(), $user_insert);
            return ["status" => "success", "message" => "Produto criado com sucesso"];
        } else {
            return ["status" => "error", "message" => "Erro ao criar produto"];
        }
    }

    // Listar todos os produtos
    public function getProdutos() {
        $produtos = $this->produto->findAll();
        return ["status" => "success", "data" => $produtos];
    }

    // Buscar um produto pelo ID
    public function getProdutoById($id_produto) {
        $produto = $this->produto->findById($id_produto);
        if ($produto) {
            return ["status" => "success", "data" => $produto];
        } else {
            return ["status" => "error", "message" => "Produto não encontrado"];
        }
    }

    // Atualizar um produto
    public function updateProduto($id_produto, $nome_produto, $descricao, $preco, $estoque, $user_insert) {
        // Validações de entrada
        if (strlen($nome_produto) < 3) {
            return ["status" => "error", "message" => "O nome do produto deve ter no mínimo 3 caracteres"];
        }
        if ($preco <= 0) {
            return ["status" => "error", "message" => "O preço deve ser um valor positivo"];
        }
        if ($estoque < 0) {
            return ["status" => "error", "message" => "O estoque deve ser um número inteiro maior ou igual a zero"];
        }

        $result = $this->produto->update($id_produto, $nome_produto, $descricao, $preco, $estoque, $user_insert);
        if ($result) {
            // Registra o log de atualização
            $this->logController->createLog('atualização', $id_produto, $user_insert);
            return ["status" => "success", "message" => "Produto atualizado com sucesso"];
        } else {
            return ["status" => "error", "message" => "Erro ao atualizar produto"];
        }
    }

    // Deletar um produto
    public function deleteProduto($id_produto, $user_insert) {
        $result = $this->produto->delete($id_produto);
        if ($result) {
            // Registra o log de exclusão
            $this->logController->createLog('exclusão', $id_produto, $user_insert);
            return ["status" => "success", "message" => "Produto deletado com sucesso"];
        } else {
            return ["status" => "error", "message" => "Erro ao deletar produto"];
        }
    }
}