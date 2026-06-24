<?php
session_start();
require_once './conexao.php';

$id_carrinho = $_POST['id_carrinho'];

$sql = $pdo->prepare("
    UPDATE carrinho
    SET quantidade = quantidade + 1
    WHERE id_carrinho = ?
");

$sql->execute([$id_carrinho]);

echo "ok";

?>