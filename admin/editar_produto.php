<?php

require_once '../backend/conexao.php';

$id = $_GET['id'];

$sql = $pdo->prepare("SELECT * FROM produto WHERE id_produto = ?");

$sql->execute([$id]);

$produto = $sql->fetch();

?>

<form method="POST" action="../backend/atualizarProduto.php">

    <input type="hidden"
           name="id_produto"
           value="<?= $produto['id_produto']; ?>">

    <label>Nome</label>
    <input type="text"
           name="produto_nome"
           value="<?= $produto['produto_nome']; ?>">

    <br><br>

    <label>Valor</label>
    <input type="number"
           step="0.01"
           name="produto_valor"
           value="<?= $produto['produto_valor']; ?>">

    <br><br>

    <label>Tamanho</label>
    <input type="text"
           name="produto_tamanho"
           value="<?= $produto['produto_tamanho']; ?>">

    <br><br>

    <label>Quantidade</label>
    <input type="number"
           name="produto_quantidade"
           value="<?= $produto['produto_quantidade']; ?>">

    <br><br>

    <label>Cor</label>
    <input type="text"
           name="produto_cor"
           value="<?= $produto['produto_cor']; ?>">

    <br><br>

    <label>Descrição</label>

    <textarea name="produto_descricao"><?= $produto['produto_descricao']; ?></textarea>

    <br><br>

    <button type="submit">
        Salvar Alterações
    </button>

</form>