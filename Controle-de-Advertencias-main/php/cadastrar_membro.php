<?php
require_once 'db.php';  // Inclui o arquivo que estabelece a conexão com o banco de dados


$mensagem = ''; // Variável para armazenar mensagens de sucesso ou erro

// Verifica se o método de envio do formulário é POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os valores enviados no formulário e armazena em variáveis
    $nome_completo = $_POST['nome_completo'];
    $cargo = $_POST['cargo'];
    $notificacoes_baixas = $_POST['notificacoes_baixas'];
    $notificacoes_medias = $_POST['notificacoes_medias'];
    $notificacoes_altas = $_POST['notificacoes_altas'];
    $advertencias = $_POST['advertencias'];
    $motivo = $_POST['motivo'];

    // Verifica se os campos obrigatórios foram preenchidos
    if (!empty($nome_completo) && !empty($cargo)) {
        // Declara a instrução SQL para inserir um novo membro no banco de dados
        $sql = "INSERT INTO membros (nome_completo, cargo, notificacoes_baixas, notificacoes_medias, notificacoes_altas, advertencias, motivo) 
                VALUES (:nome_completo, :cargo, :notificacoes_baixas, :notificacoes_medias, :notificacoes_altas, :advertencias, :motivo)";

        // Prepara a consulta para execução
        $stmt = $pdo->prepare($sql);

        // Associa cada variável aos parâmetros correspondentes da consulta
        $stmt->bindParam(':nome_completo', $nome_completo);
        $stmt->bindParam(':cargo', $cargo);
        $stmt->bindParam(':notificacoes_baixas', $notificacoes_baixas);
        $stmt->bindParam(':notificacoes_medias', $notificacoes_medias);
        $stmt->bindParam(':notificacoes_altas', $notificacoes_altas);
        $stmt->bindParam(':advertencias', $advertencias);
        $stmt->bindParam(':motivo', $motivo);

        // Executa a consulta e verifica se foi bem-sucedida
        if ($stmt->execute()) {
            $mensagem = "Membro cadastrado com sucesso!"; // Mensagem de sucesso
        } else {
            $mensagem = "Erro ao cadastrar membro."; // Mensagem de erro
        }
    } else {
        $mensagem = "Por favor, preencha todos os campos obrigatórios."; // Mensagem para campos obrigatórios não preenchidos
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8"> <!-- Define a codificação de caracteres -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Define o viewport para dispositivos móveis -->
    <link rel="shortcut icon" href="../Icons/favicon.ico.svg" type="image/x-icon"> <!-- Ícone da página -->
    <link rel="stylesheet" href="../css/cadastroMembro.css"> <!-- Estilos da página -->
    <title>Cadastro de membros</title>
</head>
<body>
    <?php if(!empty($mensagem)): ?>
    <div class="mensagem">
        <?php echo $mensagem; ?> <!-- Exibe a mensagem de sucesso ou erro -->
    </div>
    <?php endif; ?>

    <div class="cadastro-container">
        <h1>Cadastro de Membros</h1>
        <!-- Formulário para cadastrar um novo membro -->
        <form action="cadastrar_membro.php" method="POST">
            <!-- Campos para preenchimento dos dados do membro -->
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
            
            <input type="submit" class="btn-cadastrar" value="Cadastrar Membro"> <!-- Botão para enviar o formulário -->
        </form>
        <!-- Link para voltar à página de dashboard -->
        <a href="dashboard.php" class="btn-voltar">Voltar</a>
    </div>
</body>
</html>
