<?php
//session_start();
include_once("conexao.php");

$pdo = conectar();
session_destroy();

header("Location: index.php"); 
exit();
?>