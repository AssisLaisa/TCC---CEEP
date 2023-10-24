<?php
//session_start();
include_once('conexao.php');

$pdo = conectar();

$id = $_GET['id'];

$sql = "SELECT * FROM tb_categorias WHERE cod_cat = :id";

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
    <title>Alteração de Categorias</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.js"></script>
    <script src="js/jquery.js"></script>
</head>

<body>
    <h1>Alteração de Categorias</h1>
    <form method="POST">
        <div class="form-group">
        <label>Nome da Categoria</label>
            <input type="text" name="nome_cat" value="<?php echo $re->nome_cat; ?>">
        </div>
            <label>Descrição</label>
            <input type="text" name="descricao" value="<?php echo $re->descricao; ?>">
        </div>
        <button type="submit" class="btn btn-success" name="btnAlterar">Alterar</button>
        <a href="concategoria.php" class="btn btn-dark">voltar</a>
    </form>
</body>

</html>
<?php
// teste se botão foi pressionado
if (isset($_POST['btnAlterar'])) {

    //pego o valor do input (alterado ou não)
    $nome_cat_e = $_POST['nome_cat'];
    $descricao_e = $_POST['descricao'];

    //verifico se tem conteudo
    if (empty($nome_cat_e)) {
        echo "Necessário informar o nome da categoria";
        exit();
    }

    if (empty($descricao_e)) {
        echo "Necessário informar a descricao da categoria";
        exit();
    }

    //crio o sql de alteração
    $sqlup = "UPDATE tb_categorias SET nome_cat = :nome_cat, descricao = :descricao 
    WHERE cod_cat = :cod_cat";

    //preparo do sql
    $stmup = $pdo->prepare($sqlup);

    // troco os parametros :descricao e :id
    $stmup->bindParam(':nome_cat', $nome_cat_e);
    $stmup->bindParam(':descricao', $descricao_e);
    $stmup->bindParam(':cod_cat', $id);

    //executo o sql
    if ($stmup->execute()) {
        echo "Alterado com sucesso!";
        header("Location: concategoria.php");
    } else {
        echo "Erro ao alterar!";
    }
}

?>
