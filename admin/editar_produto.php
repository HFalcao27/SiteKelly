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

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
       <title>Cadastrar Produto</title>
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

       <button class="cadastrar_produto_2"
              type="submit">
              Salvar Alterações
       </button>

       </form>
       </body>
</html>