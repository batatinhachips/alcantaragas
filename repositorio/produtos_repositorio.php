

<?php
class produtoRepositorio{
    private $conn; //Sua conexão com o banco de dados


    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function cadastrar(Produto $produto)
    {
        $nome = $produto->getNome();
        $descricao = $produto->getDescricao();
        $precoProduto = $produto->getPrecoProduto();
        $imagem = $produto->getImagem();
    
        $sql = "INSERT INTO produtos (nome, descricao, precoProduto, imagem) VALUES (?,?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssds", $nome, $descricao, $precoProduto, $imagem);
    
        // Executa a consulta preparada e verifica o sucesso
        $success = $stmt->execute();
    
        // Pega o ID do produto inserido
        $lastInsertId = $this->conn->insert_id;
    
        // Fecha a declaração
        $stmt->close();
    
        // Retorna o ID do produto inserido (ou false caso falhe)
        return $success ? $lastInsertId : false;
    }
    public function buscarTodos()
    {
        $sql = "SELECT * FROM produtos ORDER BY precoProduto asc";
        $result = $this->conn->query($sql);

        $produtos = array();

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

    public function listarProdutoPorId($idProduto)
    {
        $sql = "SELECT * FROM produtos WHERE idProduto = '?'";

        // Prepara a declaração SQL
        $stmt = $this->conn->prepare($sql);

        // Vincula o parâmetro
        $stmt->bind_param('i', $idProduto);

        // Executa a consulta preparada
        $stmt->execute();

        // Obtém os resultados
        $result = $stmt->get_result();

        $produtos = null;

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            $produto = new Produto(
                $row['idProduto'],
                $row['nome'],
                $row['descricao'],
                $row['precoProduto'], 
                $row['imagem']
                
            );
        }

        // Fecha a declaração
        $stmt->close();

        return $produtos;
    }

    public function excluirProdutosPorId($idProduto)
    {
        $sql = "DELETE FROM produtos WHERE  
             idProduto = ?";

        // Prepara a declaração SQL
        $stmt = $this->conn->prepare($sql);

        // Vincula o parâmetro
        $stmt->bind_param('i', $idProduto);

        // Executa a consulta preparada
        $success = $stmt->execute();

        // Fecha a declaração
        $stmt->close();

        return $success;
    }
}
