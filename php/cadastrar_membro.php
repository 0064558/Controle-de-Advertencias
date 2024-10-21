<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Cadastro de membros</title>
</head>
<body>
<form action="cadastrar_membro.php" method="POST">
    Nome Completo: <input type="text" name="nome_completo" required><br>
    Cargo: <input type="text" name="cargo" required><br>
    Notificações Baixas: <input type="number" name="notificacoes_baixas" value="0"><br>
    Notificações Médias: <input type="number" name="notificacoes_medias" value="0"><br>
    Notificações Altas: <input type="number" name="notificacoes_altas" value="0"><br>
    Advertências: <input type="number" name="advertencias" value="0"><br>
    Motivo: <textarea name="motivo"></textarea><br>
    <input type="submit" value="Cadastrar Membro">
    <br><br>
    <a href="dashboard.php" class="btn-voltar">Voltar</a>
</form>

<?php
require_once 'db.php';
include('conexao.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome_completo = $_POST['nome_completo'];
    $cargo = $_POST['cargo'];
    $notificacoes_baixas = $_POST['notificacoes_baixas'];
    $notificacoes_medias = $_POST['notificacoes_medias'];
    $notificacoes_altas = $_POST['notificacoes_altas'];
    $advertencias = $_POST['advertencias'];
    $motivo = $_POST['motivo'];

    $sql = "INSERT INTO membros (nome_completo, cargo, notificacoes_baixas, notificacoes_medias, notificacoes_altas, advertencias, motivo) 
            VALUES ('$nome_completo', '$cargo', '$notificacoes_baixas', '$notificacoes_medias', '$notificacoes_altas', '$advertencias', '$motivo')";

    if ($pdo->exec($sql)) {
        echo "Membro cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar membro.";
    }
}
?>
</body>
</html>