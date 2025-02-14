<?php
    session_start();

    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
        $tempo_limite = 360; // 6 minutos

        if (isset($_SESSION['TEMPO'])) {
            $tempo_desde_o_ultimo_carregamento = time() - $_SESSION['TEMPO'];
            $_SESSION['VER'] = $tempo_desde_o_ultimo_carregamento;
            if ($tempo_desde_o_ultimo_carregamento > $tempo_limite) {
                $_SESSION['logged_in'] = false;

                header('location: desconectar.php');
                die();
            } else {
                
                $_SESSION['TEMPO'] = time();
            }
        } else {
            $_SESSION['logged_in'] = false;

            header('location: desconectar.php');
            die();
        }
    } else {
        header('location: desconectar.php');
        die();
    }
?>
