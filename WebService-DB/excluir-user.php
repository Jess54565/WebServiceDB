<?php
ob_start();

include_once("config.php");

$conexao = db_connect();

try {
    if (isset($_POST['id_user']) && !empty($_POST['id_user'])) {
        $cod_vend = $_POST['id_user'];

        $sql = "DELETE FROM usuario WHERE id_user = :cod";
        $comando = $conexao->prepare($sql);
        $comando->bindParam(':cod', $cod_vend, PDO::PARAM_INT);

        $comando->execute();

        $deletedRows = $comando->rowCount();

        if ($deletedRows > 0) {
            header("Location: exibeUsuarios.php?mensagem=usuario+excluído+com+sucesso!");
        } else {
            header("Location: exibeUsuarios.php?mensagem=usuario+não+encontrado!");
        }
    } else {
        header("Location: exibeUsuarios.php?mensagem=Código+do+usuario+não+fornecido!");
    }
} catch (PDOException $e) {
    header("Location: exibeUsuarios.php?mensagem=Erro+ao+excluir+produto:" . urlencode($e->getMessage()));
    exit;
}

$conexao = null;

ob_end_flush();
?>
