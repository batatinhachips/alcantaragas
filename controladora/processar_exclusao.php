<?php
include '../controladora/conexao.php';
include '../modelo/produtos.php';
include '../repositorio/produtos_repositorio.php';
include '../modelo/usuario.php';
include '../repositorio/usuarios_repositorio.php';

$produtosRepositorio = new produtoRepositorio($conn);
$usuariosRepositorio = new usuarioRepositorio($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $idParaExcluir = $_POST['id'];

    if (isset($_POST['tipo']) && $_POST['tipo'] === 'produto') {
        // Excluir produto
        $produtosRepositorio->excluirProdutosPorId($idParaExcluir);
        header('Location: ../visao/admin.php');
        exit();
    } elseif (isset($_POST['tipo']) && $_POST['tipo'] === 'usuario') {
        // Excluir usuário
        $usuariosRepositorio->excluirUsuariosPorId($idParaExcluir);

        // Redirecionar com base na página de origem
        if (isset($_POST['pagina_origem'])) {
            if ($_POST['pagina_origem'] === 'admin_tabela') {
                header('Location: ../visao/admin_tabela.php');
            } elseif ($_POST['pagina_origem'] === 'usuario_tabela') {
                header('Location: ../visao/usuario_tabela.php');
            }
        } else {
            // Redirecionamento padrão caso não seja identificada a origem
            header('Location: ../visao/admin_tabela.php');
        }

        exit();
    }
}
?>
