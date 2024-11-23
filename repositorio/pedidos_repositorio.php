<?php
class PedidosRepositorio {
    private $conn; // Conexão com o banco de dados

    // Construtor para injetar a conexão com o banco de dados
    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Método para cadastrar um novo pedido
    public function cadastrar(Pedidos $venda) {
        // Recuperando dados do objeto Pedido
        $cep = $venda->getCep();
        $rua = $venda->getRua();
        $numero = $venda->getNumero();
        $bairro = $venda->getBairro();
        $cidade = $venda->getCidade();
        $produto = $venda->getProduto();
        $quantidade = $venda->getQuantidade();
        $preco = $venda->getPreco();
        $total = $venda->getTotal();
        $formaPagamento = $venda->getFormaPagamento();
        $total_produtos = $venda->getTotalProdutos();

        // Query para inserir o pedido
        $sql = "INSERT INTO pedidos (cep, rua, numero, bairro, cidade, produto, quantidade, preco, total, formaPagamento, total_produtos) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // Usando prepare para proteger contra SQL injection
        if ($stmt = $this->conn->prepare($sql)) {
            // Vinculando os parâmetros
            $stmt->bind_param("ssssssiddss", 
                $cep, 
                $rua, 
                $numero, 
                $bairro, 
                $cidade, 
                $produto, 
                $quantidade, 
                $preco, 
                $total, 
                $formaPagamento, 
                $total_produtos
            );

            // Executa a query e verifica se a operação foi bem-sucedida
            $success = $stmt->execute();

            // Fecha a declaração
            $stmt->close();

            return $success;
        } else {
            // Se houver erro na preparação da query
            throw new Exception("Erro ao preparar a query: " . $this->conn->error);
        }
    }

    
    // Método para buscar todas as vendas
    public function buscarTodasVendas() {
        $sql = "SELECT * FROM pedidos ORDER BY preco ASC";
        $result = $this->conn->query($sql);
        $vendas = [];

        // Verificando se existem resultados
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $venda = new Pedidos(
                    $row['idPedido'],
                    $row['idUsuario'],
                    $row['idProduto'],
                    $row["cep"],
                    $row["rua"],
                    $row['numero'],
                    $row['bairro'],
                    $row['cidade'],
                    $row['produto'],
                    $row['quantidade'],
                    $row['preco'],
                    $row['total'],
                    $row['formaPagamento'],
                    $row['total_produtos']
                );
                $vendas[] = $venda;
            }
        }

        return $vendas;
    }

    // Método para somar os totais de todos os pedidos
    public function somarTotais() {
        $sql = "SELECT total FROM pedidos";
        $result = $this->conn->query($sql);
        $totalGeral = 0;

        // Soma todos os totais
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $totalGeral += $row['total'];
            }
        }

        return $totalGeral;
    }

    // Método para buscar um pedido por ID
    public function listarVendasPorId($idPedido) {
        $sql = "SELECT * FROM pedidos WHERE idPedido = ?";

        if ($stmt = $this->conn->prepare($sql)) {
            // Vincula o parâmetro
            $stmt->bind_param('i', $idPedido);
            
            // Executa a consulta preparada
            $stmt->execute();
            $result = $stmt->get_result();

            $venda = null;

            // Verifica se o pedido foi encontrado
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $venda = new Pedidos(
                    $row['idPedido'],
                    $row['idUsuario'],
                    $row['idProduto'],
                    $row["cep"],
                    $row["rua"],
                    $row['numero'],
                    $row['bairro'],
                    $row['cidade'],
                    $row['produto'],
                    $row['quantidade'],
                    $row['preco'],
                    $row['total'],
                    $row['formaPagamento'],
                    $row['total_produtos']
                );
            }

            // Fecha a declaração
            $stmt->close();

            return $venda;
        } else {
            throw new Exception("Erro ao preparar a consulta: " . $this->conn->error);
        }
    }
    public function atualizarTotalProdutos($idProduto, $quantidadeVendida) {
        // Atualiza a quantidade vendida de um produto
        $sql = "UPDATE produtos SET total_vendidos = total_vendidos + ? WHERE idProduto = ?";

        // Prepara a query
        if ($stmt = $this->conn->prepare($sql)) {
            // Vincula os parâmetros
            $stmt->bind_param("ii", $quantidadeVendida, $idProduto);

            // Executa a query
            $stmt->execute();
            $stmt->close();
        } else {
            throw new Exception("Erro ao preparar a consulta de atualização: " . $this->conn->error);
        }
    }
    
    
    // Método para excluir um pedido por ID
    public function excluirVendasPorId($idPedido) {
        $sql = "DELETE FROM pedidos WHERE idPedido = ?";

        if ($stmt = $this->conn->prepare($sql)) {
            // Vincula o parâmetro
            $stmt->bind_param('i', $idPedido);
            
            // Executa a consulta
            $success = $stmt->execute();

            // Fecha a declaração
            $stmt->close();

            return $success;
        } else {
            throw new Exception("Erro ao preparar a consulta de exclusão: " . $this->conn->error);
        }
    }
}
?>