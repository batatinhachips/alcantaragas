<?php
ob_start(); // Inicia o buffer de saída, permitindo a modificação dos headers

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
    $idNivelUsuario = trim($_POST["idNivelUsuario"]);
    $cpf = isset($_POST["cpf"]) ? trim($_POST["cpf"]) : null;
    $telefone = isset($_POST["telefone"]) ? trim($_POST["telefone"]) : null;
    $cep = isset($_POST["cep"]) ? $_POST["cep"] : null;
    $logradouro = isset($_POST["logradouro"]) ? trim($_POST["logradouro"]) : null;
    $complemento = isset($_POST["complemento"]) ? trim($_POST["complemento"]) : null;
    $numero = isset($_POST["numero"]) ? trim($_POST["numero"]) : null;
    $bairro = isset($_POST["bairro"]) ? trim($_POST["bairro"]) : null;
    $cidade = isset($_POST["cidade"]) ? trim($_POST["cidade"]) : null;

    // Validação básica
    $erros = [];
    if (empty($nome) || empty($email) || empty($senha) || empty($confirmarsenha) || empty($idNivelUsuario)) {
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
    if ($usuario->cadastrar($nome, $email, $senha, $idNivelUsuario, $cpf, $telefone, $cep, $logradouro, $complemento, $numero, $bairro, $cidade)) {
        // Redirecionar para a página de sucesso após o cadastro
        if ($idNivelUsuario === "2") {
            header("Location: ../visao/admin.php");
        } else {
            header("Location: ../visao/cadastrarcliente_sucesso.php");
        }
        exit();
    } else {
        echo "Erro ao cadastrar usuário: " . $resultado;
    }
}

ob_end_flush(); // Finaliza o buffer de saída, enviando o conteúdo armazenado
?>
