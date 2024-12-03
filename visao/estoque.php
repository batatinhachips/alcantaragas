<!DOCTYPE html>
<html lang="pt-BR">

<head>
<title>Estoque - Cadastro de Itens</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../recursos/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../recursos/css/pedidos.css">
    <link href="../recursos/imagens/icon.png" rel="icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="../recursos/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <?php
    include '../controladora/conexao.php';
    include '../modelo/produtos.php';
    include '../repositorio/produtos_repositorio.php';
    include '../repositorio/estoque_repositorio.php';

    $produtosRepositorio = new produtoRepositorio($conn);
    $produtos = $produtosRepositorio->buscarTodos(); 

    $estoqueRepositorio = new EstoqueRepositorio($conn);
    $estoqueItens = $estoqueRepositorio->listarTodos(); 
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

    <div class="container mt-5">
        <h2>ESTOQUE - CADASTRO DE ITENS</h2>

        <!-- Formulário para adicionar itens no estoque -->
        <form action="../controladora/processar_estoque.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="produto" class="form-label">Produto:</label>
                <select id="produto" name="produto" class="form-control" required>
                    <option value="">Selecione um Produto</option>
                    <?php foreach ($produtos as $produto) : ?>
                        <option value="<?= $produto->getIdProduto(); ?>" data-nome="<?= $produto->getNome(); ?>">
                            <?= $produto->getNome(); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="nomeProduto" class="form-label">Nome do Produto:</label>
                <input type="text" id="nomeProduto" name="nomeProduto" class="form-control" readonly>
            </div>

            <div class="mb-3">
                <label for="quantidade" class="form-label">Quantidade Inicial:</label>
                <input type="number" id="quantidade" name="quantidade" class="form-control" required min="1">
            </div>

            <div class="mb-3">
                <input type="submit" name="cadastro" class="btn btn-primary" value="Cadastrar no Estoque">
            </div>
        </form>

        <!-- Tabela para exibir o estoque -->
        <h3>Itens no Estoque</h3>
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>ID Produto</th>
                    <th>Nome do Produto</th>
                    <th>Quantidade Em Estoque</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($estoqueItens)) : ?>
                    <?php foreach ($estoqueItens as $item) : ?>
                        <tr id="estoque-<?= $item->getIdEstoque() ?>">
                            <td><?= $item->getIdProduto(); ?></td>
                            <td><?= $item->getNomeProduto(); ?></td> 
                            <td><?= $item->getQuantidade(); ?></td>

                            <td>
                                <button class="botao-excluir" data-id="<?= $item->getIdEstoque(); ?>" data-tipo="estoque" style="background-color: red; color: white; border: none; border-radius: 15px; padding: 6px 8px; font-weight: 500; font-family: Poppins, sans-serif; transition: background-color 0.3s; margin-top: 10px; display:inline;">
                                    Excluir
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="4" class="text-center">Nenhum item no estoque.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script>
        // Quando o produto é selecionado, preenche o nome do produto automaticamente
        $(document).ready(function() {
            $('#produto').on('change', function() {
                var nomeProduto = $(this).find('option:selected').data('nome'); // Obtém o nome do produto da opção selecionada
                $('#nomeProduto').val(nomeProduto ? nomeProduto : ''); // Atualiza o campo nomeProduto no formulário
            });
        });

        // Função para excluir um item do estoque
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
                        $(`#estoque-${idParaExcluir}`).remove();;
                    } else {
                        alert(response.message || 'Erro ao excluir.');
                    }
                },
                error: function() {
                    alert('Erro na solicitação. Tente novamente.');
                }
            });
        });
    </script>

</body>

</html>