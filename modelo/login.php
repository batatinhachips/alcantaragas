<?php
class Usuario {
    private $conn;
    private $id;
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


    // Getters e Setters
    function get_nome() {
        return $this->nome;
    }
    function set_nome($nome) {
        $this->nome = $nome;
    }

    function get_email() {
        return $this->email;
    }
    function set_email($email) {
        $this->email = $email;
    }

    function get_senha() {
        return $this->senha;
    }
    function set_senha($senha) {
        $this->senha = $senha;
    }

    function get_papel() {
        return $this->papel;
    }
    function set_papel($papel) {
        $this->papel = $papel;
    }

    function get_cpf() {
        return $this->cpf;
    }
    function set_cpf($cpf) {
        $this->cpf = $cpf;
    }

    function get_telefone() {
        return $this->telefone;
    }
    function set_telefone($telefone) {
        $this->telefone = $telefone;
    }

    function get_cep() {
        return $this->cep;
    }
    function set_cep($cep) {
        $this->cep = $cep;
    }

    function get_logradouro() {
        return $this->logradouro;
    }
    function set_logradouro($logradouro) {
        $this->logradouro = $logradouro;
    }

    function get_complemento() {
        return $this->complemento;
    }
    function set_complemento($complemento) {
        $this->complemento = $complemento;
    }

    function get_numero() {
        return $this->numero;
    }
    function set_numero($numero) {
        $this->numero = $numero;
    }

    function get_bairro() {
        return $this->bairro;
    }
    function set_bairro($bairro) {
        $this->bairro = $bairro;
    }

    function get_cidade() {
        return $this->cidade;
    }
    function set_cidade($cidade) {
        $this->cidade = $cidade;
    }


    // Método para cadastrar cliente
    public function cadastrar($nome, $email, $senha, $papel, $cpf, $telefone, $cep, $logradouro, $complemento, $numero, $bairro, $cidade) {
        // Prepare a query para evitar SQL Injection
        $sql = "INSERT INTO usuario (nome, email, senha, papel, cpf, telefone, cep, logradouro, complemento, numero, bairro, cidade) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        
        // Execute a query e retorne verdadeiro se bem-sucedido
        return $stmt->execute([$nome, $email, $senha, $papel, $cpf, $telefone, $cep, $logradouro, $complemento, $numero, $bairro, $cidade]);
    }
}
?>
