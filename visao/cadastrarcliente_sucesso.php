<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://cdn.positus.global/production/resources/robbu/whatsapp-button/whatsapp-button.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../recursos/css/login.css">
  <link href="../recursos/imagens/icon.png" rel="icon">
  <title>SUCESSO NO CADASTRO!</title>
</head>

<body>

  <body class="login_bg">
    <!-- Botão do WhatsApp -->
    <a id="robbu-whatsapp-button" target="_white" href="https://api.whatsapp.com/send?phone=5511958780556&text=Ol%C3%A1,%20eu%20gostaria%20de%20fazer%20um%20pedido!%0AProduto(s):%0AQuantidade:%0AMeu%20endere%C3%A7o:%0AMeu%20nome:%0ARetirar%20ou%20entrega:">
      <div class="rwb-tooltip"style="background-color: #fff;" >Faça o seu pedido agora!</div>
      <img src="https://cdn.positus.global/production/resources/robbu/whatsapp-button/whatsapp-icon.svg">
    </a>
    <main>
    <div class="cadastro-sucesso">
      <div class="login-title text-center">
        <a href="/">
          <img src="../recursos/imagens/logo_nav.png" alt="Logo" class="logo">
        </a>
        <h1>Cadastro realizado com sucesso!</h1>
      </div>
      <div class="container container-form mt-5 text-center">
        <form method="post" action="../visao/formLogin.php">
          <button type="submit" class="btn btn-custom-primary">Login</button>
        </form>
      </div>
</body>

    </main>

    <!-- jQuery and Bootstrap JS -->
    <script src="../recursos/js/jquery-3.5.1.min.js"></script>
    <script src="../recursos/js/bootstrap.min.js"></script>


    <script>
      $(document).ready(function() {
        // Centralizar o título
        $('.login-title').css('display', 'flex').css('flex-direction', 'column').css('align-items', 'center');
      });
    </script>
  </body>

  </main>
</body>

</html>