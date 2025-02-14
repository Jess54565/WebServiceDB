<?php
require_once("verifica.php");
include_once("elemento-design/cabec.php"); 
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Usuário</title>
</head>
<body><br>
    <h2 align="center"><?php echo $lng['cadastroProdutosSistema'];?></h2>
    
    <?php
    if (isset($_GET['sucesso']) && $_GET['sucesso'] === 'true') {
        echo '<p style="color: green;">Usuário cadastrado com sucesso!</p>';
    } elseif (isset($_GET['erro'])) {
        echo '<p style="color: red;">Erro ao cadastrar usuário: ' . htmlspecialchars($_GET['erro']) . '</p>';
    }
    ?>


<div class="container mt-5">
    <form action="cadastrar/cadastrar_produto.php" method="POST" class="form">

    <h7><p id="heading"><?php echo $lng['infoProdutos'];?></p></h7>
    <div class="field">
      
    <input placeholder="<?php echo $lng['codigoProduto'];?>" class="input-field" type="number" id="codprod" name="codprod" required>
</div>
<div class="field">
        <input placeholder="<?php echo $lng['nomeProduto'];?>" class="input-field" type="text" id="nomeprod" name="nomeprod" required>
</div>
<div class="field">
        <input placeholder="<?php echo $lng['descricao'];?>" class="input-field" type="text" id="descprod" name="descprod" required >
</div>
<div class="field">
        <input placeholder="<?php echo $lng['precoPrroduto'];?>" class="input-field" type="number" id="precoprod" name="precoprod" required>
</div>
<div class="field">
        <input placeholder="<?php echo $lng['quantidadeEstoque'];?>" class="input-field" type="number" id="qntdprod" name="qntdprod" required>
</div><br>
        <input class="button1" type="submit" value="<?php echo $lng['cadastrar'];?>">
    </form>
</div>
</body>
</html>
