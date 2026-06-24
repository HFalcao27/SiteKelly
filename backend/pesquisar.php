<?php

require_once './conexao.php';

$busca = $_GET['busca'] ?? '';

$sql = $pdo->prepare("
    SELECT *
    FROM produto
    WHERE produto_nome LIKE ?
    LIMIT 10
");

$sql->execute([
    "%$busca%"
]);

$produtos = $sql->fetchAll();

foreach($produtos as $produto){
?>

<div class="resultado-item">
    <?= $produto['produto_nome']; ?>
</div>

<?php } ?>