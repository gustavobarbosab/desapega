<?php
require_once  "../../database/conexaoMysql.php";
require_once  "../../commons/php/baseResponse.php";
require_once "../../commons/php/autenticacao.php";

session_start();
$pdo = mysqlConnect();
$offset = $_GET['offset'];
$title = $_GET['title'] ?? "";

header("Content-Type: application/json");
try {
    $sql = <<<SQL
        SELECT * FROM anuncio
        WHERE titulo LIKE :title
        ORDER BY data_hora
        LIMIT 10 OFFSET :offset;
    SQL;

    $stmt = $pdo->prepare($sql);
    $stmt->execute([":title" => "%" . $title . "%", ":offset" => $offset]);
    $dataToReturn = [];

    while($row = $stmt->fetch()) 
    {
        $sqlImage = <<<SQL
            SELECT * FROM foto
            WHERE codigo_anuncio = $row[codigo];
        SQL;
        $stmtFoto = $pdo->query($sqlImage);
        $row["fotos"] = $stmtFoto->fetchAll();
        $dataToReturn[] = $row;
    }
    
    echo json_encode($dataToReturn);
} catch (Exception $ex) {
    http_response_code(500);
    echo json_encode(RequestResponse::basicResponse(false, $ex->getMessage()));
}
