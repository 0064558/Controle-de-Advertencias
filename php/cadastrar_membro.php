<?php
    require_once 'db.php'; 
    include('conexao.php');

    $mensagem = '';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome_completo = $_POST['nome_completo'];
        $cargo = $_POST['cargo'];
        $notificacoes_baixas = $_POST['notificacoes_baixas'];
        $notificacoes_medias = $_POST['notificacoes_medias'];
        $notificacoes_altas = $_POST['notificacoes_altas'];
        $advertencias = $_POST['advertencias'];
        $motivo = $_POST['motivo'];

        if (!empty($nome_completo) && !empty($cargo)) {
            // Prepara a consulta SQL usando prepared statements
            $sql = "INSERT INTO membros (nome_completo, cargo, notificacoes_baixas, notificacoes_medias, notificacoes_altas, advertencias, motivo) 
                    VALUES (:nome_completo, :cargo, :notificacoes_baixas, :notificacoes_medias, :notificacoes_altas, :advertencias, :motivo)";

            $stmt = $pdo->prepare($sql);

            // Atribui os valores para os placeholders
            $stmt->bindParam(':nome_completo', $nome_completo);
            $stmt->bindParam(':cargo', $cargo);
            $stmt->bindParam(':notificacoes_baixas', $notificacoes_baixas);
            $stmt->bindParam(':notificacoes_medias', $notificacoes_medias);
            $stmt->bindParam(':notificacoes_altas', $notificacoes_altas);
            $stmt->bindParam(':advertencias', $advertencias);
            $stmt->bindParam(':motivo', $motivo);

            // Tenta executar a consulta
            if ($stmt->execute()) {
                $mensagem = "Membro cadastrado com sucesso!";
            } else {
                $mensagem = "Erro ao cadastrar membro.";
            }
        } else {
            $mensagem = "Por favor, preencha todos os campos obrigatórios.";
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/cadastroMembro.css">
    <title>Cadastro de membros</title>
</head>
<body>
    <?php if(!empty($mensagem)): ?>
    <div class="mensagem">
        <?php echo $mensagem; ?>
    </div>
    <?php endif; ?>

    <div class="cadastro-container">
        <h1>Cadastro de Membros</h1>
        <form action="cadastrar_membro.php" method="POST">
            <label for="nome_completo">Nome Completo:</label>
            <input type="text" name="nome_completo" id="nome_completo" required><br>
            
            <label for="cargo">Cargo:</label>
            <input type="text" name="cargo" id="cargo" required><br>
            
            <label for="notificacoes_baixas">Notificações Baixas:</label>
            <input type="number" name="notificacoes_baixas" id="notificacoes_baixas" value="0"><br>
            
            <label for="notificacoes_medias">Notificações Médias:</label>
            <input type="number" name="notificacoes_medias" id="notificacoes_medias" value="0"><br>
            
            <label for="notificacoes_altas">Notificações Altas:</label>
            <input type="number" name="notificacoes_altas" id="notificacoes_altas" value="0"><br>
            
            <label for="advertencias">Advertências:</label>
            <input type="number" name="advertencias" id="advertencias" value="0"><br>
            
            <label for="motivo">Motivo:</label>
            <textarea name="motivo" id="motivo"></textarea><br>
            
            <input type="submit" class="btn-cadastrar" value="Cadastrar Membro">
        </form>
        <a href="dashboard.php" class="btn-voltar">Voltar</a>
    </div>
</body>
</html>