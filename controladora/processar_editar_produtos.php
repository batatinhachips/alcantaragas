<?php
// Incluir o arquivo de conexão com o banco de dados
include '../controladora/conexao.php';
include '../modelo/produtos.php';
include '../repositorio/produtos_repositorio.php';

// Criar uma instância do repositório de produtos
$produtosRepositorio = new produtoRepositorio($conn);
$produtos = $produtosRepositorio->buscarTodos();

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obter os dados do formulário
    $produto_id = $_POST["idProduto"];
    $nome = $_POST["nome"];
    $descricao = $_POST["descricao"];
    $precoProduto = $_POST["precoProduto"];

    // Verificar se um novo arquivo foi enviado
    if ($_FILES["imagem"]["error"] == 0) {
        // Diretório onde você deseja armazenar as imagens (ajuste conforme necessário)
        $diretorio_destino = "../recursos/imagens/";

        // Nome do arquivo da imagem
        $nome_arquivo = basename($_FILES["imagem"]["name"]);

        // Caminho completo do arquivo no servidor
        $caminho_completo = $diretorio_destino . $nome_arquivo;

        // Validar se o arquivo é uma imagem (apenas para maior segurança)
        $check = getimagesize($_FILES["imagem"]["tmp_name"]);
        if($check !== false) {
            // Mover o arquivo para o diretório de destino
            if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $caminho_completo)) {
                // Atualizar o nome do arquivo no banco de dados
                $sql_update_imagem = "UPDATE produtos SET imagem=? WHERE idProduto=?";
                $stmt = $conn->prepare($sql_update_imagem);
                $stmt->bind_param("si", $nome_arquivo, $produto_id);

                if ($stmt->execute()) {
                    $stmt->close();
                } else {
                    echo "Erro ao atualizar o nome do arquivo no banco de dados: " . $stmt->error;
                    exit;
                }
            } else {
                echo "Erro ao fazer upload do arquivo.";
                exit;
            }
        } else {
            echo "O arquivo não é uma imagem válida.";
            exit;
        }
    }

    // Atualizar as informações do produto no banco de dados
    $sql = "UPDATE produtos SET nome=?, descricao=?, precoProduto=? WHERE idProduto=?";
    $stmt = $conn->prepare($sql);

    // Verificar se a preparação da consulta foi bem-sucedida
    if ($stmt) {
        // Vincular os parâmetros
        $stmt->bind_param("ssdi", $nome, $descricao, $precoProduto, $produto_id);

        // Executar a consulta
        if ($stmt->execute()) {
            // Redirecionar após o sucesso
            header("Location: ../visao/admin.php");
            exit; // A execução do script é parada após o redirecionamento
        } else {
            echo "Erro ao editar produto: " . $stmt->error;
        }

        // Fechar a declaração
        $stmt->close();
    } else {
        echo "Erro na preparação da consulta: " . $conn->error;
    }
}
?>