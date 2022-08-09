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
        SELECT interesse.codigo as "int_cod", interesse.data_hora, interesse.mensagem, interesse.contato, anuncio.codigo as 'an_cod', anuncio.titulo 
        FROM interesse 
        INNER JOIN anuncio ON codigo_anuncio = anuncio.codigo
        INNER JOIN anunciante ON anunciante.codigo = cod_anunciante
        WHERE email = :email
        ORDER BY data_hora;
    SQL;

    $stmt = $pdo->prepare($sql);
    $stmt->execute([":email" => $email]);
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
            <h3>Interesses</h3>
            <table class="table table-striped table-hover">
                <tr>
                    <th>Código interesse</th>
                    <th>Data do interesse</th>
                    <th>Título do anúncio</th>
                    <th>Contato</th>
                    <th>Mensagem</th>
                    <th>Excluir</th>
                </tr>

                <?php
                while ($row = $stmt->fetch()) {
                    $cod_interesse = htmlspecialchars($row['int_cod']);
                    $date = htmlspecialchars($row['data_hora']);
                    $anuncio_title = htmlspecialchars($row['titulo']);
                    $msg = htmlspecialchars($row['mensagem']);
                    $contact = htmlspecialchars($row['contato']);
                    $deleteUrl = "/pages/interest/delete.php?id=" . $cod_interesse;

                    echo <<<HTML
                <tr>
                    <td>$cod_interesse</td>
                    <td>$date</td>
                    <td>$anuncio_title</td>
                    <td>$contact</td>
                    <td>$msg</td>
                    <td><a href=$deleteUrl>Deletar</a></td>
                </tr>      
                HTML;
                }
                ?>
            </table>
        </div>
    </main>
</body>

</html>