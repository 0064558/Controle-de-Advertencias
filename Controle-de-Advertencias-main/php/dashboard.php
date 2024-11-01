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
    <link rel="shortcut icon" href="../Icons/favicon.ico.svg" type="image/x-icon">
    <link rel="stylesheet" href="../css/dashboard.css">
    <title>Dashboard</title>
</head>
<body>
<div class="dashboard-container">
    <h1>Bem-vindo, <?php echo $_SESSION['usuario']; ?>!</h1>
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
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            
            $query = "SELECT * FROM membros";
            $result = $pdo->query($query);

            if ($result->rowCount() > 0) {
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['nome_completo']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['cargo']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['notificacoes_baixas']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['notificacoes_medias']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['notificacoes_altas']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['advertencias']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['motivo']) . "</td>";
                    echo "<td><a href='editar_membro.php?id=" . $row['id'] . "' class='btn-acoes'>Editar</a> | 
                      <a href='excluir_membro.php?id=" . $row['id'] . "' class='btn-acoes excluir'>Excluir</a></td>";
                    echo "</tr>";
                }
            } else {
                echo '<tr><td colspan="8">Nenhum membro encontrado.</td></tr>';
            }
            ?>
        </tbody>
    </table>
    <div class="button-container">
        <a href="cadastrar_membro.php" class="btn-cadastrar">Cadastrar Novo Membro</a>
        <a href="logout.php" id="btn-logout">Sair</a> 
    </div>
</div>
</body>
</html>
