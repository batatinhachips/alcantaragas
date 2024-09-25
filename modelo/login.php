<?php
class Usuario {
    private $conn;

    function __construct($conn) {
        $this->conn = $conn;
    }

    // Método para cadastrar um usuário
    public function cadastrar($nome, $email, $senha, $papel, $cpf, $telefone, $cep, $logradouro, $complemento, $numero, $bairro, $cidade) {
        $sql = "INSERT INTO usuarios (nome, email, senha, papel, cpf, telefone, cep, logradouro, complemento, numero, bairro, cidade) VALUES (:nome, :email, :senha, :papel, :cpf, :telefone, :cep, :logradouro, :complemento, :numero, :bairro, :cidade)";
        $stmt = $this->conn->prepare($sql);

        // Hash da senha
        $senhaHash = password_hash($senha, PASSWORD_BCRYPT);

        // Bind dos parâmetros
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senhaHash);
        $stmt->bindParam(':papel', $papel);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':cep', $cep);
        $stmt->bindParam(':logradouro', $logradouro);
        $stmt->bindParam(':complemento', $complemento);
        $stmt->bindParam(':numero', $numero);
        $stmt->bindParam(':bairro', $bairro);
        $stmt->bindParam(':cidade', $cidade);

        return $stmt->execute();
    }

    // Método para cadastrar um administrador
    public function cadastrarAdm($nome, $email, $senha, $papel) {
        $sql = "INSERT INTO administradores (nome, email, senha, papel) VALUES (:nome, :email, :senha, :papel)";
        $stmt = $this->conn->prepare($sql);
        
        // Hash da senha
        $senhaHash = password_hash($senha, PASSWORD_BCRYPT);

        // Bind dos parâmetros
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senhaHash);
        $stmt->bindParam(':papel', $papel);

        return $stmt->execute();
    }
}
?>
