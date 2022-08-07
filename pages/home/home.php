<?php
require_once "../../database/conexaoMysql.php";
require_once "../../commons/php/autenticacao.php";
require_once "../../commons/php/baseResponse.php";

session_start();
$pdo = mysqlConnect();

http_response_code(302);
if (checkLogged($pdo)) {
    echo json_encode(RequestResponse::newPage(true, "/pages/product-list/index.html"));
} else {
    echo json_encode(RequestResponse::newPage(true, "/default-product-list"));
}
exit();
