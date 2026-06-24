<?php

require_once 'conexao.php';

$id = $_POST['id_produto'];

$produto_nome = $_POST['produto_nome'];
$produto_valor = $_POST['produto_valor'];
$produto_tamanho = $_POST['produto_tamanho'];
$produto_quantidade = $_POST['produto_quantidade'];
$produto_cor = $_POST['produto_cor'];
$produto_descricao = $_POST['produto_descricao'];
$produto_categoria = $_POST['produto_categoria'];

$sql = $pdo->prepare("
    UPDATE produto
    SET
        produto_nome = ?,
        produto_valor = ?,
        produto_tamanho = ?,
        produto_quantidade = ?,
        produto_cor = ?,
        produto_descricao = ?,
        produto_categoria = ?
    WHERE id_produto = ?
");

$sql->execute([
    $produto_nome,
    $produto_valor,
    $produto_tamanho,
    $produto_quantidade,
    $produto_cor,
    $produto_descricao,
    $produto_categoria,
    $id
]);

$sqlDelete = $pdo->prepare("
    DELETE FROM produto_carrossel
    WHERE id_produto = ?
");

$sqlDelete->execute([$id]);

if(isset($_POST['carrossel'])){

    foreach($_POST['carrossel'] as $idCarrossel){

        $sqlCarrossel = $pdo->prepare("
            INSERT INTO produto_carrossel
            (id_produto, id_carrossel)
            VALUES (?, ?)
        ");

        $sqlCarrossel->execute([
            $id,
            $idCarrossel
        ]);
    }
}

header ('Location: ../admin/produtos.php');
exit;

?>