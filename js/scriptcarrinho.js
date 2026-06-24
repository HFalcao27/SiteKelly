const frases = document.getElementById('frases');

const textos = [ //Foi criado um array com os textos 0,1
    "Frete Grátis a partir de R$350,00",
    "Cadastre-se e aproveite as promoções"
];

let indice = 0; // Esse 0 mostra qual a frase vai começar

setInterval(() => { //executa uma função repetidamente 
    frases.style.opacity = 0; //O style acessa o CSS, o opacity controla a transparencia

    setTimeout(() => {
        indice = (indice + 1) % textos.length;
        frases.textContent = textos[indice]; //Troca o texto que está aparecendo
        frases.style.opacity = 1;
    }, 300); // Fica na tela

}, 3000);// troca a cada 3 segundos

//Aqui é a interação com o carrinho

document.querySelectorAll('.carrinho_de_compras')
.forEach(botao => {

    botao.addEventListener('click', () => {

        const produto = botao.dataset.produto;

        fetch('backend/adicionar_carrinho.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'id_produto=' + produto
        })
        .then(response => response.text())
        .then(data => {

            console.log(data);

            botao.classList.add('ativo');

        });

    });

});

// botão de aumentar e diminuir produto

document.addEventListener('DOMContentLoaded', () => {

    // ➕ AUMENTAR
    document.querySelectorAll('.carrinho__mais').forEach(btn => {
        btn.addEventListener('click', () => {

            const id = btn.dataset.carrinho;

            fetch('backend/aumentar_quantidade.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'id_carrinho=' + id
            })
            .then(() => location.reload());

        });
    });

    // ➖ DIMINUIR
    document.querySelectorAll('.carrinho__menos').forEach(btn => {
        btn.addEventListener('click', () => {

            const id = btn.dataset.carrinho;

            fetch('backend/diminuir_quantidade.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'id_carrinho=' + id
            })
            .then(() => location.reload());

        });
    });

    // ❌ REMOVER
    document.querySelectorAll('.buton__favoritos__excluir').forEach(btn => {
        btn.addEventListener('click', () => {

            const id = btn.dataset.carrinho;

            fetch('backend/remover_carrinho.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'id_carrinho=' + id
            })
            .then(() => location.reload());

        });
    });

});
