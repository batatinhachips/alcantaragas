<?php
session_start();
session_unset(); // Limpa todas as variáveis de sessão
session_destroy(); // Destrói a sessão
header("Location: /"); // Redireciona para a página de login
exit();
?>