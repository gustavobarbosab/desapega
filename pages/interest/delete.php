<?php
require_once  "../../database/conexaoMysql.php";
require_once "../../commons/php/autenticacao.php";
require_once  "../../commons/php/baseResponse.php";

session_start();
$pdo = mysqlConnect();
exitWhenNotLogged($pdo);

$email = $_SESSION['emailUsuario'];
$id = $_GET['id'];
$success = false;

if ($id == NULL) {
    header("Content-Type: application/json");
    http_response_code(400);
    echo json_encode(RequestResponse::basicResponse(false, "paramêtro id necessário"));
}

try {
    $sql = <<<SQL
        SELECT *
        FROM interesse 
        INNER JOIN anuncio ON codigo_anuncio = anuncio.codigo
        INNER JOIN anunciante ON anunciante.codigo = cod_anunciante
        WHERE email = :email AND interesse.codigo = :id;
    SQL;

    $stmt = $pdo->prepare($sql);
    $stmt->execute([":email" => $email, ":id" => $id]);

    if ($stmt->fetchColumn()) {
        $sql = <<<SQL
            DELETE FROM interesse 
            WHERE codigo = :id;
         SQL;

        $stmt = $pdo->prepare($sql);
        $stmt->execute([":id" => $id]);

        if ($stmt->rowCount()) {
            $success = true;
        }
    }
} catch (Exception $ex) {
    $error = $ex->getMessage();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../../commons/menu.css">
    <script src="../../commons/script/logout.js"></script>
    <title>Lista de interesses</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-CuOF+2SnTUfTwSZjCXf01h7uYhfOBuxIhGKPbfEJ3+FqH/s6cIFN9bGr1HmAg4fQ" crossorigin="anonymous">
    <title>Listagem Produto</title>
</head>

<body>
    <header class="header_desapega">
        <img src="../../commons/images/logo.svg" alt="logo_desapega" height="40">
    </header>
    <main>
        <aside class="menu">
            <button class="menuItem"><a href="/pages/product-list/">Meus anúncios</a></button>
            <button class="menuItem"><a href="/pages/product-register/">Cadastrar Anuncio</a></button>
            <button class="menuItem" id="logout" onclick="doLogout()">Logout</button>
        </aside>

        <div class="container" id="interests_container">
            <?php
            if ($success) {
                echo <<<HTML
                        <h3>Deletado com sucesso</h3>
                        <p><a href="index.php">Voltar</a></p>
                    HTML;
            } else {
                echo <<<HTML
                        <h3>Houve um erro ao deletar!</h3>
                        <p><a href="index.php">Voltar</a></p>
                        <p>$error</p>
                    HTML;
            }
            ?>
        </div>
    </main>
</body>

</html>