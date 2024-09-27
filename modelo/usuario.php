<?php
class Usuariosss {
    /* private $conn; //Sua conexão com o banco de dados */
    private $id_usuario;
    private $nome;
    private $email;
    private $senha;
    private $papel;
    private $data_cadastro;
    private $cpf;
    private $telefone;
    private $cep;
    private $logradouro;
    private $complemento;
    private $numero;
    private $bairro;
    private $cidade;
    
    public function __construct(
        $id_usuario,
        $nome,
        $email,
        $senha,
        $papel,
        $data_cadastro,
        $cpf,
        $telefone,
        $cep,
        $logradouro,
        $complemento,
        $numero,
        $bairro,
        $cidade
    ) {
        $this->id_usuario = $id_usuario;
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
        $this->papel = $papel;
        $this->data_cadastro = $data_cadastro;
        $this->cpf = $cpf;
        $this->telefone = $telefone;
        $this->cep = $cep;
        $this->logradouro = $logradouro;
        $this->complemento = $complemento;
        $this->numero = $numero;
        $this->bairro = $bairro;
        $this->cidade = $cidade;
    }

    public function getIdUsuario()
    {
        return $this->id_usuario;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setIdUsuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;

        return $this;
    }
    


    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     *
     * @return  self
     */ 
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }


    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of descricao
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }


    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * Set the value of preco
     *
     * @return  self
     */ 
    public function setSenha($senha)
    {
        $this->senha = $senha;

        return $this;
    }

    public function getPapel()
    {
        return $this->papel;
    }

    /**
     * Set the value of preco
     *
     * @return  self
     */ 
    public function setPapel($papel)
    {
        $this->papel = $papel;

        return $this;
    }

    public function getDataCadastro()
    {
        return $this->data_cadastro;
    }

    /**
     * Set the value of data_cadastro
     *
     * @return  self
     */ 
    public function setDataCadastro($data_cadastro)
    {
        $this->data_cadastro = $data_cadastro;

        return $this;
    }

    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * Set the value of cpf
     *
     * @return  self
     */ 
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;

        return $this;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    /**
     * Set the value of telefone
     *
     * @return  self
     */ 
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;

        return $this;
    }

    public function getCep()
    {
        return $this->cep;
    }

    /**
     * Set the value of cep
     *
     * @return  self
     */ 
    public function setCep($cep)
    {
        $this->cep = $cep;

        return $this;
    }

    public function getLogradouro()
    {
        return $this->logradouro;
    }

    /**
     * Set the value of logradouro
     *
     * @return  self
     */ 
    public function setLogradouro($logradouro)
    {
        $this->logradouro = $logradouro;

        return $this;
    }

    public function getComplemento()
    {
        return $this->complemento;
    }

    /**
     * Set the value of complemento
     *
     * @return  self
     */ 
    public function setComplemento($complemento)
    {
        $this->complemento = $complemento;

        return $this;
    }

    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set the value of numero
     *
     * @return  self
     */ 
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    public function getBairro()
    {
        return $this->bairro;
    }

    /**
     * Set the value of bairro
     *
     * @return  self
     */ 
    public function setBairro($bairro)
    {
        $this->bairro = $bairro;

        return $this;
    }

    public function getCidade()
    {
        return $this->cidade;
    }

    /**
     * Set the value of cidade
     *
     * @return  self
     */ 
    public function setCidade($cidade)
    {
        $this->cidade = $cidade;

        return $this;
    }

}

?>
