<?php
include "../controladora/autenticacao.php";
include "../controladora/conexao.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);


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
