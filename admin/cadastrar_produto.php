<?php


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Produto</title>
</head>
<body>
    <form method="POST" action="../backend/salvarProduto.php" enctype="multipart/form-data"> <!--esse multipart serve para enviar dados obrigatorio para upload de arquivos-->

    <h3>Cadastro de protudos</h3>

    <label>Nome do Produto:</label><br>
    <input type="text" name="produto_nome" required><!--required é campo obrigatorio-->
    <br><br>

    <label>Tamanho:</label><br>
    <input type="text" name="produto_tamanho" required>
    <br><br>

    <label>Quantidade:</label><br>
    <input type="number" name="produto_quantidade" required>
    <br><br>

    <label>Cor:</label><br>
    <input type="text" name="produto_cor" required>
    <br><br>

    <label>Valor:</label><br>
    <input type="number" step="0.01" name="produto_valor" required>
    <br><br>

    <label>Descrição:</label><br>
    <textarea name="produto_descricao"></textarea>
    <br><br>

    <label>Imagem:</label><br>
    <input type="file" name="produto_imagem">
    <br><br>

    <button type="submit">
        Cadastrar Produto
    </button>

    </form>
</body>
</html>