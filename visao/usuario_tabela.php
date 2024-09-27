<!DOCTYPE html>
<html lang="pt-BR">
<?php
session_start();
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
  <script src="../recursos/js/jquery-3.5.1.slim.min.js"></script>
  <script src="../recursos/js/popper.min.js"></script>
  <script src="../recursos/js/script.js"></script>


  <!-- FIM DOS LINKS -->
</head>
<?php
include '../controladora/conexao.php';
include '../modelo/usuario.php';
include '../repositorio/usuarios_repositorio.php';
include "../controladora/autenticacao.php";

$usuariosRepositorio = new usuarioRepositorio($conn);
$usuarios = $usuariosRepositorio->buscarTodosUsuarios();

?>

<body>

  <nav class="navbar navbar-expand-sm navbar-custom navbar-dark fixed-top">
    <div class="container-fluid">
      <!-- NAVBAR -->
      <a class="navbar-brand" href="/">
        <img src="../recursos/imagens/logo_nav.png" alt="Logo da Empresa" style="height: 40px;">
      </a>
      <!-- BOTAO PARA EXIBIR O MENU EM TELAS MENORES -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Links de navegação e botões -->
      <!-- Botões de Logar e Cadastrar -->
      <div class="botao-admin">
        <a class="btn btn-light ms-2" href="../visao/cadastrar_admin.php">Novo Admin</a>
        <a class="btn btn-light ms-2" href="../visao/cadastrar_produtos.php">Novo Produto</a>
      </div>
    </div>

    <!-- Ícone do Menu Hambúrguer -->
    <div class="menu-icon" onclick="toggleMenu()">
      <i class="bi bi-list"></i>
    </div>

    <!-- Menu Dropdown -->
    <nav id="menu" class="menu">
      <?php
      if (isset($_SESSION["nome_usuario"])) {
        echo "<div class='user-name'>" . $_SESSION["nome_usuario"] . "</div>";
      }
      ?>
      <div class="dropdown-content">
        <?php if (isset($_SESSION["nome_usuario"])) { ?>
          <a class="dropdown-item" href="../controladora/logout.php">Sair</a>
        <?php } else { ?>
          <a class="dropdown-item" href="formLogin.php">Login</a>
        <?php } ?>
      </div>
    </nav>
    </div>
  </nav>
  </div>

  <!-- LINKS DE NAVEGACAO E BOTOES -->
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ms-auto d-flex align-items-center">
    </ul>
  </div>
  </div>
  </nav>

  <!-- SESSAO DO CATALOGO -->
  <section id="services" class="services">
    <div class="container" data-aos="fade-up">
      <div class="section-title">
        <br>
        <br>
        <br>
      </div>
 <div class="row">
  <?php foreach ($usuarios as $usuario) : ?>
    <div class="col">
      <div class="card custom-card">
        <div class="custom-card-body">
          <h5 class="custom-card-title"><?= htmlspecialchars($usuario->getNome()) ?></h5>
          <p class="custom-card-text">Email: <?= htmlspecialchars($usuario->getEmail()) ?></p>
          <p>CPF: <?= htmlspecialchars($usuario->getCpf()) ?></p>
          <p>Telefone: <?= htmlspecialchars($usuario->getTelefone()) ?></p>
          <p>CEP: <?= htmlspecialchars($usuario->getCep()) ?></p>
          <p>Logradouro: <?= htmlspecialchars($usuario->getLogradouro()) ?></p>
          <p>Complemento: <?= htmlspecialchars($usuario->getComplemento()) ?></p>
          <p>Número: <?= htmlspecialchars($usuario->getNumero()) ?></p>
          <p>Bairro: <?= htmlspecialchars($usuario->getBairro()) ?></p>
          <p>Cidade: <?= htmlspecialchars($usuario->getCidade()) ?></p>

          <form action="../visao/editar_admin.php" method="POST" style="margin-bottom: 10px;">
            <input type="hidden" name="id" value="<?= $usuario->getIdUsuario(); ?>">
            <input type="submit" class="botao-editar" value="Editar" style="background-color: green; color: white; border: none; border-radius: 15px; padding: 6px 11px; font-weight: 500; font-family: Poppins, sans-serif;">
          </form>

          <form action="../controladora/processar_exclusao.php" method="POST" style="margin-top: 10px;">
            <input type="hidden" name="id" value="<?= $usuario->getIdUsuario(); ?>">
            <input type="submit" class="botao-excluir" value="Excluir" style="background-color: red; color: white; border: none; border-radius: 15px; padding: 6px 8px; font-weight: 500; font-family: Poppins, sans-serif; transition: background-color 0.3s;">
          </form>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>
      



<!--       <div class="row">
        <?php foreach ($usuarios as $usuario) : ?>
          <tr>
            <div class="col">
              <div class="card custom-card">
                <div class="custom-card-body">
                  <h5 class="custom-card-title"><?= $usuario->getNome() ?></a></h5>
                  <p class="custom-card-text"><?= $usuario->getEmail() ?></p>
                  <h4><?= $usuario->getSenha() ?></h4>

                  <form action="../visao/editar_admin.php" method="POST" style="margin-bottom: 10px;">
                    <input type="hidden" name="id" value="<?= $usuario->getIdUsuario(); ?>">
                    <input type="submit" class="botao-editar" value="Editar" style="background-color: green; color: white; border: none; border-radius: 15px; padding: 6px 11px; font-weight: 500; font-family: Poppins, sans-serif;">
                  </form>
                  <td>
                    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acao']) && $_POST['acao'] === 'excluir') {
                      $idParaExcluir = $_POST['id'];

                      $usuariosRepositorio->excluirUsuariosPorId($idParaExcluir);
                    } ?>
                  </td>
                  <td>
                    <form action="../controladora/processar_exclusao.php" method="POST" style="margin-top: 10px;">
                      <input type="hidden" name="id" value="<?= $usuario->getIdUsuario(); ?>">
                      <input type="submit" class="botao-excluir" value="Excluir" style="background-color: red; color: white; border: none; border-radius: 15px; padding: 6px 8px; font-weight: 500; font-family: Poppins, sans-serif; transition: background-color 0.3s;">
                    </form>
                </div>
              </div>
              </td>
            </div>
          </tr>
        <?php endforeach; ?>
      </div> -->
    </div>
  </section>

</body>

</html>