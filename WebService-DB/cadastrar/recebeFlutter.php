<?php
include_once("../config.php");

// Conexão com o banco de dados
$conexao = db_connect();

// Recebe o JSON enviado pelo Flutter e decodifica
$jsonData = file_get_contents("php://input");
$data = json_decode($jsonData, true);

// Verifica se $data é um array antes de continuar
if (is_array($data) && isset($data['email'], $data['senha'], $data['nome'])) {
    // Extrai as variáveis nome, email e senha
    $email = $data['email'];
    $senha = $data['senha']; // Criptografa a senha
    $nome = $data['nome'];

    try {
        // Prepara o comando SQL para inserir os dados no banco
        $sql = "INSERT INTO usuario (email_user, senha_user, nome_user, status_user)
                VALUES (:mail, :senha, :nome, 'A')";
        $comando = $conexao->prepare($sql);

        // Liga os parâmetros ao comando SQL
        $comando->bindParam(':mail', $email);
        $comando->bindParam(':senha', $senha);
        $comando->bindParam(':nome', $nome);

        // Executa o comando
        $comando->execute();

        // Retorna uma mensagem de sucesso em JSON
        echo json_encode(['message' => 'Cadastro realizado com sucesso']);
    } catch (PDOException $e) {
        // Retorna uma mensagem de erro específica do banco de dados em JSON
        echo json_encode(['message' => 'Erro ao cadastrar: ' . $e->getMessage()]);
    }
} else {
    // Retorna uma mensagem de erro se os dados estiverem incompletos
    echo json_encode(['message' => 'Dados incompletos ou inválidos']);
}
?>
