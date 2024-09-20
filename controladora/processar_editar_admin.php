<?php
// Incluir o arquivo de conexão com o banco de dados
include '../controladora/conexao.php';
include '../modelo/login.php';
include '../repositorio/admins_repositorio.php';

$usuariosRepositorio = new usuarioRepositorio($conn);
$usuarios = $usuariosRepositorio->buscarTodos();

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obter os dados do formulário
    $id_usuario = $_POST["id_usuario"];
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $papel = $_POST["papel"];

    // Atualizar as informações do produto no banco de dados
    $sql = "UPDATE usuario SET 
                nome='$nome',
                email='$email',
                papel='$papel'
            WHERE id=$id_usuario";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../visao/admin.php");
    } else {
        echo "Erro ao editar admin: " . $conn->error;
    }
}

// Não feche a conexão aqui, pois ela será utilizada em outros scripts
?>