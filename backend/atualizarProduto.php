<?php

require_once 'conexao.php';

$id = $_POST['id_produto'];

$produto_nome = $_POST['produto_nome'];
$produto_valor = $_POST['produto_valor'];
$produto_tamanho = $_POST['produto_tamanho'];
$produto_quantidade = $_POST['produto_quantidade'];
$produto_cor = $_POST['produto_cor'];
$produto_descricao = $_POST['produto_descricao'];

$sql = $pdo->prepare("
    UPDATE produto
    SET
        produto_nome = ?,
        produto_valor = ?,
        produto_tamanho = ?,
        produto_quantidade = ?,
        produto_cor = ?,
        produto_descricao = ?
    WHERE id_produto = ?
");

$sql->execute([
    $produto_nome,
    $produto_valor,
    $produto_tamanho,
    $produto_quantidade,
    $produto_cor,
    $produto_descricao,
    $id
]);

header ('Location: ../admin/produtos.php');
exit;

?>