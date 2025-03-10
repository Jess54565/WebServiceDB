

<?php
include_once("config.php");
require_once("verifica.php");


if (!isset($_POST['cod_prod'])) {
    header('location: estoque.php?mensagem=' . urlencode('Código do produto não fornecido.'));
    exit();
}

$cod_prod = $_POST['cod_prod'];

$conexao = db_connect();

try {
    $sql = "SELECT * FROM produto WHERE cod_prod = :cod";
    $comando = $conexao->prepare($sql);
    $comando->bindParam(':cod', $cod_prod);
    $comando->execute();
    
    $produto = $comando->fetch(PDO::FETCH_ASSOC);
    
    if (!$produto) {
        header('location: estoque.php?mensagem=' . urlencode('Produto não encontrado.'));
        exit();
    }
} catch (PDOException $e) {
    header('location: estoque.php?mensagem=' . urlencode('Erro ao buscar produto: ' . $e->getMessage()));
    exit();
}

include_once("elemento-design/cabec.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Alteração de dados do Produto</title>
</head>
<body> 
    <h2>Alteração de dados do Produto</h2>
    
    <?php
    if (isset($_GET['sucesso']) && $_GET['sucesso'] === 'true') {
        echo '<p style="color: green;">Produto alterado com sucesso!</p>';
    } elseif (isset($_GET['erro'])) {
        echo '<p style="color: red;">Erro ao alterar produto: ' . htmlspecialchars($_GET['erro']) . '</p>';
    }
    ?>
    
    <form action="alterar-produto.php" method="POST">
        <input type="hidden" name="codprod" value="<?php echo htmlspecialchars($cod_prod); ?>">

        <label for="nomeprod">Nome do produto:</label>
        <input type="text" id="nomeprod" name="nomeprod" value="<?php echo htmlspecialchars($produto['nomeproduto']); ?>" required><br><br>
        
        <label for="descprod">Descrição:</label>
        <input type="text" id="descprod" name="descprod" value="<?php echo htmlspecialchars($produto['descricao']); ?>" required><br><br>
        
        <label for="precoprod">Preço do produto:</label>
        <input type="number" id="precoprod" name="precoprod" value="<?php echo htmlspecialchars($produto['preco']); ?>" required><br><br>

        <label for="qntdprod">Quantidade no estoque:</label>
        <input type="number" id="qntdprod" name="qntdprod" value="<?php echo htmlspecialchars($produto['qntd_estoque']); ?>" required><br><br>
        
        <input type="submit" value="Alterar">
    </form>
</body>
</html>
