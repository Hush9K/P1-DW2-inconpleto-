<?php

namespace Alunos\Karyan\Controller;

use Alunos\Karyan\Model\log;

class logController {
    private $log;

    public function __construct($db) {
        $this->log = new log($db); // Instancia a model log com a conexão do banco de dados
    }

    // Criar um novo log
    public function createLog($acao, $id_produto, $user_insert) {
        // Chama a função de criação do log no model
        $this->log->create($acao, $id_produto, $user_insert);
    }

    // Listar todos os logs
    public function getLogs() {
        $logs = $this->log->findAll();
        return ["status" => "success", "data" => $logs];
    }

    // Buscar logs por ID do produto
    public function getLogsByProductId($id_produto) {
        $logs = $this->log->findByProductId($id_produto);
        if ($logs) {
            return ["status" => "success", "data" => $logs];
        } else {
            return ["status" => "error", "message" => "Logs não encontrados"];
        }
    }
}