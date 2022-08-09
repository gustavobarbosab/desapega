<?php
require_once  "../../database/conexaoMysql.php";
require_once  "../../commons/php/baseResponse.php";
require_once "../../commons/php/autenticacao.php";

session_start();
$pdo = mysqlConnect();
exitWhenNotLogged($pdo);

$cod = $_GET['cod'];

header("Content-Type: application/json");
try {
    $sql = <<<SQL
        DELETE FROM anuncio
        WHERE anuncio.codigo = ?
    SQL;

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$cod]);

} catch (Exception $ex) {
    http_response_code(500);
}
