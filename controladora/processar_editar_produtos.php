<?php
// Incluir o arquivo de conexão com o banco de dados
include '../controladora/conexao.php';
include '../modelo/produtos.php';
include '../repositorio/produtos_repositorio.php';

$produtosRepositorio = new produtoRepositorio($conn);
$produtos = $produtosRepositorio->buscarTodos();

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obter os dados do formulário
    $produto_id = $_POST["id"];
    $nome = $_POST["nome"];
    $descricao = $_POST["descricao"];
    $preco = $_POST["preco"];

    // Verificar se um novo arquivo foi enviado
    if ($_FILES["imagem"]["error"] == 0) {
        // Diretório onde você deseja armazenar as imagens (ajuste conforme necessário)
        $diretorio_destino = "../recursos/imagens/";

        // Nome do arquivo da imagem
        $nome_arquivo = basename($_FILES["imagem"]["name"]);

        // Caminho completo do arquivo no servidor
        $caminho_completo = $diretorio_destino . $nome_arquivo;

        // Mover o arquivo para o diretório de destino
        if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $caminho_completo)) {
            // Atualizar o nome do arquivo no banco de dados
            $sql_update_imagem = "UPDATE produtos SET imagem='$nome_arquivo' WHERE id=$produto_id";
            if ($conn->query($sql_update_imagem) !== TRUE) {
                echo "Erro ao atualizar o nome do arquivo no banco de dados: " . $conn->error;
                exit;
            }
        } else {
            echo "Erro ao fazer upload do arquivo.";
            exit;
        }
    }

    // Atualizar as informações do produto no banco de dados
    $sql = "UPDATE produtos SET 
                nome='$nome',
                descricao='$descricao',
                preco='$preco'
            WHERE id=$produto_id";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../visao/admin.php");
    } else {
        echo "Erro ao editar produto: " . $conn->error;
    }
}

// Não feche a conexão aqui, pois ela será utilizada em outros scripts
?>