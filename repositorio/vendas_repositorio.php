<?php
class estoqueRepositorio{
    private $conn; //Sua conexão com o banco de dados


    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function cadastrar(Estoque $venda)
{
    // Recuperando os dados do objeto Estoque
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

    // Inserção no banco de dados com endereço estruturado
    $sql = "INSERT INTO vendas (cep, rua, numero, bairro, cidade, produto, quantidade, preco, total, formaPagamento, total_produtos) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? )";

    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("ssssssdddss", 
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
        $total_produtos, 

    );

    // Executa a consulta preparada e verifica o sucesso
    $success = $stmt->execute();

    // Fecha a declaração
    $stmt->close();

    // Retorna um indicador de sucesso
    return $success;
}

public function buscarTodasVendas()
{
    $sql = "SELECT * FROM vendas ORDER BY preco asc";
    $result = $this->conn->query($sql);

    $vendas = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Criando o objeto Estoque com dados estruturados
            $venda = new Estoque(
                $row['id'],
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
                $row['total_produtos'],
            );
            $vendas[] = $venda;
        }
    }

    return $vendas;
}

public function somarTotais()
{
    $sql = "SELECT total FROM vendas";
    $result = $this->conn->query($sql);

    $totalGeral = 0; // Variável para armazenar o total de todas as vendas

    // Verifica se existem resultados e soma os totais
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Soma o valor do campo 'total' de cada venda
            $totalGeral += $row['total'];
        }
    }

    return $totalGeral; // Retorna a soma de todos os totais
}

public function listarVendasPorId($id)
{
    $sql = "SELECT * FROM vendas WHERE id = ?";

    // Prepara a declaração SQL
    $stmt = $this->conn->prepare($sql);

    // Vincula o parâmetro
    $stmt->bind_param('i', $id);

    // Executa a consulta preparada
    $stmt->execute();

    // Obtém os resultados
    $result = $stmt->get_result();

    $venda = null;

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Criando o objeto Estoque com dados estruturados
        $venda = new Estoque(
            $row['id'],
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
}

public function excluirVendasPorId($id)
{
    $sql = "DELETE FROM vendas WHERE id = ?";

    // Prepara a declaração SQL
    $stmt = $this->conn->prepare($sql);

    // Vincula o parâmetro
    $stmt->bind_param('i', $id);

    // Executa a consulta preparada
    $success = $stmt->execute();

    // Fecha a declaração
    $stmt->close();

    return $success;
}
}
