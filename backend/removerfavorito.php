<?php

session_start();
require_once 'conexao.php';

if(!isset($_SESSION['login'])){
    exit;
}

$id_cliente = $_SESSION['login'];
$id_produto = $_POST['id_produto'];

$sql = $pdo->prepare("
    DELETE FROM favoritos
    WHERE id_cliente = ?
    AND id_produto = ?
");

$sql->execute([
    $id_cliente,
    $id_produto
]);

echo 'ok';

?>