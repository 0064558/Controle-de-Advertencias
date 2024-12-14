<?php
$servername = "localhost";
$username = "root";
$password = "123456";
$dbname = "testedb";
session_start(); // Inicia a sessão para controle de login, se necessário
$base = 'http://localhost/teste'; // Define a URL base do projeto

try {
    // Cria a conexão com o banco usando PDO
    $pdo = new PDO("mysql:dbname=".$dbname.";host=".$servername, $username, $password);
} catch(PDOException $e) {
    echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
}

// Define o modo de erro para exceções
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
