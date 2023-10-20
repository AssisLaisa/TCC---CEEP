<?php
include_once "conexao.php";
$pdo = conectar();

// Clientes
$sqlClientes = "SELECT * FROM tb_clientes";
$stmtClientes = $pdo->prepare($sqlClientes);
$stmtClientes->execute();
$clientes = $stmtClientes->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="ptBR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Pedidos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery.mask.js"></script>
    <script type="text/javascript" src="js/mask.js"></script>
    <link rel="stylesheet" href="css/cssadms.css"></script>
</head>

<body>
<div class="container">
    <h2>Cadastro de Pedido</h2>
    <form method="POST">
        <div class="form-group">
            <label>Data do Pedido</label>
            <input type="date" name="data_ped" required>
        </div>
        <div class="form-group">
            <label>Cliente</label>
            <select name="cod_cli" required>
                <option value="">Selecione</option>
                <?php
                foreach ($clientes as $cliente) {
                    echo "<option value='{$cliente['cod_cli']}'>{$cliente['nome_cli']}</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label>Método de Pagamento</label>
            <select name="tipo_pagamento" required>
                <option value="1">Pix</option>
                <option value="2">Dinheiro</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success" name="btnSalvar">Salvar</button>
        <a href="conpedido.php" class="btn btn-dark">voltar</a>
    </form>
</div>
</body>

</html>
<?php
if (isset($_POST['btnSalvar'])) {
    // Receber os valores do formulário
    $data_ped = $_POST['data_ped'];
    $cod_cli = $_POST['cod_cli'];
    $tipo_pagamento = $_POST['tipo_pagamento'];

    // Valide os dados conforme suas necessidades

    // SQL que faz a inserção dos dados na tabela de pedidos
    $sql = "INSERT INTO tb_pedidos (data_ped, tipo_pagamento, cod_cli) VALUES (:data_ped, :tipo_pagamento, :cod_cli)";
    // Preparar e executar a consulta SQL
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':data_ped', $data_ped);
    $stmt->bindParam(':tipo_pagamento', $tipo_pagamento);
    $stmt->bindParam(':cod_cli', $cod_cli);

    // Executar a consulta SQL
    if ($stmt->execute()) {
        echo "Pedido cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar o pedido";
    }
}
?>
