<?php
require '../repositorio/produtos_repositorio.php';
require './conexao.php';
require '../modelo/produtos.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $descricao = $_POST["descricao"];
    $preco = $_POST["preco"];

    // Verificar se o preço é válido
    if (!is_numeric($preco) || $preco <= 0) {
        echo "Preço inválido. Por favor, insira um valor numérico válido.";
        exit();
    }

    // Verificar se um arquivo de imagem foi enviado e não houve erro
    if (isset($_FILES["imagem"]) && $_FILES["imagem"]["error"] == 0) {
        // Diretório onde as imagens serão armazenadas (ajuste conforme necessário)
        $diretorio_destino = "../recursos/imagens/";

        // Gerar um nome único para a imagem para evitar conflitos
        $nome_arquivo = uniqid() . '-' . basename($_FILES["imagem"]["name"]);

        // Caminho completo do arquivo no servidor
        $caminho_completo = $diretorio_destino . $nome_arquivo;

        // Verificar se o arquivo é realmente uma imagem
        $tipo_arquivo = mime_content_type($_FILES["imagem"]["tmp_name"]);
        if (strpos($tipo_arquivo, 'image') === false) {
            echo "O arquivo enviado não é uma imagem válida.";
            exit();
        }

        // Mover o arquivo para o diretório de destino
        if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $caminho_completo)) {
            // Criar o objeto produto
            $produto = new produto(0, $nome, $descricao, $nome_arquivo, $preco);

            // Instanciar o repositório e cadastrar o produto
            $produtoRepositorio = new produtoRepositorio($conn);
            $produtoRepositorio->cadastrar($produto);

            // Redirecionar para a página de sucesso
            header("Location: ../visao/cadastrar_produtos_sucesso.php");
        } else {
            echo "Erro ao fazer upload do arquivo.";
        }
    } else {
        echo "Por favor, selecione uma imagem.";
    }
}
?>
