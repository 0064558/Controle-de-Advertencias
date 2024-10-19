<?php
$servername = "localhost";
$username = "root";
$password = "123456";
$dbname = "testedb";
session_start();
$base = 'http://localhost/teste';

try {
    $pdo = new PDO("mysql:dbname=".$dbname.";host=".$servername, $username, $password);
    echo "Conexão com o banco de dados bem-sucedida! ";
} catch(PDOException $e) {
    echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
}

// Cria a conexão
/*$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}*/
?>