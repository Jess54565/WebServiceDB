<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");


include_once("config.php");
require_once("verifica.php");
$conexao = db_connect();  

if (!$conexao) {
    echo "Erro: Não foi possível conectar ao banco de dados.";
    exit;
}

$query = "SELECT id_user, nome_user, email_user FROM usuario";
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
    <title>Lista de Usuários</title>
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
<h2 class="text-center mb-4"><?php echo $lng['listaUsuarios'];?></h2>
    <div class="btn-new">
        <button onclick="location.href='cadastro.php'"><?php echo $lng['novoUsuario'];?></button>
    </div>
    <div class="container mt-5">
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col"><?php echo $lng['codigoUsuario'];?></th>
                    <th scope="col"><?php echo $lng['nomeUsuario'];?></th>
                    <th scope="col"><?php echo $lng['emailUsuario'];?></th>
                    <th scope="col"><?php echo $lng['alterar'];?></th>
                    <th scope="col"><?php echo $lng['excluir'];?></th>
                </tr>
            </thead>
            <tbody>
                <?php while ($usuario = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($usuario['id_user'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($usuario['nome_user'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($usuario['email_user'] ?? ''); ?></td>
                        <td>
                            <form action="alter-user.php" method="POST" onsubmit="return confirm('Tem certeza que deseja editar este usuário?');">
                                <input type="hidden" name="id_user" value="<?php echo htmlspecialchars($usuario['id_user'] ?? ''); ?>">
                                <button type="submit" class="btn btn-primary">Editar</button>
                            </form>
                        </td>
                        <td>
                            <form action="excluir-user.php" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este usuário?');">
                                <input type="hidden" name="id_user" value="<?php echo htmlspecialchars($usuario['id_user'] ?? ''); ?>">
                                <button type="submit" class="btn btn-danger">Excluir</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php include_once("elemento-design/rodape.php"); ?>

<?php
$conexao = null;
?>
