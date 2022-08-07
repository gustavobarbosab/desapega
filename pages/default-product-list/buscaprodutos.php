<?php
require  "../../database/conexaoMysql.php";
require  "../../commons/php/baseResponse.php";
require "../../commons/php/autenticacao.php";

session_start();
$pdo = mysqlConnect();
$pagina = $_GET['offset'];

header("Content-Type: application/json");
try {
    $sql = <<<SQL
        SELECT * FROM anuncio
        ORDER BY data_hora
        LIMIT 6 OFFSET ?;
    SQL;

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$pagina]);
    $dados = $stmt->fetchAll();
    echo json_encode($dados);

}catch (Exception $ex) {
    http_response_code(500);
    echo json_encode(new RequestResponse(false, $ex->getMessage()));
}
?>