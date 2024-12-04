<?php
ob_start(); // Inicia o buffer de saída, permitindo a modificação dos headers

require_once '../modelo/login.php';
require_once 'conexao.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Verifica se o método da requisição é POST 
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

    // Preparar o comando SQL para inserção do novo usuário no banco de dados
    // Evita SQL Injection com Prepared Statements

    // Hash da senha para segurança
    $senhaHash = password_hash($senha, PASSWORD_BCRYPT);

    $stmt = $conn->prepare(
        "INSERT INTO usuarios (nome, email, senha, idNivelUsuario, cpf, telefone, cep, logradouro, complemento, numero, bairro, cidade)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
    );
    
    // Verifica se o prepared statement foi criado corretamente
    if ($stmt === false) {
        echo "Erro na preparação da consulta: " . $conn->error;
        exit();
    }

    // Bind dos parâmetros, substituindo os placeholders "?" pelos valores recebidos no formulário
    $stmt->bind_param(
        "ssssssssssss", 
        $nome, 
        $email, 
        $senhaHash, 
        $idNivelUsuario, 
        $cpf, 
        $telefone, 
        $cep, 
        $logradouro, 
        $complemento, 
        $numero, 
        $bairro, 
        $cidade
    );

    // Executar a consulta preparada
    if ($stmt->execute()) {
        // Se o cadastro for bem-sucedido, redireciona o usuário conforme o nível de acesso
        if ($idNivelUsuario === "2") {
            header("Location: ../visao/admin.php");
        } else {
            header("Location: ../visao/cadastrarcliente_sucesso.php");
        }
        exit();
    } else {
        echo "Erro ao cadastrar usuário: " . $stmt->error;
    }

    // Fechar o prepared statement
    $stmt->close();
}

ob_end_flush(); // Finaliza o buffer de saída, enviando o conteúdo armazenado
