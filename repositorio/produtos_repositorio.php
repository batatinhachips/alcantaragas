<?php
class ProdutoRepositorio
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn; // Armazena a conexão com o banco de dados
    }

    // Método para cadastrar um novo produto
    public function cadastrar(Produto $produto)
    {
        $nome = $produto->getNome();
        $descricao = $produto->getDescricao();
        $precoProduto = $produto->getPrecoProduto();
        $imagem = $produto->getImagem();

        // Prepara a consulta SQL para inserir um novo produto
        $sql = "INSERT INTO produtos (nome, descricao, precoProduto, imagem) VALUES (?,?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssds", $nome, $descricao, $precoProduto, $imagem);

        $success = $stmt->execute();

        // Pega o ID do produto inserido
        $lastInsertId = $this->conn->insert_id;

        $stmt->close();

        // Retorna o ID do produto inserido, ou false se a operação falhar
        return $success ? $lastInsertId : false;
    }

    // Método para buscar todos os produtos ordenados por preço
    public function buscarTodos()
    {
        // Consulta SQL para retornar todos os produtos, ordenados por preço
        $sql = "SELECT * FROM produtos ORDER BY precoProduto asc";
        $result = $this->conn->query($sql);

        $produtos = array();

        // Verifica se a consulta retornou resultados e os adiciona ao array de produtos
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $produto = new Produto(
                    $row['idProduto'],
                    $row['nome'],
                    $row['descricao'],
                    $row['precoProduto'],
                    $row['imagem']
                );
                $produtos[] = $produto;
            }
        }

        return $produtos;
    }

    // Método para buscar um produto pelo seu ID
    public function listarProdutoPorId($idProduto)
    {
        $sql = "SELECT * FROM produtos WHERE idProduto = ?";

        $stmt = $this->conn->prepare($sql);

        // Vincula o parâmetro para o idProduto
        $stmt->bind_param('i', $idProduto);

        // Executa a consulta preparada
        $stmt->execute();

        // Obtém os resultados da consulta
        $result = $stmt->get_result();

        $produtos = null;

        // Verifica se o produto foi encontrado
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Cria um objeto Produto com os dados encontrados
            $produto = new Produto(
                $row['idProduto'],
                $row['nome'],
                $row['descricao'],
                $row['precoProduto'],
                $row['imagem']
            );
            // Atribui o produto encontrado
            $produtos = $produto;
        }

        $stmt->close();

        return $produtos;
    }

    // Método para excluir um produto pelo seu ID
    public function excluirProdutosPorId($idProduto)
    {
        // Prepara a consulta SQL para excluir um produto baseado no seu ID
        $sql = "DELETE FROM produtos WHERE idProduto = ?";

        // Prepara a declaração SQL
        $stmt = $this->conn->prepare($sql);

        // Vincula o parâmetro para o idProduto
        $stmt->bind_param('i', $idProduto);

        // Executa a consulta preparada
        $success = $stmt->execute();

        $stmt->close();

        return $success;
    }
}
