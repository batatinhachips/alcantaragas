<?php
require_once '../modelo/login.php';
require_once 'conexao.php'; // Certifique-se de que o caminho está correto

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obter dados do formulário

    $nome = trim($_POST["nome"]);
    $email = trim($_POST["email"]);
    $senha = $_POST["senha"];
    $confirmarsenha = $_POST["confirmarsenha"];
    $papel = 'admin';
    $cpf = isset($_POST["cpf"]) ? trim($_POST["cpf"]) : null;
    $telefone = isset($_POST["telefone"]) ? trim($_POST["telefone"]) : null;
    $cep = isset($_POST["cep"]) ? trim($_POST["cep"]) : null;
    $logradouro = isset($_POST["logradouro"]) ? trim($_POST["logradouro"]) : null;
    $complemento = isset($_POST["complemento"]) ? trim($_POST["complemento"]) : null;
    $numero = isset($_POST["numero"]) ? trim($_POST["numero"]) : null;
    $bairro = isset($_POST["bairro"]) ? trim($_POST["bairro"]) : null;
    $cidade = isset($_POST["cidade"]) ? trim($_POST["cidade"]) : null;

    // Validação básica
    $erros = [];
    if (empty($nome) || empty($email) || empty($senha) || empty($confirmarsenha) || empty($papel)) {
        $erros[] = "Todos os campos são obrigatórios.";
    }

    if ($senha !== $confirmarsenha) {
        $erros[] = "As senhas não coincidem.";
    }


    if (!empty($erros)) {
        header("Location: ../visao/cadastro.php?erro=" . urlencode(implode(", ", $erros)));
        exit();
    }

    // Instanciar a classe Usuario com a conexão
    $usuario = new Usuario($conn);

    // Cadastrar usuário ou administrador
    $resultado = $usuario->cadastrar($nome, $email, $senha, $papel, $cpf, $telefone, $cep, $logradouro, $complemento, $numero, $bairro, $cidade);
    
    if ($resultado === true) {
        // Redirecionar para a página de sucesso com base no papel
            header("Location: ../visao/cadastaradmin_sucesso.php");

    } else {
        echo "Erro ao cadastrar usuário: " . $resultado;
    }
}
?>
