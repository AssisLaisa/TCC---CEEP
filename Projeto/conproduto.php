<?php
//session_start();
include_once('conexao.php');

$pdo = conectar();

// consulta, traz dados da tabela
$sql = "SELECT * FROM tb_produtos";
$stmt = $pdo->prepare($sql);
$stmt->execute();
// buscando todos as linhas da tabela
$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

// buscando um unico registro
// $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Listagem de Produtos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.js"></script>
    <script src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery.mask.js"></script>
    <script type="text/javascript" src="js/mask.js"></script>
</head>

<body>
    <h2>
        <center>Listagem de Produtos</center>
    </h2>
    <table class="table table-striped table-bordered">
    <a href="incproduto.php" class="btn btn-primary">Incluir Produto</a>
        <tr class="table-dark">
            <th>Código</th>
            <th>Nome</th>
            <th>Preço</th>
            <th>Descrição</th>
            <th>Imagem</th>
            <th>Ativo</th>
            <th>Oferta</th>
            <th>Valor Oferta</th>
        </tr>
        <?php foreach ($resultado as $r) { ?>
            <tr>
                <td><?php echo $r['cod_prod']; ?></td>
                <td><?php echo $r['nome_prod']; ?></td>
                <td><?php echo $r['preco_prod']; ?></td>
                <td><?php echo $r['descricao']; ?></td>
                <td><?php echo $r['imag_prod']; ?></td>
                <td><?php echo $r['ativo']; ?></td>
                <td><?php echo $r['oferta']; ?></td>
                <td><?php echo $r['valor_oferta']; ?></td>

                <td><a href="altproduto.php?id=<?php echo $r['cod_prod'] ?>" class="btn btn-dark">ALTERAR</a> - <a href="excproduto.php?id=<?php echo $r['cod_prod'] ?>" class="btn btn-danger">EXCLUIR</a> </td>
            </tr>

        <?php } ?>
    </table>
</body>

</html>