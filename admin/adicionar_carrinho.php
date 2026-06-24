<?php

session_start();
require_once './backend/conexao.php';

if(!isset($_SESSION['login'])){
    header('Location: login.php');
    exit;
}

$idProduto = $_GET['id'];

$sql = $pdo->prepare("
    SELECT *
    FROM carrinho
    WHERE id_cliente = ?
    AND id_produto = ?
");

$sql->execute([
    $_SESSION['login'],
    $idProduto
]);

$item = $sql->fetch();

if($item){

    $update = $pdo->prepare("
        UPDATE carrinho
        SET quantidade = quantidade + 1
        WHERE id_carrinho = ?
    ");

    $update->execute([
        $item['id_carrinho']
    ]);

}else{

    $insert = $pdo->prepare("
        INSERT INTO carrinho
        (id_cliente, id_produto, quantidade)
        VALUES (?, ?, 1)
    ");

    $insert->execute([
        $_SESSION['login'],
        $idProduto
    ]);
}

header('Location: carrinho.php');
exit;

?>