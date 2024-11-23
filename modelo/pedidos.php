
<?php
class Pedidos {
    private $idPedido;
    private $idUsuario;
    private $idProduto;
    private $cep;
    private $rua;
    private $numero;
    private $bairro;
    private $cidade;
    private $produto;
    private $quantidade;
    private $preco;
    private $total;
    private $formaPagamento;
    private $total_produtos;

    public function __construct(
        $idPedido,
        $idUsuario,
        $idProduto,
        $cep, 
        $rua, 
        $numero, 
        $bairro, 
        $cidade,
        $produto,
        $quantidade,
        $preco,
        $total,
        $formaPagamento,
        $total_produtos,
    
    {
        $this->idPedido = $idPedido;
        $this->idUsuario = $idUsuario;
        $this->idProduto = $idProduto;
        $this->cep = $cep;
        $this->rua = $rua;
        $this->numero = $numero;
        $this->bairro = $bairro;
        $this->cidade = $cidade;
        $this->produto = $produto;
        $this->quantidade = $quantidade;
        $this->preco = $preco;
        $this->total = $total;
        $this->formaPagamento = $formaPagamento;
        $this->total_produtos = $total_produtos;
        
        // Preenche o endereço com base no CEP, caso o CEP esteja presente
        if ($this->cep) {
            $this->preencherEndereco();
        }
    }

    // Método para preencher o endereço a partir do CEP
    private function preencherEndereco() {
        $cep = preg_replace('/[^0-9]/', '', $this->cep); // Remove caracteres não numéricos do CEP
        if (strlen($cep) == 8) { // Verifica se o CEP tem 8 caracteres
            $url = "https://viacep.com.br/ws/{$cep}/json/";
            $json = file_get_contents($url);
            $data = json_decode($json, true);

            if (isset($data['logradouro'])) {
                $this->rua = $data['logradouro'];
                $this->bairro = $data['bairro'];
                $this->cidade = $data['localidade'];
            } else {
                $this->rua = '';
                $this->bairro = '';
                $this->cidade = '';
            }
        } else {
            // Caso o CEP seja inválido, limpa os campos
            $this->rua = '';
            $this->bairro = '';
            $this->cidade = '';
        }
    }

    public function getIdPedido() {
        return $this->idPedido;
    }
    public function setIdPedido($idPedido) {
        $this->idPedido = $idPedido;
    }

    public function getIdUsuario() {
        return $this->idUsuario;
    }
    public function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    public function getIdProduto() {
        return $this->idProduto;
    }
    public function setIdProduto($idProduto) {
        $this->idProduto = $idProduto;
    }

    public function getCep() {
        return $this->cep;
    }

    public function setCep($cep) {
        $this->cep = $cep;
        $this->preencherEndereco(); // Repreenche o endereço sempre que o CEP for alterado
    }

    public function getRua() {
        return $this->rua;
    }

    public function setRua($rua) {
        $this->rua = $rua;
    }

    public function getNumero() {
        return $this->numero;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
    }

    public function getBairro() {
        return $this->bairro;
    }

    public function setBairro($bairro) {
        $this->bairro = $bairro;
    }

    public function getCidade() {
        return $this->cidade;
    }

    public function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    public function getProduto() {
        return $this->produto;
    }

    public function setProduto($produto) {
        $this->produto = $produto;
    }

    public function getQuantidade() {
        return $this->quantidade;
    }

    public function setQuantidade($quantidade) {
        $this->quantidade = $quantidade;
    }

    public function getPreco() {
        return $this->preco;
    }

    public function setPreco($preco) {
        $this->preco = $preco;
    }

    public function getTotal() {
        return $this->total;
    }

    public function setTotal($total) {
        $this->total = $total;
    }

    public function getFormaPagamento() {
        return $this->formaPagamento;
    }

    public function setFormaPagamento($formaPagamento) {
        $this->formaPagamento = $formaPagamento;
    }

    public function getTotalProdutos() {
        return $this->total_produtos;
    }

    public function setTotalProdutos($total_produtos) {
        $this->total_produtos = $total_produtos;
    }
}
?>
