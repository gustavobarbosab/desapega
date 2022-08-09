<?php
require_once  "../../database/conexaoMysql.php";
require_once  "../../commons/php/baseResponse.php";
require_once "../../commons/php/autenticacao.php";

session_start();
$pdo = mysqlConnect();
exitWhenNotLogged($pdo);

$offset = $_GET['pag'];
$title = $_GET['title'] ?? "";

$email = $_SESSION['emailUsuario'];

header("Content-Type: application/json");
try {
    $sql = <<<SQL
        SELECT * FROM anuncio 
        JOIN anunciante ON anuncio.cod_anunciante = anunciante.codigo
        WHERE anuncio.titulo LIKE :title 
        AND anunciante.email = :email
        ORDER BY anuncio.data_hora
        LIMIT 20 OFFSET :offset;
    SQL;

    $stmt = $pdo->prepare($sql);
    $stmt->execute([":title" => "%" . $title . "%", ":email" => $email, ":offset" => $offset]);
    $dados = $stmt->fetchAll();
    echo json_encode($dados);
} catch (Exception $ex) {
    http_response_code(500);
    echo json_encode(RequestResponse::basicResponse(false, $ex->getMessage()));
}
