<?php

session_start();
require_once 'conexao.php';

$email = $_POST['email'];
$senha = $_POST['senha'];

$sql = $pdo->prepare("
    SELECT *
    FROM usuario_adm
    WHERE email = ?
    AND senha = ?
");

$sql->execute([
    $email,
    $senha
]);

$adm = $sql->fetch();

if($adm){

    $_SESSION['login_adm'] = true;

    header('Location: ../admin/cadastrar_produto.php');
    exit;
}

header('Location: ../admin/login_adm.php');
exit;

?>