<?php
require("db.php");
session_destroy(); // Destroi a sessão atual
header("Location: ../index.php"); // Redireciona para o login
exit();
?>
