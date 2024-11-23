<?php
// Incluir o arquivo de conexão com o banco de dados
include '../controladora/conexao.php';
include '../modelo/usuario.php';
include '../repositorio/usuarios_repositorio.php';


$usuariosRepositorio = new usuarioRepositorio($conn);
$usuarios = $usuariosRepositorio->buscarTodosClientes();

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obter os dados do formulário
    $idUsuario = $_POST["idUsuario"]; // Corrigido para o nome correto
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $cpf = $_POST["cpf"];
    $telefone = $_POST["telefone"];
    $cep = $_POST["cep"];
    $logradouro = $_POST["logradouro"];
    $complemento = $_POST["complemento"];
    $numero = $_POST["numero"];
    $bairro = $_POST["bairro"];
    $cidade = $_POST["cidade"];


     // Gerar o hash da senha
    $senha = password_hash($_POST["senha"], PASSWORD_DEFAULT);

    // Atualizar as informações do produto no banco de dados
    $stmt = $conn->prepare("UPDATE usuario SET nome=?, email=?, senha=?, cpf=?, telefone=?, cep=?, logradouro=?, complemento=?, numero=?, bairro=?, cidade=? WHERE idUsuario=?");
    $stmt->bind_param("sssiiississi", $nome, $email, $senha, $cpf, $telefone, $cep, $logradouro, $complemento, $numero, $bairro, $cidade, $idUsuario);

    if ($stmt->execute()) {
        header("Location: ../visao/usuario_tabela.php");
        exit; // Adiciona um exit após o redirecionamento
    } else {
        echo "Erro ao editar usuario: " . $stmt->error; // Use o método de erro do statement
    }

    $stmt->close(); // Não esqueça de fechar a declaração
}
?>
// Não feche a conexão aqui, pois ela será utilizada em outros scripts

