<?php
class usuarioRepositorio{
    private $conn; //Sua conexão com o banco de dados


    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function cadastrar(usuario $usuario){
        $sql = "INSERT INTO usuario (nome, email, senha, papel) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssss",
            $usuario->get_nome(),
            $usuario->get_email(),
            $usuario->get_senha(),
            $usuario->get_papel()
        );
       // Executa a consulta preparada e verifica o sucesso
       $success = $stmt->execute();

       // Fecha a declaração
       $stmt->close();

       // Retorna um indicador de sucesso
       return $success;

    }

    /* public function buscarTodos()
    {
        $sql = "SELECT * FROM usuario ORDER BY papel asc";
        $result = $this->conn->query($sql);

        $usuarios = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $usuario = new usuario(
                    $row['id_usuario'],
                    $row['nome'],
                    $row['email'],
                    $row['senha'],
                    $row['papel']

                );
                $usuarios[] = $usuario;
            }
        }

        return $usuarios;
    }

    public function listarUsarioPorId($id)
    {
        $sql = "SELECT * FROM usuario WHERE id = '?'";

        // Prepara a declaração SQL
        $stmt = $this->conn->prepare($sql);

        // Vincula o parâmetro
        $stmt->bind_param('i', $id);

        // Executa a consulta preparada
        $stmt->execute();

        // Obtém os resultados
        $result = $stmt->get_result();

        $usuarios = null;

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            $usuario = new usuario(
                $row['id_usuario'],
                $row['nome'],
                $row['email'],
                $row['senha'],
                $row['papel']
            );
        }

        // Fecha a declaração
        $stmt->close();

        return $usuarios;
    }

    public function excluirUsuarioPorId($id)
    {
        $sql = "DELETE FROM usuario WHERE  
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
    } */
}
