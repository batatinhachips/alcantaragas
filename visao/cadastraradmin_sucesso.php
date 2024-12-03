<!doctype html>
<html lang="pt-br">

<head>
  <title>SUCESSO NO CADASTRO!</title>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link rel="stylesheet" href="../recursos/css/login.css">
  <link href="../recursos/imagens/icon.png" rel="icon">p
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

  <body class="login_bg">
    <main>
      <div class="login-title text-center">
        <a href="/">
          <img src="../recursos/imagens/logo_nav.png" alt="Logo" class="logo">
        </a>
        <h1>Cadastro realizado com sucesso!</h1>
      </div>
      <div class="container container-form mt-5">
        <form method="post" action="../visao/admin.php">
          <button type="submit" class="btn btn-custom-primary btn-block">Voltar</button>
        </form>
      </div>
    </main>

    <script src="../recursos/js/jquery-3.5.1.min.js"></script>
    <script src="../recursos/js/bootstrap.min.js"></script>
    <script>
      $(document).ready(function() {
        $('.login-title').css('display', 'flex').css('flex-direction', 'column').css('align-items', 'center');
      });
    </script>
  </body>

  </main>
</body>

</html>