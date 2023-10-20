<?php
//session_start();
include_once('conexao.php');

$pdo = conectar();

$id = $_GET['id'];

$sqlc = "SELECT * FROM tb_categorias WHERE cod_cat = :id";
$stmc = $pdo->prepare($sqlc);
$stmc->bindParam(':id', $id);
$stmc->execute();

if ($stmc->rowCount() > 0) {
    $sqlex = "DELETE FROM tb_categorias WHERE cod_cat = :cod_cat";
    $stmex = $pdo->prepare($sqlex);
    $stmex->bindParam(':cod_cat', $id);
    if ($stmex->execute()) {
        echo "Categoria excluída com sucesso!";
    } else {
        echo "Erro ao excluir categoria.";
    }
} else {
    echo "Categoria não encontrada!";
}

header('Location: concategoria.php');
exit(); // Certifique-se de usar exit() para evitar a execução de código adicional após o redirecionamento.
?>
