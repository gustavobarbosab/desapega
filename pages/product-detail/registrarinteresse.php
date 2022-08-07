<?php 
    require  "../../database/conexaoMysql.php";
    require  "../../commons/php/baseResponse.php";
    $pdo = mysqlConnect();

    $codigo = $_POST['cod'] ?? "";

    $contato = $_POST['contato'] ?? "";
    $mensagem = $_POST['mensagem'] ?? "";
    
    $sql = <<<SQL
        
    SQL;

    header("Content-Type: application/json");
    try{
        $pdo->beginTransaction();

        $stmt = $pdo->prepare($sql);
        if(!$stmt->execute([$codigo,$contato,$mensagem])){
            throw new Exception('Erro ao registrar interesse');
        }

        $pdo->commit();

        echo json_encode(new RequestResponse(true, "Interesse registrado com sucesso!"));

    }catch(Exception $err) {
        $pdo->rollBack();
        http_response_code(500);
        echo json_encode(new RequestResponse(false, $err->getMessage()));
    }
    
?>