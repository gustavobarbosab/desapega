<?php
require_once  "../../database/conexaoMysql.php";
require_once "../../commons/php/autenticacao.php";
require_once  "../../commons/php/baseResponse.php";

session_start();
$pdo = mysqlConnect();
exitWhenNotLogged($pdo);

$email = $_SESSION['emailUsuario'];

$cpf = $_POST['cpf'];
$telefone = $_POST['phone'];
$nome = $_POST['name'];
$novaSenha = $_POST['password'];
$success = false;

try {
    $sql = <<<SQL
        UPDATE anunciante 
        SET nome = :nome, cpf = :cpf, telefone = :telefone, password_hash = :password_hash
        WHERE email = :email;
    SQL;

    if ($novaSenha == NULL || $novaSenha == "" || checkPassword($pdo, $email, $novaSenha)) {
        $sql = <<<SQL
            UPDATE anunciante 
            SET nome = :nome, cpf = :cpf, telefone = :telefone
            WHERE email = :email;
        SQL;
        $stmt = $pdo->prepare($sql);
        $stmt->execute([":nome" => $nome, ":cpf" => $cpf, ":telefone" => $telefone, ":email" => $email]);
    } else {
        $newSenha_hash = password_hash($novaSenha, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare($sql);
        $stmt->execute([":nome" => $nome, ":cpf" => $cpf, ":telefone" => $telefone, ":password_hash" => $newSenha_hash, ":email" => $email]);
    }
    $success = true;
} catch (Exception $ex) {
    $error = $ex->getMessage();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar perfil</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../../commons/menu.css">
    <script src="../../commons/script/logout.js"></script>
</head>

<body>

    <header>
        <div class="page-margin horizontal-center">
            <div id="logo" class="container side-by-side menu__item" path="home">
                <div class="center">
                    <img id="logo__img" src="../../commons/images/logo.svg" alt="Logo" width="184">
                </div>
            </div>
        </div>
    </header>

    <main id="main__container">
        <aside class="menu">
            <button class="menuItem"><a href="/pages/product-list/">Meus anúncios</a></button>
            <button class="menuItem"><a href="/pages/product-register/">Cadastrar Anuncio</a></button>
            <button class="menuItem"><a href="/pages/interest/">Ver Interesses</a></button>
            <button class="menuItem" id="logout" onclick="doLogout()">Logout</button>
        </aside>
        <div class="container" id="message_container">
            <?php
            if ($success) {
                echo <<<HTML
                        <h3>Editado com sucesso</h3>
                        <p><a href="/home">Voltar</a></p>
                    HTML;
            } else {
                echo <<<HTML
                        <h3>Houve um erro ao editar!</h3>
                        <p><a href="index.php">Voltar</a></p>
                        <p>$error</p>
                    HTML;
            }
            ?>
        </div>
    </main>
</body>

</html>