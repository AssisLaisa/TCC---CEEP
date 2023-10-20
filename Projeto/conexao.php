<?php
session_start();

function conectar() {
    $host = "localhost";
    $port = "5432";
    $dbname = "Naturalis";
    $user = "postgres";
    $password = "laisa2005";

    try {
        $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        echo "Erro de conexão: " . $e->getMessage();
        exit();
    }
}

$pdo = conectar();
?>