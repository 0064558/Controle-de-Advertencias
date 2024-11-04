<?php
require_once 'db.php'; // Inclui o arquivo de conexão com o banco de dados

$mensagem_erro = '';  // Variável para mensagem de erro

// Verifica se o formulário foi enviado via método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Obtém os valores de email e senha enviados pelo formulário
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Prepara a consulta SQL para buscar o usuário pelo email
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
    $stmt->bindValue(":email", $email); // Atribui o valor de $email ao parâmetro :email
    $stmt->execute(); // Executa a consulta

    // Verifica se algum usuário foi encontrado
    if ($stmt->rowCount() > 0) {
        // Se encontrado, obtém os dados do usuário
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Verifica se a senha fornecida corresponde à senha criptografada no banco de dados
        if (password_verify($senha, $user['senha'])) {
            // Se a senha for válida, inicia a sessão com informações do usuário
            $_SESSION['usuario'] = $user['nome']; // Nome do usuário
            $_SESSION['is_admin'] = $user['admin']; // Status admin do usuário
            header("Location: dashboard.php"); // Redireciona para o dashboard
            exit();
        } else {
            // Se a senha estiver incorreta, exibe uma mensagem de erro
            $_SESSION['mensagem_erro'] = "Email ou senha incorretos."; // Salva a mensagem de erro na sessão
            header("Location: ../index.php"); // Redireciona de volta para O index.php
            exit();
        }
    } else {
        // Se o usuário não for encontrado, exibe uma mensagem de erro
        $_SESSION['mensagem_erro'] = "Email ou senha incorretos."; // Salva a mensagem de erro na sessão
        header("Location: ../index.php"); // Redireciona de volta para O index.php
        exit();
    }
} else {
    // Exibe mensagem de erro se a requisição não for do tipo POST
    /*$mensagem_erro = "Método de requisição inválido.";*/
}

/*return early*/
?>
