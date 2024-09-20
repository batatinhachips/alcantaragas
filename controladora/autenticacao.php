<?php
class autenticacao {
    private $conexao;

    public function __construct($conexao) {
        $this->conexao = $conexao;
    }

    public function verificarUsuario($email, $senha) {
        // Consulta para obter todos os campos do usuário, incluindo o papel
        $query = "SELECT * FROM usuario WHERE email = ?";
        $stmt = $this->conexao->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $usuario = $result->fetch_assoc();
            if (password_verify($senha, $usuario['senha'])) {
                return $usuario; // Retorna todos os dados do usuário
            } 
        }

        return false;
    }
}
?>