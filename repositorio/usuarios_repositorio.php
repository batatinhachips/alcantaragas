<?php
class usuarioRepositorio{
    private $conn; //Sua conexão com o banco de dados


    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function cadastrar(Usuariosss $usuario){

        $nome = $usuario->getNome();
        $email = $usuario->getEmail();
        $senha = $usuario->getSenha();
        /* $papel = $usuario->getPapel(); */

        $sql = "INSERT INTO usuario (nome, email, senha) VALUES (?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssss",
            $nome,
            $email,
            $senha
    );
       // Executa a consulta preparada e verifica o sucesso
       $success = $stmt->execute();

       // Fecha a declaração
       $stmt->close();

       // Retorna um indicador de sucesso
       return $success;

    }

    public function buscarTodosUsuarios()
    {
        $sql = "SELECT * FROM usuario ORDER BY nome asc";
        $result = $this->conn->query($sql);

        $usuarios = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $usuario = new Usuariosss(
                    $row['id_usuario'],
                    $row['nome'],
                    $row['email'],
                    $row['senha']

                );
                $usuarios[] = $usuario;
            }
        }

        return $usuarios;
    }

    public function listarUsuarioPorId($id_usuario)
    {
        $sql = "SELECT * FROM usuario WHERE id_usuario = '?'";

        // Prepara a declaração SQL
        $stmt = $this->conn->prepare($sql);

        // Vincula o parâmetro
        $stmt->bind_param('i', $id_usuario);

        // Executa a consulta preparada
        $stmt->execute();

        // Obtém os resultados
        $result = $stmt->get_result();

        $usuarios = null;

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            $usuario = new Usuario(
                $row['id_usuario'],
                $row['nome'],
                $row['email'],
                $row['senha']
            );
        }

        // Fecha a declaração
        $stmt->close();

        return $usuarios;
    }

    public function excluirUsuariosPorId($id_usuario)
    {
        $sql = "DELETE FROM usuario WHERE  
             id_usuario = ?";

        // Prepara a declaração SQL
        $stmt = $this->conn->prepare($sql);

        // Vincula o parâmetro
        $stmt->bind_param('i', $id_usuario);

        // Executa a consulta preparada
        $success = $stmt->execute();

        // Fecha a declaração
        $stmt->close();

        return $success;
    }
}
