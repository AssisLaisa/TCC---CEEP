<?php
//session_start();
include_once("conexao.php");

$pdo = conectar();

$stmt = $pdo->query("SELECT * FROM tb_produtos");
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
        </div>
        

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
                <a href="catalogo.php">Tudo</a>
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
        <a href="perfil.php?id=<?php echo $_SESSION['cod_cli']; ?>">Perfil</a>
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
   
    <body>
        <div class="slider-container">
          <div class="slider">
            <div class="slide"><img src="img/imgc1.jpg" alt="Slide 1"></div>
            <div class="slide"><img src="img/imgc1.jpg" alt="Slide 2"></div>
            <div class="slide"><img src="img/imgc1.jpg" alt="Slide 3"></div>
          </div>
          <div class="slider-controls">
            <button class="prev" onclick="prevSlide()"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 16 16">
              <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
            </svg></button>
            <button class="next" onclick="nextSlide()"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
              <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/>
            </svg></button>
          </div>
        </div>
        
      
        <script>
          const slider = document.querySelector('.slider');
          let slideIndex = 0;
      
          function showSlide(index) { 
            slider.style.transform = `translateX(-${index * 100}%)`;
          }
      
          function prevSlide() {
            slideIndex = (slideIndex - 1 + 3) % 3;
            showSlide(slideIndex);
          }
      
          function nextSlide() {
            slideIndex = (slideIndex + 1) % 3;
            showSlide(slideIndex);
          }

          </script>
          
</div>
<footer>
        <div class="container">
            <div class="footer-content">
                </div>
                <div class="footer-info">
                    <h3>Contato</h3>
                    <p>Endereço: Rua das Plantas, 123</p>
                    <p>Telefone: (11) 1234-5678</p>
                    <p>Email: contato@naturalis.com</p>
                </div>
                <div class="footer-social">
                    <h3>Redes Sociais</h3>
                    <ul>
                        <li><a href="#">Facebook</a></li>
                        <li><a href="#">Instagram</a></li>
                        <li><a href="#">Twitter</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>

      </body>


</html>
