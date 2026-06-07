<?php

require_once 'backend/conexao.php';
session_start();


?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
        <title>Login</title>
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
        <a class="container__Menu__Link" href="cadastrar.php">CADASTRO</a>  
    </div>

    <div class="div_todo">
        <form method="POST" action="backend/autenticar.php">
            <h3 class="div__login">Login</h3>
            <div class="div__cadastro">
            <label class="" for="exampleInputEmail1">Email ou Telefone:</label>
            <input name="login" type="text">   
        </div>
        <div class="div__cadastro">
            <label for="exampleInputEmail1">senha: </label>
            <input name="senha" type="password" id="senhalogin">   
        </div>

        <div>
            <input type="checkbox" id="mostrarsenhalogin">
            <label for="mostrarsenha" >Mostrar Senhas</label>
        </div>

        <div class="div__cadastro__buttoes">
            <button class="login_button" type="submit">Faça seu cadastro</button>            
        <a href="index.php">
            <button class="login_button" type="button">Login</button>
        </a>     
        </div> 
        </form>
    </div>
<script src="js/scriptlogin.js"></script>
</body>

</html>