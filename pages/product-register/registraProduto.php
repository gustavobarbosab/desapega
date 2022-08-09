<?php
require_once  "../../database/conexaoMysql.php";
require_once  "../../commons/php/baseResponse.php";
require_once "../../commons/php/autenticacao.php";

session_start();
$pdo = mysqlConnect();
exitWhenNotLogged($pdo);

$titulo = $_POST['titulo'] ?? "";
$descricao = $_POST['descricao'] ?? "";
$preco = $_POST['preco'] ?? "";
$cep = $_POST['cep'] ?? "";
$bairro = $_POST['bairro'] ?? "";
$cidade = $_POST['cidade'] ?? "";
$estado = $_POST['estado'] ?? "";
$codcategoria = $_POST['cod_categoria'] ?? "";
$codanunciante = getLoggedUserId($pdo);
$success = false;
try {
    $pdo->beginTransaction();

    $sql = <<<SQL
            INSERT INTO `anuncio` (titulo, descricao, preco, data_hora, cep, bairro, cidade, estado, cod_categoria, cod_anunciante) 
            VALUES (:titulo, :descricao, :preco, :data_hora, :cep, :bairro, :cidade, :estado, :cod_categoria, :cod_anunciante);
        SQL;

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':titulo', $titulo);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':preco', $preco);
    $stmt->bindParam(':cep', $cep);
    $stmt->bindParam(':bairro', $bairro);
    $stmt->bindParam(':data_hora', time());
    $stmt->bindParam(':cidade', $cidade);
    $stmt->bindParam(':estado', $estado);
    $stmt->bindParam(':cod_categoria', $codcategoria);
    $stmt->bindParam(':cod_anunciante', $codanunciante);

    $stmt->execute();

    $codanuncio =  $pdo->lastInsertId();

    $sql = <<<SQL
            INSERT INTO `foto` (codigo_anuncio, nome_arq_foto) 
            VALUES (:codigo_anuncio, :nome_arq_foto);
        SQL;


    $uploadDir = "/upload/";
    $folder = $folder = $_SERVER["DOCUMENT_ROOT"] . $uploadDir;
    if (!file_exists($folder)) {
        @mkdir($folder, 0755, true);
    }
    $extension = array("JPEG", "JPG", "PNG", "jpeg", "jpg", "png");
    foreach ($_FILES["files"]["name"] as $key => $name) {
        $file_name = $folder . basename($name);
        $file_tmp = $_FILES["files"]["tmp_name"][$key];
        $ext = pathinfo($file_name, PATHINFO_EXTENSION);

        if (in_array($ext, $extension)) {
            $filename = basename($file_name, $ext);
            $newFileName = $filename . time() . "." . $ext;
            $filePath = $folder . $newFileName;
            move_uploaded_file($_FILES["files"]["tmp_name"][$key], $filePath);

            $fileToSearch = $uploadDir . $newFileName;
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':codigo_anuncio', $codanuncio);
            $stmt->bindParam(':nome_arq_foto', $fileToSearch);
            $stmt->execute();
        } else {
            exit("Formato de imagem inválido!" . $ext);
        }
    }
    $pdo->commit();
    $success = true;
} catch (Exception $e) {
    $pdo->rollBack();
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
            <button class="menuItem"><a href="/pages/product-register/">Lista de Interesses</a></button>
            <button class="menuItem" id="logout" onclick="doLogout()">Logout</button>
        </aside>

        <div class="container" id="interests_container">
            <?php
            if ($success) {
                echo <<<HTML
                        <h3>Cadastrado com sucesso</h3>
                        <p><a href="/home">Voltar</a></p>
                    HTML;
            } else {
                echo <<<HTML
                        <h3>Houve um erro ao cadastrar!</h3>
                        <p><a href="/index.html">Voltar</a></p>
                        <p>$error</p>
                    HTML;
            }
            ?>
        </div>
    </main>
</body>

</html>