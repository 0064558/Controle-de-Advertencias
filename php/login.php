<?php
require_once 'db.php';

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
    $stmt->bindValue(":email", $email);
    $stmt->execute();
    /*$sql = $stmt->fetchAll(PDO::FETCH_ASSOC);*/

    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Para texto simples
        if ($senha == $user['senha']) {
            $_SESSION['usuario'] = $user['nome'];
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Senha incorreta.";
        }
    } else {
        echo "Usuário não encontrado.";
    }
} else {
    echo "Método de requisição inválido.";
}

/*return early*/
?>
