
<?php 
require_once("verifica.php");
include_once("elemento-design/cabec.php"); 
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Registrar Vendas</title>
</head>
<body> 
    <h2 align="center">REGISTRAR VENDAS NO SISTEMA</h2>
    
    <?php
    if (isset($_GET['sucesso']) && $_GET['sucesso'] === 'true') {
        echo '<p style="color: green;">Venda realizada com sucesso!</p>';
    } elseif (isset($_GET['erro'])) {
        echo '<p style="color: red;">Erro ao realizar a venda: ' . htmlspecialchars($_GET['erro']) . '</p>';
    }
    ?>


    <div class="container mt-4"> 
    <form action="cadastrar/cadastrar_venda.php" method="POST" class="form">
    <h5><p id="heading">DADOS DA VENDA</p></h5>
    <div class="field">
        <input type="number" id="codprod" name="codprod" placeholder="CÓDIGO DO PRODUTO" class="input-field" required>
    </div>
        <div class="field">
        <input type="text" id="nomeprod" name="nomeprod" placeholder="NOME DO PRODUTO" class="input-field" required>

</div>
        <div class="field">  
        <input type="number" id="precovend" name="precovend" placeholder="VALOR DA VENDA" class="input-field" required>
</div>

        <div class="field">
        <input type="number" id="qntdvend" name="qntdvend" placeholder="QUANTIDADE VENDIDA" class="input-field" required>

</div>
        <div class="field">
        <input type="date" id="datavend" name="dataVend" placeholder="DATA DA VENDA" class="input-field" required>
</div>

        <input type="submit" value="Registrar Venda" class="button1">
    </form>
</div>   
</body>
</html>
<?php include_once("elemento-design/rodape.php"); ?>
