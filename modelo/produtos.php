<?php
class produto {
    /* private $conn; //Sua conexão com o banco de dados */
    private  $id;
    private  $nome;
    private  $descricao;
    private  $preco;
    private  $imagem;

    /* public funciton __construct($conn) {
        $this->conn = $conn;
    } 

    public function listarProdutos(){
        $sql = "SELECT * FROM cafe";
        $result = $this->conn->query($sql);
    
    $produtos = array();

    if ($result->num_rows > 0){
        while ($row = $result->fetch_assoc()){
            $produtos[]= $row;
        }
    }
    return $produtos;
}
*/


    public function __construct(
       $id,
        $nome,
        $descricao,
        $imagem = "logo.png",
        $preco)

    {
        $this->id = $id;
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->imagem = $imagem;
        $this->preco = $preco;
    }    


    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

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


    public function getPreco()
    {
        return $this->preco;
    }

    /**
     * Set the value of preco
     *
     * @return  self
     */ 
    public function setPreco($preco)
    {
        $this->preco = $preco;

        return $this;
    }


    public function getImagem()
    {
        return $this->imagem;
    }
    public function getImagemDiretorio(): string
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