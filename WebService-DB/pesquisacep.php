<?php
    require_once("verifica.php");
	include_once("elemento-design/cabec.php");
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head> 
    <meta charset="UTF-8">
    <title><?php echo $lng['titulo']; ?></title>
</head>
<body>
<p>&nbsp;</p>
<form method="post" class="form">
<div class="container mt-4">
<h2 style="text-align: center;"><?php echo $lng['titulo']; ?></h2>

    <label for="cep"><?php echo $lng['digiteCep']; ?>:</label>
    <div class="field">
    <input type="text" name="cep" id="cep" placeholder="00000-000" required class="input-field">
</div><br>
<div style="display: flex; justify-content: center;">
    <button type="submit" style="align;" class="button1"><?php echo $lng['buscar']; ?></button>
</div>
</form>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cep = preg_replace("/[^0-9]/", "", $_POST['cep']);
    $url = "https://viacep.com.br/ws/" . $cep . "/json/";

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($curl);
    curl_close($curl);

    if ($response) {
        $dados = json_decode($response, true);

        // Verifica se o CEP foi encontrado
        if (isset($dados['cep'])) {
            echo "<h3>" . $lng['dadosCep'] . ":</h3>";
            echo "<p><strong>" . $lng['cep'] . ":</strong> " . htmlspecialchars($dados['cep']) . "</p>";
            echo "<p><strong>" . $lng['logradouro'] . ":</strong> " . htmlspecialchars($dados['logradouro']) . "</p>";
            echo "<p><strong>" . $lng['complemento'] . ":</strong> " . htmlspecialchars($dados['complemento']) . "</p>";
            echo "<p><strong>" . $lng['bairro'] . ":</strong> " . htmlspecialchars($dados['bairro']) . "</p>";
            echo "<p><strong>" . $lng['localidade'] . ":</strong> " . htmlspecialchars($dados['localidade']) . "</p>";
            echo "<p><strong>" . $lng['uf'] . ":</strong> " . htmlspecialchars($dados['uf']) . "</p>";
            echo "<p><strong>" . $lng['ibge'] . ":</strong> " . htmlspecialchars($dados['ibge']) . "</p>";
        } else {
            echo "<p>" . $lng['cepNaoEncontrado'] . "</p>";
        }
    } else {
        echo "<p>" . $lng['erroConsultaCep'] . "</p>";
    }
}
?>
</div>

</body>
</html>

<?php
	include_once("elemento-design/rodape.php");
?>
