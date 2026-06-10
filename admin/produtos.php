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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
</head>

<body class="body_cadastrar_produto">
<h1 class="cadastrar_produto_paragraph">Produtos Cadastrados</h1>

<!--
<div>
<input type="text" class="container__Menu__search" placeholder="QUER ENCONTRAR QUAL PRODUTO?">
<button href="cadastrar_produto.php">Cadastrar Produtos</button>
<button></button>
</div> -->

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
    
        <td class="tabela_produto_cadastrado"><?= $produto['id_produto']; ?></td>
        <td class="tabela_produto_cadastrado"><?= $produto['produto_nome']; ?></td>
        <td class="tabela_produto_cadastrado">R$ <?= $produto['produto_valor']; ?></td>
        <td class="tabela_produto_cadastrado"><?= $produto['produto_tamanho']; ?></td>
        <td class="tabela_produto_cadastrado"><?= $produto['produto_quantidade']; ?></td>

        <td>
        <img
            src="../assets/uploads_produtos/<?= $produto['produto_imagem']; ?>"
            width="80">
        </td>
        <td>
        <a class="tabela_butao_exclui" href="excluir_produto.php?id=<?= $produto['id_produto']; ?>">
            Excluir
        </a>
        </td>
        <td>
        <a class="tabela_butao_editar" href="editar_produto.php?id=<?= $produto['id_produto']; ?>">
            Editar
        </a>
        </td>

        </td>
    </tr>
   

    <?php endforeach; ?>

</table>

</body>
</html>
