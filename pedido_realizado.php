<?php

session_start();
require_once './backend/conexao.php';

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$numeroPedido = $_GET['pedido'] ?? '';

if ($numeroPedido == '') {
    header("Location: index.php");
    exit;
}

$sql = $pdo->prepare("
    SELECT *
    FROM pedidos
    WHERE numero_pedido = ?
    AND id_cliente = ?
");

$sql->execute([
    $numeroPedido,
    $_SESSION['login']
]);

$pedido = $sql->fetch(PDO::FETCH_ASSOC);

if (!$pedido) {
    header("Location: index.php");
    exit;
}
 //Isso aqui tudo garante que isso aqui vai aparecer apenas para o cliente logado!
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
        <title>Pedido Realizado</title>
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
        <a href="carrinho.php"><img href="" class="container__Menu__Link__sacola" src="./assets/sacola de compras.png"></a>
        <a href="backend/logout.php">
        <img class="container__botaologout" src="./assets/logout.png" alt="icone de logout"></a>
    </div>



<main class="pedidoRealizado">

    <div class="pedidoRealizado__card">

        <div class="pedidoRealizado__icone">
            ✅
        </div>

        <h1>Pedido realizado com sucesso!</h1>

        <p>
            Obrigado pela sua compra.
            Recebemos seu pedido com sucesso.
        </p>

        <div class="pedidoRealizado__informacoes">

            <div>
                <strong>Número do Pedido</strong><br>
                <?= $pedido['numero_pedido']; ?>
            </div>

            <div>
                <strong>Status</strong><br>
                <?= $pedido['status_pedido']; ?>
            </div>

            <div>
                <strong>Forma de Pagamento</strong><br>
                <?= ucfirst($pedido['forma_pagamento']); ?>
            </div>

            <div>
                <strong>Total</strong><br>
                R$ <?= number_format($pedido['valor_total'],2,',','.'); ?>
            </div>

        </div>

        <p class="pedidoRealizado__texto">
            Em breve entraremos em contato para dar continuidade ao seu pedido.
        </p>

        <div class="pedidoRealizado__botoes">

            <a href="index.php" class="pedidoRealizado__botao">
                Continuar Comprando
            </a>

        </div>

    </div>

</main>


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

</body>
</html>