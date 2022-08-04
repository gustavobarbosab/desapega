<?php

    include "mysqlConnection.php";
    
    $pagina = $_GET['pag'];
    $palavraChave1 = $_GET['pchave1'] ?? "";
    $palavraChave2 = $_GET['pchave2'] ?? "";
    $palavraChave3 = $_GET['pchave3'] ?? "";

    $palavraChave1 = htmlspecialchars($palavraChave1);
    $palavraChave2 = htmlspecialchars($palavraChave2);
    $palavraChave3 = htmlspecialchars($palavraChave3);

    $sql = <<<SQL
        SELECT * FROM anuncio a
        WHERE
        a.descricao like '%?%' AND
        a.descricao like '%?%' AND
        a.descricao like '%?%'
        ORDER BY a.data_hora
        LIMIT 6 OFFSET ?
    SQL;

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$palavraChave1,$palavraChave2,$palavraChave3,$pagina]);

    
    echo $dados
?>