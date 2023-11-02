<?php
//session_start();
require_once 'conexao.php'; // Inclua o arquivo de conexão com o banco de dados aqui

$db = $pdo;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $senha = md5($_POST['senha']);

    $stmt = $db->prepare("SELECT * FROM tb_clientes WHERE email = :email AND senha = :senha");
    $stmt->execute([':email' => $email, ':senha' => $senha]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
        $_SESSION['cod_cli'] = $usuario['cod_cli'];
        $_SESSION['email'] = $usuario['email'];

        if ($usuario['tipo_cadastro'] === 'A') {
            // Se o tipo de cadastro for 'A' (administrador), redirecione para a área de administração
            header("Location: admindex.php");
            exit();
        } else {
            // Senão, redirecione para a área dos clientes
            header("Location: index.php");
            exit();
        }

    }else {
        echo "<p>Usuário ou senha inválidos. Tente novamente.</p>";
    };
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    
    <link rel="stylesheet" href="css/csscadastro.css"></script>
</head>
<body>
    <div class="container">
        <a class="links" id="cadastro.php"></a>
        <a class="links" id="login.php"></a>

        <div class="content">
            <div id="login">
                <form method="post" action="">   
                    <h1>Login</h1>
                    <p>
                        <label for="email">Seu e-mail</label>
                        <input id="email" name="email" required="required" type="email" placeholder="e-mail" />
                    </p>
                    <p>
                        <label for="senha">Sua senha</label>
                        <input id="senha" name="senha" required="required" type="password" placeholder="senha" />
                    </p>

                    <p>
                        <input type="checkbox" name="continuar" id="continuar" value="" />
                        <label for="continuar">Continuar logado</label>
                    </p>

                    <p>
                        <input type="submit" name="btnLogin" value="Logar" />
                    </p>

                    <p class="link">
                        <a href="cadastro.php">Ainda não tem conta? Cadastre-se</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>