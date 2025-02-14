
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


$data = $_REQUEST;

$conexao = db_connect();



extract($data);

try {
    $sql = "INSERT INTO produto (nomeProduto, descricao, preco, cod_prod, qntd_estoque, status_prod)
            VALUES (:nome, :descr, :preco, :cod, :qntd, TRUE)";

    $comando = $conexao->prepare($sql);
    $comando->bindParam(':nome', $nomeprod);
    $comando->bindParam(':descr', $descprod);
    $comando->bindParam(':preco', $precoprod);
    $comando->bindParam(':cod', $codprod);
    $comando->bindParam(':qntd', $qntdprod);

    $comando->execute();

    header('location: ../estoque.php');
    exit();
} catch (PDOException $e) {
    header('location: ../estoque.php?mensagem=' . urlencode($e->getMessage()));
    exit();
}
?>
