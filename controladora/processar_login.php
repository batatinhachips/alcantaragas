<?php
include "../controladora/autenticacao.php";
include "../controladora/conexao.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $login = new autenticacao($conn);
    $usuario = $login->verificarUsuario($email, $senha);

    if ($usuario) {
        session_start();
        $_SESSION["usuario"] = $usuario["email"];
        $_SESSION["nome_usuario"] = $usuario["nome"];
        $_SESSION["idNivelUsuario"] = $usuario["idNivelUsuario"];
        header("Location: ../index.php");
        exit;
    } else {
        header("Location: ../visao/formLogin.php?erro=1");
        exit;
    }
}

?>
