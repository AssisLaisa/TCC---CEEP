<?php
//session_start();
include_once("conexao.php");

$pdo = conectar();

$sql = "SELECT * FROM tb_clientes";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$resultado = $stmt->fetchAll();

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Listagem de Clientes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.js"></script>
    <script src="js/jquery.js"></script>
</head>

<body>
    <h2 class="text-center">Listagem de Clientes</h2>
    <a href="inccliente.php" class="btn btn-primary">Incluir Cliente</a>
    <br><table class="table table-striped table-bordered">
        <tr class="table-dark">
        <tr>
            <th>Nome</th>
            <th>Telefone</th>
            <th>CPF</th>
            <th>Tipo</th>
            <th>Ativo</th>
            <th>Email</th>
            <th>Cidade</th>
        </tr>
        <?php foreach ($resultado as $r) { ?>
            <tr>
                <td><?php echo $r['nome_cli']; ?></td>
                <td><?php echo $r['cel_cli']; ?></td>
                <td><?php echo $r['cpf_cli']; ?></td>
                <td><?php echo $r['tipo_cadastro']; ?></td>
                <td><?php echo $r['ativo']; ?></td>
                <td><?php echo $r['email']; ?></td>
                <td><?php echo $r['cod_cidade']; ?></td>
                <td>
                <td><a href="altcliente.php?id=<?php echo $r['cod_cli'] ?>" class="btn btn-dark">ALTERAR</a> - <a href="exccliente.php?id=<?php echo $r['cod_cli'] ?>" class="btn btn-danger">EXCLUIR</a> </td>
                </td>
                </td>
            </tr>
        <?php } ?>
    </table>
    <script>
        function confExclusao() {
            let resposta = confirm('Confirma a exclusão deste cliente?')
            return resposta;
        }
    </script>
</body>