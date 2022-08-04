<?php
require  __DIR__ . "/database/conexaoMysql.php";
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
} catch (Exception $ex) {
    $pdo->rollBack();
    exit("We cannot register this data, please check the database or your data");
}
