<?php
include_once '../modelo/estoque.php';
class EstoqueRepositorio
{
    private $conn;

    // Construtor: recebe a conexão com o banco de dados e a armazena para uso nos métodos
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    // Método para listar todos os itens de estoque com o nome do produto associado
    public function listarTodos()
    {
        $sql = "SELECT e.*, p.nome AS nomeProduto FROM estoque e INNER JOIN produtos p ON e.idProduto = p.idProduto";
        $result = $this->conn->query($sql);  // Executa a consulta no banco

        $itens = [];
        while ($row = $result->fetch_assoc()) {
            // Para cada linha do resultado, cria um objeto Estoque e adiciona à lista
            $estoque = new Estoque();
            $estoque->setIdEstoque($row['idEstoque']);
            $estoque->setIdProduto($row['idProduto']);
            $estoque->setNomeProduto($row['nomeProduto']);
            $estoque->setQuantidade($row['quantidade']);
            $itens[] = $estoque;  // Adiciona o objeto na lista de itens
        }
        return $itens;  // Retorna a lista de itens de estoque
    }

    // Método para adicionar um novo item ao estoque
    public function adicionar(Estoque $estoque)
    {
        $sql = "INSERT INTO estoque (idProduto, quantidade) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);  // Prepara a query SQL
        $stmt->bind_param("ii", $estoque->getIdProduto(), $estoque->getQuantidade());  // Liga os parâmetros da query
        return $stmt->execute();  // Executa a query para adicionar o item ao estoque
    }

    // Método para atualizar a quantidade de um produto no estoque
    public function atualizarQuantidade($idEstoque, $quantidade)
    {
        $sql = "UPDATE estoque SET quantidade = ? WHERE idEstoque = ?";
        $stmt = $this->conn->prepare($sql);  // Prepara a query SQL
        $stmt->bind_param("ii", $quantidade, $idEstoque);  // Liga os parâmetros da query
        return $stmt->execute();  // Executa a query para atualizar a quantidade no estoque
    }

    // Método para excluir um item do estoque, dado o seu ID
    public function excluirEstoquePorId($idEstoque)
    {
        $sql = "DELETE FROM estoque WHERE idEstoque = ?";
        $stmt = $this->conn->prepare($sql);  // Prepara a query SQL
        $stmt->bind_param("i", $idEstoque);  // Liga o parâmetro da query
        return $stmt->execute();  // Executa a query para excluir o item do estoque
    }

    // Método para obter o estoque de um produto específico, dado o seu ID
    public function obterEstoquePorProduto($idProduto)
    {
        $sql = "SELECT * FROM estoque WHERE idProduto = ?";
        $stmt = $this->conn->prepare($sql);  // Prepara a query SQL
        $stmt->bind_param("i", $idProduto);  // Liga o parâmetro da query
        $stmt->execute();  // Executa a consulta
        $result = $stmt->get_result();  // Obtém o resultado da execução
        return $result->fetch_assoc();  // Retorna o estoque do produto (se existir)
    }

    // Método para atualizar a quantidade vendida de um produto no estoque
    public function atualizarQuantidadeVendida($idEstoque, $quantidadeVendida)
    {
        $sql = "UPDATE estoque SET qtdVendida = IFNULL(qtdVendida, 0) + ? WHERE idEstoque = ?";
        $stmt = $this->conn->prepare($sql);  // Prepara a query SQL
        $stmt->bind_param("ii", $quantidadeVendida, $idEstoque);  // Liga os parâmetros da query
        return $stmt->execute();  // Executa a query para atualizar a quantidade vendida
    }
}
