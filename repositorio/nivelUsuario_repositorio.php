<?php

class NivelUsuarioRepositorio
{
    private $conn;

    // Construtor que recebe e armazena a conexão com o banco de dados
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    // Cadastrar um novo nível de usuário
    public function cadastrar(NivelUsuario $nivelUsuario)
    {
        // Prepara a query para inserir um novo nível na tabela 'nivelUsuarios'
        $sql = "INSERT INTO nivelUsuarios (nivel) VALUES (?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $nivelUsuario->getNivel());  // Bind do parâmetro 'nivel'
        return $stmt->execute();  // Executa a query e retorna se foi bem-sucedido
    }

    // Buscar todos os níveis de usuário
    public function buscarTodos()
    {
        // Consulta SQL para selecionar todos os níveis de usuário
        $sql = "SELECT * FROM nivelUsuarios";
        $result = $this->conn->query($sql);

        // Cria um array para armazenar os níveis
        $niveis = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Cria um objeto NivelUsuario para cada linha de resultado e adiciona ao array
                $niveis[] = new NivelUsuario($row['idNivelUsuario'], $row['nivel']);
            }
        }
        return $niveis;  // Retorna a lista de níveis encontrados
    }

    // Buscar nível de usuário por ID
    public function buscarPorId($idNivelUsuario)
    {
        // Consulta SQL para buscar um nível pelo ID
        $sql = "SELECT * FROM nivelUsuarios WHERE idNivelUsuario = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $idNivelUsuario);  // Bind do parâmetro 'idNivelUsuario'
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return new NivelUsuario($row['idNivelUsuario'], $row['nivel']);  // Retorna o nível encontrado
        }
        return null;  // Retorna null caso não encontre o nível
    }

    // Atualizar um nível de usuário existente
    public function atualizar(NivelUsuario $nivelUsuario)
    {
        // Consulta SQL para atualizar o nível de usuário
        $sql = "UPDATE nivelUsuarios SET nivel = ? WHERE idNivelUsuario = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $nivelUsuario->getNivel(), $nivelUsuario->getIdNivelUsuario());  // Bind dos parâmetros
        return $stmt->execute();  // Executa a query e retorna o resultado
    }

    // Excluir um nível de usuário pelo ID
    public function excluir($idNivelUsuario)
    {
        // Consulta SQL para excluir um nível pelo ID
        $sql = "DELETE FROM nivelUsuarios WHERE idNivelUsuario = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $idNivelUsuario);  // Bind do parâmetro 'idNivelUsuario'
        return $stmt->execute();  // Executa a query e retorna se foi bem-sucedido
    }
}
