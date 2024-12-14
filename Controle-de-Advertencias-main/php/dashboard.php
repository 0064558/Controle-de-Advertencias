<?php
require("db.php");

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

// Inicializa as variáveis de filtro
$nome = $_GET['nome'] ?? '';
$cargo = $_GET['cargo'] ?? '';
$notificacoes = $_GET['notificacoes'] ?? '';
$advertencias = $_GET['advertencias'] ?? '';

// Monta a consulta SQL com filtros dinâmicos
$query = "SELECT * FROM membros WHERE 1=1";
if ($nome) {
    $query .= " AND nome_completo LIKE :nome";
}
if ($cargo) {
    $query .= " AND cargo LIKE :cargo";
}
if ($notificacoes) {
    $query .= " AND ($notificacoes)";
}
if ($advertencias) {
    $query .= " AND advertencias >= :advertencias";
}

$stmt = $pdo->prepare($query);
if ($nome) {
    $stmt->bindValue(':nome', "%$nome%");
}
if ($cargo) {
    $stmt->bindValue(':cargo', "%$cargo%");
}
if ($advertencias) {
    $stmt->bindValue(':advertencias', $advertencias);
}
$stmt->execute();

$membros = $stmt->fetchAll(PDO::FETCH_ASSOC);
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

        <form method="GET" class="filter-form">
            <input type="text" name="nome" placeholder="Pesquisar por nome" value="<?php echo htmlspecialchars($nome); ?>">
            <input type="text" name="cargo" placeholder="Pesquisar por cargo" value="<?php echo htmlspecialchars($cargo); ?>">
            <select name="notificacoes">
                <option value="">Todas as Notificações</option>
                <option value="notificacoes_baixas > 0" <?php echo $notificacoes === 'notificacoes_baixas > 0' ? 'selected' : ''; ?>>Baixas</option>
                <option value="notificacoes_medias > 0" <?php echo $notificacoes === 'notificacoes_medias > 0' ? 'selected' : ''; ?>>Médias</option>
                <option value="notificacoes_altas > 0" <?php echo $notificacoes === 'notificacoes_altas > 0' ? 'selected' : ''; ?>>Altas</option>
            </select>
            <select name="advertencias">
                <option value="">Todas as Advertências</option>
                <option value="1" <?php echo $advertencias === '1' ? 'selected' : ''; ?>>1 ou mais</option>
                <option value="3" <?php echo $advertencias === '3' ? 'selected' : ''; ?>>3 ou mais</option>
            </select>
            <button type="submit">Pesquisar</button>
        </form>

        <div class="table-container">
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
                    <?php if (count($membros) > 0): ?>
                        <?php foreach ($membros as $membro): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($membro['nome_completo']); ?></td>
                                <td><?php echo htmlspecialchars($membro['cargo']); ?></td>
                                <td><?php echo htmlspecialchars($membro['notificacoes_baixas']); ?></td>
                                <td><?php echo htmlspecialchars($membro['notificacoes_medias']); ?></td>
                                <td><?php echo htmlspecialchars($membro['notificacoes_altas']); ?></td>
                                <td><?php echo htmlspecialchars($membro['advertencias']); ?></td>
                                <td><?php echo htmlspecialchars($membro['motivo']); ?></td>
                                <td>
                                    <a href="editar_membro.php?id=<?php echo $membro['id']; ?>" class="btn-acoes">Editar</a>
                                    <a href="excluir_membro.php?id=<?php echo $membro['id']; ?>" class="btn-acoes excluir">Excluir</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="8">Nenhum membro encontrado.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="button-container">
            <a href="cadastrar_membro.php" class="btn-cadastrar">Cadastrar Novo Membro</a>
            <?php if ($_SESSION['is_admin']) : ?>
                <a href="cadastrar_usuario.php" class="btn-cadastrar">Cadastrar Usuário</a>
            <?php endif; ?>
            <a href="logout.php" id="btn-logout">Sair</a>
        </div>
    </div>
</body>
</html>
