<?php
// Incluir o arquivo de conexão com o banco de dados
include '../controladora/conexao.php';
include '../modelo/pedidos.php';
include '../repositorio/pedidos_repositorio.php';


$vendasRepositorio = new pedidosRepositorio($conn);
$vendas = $vendasRepositorio->buscarTodasVendas();

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obter os dados do formulário
    $produto = $_POST["produto"] ?? null;
    $quantidade = (float) ($_POST["quantidade"] ?? 0);
    $preco = (float) ($_POST["preco"] ?? 0);
    $total = (float) ($_POST["total"] ?? 0);
    $formaPagamento = $_POST["formaPagamento"] ?? null;
    $cep = $_POST['cep'];
    $numero = $_POST['numero'];
    $idPedido = $_POST["idPedido"] ?? null; // Certifique-se de que você tem um ID para atualizar

// Atualizar as informações do produto no banco de dados
$stmt = $conn->prepare("UPDATE pedidos SET produto=?, quantidade=?, preco=?, total=?, formaPagamento=?, cep=?, numero=? WHERE idPedido=?");
$stmt->bind_param("sidssssi", $produto, $quantidade, $preco, $total, $formaPagamento, $cep, $numero, $id);

if ($stmt->execute()) {
    header("Location: ../visao/pedidos.php");
    exit; // Adiciona um exit após o redirecionamento
} else {
    echo "Erro ao editar venda: " . $stmt->error; // Use o método de erro do statement
}

$stmt->close(); // Não esqueça de fechar a declaração
}

// Não feche a conexão aqui, pois ela será utilizada em outros scripts
?>
