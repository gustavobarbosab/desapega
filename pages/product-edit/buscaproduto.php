<?php
    
require_once  "../../database/conexaoMysql.php";
require_once  "../../commons/php/baseResponse.php";
$pdo = mysqlConnect();

// codigo

    $codigo = $_GET['cod'] ?? "";

    $sql = <<<SQL
        SELECT * FROM anuncio
        WHERE codigo = $codigo
    SQL;

    $stmt = $pdo->query($sql);

    echo json_encode($stmt->fetch());

?>