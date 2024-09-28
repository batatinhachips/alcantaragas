<!DOCTYPE html>
<html lang="pt-BR">
<?php
session_start();
?>

<head>
  <title>EDITAR PRODUTOS</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- LINKS -->
  <link rel="icon" href="../recursos/imagens/icon.png" type="image/png">
  <link href="../recursos/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="../recursos/css/produtos.css">
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
include '../modelo/produtos.php';
include '../repositorio/produtos_repositorio.php';

$produtosRepositorio = new produtoRepositorio($conn);
$produtos = $produtosRepositorio->buscarTodos();
$senhaHash = password_hash($senha, PASSWORD_BCRYPT);
?>

<body>
<div class="login-title text-center">
      <a href="/">
        <img src="../recursos/imagens/logo_nav.png" alt="Logo" class="logo">
      </a>
      <h1>EDITAR PRODUTO</h1>
    </div>

    <!-- LINKS DE NAVEGACAO E BOTOES -->
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ms-auto d-flex align-items-center">
    </ul>
  </div>
  </div>
  </nav>
  <!-- FIM DA NAVBAR -->

  <section id="services" class="services">
    <div class="container" data-aos="fade-up">
      <div class="row">
      <div class="container container-form-login mt-5" id="login-form">
          <div class="icon-box">
            <?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
              $produto_id = $_POST["id"];
              $sql = "SELECT * FROM produtos WHERE id = $produto_id";
              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                $produto = $result->fetch_assoc();
            ?>

                  <!-- Formulário de edição -->
                  <form action="../controladora/processar_editar_produtos.php" method="POST" enctype="multipart/form-data" class="formulario-edicao">
                    <input type="hidden" name="id" value="<?= $produto["id"] ?>">

                    <label for="nome" class="titulo-campo">Nome:</label>
                    <input type="text" name="nome" value="<?= $produto["nome"] ?>" class="custom-input"><br>

                    <label for="descricao" class="titulo-campo">Descrição:</label>
                    <input type="text" name="descricao" value="<?= $produto["descricao"] ?>" class="custom-input"><br>

                    <label for="preco" class="titulo-campo">Preço:</label>
                    <input type="text" name="preco" value="<?= $produto["preco"] ?>" class="custom-input"><br>

                    <label for="imagem" class="titulo-campo">Imagem:</label>
                    <input type="file" name="imagem" accept="image/*" class="custom-input">
                    <span class="titulo-campo">Imagem atual: <?= $produto["imagem"] ?></span><br>

                    <button type="submit" class="btn btn-primary btn-lg btn-block botao-salvar-edicoes">Salvar edições</button>
                  </form>
                  <br>
                  <br>
                  <br>
                </div>
            <?php
              } else {
                echo "Produto não encontrado";
              }
            }
            $conn->close(); ?>
          </div>
        </div>
      </div>
    </div>
  </section>

</body>

</html>
