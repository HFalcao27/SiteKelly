<?php

require_once 'conexao.php';

/* upload */

$arquivoTemporario = $_FILES['produto_imagem']['tmp_name'];
$nomeArquivo = $_FILES['produto_imagem']['name'];

move_uploaded_file(
    $arquivoTemporario,
    "../assets/uploads_produtos/" . $nomeArquivo
);

/* dados */

$produto_nome = $_POST['produto_nome'];
$produto_valor = $_POST['produto_valor'];
$produto_tamanho = $_POST['produto_tamanho'];
$produto_quantidade = $_POST['produto_quantidade'];
$produto_cor = $_POST['produto_cor'];
$produto_descricao = $_POST['produto_descricao'];
$produto_categoria = $_POST['produto_categoria'];

$produto_imagem = $nomeArquivo;

/* insert */

$sql = $pdo->prepare("
    INSERT INTO produto (
        produto_nome,
        produto_valor,
        produto_tamanho,
        produto_quantidade,
        produto_cor,
        produto_descricao,
        produto_imagem,
        produto_categoria,
        produto_ativo
    ) VALUES (
        ?, ?, ?, ?, ?, ?, ?, ?,?
    )
");

/*$sql->execute([                SE DER CERTO A GENTE APAGA HAHAHAHA
    $produto_nome,
    $produto_valor,
    $produto_tamanho,
    $produto_quantidade,
    $produto_cor,
    $produto_descricao,
    $produto_imagem,
    $produto_categoria,
    1
]);

echo "<h2>Produto cadastrado com sucesso!</h2>";

header("Location: ../admin/cadastrar_produto.php");
exit;

?>*/

$sql->execute([
    $produto_nome,
    $produto_valor,
    $produto_tamanho,
    $produto_quantidade,
    $produto_cor,
    $produto_descricao,
    $produto_imagem,
    $produto_categoria,
    1
]);

$idProduto = $pdo->lastInsertId();

if(isset($_POST['carrossel'])){

    foreach($_POST['carrossel'] as $idCarrossel){

        $sqlCarrossel = $pdo->prepare("
            INSERT INTO produto_carrossel
            (id_produto, id_carrossel)
            VALUES (?, ?)
        ");

        $sqlCarrossel->execute([
            $idProduto,
            $idCarrossel
        ]);
    }
}

header("Location: ../admin/cadastrar_produto.php");
exit;