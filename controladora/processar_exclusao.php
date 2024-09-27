<?php
include '../controladora/conexao.php';
include '../modelo/produtos.php';
include '../repositorio/produtos_repositorio.php';
include '../repositorio/usuarios_repositorio.php';

$produtosRepositorio = new produtoRepositorio($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $idParaExcluir = $_POST['id'];

    // Excluir do banco de dados
    $produtosRepositorio->excluirProdutosPorId($idParaExcluir);

    // Adicione aqui qualquer lógica adicional necessária para a exclusão no site, se aplicável
}

// Redirecione para a página principal ou para onde desejar após a exclusão
header('Location: ../visao/admin.php');

$usuariosRepositorio = new usuarioRepositorio($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $idParaExcluir = $_POST['id'];

    // Excluir do banco de dados
    $usuariosRepositorio->excluirUsuariosPorId($idParaExcluir);

    header('Location: ../visao/admin_tabela.php');
}

// Redirecione para a página principal ou para onde desejar após a exclusão
exit();
?>
