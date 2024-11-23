<?php
include '../controladora/conexao.php';
include '../modelo/produtos.php';
include '../repositorio/produtos_repositorio.php';
include '../modelo/usuario.php';
include '../repositorio/usuarios_repositorio.php';
include '../repositorio/pedidos_repositorio.php';
include '../repositorio/estoque_repositorio.php';

$produtosRepositorio = new produtoRepositorio($conn);
$usuariosRepositorio = new usuarioRepositorio($conn);
$vendasRepositorio = new pedidosRepositorio($conn);
$estoqueRepositorio = new EstoqueRepositorio($conn);

header('Content-Type: application/json');


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $idParaExcluir = $_POST['id'];

    if (isset($_POST['tipo'])) {
        switch ($_POST['tipo']) {
            
            case 'vendas':
                $vendasRepositorio->excluirVendasPorId($idParaExcluir);
                $novoLucro = $vendasRepositorio->somarTotais();
                $response = [
                    'status' => 'sucesso',
                    'message' => 'Venda excluída com sucesso',
                    'id' => $idParaExcluir,
                    'novoLucro' => $novoLucro,
                ];
                break;

            case 'produto':
                $produtosRepositorio->excluirProdutosPorId($idParaExcluir);
                $response = [
                    'status' => 'sucesso',
                    'message' => 'Produto excluído com sucesso',
                    'id' => $idParaExcluir,
                ];
                break;

            case 'usuario':
                $usuariosRepositorio->excluirUsuariosPorId($idParaExcluir);
                $response = [
                    'status' => 'sucesso',
                    'message' => 'Usuário excluído com sucesso',
                    'id' => $idParaExcluir,
                ];
                break;

            case 'estoque':
                $estoqueRepositorio->excluirEstoquePorId($idParaExcluir);
                $response = [
                    'status' => 'sucesso',
                    'message' => 'Produto de Estoque excluído com sucesso',
                    'id' => $idParaExcluir,
                    ];
                    break;     

            default:
                $response = [
                    'status' => 'error',
                    'message' => 'Tipo de exclusão inválido',
                ];
                break;
        }
    }
}

echo json_encode($response);
exit();
?>