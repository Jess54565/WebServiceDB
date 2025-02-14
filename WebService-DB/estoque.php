<?php
include_once("config.php");
require_once("verifica.php");
$conexao = db_connect();  

if (!$conexao) {
    echo "Erro: Não foi possível conectar ao banco de dados.";
    exit;
}

$query = "SELECT cod_prod, nomeProduto, descricao, preco, qntd_estoque, status_prod FROM produto";
$stmt = $conexao->prepare($query);

try {
    $stmt->execute();
} catch (PDOException $e) {
    echo "Erro na execução da query: " . $e->getMessage();
    exit;
}
?>
<?php include_once("elemento-design/cabec.php"); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?php echo $lng['listaEstoque'];?></title>
    <style>
        .btn-new {
            display: flex;
            justify-content: flex-end;
            margin-right: 8%;
        }
        .btn-new button {
            background-color: #4a4a4a;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
        }
        .btn-new button:hover {
            background-color: #5a5a5a;
        }
        .container {
            margin-top: 50px;
        }
        .table-responsive {
            max-height: 500px; /* Ajuste conforme necessário */
            overflow-y: auto;
            margin-top: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            border-radius: 20px;
            overflow: hidden;
        }
        table th, table td {
            border: 1px solid #ddd;
        }
        table th {
            background-color: #343a40;
            color: white;
        }
        table td, table th {
            padding: 10px;
            text-align: center;
        }
    </style>
</head>
<body><br><br>
<h2 class="text-center mb-4"><?php echo $lng['listaEstoque'];?></h2>
<div class="btn-new">
    <button onclick="location.href='cadastro_prod.php'"><?php echo $lng['novoProduto'];?></button>
</div>
<div class="container mt-5">
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col"><?php echo $lng['codigoProduto'];?></th>
                    <th scope="col"><?php echo $lng['nomeProduto'];?></th>
                    <th scope="col"><?php echo $lng['descricao'];?></th>
                    <th scope="col"><?php echo $lng['precoProduto'];?></th>
                    <th scope="col"><?php echo $lng['quantidadeEstoque'];?></th>
                    <th scope="col"><?php echo $lng['alterar'];?></th>
                    <th scope="col"><?php echo $lng['status'];?></th>
                </tr>
            </thead>
            <tbody>
                <?php while ($estoque = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr class="<?php echo $estoque['status_prod'] == true ? 'table-success' : 'table-danger'; ?>">
                        <td><?php echo htmlspecialchars($estoque['cod_prod'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($estoque['nomeproduto'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($estoque['descricao'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars(isset($estoque['preco']) ? number_format($estoque['preco'], 2, ',', '.') : '0,00'); ?></td>
                        <td><?php echo htmlspecialchars($estoque['qntd_estoque'] ?? ''); ?></td>
                        <td>
                            <form action="alter-prod.php" method="POST" onsubmit="return confirm('Tem certeza que deseja editar este produto?');">
                                <input type="hidden" name="cod_prod" value="<?php echo htmlspecialchars($estoque['cod_prod'] ?? ''); ?>">
                                <button type="submit" class="btn btn-primary"><?php echo $lng['editar'];?></button>
                            </form>
                        </td>
                        <td>
                            <?php if ($estoque['status_prod'] == true) { ?>
                                <form action="inativar-prod.php" method="POST" onsubmit="return confirm('Tem certeza que deseja inativar este produto?');">
                                    <input type="hidden" name="cod_prod" value="<?php echo htmlspecialchars($estoque['cod_prod'] ?? ''); ?>">
                                    <button type="submit" class="btn btn-warning"><?php echo $lng['inativar'];?></button>
                                </form>
                            <?php } else { ?>
                                <form action="ativar-prod.php" method="POST" onsubmit="return confirm('Tem certeza que deseja ativar este produto?');">
                                    <input type="hidden" name="cod_prod" value="<?php echo htmlspecialchars($estoque['cod_prod'] ?? ''); ?>">
                                    <button type="submit" class="btn btn-success"><?php echo $lng['ativar'];?></button>
                                </form>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
<?php include_once("elemento-design/rodape.php"); ?>

<?php
$conexao = null;
?>
