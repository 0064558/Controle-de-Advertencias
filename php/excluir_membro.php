<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Membro</title>
    <script type="text/javascript">
        // Função para confirmar a exclusão
        function confirmarExclusao() {
            var confirmacao = confirm("Você tem certeza que deseja excluir este membro?");
            if (confirmacao) {
                return true;  // Se o usuário confirmar, o formulário será enviado e a exclusão ocorrerá
            } else {
                window.location.href = 'dashboard.php'; // Caso o usuário cancele, volta para o dashboard
                return false;  // Não envia o formulário
            }
        }
    </script>
</head>
<body>
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
</body>
</html>
