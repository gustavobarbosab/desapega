<?php
    require  "../../database/conexaoMysql.php";
    require  "../../commons/php/baseResponse.php";
    $pdo = mysqlConnect();

    $codigo = $_POST['cod'] ?? "";

    $newDescription = $_POST['descriptionInput'] ?? "";
    $newTitle = $_POST['titleInput'] ?? "";
    $NewPrice = $_POST['NewPrice'] ?? "";
    $cep = $_POST['cep'] ?? "";
    $bairro = $_POST['bairro'] ?? "";
    $cidade = $_POST['cidade'] ?? "";
    $estado = $_POST['estado'] ?? "";

    $sql = <<<SQL
        UPDATE anuncio
        SET descricao = ? , preco = ? , titulo = ?, cep = ?, bairro = ?, cidade = ?, estado = ?
        WHERE codigo = $codigo
    SQL;

    header("Content-Type: application/json");
    try{
        $pdo->beginTransaction();

        $stmt = $pdo->prepare($sql);
        if(!$stmt->execute([$newDescription,$NewPrice,$newTitle,$cep,$bairro,$cidade,$estado])){
            throw new Exception('Edit error');
        }

        $pdo->commit();

        echo true;

    }catch(Exception $err) {
        $pdo->rollBack();
        http_response_code(500);
        echo false;
    }
    
?>