<?php
    
require  "../../database/conexaoMysql.php";
require  "../../commons/php/baseResponse.php";
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