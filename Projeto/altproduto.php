<?php
//session_start();
include_once('conexao.php');

$pdo = conectar();

$id = $_GET['id'];

$sql = "SELECT * FROM tb_produtos WHERE cod_prod = :id";

$stmc = $pdo->prepare($sql);
$stmc->bindParam(':id', $id);
$stmc->execute();

$re = $stmc->fetch(PDO::FETCH_OBJ);

/*
COMO USAR:
FETCH_ASSOC = $re['idcategoria']
FETCH_OBJ = $re->idcategoria
*/
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Alteração de Produto</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.js"></script>
    <script src="js/jquery.js"></script>
</head>

<body>
    <header>
    <h1>Alteração de Produto</h1>
    <form method="POST">
        <div class="container">
            <div class="form-group">
                <label>Nome</label>
                <input type="text" name="nome_prod" value="<?php echo $re->nome_prod; ?>">
            </div>
            <div class="form-group">
                <label>Preço</label>
                <input type="text" name="preco_prod" value="<?php echo $re->preco_prod; ?>">
            </div>
            <div class="form-group">
                <label>Descrição</label>
                <input type="text" name="descricao" value="<?php echo $re->descricao; ?>">
            </div>
            <div class="form-group">
                <label>Ativo</label>
                <input type="text" name="ativo" value="<?php echo $re->ativo; ?>">
            </div>
            <div class="form-group">
                <label>Oferta</label>
                <input type="text" name="oferta" value="<?php echo $re->oferta; ?>">
            </div>
            <div class="form-group">
                <label>Valor da Oferta</label>
                <input type="text" name="valor_oferta" value="<?php echo $re->valor_oferta; ?>">
            </div>
            <div class="form-group">
                <label>Imagem</label>
                <input type="file" name="imag_prod" class="form-control col-6" accept="image/*" id="imagem">
            </div>
        </div>
        <button type="submit" class="btn btn-success" name="btnAlterar">Alterar</button>
        <a href="conproduto.php" class="btn btn-dark">voltar</a>
    </form>
    </header>
</body>

</html>
<?php
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
    }
}
// teste se botão foi pressionado

if (isset($_POST['btnAlterar'])) {

    //pego o valor do input (alterado ou não)
    $nome_prod_e = $_POST['nome_prod'];
    $descricao_e = $_POST['descricao'];
    $preco_prod_e = $_POST['preco_prod'];
    $imag_prod_e = $_POST['imag_prod'];
    $ativo_e = $_POST['ativo'];
    $oferta_e = $_POST['oferta'];
    $valor_oferta_e = $_POST['valor_oferta'];

    //verifico se tem conteudo
    if (empty($descricao_e)) {
        echo "Necessário informar a descrição do produto";
        exit();
    }
    if (empty($nome_prod_e)) {
        echo "Necessário informar o nome do produto";
        exit();
    }
    if (empty($preco_prod_e)) {
        echo "Necessário informar o preço do produto";
        exit();
    }
    if (empty($ativo_e)) {
        echo "Necessário informar a atividade do produto";
        exit();
    }
    if (empty($oferta_e)) {
        echo "Necessário informar se o produto está em oferta";
        exit();
    }

    // Crie o SQL de alteração
    $sqlup = "UPDATE tb_produtos SET nome_prod = :nome_prod, descricao = :descricao, preco_prod = :preco_prod, imag_prod = :imag_prod, ativo = :ativo, oferta = :oferta, valor_oferta = :valor_oferta WHERE cod_prod = :cod_prod";

    // Preparo do SQL
    $stmup = $pdo->prepare($sqlup);

    $stmup->bindParam(':nome_prod', $nome_prod_e);
    $stmup->bindParam(':preco_prod', $preco_prod_e);
    $stmup->bindParam(':descricao', $descricao_e);
    $stmup->bindParam(':imag_prod', $nome_arquivo);
    $stmup->bindParam(':ativo', $ativo_e);
    $stmup->bindParam(':oferta', $oferta_e);
    $stmup->bindParam(':valor_oferta', $valor_oferta_e);
    $stmup->bindParam(':cod_prod', $id);

    // Executa o SQL
    if ($stmup->execute()) {
        echo "Alterado com sucesso!";
        header("Location: conproduto.php");
    } else {
        echo "Erro ao alterar!";
    }
}
?>
