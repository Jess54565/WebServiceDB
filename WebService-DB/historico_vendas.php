<?php
require_once("verifica.php");
include_once("config.php");
$conexao = db_connect();  

if (!$conexao) {
    echo "Erro: Não foi possível conectar ao banco de dados.";
    exit;
}

$query = "SELECT id_venda, nomeProduto, valVenda, codProd, qntdVenda, data_venda FROM vendas";
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
    <title>Lista de Vendas</title>
    <style>
        .table-container {
            display: flex;
            justify-content: center;
            margin-top: 50px;
        }
        .table {
            width: auto;
            border-radius: 20px;
            overflow: hidden;
        }
        .btn svg {
            vertical-align: middle;
        }
        .btn-new {
            display: flex;
            justify-content: flex-end;
            margin-right: 9%;
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
            background-color: #5a5a5a; /* Ligeiro ajuste na cor ao passar o mouse */
        }
        .container {
            margin-top: 50px;
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
<body>
<br><br>
<h2 class="text-center mb-4"><?php echo $lng['historicoVendas'];?></h2>
    <div class="btn-new">
        <button onclick="location.href='vendas.php'"><?php echo $lng['novaVenda'];?></button>
    </div>
    <div class="table-container">
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col"><?php echo $lng['codigoVenda'];?></th>
                    <th scope="col"><?php echo $lng['nomeProduto'];?></th>
                    <th scope="col"><?php echo $lng['valorVenda'];?></th>
                    <th scope="col"><?php echo $lng['codigoProduto'];?></th>
                    <th scope="col"><?php echo $lng['quantidadeVendida'];?></th>
                    <th scope="col"><?php echo $lng['dataVenda'];?></th>
                    <th scope="col"><?php echo $lng['alterar'];?></th>
                    <th scope="col"><?php echo $lng['excluir'];?></th>
                </tr>
            </thead>
            <tbody>
                <?php while ($venda = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($venda['id_venda'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($venda['nomeproduto'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars(isset($venda['valvenda']) ? number_format($venda['valvenda'], 2, ',', '.') : '0,00'); ?></td>
                        <td><?php echo htmlspecialchars($venda['codprod'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($venda['qntdvenda'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($venda['data_venda'] ?? ''); ?></td>
                        <td>
                            <form action="alter-vend.php" method="POST" onsubmit="return confirm('Tem certeza que deseja editar esta venda?');">
                                <input type="hidden" name="id_venda" value="<?php echo htmlspecialchars($venda['id_venda'] ?? ''); ?>">
                                <button type="submit" class="btn btn-primary">
                                <?php echo $lng['editar'];?>
                                </button>
                            </form>
                        </td>
                        <td>
                            <form action="excluir-venda.php" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir esta venda?');">
                                <input type="hidden" name="id_venda" value="<?php echo htmlspecialchars($venda['id_venda'] ?? ''); ?>">
                                <button type="submit" class="btn btn-danger">
                                <?php echo $lng['excluir'];?>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php
$conexao = null;
?>
