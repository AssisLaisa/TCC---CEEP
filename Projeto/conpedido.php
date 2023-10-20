<?php
//session_start();
include_once("conexao.php");

$pdo = conectar();

$sql = "SELECT * FROM tb_pedidos";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$resultado = $stmt->fetchAll();

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Listagem de Pedidos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.js"></script>
    <script src="js/jquery.js"></script>
</head>

<body>
    <h2 class="text-center">Listagem de Pedidos</h2>
    <a href="incpedido.php" class="btn btn-primary">Incluir pedido</a>
    <br><table class="table table-striped table-bordered">
        <tr class="table-dark">
        <tr>
            <th>Código</th>
            <th>Código cliente</th>
            <th>Data pedido</th>
            <th>Tipo Pagamento</th>
        </tr>
        <?php foreach ($resultado as $r) { ?>
            <tr>
                <td><?php echo $r['cod_ped']; ?></td>
                <td><?php echo $r['cod_cli']; ?></td>
                <td><?php echo $r['data_ped']; ?></td>
                <td><?php echo $r['tipo_pagamento']; ?></td>
               
                <td>
                <td><a href="altpedido.php?id=<?php echo $r['cod_ped'] ?>" class="btn btn-dark">ALTERAR</a> - <a href="excpedido.php?id=<?php echo $r['cod_ped'] ?>" class="btn btn-danger">EXCLUIR</a> </td>
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
