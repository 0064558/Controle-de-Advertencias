<?php
require_once 'db.php';
include('conexao.php');
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

if (!$_SESSION['is_admin']) {
    echo "Você não tem permissão para cadastrar um novo usuário.";
    exit();
}

// Código para exibir o formulário e processar o cadastro do usuário:
$mensagem = '';
$mensagem_erro = '';

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $admin = isset($_POST['admin']) ? 1 : 0;

    // Valida se todos os campos obrigatórios foram preenchidos
    if (!empty($nome) && !empty($email) && !empty($senha)) {
        // Verifica se o e-mail já está cadastrado
        $sql_check = "SELECT * FROM usuarios WHERE email = :email";
        $stmt_check = $pdo->prepare($sql_check);
        $stmt_check->bindParam(':email', $email);
        $stmt_check->execute();

        if ($stmt_check->rowCount() > 0) {
            $mensagem_erro = "Usuário já cadastrado com este e-mail.";
        } else {
            // Criptografa a senha
            $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);

            // Prepara a consulta SQL para inserir um novo usuário
            $sql = "INSERT INTO usuarios (nome, email, senha, admin) VALUES (:nome, :email, :senha, :admin)";
            $stmt = $pdo->prepare($sql);

            // Define os parâmetros
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':senha', $senhaCriptografada); // Usando a senha criptografada
            $stmt->bindParam(':admin', $admin);

            // Executa a inserção
            if ($stmt->execute()) {
                $mensagem = "Usuário cadastrado com sucesso!";
            } else {
                $mensagem_erro = "Erro ao cadastrar usuário.";
            }
        }
    } else {
        $mensagem_erro = "Por favor, preencha todos os campos obrigatórios.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Usuário</title>
    <link rel="stylesheet" href="../css/cadastrarUsuario.css">
</head>
<body>
    <?php if (!empty($mensagem)): ?>
        <div class="mensagem">
            <?php echo $mensagem; ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($mensagem_erro)): ?>
        <div class="mensagem-erro">
            <?php echo $mensagem_erro; ?>
        </div>
    <?php endif; ?>

    <div class="cadastro-container">
        <h1>Cadastrar Usuário</h1>
        <form action="cadastrar_usuario.php" method="POST">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" required><br>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required><br>

            <label for="senha">Senha:</label>
            <input type="password" name="senha" id="senha" required><br>

            <label for="admin">Administrador:</label>
            <input type="checkbox" name="admin" id="admin"><br>

            <input type="submit" value="Cadastrar Usuário" class="btn-cadastrar">
        </form>
        <a href="dashboard.php" class="btn-voltar">Voltar</a>
    </div>
</body>
</html>