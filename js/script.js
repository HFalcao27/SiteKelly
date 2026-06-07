const checkbox = document.getElementById('mostrarsenha'); // PARA MOSTAR A SENHA DO CADASTRO
const senhacadastro = document.getElementById('senhacadastro'); // PARA MOSTRAR A SENHA DO CADASTRO
const repitasenhacadastro = document.getElementById('repitasenhacadastro'); // PARA MOSTRAR A SENHA DO CADASTRO

checkbox.addEventListener('change', function() { //addeventlister é usado quando um evento acontece, o evento é change, que no caso é muda o estado de marcado ou desmarcado. CHECKBOX É UM EVENTO, MOSTRARSENHALOGIN É OUTRO EVENTO.

  let tipo;// ficou faltando isso, como tem tipo se não tem declaração... 

  if(this.checked){ //se tiver marcado...
        tipo = 'text'; //...sera texto(vai aparecer)...
    }else{ // se não (marcado no caso)...
        tipo = 'password'; //... será password (oculto)
    }  
  
  /*const tipo = this.checked ? 'text' : 'password';*/ //isso é a mesma coisa do que está escrito na parte de cima.

    senhacadastro.type = tipo; // se senha for 'text' fica visivel
    repitasenhacadastro.type = tipo; //faz exatamente a mesma coisa para o repita a senha e se tranforma em password
});


/*document.addEventListener('DOMContentLoaded', () => {
    const hearts = document.querySelectorAll('.heart-icon');
    
    hearts.forEach(heart => {
      heart.addEventListener('click', () => {
        heart.classList.toggle('favorited');
            });
        });
    });
    
document.addEventListener('DOMContentLoaded', () => {
  const input = document.getElementById('searchInput');
  const produtos = document.querySelectorAll('.swiper-slide');

  input.addEventListener('keypress', (event) => {
    if (event.key === 'Enter') {
      event.preventDefault();

      const termo = input.value.trim().toLowerCase();

      produtos.forEach(produto => {
        const textoProduto = produto.textContent.toLowerCase();
        // Mostra só os que contêm o termo digitado
        if (textoProduto.includes(termo) || termo === '') {
          produto.style.display = 'flex';
        } else {
          produto.style.display = 'none';
        }
      });
    }
  });
});
*/