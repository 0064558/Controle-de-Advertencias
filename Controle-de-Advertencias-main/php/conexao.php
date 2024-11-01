<?php
$conn = new mysqli('localhost', 'root', '0091', 'testedb');
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>