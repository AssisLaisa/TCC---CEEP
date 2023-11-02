<?php
include_once('conexao.php');

$pdo = conectar();

$id = $_GET['id'];

$sql = "SELECT * FROM tb_cidades WHERE cod_cidade = :id"; // Change the table name to tb_cidades

$stmc = $pdo->prepare($sql);
$stmc->bindParam(':id', $id);
$stmc->execute();

$re = $stmc->fetch(PDO::FETCH_OBJ);

/*
COMO USAR:
FETCH_ASSOC = $re['idcategoria']
FETCH_OBJ = $re->idcategoria
*/
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Alteração de Cidades</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.js"></script>
    <script src="js/jquery.js"></script>
    <link rel="stylesheet" href="css/cssadms.css"></script>
</head>

<body>
    <h2>Alteração de Cidades</h2>
    <form method="POST">
        <div class="form-group">
        <label>Nome da Cidade</label>
            <input type="text" name="nome_cid" value="<?php echo $re->nome_cid; ?>">
        </div>
            <label>Nome do Estado</label>
            <input type="text" name="nome_estado" value="<?php echo $re->nome_estado; ?>">
        </div>
        <button type="submit" class="btn btn-success" name="btnAlterar">Alterar</button>
        <a href="concidade.php" class="btn btn-dark">voltar</a>
    </form>
</body>

</html>
<?php
// Teste se o botão foi pressionado
if (isset($_POST['btnAlterar'])) {

    // Pego o valor do input (alterado ou não)
    $nome_cid_e = $_POST['nome_cid'];
    $nome_estado_e = $_POST['nome_estado'];

    // Verifico se tem conteúdo
    if (empty($nome_cid_e)) {
        echo "Necessário informar o nome da cidade";
        exit();
    }

    if (empty($nome_estado_e)) {
        echo "Necessário informar o nome do estado";
        exit();
    }

    // Crio o SQL de alteração
    $sqlup = "UPDATE tb_cidades SET nome_cid = :nome_cid, nome_estado = :nome_estado 
    WHERE cod_cidade = :cod_cidade";

    // Preparo o SQL
    $stmup = $pdo->prepare($sqlup);

    // Troco os parâmetros :nome_cid, :nome_estado e :cod_cidade
    $stmup->bindParam(':nome_cid', $nome_cid_e);
    $stmup->bindParam(':nome_estado', $nome_estado_e);
    $stmup->bindParam(':cod_cidade', $id);

    // Executo o SQL
    if ($stmup->execute()) {
        echo "Alterado com sucesso!";
        header("Location: concidade.php");
    } else {
        echo "Erro ao alterar!";
    }
}
?>