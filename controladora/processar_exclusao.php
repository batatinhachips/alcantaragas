<?php
include '../controladora/conexao.php';
include '../modelo/produtos.php';
include '../repositorio/produtos_repositorio.php';
include '../repositorio/usuarios_repositorio.php';

$produtosRepositorio = new produtoRepositorio($conn);
$usuariosRepositorio = new usuarioRepositorio($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $idParaExcluir = $_POST['id'];

    // Excluir do banco de dados
    $produtosRepositorio->excluirProdutosPorId($idParaExcluir);

   header('Location: ../visao/admin.php');
}




if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_usuario'])) {
    $idParaExcluir = $_POST['id_usuario'];

    // Excluir do banco de dados
    $usuariosRepositorio->excluirUsuariosPorId($idParaExcluir);

    header('Location: ../visao/admin_tabela.php');
}

// Redirecione para a página principal ou para onde desejar após a exclusão
exit();
?>
