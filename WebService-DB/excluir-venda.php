<?php
ob_start();

include_once("config.php");

$conexao = db_connect();

try {
    if (isset($_POST['id_venda']) && !empty($_POST['id_venda'])) {
        $cod_vend = $_POST['id_venda'];

        $sql = "DELETE FROM vendas WHERE id_venda = :cod";
        $comando = $conexao->prepare($sql);
        $comando->bindParam(':cod', $cod_vend, PDO::PARAM_INT);

        $comando->execute();

        $deletedRows = $comando->rowCount();

        if ($deletedRows > 0) {
            header("Location: historico_vendas.php?mensagem=Produto+excluído+com+sucesso!");
        } else {
            header("Location: historico_vendas.php?mensagem=Produto+não+encontrado!");
        }
    } else {
        header("Location: historico_vendas.php?mensagem=Código+do+produto+não+fornecido!");
    }
} catch (PDOException $e) {
    header("Location: historico_vendas.php?mensagem=Erro+ao+excluir+produto:" . urlencode($e->getMessage()));
    exit;
}

$conexao = null;

ob_end_flush();
?>
