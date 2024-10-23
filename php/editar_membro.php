<?php
require_once 'db.php'; // Inclui a conexão com o banco de dados
$mensagem = ''; // Variável para armazenar a mensagem de sucesso ou erro
$membro = null; // Inicializa a variável membro como nula para evitar erros
$atualizado = false; // Variável para controlar se o membro foi atualizado

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Consulta para buscar o membro pelo ID
    $stmt = $pdo->prepare("SELECT * FROM membros WHERE id = :id");
    $stmt->bindValue(":id", $id);
    $stmt->execute();
    $membro = $stmt->fetch(PDO::FETCH_ASSOC); // Busca o membro
    
    // Verifica se o membro foi encontrado
    if (!$membro) {
        $mensagem = "Membro não encontrado!";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe os dados do formulário
    $id = $_POST['id'];
    $nome_completo = $_POST['nome_completo'];
    $cargo = $_POST['cargo'];
    $notificacoes_baixas = $_POST['notificacoes_baixas'];
    $notificacoes_medias = $_POST['notificacoes_medias'];
    $notificacoes_altas = $_POST['notificacoes_altas'];
    $advertencias = $_POST['advertencias'];
    $motivo = $_POST['motivo'];

    // Prepara o SQL para atualização
    $sql = "UPDATE membros SET 
                nome_completo = :nome_completo, 
                cargo = :cargo, 
                notificacoes_baixas = :notificacoes_baixas, 
                notificacoes_medias = :notificacoes_medias, 
                notificacoes_altas = :notificacoes_altas, 
                advertencias = :advertencias, 
                motivo = :motivo
            WHERE id = :id";

    $stmt = $pdo->prepare($sql);

    // Bind dos valores às variáveis
    $stmt->bindValue(':nome_completo', $nome_completo);
    $stmt->bindValue(':cargo', $cargo);
    $stmt->bindValue(':notificacoes_baixas', $notificacoes_baixas);
    $stmt->bindValue(':notificacoes_medias', $notificacoes_medias);
    $stmt->bindValue(':notificacoes_altas', $notificacoes_altas);
    $stmt->bindValue(':advertencias', $advertencias);
    $stmt->bindValue(':motivo', $motivo);
    $stmt->bindValue(':id', $id);

    // Executa a consulta e verifica se deu certo
    if ($stmt->execute()) {
        $mensagem = "Membro atualizado com sucesso!"; // Define a mensagem de sucesso
        $atualizado = true; // Define que a atualização foi feita
    } else {
        $mensagem = "Erro ao atualizar membro."; // Define a mensagem de erro
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/editarMembro.css">
    <title>Editar Membro</title>
</head>
<body>
    <?php if ($atualizado): ?>
        <div class="mensagem">
            <?php echo $mensagem; ?>
        </div>
        <br>
        <a href="dashboard.php" class="btn-voltar">Voltar</a>
    <?php else: ?>
        <?php if(!empty($mensagem)): ?>
            <div class="mensagem">
                <?php echo $mensagem; ?>
            </div>
        <?php endif; ?>

        <form action="editar_membro.php" method="POST">
            <div class="editar-container">
                <h2>Editar Membro</h2>

                <?php if ($membro): ?>
                    <!-- Campos do formulário com valores pré-definidos do membro -->
                    <input type="hidden" name="id" value="<?= $membro['id'] ?>">
                    <label for="nome_completo">Nome Completo:</label>
                    <input type="text" name="nome_completo" value="<?= $membro['nome_completo'] ?>" required>

                    <label for="cargo">Cargo:</label>
                    <input type="text" name="cargo" value="<?= $membro['cargo'] ?>" required>

                    <label for="notificacoes_baixas">Notificações Baixas:</label>
                    <input type="number" name="notificacoes_baixas" value="<?= $membro['notificacoes_baixas'] ?>">

                    <label for="notificacoes_medias">Notificações Médias:</label>
                    <input type="number" name="notificacoes_medias" value="<?= $membro['notificacoes_medias'] ?>">

                    <label for="notificacoes_altas">Notificações Altas:</label>
                    <input type="number" name="notificacoes_altas" value="<?= $membro['notificacoes_altas'] ?>">

                    <label for="advertencias">Advertências:</label>
                    <input type="number" name="advertencias" value="<?= $membro['advertencias'] ?>">

                    <label for="motivo">Motivo:</label>
                    <textarea name="motivo"><?= $membro['motivo'] ?></textarea>

                    <input type="submit" value="Atualizar Membro" class="btn-atualizar">
                    <br><br>
                <?php else: ?>
                    <p>Membro não encontrado!</p>
                <?php endif; ?>
            </div>
        </form>
    <?php endif; ?>
</body>
</html>
