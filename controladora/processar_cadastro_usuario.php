<?php
require_once '../modelo/login.php';
require_once 'conexao.php'; // Certifique-se de que o caminho está correto

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obter dados do formulário
    $nome = trim($_POST["nome"]);
    $email = trim($_POST["email"]);
    $senha = $_POST["senha"];
    $confirmarsenha = $_POST["confirmarsenha"];
    $papel = $_POST["papel"];
    $cpf = trim($_POST["cpf"]);
    $telefone = trim($_POST["telefone"]);
    $cep = trim($_POST["cep"]);
    $logradouro = trim($_POST["logradouro"]);
    $complemento = trim($_POST["complemento"]);
    $numero = trim($_POST["numero"]);
    $bairro = trim($_POST["bairro"]);
    $cidade = trim($_POST["cidade"]);

    // Validação básica
    $erros = [];
    if (empty($nome) || empty($email) || empty($senha) || empty($confirmarsenha) || empty($papel)) {
        $erros[] = "Todos os campos são obrigatórios.";
    }

    if ($senha !== $confirmarsenha) {
        $erros[] = "As senhas não coincidem.";
    }

    $papel_valido = ['admin', 'usuario'];
    if (!in_array($papel, $papel_valido)) {
        $erros[] = "Papel inválido.";
    }

    if (!empty($erros)) {
        header("Location: ../visao/cadastro.php?erro=" . urlencode(implode(", ", $erros)));
        exit();
    }

    // Criptografar a senha
    $senha_hash = password_hash($senha, PASSWORD_BCRYPT);
    $usuario = new Usuario(); // Certifique-se de que a classe Usuario está definida corretamente

    // Cadastrar usuário ou administrador
    if ($papel === "admin") {
        // Cadastrar administrador
        if ($usuario->cadastrarAdm($nome, $email, $senha_hash, $papel)) {
            header("Location: ../visao/cadastrarcliente_sucesso.php");
            exit();
        } else {
            echo "Erro ao cadastrar administrador. Tente novamente.";
        }
    } else {
        // Cadastrar usuário normal
        if ($usuario->cadastrar($nome, $email, $senha_hash, $papel, $cpf, $telefone, $cep, $logradouro, $complemento, $numero, $bairro, $cidade)) {
            header("Location: ../visao/cadastrarcliente_sucesso.php");
            exit();
        } else {
            echo "Erro ao cadastrar usuário. Tente novamente.";
        }
    }
}
?>
