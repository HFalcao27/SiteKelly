const mostrarsenhalogin = document.getElementById('mostrarsenhalogin'); //aqui é do checkbox
const senhalogin = document.getElementById('senhalogin'); // Isso aqui é de onde quer mostrar e apagar a senha

mostrarsenhalogin.addEventListener('change', function() {

  let tipologin;
  
  if(this.checked){
    tipologin = 'text';
  }else{
    tipologin = 'password';
  }

  senhalogin.type = tipologin;

});
