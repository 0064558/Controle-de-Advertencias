<?php
include 'conexao.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome_completo = $_POST['nome_completo'];
    $cargo = $_POST['cargo'];
    $sql = "INSERT INTO membros (nome_completo, cargo) VALUES ('$nome_completo', '$cargo')";
    if ($conn->query($sql) === TRUE) {
        echo "Membro cadastrado com sucesso!";
    } else {
        echo "Erro: " . $conn->error;
    }
}
?>