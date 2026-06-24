<?php

session_start();

if(!isset($_SESSION['login_adm'])){

    header('Location: login_adm.php');
    exit;
}

?>

<?php

require_once '../backend/conexao.php';

$id = $_GET['id'];

$sql = $pdo->prepare("SELECT * FROM produto WHERE id_produto = ?");

$sql->execute([$id]);

$produto = $sql->fetch();

/*Ficar atento com relação a isso se vai funcionar para salvar */

$sqlCarrossel = $pdo->prepare("
    SELECT id_carrossel
    FROM produto_carrossel
    WHERE id_produto = ?
");

$sqlCarrossel->execute([$id]);

$carrosseisSelecionados =
    $sqlCarrossel->fetchAll(PDO::FETCH_COLUMN);

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
       <title>Editar Produtos</title>
       <meta charset="UTF-8">
       <meta charset="UTF-8">
       <meta http-equiv="X-UA-Compatible" content="IE=edge">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <link rel="stylesheet" href="../styles/style.css">
</head>

       <body class="body_cadastrar_produto">
              <h3 class="cadastrar_produto_paragraph">Editar Produtos</h3>
       <form method="POST" action="../backend/atualizarProduto.php">

       <input type="hidden"
              name="id_produto"
              value="<?= $produto['id_produto']; ?>">

       <div class="cadastrar_produto_1">
       <label>Nome:</label>
       <input type="text"
              name="produto_nome"
              value="<?= $produto['produto_nome']; ?>">

       <br><br>

       <label>Valor:</label>
       <input type="number"
              step="0.01"
              name="produto_valor"
              value="<?= $produto['produto_valor']; ?>">

       <br><br>
       </div>

       <div class="cadastrar_produto_1">
       <label>Tamanho:</label>
       <input type="text"
              name="produto_tamanho"
              value="<?= $produto['produto_tamanho']; ?>">

       <br><br>

       <label>Quantidade:</label>
       <input type="number"
              name="produto_quantidade"
              value="<?= $produto['produto_quantidade']; ?>">

       <br><br>
       </div>

       <div class="cadastrar_produto_1">
       <label>Cor:</label>
       <input type="text"
              name="produto_cor"
              value="<?= $produto['produto_cor']; ?>">

       <br><br>

       <label>Descrição</label>
       <textarea name="produto_descricao"><?= $produto['produto_descricao']; ?></textarea>

       <br><br>
       </div>

       <div class="cadastrar_produto_1">
       <label>Categoria:</label>
       <input type="text"
              name="produto_categoria"
              value="<?= $produto['produto_categoria']; ?>">

       <br><br>

       <label>Exibir em:</label><br> <!--Isso aqui está vinculado com categoria para poder saber em qual carrossel vai aparecer-->

        <input type="checkbox" name="carrossel[]" value="1" <?= in_array(1,$carrosseisSelecionados) ? 'checked' : ''; ?> >
        Lançamentos

        <br>

        <input type="checkbox" name="carrossel[]" value="2" <?= in_array(2,$carrosseisSelecionados) ? 'checked' : ''; ?>>
        Promoções

        <br>

        <input type="checkbox" name="carrossel[]" value="3"  <?= in_array(3,$carrosseisSelecionados) ? 'checked' : ''; ?>>
        Destaques

        <br><br>

       </div>

       <button class="cadastrar_produto_2"
       type="submit">
       Salvar Alterações
       </button>

       </form>
       </body>
</html>