<?php
// Incluir o arquivo de conexão com o banco de dados
include '../controladora/conexao.php';
include '../modelo/usuario.php';
include '../repositorio/usuarios_repositorio.php';

$usuariosRepositorio = new usuarioRepositorio($conn);
$usuarios = $usuariosRepositorio->buscarTodosAdmins();

// Verificar se o formulário foi enviado
/* if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obter os dados do formulário
    $id_usuario = $_POST["id_usuario"];
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    
    // $papel = $_POST["papel"];




    // Atualizar as informações do produto no banco de dados
    $sql = "UPDATE usuario SET 
                nome='$nome',
                email='$email',
                senha= '$senha'

                -- papel='$papel'


            WHERE id=$id_usuario";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../visao/admin.php");
    } else {
        echo "Erro ao editar admin: " . $conn->error;
    }
 */
// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obter os dados do formulário
    $id_usuario = $_POST["id_usuario"] ?? null; // Mudei aqui para corresponder ao nome do índice
    $nome = $_POST["nome"] ?? null;
    $email = $_POST["email"] ?? null;
    $senha = $_POST["senha"] ?? null;

    // Atualizar as informações do produto no banco de dados
    $stmt = $conn->prepare("UPDATE usuario SET nome=?, email=?, senha=? WHERE id_usuario=?");
    $stmt->bind_param("sssi", $nome, $email, $senha, $id_usuario);

    if ($stmt->execute()) {
        header("Location: ../visao/admin.php");
    } else {
        echo "Erro ao editar admin: " . $stmt->error; // Use o método de erro do statement
    }

    $stmt->close(); // Não esqueça de fechar a declaração
}

// Não feche a conexão aqui, pois ela será utilizada em outros scripts
?>
