<?php
include_once('conexao.php');

$pdo = conectar();

// Query to retrieve data from the "tb_cidades" table
$sql = "SELECT * FROM tb_cidades";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$resultado = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Listagem de Cidades</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
</head>

<body>
    <h2>
        <center>Listagem de Cidades</center>
    </h2>
    <table class="table table-striped table-bordered">
        <a href="inccidade.php" class="btn btn-primary">Incluir Cidade</a>
        <tr class="table-dark">
            <th>Cod</th>
            <th>Nome da Cidade</th>
            <th>Nome do Estado</th>
        </tr>
        <?php foreach ($resultado as $r) { ?>
            <tr>
                <td><?php echo $r['cod_cidade']; ?></td>
                <td><?php echo $r['nome_cid']; ?></td>
                <td><?php echo $r['nome_estado']; ?></td>
                <td>
                    <a href="altcidade.php?id=<?php echo $r['cod_cidade']; ?>" class="btn btn-dark">ALTERAR</a> - 
                    <a href="exccidade.php?id=<?php echo $r['cod_cidade']; ?>" class="btn btn-danger">EXCLUIR</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>

</html>
