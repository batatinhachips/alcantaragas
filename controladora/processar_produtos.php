<?php
require '../repositorio/produtos_repositorio.php';
require './conexao.php';
require '../modelo/produtos.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $descricao = $_POST["descricao"];
    $preco = $_POST["preco"];

    // Verificar se um arquivo de imagem foi enviado
    if ($_FILES["imagem"]["error"] == 0) {
        // Diretório onde você deseja armazenar as imagens (ajuste conforme necessário)
        $diretorio_destino = "public_html/alcagas/recursos/imagens/";

        // Nome do arquivo da imagem
        $nome_arquivo = basename($_FILES["imagem"]["name"]);

        // Caminho completo do arquivo no servidor
        $caminho_completo = $diretorio_destino . $nome_arquivo;

        // Mover o arquivo para o diretório de destino
        if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $caminho_completo)) {
            $produto = new produto(0, $nome, $descricao, $nome_arquivo, $preco);

            $produtoRepositorio = new produtoRepositorio($conn);
            $produtoRepositorio->cadastrar($produto);

            header("Location: ../visao/cadastrar_produtos_sucesso.php");
        } else {
            echo "Erro ao fazer upload do arquivo.";
        }
    } else {
        echo "Por favor, selecione uma imagem.";
    }
}
?>