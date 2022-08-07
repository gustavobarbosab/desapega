<?php
require  "../../commons/php/conexaoMysql.php";
require  "../../commons/php/baseResponse.php";
require  "../../commons/php/autenticacao.php";

session_start();
$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

$pdo = mysqlConnect();
if ($senhaHash = checkPassword($pdo, $email, $senha)) {
  // Armazena dados úteis para confirmação 
  // de login em outros scripts PHP
  $_SESSION['emailUsuario'] = $email;
  $_SESSION['loginString'] = hash('sha512', $senhaHash . $_SERVER['HTTP_USER_AGENT']);  
  $response = new RequestResponse(true, 'home.php');
} 
else
  $response = new RequestResponse(false, ''); 

echo json_encode($response);



