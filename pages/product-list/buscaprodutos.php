<?php
require  "../../database/conexaoMysql.php";
require  "../../commons/php/baseResponse.php";
require "../../commons/php/autenticacao.php";

session_start();
$pdo = mysqlConnect();
$offset = $_GET['pag'];
$title = $_GET['title'] ?? "";

$email = $_SESSION['emailUsuario'];

header("Content-Type: application/json");
try {
    $sql = <<<SQL
        SELECT * FROM anuncio JOIN anunciante ON cod_anunciante = codigo
        WHERE titulo LIKE :title AND email = :email
        ORDER BY data_hora
        LIMIT 20 OFFSET :offset;
    SQL;

    $stmt = $pdo->prepare($sql);
    $stmt->execute([":title" => "%".$title."%",":offset" => $offset, ":email" => $email]);
    $dados = $stmt->fetchAll();
    echo json_encode($dados);
} catch (Exception $ex) {
    http_response_code(500);
    echo json_encode(new RequestResponse(false, $ex->getMessage()));
}

?>