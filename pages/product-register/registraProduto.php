<?php
require  "../../database/conexaoMysql.php";
require  "../../commons/php/baseResponse.php";

    $pdo = mysqlConnect();

    $titulo = $_POST['titulo'] ?? "";
    $descricao = $_POST['descricao'] ?? "";
    $preco = $_POST['preco'] ?? "";
    $cep = $_POST['cep'] ?? "";
    $bairro = $_POST['bairro'] ?? "";
    $cidade = $_POST['cidade'] ?? "";
    $estado = $_POST['estado'] ?? "";
    $codcategoria = $_POST['codcategoria'] ?? "";    
    $codanunciante = $_POST['codanunciante'] ?? "";    
    $fotos = $_FILES['name'] ?? "";    
        
    try{
        $pdo->beginTransaction();

        $sql = <<<SQL
            INSERT INTO `anuncio` (titulo, descricao, preco, data_hora, cep, bairro, cidade, estado, cod_categoria, cod_anunciante) 
            VALUES (:titulo, :descricao, :preco, sysdate, :cep, :bairro, :cidade, :estado, :cod_categoria, :cod_anunciante);
        SQL;

        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':preco', $preco);
        $stmt->bindParam(':cep', $cep);
        $stmt->bindParam(':bairro', $bairro);
        $stmt->bindParam(':cidade', $cidade);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':cod_categoria', $codcategoria);
        $stmt->bindParam(':cod_anunciante', $codanunciante);

        $stmt->execute();    
        
        $codanuncio =  $pdo->lastInsertId();

        $sql = <<<SQL
            INSERT INTO `imagem` (cod_anuncio, imagem) 
            VALUES (:cod_anuncio, :imagem);
        SQL;
        foreach ($fotos as $img) {
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':cod_anuncio', $codAnuncio);
            $stmt->bindParam(':imagem', $img);
            $stmt->execute();
        }
        $pdo->commit();

        swalsuccess('Anúncio cadastrado com sucesso!');
    }
    catch(Exception $e){
        $pdo->rollBack();
        swalerror('Erro ao cadastrar anúncio!' + $e->getMessage());
    }
        
    
    
    function swalsuccess($msg) {
        echo "<script>
        window.alert('$msg');;
    </script>";    
    }

    function swalerror($msg) {
        echo "<script>
            window.alert('$msg');
            window.location.href='../../pages/product-register/index.html';
    </script>";
    }   
?>