<?php
include_once("../config.php");

$data = $_REQUEST;

$conexao = db_connect();

extract($data);

try {
    // Verifica se o produto existe
    $sqlVerificaProduto = "SELECT * FROM produto WHERE cod_prod = :cod";
    $comandoVerifica = $conexao->prepare($sqlVerificaProduto);
    $comandoVerifica->bindParam(':cod', $codprod);
    $comandoVerifica->execute();

    $produtoEncontrado = $comandoVerifica->fetch();

    if (!$produtoEncontrado) {
        header('location: ../index.php?mensagem=' . urlencode("Código do produto inválido."));
        exit();
    }

    // Verifica se há estoque disponível (opcional)
    $estoqueDisponivel = $produtoEncontrado['qntd_estoque'] >= $qntdvend;

    if (!$estoqueDisponivel) {
        header('location: ../index.php?mensagem=' . urlencode("Estoque insuficiente para a quantidade desejada."));
        exit();
    }

    // Insere a venda no banco de dados
    $sql = "INSERT INTO vendas (nomeProduto, valVenda, codProd, qntdVenda, data_venda)
            VALUES (:nome, :preco, :cod, :qntd, :data_ven)";

    $comando = $conexao->prepare($sql);
    $comando->bindParam(':nome', $nomeprod);
    $comando->bindParam(':preco', $precovend);
    $comando->bindParam(':cod', $codprod);
    $comando->bindParam(':qntd', $qntdvend);
    $comando->bindParam(':data_ven', $dataVend);

    $comando->execute();

    header('location: ../index.php');
    exit();
} catch (PDOException $e) {
    header('location: ../index.php?mensagem=' . urlencode($e->getMessage()));
    exit();
}
?>
