<?php
require("db.php");
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php"); // Redireciona para o login se não estiver logado
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/dashboard.css">
    <title>Dashboard</title>
</head>
<body>
<div class="dashboard-container">
    <h1>Bem-vindo, <?php echo $_SESSION['usuario']; ?>!</h1>
    <p>Aqui estão as notificações e advertências dos membros.</p>
    
    <!-- Exemplo de Tabela para Exibir os Dados -->
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Cargo</th>
                <th>Notificações Baixas</th>
                <th>Notificações Médias</th>
                <th>Notificações Altas</th>
                <th>Advertências</th>
                <th>Motivo</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Exemplo de consulta para obter os dados do banco
            require_once 'db.php';
            $query = "SELECT * FROM membros";
            $result = $pdo->query($query);
            if ($result->rowCount() > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['nome']}</td>";
                    echo "<td>{$row['cargo']}</td>";
                    echo "<td>{$row['notificacoes_baixas']}</td>";
                    echo "<td>{$row['notificacoes_medias']}</td>";
                    echo "<td>{$row['notificacoes_altas']}</td>";
                    echo "<td>{$row['advertencias']}</td>";
                    echo "<td>{$row['motivo']}</td>";
                    echo "</tr>";
                }
            }
            ?>
        </tbody>
    </table>
    <?php
    if ($result->rowCount() < 1) {
        echo 'tabela está vazia';
    }
    ?>
    <br>
    <a href="logout.php" id="btn-logout">Sair</a> 
</div>
</body>
</html>
