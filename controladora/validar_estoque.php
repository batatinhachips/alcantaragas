<?php

include '../controladora/conexao.php';
include '../repositorio/estoque_repositorio.php';

// Recupera os parâmetros 'produtoId' e 'quantidade' da URL (via método GET)
$produtoId = $_GET['produtoId'];
$quantidade = $_GET['quantidade'];

// Cria uma instância do repositório de estoque, passando a conexão com o banco
$estoqueRepositorio = new EstoqueRepositorio($conn);

// Chama o método 'obterEstoquePorProduto' para obter o estoque do produto pelo ID
$estoque = $estoqueRepositorio->obterEstoquePorProduto($produtoId);

// Verifica se o produto foi encontrado no estoque e se a quantidade disponível é suficiente
if ($estoque && $estoque['quantidade'] >= $quantidade) {
    echo json_encode(['sucesso' => true]);
} else {
    echo json_encode(['sucesso' => false]);
}
