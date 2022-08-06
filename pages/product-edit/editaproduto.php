<?php
    require  "../../database/conexaoMysql.php";
    require  "../../commons/php/baseResponse.php";
    $pdo = mysqlConnect();

    $codigo = $_POST['cod'] ?? "";

    $newDescription = $_POST['descriptionInput'] ?? "";
    $newTitle = $_POST['titleInput'] ?? "";
    $NewPrice = $_POST['NewPrice'] ?? "";

    $sql = <<<SQL
        UPDATE anuncio
        SET descricao = ? , preco = ? , titulo = ?
        WHERE codigo = $codigo
    SQL;

    header("Content-Type: application/json");
    try{
        $pdo->beginTransaction();

        $stmt = $pdo->prepare($sql);
        if(!$stmt->execute([$newDescription,$NewPrice,$newTitle])){
            throw new Exception('Edit error');
        }

        $pdo->commit();

        echo json_encode(new RequestResponse(true, "Anuncio editado com sucesso!"));

    }catch(Exception $err) {
        $pdo->rollBack();
        http_response_code(500);
        echo json_encode(new RequestResponse(false, $err->getMessage()));
    }
    
?>