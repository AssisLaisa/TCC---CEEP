<?php
//session_start();
include_once "conexao.php";

$pdo = conectar();

function removeSpecialChars($str) {
    // Remove todos os caracteres não numéricos (exceto números)
    $cleanedStr = preg_replace('/[^0-9]/', '', $str);
    return $cleanedStr;
}

// cidades
$sqlc = "SELECT * FROM tb_cidades";
$stmtc = $pdo->prepare($sqlc);
$stmtc->execute();
$dados = $stmtc->fetchAll(PDO::FETCH_ASSOC);    

?>
<!DOCTYPE html>
<html lang="ptBR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Clientes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery.mask.js"></script>
    <script type="text/javascript" src="js/mask.js"></script>
    <link rel="stylesheet" href="css/csscadastro.css"></script>
</head>

<body>
<div class="container" >
          <a class="links" id="cadastro.php"></a>
          <a class="links" id="login.php"></a>

    <h1>Cadastro</h1>
    <form method="POST">
        <label>Nome</label>
        <input type="text" name="nome" placeholder="Informe o nome.">
        <br>
        <label>Email</label>
        <input type="text" name="email" placeholder="Informe o e-mail.">
        <br>
        <label>Telefone</label>
        <input type="text" id="cel_cli" name="cel_cli" required class="sp_celphones" placeholder="Informe o telefone.">
        <br>
        <label>CPF</label>
        <input type="text" id="cpf" name="cpf"  class="cpf" placeholder="Informe o CPF.">
        <br>
        <label>Senha</label>
        <input type="password" name="senha" placeholder="Informe a senha.">
        <br>
        <label>Cidade</label>
        <select name="cidade">
            <option>Selecione</option>
            <?php foreach ($dados as $d) {
                echo "<option value='{$d['cod_cidade']}'>{$d['nome_cid']}</option>";
            }
            ?>
        </select>
    
        <br>

        <input type="submit" name="btnSalvar" value="Salvar">
        <input type="hidden" name="tp" value="x">
        
        <p class="link">  
                  Já tem conta?
                  <a href="login.php"> Ir para Login </a>
                </p>
    </form>
    <script>
        function removeSpecialChars(inputId) {
            var inputElement = document.getElementById(inputId);
            inputElement.value = inputElement.value.replace(/\D/g, ''); // Remove todos os caracteres não numéricos
        }
    </script>
    
</body>

</html>
<?php
if (isset($_POST['btnSalvar'])) {
    $nome = $_POST['nome'];
    $tipo = $_POST['tp'];
    $email = $_POST['email'];
    $telefone = $_POST['cel_cli'];
    $telefoneLimpo = removeSpecialChars($telefone);
    $cpf = $_POST['cpf'];
    $cpfLimpo = removeSpecialChars($cpf);
    $senha = md5($_POST['senha']);
    $cidade = $_POST['cidade'];

    if (empty($_POST['nome']) && empty($_POST['email']) && empty($telefoneLimpo) && empty($cpfLimpo) && empty($_POST['senha'])) {
        echo "Preencha todos os campos";
        exit();
    }

    $sql = "INSERT INTO tb_clientes (nome_cli, cel_cli, cpf_cli, senha, email, cod_cidade) VALUES (:nome, :cel_cli, :cpf, :senha, :email, :cidade)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':cel_cli', $telefoneLimpo);
    $stmt->bindParam(':cpf', $cpfLimpo);
    $stmt->bindParam(':senha', $senha);
    $stmt->bindParam(':cidade', $cidade);

    if ($stmt->execute()) {
        echo "Cliente cadastrado com sucesso!";
        header("Location: index.php");
    } else {
        echo "Erro ao cadastrar o cliente";
    }
}
?>
