<?php

require_once '../backend/conexao.php';

$id = $_GET['id'];

$sql = $pdo->prepare("UPDATE produto SET produto_ativo = 0 WHERE id_produto = ? "); //Lembrando que não sera excluido.Ele vai desaparecer do cadastros mas continuará no banco de dados. O ID_PRODUTO SERÁ MANIPULADO DEPENDENDO SE O PRODUTO VAI ESTAR DIPOSNIVEL OU NÃO.

$sql->execute([$id]);

header('Location: produtos.php');
exit;

?>