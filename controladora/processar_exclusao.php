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
        // Verificar se o ID para excluir foi enviado
        if (isset($_POST['idParaExcluir']) && !empty($_POST['idParaExcluir'])) {
            $idParaExcluir = $_POST['idParaExcluir'];
    
            // Excluir o usuário
            $usuariosRepositorio->excluirUsuariosPorId($idParaExcluir);
    
            // Verifique se o campo 'papel' foi enviado e redirecione adequadamente
            if (isset($_POST['papel'])) {
                if ($_POST['papel'] === 'admin') {
                    // Redirecionar para a página de administradores
                    header('Location: ../visao/admin_tabela.php');
                } elseif ($_POST['papel'] === 'usuario') {
                    // Redirecionar para a página de usuários comuns
                    header('Location: ../visao/usuario_tabela.php');
                }
            } else {
                // Se o 'papel' não foi enviado, exiba uma mensagem de erro ou redirecione para uma página padrão
                echo "Erro: O campo 'papel' não foi enviado.";
            }
        } else {
            echo "Erro: ID para exclusão não foi fornecido.";
        }
    
        exit();
    }
}

?>
