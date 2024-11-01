<?php
$servername = "localhost";
$username = "root";
$password = "0091";
$dbname = "testedb";
session_start();
$base = 'http://localhost/teste';

try {
    $pdo = new PDO("mysql:dbname=".$dbname.";host=".$servername, $username, $password);
} catch(PDOException $e) {
    echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
}

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


// Cria a conexão
/*$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}*/
?>