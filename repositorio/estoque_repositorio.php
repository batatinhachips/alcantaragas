<?php
include_once '../modelo/estoque.php';
class EstoqueRepositorio {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function listarTodos() {
        $sql = "SELECT e.*, p.nome AS nomeProduto FROM estoque e INNER JOIN produtos p ON e.idProduto = p.idProduto";
        $result = $this->conn->query($sql);

        $itens = [];
        while ($row = $result->fetch_assoc()) {
            $estoque = new Estoque();
            $estoque->setIdEstoque($row['idEstoque']);
            $estoque->setIdProduto($row['idProduto']);
            $estoque->setNomeProduto($row['nomeProduto']); // Adiciona nome do produto
            $estoque->setQuantidade($row['quantidade']);
            $itens[] = $estoque;
        }
        return $itens;
    }

    public function adicionar(Estoque $estoque) {
        $sql = "INSERT INTO estoque (idProduto, quantidade) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $estoque->getIdProduto(), $estoque->getQuantidade());
        return $stmt->execute();
    }

    public function atualizarQuantidade($idEstoque, $quantidade) {
        $sql = "UPDATE estoque SET quantidade = ? WHERE idEstoque = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $quantidade, $idEstoque);
        return $stmt->execute();
    }
    
    public function excluirEstoquePorId($idEstoque) {
        $sql = "DELETE FROM estoque WHERE idEstoque = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $idEstoque);
        return $stmt->execute();
    }
    
    public function obterEstoquePorProduto($idProduto) {
        $sql = "SELECT * FROM estoque WHERE idProduto = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $idProduto);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc(); // Retorna uma única linha
    }
    
    public function atualizarQuantidadeVendida($idEstoque, $quantidadeVendida) {
        $sql = "UPDATE estoque SET qtdVendida = IFNULL(qtdVendida, 0) + ? WHERE idEstoque = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $quantidadeVendida, $idEstoque);
        return $stmt->execute();
    }
    
}
?>
