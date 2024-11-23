<?php
class Estoque {
    private $idEstoque;
    private $idProduto;
    private $nomeProduto;
    private $quantidade;
    private $qtdVendida;

    // Construtor para inicializar os valores
    public function __construct($idProduto = null, $quantidade = 0, $qtdVendida = null) {
        $this->idProduto = $idProduto;
        $this->quantidade = $quantidade;
        $this->qtdVendida = $qtdVendida;
    }

    // Getters e Setters
    public function getIdEstoque() {
        return $this->idEstoque;
    }

    public function setIdEstoque($idEstoque) {
        $this->idEstoque = $idEstoque;
    }

    public function getIdProduto() {
        return $this->idProduto;
    }

    public function setIdProduto($idProduto) {
        $this->idProduto = $idProduto;
    }

    public function getNomeProduto() {
        return $this->nomeProduto;
    }

    public function setNomeProduto($nomeProduto) {
        $this->nomeProduto = $nomeProduto;
    }

    public function getQuantidade() {
        return $this->quantidade;
    }

    public function setQuantidade($quantidade) {
        $this->quantidade = $quantidade;
    }

    public function getQtdVendida() {
        return $this->qtdVendida;
    }

    public function setQtdVendida($qtdVendida) {
        $this->qtdVendida = $qtdVendida;
    }
}
?>
