<?php

include '../controladora/conexao.php';
include '../modelo/usuario.php';
include '../repositorio/usuarios_repositorio.php';

$usuariosRepositorio = new usuarioRepositorio($conn);
$usuarios = $usuariosRepositorio->buscarTodosAdmins();

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obter os dados do formulário
    $idUsuario = $_POST["idUsuario"];
    $nome = $_POST["nome"] ?? null;
    $email = $_POST["email"] ?? null;
    $senha = $_POST["senha"] ?? null;

    // Consultar os dados atuais do usuário para manter os valores que não foram modificados
    $stmt = $conn->prepare("SELECT nome, email, senha FROM usuario WHERE idUsuario = ?");
    $stmt->bind_param("i", $idUsuario);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($nomeAtual, $emailAtual, $senhaAtual);
    $stmt->fetch();
    $stmt->close();

    // Se os campos forem fornecidos, uss o novo valor. Caso contrário, mantem o valor atual.
    $nome = $nome ?? $nomeAtual;  // Se não foi fornecido nome, mantém o atual
    $email = $email ?? $emailAtual;  // Se não foi fornecido email, mantém o atual

    // Se a senha foi fornecida, aplique o hash, caso contrário, mantenha a senha atual
    if (!empty($senha)) {
        $senha = password_hash($senha, PASSWORD_DEFAULT);
    } else {
        $senha = $senhaAtual;
    }

    // Atualizar os dados no banco de dados
    $stmt = $conn->prepare("UPDATE usuario SET nome=?, email=?, senha=? WHERE idUsuario=?");
    $stmt->bind_param("sssi", $nome, $email, $senha, $idUsuario);

    if ($stmt->execute()) {
        header("Location: ../visao/admin_tabela.php");
        exit;
    } else {
        echo "Erro ao editar admin: " . $stmt->error;
    }

    $stmt->close();
}
