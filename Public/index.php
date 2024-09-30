<?php
namespace Alunos\Karyan;
require_once '../vendor/autoload.php';

use Alunos\Karyan\DB\database;
use Alunos\Karyan\Controller\produtoController;
use Alunos\Karyan\Controller\logController;

$database = new database();
$db = $database->conecta();
$produtoController = new produtoController($db);
$logController = new logController($db);

$method = $_SERVER['REQUEST_METHOD'];
$action = $_GET['action'] ?? null;
$id = $_GET['id'] ?? null;

switch ($action) {
    case 'produtos':
        switch ($method) {

            case 'GET':
                if ($id) {

                    $produto = $produtoController->show($id);
                    echo json_encode($produto);
                } else {
            
                    $produtos = $produtoController->index();
                    echo json_encode($produtos);
                }
                break;

          
            case 'POST':
                
                $data = json_decode(file_get_contents("php://input"), true);
                $produtoController->create(
                    $data['nome_produto'],
                    $data['descricao'],
                    $data['preco'],
                    $data['estoque'],
                    $data['user_insert']
                );
                echo json_encode(['message' => 'O produto foi adicionado com sucesso']);
                break;

        
            case 'PUT':
                if ($id) {
                    $data = json_decode(file_get_contents("php://input"), true);
                    $produtoController->update(
                        $id,
                        $data['nome_produto'],
                        $data['descricao'],
                        $data['preco'],
                        $data['estoque'],
                        $data['user_insert']
                    );
                    echo json_encode(['message' => 'O produto foi atualizado com sucesso']);
                }
                break;

          
            case 'DELETE':
                if ($id) {
                    $produtoController->delete($id);
                    echo json_encode(['message' => 'O produto foi excluído com sucesso']);
                }
                break;

            default:
                http_response_code(405); 
                echo json_encode(['message' => 'Método não permitido']);
                break;
        }
        break;

    case 'logs':
        
        if ($method === 'GET') {
            $logs = $logController->index();
            echo json_encode($logs);
        } else {
            http_response_code(405); 
            echo json_encode(['message' => 'Método não permitido']);
        }
        break;

    default:
        http_response_code(404); 
        echo json_encode(['message' => 'Rota não encontrada']);
        break;
}