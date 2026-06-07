<?php

require_once 'backend/conexao.php';

$sql = $pdo->prepare("SELECT * FROM clientes");

$sql->execute();

$clientes = $sql->fetchAll();

?>


 <!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
        <title>Cadastro</title>
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
    <a>Frete Grátis a partir de R$350,00</a>
</header>

<body class="">
    <div class="container__Menu">
            <img src="./assets/Logo.jpeg" class="container__Menu__logo" alt="logo">
        <a class="container__Menu__Link" href="index.php">HOME</a>    
        <a class="container__Menu__Link" href="login.php">LOGIN</a> 
    </div>

      <h3 class="div__cadastro__paragraph">Faça Seu Cadastro</h3>
    <div class="div__cadastro"> 

    <form action="backend/salvarClientes.php" method="POST">  

        <div class="div__cadastro">
            <label class="" for="exampleInputEmail1">Nome:</label>
            <input name="nome" type="text">   
        </div>
        <div class="div__cadastro">
            <label for="exampleInputEmail1">email: </label>
            <input name="email" type="email" placeholder="exemplo@.com">   
        </div>
        <div class="div__cadastro">
            <label for="exampleInputEmail1">Data de Nascimento:</label>
            <input name="data_de_nascimento" type="number" placeholder="00/00/0000">  
        </div>
        <div class="div__cadastro">
            <label for="exampleInputEmail1">Telefone: </label>
            <input name="telefone" type="number" placeholder="90000-0000">  
        </div>
        <div class="div__cadastro">
            <label for="exampleInputEmail1">Cpf: </label>
            <input name="cpf" type="number" placeholder="123.456.789-10">  
        </div>

        <div class="div__cadastro">
            <label for="exampleInputEmail1">endereço: </label>
            <input name="endereco" type="text">  
        </div>

        <div class="div__cadastro">
            <label for="exampleInputEmail1">Cep: </label>
            <input name="cep" type="number" placeholder="0000000-000">  
        </div>

        <div class="div__cadastro">
            <label for="exampleInputPassword1">Senha: </label>
            <input name="senha" type="password" id="senhacadastro">
        </div>

        <div class="div__cadastro">
            <label for="exampleInputPassword1">Repita a Senha: </label>
            <input name="repita_senha" type="password" id="repitasenhacadastro">
        </div>
        <div>
            <input type="checkbox" id="mostrarsenha">
            <label for="mostrarsenha" >Mostrar Senhas</label>
        </div>

        <div class="div__cadastro__buttoes">
        <a href="index.php">
            <button class="login_button" type="button">Volta ao Home</button>
        </a>

         <!--Coloca o que aqui. Eu acho que tem que cadastrar e voltar para o login.-->
            <button class="login_button" type="submit">Cadastrar</button>   
        </div>     
    </form>
    </div>
<script src="js/script.js"></script>
</body>

</html>