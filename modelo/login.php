<?php
class Usuario {
    private $conn;

    function __construct($conn) {
        $this->conn = $conn;
    }

    // Método para cadastrar um usuário
    public function cadastrar($nome, $email, $senha, $papel, $cpf, $telefone, $cep, $logradouro, $complemento, $numero, $bairro, $cidade) {
        try {
            $sql = "INSERT INTO usuarios (nome, email, senha, papel, cpf, telefone, cep, logradouro, complemento, numero, bairro, cidade) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);

            if (!$stmt) {
                throw new Exception("Erro na preparação da consulta: " . $this->conn->error);
            }

            // Hash da senha
            $senhaHash = password_hash($senha, PASSWORD_BCRYPT);

            // Bind dos parâmetros (MySQLi usa bind_param com tipos de dados)
            $stmt->bind_param(
                'sssiiississs',
                $nome,
                $email,
                $senhaHash,
                $papel,
                $cpf,
                $telefone,
                $cep,
                $logradouro,
                $complemento,
                $numero,
                $bairro,
                $cidade
            );

            if (!$stmt->execute()) {
                throw new Exception("Erro ao executar consulta: " . $stmt->error);
            }

            return true;
        } catch (Exception $e) {
            // Registrar o erro e retornar a mensagem
            error_log($e->getMessage());
            return "Erro ao cadastrar usuário: " . $e->getMessage();
        }
    }

    // Método para cadastrar um administrador
    public function cadastrarAdm($nome, $email, $senha, $papel) {
        try {
            $sql = "INSERT INTO administradores (nome, email, senha, papel) VALUES (?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);

            if (!$stmt) {
                throw new Exception("Erro na preparação da consulta: " . $this->conn->error);
            }

            // Hash da senha
            $senhaHash = password_hash($senha, PASSWORD_BCRYPT);

            // Bind dos parâmetros
            $stmt->bind_param('ssss', $nome, $email, $senhaHash, $papel);

            if (!$stmt->execute()) {
                throw new Exception("Erro ao executar consulta: " . $stmt->error);
            }

            return true;
        } catch (Exception $e) {
            // Registrar o erro e retornar a mensagem
            error_log($e->getMessage());
            return "Erro ao cadastrar administrador: " . $e->getMessage();
        }
    }
}
?>
