<?php
require_once("verifica.php");
include_once("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['nomeprod'], $_POST['descprod'], $_POST['precoprod'], $_POST['qntdprod'], $_POST['codprod'])) {
        $nomeprod = $_POST['nomeprod'];
        $descprod = $_POST['descprod'];
        $precoprod = $_POST['precoprod'];
        $qntdprod = $_POST['qntdprod'];
        $codprod = $_POST['codprod'];

        $conexao = db_connect();

        try {
            $sql = "UPDATE produto SET nomeProduto = :nome, descricao = :descr, preco = :preco, qntd_estoque = :qntd WHERE cod_prod = :cod";
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':nome', $nomeprod);
            $stmt->bindParam(':descr', $descprod);
            $stmt->bindParam(':preco', $precoprod);
            $stmt->bindParam(':qntd', $qntdprod);
            $stmt->bindParam(':cod', $codprod);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                header('location: estoque.php?sucesso=true');
                exit();
            } else {
                header('location: estoque.php?erro=' . urlencode('Nenhuma alteração foi feita.'));
                exit();
            }
        } catch (PDOException $e) {
            header('location: estoque.php?erro=' . urlencode($e->getMessage()));
            exit();
        }
    } else {
        header('location: estoque.php?erro=' . urlencode('Todos os campos devem ser preenchidos.'));
        exit();
    }
} else {
    header('location: estoque.php?erro=' . urlencode('Código do produto não fornecido.'));
    exit();
}
?>
