<?php
class Usuario {
    private $conn;
    private $nome;
    private $email;
    private $senha;
    private $papel;
    private $cpf;
    private $telefone;
    private $cep;
    private $logradouro;
    private $complemento;
    private $numero;
    private $bairro;
    private $cidade;

    function __construct($conn) {
        $this->conn = $conn;
    }

    // Getters e Setters...

    // Método para cadastrar um usuário
    public function cadastrar($nome, $email, $senha, $papel, $cpf, $telefone, $cep, $logradouro, $complemento, $numero, $bairro, $cidade) {
        // Inserir no banco de dados
        $sql = "INSERT INTO usuarios (nome, email, senha, papel, cpf, telefone, cep, logradouro, complemento, numero, bairro, cidade) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssssssssss", $nome, $email, $senha, $papel, $cpf, $telefone, $cep, $logradouro, $complemento, $numero, $bairro, $cidade);

        return $stmt->execute();
    }

    // Método para cadastrar um administrador
    public function cadastrarAdm($nome, $email, $senha, $papel) {
        // Inserir no banco de dados
        $sql = "INSERT INTO administradores (nome, email, senha, papel) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssss", $nome, $email, $senha, $papel);

        return $stmt->execute();
    }
}
?>
