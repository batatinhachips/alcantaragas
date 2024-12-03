<?php
class Usuariosss
{

    private $idUsuario;
    private $nome;
    private $email;
    private $senha;
    private $idNivelUsuario;
    private $cpf;
    private $telefone;
    private $cep;
    private $logradouro;
    private $complemento;
    private $numero;
    private $bairro;
    private $cidade;

    public function __construct(
        $idUsuario,
        $nome,
        $email,
        $senha,
        $idNivelUsuario,
        $cpf,
        $telefone,
        $cep,
        $logradouro,
        $complemento,
        $numero,
        $bairro,
        $cidade
    ) {
        $this->idUsuario = $idUsuario;
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
        $this->idNivelUsuario = $idNivelUsuario;
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
        return $this->idUsuario;
    }


    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }



    public function getNome()
    {
        return $this->nome;
    }


    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }


    public function getEmail()
    {
        return $this->email;
    }


    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }


    public function getSenha()
    {
        return $this->senha;
    }


    public function setSenha($senha)
    {
        $this->senha = $senha;

        return $this;
    }

    public function getIdNivelUsuario()
    {
        return $this->idNivelUsuario;
    }


    public function setIdNivelUsuario($idNivelUsuario)
    {
        $this->idNivelUsuario = $idNivelUsuario;

        return $this;
    }

    public function getCpf()
    {
        return $this->cpf;
    }


    public function setCpf($cpf)
    {
        $this->cpf = $cpf;

        return $this;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }


    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;

        return $this;
    }

    public function getCep()
    {
        return $this->cep;
    }


    public function setCep($cep)
    {
        $this->cep = $cep;

        return $this;
    }

    public function getLogradouro()
    {
        return $this->logradouro;
    }


    public function setLogradouro($logradouro)
    {
        $this->logradouro = $logradouro;

        return $this;
    }

    public function getComplemento()
    {
        return $this->complemento;
    }

    public function setComplemento($complemento)
    {
        $this->complemento = $complemento;

        return $this;
    }

    public function getNumero()
    {
        return $this->numero;
    }


    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    public function getBairro()
    {
        return $this->bairro;
    }


    public function setBairro($bairro)
    {
        $this->bairro = $bairro;

        return $this;
    }

    public function getCidade()
    {
        return $this->cidade;
    }


    public function setCidade($cidade)
    {
        $this->cidade = $cidade;

        return $this;
    }
}
