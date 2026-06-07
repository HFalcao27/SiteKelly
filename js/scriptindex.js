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