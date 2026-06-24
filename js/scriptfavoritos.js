const frases = document.getElementById('frases');

const textos = [ //Foi criado um array com os textos 0,1
    "Frete Grátis a partir de R$350,00",
    "Continue Comprando Para Ganhar Descontos",
    "Não perca tempo, garanta os seus descontos"
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

//Coração de favoritos

document.addEventListener('DOMContentLoaded', () => {
    const hearts = document.querySelectorAll('.heart-icon');

    hearts.forEach(heart => {
      heart.addEventListener('click', () => {

            const idProduto =
            heart.dataset.produto;

            fetch('./backend/toggle_favoritos.php', {
              method: 'POST',
                headers: {
                    'Content-Type':
                    'application/x-www-form-urlencoded'
                },
               body:
                'id_produto=' + idProduto
            })

          .then(response => response.text())
          .then(() => {
                heart.classList.toggle('favorited');

            });
        });
    });
});

//Remover dos favoritos

document.querySelectorAll('.buton__favoritos__excluir')
.forEach(botao => {

    botao.addEventListener('click', () => {

        const idProduto = botao.dataset.produto;

        fetch('./backend/removerFavorito.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `id_produto=${idProduto}`
        })
        .then(() => {
            location.reload();
        });

    });

});

//Sobre pesquisa

const input = document.getElementById('searchInput');

input.addEventListener('keyup', () => {

    let busca = input.value;

    fetch(`backend/pesquisarfavorito.php?busca=${busca}`)
        .then(response => response.text())
        .then(resultado => {

            document.getElementById('resultadoPesquisa').innerHTML = resultado;

        });

});

document.addEventListener('keydown', (e) => { // digitar algo as coisas começar a aparecer

    if(e.key === 'Escape'){
        document.getElementById('resultadoPesquisa').innerHTML = '';
        input.value = '';
    }

});

document.addEventListener('click', (e) => { //quando apagar tudo os resultados somem

    if(!e.target.closest('.container__search-wrapper')){
        document.getElementById('resultadoPesquisa').innerHTML = '';
    }

});

input.addEventListener('keyup', () => { //Serve para quando clicar em qualquer lugar a pesquisa acabar

    let busca = input.value.trim();

    if(busca === ''){
        document.getElementById('resultadoPesquisa').innerHTML = '';
        return;
    }

    fetch(`backend/pesquisarfavorito.php?busca=${encodeURIComponent(busca)}`)
        .then(response => response.text())
        .then(resultado => {
            document.getElementById('resultadoPesquisa').innerHTML = resultado;
        });

});


//Para adiconar ao carrinho

document.querySelectorAll('.buton__favoritos')
.forEach(botao => {

    botao.addEventListener('click', () => {

        const idProduto = botao.dataset.produto;

        fetch('./backend/adicionar_carrinho.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `id_produto=${idProduto}`
        })
        .then(response => response.text())
        .then(retorno => {

            if(retorno === 'adicionado'){

                botao.innerHTML =
                    'Adicionado ao Carrinho ✅';

            }

            if(retorno === 'removido'){

                botao.innerHTML =
                    'Adicionar ao Carrinho 🛒';

            }

        });

    });

});