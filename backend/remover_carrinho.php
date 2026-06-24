<?php
session_start();
require_once 'conexao.php';

$id_carrinho = $_POST['id_carrinho'];

$sql = $pdo->prepare("
    DELETE FROM carrinho
    WHERE id_carrinho = ?
");

$sql->execute([$id_carrinho]);

echo "ok";

?>