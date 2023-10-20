<?php
//session_start();
include_once('conexao.php');

$pdo = conectar();

$id = $_GET['id'];

$sqlc = "SELECT * FROM tb_produtos WHERE cod_prod = :id";
$stmc = $pdo->prepare($sqlc);
$stmc->bindParam(':id', $id);
$stmc->execute();

if ($stmc->rowCount() > 0) {
    $sqlex = "DELETE FROM tb_produtos WHERE cod_prod = :cod_prod";
    $stmex = $pdo->prepare($sqlex);
    $stmex->bindParam(':cod_prod', $id);
    if ($stmex->execute()) {
        echo "Produto excluído com sucesso!";
    } else {
        echo "Erro ao excluir produto.";
    }
} else {
    echo "Produto não encontrado!";
}

header('Location: conproduto.php');
exit(); // Certifique-se de usar exit() para evitar a execução de código adicional após o redirecionamento.
?>