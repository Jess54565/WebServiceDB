
<?php 
require_once("verifica.php");
include_once("elemento-design/cabec.php"); 
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?php echo $lng['cadastroPessoasSistema'];?></title>
</head>
<body><br>
    <h2 align="center"><?php echo $lng['cadastroPessoasSistema'];?></h2>
    
    <?php
    if (isset($_GET['sucesso']) && $_GET['sucesso'] === 'true') {
        echo '<p style="color: green;">Usuário cadastrado com sucesso!</p>';
    } elseif (isset($_GET['erro'])) {
        echo '<p style="color: red;">Erro ao cadastrar usuário: ' . htmlspecialchars($_GET['erro']) . '</p>';
    }
    ?>
 <div class="container mt-4">   
    <form action="cadastrar/cadastrar_usuario.php" method="POST" class="form">
    <h5><p id="heading"><?php echo $lng['dadosCadastro'];?></p></h5>
    
    <div class="field">
    <input type="text" id="nome" name="nome" class="input-field" placeholder="<?php echo $lng['nomeUsuario']; ?>" required>
</div>


    <div class="field">
        <input type="email" id="email" name="email" placeholder="<?php echo $lng['email'];?>" class="input-field" required>
    </div>
    <div class="field">
        <input type="password" id="senha" name="senha" placeholder="<?php echo $lng['senha'];?>" class="input-field" required>
    </div>    
        <input class="button1" type="submit" value="<?php echo $lng['cadastrar'];?>">
    </form><br>
</div>
</body>
</html>
<?php include_once("elemento-design/rodape.php"); ?>
