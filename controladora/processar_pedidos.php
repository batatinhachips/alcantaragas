<?php
include '../controladora/conexao.php';
include '../modelo/pedidos.php';
include '../repositorio/pedidos_repositorio.php';
include '../repositorio/estoque_repositorio.php'; // Inclua o repositório de estoque
include "../controladora/autenticacao.php";  

function obterEndereco($cep) {
    $url = "https://viacep.com.br/ws/$cep/json/";
    $dados = file_get_contents($url);
    return json_decode($dados, true);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idUsuario = $_POST['nomeCliente'];
    $cep = $_POST['cep'];
    $produtoId = $_POST['produto'];
    $quantidadeVendida = $_POST['quantidade'];
    $preco = $_POST['preco'];
    $formaPagamento = $_POST['formaPagamento'];
    $numero = $_POST['numero'];
    $total_produtos = $_POST['total_produtos'] ?? NULL;

    $endereco = obterEndereco($cep);

    if (isset($endereco['erro']) && $endereco['erro'] == true) {
        echo "CEP inválido.";
        exit;
    }

    $estoqueRepositorio = new EstoqueRepositorio($conn);

    // Valida o estoque disponível
    $estoqueAtual = $estoqueRepositorio->obterEstoquePorProduto($produtoId);
    if ($estoqueAtual === null || $estoqueAtual['quantidade'] < $quantidadeVendida) {
        echo "Estoque insuficiente para o produto selecionado.";
        exit;
    }

    // Subtrai a quantidade vendida do estoque
    $estoqueAtualizado = $estoqueAtual['quantidade'] - $quantidadeVendida;
    $estoqueRepositorio->atualizarQuantidade($estoqueAtual['idEstoque'], $estoqueAtualizado);

    // Cria a instância da classe Pedidos
    $pedidos = new Pedidos(
        null,
        $idUsuario,
        null,
        $cep,
        $endereco['logradouro'],
        $numero,
        $endereco['bairro'],
        $endereco['localidade'],
        $produtoId,
        $quantidadeVendida,
        $preco,
        $preco * $quantidadeVendida,
        $formaPagamento,
        $total_produtos  
    );

    $vendasRepositorio = new pedidosRepositorio($conn);
    $sucesso = $vendasRepositorio->cadastrar($pedidos);

    if ($sucesso) {
        header("Location: ../visao/pedidos.php");
        } else {
        echo "Erro ao cadastrar a venda.";
    }
}
?>
