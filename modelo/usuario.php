<?php
class Usuariosss {
    /* private $conn; //Sua conexão com o banco de dados */
    private  $id_usuario;
    private  $nome;
    private  $email;
    private  $senha;


        public function __construct(
        $id_usuario,
        $nome,
        $email,
        $senha,

    )
    {
        $this->id_usuario = $id_usuario;
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
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

}

?>
