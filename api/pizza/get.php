<?php
// CRIAÇÃO ROTA GET.PHP
// Headers obrigatórios
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// Incluir arquivos de banco de dados e modelo
include_once '../../config/Database.php';
include_once '../../models/Pizza.php';
 
// Instanciar o objeto Database e obter a conexão
$database = new Database();
$db = $database->getConnection();
 
if (!$db) {
    //http_response_code(500);
     header("HTTP/1.1 500 Internal Server Error");
    echo json_encode(array("message" => "Erro de conexão com o banco de dados."));
    exit;
}
 
// Instanciar o objeto Pizza
$pizza = new Pizza($db);
$pizza->idPizza = isset($_GET['id']) ? (int) $_GET['id'] : 0;
 
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if ($pizza->idPizza > 0 && $pizza->get()) {
        $pizza_arr = array(
            "id" => $pizza->idpizza,
            "nome" => $pizza->nome,
            "ingredientes" => $pizza->ingredientes,
            "valor" => $pizza->valor
        );
 
        echo json_encode($pizza_arr);
    } else {
        //http_response_code(404);
        header("HTTP/1.1 404 Not Found");
        echo json_encode(array("message" => "Pizza não encontrada."));
    }
} else {
    // http_response_code(405);
        header("HTTP/1.1 405");
    echo json_encode(array("message" => "Método não permitido."));
     
     
}
 