<?php
require('../recursos/fpdf/fpdf.php');
include '../controladora/conexao.php';
include '../repositorio/pedidos_repositorio.php';

$vendasRepositorio = new pedidosRepositorio($conn);
$vendas = $vendasRepositorio->buscarTodasVendas();

class PDF extends FPDF {
    function Header() {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'Relatório de Vendas', 0, 1, 'C');
        $this->Ln(5);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Página ' . $this->PageNo(), 0, 0, 'C');
    }
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 10);

// Cabeçalho da tabela
$pdf->Cell(20, 10, 'ID Venda', 1);
$pdf->Cell(50, 10, 'Produto', 1);
$pdf->Cell(20, 10, 'Qtd.', 1);
$pdf->Cell(30, 10, 'Preco (R$)', 1);
$pdf->Cell(30, 10, 'Total (R$)', 1);
$pdf->Cell(40, 10, 'Forma Pagto.', 1);
$pdf->Ln();

// Preenche os dados da tabela
foreach ($vendas as $venda) {
    $produtoNome = ''; // Nome do produto correspondente
    $produtoId = $venda->getProduto();
    foreach ($produtos as $produto) {
        if ($produto->getIdProduto() == $produtoId) {
            $produtoNome = $produto->getNome();
            break;
        }
    }

    $pdf->Cell(20, 10, $venda->getIdPedido(), 1);
    $pdf->Cell(50, 10, utf8_decode($produtoNome), 1);
    $pdf->Cell(20, 10, $venda->getQuantidade(), 1);
    $pdf->Cell(30, 10, number_format($venda->getPreco(), 2, ',', '.'), 1);
    $pdf->Cell(30, 10, number_format($venda->getTotal(), 2, ',', '.'), 1);
    $pdf->Cell(40, 10, $venda->getFormaPagamento(), 1);
    $pdf->Ln();
}

// Envia o PDF como resposta
header('Content-Type: application/pdf');
$pdf->Output('relatorio_vendas.pdf', 'I');
