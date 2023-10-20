<?php
//session_start();
include_once("conexao.php");

$pdo = conectar();

if (isset($_GET['q'])) {
    $searchTerm = $_GET['q'];
} else {
    $searchTerm = '';
}

// Execute uma consulta SQL para encontrar produtos correspondentes ao termo de pesquisa
$sql = "SELECT * FROM tb_produtos WHERE nome_prod LIKE :searchTerm";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':searchTerm', '%' . $searchTerm . '%');
$stmt->execute();
$resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
    <link rel="stylesheet" href="css/csspesquisa.css"></script>
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
</div>
<button class="logoff-button">
<?php if (isset($_SESSION['cod_cli'])) { ?>
        <a href="logout.php">Logoff</a>
    <?php } else { ?>
        
    <?php } ?>
        
    </button>
        

    </script>
            <script>
        document.querySelector('.search-button').addEventListener('click', function () {
            const searchTerm = document.querySelector('.search-box').value;
            if (searchTerm) {
                // Redirecionar para a página de resultados com o termo de pesquisa
                window.location.href = 'barrapesquisa.php?q=' + encodeURIComponent(searchTerm);
            }
        });

            </script>
    </header>

    <nav>
        <ul>
            <li>
                <button class="button">
                <a href="catalogo.php">Categorias</a>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-grid" viewBox="0 0 16 16">
                        <path d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5v-3zM2.5 2a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zm6.5.5A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zm-7 7A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zm6.5.5A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3z" />
                    </svg>
                </button>
                
            </li>
            <li><a href="#">Alimentos</a></li>
            <li><a href="#">Bebidas</a></li>
            <li><a href="#">Bem-estar</a></li>
            <li><a href="#">Higiene e Beleza</a></li>
            <li><a href="#">Marcas</a></li>
            <li><a href="#">Ofertas</a></li>
            <li><a href="#">Contato</a></li>
            <li>
                
                <button class="button2">
                <?php if (isset($_SESSION['cod_cli'])) { ?>
        <a href="perfil.php?id=<?php echo $_SESSION['cod_cli']; ?>">Meu Perfil</a>
    <?php } else { ?>
        <a href="login.php">Entre ou cadastre-se</a>
    <?php } ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-person-circle" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                    </svg>
                </button>
                </li>
            </ul>
        </nav>
    </header>
   
    <div class="search">
        <h1>Resultados de Pesquisa</h1>
        <p>Exibindo resultados para: <?php echo htmlspecialchars($searchTerm); ?></p>

        <!-- Exibir os resultados aqui -->
        <ul>
            <?php
            // Loop através dos resultados da pesquisa e exiba-os como uma lista
            foreach ($resultados as $resultado) {
                echo "<li>";
                echo "<h3>" . htmlspecialchars($resultado['nome_prod']) . "</h3>";
                echo "<p>" . htmlspecialchars($resultado['descricao']) . "</p>";
                echo '<img src="img/' . htmlspecialchars($resultado['imag_prod']) . '" alt="Imagem do Produto" width="150px" height="150px">';
                echo "<p>Preço: R$" . number_format($resultado['preco_prod'], 2, ',', '.') . "</p>";
                echo "</li>";
            }
            ?>
        </ul>
    </div>
</body>
</html>