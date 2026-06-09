<?php

require_once '../backend/conexao.php';

$sql = $pdo->prepare(" SELECT * FROM produto WHERE produto_ativo = 1"); //Esse 1 significa que o produto está ativo, 0 o produto não está disponivel
$sql->execute();

$produtos = $sql->fetchAll();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Produtos Cadastrados</title>

    <h1>Produtos Cadastrados</h1>
</head>
<body>

<table border="1">

    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Valor</th>
        <th>Tamanho</th>
        <th>Quantidade</th>
        <th>Imagem</th>
        <th>Excluir</th>
        <th>Editar</th>
        
    </tr>

    <?php foreach($produtos as $produto): ?> <!--Para cada produto encontrado no banco crie uma linha da tabela-->

    <tr>
        <td>
        <img
            src="../assets/uploads_produtos/<?= $produto['produto_imagem']; ?>"
            width="80">
        </td>
        <td><?= $produto['id_produto']; ?></td>
        <td><?= $produto['produto_nome']; ?></td>
        <td>R$ <?= $produto['produto_valor']; ?></td>
        <td><?= $produto['produto_tamanho']; ?></td>
        <td><?= $produto['produto_quantidade']; ?></td>
        <td>
        <a href="excluir_produto.php?id=<?= $produto['id_produto']; ?>">
            Excluir
        </a>
        <td>
        <a href="editar_produto.php?id=<?= $produto['id_produto']; ?>">
            Editar
        </a>
        </td>
        </td>
    </tr>
   

    <?php endforeach; ?>

</table>

</body>
</html>
