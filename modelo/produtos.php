<?php
class Produto
{

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

    ) {
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


    public function setIdProduto($idProduto)
    {
        $this->idProduto = $idProduto;

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


    public function getDescricao()
    {
        return $this->descricao;
    }


    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;

        return $this;
    }


    public function getPrecoProduto()
    {
        return $this->precoProduto;
    }


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
        return "../recursos/img/" . $this->imagem;
    }



    public function setImagem($imagem)
    {
        $this->imagem = $imagem;

        return $this;
    }
}
