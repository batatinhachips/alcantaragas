<?php
// Incluir o arquivo de conexão com o banco de dados
include '../controladora/conexao.php';
include '../modelo/usuario.php';
include '../repositorio/usuarios_repositorio.php';
require_once '../modelo/login.php';

$usuariosRepositorio = new usuarioRepositorio($conn);
$usuarios = $usuariosRepositorio->buscarTodosAdmins();

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obter os dados do formulário
    $id_usuario = $_POST["id_usuario"]; // Corrigido para o nome correto
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    // Atualizar as informações do produto no banco de dados
    $stmt = $conn->prepare("UPDATE usuario SET nome=?, email=?, senha=? WHERE id_usuario=?");
    $stmt->bind_param("sssi", $nome, $email, $senha, $id_usuario);

    if ($stmt->execute()) {
        header("Location: ../visao/admin_tabela.php");
        exit; // Adiciona um exit após o redirecionamento
    } else {
        echo "Erro ao editar admin: " . $stmt->error; // Use o método de erro do statement
    }

    $stmt->close(); // Não esqueça de fechar a declaração
}

// Não feche a conexão aqui, pois ela será utilizada em outros scripts
?>
