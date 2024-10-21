<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Membro</title>
</head>
<body>
    <?php
    require_once 'db.php';
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $stmt = $pdo->prepare("SELECT * FROM membros WHERE id = :id");
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        $membro = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    ?>

    <form action="editar_membro.php" method="POST">
        <input type="hidden" name="id" value="<?= $membro['id'] ?>">
        Nome Completo: <input type="text" name="nome_completo" value="<?= $membro['nome_completo'] ?>" required><br>
        Cargo: <input type="text" name="cargo" value="<?= $membro['cargo'] ?>" required><br>
        Notificações Baixas: <input type="number" name="notificacoes_baixas" value="<?= $membro['notificacoes_baixas'] ?>"><br>
        Notificações Médias: <input type="number" name="notificacoes_medias" value="<?= $membro['notificacoes_medias'] ?>"><br>
        Notificações Altas: <input type="number" name="notificacoes_altas" value="<?= $membro['notificacoes_altas'] ?>"><br>
        Advertências: <input type="number" name="advertencias" value="<?= $membro['advertencias'] ?>"><br>
        Motivo: <textarea name="motivo"><?= $membro['motivo'] ?></textarea><br>
        <input type="submit" value="Atualizar Membro">
        <br><br>
        <a href="dashboard.php" class="btn-voltar">Voltar</a>

        <?php
            require_once 'db.php';

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $id = $_POST['id'];
                $nome_completo = $_POST['nome_completo'];
                $cargo = $_POST['cargo'];
                $notificacoes_baixas = $_POST['notificacoes_baixas'];
                $notificacoes_medias = $_POST['notificacoes_medias'];
                $notificacoes_altas = $_POST['notificacoes_altas'];
                $advertencias = $_POST['advertencias'];
                $motivo = $_POST['motivo'];
            
                $sql = "UPDATE membros SET nome_completo = '$nome_completo', cargo = '$cargo', 
                        notificacoes_baixas = '$notificacoes_baixas', notificacoes_medias = '$notificacoes_medias', 
                        notificacoes_altas = '$notificacoes_altas', advertencias = '$advertencias', motivo = '$motivo' 
                        WHERE id = $id";
            
                if ($pdo->exec($sql)) {
                    echo "Membro atualizado com sucesso!";
                } else {
                    echo "Erro ao atualizar membro.";
                }
            }
            
        ?>
    </form>
</body>
</html>