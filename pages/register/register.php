<?php
require  "../../database/conexaoMysql.php";
require  "../../commons/php/baseResponse.php";
$pdo = mysqlConnect();

$username = $_POST["name"];
$cpf = $_POST["cpf"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$password = $_POST["password"];
$passwordHash = password_hash($password, PASSWORD_DEFAULT);

$sqlToInsertData = <<<SQL
  INSERT INTO anunciante (nome, cpf, email, telefone, password_hash)
  VALUES (:nome, :cpf, :email, :telefone, :password_hash)
SQL;

header("Content-Type: application/json");
try {
    $pdo->beginTransaction();
    $statementToInsert = $pdo->prepare($sqlToInsertData);

    if (!$statementToInsert->execute([
        $username,
        $cpf,
        $email,
        $phone,
        $passwordHash
    ])) {
        throw new Exception('Insertion error, please check your data or database');
    }
    $pdo->commit();
    echo json_encode(new RequestResponse(true, "Cadastro efetuado com sucesso!"));
} catch (Exception $ex) {
    $pdo->rollBack();
    http_response_code(500);
    echo json_encode(new RequestResponse(false, $ex->getMessage()));
}
