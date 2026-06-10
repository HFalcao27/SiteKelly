<?php

session_start();

if(!isset($_SESSION['login_adm'])){

    header('Location: login_adm.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Cadastrar Produto</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
</head>

<body class="body_cadastrar_produto">
    <form method="POST" action="../backend/salvarProduto.php" enctype="multipart/form-data"> <!--esse multipart serve para enviar dados obrigatorio para upload de arquivos-->

    <h3 class="cadastrar_produto_paragraph">Cadastro de produtos</h3>

    <div class="cadastrar_produto_1">
    <label>Nome do Produto:</label><br>
    <input type="text" name="produto_nome" required><!--required é campo obrigatorio-->
    <br><br>

    <label>Tamanho:</label><br>
    <input type="text" name="produto_tamanho" required>
    <br><br>
    </div>

    <div class="cadastrar_produto_1">
    <label>Quantidade:</label><br>
    <input type="number" name="produto_quantidade" required>
    <br><br>

    <label>Cor:</label><br>
    <input type="text" name="produto_cor" required>
    <br><br>
    </div>

    <div class="cadastrar_produto_1">
    <label>Valor:</label><br>
    <input type="number" step="0.01" name="produto_valor" required>
    <br><br>

    <label >Descrição:</label><br>
    <textarea name="produto_descricao"></textarea>
    <br><br>
    </div>

    <label>Imagem:</label><br>
    <input type="file" name="produto_imagem">
    <br><br>

    <button class="cadastrar_produto_2" type="submit">
        Cadastrar Produto
    </button>

    <a href="../backend/logout.php">
    <button class="cadastrar_produto_3" >Sair</button>
    </a>

    </form>
</body>
</html>