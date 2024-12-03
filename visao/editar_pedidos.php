<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <title>Editar Pedidos</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="../recursos/imagens/icon.png" rel="icon">
    <link rel="stylesheet" href="../recursos/css/pedidos.css">
    <link href="../recursos/css/bootstrap.min.css" rel="stylesheet">

</head>
<?php
include '../controladora/conexao.php';
include '../modelo/pedidos.php';
include '../repositorio/pedidos_repositorio.php';

$vendasRepositorio = new pedidosRepositorio($conn);
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
                    $idPedidos = $_POST["id"];
                    $sql = "SELECT * FROM pedidos WHERE idPedido = $idPedidos";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        $venda = $result->fetch_assoc();
                ?>
                        <form action="../controladora/processar_editar_pedidos.php" method="POST" style="margin-top: 10px;">


                            <td><input type="text" name="produto" value="<?= $venda["produto"] ?>" class="custom-input"></td>
                            <td><input type="text" name="quantidade" value="<?= $venda["quantidade"] ?>" class="custom-input"></td>
                            <td><input type="text" name="preco" value="<?= $venda["preco"] ?>" class="custom-input"></td>
                            <td><input type="text" name="total" value="<?= $venda["total"] ?>" class="custom-input"></td>
                            <td><input type="text" name="formaPagamento" value="<?= $venda["formaPagamento"] ?>" class="custom-input"></td>
                            <td><input type="text" name="cep" value="<?= $venda["cep"] ?>" class="custom-input"></td>
                            <td><input type="text" name="numero" value="<?= $venda["numero"] ?>" class="custom-input"></td>
                            <td>
                                <button type="submit" class="btn btn-primary btn-lg btn-block botao-salvar-edicoes">Salvar edições</button>

                        </form>
                        </td>
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

    <script src="../recursos/js/jquery-3.5.1.min.js"></script>
    <script src="../recursos/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</body>

</html>