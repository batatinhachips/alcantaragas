<?php
include '../controladora/conexao.php';
include '../modelo/vendas.php';  // Certifique-se de que a classe Estoque está sendo incluída aqui
include '../repositorio/vendas_repositorio.php';  // O repositório de vendas
include "../controladora/autenticacao.php";  // Se necessário

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recebe os dados do formulário
    $cep = $_POST['cep']; // Supondo que o CEP venha do formulário
    $produto = $_POST['produto'];
    $quantidade = $_POST['quantidade'];
    $preco = $_POST['preco'];
    $formaPagamento = $_POST['formaPagamento'];
    $numero = $_POST['numero'];
    $total_produtos = $_POST['total_produtos'] ?? NULL;

    // Chama a API ViaCEP para obter os dados de endereço
    $viaCepUrl = "https://viacep.com.br/ws/{$cep}/json/";
    $endereco = file_get_contents($viaCepUrl);
    $endereco = json_decode($endereco, true);

    // Verifica se a API retornou dados válidos
    if (isset($endereco['erro']) && $endereco['erro'] == true) {
        echo "CEP não encontrado.";
        exit; // Se não encontrou o CEP, interrompe o processo
    }

    // Cria a instância da classe Estoque com os dados do formulário
    $estoque = new Estoque(
        null, // ID (não utilizado aqui)
        $cep, 
        $endereco['logradouro'],  // Rua preenchida pelo ViaCEP
        $numero,                   // Número recebido do formulário
        $endereco['bairro'],       // Bairro preenchido pelo ViaCEP
        $endereco['localidade'],   // Cidade preenchida pelo ViaCEP
        $produto,
        $quantidade,
        $preco,
        $preco * $quantidade,      // Total (preço * quantidade)
        $formaPagamento,
        $total_produtos  
    );

    

    // Se necessário, aqui você pode salvar a venda no banco de dados usando o repositório
    $vendasRepositorio = new estoqueRepositorio($conn);
    $sucesso = $vendasRepositorio->cadastrar($estoque);

    if ($sucesso) {
        header("Location: ../visao/estoque.php");
    } else {
        echo "Erro ao cadastrar a venda.";
    }

}
?>