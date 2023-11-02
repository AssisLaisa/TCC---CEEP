<?php
include_once('conexao.php');

$pdo = conectar();

$id = $_GET['id'];

$sqlc = "SELECT * FROM tb_cidades WHERE cod_cidade = :id"; // Change the table name to tb_cidades
$stmc = $pdo->prepare($sqlc);
$stmc->bindParam(':id', $id);
$stmc->execute();

if ($stmc->rowCount() > 0) {
    $sqlex = "DELETE FROM tb_cidades WHERE cod_cidade = :cod_cidade"; // Change the table name to tb_cidades
    $stmex = $pdo->prepare($sqlex);
    $stmex->bindParam(':cod_cidade', $id); // Change the parameter name to cod_cidade
    if ($stmex->execute()) {
        echo "Cidade excluída com sucesso!";
    } else {
        echo "Erro ao excluir cidade.";
    }
} else {
    echo "Cidade não encontrada!";
}

header('Location: concidade.php'); // Change the location to the appropriate page for managing cities
exit(); // Make sure to use exit() to avoid further code execution after redirection.
?>