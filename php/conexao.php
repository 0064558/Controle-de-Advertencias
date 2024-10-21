<?php
$conn = new mysqli('localhost', 'root', '123456', 'testedb');
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>