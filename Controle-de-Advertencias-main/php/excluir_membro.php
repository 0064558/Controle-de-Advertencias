<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../Icons/favicon.ico.svg" type="image/x-icon">
    <title>Excluir Membro</title>
    <link rel="stylesheet" href="../css/excluirMembro.css">
    <script type="text/javascript">
        // Função javascript para confirmar a exclusão
        function confirmarExclusao() {
            var confirmacao = confirm("Você tem certeza que deseja excluir este membro?");
            if (confirmacao) {
                return true;  // Se o usuário confirmar, o formulário será enviado e a exclusão ocorrerá
            } else {
                return false;  // Não envia o formulário
            }
        }
    </script>
</head>
<body>
    <div class="excluir-container">
        <h2>Excluir Membro</h2>
        <p class="mensagem-exclusao">Tem certeza que deseja excluir este membro?</p>
        <?php
            require_once 'db.php';

            if (isset($_GET['id'])) {
                $id = $_GET['id'];

                // Exibe o botão de confirmação de exclusão
                echo '<form action="" method="POST" onsubmit="return confirmarExclusao();">';
                echo '<input type="hidden" name="id" value="' . $id . '">';
                echo '<input type="submit" value="Excluir Membro">';
                echo '</form>';
            }

            // Realiza a exclusão quando o formulário for submetido
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
                $id = $_POST['id'];

                // SQL para excluir o membro
                $sql = "DELETE FROM membros WHERE id = $id";

                // Executa a exclusão
                if ($pdo->exec($sql)) {
                    echo "Membro excluído com sucesso!";
                    // Redireciona para a página de dashboard após excluir
                    header("Location: dashboard.php");
                    exit();
                } else {
                    echo "Erro ao excluir membro.";
                }
            }
        ?>
        <a href="dashboard.php" class="btn-voltar">Voltar</a>
    </div>
</body>
</html>
