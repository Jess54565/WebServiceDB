<?php
ob_start();

include_once("config.php");

$conexao = db_connect();

try {
    if (isset($_POST['cod_prod']) && !empty($_POST['cod_prod'])) {
        $cod_prod = $_POST['cod_prod'];

        $sql = "UPDATE produto SET status_prod = FALSE WHERE cod_prod = :cod";
        $comando = $conexao->prepare($sql);
        $comando->bindParam(':cod', $cod_prod, PDO::PARAM_INT);

        $comando->execute();

        $updatedRows = $comando->rowCount();

        if ($updatedRows > 0) {
            header("Location: estoque.php?mensagem=Produto inativado com sucesso!");
        } else {
            header("Location: estoque.php?mensagem=Produto não encontrado ou já inativado!");
        }
    } else {
        header("Location: estoque.php?mensagem=Código do produto não fornecido!");
    }
} catch (PDOException $e) {
    header("Location: estoque.php?mensagem=Erro ao inativar produto: " . urlencode($e->getMessage()));
    exit;
}

$conexao = null;

ob_end_flush();
?>