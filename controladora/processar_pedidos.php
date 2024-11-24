<?php
ob_start();
include '../controladora/conexao.php';
include '../modelo/pedidos.php';
include '../repositorio/pedidos_repositorio.php';
include '../repositorio/estoque_repositorio.php'; // Inclua o repositório de estoque
include "../controladora/autenticacao.php";  

function obterEndereco($cep) {
    $url = "https://viacep.com.br/ws/$cep/json/";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url); // Define a URL para a requisição
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Retorna o resultado como string
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Ignora a verificação SSL (opcional)
    
    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        curl_close($ch);
        return ['erro' => 'Erro ao conectar com o serviço: ' . curl_error($ch)];
    }

    curl_close($ch);

    return json_decode($response, true);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idUsuario = $_POST['nomeCliente'];
    $cep = $_POST['cep'];
    $produtoId = $_POST['produto'];
    $quantidadeVendida = $_POST['quantidade'];
    $preco = $_POST['preco'];
    $formaPagamento = $_POST['formaPagamento'];
    $numero = $_POST['numero'];
    $total_produtos = isset($_POST['total_produtos']) ? $_POST['total_produtos'] : NULL;

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
    ob_end_flush();
?>
