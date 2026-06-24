<?php

session_start();
require_once 'conexao.php';

if(!isset($_SESSION['login'])){
    exit;
}

$busca = trim($_GET['busca'] ?? '');

if(empty($busca)){
    exit;
}

$sql = $pdo->prepare("
    SELECT p.*
    FROM favoritos f
    INNER JOIN produto p
        ON p.id_produto = f.id_produto
    WHERE f.id_cliente = ?
    AND p.produto_nome LIKE ?
");

$sql->execute([
    $_SESSION['login'],
    "%$busca%"
]);

$favoritos = $sql->fetchAll();

foreach($favoritos as $produto){
    ?>
    
    <div class="resultado-item">
        <?= htmlspecialchars($produto['produto_nome']); ?>
    </div>

    <?php
}

?>