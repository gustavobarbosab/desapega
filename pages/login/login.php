<?php
require  "../../database/conexaoMysql.php";
require  "../../commons/php/baseResponse.php";
require  "../../commons/php/autenticacao.php";

session_start();
$email = $_POST['email'] ?? '';
$senha = $_POST['password'] ?? '';

$pdo = mysqlConnect();

if ($senhaHash = checkPassword($pdo, $email, $senha)) {
  $_SESSION['emailUsuario'] = $email;
  $_SESSION['loginString'] = hash('sha512', $senhaHash . $_SERVER['HTTP_USER_AGENT']);
  $response = RequestResponse::basicResponse(true, 'Login feito com sucesso!');
} else {
  $response = RequestResponse::basicResponse(false, 'Ops... Houve uma falha.');
}

echo json_encode($response);
