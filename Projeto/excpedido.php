<?php
//session_start();
include_once("conexao.php");

$pdo = conectar();

$id = $_GET['id'];

$sqlc = "SELECT * FROM tb_pedidos WHERE cod_ped = :id";
$stmex = $pdo->prepare($sqlc);
$stmex->bindValue(":id", $id);
$stmex->execute();

if ($stmex->rowCount() > 0) {
    $sqlex = "DELETE FROM tb_pedidos WHERE cod_ped = :id";
    $stmex = $pdo->prepare($sqlex);
    $stmex->bindValue(":id", $id);
    $stmex->execute();
    echo "Pedido excluído com sucesso!";
} else {
    echo "Pedido não encontrado!";
}

header('Location: conpedido.php');
?>
