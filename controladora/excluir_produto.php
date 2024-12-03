<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se 'id' foi enviado via POST
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        // Realiza a exclusão usando o seu repositório
        $excluirProduto = $produtosRepositorio->excluirProdutosPorId($id);
    }
}

header('Location: admin.php');
exit();
