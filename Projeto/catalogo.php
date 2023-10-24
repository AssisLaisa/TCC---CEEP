<?php
//session_start();
include_once("conexao.php");

$pdo = conectar();

$sql = "SELECT * FROM tb_produtos";
$stmt = $pdo->prepare($sql);
$stmt->execute(); // Corrigido o typo de $smt para $stmt
$rprd = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
    <link rel="stylesheet" href="css/catalogo.css"></script>
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

<div class="logoff-button">
<?php if (isset($_SESSION['cod_cli'])) { ?>
        <a href="logout.php">Logoff</a>
    <?php } else { ?>
        
    <?php } ?>

    </div>
    <button type="button" class="btn btn-light"><a href="index.php">Home</a>
        </div>
        
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
    <h1>Catálogo de Produtos</h1>
</li>
</ul>
</nav>
<div class="product-container">
    <h2>Produtos</h2>
    <div class="row">
        <?php
        foreach ($rprd as $produto) : // Corrigido o uso da variável $produto
        ?>
            <div class="col-sm-4">
                <div class="card">
                <img src="img/<?php echo $produto['imag_prod'];?> "alt="Imagem do Produto" width="150px" height="150px">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $produto['nome_prod']; ?></h5>
                        <p class="card-text"><?php echo $produto['descricao']; ?></p>
                        <p class="card-text">Preço: R$<?php echo number_format($produto['preco_prod'], 2, ',', '.'); ?></p>
                        <button type="submit" class="button-comprar">COMPRAR</button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</body>
</html>
