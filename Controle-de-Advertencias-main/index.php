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

            <img class="Imagem-Login" src="Icons/logo-gradiente.svg" alt="Imagem-Login">
            <h2>Login</h2>
            <label for="email">Email:</label>
            <input type="email" name="email" required>
            
            <label for="senha">Senha:</label>
            <input type="password" name="senha" id="senha" required>
            
            <!-- Checkbox para mostrar senha -->
            <label>
                <input type="checkbox" onclick="toggleSenha()"> Mostrar Senha
            </label>

            <button type="submit" id="btn-login">Entrar</button>
            <br>
            
            <!-- Exibe a mensagem de erro -->
            <?php
            session_start();
            if(isset($_SESSION['mensagem_erro'])): ?>
            <div class="mensagem-erro">
                <?php
                    echo $_SESSION['mensagem_erro'];
                    unset($_SESSION['mensagem_erro']); // Remove a mensagem de erro da sessão
                ?>
            </div>
            <?php endif; ?>
            
           
        </div>
    </form>

    <!-- Script JavaScript para alternar senha -->
    <script>
        function toggleSenha() {
            const senhaInput = document.getElementById("senha");
            senhaInput.type = senhaInput.type === "password" ? "text" : "password";
        }
    </script>
</body>
</html>
