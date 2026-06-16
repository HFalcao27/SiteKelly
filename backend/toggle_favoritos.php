<?php

//Lembrando que estou usando toggle porque a tradução é alternancia. Para poder me abtuar com esse nome.

session_start();
require_once 'conexao.php';

if(!isset($_SESSION['login'])){
    exit;
}

$id_cliente = $_SESSION['login'];
$id_produto = $_POST['id_produto'];

$sql = $pdo->prepare("
    SELECT *
    FROM favoritos
    WHERE id_cliente = ?
    AND id_produto = ?
");

$sql->execute([
    $id_cliente,
    $id_produto
]);

if($sql->rowCount() > 0){

    $delete = $pdo->prepare("
        DELETE FROM favoritos
        WHERE id_cliente = ?
        AND id_produto = ?
    ");

    $delete->execute([
        $id_cliente,
        $id_produto
    ]);

    echo 'removido';

}else{

    $insert = $pdo->prepare("
        INSERT INTO favoritos
        (id_cliente, id_produto)
        VALUES (?, ?)
    ");

    $insert->execute([
        $id_cliente,
        $id_produto
    ]);

    echo 'adicionado';
}

?>