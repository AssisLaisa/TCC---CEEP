<?php
//session_start();
include_once('conexao.php');

$pdo = conectar();

// consulta, traz dados da tabela
$sql = "SELECT * FROM tb_categorias";
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
    <title>Listagem de Categorias</title>
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
        <center>Listagem de Categorias</center>
    </h2>
    <table class="table table-striped table-bordered">
    <a href="inccategoria.php" class="btn btn-primary">Incluir Categoria</a>
        <tr class="table-dark">
            <th>Cod</th>
            <th>Nome</th>
            <th>Descrição</th>  
        </tr>
        <?php foreach ($resultado as $r) { ?>
            <tr>
                <td><?php echo $r['cod_cat']; ?></td>
                <td><?php echo $r['nome_cat']; ?></td>
                <td><?php echo $r['descricao']; ?></td>

                <td><a href="altcategoria.php?id=<?php echo $r['cod_cat'] ?>" class="btn btn-dark">ALTERAR</a> - <a href="exccategoria.php?id=<?php echo $r['cod_cat'] ?>" class="btn btn-danger">EXCLUIR</a> </td>
            </tr>

        <?php } ?>
    </table>
</body>

</html>/