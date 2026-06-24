<?php

session_start();
require_once './backend/conexao.php';

if(!isset($_SESSION['login'])){
    header('Location: login.php');
    exit;
}


$sql = $pdo->prepare("
    SELECT
        c.id_carrinho,
        c.quantidade,
        p.*
    FROM carrinho c
    INNER JOIN produto p
        ON p.id_produto = c.id_produto
    WHERE c.id_cliente = ?
");

$sql->execute([
    $_SESSION['login']
]);

$carrinho = $sql->fetchAll();


$total = 0;

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
        <title>Meu Carrinho</title>
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
            <a href="./index.php"><img src="./assets/Logo.jpeg" class="container__Menu__logo" alt="logo"></a>
    <div class="container__search-wrapper">
        <input type="text" id="searchInput" class="container__Menu__search" placeholder="O que você procura?">
        <button class="container__Menu__lupa" type="button"><img src="assets/lupa.png" alt="ícone de buscar"></button>
        <div id="resultadoPesquisa"><!--Os produtos para aparecencerem aqui, esse resultado tem que está dentro da div--></div>
    </div> 

    <?php if(isset($_SESSION['nome'])): ?>

        <a class="container__Menu__Link"> Olá, <?= $_SESSION['nome']; ?></a>

    <?php else: ?>

        <a class="container__Menu__Link" href="login.php">Entre ou cadastre-se </a>

    <?php endif; ?>

        
        <a href="favoritos.php"><img href="" class="container__Menu__Link__coracao" src="./assets/coracao_favorito.png"></a>
        <a><img href="" class="container__Menu__Link__sacola" src="./assets/sacola de compras.png"></a>
        <a href="backend/logout.php">
        <img class="container__botaologout" src="./assets/logout.png" alt="icone de logout"></a>
    </div>

<h1 class="carrosel__titulo">
    Minha Sacola 🛒
</h1>

<?php if(!empty($carrinho)): ?>


<?php foreach($carrinho as $produto): ?>

    <?php
        $subtotal =
            $produto['produto_valor']
            *
            $produto['quantidade'];

        $total += $subtotal;
    ?>

    <div class="lista__favoritos">

        <img
            class="lista__favoritos__photo"
            src="./assets/uploads_produtos/<?= $produto['produto_imagem']; ?>"
            alt="<?= $produto['produto_nome']; ?>"
        >

        <div class="lista__favoritos__detalhes">

            <h3 class="lista__nome">
                <?= $produto['produto_nome']; ?>
            </h3>

            <p class="lista__descricao">
                <?= $produto['produto_descricao']; ?>
            </p>

            <p class="lista__valor">
                R$ <?= number_format($produto['produto_valor'], 2, ',', '.'); ?>
            </p>

            <div class="carrinho__quantidade">

                <button
                    class="carrinho__menos"
                    data-carrinho="<?= $produto['id_carrinho']; ?>">
                    -
                </button>

                <span class="carrinho__numero">
                    <?= $produto['quantidade']; ?>
                </span>

                <button
                    class="carrinho__mais"
                    data-carrinho="<?= $produto['id_carrinho']; ?>">
                    +
                </button>

            </div>

            <p class="carrinho__subtotal">
                Subtotal:
                R$ <?= number_format($subtotal, 2, ',', '.'); ?>
            </p>

            <button
                class="buton__favoritos__excluir"
                data-carrinho="<?= $produto['id_carrinho']; ?>">
                Remover Produto ❌
            </button>
            <a href="checkout.php">
            <button
                class="buton__favoritos"
                data-carrinho="<?= $produto['id_carrinho']; ?>">
                Comprar Produto
            </button></a>
            

        </div>

    </div>

<?php endforeach; ?>

<section class="favoritos__botoes__secundarios__carrinho">

    
       <h2 class="carrinho__valor_total">
        Total: R$ <?= number_format($total, 2, ',', '.'); ?>
    </h2>

    <div class="carrinho__acoes">

        <a href="index.php">
            <button class="favoritos__botoes__secundarios_1">
                Continuar Comprando
            </button>
        </a>

        <a href="checkout.php">
            <button class="favoritos__botoes__secundarios_2">
                Finalizar Compra
            </button>
        </a>

    </div>

</section>

<?php else: ?>

<p class="swiper__paragraph">Sua sacola está vazia.</p>

<?php endif; ?>

<script src="js/scriptcarrinho.js"></script>

</body>

    <footer class="rodape">
        <section class="rodape__grid">
            <div>
                <H5 class="rodape__paragraph">Siga nas Redes Sociais</H5>
                <div>
                <div class="rodape__redesociais">
                <a href="https://www.instagram.com/kellyrfernandess/?hl=pt-br">
                <img class="rodape__logoInsta" src="./assets/footer/instagram.png" alt="logo instagram"></a>
                <a href="https://wa.me/5561994379053" target="_blank">
                <img class="rodape__logowhats" src="./assets/footer/logo whatsapp.png" alt="logo do whatsapp"></a>
                </div>
                </div>
            </div>
        
            <div>
                <h5 class="rodape__paragraph">Formas de pagamento</h5>
                <div class="rodape__formadepagamento">
                    <img class="rodape__elo" src="./assets/formas de pagamento/Elo_card_association_logo_-_black_text.svg.png" alt="logo da elo">
                    <img class="rodape__visa" src="./assets/formas de pagamento/logo-da-visa-bandeira-cartao-e1709061738681.png" alt="logo da visa">
                    <img class="rodape__pix" src="./assets/formas de pagamento/logo-pix-icone-1024.png" alt="logo do pix">
                    <img class="rodape__mastecard" src="./assets/formas de pagamento/master-card.png" alt="logo do maste card">
                </div>
            </div>
        </section>
        <h6 class="rodape__paragraph__hf">Feito Por Hallyson Falcão</h6>
    </footer>
</html>
