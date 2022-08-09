<?php
require_once  "../../database/conexaoMysql.php";
require_once "../../commons/php/autenticacao.php";
require_once  "../../commons/php/baseResponse.php";

session_start();
$pdo = mysqlConnect();
exitWhenNotLogged($pdo);

$email = $_SESSION['emailUsuario'];

try {
    $sql = <<<SQL
        SELECT *
        FROM anunciante 
        WHERE email = :email;
    SQL;

    $stmt = $pdo->prepare($sql);
    $stmt->execute([":email" => $email]);
    $result = $stmt->fetch();
} catch (Exception $ex) {
    http_response_code(500);
    header("Content-Type: application/json");
    echo json_encode(RequestResponse::basicResponse(false, $ex->getMessage()));
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
        <div id="register__container" class="content">
            <?php
            $nome = htmlspecialchars($result["nome"]);
            $cpf = htmlspecialchars($result["cpf"]);
            $email = htmlspecialchars($result["email"]);
            $telefone = htmlspecialchars($result["telefone"]);

            echo <<<HTML
                <div>
                    <form id="form-register" action="edit-profile.php" method="post" enctype="multipart/form-data" autocomplete="on">
                        <div id="register__container_title">
                            <h1 class="text_light">Alteração de cadastro</h1>
                        </div>
                        <div id="register__container_name" class="mt30">
                            <input type="text" name="name" id="name" autofocus required placeholder="Nome" minlength="10" value="$nome">
                        </div>
                        <div id="register__container_cpf" class="mt15">
                            <input type="text" id="cpf" name="cpf" required placeholder="CPF xxx.xxx.xxx-xx" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" value="$cpf">
                        </div>
                        <div id="register__container_email" class="mt15">
                            <input type="email" id="email" name="email" required placeholder="Email" readonly value="$email">
                        </div>
                        <div id="register__container_phone" class="mt15">
                            <input type="tel" id="phone" name="phone" required placeholder="Telefone XX 9XXXX XXXX" minlength="10" maxlength="11" value="$telefone">
                        </div>
                        <div id="register__container_password" class="mt15">
                            <input type="password" id="password" name="password" placeholder="Nova senha" minlength="6">
                        </div>
                        <div id="register__btn_enter" class="mv30">
                            <button type="submit" class="bt_primary">Alterar</button>
                        </div>
                    </form>
                </div>
            HTML;
            ?>
        </div>
    </main>

    <div id="footer__container">
        <footer class="center text_light">&copy;2022 DESAPEGO STORE</footer>
    </div>

</body>

</html>