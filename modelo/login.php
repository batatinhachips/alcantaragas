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
}
?>


    if($papel !== "admin") {
        //cadastrar admin
        if ($usuario->cadastrar($nome, $email, $senha_hash, $papel, $cpf, $telefone, $cep, $logradouro, $complemento, $numero, $bairro, $cidade)) {
            // Redirecionar para a página de sucesso após o cadastro
            header("Location: ../visao/cadastrarcliente_sucesso.php");
            exit();
        } else {
            echo "Erro ao cadastrar. Tente novamente.";
        }
    } else {
         // Cadastrar o usuário
        if ($usuario->cadastrarAdm($nome, $email, $senha, $papel)) {
            // Redirecionar para a página de sucesso após o cadastro
            header("Location: ../visao/cadastrarcliente_sucesso.php");
            exit();
        } else {
            echo "Erro ao cadastrar. Tente novamente.";
        }
    }

}
?>
