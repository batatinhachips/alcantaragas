<?php
include '../controladora/conexao.php';
include '../modelo/estoque.php';
include '../repositorio/estoque_repositorio.php';

// Obter dados do formulário
$idProduto = $_POST['produto'];
$quantidade = $_POST['quantidade'];

// Criar objeto Estoque e salvar
$estoque = new Estoque($idProduto, $quantidade);
$estoqueRepositorio = new EstoqueRepositorio($conn);
$estoqueRepositorio->adicionar($estoque);

header("Location: ../visao/estoque.php");
exit();
