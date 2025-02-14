<?php
    $data = $_REQUEST;

    include_once("config.php");

    $conexao = db_connect();

    extract($data);
    $email = $edtMail;
    $senha = $edtSenha;
    $status = "A";

    try {
        $sql = "SELECT id_user, nome_user FROM usuario WHERE email_user = :mail AND senha_user = :senha AND status_user = :status";
        $comando = $conexao->prepare($sql);

        $comando->bindParam(':mail', $email);
        $comando->bindParam(':senha', $senha);
        $comando->bindParam(':status', $status);

        $comando->execute();

        if ($comando->rowCount() > 0) {
            $dados = $comando->fetch(PDO::FETCH_OBJ);

            $usuCodigo = $dados->id_user; 
            $usuNome = $dados->nome_user; 

            session_start();
            $_SESSION['logged_in'] = true;
            $_SESSION['id_user'] = $usuCodigo;
            $_SESSION['user_nome'] = $usuNome;
            $_SESSION['TEMPO'] = time();

            header('location: .');
        } else {
            header('location: login_invalido.php?error=Invalid credentials');
        }
    } catch (Exception $e) {
        header('location: login_invalido.php?error=' . urlencode($e->getMessage()));
    }
?>
