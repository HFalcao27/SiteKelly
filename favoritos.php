<?php

session_start();
require_once './backend/conexao.php';

if(!isset($_SESSION['login'])){
    header('Location: login.php');
    exit;
}

$sql = $pdo->prepare("
    SELECT p.*
    FROM favoritos f
    INNER JOIN produto p
        ON p.id_produto = f.id_produto
    WHERE f.id_cliente = ?
");

$sql->execute([
    $_SESSION['login']
]);

$favoritos = $sql->fetchAll();

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
        <title>Produtos Favoritos</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&display=swap" rel="stylesheet">    
        <link rel="stylesheet" href="./styles/style.css">
</head>

<header class="cabecalho">
    <div class="cabecalho_frases">
    <span id="frases">Frete Grátis a partir de R$350,00</span>
    </div>
</header>

<body>
    <div class="container__Menu">
            <img src="./assets/Logo.jpeg" class="container__Menu__logo" alt="logo">
    <div class="container__search-wrapper">
        <input type="text" class="container__Menu__search" placeholder="O que você procura?">
        <button class="container__Menu__lupa" type="submit">
            <img src="assets/lupa.png" alt="ícone de buscar">
        </button>
    </div>

    <?php if(isset($_SESSION['nome'])): ?>

        <a class="container__Menu__Link"> Olá, <?= $_SESSION['nome']; ?></a>

    <?php else: ?>

        <a class="container__Menu__Link" href="login.php">Entre ou cadastre-se </a>

    <?php endif; ?>


        <img href="" class="container__Menu__Link__coracao" src="./assets/coracao_favorito.png"></a>
        <img href="" class="container__Menu__Link__sacola" src="./assets/sacola de compras.png"></a>
        <a href="backend/logout.php">
        <img class="container__botaologout" src="./assets/logout.png" alt="icone de logout"></a>
    </div>


    <h1 class="carrosel__titulo">Meus Favoritos</h1>

<?php if(count($favoritos) > 0): ?>

    <?php foreach($favoritos as $produto): ?>

    <div class="">
    <img
        src="./assets/uploads_produtos/<?= $produto['produto_imagem']; ?>"
        width="200">

            <div class=">
                    <h3 class="">
                        <?= $produto['produto_nome']; ?>
                    </h3>
                    <p class="">
                        R$ <?= number_format($produto['produto_valor'], 2, ',', '.'); ?>
                    </p>
                    <p class="">
                        3x de R$
                        <?= number_format($produto['produto_valor'] / 3, 2, ',', '.'); ?>
                    </p>

                    <button
                        class=""
                        data-produto="<?= $produto['id_produto']; ?>">Adicionar ao carrinho
                        &#128722;
                    </button>
            </div>
    </div>

        <hr>

    <?php endforeach; ?>

<?php else: ?>

    <p class="swiper__paragraph">Você ainda não possui favoritos.</p>

<?php endif; ?>

<button>Compra Tudo</button>

<script src="js/scriptindex.js"></script>
</body>

</html>