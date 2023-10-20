<?php
//session_start();
include_once("conexao.php");

$pdo = conectar();
function removeSpecialChars($str) {
    // Remove todos os caracteres não numéricos (exceto números)
    $cleanedStr = preg_replace('/[^0-9]/', '', $str);
    return $cleanedStr;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Cadastro de Produtos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.js"></script>
    <script src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery.mask.js"></script>
    <script type="text/javascript" src="js/mask.js"></script>
    <link rel="stylesheet" href="css/cssadms.css">
</head>

<body>
    <div class="container">
        <div class="content">
            <div id="cadastro">
                <form method="post" action="" enctype="multipart/form-data">
                    <h1>Cadastro de Produtos</h1>
                    <div class="form-group">
                        <label>Nome</label>
                        <input type="text" name="nome_prod" class="form-control col-6" placeholder="Digite o nome do produto">
                    </div>
                    <div class="form-group">
                        <label>Preço</label>
                        <input type="text" name="preco_prod" class="form-control col-6 money" placeholder="Digite o preço do produto">
                    </div>
                    <div class="form-group">
                        <label>Descrição</label>
                        <input type="text" name="descricao" class="form-control col-6" placeholder="Digite a descrição do produto">
                    </div>
                    <div class="form-group">
                        <label>Ativo</label>
                        <input type="text" name="ativo" class="form-control col-6" placeholder="Digite S/N">
                    </div>
                    <div class="form-group">
                        <label>Oferta</label>
                        <input type="text" name="oferta" class="form-control col-6" placeholder="Digite S/N">
                    </div>
                    <div class="form-group">
                        <label>Valor da Oferta</label>
                        <input type="text" name="valor_oferta" class="form-control col-6 money" placeholder="Digite o valor da oferta">
                    </div>
                    <div class="form-group">
                        <label>Imagem</label>
                        <input type="file" name="imag_prod" class="form-control col-6" accept="image/*" id="imagem">
                    </div>
                    <input type="submit" name="btnSalvar" value="Salvar" class="btn btn-success">
                    <a href="conproduto.php" class="btn btn-dark">voltar</a>
                </form>
            </div>
        </div>
    </div>

    <?php 
    if (isset($_POST['btnSalvar'])) {
        // Receber os valores dos campos do formulário
        $nome_prod = $_POST['nome_prod'];
        $preco_prod = $_POST['preco_prod'];
        $precoLimpo = removeSpecialChars($preco_prod);
        $descricao = $_POST['descricao'];
        $ativo = $_POST['ativo'];
        $oferta = $_POST['oferta'];
        $valor_oferta = $_POST['valor_oferta'];
        $ofertaLimpo = removeSpecialChars($valor_oferta);
    
        // Verifique se uma imagem foi enviada
        if (isset($_FILES['imag_prod']) && $_FILES['imag_prod']['error'] === UPLOAD_ERR_OK) {
            // Diretório para onde você deseja salvar as imagens (certifique-se de que o diretório exista)
            $diretorio = 'C:\xampp\htdocs\Projeto\img';
    
            // Gere um nome de arquivo único baseado na descrição e extensão da imagem
            $extensao = pathinfo($_FILES['imag_prod']['name'], PATHINFO_EXTENSION);
            $nome_arquivo = strtolower(str_replace(" ", "_", $descricao)) . '.' . $extensao;
    
            // Caminho completo para o arquivo
            $caminho_arquivo = $diretorio . '\\' . $nome_arquivo;
    
            // Verifique se o arquivo foi movido com sucesso
            if (move_uploaded_file($_FILES['imag_prod']['tmp_name'], $caminho_arquivo)) {
                // O arquivo foi carregado com sucesso, agora você pode inserir os dados no banco de dados
    
                $sql = "INSERT INTO tb_produtos (nome_prod, preco_prod, descricao, imag_prod, ativo, oferta, valor_oferta) 
                        VALUES (:nome_prod, :preco_prod, :descricao, :imag_prod, :ativo, :oferta, :valor_oferta)";
    
                // Preparando a consulta
                $stmt = $pdo->prepare($sql);
    
                // Vinculando os parâmetros
                $stmt->bindParam(':nome_prod', $nome_prod);
                $stmt->bindParam(':preco_prod', $precoLimpo);
                $stmt->bindParam(':descricao', $descricao);
                $stmt->bindParam(':imag_prod', $nome_arquivo);
                $stmt->bindParam(':ativo', $ativo);
                $stmt->bindParam(':oferta', $oferta);
                $stmt->bindParam(':valor_oferta', $ofertaLimpo);
    
                // Executando a consulta
                if ($stmt->execute()) {
                    echo "Produto inserido com sucesso!";
                } else {
                    echo "Erro ao inserir o produto no banco de dados.";
                }
            } else {
                echo "Erro ao mover o arquivo de imagem.";
            }
        } else {
            echo "Nenhuma imagem enviada.";
        }
    }
    