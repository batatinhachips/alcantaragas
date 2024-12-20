<!doctype html>
<html lang="pt-br">
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
  <title>Cadastrar Novo Admin</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link rel="stylesheet" href="../recursos/css/login.css">
  <link href="../recursos/imagens/icon.png" rel="icon">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="login_bg">
  <main>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-sm navbar-custom navbar-dark fixed-top">
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto d-flex justify-content-end align-items-center w-100">
            <li class="nav-item">
              <a class="btn btn-dark" href="admin.php" style="background-color: #222529; border-radius: 2rem; margin-top: 1rem;">Voltar</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="login-title text-center">
      <a href="/">
        <img src="../recursos/imagens/logo_nav.png" alt="Logo" class="logo">
      </a>
      <h1 class="titulo-admin">CADASTRO DE ADMINISTRADOR</h1>
    </div>
    <div class="container container-form-login mt-5" id="login-form">
      <form id="admin-form" method="post" action="../controladora/processar_cadastro_usuario.php">
        <div class="form-group">
          <label for="nome">Nome</label>
          <input type="text" class="form-control" id="nome" placeholder="Digite o nome do admin" name="nome" required>
          <div class="invalid-feedback">O nome deve conter apenas letras.</div>
        </div>
        <div class="form-group">
          <label for="email">E-mail</label>
          <input type="email" class="form-control" id="email" placeholder="Digite o e-mail do admin" name="email" required>
          <div class="invalid-feedback">E-mail inválido.</div>
        </div>
        <div class="form-group">
          <label for="senha">Senha</label>
          <input type="password" class="form-control" id="senha" placeholder="Digite a senha do admin" name="senha" required>
          <div class="invalid-feedback">A senha deve ter no mínimo 6 caracteres, incluindo letras e números.</div>
        </div>
        <div class="form-group">
          <label for="confirmarsenha">Confirmar Senha</label>
          <input type="password" class="form-control" id="confirmarsenha" placeholder="Confirme a senha do admin" name="confirmarsenha" required>
          <div class="invalid-feedback">As senhas não coincidem.</div>
        </div>
        <input type="hidden" name="idNivelUsuario" value="2">
        <button type="submit" class="btn btn-custom-primary btn-block">Cadastrar</button>
      </form>
    </div>
  </main>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
    document.getElementById('admin-form').addEventListener('submit', function(event) {
      event.preventDefault();

      var nome = document.getElementById('nome');
      var email = document.getElementById('email');
      var senha = document.getElementById('senha');
      var confirmarSenha = document.getElementById('confirmarsenha');
      var valid = true;

      document.querySelectorAll('.form-control').forEach(function(input) {
        input.classList.remove('is-invalid');
      });
      document.querySelectorAll('.invalid-feedback').forEach(function(feedback) {
        feedback.style.display = 'none';
      });

      // Validar Nome
      var nomeValue = nome.value.trim();
      if (nomeValue && !/^[a-zA-Z\s]+$/.test(nomeValue)) {
        nome.classList.add('is-invalid');
        nome.nextElementSibling.style.display = 'block';
        valid = false;
      }

      // Validar Senha
      var senhaValue = senha.value.trim();
      if (senhaValue && (senhaValue.length < 6 || !/[a-zA-Z]/.test(senhaValue) || !/\d/.test(senhaValue))) {
        senha.classList.add('is-invalid');
        senha.nextElementSibling.style.display = 'block';
        valid = false;
      }

      // Validar Confirmar Senha
      if (senhaValue && confirmarSenha.value.trim() !== senhaValue) {
        confirmarSenha.classList.add('is-invalid');
        confirmarSenha.nextElementSibling.style.display = 'block';
        valid = false;
      }

      if (valid) {
        this.submit();
      }
    });
  </script>
</body>

</html>
