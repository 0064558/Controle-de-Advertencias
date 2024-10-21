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
            $query = "SELECT * FROM membros";
            $result = $pdo->query($query);

            if ($result->rowCount() > 0) {
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . (!empty($row['nome_completo']) ? $row['nome_completo'] : 'N/A') . "</td>";
                    echo "<td>" . (!empty($row['cargo']) ? $row['cargo'] : 'N/A') . "</td>";
                    echo "<td>" . (!empty($row['notificacoes_baixas']) ? $row['notificacoes_baixas'] : 'N/A') . "</td>";
                    echo "<td>" . (!empty($row['notificacoes_medias']) ? $row['notificacoes_medias'] : 'N/A') . "</td>";
                    echo "<td>" . (!empty($row['notificacoes_altas']) ? $row['notificacoes_altas'] : 'N/A') . "</td>";
                    echo "<td>" . (!empty($row['advertencias']) ? $row['advertencias'] : 'N/A') . "</td>";
                    echo "<td>" . (!empty($row['motivo']) ? $row['motivo'] : 'N/A') . "</td>";
                    echo "</tr>";
                }
            } else {
                echo '<tr><td colspan="7">Nenhum membro encontrado.</td></tr>';
            }
            ?>
        </tbody>
    </table>
    <br>
    <a href="logout.php" id="btn-logout">Sair</a> 
</div>
</body>
</html>
