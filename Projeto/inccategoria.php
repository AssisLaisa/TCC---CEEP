<?php
//session_start();
include_once("conexao.php");

$pdo = conectar();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Adicionar Categoria</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="js/bootstrap.js"></script>
    <script src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery.mask.js"></script>
    <script type="text/javascript" src="js/mask.js"></script>
</head>

<body>
    <h2>Cadastro de Categoria</h2>
    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Nome</label>
            <input type="text" name="nome_cat" class="form-control col-6" placeholder="Digite o nome da categoria">
        </div>
        <div class="form-group"> <!-- Abri uma nova div para a descrição -->
            <label>Descrição</label>
            <input type="text" name="descricao" class="form-control col-6" placeholder="Digite a descrição da categoria">
        </div>
        <button type="submit" name="btnSalvar" class="btn btn-primary">Salvar</button>
    </form>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</body>

</html>

<?php
if (isset($_POST['btnSalvar'])) {

    $nome_cat = $_POST['nome_cat'];
    $descricao = $_POST['descricao'];

    if (empty($descricao)) {
        echo "Necessário informar a descrição da categoria";
        exit();
    }
    if (empty($nome_cat)) {
        echo "Necessário informar o nome da categoria";
        exit();
    }

    // Corrigindo as consultas SQL
    $pgsql = "INSERT INTO tb_categorias(nome_cat, descricao) VALUES (:nome_cat, :descricao)";
    
    // Preparando a consulta
    $stmt = $pdo->prepare($pgsql);

    // Vinculando os parâmetros
    $stmt->bindParam(':nome_cat', $nome_cat);
    $stmt->bindParam(':descricao', $descricao);

    if ($stmt->execute()) {
        echo "Categoria inserida com sucesso!";
    } else {
        echo "Erro ao inserir categoria";
    }
}
?>
