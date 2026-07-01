<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once './backend/conexao.php';

$sqlCliente = $pdo->prepare("
    SELECT *
    FROM clientes
    WHERE id = ?
");

$sqlCliente->execute([
    $_SESSION['login']
]);

$cliente = $sqlCliente->fetch();

$sqlCarrinho = $pdo->prepare("
    SELECT
        p.*,
        c.quantidade
    FROM carrinho c
    INNER JOIN produto p
        ON p.id_produto = c.id_produto
    WHERE c.id_cliente = ?
");

$sqlCarrinho->execute([
    $_SESSION['login']
]);

$produtosCarrinho = $sqlCarrinho->fetchAll();

$total = 0;

foreach($produtosCarrinho as $produto){

    $subtotal =
        $produto['produto_valor']
        * $produto['quantidade'];

    $total += $subtotal;
}

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
        <title>Checkout</title>
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


    <main class="checkout">

<form action="backend/finalizar_pedido.php" method="POST">

    <!-- COLUNA ESQUERDA -->
    <div class="checkout__esquerda">

        <h2>Dados para Entrega</h2>

        <div class="checkout__grupo">
            <label>Nome</label>
            <input
                type="text"
                name="nome"
                value="<?= $cliente['nome']; ?>"
                required
            >
        </div>

        <div class="checkout__grupo">
            <label>Email</label>
            <input
                type="email"
                name="email"
                value="<?= $cliente['email']; ?>"
                required
            >
        </div>

        <div class="checkout__grupo">
            <label>Telefone</label>
            <input
                type="text"
                name="telefone"
                value="<?= $cliente['telefone']; ?>"
                required
            >
        </div>

        <div class="checkout__grupo">
            <label>CPF</label>
            <input
                type="text"
                name="cpf"
                value="<?= $cliente['cpf']; ?>"
                required
            >
        </div>

        <div class="checkout__grupo">
            <label>CEP</label>
            <input
                type="text"
                name="cep"
                value="<?= $cliente['cep']; ?>"
                required
            >
        </div>

        <div class="checkout__grupo">
            <label>Endereço</label>
            <input
                type="text"
                name="endereco"
                value="<?= $cliente['endereco']; ?>"
                required
            >
        </div>

        <div class="checkout__grupo">
            <label>Complemento</label>
            <input
                type="text"
                name="complemento"
            >
        </div>

        <div class="checkout__grupo">
            <label>Número</label>
            <input
                type="text"
                name="numero"
                value="<?= $cliente['numero']; ?>"
                required
            >
        </div>

        <div class="checkout__grupo">
            <label>Bairro</label>
            <input
                type="text"
                name="bairro"
                value="<?= $cliente['bairro']; ?>"
                required
            >
        </div>

        <div class="checkout__grupo">
            <label>Cidade</label>
            <input
                type="text"
                name="cidade"
                value="<?= $cliente['cidade']; ?>"
                required
            >
        </div>

        <div class="checkout__grupo">
            <label>Observações do Pedido</label>

            <textarea
                name="observacao"
                rows="4"
                placeholder="Ex.: entregar após as 18h, casa azul, etc."
            ></textarea>
        </div>

    </div>

    <!-- COLUNA DIREITA -->
    <div class="checkout__direita">

        <h2>Forma de Pagamento</h2>

        <div class="checkout__pagamento">

            <label>
                <input type="radio" name="pagamento" value="pix" required>
                PIX
            </label>

            <label>
                <input type="radio" name="pagamento" value="credito">
                Cartão de Crédito
            </label>

            <label>
                <input type="radio" name="pagamento" value="dinheiro">
                Dinheiro
            </label>

        </div>

        <hr>

        <h2>Resumo do Pedido</h2>

        <?php foreach($produtosCarrinho as $produto): ?>

        <div class="checkout__produto">

            <span>
                <?= $produto['produto_nome']; ?>
                (<?= $produto['quantidade']; ?>x)
            </span>

            <span>
                R$
                <?= number_format(
                    $produto['produto_valor'] * $produto['quantidade'],
                    2,
                    ',',
                    '.'
                ); ?>
            </span>

        </div>

        <?php endforeach; ?>

        <hr>

        <div class="checkout__produto">
            <strong>Frete</strong>
            <strong>Grátis</strong>
        </div>

        <div class="checkout__produto">
            <strong>Total</strong>
            <strong>R$ <?= number_format($total,2,',','.'); ?></strong>
        </div>

        <button class="checkout__botao">
            Finalizar Compra
        </button>

    </div>

</form>

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