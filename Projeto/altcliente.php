<?php
include_once('conexao.php');

$pdo = conectar();

$id = $_GET['id'];

// Verifica se o cod_cli existe
$sql = "SELECT * FROM tb_clientes WHERE cod_cli = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();
$cod_cli = $stmt->fetch(PDO::FETCH_OBJ);

if (!$cod_cli) {
    die("cod_cli não encontrado.");
}

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome_cli = $_POST['nome_cli'];
    $cel_cli = $_POST['cel_cli'];
    $cpf_cli = $_POST['cpf_cli'];
    $senha = md5($_POST['senha']);
    $email = $_POST['email'];
    $tipo_cadastro = $_POST['tipo_cadastro'];
    $cod_cidade = $_POST['cod_cidade'];

    // Validação dos campos (faça as validações necessárias)

    // SQL para atualizar o cod_cli
    $sql = "UPDATE tb_clientes SET 
        nome_cli = :nome_cli,
        cel_cli = :cel_cli,
        cpf_cli = :cpf_cli,
        senha = :senha,
        email = :email,
        tipo_cadastro = :tipo_cadastro,
        cod_cidade = :cod_cidade
    WHERE cod_cli = :id";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nome_cli', $nome_cli);
    $stmt->bindParam(':cel_cli', $cel_cli);
    $stmt->bindParam(':cpf_cli', $cpf_cli);
    $stmt->bindParam(':senha', $senha);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':tipo_cadastro', $tipo_cadastro);
    $stmt->bindParam(':cod_cidade', $cod_cidade);
    $stmt->bindParam(':id', $id);

    // Executa a atualização
    if ($stmt->execute()) {
        echo "cod_cli atualizado com sucesso!";
        header("Location: concliente.php");
        exit;
    } else {
        echo "Erro ao atualizar o cod_cli.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Alteração de usuario</title>
    <link rel="stylesheet" href="css/cssadms.css"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
</head>

<body>
    <h2>Alteração de úsuario</h2>
    <form method="POST">
    
        <div class="form-group">
            <label>Nome</label>
            <input type="text" name="nome_cli" value="<?php echo $cod_cli->nome_cli; ?>">
        </div>
        <div class="form-group">
            <label>Telefone</label>
            <input type="text" name="cel_cli" value="<?php echo $cod_cli->cel_cli; ?>">
        </div>
        <div class="form-group">
            <label>CPF</label>
            <input type="text" name="cpf_cli" value="<?php echo $cod_cli->cpf_cli; ?>">
        </div>
        <div class="form-group">
            <label>Senha</label>
            <input type="password" name="senha">
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="text" name="email" value="<?php echo $cod_cli->email; ?>">
        </div>
        <div class="form-group">
            <label>Ativo</label>
            <select name="ativo">
                <option value="S" <?php if ($cod_cli->ativo == 'S') echo 'selected'; ?>>Sim</option>
                <option value="N" <?php if ($cod_cli->ativo == 'N') echo 'selected'; ?>>Não</option>
            </select>
        </div>
        <div class="form-group">
            <label>Tipo do cadastro</label>
            <select name="tipo_cadastro">
                <option value="C" <?php if ($cod_cli->tipo_cadastro == 'C') echo 'selected'; ?>>Cliente</option>
                <option value="A" <?php if ($cod_cli->tipo_cadastro == 'A') echo 'selected'; ?>>Admin</option>
            </select>
        </div>
        <div class="form-group">
            <label>Cidade</label>
            <input type="text" name="cod_cidade" value="<?php echo $cod_cli->cod_cidade; ?>">
        </div>
        <button type="submit" class="btn btn-success" name="btnAlterar">Alterar</button>
        <a href="concliente.php" class="btn btn-dark">Voltar</a>
    </form>
</body>

</html>
