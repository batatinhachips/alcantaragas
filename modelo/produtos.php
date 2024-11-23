<?php
class Produto {
    /* private $conn; //Sua conexão com o banco de dados */
    private  $idProduto;
    private  $nome;
    private  $descricao;
    private  $precoProduto;
    private  $imagem;
    


        public function __construct(
        $idProduto,
        $nome,
        $descricao,
        $precoProduto,
        $imagem

    )
    {
        $this->idProduto = $idProduto;
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->precoProduto = $precoProduto;
        $this->imagem = $imagem;
        
    }    


    public function getIdProduto()
    {
        return $this->idProduto;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setIdProduto($idProduto)
    {
        $this->idProduto = $idProduto;

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


    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * Set the value of descricao
     *
     * @return  self
     */ 
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;

        return $this;
    }


    public function getPrecoProduto()
    {
        return $this->precoProduto;
    }

    /**
     * Set the value of preco
     *
     * @return  self
     */ 
    public function setPrecoProduto($precoProduto)
    {
        $this->precoProduto = $precoProduto;

        return $this;
    }


    public function getImagem()
    {
        return $this->imagem;
    }
    public function getImagemDiretorio()
    {
        return "../recursos/img/".$this->imagem;
    }


    /**
     * Set the value of imagem
     *
     * @return  self
     */ 
    public function setImagem($imagem)
    {
        $this->imagem = $imagem;

        return $this;
    }

}

?>
