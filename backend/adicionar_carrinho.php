<?php
session_start();
require_once 'conexao.php';

$idCliente = $_SESSION['login'];
$idProduto = $_POST['id_produto'];

// verifica se existe
$sql = $pdo->prepare("
    SELECT 1 FROM carrinho
    WHERE id_cliente = ? AND id_produto = ?
");
$sql->execute([$idCliente, $idProduto]);

$existe = $sql->fetchColumn();

if ($existe) {

    $sql = $pdo->prepare("
        DELETE FROM carrinho
        WHERE id_cliente = ? AND id_produto = ?
    ");
    $sql->execute([$idCliente, $idProduto]);

    echo "removido";

} else {

    $sql = $pdo->prepare("
        INSERT INTO carrinho (id_cliente, id_produto)
        VALUES (?, ?)
    ");
    $sql->execute([$idCliente, $idProduto]);

    echo "adicionado";
}
?>