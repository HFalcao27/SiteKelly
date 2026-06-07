<?php

require_once 'conexao.php';

if (isset($_POST['nome'])){

//Aqui vai pegar os dados dos formularios

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $data_de_nascimento = $_POST['data_de_nascimento'];
    $telefone = $_POST['telefone'];
    $cpf = $_POST['cpf'];
    $endereco = $_POST['endereco'];
    $cep = $_POST['cep'];
    $senha = $_POST['senha'];

    $sql = $pdo-> prepare("INSERT INTO clientes (nome, email, data_de_nascimento, telefone, cpf, endereco, cep, senha) VALUES (?,?,?,?,?,?,?,?)");

    $sql-> execute([$nome, $email, $data_de_nascimento, $telefone, $cpf, $endereco, $cep, $senha]);

    header("Location: ../index.php");
    exit;
}

?>