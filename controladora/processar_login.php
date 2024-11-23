<?php
include "../controladora/autenticacao.php";
include "../controladora/conexao.php";

error_reporting(0);
ini_set('display_errors',0);

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
