<?php

session_start();
require_once 'conexao.php';


if (!isset($_SESSION['login'])) {
    header('Location: ../login.php');
    exit;
}

$idCliente = $_SESSION['login'];

try {

    $pdo->beginTransaction();

    // ===============================
    // RECEBENDO OS DADOS DO FORMULÁRIO
    // ===============================

    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $telefone = trim($_POST['telefone']);
    $cpf = trim($_POST['cpf']);
    $cep = trim($_POST['cep']);
    $endereco = trim($_POST['endereco']);
    $numero = trim($_POST['numero']);
    $bairro = trim($_POST['bairro']);
    $cidade = trim($_POST['cidade']);
    $pagamento = $_POST['pagamento'];

    // ===============================
    // ATUALIZAR CADASTRO
    // ===============================

    $sql = $pdo->prepare("
        UPDATE clientes
        SET
            nome = ?,
            email = ?,
            telefone = ?,
            cpf = ?,
            cep = ?,
            endereco = ?,
            numero = ?,
            bairro = ?,
            cidade = ?
        WHERE id = ?
    ");

    $sql->execute([
        $nome,
        $email,
        $telefone,
        $cpf,
        $cep,
        $endereco,
        $numero,
        $bairro,
        $cidade,
        $idCliente
    ]);

    // ===============================
    // BUSCAR CARRINHO
    // ===============================

    $sql = $pdo->prepare("
        SELECT
            c.id_produto,
            c.quantidade,
            p.produto_nome,
            p.produto_valor,
            p.produto_quantidade
        FROM carrinho c
        INNER JOIN produto p
            ON p.id_produto = c.id_produto
        WHERE c.id_cliente = ?
    ");

    $sql->execute([$idCliente]);

    $carrinho = $sql->fetchAll(PDO::FETCH_ASSOC);

    // ===============================
    // CARRINHO VAZIO
    // ===============================

    if (count($carrinho) == 0) {

        $pdo->rollBack();

        header("Location: ../carrinho.php");
        exit;
    }

    // ===============================
    // CALCULAR TOTAL
    // ===============================

    $total = 0;

    foreach ($carrinho as $produto) {

        $total +=
            $produto['produto_valor']
            * $produto['quantidade'];

    }

    // ===============================
    // VERIFICAR ESTOQUE
    // ===============================

    foreach ($carrinho as $produto) {

        if ($produto['quantidade'] > $produto['produto_quantidade']) {
            throw new Exception(
                "O produto '{$produto['produto_nome']}' não possui estoque suficiente."
            );
        }
    }

    // ===============================
    // CRIAR PEDIDO
    // ===============================

    $sql = $pdo->prepare("
        INSERT INTO pedidos
        (
            id_cliente,
            valor_total,
            status_pedido,
            forma_pagamento,
            observacao
        )
        VALUES
        (?, ?, ?, ?, ?)
    ");

    $sql->execute([
        $idCliente,
        $total,
        'Aguardando Pagamento',
        $pagamento,
        $_POST['observacao'] ?? null
    ]);

    $idPedido = $pdo->lastInsertId();

    // ===============================
    // GERAR NÚMERO DO PEDIDO
    // ===============================

    $numeroPedido = 'KM'
        . date('Y')
        . str_pad($idPedido, 5, '0', STR_PAD_LEFT);

    $sql = $pdo->prepare("
        UPDATE pedidos
        SET numero_pedido = ?
        WHERE id_pedido = ?
    ");

    $sql->execute([
        $numeroPedido,
        $idPedido
    ]);

    // ===============================
    // SALVAR ITENS DO PEDIDO
    // ===============================



    //isso aqui vai para itens_peidos

    $sql = $pdo->prepare("
        INSERT INTO itens_pedido
        (
            id_pedido,
            id_produto,
            quantidade,
            preco_unitario
        )
        VALUES
        (?, ?, ?, ?)
    ");

    foreach ($carrinho as $produto) {

        $sql->execute([
            $idPedido,
            $produto['id_produto'],
            $produto['quantidade'],
            $produto['produto_valor']
        ]);

    }

    // ===============================
    // DIMINUIR ESTOQUE
    // ===============================

    $sql = $pdo->prepare("
        UPDATE produto
        SET produto_quantidade = produto_quantidade - ?
        WHERE id_produto = ?
    ");

    foreach ($carrinho as $produto) {

        $sql->execute([
            $produto['quantidade'],
            $produto['id_produto']
        ]);      
}

/*Esse update é seguro por conta disso if ($produto['quantidade'] > $produto['produto_quantidade']) {
    throw new Exception(...); */


    // ===============================
    // LIMPAR CARRINHO
    // ===============================

    $sql = $pdo->prepare("
        DELETE FROM carrinho
        WHERE id_cliente = ?
    ");

    $sql->execute([
        $idCliente
    ]);    

 
    // ===============================
    // FINALIZAR TRANSAÇÃO
    // ===============================

       /* Isso aqui foi trocado por aquele outro lá em baixo
    $pdo->commit();

    echo "Pedido criado com sucesso!<br>";
    echo "ID: " . $idPedido . "<br>";
    echo "Número: " . $numeroPedido;
    */

    $pdo->commit();

    header("Location: ../pedido_realizado.php?pedido=$numeroPedido");
    exit;

    } catch (Exception $e) {

        if ($pdo->inTransaction()) {
            $pdo->rollBack();
        }

        die($e->getMessage());

    }

?>