<?php
    include("php/conexao.php")
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="Icons/favicon.ico.svg" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
    <title>Tela de Login</title>
</head>

<body>
    <form action="php/login.php" method="POST">
        <div class="login-container">

            <?php if (!empty($flash)): ?>
                <p class="flashError"><?= $flash ?></p>
            <?php endif; ?>

            <img class ="Imagem-Login" src="Icons/logo-gradiente.svg" alt="Imagem-Login">
            <h2>Login</h2>
            <label for="email">Email:</label>
            <input type="email" name="email" required>
            <label for="senha">Senha:</label>
            <input type="password" name="senha" required>
            <button type="submit" id="btn-login">Entrar</button>
        </div>


    </form>
</body>

</html>