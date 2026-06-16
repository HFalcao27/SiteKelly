<?php

session_start();
require_once 'conexao.php';

if (!isset($_SESSION['login'])) {
    exit('Faça login');
}

$id_cliente = $_SESSION['login'];
$id_produto = $_POST['id_produto'];

$sql = $pdo->prepare("INSERT IGNORE INTO favoritos (id_cliente, id_produto) VALUES (?, ?)"); 
//insert ignore, ignora duplicados. CASO TIVESSE SEM O INSERT IGNORE DARIA ERRO QUANDO O USUARIO CLICASSE DUAS VEZES NO CORAÇÃO.

$sql->execute([
    $id_cliente,
    $id_produto
]);

echo 'ok';

?>