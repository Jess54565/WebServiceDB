<?php
// Adicionar cabeçalhos CORS no início do arquivo PHP
header("Access-Control-Allow-Origin: *");  // Permitir qualquer origem
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");  // Permitir GET, POST e OPTIONS
header("Access-Control-Allow-Headers: Content-Type");  // Permitir cabeçalhos Content-Type

// Caso seja uma requisição OPTIONS (preflight), respondemos e não processamos mais nada
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);  // Resposta vazia com status 200
    exit();  // Termina a execução do script
}

include_once("../config.php");

$data = $_POST;

$conexao = db_connect();

extract($data);

try {
    $sql = "INSERT INTO usuario (email_user, senha_user, nome_user, status_user)
            VALUES (:mail, :senha, :nome, 'A')";

    $comando = $conexao->prepare($sql);

    $comando->bindParam(':mail', $email);
    $comando->bindParam(':senha', $senha);
    $comando->bindParam(':nome', $nome);

    $comando->execute();

    header('location: ../login.php');
    exit();
} catch (PDOException $e) {
    header('location: ../login_invalido.php?mensagem=' . urlencode($e->getMessage()));
    exit();
}
?>
