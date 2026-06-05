  document.addEventListener('DOMContentLoaded', () => {
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
