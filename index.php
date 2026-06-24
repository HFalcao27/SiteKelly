<?php

session_start();
require_once './backend/conexao.php';

$sql = $pdo->prepare("
    SELECT * 
    FROM produto
    WHERE produto_ativo = 1
");

$sql->execute();

$produtos = $sql->fetchAll();

//Daqui
$destaques = $pdo->prepare("
    SELECT p.*
    FROM produto p
    INNER JOIN produto_carrossel pc
        ON p.id_produto = pc.id_produto
    WHERE p.produto_ativo = 1
    AND pc.id_carrossel = 3
");

$destaques->execute();

$destaques = $destaques->fetchAll();


$promocoes = $pdo->prepare("
    SELECT p.*
    FROM produto p
    INNER JOIN produto_carrossel pc
        ON p.id_produto = pc.id_produto
    WHERE p.produto_ativo = 1
    AND pc.id_carrossel = 2
");

$promocoes->execute();

$promocoes = $promocoes->fetchAll();


$lancamentos = $pdo->prepare("
    SELECT p.*
    FROM produto p
    INNER JOIN produto_carrossel pc
        ON p.id_produto = pc.id_produto
    WHERE p.produto_ativo = 1
    AND pc.id_carrossel = 1
");

$lancamentos->execute();

$lancamentos = $lancamentos->fetchAll(); //Foi até aqui  Ficar de olho

$favoritos = [];

if(isset($_SESSION['login'])){

    $sqlFavoritos = $pdo->prepare("
        SELECT id_produto
        FROM favoritos
        WHERE id_cliente = ?
    ");

    $sqlFavoritos->execute([
        $_SESSION['login']
    ]);

    $favoritos = $sqlFavoritos->fetchAll(PDO::FETCH_COLUMN);
}

$carrinho = []; // começa vazio

if(isset($_SESSION['login'])){

    // aqui buscamos os produtos que estão no carrinho desse usuário
    $sqlCarrinho = $pdo->prepare("
        SELECT id_produto
        FROM carrinho
        WHERE id_cliente = ?
    ");

    $sqlCarrinho->execute([
        $_SESSION['login']
    ]);

    // aqui transformamos em um array simples só com os IDs
    $carrinho = $sqlCarrinho->fetchAll(PDO::FETCH_COLUMN);
}

?>


<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
        <title>Home</title>
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
    <div class="container__Procura">
        <a class="container__Procura__text" href="#destaques">Destaques</a>
        <a class="container__Procura__text" href="#vestidos">Promoções</a>
        <a class="container__Procura__text" href="#conjunto">Lançamentos</a>
         <a class="container__Procura__text" href="#teste">All</a>
    </div>

    <!--Entender que as seções são Carrosseis que pode ser dividido como categoria produto_categoria , vestido,blusa,camisa, calça-->
    <!--E tem também o produto_carrossel que serve para fazer carrosse de destaque, lançamento, promoções...-->

    <section id="destaques" class="carrosel">
        <h2 class="carrosel__titulo">Destaques</h2>
        <div class="swiper">
            <div class="swiper-pagination"></div>
                <div class="swiper-wrapper">
                    <?php foreach($destaques as $produto): ?>
    <div class="swiper-slide">

        <img src="./assets/uploads_produtos/<?= $produto['produto_imagem']; ?>">

        <span class="heart-icon <?= in_array($produto['id_produto'], $favoritos) ? 'favorited' : ''; ?>"
              data-produto="<?= $produto['id_produto']; ?>">
            &#10084;
        </span>

        <p class="swiper__paragraph">
            <?= $produto['produto_nome']; ?>
        </p>

        <p class="swiper__paragraph__valor">
            R$ <?= number_format($produto['produto_valor'], 2, ',', '.'); ?>
        </p>

        <span class="carrinho_de_compras <?= in_array($produto['id_produto'], $carrinho) ? 'ativo' : ''; ?>"
              data-produto="<?= $produto['id_produto']; ?>">
            <?= in_array($produto['id_produto'], $carrinho) ? '🛒✔' : '🛒'; ?>
        </span>

    </div>
<?php endforeach; ?>

                        
                </div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
    </section> 

    <section id="vestidos" class="carrosel">
        <h2 class="carrosel__titulo">Promoções</h2>
        <div class="swiper">
            <div class="swiper-wrapper">
<?php foreach($promocoes as $produto): ?>
    <div class="swiper-slide">

        <img src="./assets/uploads_produtos/<?= $produto['produto_imagem']; ?>">

        <span class="heart-icon <?= in_array($produto['id_produto'], $favoritos) ? 'favorited' : ''; ?>"
              data-produto="<?= $produto['id_produto']; ?>">
            &#10084;
        </span>

        <p class="swiper__paragraph">
            <?= $produto['produto_nome']; ?>
        </p>

        <p class="swiper__paragraph__valor">
            R$ <?= number_format($produto['produto_valor'], 2, ',', '.'); ?>
        </p>

        <span class="carrinho_de_compras <?= in_array($produto['id_produto'], $carrinho) ? 'ativo' : ''; ?>"
              data-produto="<?= $produto['id_produto']; ?>">
            <?= in_array($produto['id_produto'], $carrinho) ? '🛒✔' : '🛒'; ?>
        </span>

    </div>
<?php endforeach; ?>
                
            </div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
        </div>

    </section>

    <section id="conjunto" class="carrosel">
    <h2 class="carrosel__titulo">Lançamentos</h2>

    <div class="swiper">

        <div class="swiper-wrapper">

            <?php foreach($lancamentos as $produto): ?>
                <div class="swiper-slide">

                    <img src="./assets/uploads_produtos/<?= $produto['produto_imagem']; ?>">

                    <span class="heart-icon <?= in_array($produto['id_produto'], $favoritos) ? 'favorited' : ''; ?>"
                          data-produto="<?= $produto['id_produto']; ?>">
                        &#10084;
                    </span>

                    <p class="swiper__paragraph">
                        <?= $produto['produto_nome']; ?>
                    </p>

                    <p class="swiper__paragraph__valor">
                        R$ <?= number_format($produto['produto_valor'], 2, ',', '.'); ?>
                    </p>

                    <span class="carrinho_de_compras <?= in_array($produto['id_produto'], $carrinho) ? 'ativo' : ''; ?>"
                          data-produto="<?= $produto['id_produto']; ?>">
                        <?= in_array($produto['id_produto'], $carrinho) ? '🛒✔' : '🛒'; ?>
                    </span>

                </div>
            <?php endforeach; ?>

        </div>

        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>

    </div>
</section>
    
    <section id="teste" class="carrosel">  <!--Padrão de como vai ser com o bando de dados.-->
        <h2 class="carrosel__titulo">All</h2>

        <div class="swiper">
            <div class="swiper-pagination"></div>

        <div class="swiper-wrapper">

            <?php foreach($produtos as $produto): ?>

                <div class="swiper-slide">

                    <img
                        src="./assets/uploads_produtos/<?= $produto['produto_imagem']; ?>"
                        alt="<?= $produto['produto_nome']; ?>">

                    <span class="heart-icon <?= in_array($produto['id_produto'], $favoritos) ? 'favorited' : ''; ?>" data-produto="<?= $produto['id_produto']; ?>">&#10084;</span>

                    <p class="swiper__paragraph">
                        <?= $produto['produto_nome']; ?>
                    </p>

                    <p class="swiper__paragraph__valor">
                        R$ <?= number_format($produto['produto_valor'], 2, ',', '.'); ?>
                    </p>

                    <p class="swiper__paragraph__dividir">
                        3x de R$
                        <?= number_format($produto['produto_valor'] / 3, 2, ',', '.'); ?>
                    </p>

                    <span class="carrinho_de_compras <?= in_array($produto['id_produto'], $carrinho) ? 'ativo' : ''; ?>" data-produto="<?= $produto['id_produto']; ?>"><?= in_array($produto['id_produto'], $carrinho) ? '🛒✔' : '🛒'; ?></span>

                </div>

            <?php endforeach; ?>

        </div>

            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>

        </div>
    </section>
</body>

<script src="js/scriptindex.js"></script>

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

        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        <script>
            const swiper = new Swiper('.swiper', { 
                        spaceBetween: 2,
                        slidesPerView: 4,
                        pagination: {
                            el: '.swiper-pagination',
                            type: 'bullets',
                        },
                        navigation: {
                            nextEl: '.swiper-button-next',
                            prevEl: '.swiper-button-prev',
                        },
        });
        </script>

</html>