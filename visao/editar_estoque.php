<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../recursos/css/bootstrap.min.css" rel="stylesheet">
    <title>Controle de Vendas - Site de Gás</title>
    <script src="../recursos/js/jquery-3.5.1.min.js"></script>
    <script src="../recursos/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<?php
include '../controladora/conexao.php';
include '../modelo/vendas.php';
include '../repositorio/vendas_repositorio.php';

$vendasRepositorio = new estoqueRepositorio($conn);
$vendas = $vendasRepositorio->buscarTodasVendas();

?>

<body>
<div class="container mt-5">

    <table class="table mt-4" id="tabelaVendas">
        <thead>
            <tr>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Preço</th>
                <th>Total</th>
                <th>Forma de Pagamento</th>
                <th>Cep</th>
                <th>Numero</th>
                <th>Ações</th>
            </tr>

        </thead>
        <tbody>
            
        <?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
              $id = $_POST["id"];
              $sql = "SELECT * FROM vendas WHERE id = $id";
              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                $venda = $result->fetch_assoc();
            ?>
                <form action="../controladora/processar_editar_estoque.php" method="POST" style="margin-top: 10px;">
                <input type="hidden" name="id" value="<?= $venda["id"] ?>">
                
                <td><input type="text" name="produto" value="<?= $venda["produto"] ?>" class="custom-input"></td>
                <td><input type="text" name="quantidade" value="<?= $venda["quantidade"] ?>" class="custom-input"></td>
                <td><input type="text" name="preco" value="<?= $venda["preco"] ?>" class="custom-input"></td>
                <td><input type="text" name="total" value="<?= $venda["total"] ?>" class="custom-input"></td> 
                <td><input type="text" name="formaPagamento" value="<?= $venda["formaPagamento"] ?>" class="custom-input"></td>
                <td><input type="text" name="cep" value="<?= $venda["cep"] ?>" class="custom-input"></td>
                <td><input type="text" name="numero" value="<?= $venda["numero"] ?>" class="custom-input"></td>
                <td>
                    <button type="submit" class="btn btn-primary btn-lg btn-block botao-salvar-edicoes">Salvar edições</button>
                    
                </form></td>
            <?php
              } else {
                echo "Produto não encontrado";
              }
            }
            $conn->close(); ?>
        </tr> 

</tbody>
    </table>
</div>
</body>
</html>

