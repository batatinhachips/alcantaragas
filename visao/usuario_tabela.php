<!DOCTYPE html>
<html lang="pt-BR">
<?php
session_start();
?>

<head>
  <title>Administração</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="../recursos/css/styles.css">
  <link rel="icon" href="../recursos/imagens/icon.png" type="image/png">
  <link href="../recursos/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <script src="../recursos/js/bootstrap.bundle.min.js"></script>
  <script src="../recursos/js/jquery-3.5.1.min.js"></script>
  <script src="../recursos/js/popper.min.js"></script>
  <script src="../recursos/js/script.js"></script>

</head>
<?php
include '../controladora/conexao.php';
include '../modelo/usuario.php';
include '../repositorio/usuarios_repositorio.php';
include "../controladora/autenticacao.php";

$usuariosRepositorio = new usuarioRepositorio($conn);
$usuarios = $usuariosRepositorio->buscarTodosClientes();

?>

<body class="usuario-admin">
  <nav class="navbar navbar-expand-sm navbar-custom navbar-dark fixed-top usuario-admin">
    <div class="container-fluid">
      <!-- NAVBAR -->
      <a class="navbar-brand" href="/">
        <img src="../recursos/imagens/logo.png" alt="Logo da Empresa" style="height: 40px;">
      </a>

      <div class="botao-admin">
        <a class="btn btn-light ms-2" href="../visao/cadastrar_cliente.php">Novo Cliente</a>
        <a class="btn btn-light ms-2" href="../visao/cadastrar_produtos.php">Novo Produto</a>
      </div>

      <!-- Ícone do Menu Hambúrguer -->
      <div class="menu-icon-tabelas" onclick="toggleMenu()">
        <i class="bi bi-list"></i>
      </div>
    </div>

    <!-- Menu Dropdown -->
    <nav id="menu" class="menu">
      <?php
      if (isset($_SESSION["nome_usuario"])) {
        echo "<div class='user-name'>" . $_SESSION["nome_usuario"] . "</div>";
      }
      ?>
      <li class="dropdown-content">
        <a class="dropdown-item" href="admin.php" style="margin-left: auto;">Voltar</a>
      </li>
      <div class="dropdown-content">
        <?php if (isset($_SESSION["nome_usuario"])) { ?>
          <a class="dropdown-item" href="../controladora/logout.php">Sair</a>
        <?php } else { ?>
          <a class="dropdown-item" href="formLogin.php">Login</a>
        <?php } ?>
      </div>
    </nav>
  </nav>

  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ms-auto d-flex align-items-center">
    </ul>
  </div>
  </div>
  </nav>

  <section id="services" class="services">
    <div class="container" data-aos="fade-up">
      <div class="section-title">
        <br>
        <br>
        <br>
      </div>

      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nome</th>
              <th scope="col">Email</th>
              <th scope="col">CPF</th>
              <th scope="col">Telefone</th>
              <th scope="col">CEP</th>
              <th scope="col">Logradouro</th>
              <th scope="col">Complemento</th>
              <th scope="col">Numero</th>
              <th scope="col">Bairro</th>
              <th scope="col">Cidade</th>
              <th scope="col">Ações</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($usuarios as $usuario) : ?>
              <tr id="usuario-<?= $usuario->getIdUsuario() ?>">
                <th scope="row"><?= $usuario->getIdUsuario() ?></th>
                <td><?= $usuario->getNome() ?></td>
                <td><?= $usuario->getEmail() ?></td>
                <td><?= $usuario->getCpf() ?></td>
                <td><?= $usuario->getTelefone() ?></td>
                <td><?= $usuario->getCep() ?></td>
                <td><?= $usuario->getLogradouro() ?></td>
                <td><?= $usuario->getComplemento() ?></td>
                <td><?= $usuario->getNumero() ?></td>
                <td><?= $usuario->getBairro() ?></td>
                <td><?= $usuario->getCidade() ?></td>
                <td>
                  <form action="../visao/editar_usuario.php" method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $usuario->getIdUsuario(); ?>">
                    <input type="submit" class="botao-editar" value="Editar">
                  </form>
                  <button class="botao-excluir" data-id="<?= $usuario->getIdUsuario(); ?>" data-tipo="usuario">
                    Excluir
                  </button>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
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
            $(`#usuario-${idParaExcluir}`).remove();;
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
