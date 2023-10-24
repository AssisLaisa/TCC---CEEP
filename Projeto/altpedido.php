<?php
include_once "conexao.php";
$pdo = conectar();

// Clientes
$sqlClientes = "SELECT * FROM tb_clientes";
$stmtClientes = $pdo->prepare($sqlClientes);
$stmtClientes->execute();
$clientes = $stmtClientes->fetchAll(PDO::FETCH_ASSOC);

// Obtendo o ID do pedido a ser alterado
$id = $_GET['id'];

// Consulta SQL para obter os dados do pedido
$sqlPedido = "SELECT * FROM tb_pedidos WHERE cod_ped = :id";
$stmtPedido = $pdo->prepare($sqlPedido);
$stmtPedido->bindParam(':id', $id);
$stmtPedido->execute();
$pedido = $stmtPedido->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ptBR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alteração de Pedido</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery.mask.js"></script>
    <script type="text/javascript" src="js/mask.js"></script>
    
</head>

<body>
<div class="container">
    <h1>Alteração de Pedido</h1>
    <form method="POST">
        <input type="hidden" name="cod_ped" value="<?php echo $cod_ped; ?>">
        <div class="form-group">
            <label>Data do Pedido</label>
            <input type="date" name="data_ped" value="<?php echo $pedido['data_ped']; ?>" required>
        </div>
        <div class="form-group">
            <label>Cliente</label>
            <select name="cod_cli" required>
                <option value="">Selecione</option>
                <?php
                foreach ($clientes as $cliente) {
                    $selected = ($cliente['cod_cli'] == $pedido['cod_cli']) ? 'selected' : '';
                    echo "<option value='{$cliente['cod_cli']}' $selected>{$cliente['nome_cli']}</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label>Método de Pagamento</label>
            <select name="tipo_pagamento" required>
                <option value="1" <?php if ($pedido['tipo_pagamento'] == 1) echo 'selected'; ?>>Pix</option>
                <option value="2" <?php if ($pedido['tipo_pagamento'] == 2) echo 'selected'; ?>>Dinheiro</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success" name="btnAlterar">Alterar</button>
        <a href="conpedido.php" class="btn btn-dark">voltar</a>
    </form>
</div>
</body>

</html>
<?php
if (isset($_POST['btnAlterar'])) {
    // Receber os valores do formulário
    $cod_ped = $_POST['cod_ped'];
    $data_ped = $_POST['data_ped'];
    $cod_cli = $_POST['cod_cli'];
    $tipo_pagamento = $_POST['tipo_pagamento'];

    // Valide os dados conforme suas necessidades

    // SQL que faz a atualização dos dados na tabela de pedidos
    $sql = "UPDATE tb_pedidos SET data_ped = :data_ped, tipo_pagamento = :tipo_pagamento, cod_cli = :cod_cli WHERE cod_ped = :cod_ped";
    
    // Preparar e executar a consulta SQL
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':data_ped', $data_ped);
    $stmt->bindParam(':tipo_pagamento', $tipo_pagamento);
    $stmt->bindParam(':cod_cli', $cod_cli);
    $stmt->bindParam(':cod_ped', $id);

    // Executar a consulta SQL
    if ($stmt->execute()) {
        echo "Pedido alterado com sucesso!";
    } else {
        echo "Erro ao alterar o pedido";
    }
}
?>
