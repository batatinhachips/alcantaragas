<?php
class produtoRepositorio{
    private $conn; //Sua conexão com o banco de dados


    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function cadastrar(produto $produto){
        $sql = "INSERT INTO produtos (nome, descricao, imagem, preco) VALUES (?,?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssss",
            $produto->getNome(),
            $produto->getDescricao(),
            $produto->getImagem(),
            $produto->getPreco(),
    );
       // Executa a consulta preparada e verifica o sucesso
       $success = $stmt->execute();

       // Fecha a declaração
       $stmt->close();

       // Retorna um indicador de sucesso
       return $success;

    }

    public function buscarTodos()
    {
        $sql = "SELECT * FROM produtos ORDER BY preco asc";
        $result = $this->conn->query($sql);

        $produtos = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $produto = new produto(
                    $row['id'],
                    $row['nome'],
                    $row['descricao'],
                    $row['imagem'],
                    $row['preco'],

                );
                $produtos[] = $produto;
            }
        }

        return $produtos;
    }

    public function listarProdutoPorId($id)
    {
        $sql = "SELECT * FROM produtos WHERE id = '?'";

        // Prepara a declaração SQL
        $stmt = $this->conn->prepare($sql);

        // Vincula o parâmetro
        $stmt->bind_param('i', $id);

        // Executa a consulta preparada
        $stmt->execute();

        // Obtém os resultados
        $result = $stmt->get_result();

        $produtos = null;

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            $produto = new Produto(
                $row['id'],
                $row['nome'],
                $row['descricao'],
                $row['imagem'],
                $row['preco']
            );
        }

        // Fecha a declaração
        $stmt->close();

        return $produtos;
    }

    public function excluirProdutosPorId($id)
    {
        $sql = "DELETE FROM produtos WHERE  
             id = ?";

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