<?php
// Inicia o buffer de saída para garantir que a execução do script não envie nenhum conteúdo para o navegador antes do final
ob_start();

include '../controladora/conexao.php';
include '../modelo/pedidos.php';
include '../repositorio/pedidos_repositorio.php';
include '../repositorio/estoque_repositorio.php';
include "../controladora/autenticacao.php";

// Função para obter o endereço a partir do CEP usando a API do ViaCEP
function obterEndereco($cep)
{
    $url = "https://viacep.com.br/ws/$cep/json/";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);


    $response = curl_exec($ch);

    // Verifica se ocorreu algum erro durante a execução da requisição
    if (curl_errno($ch)) {
        curl_close($ch);
        return ['erro' => 'Erro ao conectar com o serviço: ' . curl_error($ch)];
    }

    curl_close($ch);

    return json_decode($response, true);
}

// Verifica se a requisição foi do tipo POST (enviado pelo formulário)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtém os dados do formulário
    $idUsuario = $_POST['nomeCliente'];
    $cep = $_POST['cep'];
    $produtoId = $_POST['produto'];
    $quantidadeVendida = $_POST['quantidade'];
    $preco = $_POST['preco'];
    $formaPagamento = $_POST['formaPagamento'];
    $numero = $_POST['numero'];
    $total_produtos = isset($_POST['total_produtos']) ? $_POST['total_produtos'] : NULL;

    // Chama a função para obter o endereço com o CEP informado
    $endereco = obterEndereco($cep);

    // Verifica se ocorreu erro ao obter o endereço (se o CEP for inválido)
    if (isset($endereco['erro']) && $endereco['erro'] == true) {
        echo "CEP inválido.";
        exit;
    }

    // Cria uma instância do repositório de estoque para verificar a quantidade disponível
    $estoqueRepositorio = new EstoqueRepositorio($conn);

    // Obtém a quantidade atual do produto no estoque
    $estoqueAtual = $estoqueRepositorio->obterEstoquePorProduto($produtoId);
    // Verifica se o estoque é suficiente para a quantidade vendida
    if ($estoqueAtual === null || $estoqueAtual['quantidade'] < $quantidadeVendida) {
        // Exibe a mensagem como um pop-up e interrompe a execução
        echo "<script>
        alert('Estoque insuficiente para o produto selecionado.');
        window.history.back(); // Retorna à página anterior </script>";
        exit;
    }

    // Atualiza o estoque subtraindo a quantidade vendida
    $estoqueAtualizado = $estoqueAtual['quantidade'] - $quantidadeVendida;
    // Chama o repositório de estoque para atualizar a quantidade do produto no banco
    $estoqueRepositorio->atualizarQuantidade($estoqueAtual['idEstoque'], $estoqueAtualizado);

    // Cria uma instância da classe Pedidos com os dados obtidos
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

    // Cria uma instância do repositório de pedidos para salvar a venda no banco
    $vendasRepositorio = new pedidosRepositorio($conn);
    // Tenta cadastrar o pedido no banco de dados
    $sucesso = $vendasRepositorio->cadastrar($pedidos);

    // Verifica se o cadastro foi bem-sucedido
    if ($sucesso) {
        header("Location: ../visao/pedidos.php");
    } else {
        echo "Erro ao cadastrar a venda.";
    }
}

// Finaliza o buffer de saída e envia o conteúdo para o navegador
ob_end_flush();
