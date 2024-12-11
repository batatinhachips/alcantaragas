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
  <title>ADMINISTRAÇÃO</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- LINKS -->
  <link rel="icon" href="../recursos/imagens/icon.png" type="image/png">
  <link href="../recursos/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="../recursos/css/styles.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <script src="../recursos/js/bootstrap.bundle.min.js"></script>
  <script src="../recursos/js/jquery-3.5.1.min.js"></script>
  <script src="../recursos/js/popper.min.js"></script>
  <script src="../recursos/js/script.js"></script>
</head>

<?php
include '../controladora/conexao.php';
include '../modelo/produtos.php';
include '../repositorio/produtos_repositorio.php';
include "../controladora/autenticacao.php";

$produtosRepositorio = new produtoRepositorio($conn);
$produtos = $produtosRepositorio->buscarTodos();
?>

<body>

  <nav class="navbar navbar-expand-sm navbar-custom navbar-dark fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="/">
        <img src="../recursos/imagens/logo_nav.png" alt="Logo da Empresa" style="height: 40px;">
      </a>

      <div class="menu-icon" onclick="toggleMenu()">
        <i class="bi bi-list"></i>
      </div>
      <nav id="menu" class="menu">
        <?php
        if (isset($_SESSION["nome_usuario"])) {
          echo "<div class='user-name'>" . $_SESSION["nome_usuario"] . "</div>";
        }
        ?>
        <div class="dropdown-content">
          <?php if (isset($_SESSION["papel"]) && $_SESSION["papel"] == "admin") { ?>
            <a class="dropdown-item" href="/">Voltar</a>
          <?php } ?>
          <?php if (isset($_SESSION["nome_usuario"])) { ?>
            <a class="dropdown-item" href="../controladora/logout.php">Sair</a>
          <?php } else { ?>
            <a class="dropdown-item" href="../visao/formLogin.php">Login</a>
            <a class="dropdown-item" href="../visao/cadastrar_cliente.php">Cadastre-se</a>
          <?php } ?>
        </div>
      </nav>
    </div>
      <div id="navbarNav" class="navbar-nav">
        <ul class="navbar-navButton">
          <li class="nav-item">
            <a class="btn btn-light ms-2" href="cadastrar_admin.php">Novo Admin</a>
          </li>
          <li class="nav-item">
            <a class="btn btn-light ms-2" href="cadastrar_produtos.php">Novo Produto</a>
          </li>
          <li class="nav-item">
            <a class="btn btn-light ms-2" href="admin_tabela.php">Tabela Admins</a>
          </li>
          <li class="nav-item">
            <a class="btn btn-light ms-2" href="usuario_tabela.php">Tabela Clientes</a>
          </li>
          <li class="nav-item">
            <a class="btn btn-light ms-2" href="pedidos.php">Tabela de Vendas</a>
          </li>
          <li class="nav-item">
            <a class="btn btn-light ms-2" href="estoque.php">Estoque</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- SESSAO DO CATALOGO -->
  <section id="services" class="services">
    <div class="container" data-aos="fade-up">
      <div class="rowCard">
        <?php foreach ($produtos as $produto) : ?>
          <div class="col">
            <div class="card custom-card" id="produto-<?= $produto->getIdProduto(); ?>">
              <img src="../recursos/imagens/<?= $produto->getImagem() ?>" alt="">
              <div class="custom-card-body">
                <h5 class="custom-card-title"><?= $produto->getNome() ?></h5>
                <p class="custom-card-text"><?= $produto->getDescricao() ?></p>
                <h4>R$ <?= number_format($produto->getPrecoProduto(), 2, ',', '.') ?></h4>
                <div class="botao-container">
                <form action="../visao/editar_produtos.php" method="POST">
                  <input type="hidden" name="idProduto" value="<?= $produto->getIdProduto(); ?>">
                  <input type="submit" class="botao-editar" value="Editar">
                </form>

                <button class="botao-excluir" data-id="<?= $produto->getIdProduto(); ?>" data-tipo="produto">
                  Excluir
                </button>
              </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
  <script>
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
              $(`#produto-${idParaExcluir}`).fadeOut(300, function() {
                    $(this).remove();
                });
            } else {
                alert(response.message || 'Erro ao excluir.');
            }
        },
        error: function() {
            alert('Erro na solicitação. Tente novamente.');
        }
    });
}); </script>
</body>

</html>
