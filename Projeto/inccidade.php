<?php
include_once("conexao.php");

$pdo = conectar();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Adicionar Cidade</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="js/bootstrap.js"></script>
    <script src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery.mask.js"></script>
    <script type="text/javascript" src="js/mask.js"></script>
</head>

<body>
    <h2>Cadastro de Cidade</h2>
    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Nome da Cidade</label>
            <input type="text" name="nome_cid" class="form-control col-6" placeholder="Digite o nome da cidade">
        </div>
        <div class="form-group">
            <label>Nome do Estado</label>
            <input type="text" name="nome_estado" class="form-control col-6" placeholder="Digite o nome do estado (sigla)">
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

    $nome_cid = $_POST['nome_cid'];
    $nome_estado = $_POST['nome_estado'];

    if (empty($nome_cid)) {
        echo "Necessário informar o nome da cidade";
        exit();
    }

    if (empty($nome_estado)) {
        echo "Necessário informar o nome do estado (sigla)";
        exit();
    }

    // Corrigindo as consultas SQL
    $pgsql = "INSERT INTO tb_cidades(nome_cid, nome_estado) VALUES (:nome_cid, :nome_estado)";
    
    // Preparando a consulta
    $stmt = $pdo->prepare($pgsql);

    // Vinculando os parâmetros
    $stmt->bindParam(':nome_cid', $nome_cid);
    $stmt->bindParam(':nome_estado', $nome_estado);

    if ($stmt->execute()) {
        echo "Cidade inserida com sucesso!";
    } else {
        echo "Erro ao inserir cidade";
    }
}
?>