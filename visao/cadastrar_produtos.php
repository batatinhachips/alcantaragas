<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <title>CADASTRAR PRODUTOS</title>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

  <link rel="stylesheet" href="../recursos/css/produtos.css">
  <link href="../recursos/imagens/icon.png" rel="icon">
</head>
<body>
<main>
<div class="login-title text-center">
  <a href="/">
    <img src="../recursos/imagens/logo_nav.png" alt="Logo" class="logo">
  </a>
  <h1>CADASTRAR PRODUTO</h1>
</div>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-sm navbar-custom navbar-dark fixed-top">
  <div class="container-fluid">
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto d-flex align-items-center">
        <?php 
          if (isset($_SESSION["nome_usuario"])) { 
            echo "<div class='user-name'>" . $_SESSION["nome_usuario"] . "</div>";
          }
        ?>
        <li class="nav-item">
          <a class="btn btn-dark" href="admin.php" style="margin-left: auto;">Voltar</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<section id="services" class="services">
  <div class="container" data-aos="fade-up">
    <div class="row">
      <div class="container container-form-login mt-5" id="login-form">
        <div class="icon-box">
          <div class="custom-container">
            <div class="form-group">
              <form action="../controladora/processar_produtos.php" method="POST" enctype="multipart/form-data">
    <label for="nome" class="titulo-campo">Nome:</label>
    <input type="text" id="nome" name="nome" placeholder="digite o nome do produto" class="custom-input" required>

    <label for="descricao" class="titulo-campo">Descrição:</label>
    <input type="text" id="descricao" name="descricao" placeholder="digite uma descrição para o produto" class="custom-input" required>

    <label for="preco" class="titulo-campo">Preço:</label>
    <input type="text" id="preco" name="preco" placeholder="ex: 99.99" class="custom-input" required>

    <label for="imagem" class="titulo-campo">Envie uma imagem do produto:</label>
    <input type="file" name="imagem" accept="image/*" id="imagem" class="custom-input" required>

    <input type="submit" name="cadastro" class="botao-cadastrar" value="CADASTRAR">
</form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js" integrity="sha512-Rdk63VC+1UYzGSgd3u2iadi0joUrcwX0IWp2rTh6KXFoAmgOjRS99Vynz1lJPT8dLjvo6JZOqpAHJyfCEZ5KoA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="js/index.js"></script>
</body>
</html>
