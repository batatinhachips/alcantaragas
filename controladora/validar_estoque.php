<?php
include '../controladora/conexao.php';
include '../repositorio/estoque_repositorio.php';

$produtoId = $_GET['produtoId'];
$quantidade = $_GET['quantidade'];

$estoqueRepositorio = new EstoqueRepositorio($conn);
$estoque = $estoqueRepositorio->obterEstoquePorProduto($produtoId);

if ($estoque && $estoque['quantidade'] >= $quantidade) {
    echo json_encode(['sucesso' => true]);
} else {
    echo json_encode(['sucesso' => false]);
}
?>