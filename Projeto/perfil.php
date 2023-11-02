<?php
//session_start();
include_once("conexao.php");

$pdo = conectar();

// Verifique se o cliente está autenticado
if (!isset($_SESSION['cod_cli'])) {
    header("Location: login.php"); // Redirecione para a página de login se o cliente não estiver autenticado
    exit();
}

// Recupere o código do cliente a partir da sessão
$cod_cli = $_SESSION['cod_cli'];

// Consulta para obter informações do cliente
$stmt = $pdo->prepare("SELECT * FROM tb_clientes WHERE cod_cli = :cod_cli");
$stmt->bindParam(':cod_cli', $cod_cli);
$stmt->execute();
$cliente = $stmt->fetch(PDO::FETCH_ASSOC);

if ($cliente) {
    // Exiba as informações do cliente
    $nome_cli = $cliente['nome_cli'];
    $email = $cliente['email'];
    $cpf_cli = $cliente['cpf_cli'];
    $cel_cli = $cliente['cel_cli'];
    $cod_cidade = $cliente['cod_cidade'];
} else {
    // Não foi possível encontrar informações do cliente
    echo "Não foi possível encontrar as informações do cliente.";
}
?>

<!DOCTYPE html>
    <html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery.mask.js"></script>
    <script type="text/javascript" src="js/mask.js"></script>
    <link rel="stylesheet" href="css/csshome.css"></script>
</head>

<body>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</body>

<body>
    <header>
        <div class="search-container">
            <img src="img/naturalislogo.png" id="logo">
            <form action="barrapesquisa.php" method="GET" class="search-form">
                <input type="text" name="q" class="search-box" placeholder="O que você busca?">
                <button type="submit" class="search-button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                    </svg>
                </button>
            </form>
            <div>
            <button class="cart-button">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-plus-fill" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5v-.5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0zM8.5 8a.5.5 0 0 0-1 0v1.5H6a.5.5 0 0 0 0 1h1.5V12a.5.5 0 0 0 1 0v-1.5H10a.5.5 0 0 0 0-1H8.5V8z" />
                </svg>
            </button>
            </div>
            <button class="logoff-button">
    <li><a href="logout.php">Logoff</a></li>

</button>
        </div>
    </header>
    <h1>Perfil do Cliente</h1>
    <p>Nome: <?php echo $nome_cli; ?></p>
    <p>Email: <?php echo $email; ?></p>
    <p>CPF: <?php echo $cpf_cli; ?></p>
    <p>Telefone: <?php echo $cel_cli; ?></p>
    <p>Cidade: <?php echo $cod_cidade; ?></p>
</body>
</html>
