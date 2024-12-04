<!DOCTYPE html>
<html lang="pt-BR">
<?php
session_start(); 

// Verifica se o usuário está autenticado
if (!isset($_SESSION['usuario']) || $_SESSION['idNivelUsuario'] != 2) {
    // Se não estiver logado ou se não for admin, redireciona para a página de login ou uma página de erro
    header("Location: formLogin.php"); // ou qualquer outra página desejada
    exit();
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../recursos/css/bootstrap.min.css" rel="stylesheet">
    <title>Controle de Vendas</title>
    <link rel="stylesheet" href="../recursos/css/pedidos.css">
    <link href="../recursos/imagens/icon.png" rel="icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="../recursos/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
</head>

<body>
    <?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    include '../controladora/conexao.php';
    include '../modelo/pedidos.php';
    include '../repositorio/pedidos_repositorio.php';
    include "../controladora/autenticacao.php";
    include '../repositorio/produtos_repositorio.php';
    include '../modelo/produtos.php';
    include '../modelo/usuario.php';
    include '../repositorio/usuarios_repositorio.php';

    $vendasRepositorio = new pedidosRepositorio($conn);
    $vendas = $vendasRepositorio->buscarTodasVendas();
    $totalVendas = $vendasRepositorio->somarTotais();

    $produtosRepositorio = new produtoRepositorio($conn);
    $produtos = $produtosRepositorio->buscarTodos();

    $usuariosRepositorio = new usuarioRepositorio($conn);
    $usuarios = $usuariosRepositorio->buscarTodosClientes();

    $registrosPorPagina = 5;
    $paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    $inicio = ($paginaAtual - 1) * $registrosPorPagina;
    
    // Buscando apenas os registros para a página atual
    $vendasPaginadas = array_slice($vendas, $inicio, $registrosPorPagina);
    
    // Total de páginas
    $totalPaginas = ceil(count($vendas) / $registrosPorPagina);
    ?>

    <nav class="navbar navbar-expand-sm navbar-custom navbar-dark fixed-top">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto d-flex align-items-center">
                    <li class="nav-item">
                        <a class="btn btn-dark" href="admin.php" style="background-color: #222529; border-radius: 1.5rem; margin-top: 1rem;">Voltar</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="login-title text-center">
        <a href="/">
            <img src="../recursos/imagens/logo_nav.png" alt="Logo" class="logo">
        </a>
    </div>
    <div class="container mt-7">
        <h2>CONTROLE DE VENDAS</h2>

        <form action="../controladora/processar_pedidos.php" method="POST" enctype="multipart/form-data">
            <label for="nomeCliente" class="titulo-campo">Nome do Cliente:</label>
            <select id="nomeCliente" name="nomeCliente" class="custom-input" autocomplete="off">
                <option value="">Selecione um Cliente</option>
                <?php foreach ($usuarios as $usuario) : ?>
                    <option value="<?= $usuario->getIdUsuario(); ?>" data-nome="<?= $usuario->getNome(); ?>" data-cep="<?= $usuario->getCep(); ?>" data-numero="<?= $usuario->getNumero(); ?>">
                        <?= $usuario->getNome(); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="cep" class="titulo-campo">CEP:</label>
            <input type="text" id="cep" name="cep" class="custom-input" required maxlength="9" placeholder="00000-000">

            <label for="numero" class="titulo-campo">Número:</label>
            <input type="text" id="numero" name="numero" class="custom-input" required>

            <input type="hidden" id="total_produtos" name="total_produtos" class="custom-input">


            <input type="hidden" id="logradouro" name="logradouro" class="custom-input">

            <input type="hidden" id="bairro" name="bairro" class="custom-input">

            <input type="hidden" id="cidade" name="cidade" class="custom-input">

            <label for="produto" class="titulo-campo">Produto:</label>
<select id="produto" name="produto" class="custom-input" required>
    <option value="" disabled selected>Selecione um Produto</option> <!-- Adicionando a opção inicial -->
    <?php foreach ($produtos as $produto) : ?>
        <option value="<?= $produto->getIdProduto(); ?>" data-preco="<?= $produto->getPrecoProduto(); ?>">
            <?= $produto->getNome(); ?>
        </option>
    <?php endforeach; ?>
</select>

            <label for="quantidade" class="titulo-campo">Quantidade:</label>
            <input type="number" id="quantidade" name="quantidade" class="custom-input" required>

            <label for="preco" class="titulo-campo">Preço do Produto:</label>
            <input id="preco" name="preco" class="custom-input" value="" required readonly>

            <label for="formaPagamento" class="titulo-campo">Forma de Pagamento:</label>
            <select id="formaPagamento" name="formaPagamento" class="custom-input" required>
                <option value="Dinheiro">Dinheiro</option>
                <option value="Cartão de Crédito">Cartão de Crédito</option>
                <option value="Cartão de Débito">Cartão de Débito</option>
                <option value="PIX">PIX</option>
            </select>

            <input type="submit" name="cadastro" class="btn btn-primary" value="CADASTRAR">
        </form>
        <table class="table mt-4" id="tabelaVendas">
            <thead>
                <tr>
                    <th>ID Venda</th>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Preço</th>
                    <th>Total</th>
                    <th>Forma de Pagamento</th>
                    <th>Endereço</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($vendas as $venda) : ?>
                    <tr id="vendas-<?= $venda->getIdPedido() ?>">
                        <td><?= $venda->getIdPedido() ?></td>
                        <td>
                            <?php
                            $produtoNome = '';
                            foreach ($produtos as $produto) {
                                if ($produto->getIdProduto() == $venda->getProduto()) {
                                    $produtoNome = $produto->getNome();
                                    break;
                                }
                            }
                            echo $produtoNome;
                            ?>
                        </td>
                        <td><?= $venda->getQuantidade() ?></td>
                        <td><?= $venda->getPreco() ?></td>
                        <td><?= $venda->getTotal() ?></td>

                        <?php
                        $totalProdutoVendido = 0;
                        foreach ($vendas as $vendaTotal) {
                            if ($vendaTotal->getProduto() == $venda->getProduto()) {
                                $totalProdutoVendido += $vendaTotal->getQuantidade();
                            }
                        }
                        ?>

                        <td><?= $venda->getFormaPagamento() ?></td>
                        <td>
                            <strong>Rua:</strong> <?= $venda->getRua() ?><br>
                            <strong>Número:</strong> <?= $venda->getNumero() ?><br>
                            <strong>Bairro:</strong> <?= $venda->getBairro() ?><br>
                            <strong>Cidade:</strong> <?= $venda->getCidade() ?>
                        </td>
                        <td style="text-align: center; vertical-align: middle;">
                            <button class="botao-excluir" data-id="<?= $venda->getIdPedido(); ?>" data-tipo="vendas" style="background-color: red;
                            color: white; border: none; border-radius: 15px; padding: 6px 8px; font-weight: 500; font-family: Poppins, sans-serif;
                            transition: background-color 0.3s; margin-top: 10px; display:inline; margin-bottom: 10px;">
                                Excluir
                            </button>
                            <form action="../visao/editar_pedidos.php" method="POST" style="margin-bottom: 10px;">
                                <input type="hidden" name="id" value="<?= $venda->getIdPedido(); ?>">
                                <input type="submit" class="botao-editar" value="Editar" style="background-color: green; color: white; border: none;
                                border-radius: 15px;padding: 6px 11px; font-weight: 500; font-family: Poppins, sans-serif;">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
                
        <p id="lucro-total">Lucro de: R$ <?= number_format($totalVendas, 2, ',', '.'); ?></p>
    </div>

    <script>
        $(document).ready(function() {
            // Limpa os campos ao carregar a página
            $("#cep").val("");
            $("#numero").val("");
            $("#logradouro").val("");
            $("#bairro").val("");
            $("#cidade").val("");

            // Quando o usuário selecionar um produto
            $("#produto").on("change", function() {
    // Obtém o preço do produto selecionado
    var preco = $(this).find('option:selected').data('preco');
    
    // Se houver um preço associado ao produto, preenche o campo de preço
    if (preco !== undefined && preco !== "") {
        $("#preco").val(preco); // Atualiza o campo de preço
    } else {
        $("#preco").val(""); // Deixa o campo de preço vazio
    }
});

            $('#nomeCliente').select2({
                placeholder: 'Digite o nome do cliente...',
                allowClear: true 
            });

            // Quando o usuário selecionar um cliente
            $("#nomeCliente").on("change", function() {
                var cep = $(this).find('option:selected').data('cep'); // Obtém o CEP da opção selecionada
                var numero = $(this).find('option:selected').data('numero'); // Obtém o Número da opção selecionada

                // Preenche o campo de CEP
                if (cep) {
                    $("#cep").val(cep); // Preenche o campo de CEP
                } else {
                    $("#cep").val(""); // Limpa o campo de CEP caso não encontre
                }

                // Preenche o campo de Número
                if (numero) {
                    $("#numero").val(numero); // Preenche o campo de Número
                } else {
                    $("#numero").val(""); // Limpa o campo de Número caso não encontre
                }
            });

            // Quando o usuário digitar ou alterar o CEP
            $("#cep").on("blur", function() {
                var cep = $(this).val().replace(/\D/g, ''); // Remove qualquer caractere não numérico (como o hífen)

                if (cep.length === 8) {
                    // Consulta ao ViaCEP usando AJAX
                    $.getJSON(`https://viacep.com.br/ws/${cep}/json/`, function(data) {
                        if (data && !data.erro) {
                            // Preenche os campos de rua, bairro e cidade
                            $("#logradouro").val(data.logradouro);
                            $("#bairro").val(data.bairro);
                            $("#cidade").val(data.localidade);
                        } else {
                            alert("CEP não encontrado.");
                        }
                    }).fail(function() {
                        alert("Erro ao consultar o CEP. Tente novamente.");
                    });
                } else {
                    alert("CEP inválido. Por favor, insira um CEP válido.");
                }
            });
        });

        $(document).on('click', '.botao-excluir', function() {
            const idParaExcluir = $(this).data('id');
            const tipo = $(this).data('tipo');

            $.ajax({
                url: '../controladora/processar_exclusao.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    id: idParaExcluir,
                    tipo: tipo
                },
                success: function(response) {
                    if (response.status === 'sucesso') {
                        $(`#vendas-${idParaExcluir}`).remove();

                        if (tipo === 'vendas' && response.novoLucro !== undefined) {
                            const lucroFormatado = `R$ ${response.novoLucro.toFixed(2).replace('.', ',')}`;
                            $('#lucro-total').text(`Lucro de: ${lucroFormatado}`);
                        }
                    } else {
                        alert(response.message || 'Erro ao excluir.');
                    }
                },
                error: function() {
                    alert('Erro na solicitação. Tente novamente.');
                }
            });
        });

        $(document).on('click', '.botao-excluir', function() {
            const idParaExcluir = $(this).data('id');
            const tipo = $(this).data('tipo');

            $.ajax({
                url: '../controladora/processar_exclusao.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    id: idParaExcluir,
                    tipo: tipo
                },
                success: function(response) {
                    if (response.status === 'sucesso') {
            
                        $(`#vendas-${idParaExcluir}`).remove();

                        // Atualizar o lucro total na tela
                        if (tipo === 'vendas' && response.novoLucro !== undefined) {
                            const lucroFormatado = `R$ ${response.novoLucro.toFixed(2).replace('.', ',')}`;
                            $('#lucro-total').text(`Lucro de: ${lucroFormatado}`);
                        }
                    } else {
                        alert(response.message || 'Erro ao excluir.');
                    }
                },
                error: function() {
                    alert('Erro na solicitação. Tente novamente.');
                }
            });
        });

        $(document).ready(function() {
            $('#formPedido').on('submit', function(event) {
                event.preventDefault(); 

                const produtoId = $('#produto').val();
                const quantidade = $('#quantidade').val();
                const form = this; 

                $.ajax({
                    url: '../controladora/validar_estoque.php',
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        produtoId: produtoId,
                        quantidade: quantidade
                    },
                    success: function(data) {
                        if (data.sucesso) {
                            // Envia o formulário se o estoque for suficiente
                            form.submit();
                        } else {
                            alert('Estoque insuficiente para o produto selecionado.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Erro na validação do estoque:", error);
                        alert('Ocorreu um erro ao validar o estoque. Tente novamente.');
                    }
                });
            });
        });


    </script>

</body>

</html>
