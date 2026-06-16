<?php

session_start();
require_once 'conexao.php';

$login = $_POST['login'] ?? '';
$senha = $_POST['senha'] ?? '';

$sql = $pdo->prepare("SELECT * FROM clientes WHERE (email = :login OR telefone= :login) AND senha = :senha");
/* selecione todos os Clientes quando email for login ou telefone for login e senha seja igual senha
Esse login fica no index.php. DEPOIS TENTAR FAZER NA PÁGINA PRINCIPAL SEM PRECISAR IR PARA A PÁGINA DO INDEX.PHP*/


$sql->execute([':login' => $login, ':senha' => $senha]);
/*Execute login quando login for a mesma coisa da variavel. NO CASO LOGIN E SENHA...  */

if ($sql-> rowCount() > 0){  // Verifica se a consulta encontrou algum registro no banco de dados e o rowCount retorna a quantidade de linhas encontradas.
    $dados = $sql -> fetch(); //Depois que encontra e se encontrar ele tranforma em array. O $dados se torna esse lista(array)

   $_SESSION['login'] = $dados['id'];// O id do cliente está logado está em login.
    $_SESSION['nome'] = $dados['nome']; 

    header("Location: ../index.php");
    exit;

} else {
    $_SESSION['erro'] = "Email/Telefone ou senha incorretos";

    header("Location: ../login.php");
} 


?>