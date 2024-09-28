<?php
include '../controladora/conexao.php';
include '../modelo/produtos.php';
include '../repositorio/produtos_repositorio.php';
include '../modelo/usuario.php'; // Inclua o modelo de usuários
include '../repositorio/usuarios_repositorio.php';
include '../modelo/login.php';// Inclua o repositório de usuários

$produtosRepositorio = new produtoRepositorio($conn);
$usuariosRepositorio = new usuarioRepositorio($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $idParaExcluir = $_POST['id'];

    if (isset($_POST['tipo']) && $_POST['tipo'] === 'produto') {
        // Excluir produto
        $produtosRepositorio->excluirProdutosPorId($idParaExcluir);

        // Redirecionar após exclusão de produto
        header('Location: ../visao/admin.php');
        exit();

    } elseif (isset($_POST['tipo']) && $_POST['tipo'] === 'usuario') {
        // Excluir usuário
        $usuariosRepositorio->excluirUsuariosPorId($idParaExcluir);

        // Verifique se o usuário é um administrador antes de redirecionar
    }elseif (isset($_POST['tipo']) && $_POST['tipo'] === 'usuario') {
        // Excluir usuário
        $usuariosRepositorio->excluirUsuariosPorId($idParaExcluir);

        // Verifique se o usuário é um administrador antes de redirecionar
        if($_POST['papel'] === 'admin'){
        // Redirecionar para outra página caso seja um usuário comum (se necessário)
        header('Location: ../visao/admin_tabela.php');
        }elseif($_POST['papel'] === 'usuario'){
        header('Location: ../visao/usuario_tabela.php');
        }
        exit();
    }
}

?>
