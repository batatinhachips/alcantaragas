<?php
include "../controladora/autenticacao.php";
include "../controladora/conexao.php";

    if (isset($_SESSION["erro"])) {
    echo "<p style='color: red;'>" . $_SESSION["erro"] . "</p>";
    unset($_SESSION["erro"]); // Limpa a mensagem após exibi-la
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $login = new autenticacao($conn);
    $usuario = $login->verificarUsuario($email, $senha);

    if ($usuario) {
        session_start();
        $_SESSION["usuario"] = $usuario["email"];
        $_SESSION["nome_usuario"] = $usuario["nome"];
        $_SESSION["papel"] = $usuario["papel"];
        header("Location: / ");
        exit;
    } else {
        header("Location: ../visao/formLogin.php?erro=1");
        exit;
    }
}

?>
