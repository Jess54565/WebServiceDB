<?php
    require_once("verifica.php");
    include_once("elemento-design/cabec.php"); 
?>

<style>
    .error-container {
        background-color: rgba(255, 0, 0, 0.5); /* Vermelho transparente */
        color: white; /* Texto branco para melhor contraste */
        padding: 20px;
        border-radius: 5px;
        text-align: center;
        margin: 20px auto; /* Centro na horizontal */
        max-width: 600px; /* Largura máxima do contêiner */
    }
    .error-container h2, .error-container h5 {
        margin: 10px 0;
    }
    .btn-container {
        text-align: center;
    }
    .btn-container button {
        background-color: #d9534f; /* Botão vermelho */
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    .btn-container button:hover {
        background-color: #c9302c; /* Cor do botão ao passar o mouse */
    }
</style>

<div class="error-container">
    <h2 class="cor_texto"><?php echo $lng['erroAutentica']; ?></h2>
    <h5 class="corTextoInverso"><?php echo $lng['loginFalhou']; ?></h5>
    <h5 class="corTextoInverso"><?php echo $lng['verifiqueSeusDados']; ?></h5>
    <?php
        if (isset($_GET['error'])) {
            echo '<p>' . htmlspecialchars($_GET['error']) . '</p>';
        }
    ?>
    <form action="login.php" method="post">
        <div class="btn-container">
            <button type="submit"><?php echo $lng['voltarLogin']; ?></button>
        </div>
    </form>
</div>

<?php include_once("elemento-design/rodape.php"); ?>
