
<?php

include "../controladora/autenticacao.php";  
include "../controladora/conexao.php";  


ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1);  
error_reporting(E_ALL);  

// Verifica se o método da requisição é POST 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados enviados pelo formulário (email e senha)
    $email = $_POST["email"];  
    $senha = $_POST["senha"]; 

    // Cria um objeto da classe 'autenticacao' e verifica o usuário no banco de dados
    $login = new autenticacao($conn);  
    $usuario = $login->verificarUsuario($email, $senha);  

    // Verifica se o usuário existe (se a função 'verificarUsuario' retorna um valor válido)
    if ($usuario) {
        // Se o usuário for encontrado, inicia uma sessão para armazenar os dados do usuário
        session_start();  
        $_SESSION["usuario"] = $usuario["email"];  // Armazena o email do usuário na sessão
        $_SESSION["nome_usuario"] = $usuario["nome"];  // Armazena o nome do usuário na sessão
        $_SESSION["idNivelUsuario"] = $usuario["idNivelUsuario"];  // Armazena o nível de acesso do usuário na sessão

        header("Location: ../index.php");  
        exit;  
    } else {

        header("Location: ../visao/formLogin.php?erro=1");  
        exit;  
    }
}
?>

