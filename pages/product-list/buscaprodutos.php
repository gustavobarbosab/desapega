<?php

require  "../../database/conexaoMysql.php";
require  "../../commons/php/baseResponse.php";
require "../../commons/php/autenticacao.php";

session_start();
$pdo = mysqlConnect();
exitWhenNotLogged($pdo);

$pagina = $_GET['pag'];
$palavraChave1 = $_GET['pchave1'] ?? "";
$palavraChave2 = $_GET['pchave2'] ?? "";
$palavraChave3 = $_GET['pchave3'] ?? "";

$palavraChave1 = htmlspecialchars($palavraChave1);
$palavraChave2 = htmlspecialchars($palavraChave2);
$palavraChave3 = htmlspecialchars($palavraChave3);

header("Content-Type: application/json");
try {
    // $sql = <<<SQL
    //     SELECT * FROM anuncio
    //     WHERE
    //     descricao like '%?%' AND
    //     descricao like '%?%' AND
    //     descricao like '%?%'
    //     ORDER BY data_hora
    //     LIMIT 6 OFFSET ?;
    // SQL;
    $sql = <<<SQL
        SELECT * FROM anuncio
        ORDER BY data_hora
    SQL;

    $stmt = $pdo->prepare($sql);

    //$stmt->execute([$palavraChave1,$palavraChave2,$palavraChave3,$pagina]);
    $stmt->execute([]);

    $dados = $stmt->fetchAll();

    echo json_encode($dados);

}catch (Exception $ex) {
    http_response_code(500);
    echo json_encode(new RequestResponse(false, $ex->getMessage()));
}

?>