<?php

// Inclua sua lógica para conectar ao banco de dados e configurar $treinosRepositorio

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifique se 'id' foi enviado via POST
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        // Realize a exclusão usando o seu repositório
        $excluirProduto = $produtosRepositorio->excluirProdutosPorId($id);

        // Adicione qualquer lógica adicional conforme necessário
    }
}

// Redirecione para a página inicial ou outra página apropriada
header('Location: admin.php');
exit();
?>


