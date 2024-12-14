<?php
require_once 'db.php'; // Inclui o arquivo de conexão com o banco de dados


// Verifica se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php"); // Redireciona para a página de login se não estiver logado
    exit();
}

// Verifica se o usuário logado é administrador
if (!$_SESSION['is_admin']) {
    echo "Você não tem permissão para cadastrar um novo usuário."; // Exibe mensagem de acesso negado
    exit();
}

$mensagem = '';       // Variável para mensagem de sucesso
$mensagem_erro = '';  // Variável para mensagem de erro

// Verifica se o formulário foi submetido via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe os dados enviados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $admin = isset($_POST['admin']) ? 1 : 0; // Verifica se o campo "Administrador" foi marcado

    // Valida se os campos obrigatórios foram preenchidos
    if (!empty($nome) && !empty($email) && !empty($senha)) {
        // Verifica se o e-mail já está cadastrado
        $sql_check = "SELECT * FROM usuarios WHERE email = :email";
        $stmt_check = $pdo->prepare($sql_check);
        $stmt_check->bindParam(':email', $email);
        $stmt_check->execute();

        if ($stmt_check->rowCount() > 0) {
            $mensagem_erro = "Usuário já cadastrado com este e-mail."; // Mensagem caso o e-mail já exista
        } else {
            // Criptografa a senha antes de salvar
            $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);

            // Prepara a consulta SQL para inserir um novo usuário
            $sql = "INSERT INTO usuarios (nome, email, senha, admin) VALUES (:nome, :email, :senha, :admin)";
            $stmt = $pdo->prepare($sql);

            // Atribui os valores aos parâmetros da consulta
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':senha', $senhaCriptografada); // Usa a senha criptografada
            $stmt->bindParam(':admin', $admin);

            // Executa a inserção e verifica se foi bem-sucedida
            if ($stmt->execute()) {
                $mensagem = "Usuário cadastrado com sucesso!"; // Mensagem de sucesso
            } else {
                $mensagem_erro = "Erro ao cadastrar usuário."; // Mensagem de erro
            }
        }
    } else {
        $mensagem_erro = "Por favor, preencha todos os campos obrigatórios."; // Mensagem de campos obrigatórios vazios
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8"> <!-- Define a codificação de caracteres -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Define o viewport para dispositivos móveis -->
    <title>Cadastrar Usuário</title>
    <link rel="stylesheet" href="../css/cadastrarUsuario.css"> <!-- Link para o CSS -->
</head>
<body>
    <?php if (!empty($mensagem)): ?>
        <div class="mensagem">
            <?php echo $mensagem; ?> <!-- Exibe a mensagem de sucesso -->
        </div>
    <?php endif; ?>

    <?php if (!empty($mensagem_erro)): ?>
        <div class="mensagem-erro">
            <?php echo $mensagem_erro; ?> <!-- Exibe a mensagem de erro -->
        </div>
    <?php endif; ?>

    <div class="cadastro-container">
        <h1>Cadastrar Usuário</h1>
        <!-- Formulário para cadastrar um novo usuário -->
        <form action="cadastrar_usuario.php" method="POST">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" required><br>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required><br>

            <label for="senha">Senha:</label>
            <input type="password" name="senha" id="senha" required><br>

            <label for="admin">Administrador:</label>
            <input type="checkbox" name="admin" id="admin"><br>

            <input type="submit" value="Cadastrar Usuário" class="btn-cadastrar"> <!-- Botão para enviar o formulário -->
        </form>
        <a href="dashboard.php" class="btn-voltar">Voltar</a> <!-- Link para voltar à dashboard -->
    </div>
</body>
</html>
