<?php
require_once '../modelo/login.php';
require_once '../controladora/conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $confirmarsenha = $_POST["confirmarsenha"];
    $papel = $_POST["papel"];
    $cpf = $_POST["cpf"];
    $telefone = $_POST["telefone"];
    $cep = $_POST["cep"];
    $logradouro = $_POST["logradouro"];
    $complemento = $_POST["complemento"];
    $numero = $_POST["numero"];
    $bairro = $_POST["bairro"];
    $cidade = $_POST["cidade"];
   
    // Validação básica
    if (empty($nome) || empty($email) || empty($senha) || empty($confirmarsenha) || empty($papel)) {
        echo "Todos os campos são obrigatórios.";
        exit;
    }

    if ($senha !== $confirmarsenha) {
        header("Location: ../visao/cadastro.php?erro=2");
        exit();
    }

    // Verificar se o papel é válido
    $papel_valido = ['admin', 'usuario'];
    if (!in_array($papel, $papel_valido)) {
        echo "Papel inválido.";
        exit;
    }

    // Criptografar a senha
    $senha_hash = password_hash($senha, PASSWORD_BCRYPT);

    // Criar uma instância da classe Usuario
    $cliente = new usuario($conn);
    $admin = new usuario($conn);

    if($papel !== "admin") {
        //cadastrar admin
        if ($cliente->cadastrar($nome, $email, $senha_hash, $papel, $cpf, $telefone, $cep, $logradouro, $complemento, $numero, $bairro, $cidade)) {
            // Redirecionar para a página de sucesso após o cadastro
            header("Location: ../visao/cadastrarcliente_sucesso.php");
            exit();
        } else {
            echo "Erro ao cadastrar. Tente novamente.";
        }
    } else {
         // Cadastrar o usuário
        if ($admin->cadastrarAdm($nome, $email, $senha, $papel)) {
            // Redirecionar para a página de sucesso após o cadastro
            header("Location: ../visao/cadastrarcliente_sucesso.php");
            exit();
        } else {
            echo "Erro ao cadastrar. Tente novamente.";
        }
    }

}
?>
