<?php
    require_once  "../../database/conexaoMysql.php";
    require_once  "../../commons/php/baseResponse.php";
    require_once "../../commons/php/autenticacao.php";

    session_start();
    $pdo = mysqlConnect();
    exitWhenNotLogged($pdo);

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

        $response = RequestResponse::basicResponse(true,"Edição feita com sucesso");
        echo json_encode($response);

    }catch(Exception $err) {
        $pdo->rollBack();
        http_response_code(500);
        $response = RequestResponse::basicResponse(false,"Erro na edição");
        echo json_encode($response);
    }
    
?>