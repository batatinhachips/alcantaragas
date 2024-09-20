<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <!-- LINKS -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.positus.global/production/resources/robbu/whatsapp-button/whatsapp-button.css">
  <link rel="stylesheet" href="../recursos/css/login.css">
  <link href="../recursos/imagens/icon.png" rel="icon">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

  <title>NOVO CADASTRO</title>

</head>

<body id="CadCliArea" class="cadCliente">
  <!-- Botão do WhatsApp -->
  <a id="robbu-whatsapp-button" target="_white" href="https://api.whatsapp.com/send?phone=5511958780556&text=Ol%C3%A1,%20eu%20gostaria%20de%20fazer%20um%20pedido!%0AProduto(s):%0AQuantidade:%0AMeu%20endere%C3%A7o:%0AMeu%20nome:%0ARetirar%20ou%20entrega:">
      <div class="rwb-tooltip"style="background-color: #fff;" >Faça o seu pedido agora!</div>
      <img src="https://cdn.positus.global/production/resources/robbu/whatsapp-button/whatsapp-icon.svg">
  </a>
  <main>
    <div class="login-title cadastro-page text-center">
      <a href="/">
        <img src="../recursos/imagens/logo_nav.png" alt="Logo" class="logo">
      </a>
      <h1>CADASTRO</h1>
    </div>

    <div class="container container-form">
      <form id="frmCadUser" method="post" action="../controladora/processar_cadastro_usuario.php">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="nome" class="required">Nome</label>
              <input type="text" class="form-control" id="nome" placeholder=" seu nome completo" name="nome" required>
            </div>
            <div class="form-group">
              <label for="email" class="required">E-mail</label>
              <input type="email" class="form-control" id="email" placeholder="seuemail@gmail.com" name="email" required>
            </div>
            <div class="form-group">
              <label for="senha" class="required">Senha</label>
              <input type="password" class="form-control" id="senha" placeholder="6 caracteres com letras e números" name="senha" required>
            </div>
            <div class="form-group">
              <label for="confirmarsenha" class="required">Confirmar Senha</label>
              <input type="password" class="form-control" id="confirmarsenha" placeholder="digite novamente a sua senha" name="confirmarsenha" required>
            </div>
            <div class="form-group">
              <label for="cpf" class="required">CPF</label>
              <input type="text" class="form-control" id="cpf" placeholder="ex: 12345678901" name="cpf" required>
            </div>
            <div class="form-group">
              <label for="telefone" class="required">Telefone</label>
              <input type="tel" class="form-control" id="telefone" placeholder="ex: 11958780556" name="telefone" required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="cep" class="required">CEP</label>
              <input type="text" class="form-control" id="cep" placeholder="ex: 08584584" name="cep" required>
            </div>
            <div class="form-group">
              <label for="logradouro" class="required">Rua</label>
              <input type="text" class="form-control" id="logradouro" placeholder="ex: Estr. Pedro da Cunha Albuquerque Lopes" name="logradouro" required>
            </div>
            <div class="form-group">
              <label for="complemento">Complemento</label>
              <input type="text" class="form-control" id="complemento" placeholder="ex: Fundos" name="complemento">
            </div>
            <div class="form-group">
              <label for="numero" class="required">Número</label>
              <input type="text" class="form-control" id="numero" placeholder="ex: 1873" name="numero" required>
            </div>
            <div class="form-group">
              <label for="bairro" class="required">Bairro</label>
              <input type="text" class="form-control" id="bairro" placeholder="ex: Jardim Silvestre" name="bairro" required>
            </div>

            <div class="form-group">
              <label for="cidade" class="required">Cidade</label>
              <input type="text" class="form-control" id="cidade" placeholder="ex: Itaquaquecetuba" name="cidade" required>
            </div>
          </div>
        </div>
        <input type="hidden" name="papel" value="usuario">
        <button type="submit" class="btn btn-custom-primary btn-block">Cadastrar</button>
        <a href="formLogin.php" class="btn btn-custom-primary btn-block">Login</a>
      </form>
    </div>

    <script type="text/javascript">
      $(function() {
        // Desativa a exibição de tooltip por hover
        $('[data-bs-toggle="tooltip"]').tooltip('dispose');
      });

      // Função para mostrar o tooltip
      function mostrarTooltip(element, message) {
        element.attr('data-bs-title', message);
        element.tooltip('show');
      }

      // Função para limpar os tooltips
      function limparTooltips() {
        $('[data-bs-toggle="tooltip"]').tooltip('dispose');
      }

      // Validação de CEP
      function limpa_formulário_cep() {
        $("#logradouro").val("");
        $("#bairro").val("");
        $("#cidade").val("");
        $("#uf").val("");
      };

      $("#cep").blur(function() {
        var cep = $(this).val().replace(/\D/g, '');
        if (cep != "") {
          var validacep = /^[0-9]{8}$/;
          if (validacep.test(cep)) {
            $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {
              if (!("erro" in dados)) {
                $("#logradouro").val(dados.logradouro);
                $("#bairro").val(dados.bairro);
                $("#cidade").val(dados.localidade);
                $("#uf").val(dados.uf);
              } else {
                limpa_formulário_cep();
                mostrarTooltip($('#cep'), 'CEP não encontrado.');
              }
            });
          } else {
            limpa_formulário_cep();
            mostrarTooltip($('#cep'), 'Formato de CEP inválido.');
          }
        } else {
          limpa_formulário_cep();
        }
      });

      // Validações de email, senha e nome
      $("#frmCadUser").submit(function(event) {
        event.preventDefault();
        limparTooltips(); // Limpa qualquer tooltip anterior

        var email = $("#email").val();
        var senha = $("#senha").val();
        var confirmarsenha = $("#confirmarsenha").val();
        var nome = $("#nome").val();

        var formIsValid = true;

        // Validação de nome (somente letras)
        var regexNome = /^[A-Za-zÀ-ú\s]+$/;
        if (!regexNome.test(nome)) {
          mostrarTooltip($('#nome'), 'Nome inválido. Apenas letras são permitidas.');
          formIsValid = false;
        }

        // Validação de email
        var regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!regexEmail.test(email)) {
          mostrarTooltip($('#email'), 'Por favor, insira um e-mail válido.');
          formIsValid = false;
        }

        // Validação de senha (deve conter letras e números)
        var regexSenha = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/;
        if (!regexSenha.test(senha)) {
          mostrarTooltip($('#senha'), 'A senha deve conter pelo menos 6 caracteres, incluindo letras e números.');
          formIsValid = false;
        }

        // Confirmação de senha
        if (senha !== confirmarsenha) {
          mostrarTooltip($('#confirmarsenha'), 'As senhas não coincidem.');
          formIsValid = false;
        }

        // Se o formulário for válido, submeter
        if (formIsValid) {
          this.submit();
        }
      });
    </script>
  </main>
</body>

</html>