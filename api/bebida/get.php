<?php
// CRIAÇÃO ROTA GET.PHP
// Headers obrigatórios
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// Incluir arquivos de banco de dados e modelo
include_once '../../config/Database.php';
include_once '../../models/Bebida.php';
 
// Instanciar o objeto Database e obter a conexão
$database = new Database();
$db = $database->getConnection();
 
if (!$db) {
    //http_response_code(500);
     header("HTTP/1.1 500 Internal Server Error");
    echo json_encode(array("message" => "Erro de conexão com o banco de dados."));
    exit;
}
 
// Instanciar o objeto Bebida
$bebida = new Bebida($db);
$bebida->idBebida = isset($_GET['id']) ? (int) $_GET['id'] : 0;
 
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if ($bebida->idBebida > 0 && $bebida->get()) {
        $bebida_arr = array(
            "id" => $bebida->idbebida,
            "nome" => $bebida->nome,
            "tipo" => $bebida->tipo,
            "valor" => $bebida->valor
        );
 
        echo json_encode($bebida_arr);
    } else {
        //http_response_code(404);
        header("HTTP/1.1 404 Not Found");
        echo json_encode(array("message" => "Bebida não encontrada."));
    }
} else {
    // http_response_code(405);
        header("HTTP/1.1 405");
    echo json_encode(array("message" => "Método não permitido."));
     
     
}