<?php
require_once "../../database/conexaoMysql.php";
require_once "../../commons/php/autenticacao.php";

session_start();
$pdo = mysqlConnect();
exitWhenNotLogged($pdo);

?>
<h2>Dados corretos! Bem Vindo!</h2>
<p> Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ut tenetur distinctio odio vel possimus necessitatibus
    aut ab nesciunt beatae, laudantium at alias, quaerat debitis quam labore fugit dolores amet? Temporibus.</p>
<hr>
<p><strong>Dica:</strong> clique em sair e posteriormente tente acessar esta página digitando diretamente 'home.php' na barra de endereços do navegador</p>
<a href="logout.php">SAIR<a>

