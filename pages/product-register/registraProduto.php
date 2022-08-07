<?php
    include "mysqlConnection.php";
    
    $titulo = $_POST['titulo'] ?? "";
    $descricao = $_POST['descricao'] ?? "";
    $preco = $_POST['preco'] ?? "";
    $cep = $_POST['cep'] ?? "";
    $bairro = $_POST['bairro'] ?? "";
    $cidade = $_POST['cidade'] ?? "";
    $estado = $_POST['estado'] ?? "";
    $codcategoria = $_POST['codcategoria'] ?? "";    
    $codanunciante = $_POST['codanunciante'] ?? "";

    $titulo = htmlspecialchars($titulo);
    $descricao = htmlspecialchars($descricao);
    $preco = htmlspecialchars($preco);
    $cep = htmlspecialchars($cep);
    $bairro = htmlspecialchars($bairro);
    $cidade = htmlspecialchars($cidade);
    $estado = htmlspecialchars($estado);
    $codcategoria = htmlspecialchars($codcategoria);
    $codanunciante = htmlspecialchars($codanunciante);
    
    $sql = <<<SQL
        INSERT INTO `anuncio` (titulo, descricao, preco, data_hora, cep, bairro, cidade, estado, cod_categoria, cod_anunciante) 
        VALUES (:titulo, :descricao, :preco, sysdate, :cep, :bairro, :cidade, :estado, :cod_categoria, :cod_anunciante);
    SQL;

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':titulo',  $titulo);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':cep',  $cep);
    $stmt->bindParam(':bairro', $bairro);
    $stmt->bindParam(':cidade',  $cidade);
    $stmt->bindParam(':estado', $estado);
    $stmt->bindParam(':cod_categoria',  $cod_categoria);
    $stmt->bindParam(':cod_anunciante', $cod_anunciante);

    $stmt->execute();    
    
    echo "<script>
            swal({
                title: 'Sucesso!',
                text: 'Anúncio cadastrado com sucesso!',
                icon: 'success',
                button: 'OK'
            }).then(function() {
                window.location.href = '/registraProduto.php';
            });
        </script>";
?>