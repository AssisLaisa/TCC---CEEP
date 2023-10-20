<?php
//session_start();
include_once("conexao.php");

$pdo = conectar();

$id = $_GET['id'];

$sqlc = "SELECT * FROM tb_clientes WHERE cod_cli = :id";
$stmex = $pdo->prepare($sqlc);
$stmex->bindValue(":id", $id);
$stmex->execute();

if ($stmex->rowCount() > 0) {
    $sqlex = "DELETE FROM tb_clientes WHERE cod_cli = :id";
    $stmex = $pdo->prepare($sqlex);
    $stmex->bindValue(":id", $id);
    $stmex->execute();
    echo "Cliente excluído com sucesso!";
} else {
    echo "Cliente não encontrado!";
}

header('Location: concliente.php');
?>
