<?php
require_once 'conexao.php';
require_once 'security.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$action = $_GET['action'] ?? '';

switch ($action) {
    case 'listar_projetos':
        try {
            $stmt = $pdo->query('SELECT * FROM projetos ORDER BY id DESC');
            $projetos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode(['status' => 'success', 'data' => $projetos]);
        } catch (PDOException $e) {
            echo json_encode(['status' => 'error', 'message' => 'Erro ao listar projetos.']);
        }
        break;

    case 'adicionar_projeto':
        checkLogin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                // Pega os dados do formulário
                $titulo = $_POST['titulo'] ?? '';
                $descricao = $_POST['descricao'] ?? '';
                $imagem_url = $_POST['imagem_url'] ?? '';
                $link_github = $_POST['link_github'] ?? '';
                $link_deploy = $_POST['link_deploy'] ?? '';
                $tecnologias_usadas = $_POST['tecnologias_usadas'] ?? '';
                $sql = "INSERT INTO projetos (titulo, descricao, imagem_url, link_github, link_deploy, tecnologias_usadas) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$titulo, $descricao, $imagem_url, $link_github, $link_deploy, $tecnologias_usadas]);
                echo json_encode(['status' => 'success', 'message' => 'Projeto adicionado com sucesso.']);
            } catch (PDOException $e) {
                echo json_encode(['status' => 'error', 'message' => 'Erro ao adicionar projeto.']);
            }
        } else {
            http_response_code(405); 
            echo json_encode(['status' => 'error', 'message' => 'Método não permitido.']);
        }
        break;

    case 'deletar_projeto':
        checkLogin();
        $id = $_GET['id'] ?? 0;
        
        try {
            $sql = "DELETE FROM projetos WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$id]);
            echo json_encode(['status' => 'success', 'message' => 'Projeto deletado com sucesso.']);
        } catch (PDOException $e) {
            echo json_encode(['status' => 'error', 'message' => 'Erro ao deletar projeto.']);
        }
        break;
    
    default:
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Ação inválida.']);
        break;
}