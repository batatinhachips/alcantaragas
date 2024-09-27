<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <title>Alcântara Gás</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- LINKS -->
  <link rel="icon" href="recursos/imagens/icon.png" type="image/png">
  <link href="recursos/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="recursos/css/styles.css">
  <link rel="stylesheet" href="https://cdn.positus.global/production/resources/robbu/whatsapp-button/whatsapp-button.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <script src="recursos/js/bootstrap.bundle.min.js"></script>
  <script src="recursos/js/jquery-3.5.1.slim.min.js"></script>
  <script src="recursos/js/popper.min.js"></script>
  <script src="recursos/js/script.js"></script>
  <!-- FIM DOS LINKS -->
</head>

<?php
session_start();
include_once './controladora/conexao.php';
include_once './modelo/produtos.php';
include_once './repositorio/produtos_repositorio.php';
include_once "./controladora/autenticacao.php";

$produtosRepositorio = new produtoRepositorio($conn);
$produtos = $produtosRepositorio->buscarTodos();
?>

<body>
  <!-- Botão do WhatsApp -->
  <a id="robbu-whatsapp-button" target="_white" href="https://api.whatsapp.com/send?phone=5511958780556&text=Ol%C3%A1,%20eu%20gostaria%20de%20fazer%20um%20pedido!%0AProduto(s):%0AQuantidade:%0AMeu%20endere%C3%A7o:%0AMeu%20nome:%0ARetirar%20ou%20entrega:">
    <div class="rwb-tooltip" style="background-color: #fff;">Faça o seu pedido agora!</div>
    <img src="https://cdn.positus.global/production/resources/robbu/whatsapp-button/whatsapp-icon.svg">
  </a>

  <nav class="navbar navbar-expand-sm navbar-custom navbar-dark fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="/">
        <img src="recursos/imagens/logo_nav.png" alt="Logo da Empresa" style="height: 40px;">
      </a>

      <!-- Links de navegação e botões -->
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto d-flex align-items-center">
          <li class="nav-item">
            <a class="nav-link active" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="#services">Produtos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="#empresa">Empresa</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="#footer">Localização</a>
          </li>
        </ul>
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
          <?php if (isset($_SESSION["papel"]) && $_SESSION["papel"] == "admin") { ?>
            <a class="dropdown-item" href="visao/admin.php">Admin</a>
          <?php } ?>
          <?php if (isset($_SESSION["nome_usuario"])) { ?>
            <a class="dropdown-item" href="controladora/logout.php">Sair</a>
          <?php } else { ?>
            <a class="dropdown-item" href="visao/formLogin.php">Login</a>
            <a class="dropdown-item" href="visao/cadastrar_cliente.php">Cadastre-se</a>
          <?php } ?>
        </div>
      </nav>
    </div>
  </nav>


  <!-- LINKS DE NAVEGACAO E BOTOES -->
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ms-auto d-flex align-items-center">
    </ul>
  </div>
  </div>
  </nav>

  <!-- Carrossel -->
  <div id="demo" class="carousel slide" data-bs-ride="carousel">

    <!-- Indicadores -->
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
      <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
    </div>

    <!-- Slideshow/carrossel -->
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="recursos/imagens/banner.jpg" alt="Banner" class="d-block w-100 carousel-image">
      </div>
      <div class="carousel-item">
        <img src="recursos/imagens/faixada.jpg" alt="Faixada" class="d-block w-100 carousel-image">
      </div>
    </div>
  </div>

  <!-- SESSAO DO CATALOGO -->
  <div class="custom-title">Os nossos produtos</div>
  <section id="services" class="services">
    <div class="container" data-aos="fade-up">
      <div class="row">
        <?php foreach ($produtos as $produto) : ?>
          <div class="col">
            <div class="card custom-card">
              <img src="recursos/imagens/<?= $produto->getImagem() ?>" alt="<?= $produto->getNome() ?>">
              <div class="custom-card-body">
                <h5 class="custom-card-title"><?= $produto->getNome() ?></h5>
                <p class="custom-card-text"><?= $produto->getDescricao() ?></p>
                <h4>R$ <?= number_format($produto->getPreco(), 2, ',', '.') ?></h4>
                <!-- <a href="https://wa.me/5511958780556?text=Ol%C3%A1!%20Gostaria%20de%20pedir%20um%20G%C3%A1s%20Liquig%C3%A1s%20P13!" class="btn btn-primary">Faça um pedido!</a> -->
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
      <div id="entrega">*valores dos produtos a retirar*</div>
      <br>
      <!-- BOTÃO WHATSAPP CENTRO -->
      <div>
        <a href="https://api.whatsapp.com/send/?phone=5511958780556&text=Olá%2C+eu+gostaria+de+fazer+um+pedido%21%0AProduto%28s%29%3A%0AQuantidade%3A%0AMeu+endereço%3A%0AMeu+nome%3A%0ARetirar+ou+entrega%3A&type=phone_number&app_absent=0" class="whatsapp-link" target="_blank">
          <button class="btn btn-success text-white whatsapp">
            <i class="fab fa-whatsapp icon-spacing"></i> Faça um pedido!
          </button>
      </div>
      </a>
    </div>

  </section>

  <!-- SESSÃO DA EMPRESA -->
  <section id="empresa" class="empresa">
    <br>
    <div class="container company-container mt-5">
      <div class="row company-row gx-4 justify-content-center">
        <!-- Coluna de Informações da Empresa e Contatos -->
        <div class="col-lg-10">
          <div class="company-info-wrapper">
            <div class="company-info-box">
              <h2>Sobre a empresa</h2>
              <div class="company-info">
                <!-- Imagem da fachada -->
                <div class="faixada">
                  <img src="recursos/imagens/faixada.jpg" class="img-faixada rounded" alt="Cinque Terre">
                </div>
                <!-- Texto da empresa -->
                <div class="info-text">
                  <h5>Fundada em 1994</h5>
                  <p>
                    Na Alcântara Gás, nossa missão é fornecer soluções práticas e confiáveis para suas necessidades diárias de água e gás. Com uma forte presença nas regiões de Itaquaquecetuba e Arujá, somos a escolha preferida para quem busca qualidade e eficiência.<br>
                    Nosso compromisso é entregar não apenas produtos, mas também a tranquilidade e segurança que você e sua família merecem. Oferecemos botijões de gás e galões de água com o mais alto padrão de qualidade e com um serviço de entrega ágil e confiável.<br>
                    Escolha a Alcântara Gás para uma experiência sem preocupações e descubra por que somos líderes no fornecimento de água e gás na sua região. Entre em contato conosco e faça parte da nossa família de clientes satisfeitos!
                  </p>
                </div>
              </div>
            </div>
            <div class="contatos-box">
              <h3>Fale conosco!</h3>
              <p>Faça seu pedido.</p>
              <br>
              <ul class="nav nav-pills flex-column">
                <li class="contato">
                  <a>(11) 95878-0556</a>
                </li>
                <li class="contato">
                  <a>(11) 4643-4728</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Mapa -->
  <div class="mapa-container mt-5">
    <div class="mapa">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3661.052068874323!2d-46.34871968822513!3d-23.42248617880744!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ce7d43a74efa8f%3A0x50bbde1a6226054f!2sM%20de%20Alc%C3%A2ntara%20Pereira%20G%C3%A1s!5e0!3m2!1spt-BR!2sbr!4v1724381294662!5m2!1spt-BR!2sbr" allowfullscreen="" loading="lazy"></iframe>
    </div>
  </div>

  <!-- FIM DA SESSAO DA EMPRESA -->

  <!-- ======= RODAPÉ ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6">
            <div class="footer-info">
              <h3>ALCÂNTARA GÁS<span>.</span></h3>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="footer-contact">
              <h4>Horário de Funcionamento</h4>
              <p>
                Seg - Sab: 8h - 21h<br>
                Domingos e Feriados: 8h - 19h
              </p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="footer-contact">
              <h4>Endereço</h4>
              <p>
                Estr. Pedro da Cunha Albuquerque Lopes, 1873<br>
                Jardim Silvestre, Itaquaquecetuba - SP<br>
                CEP: 08584-584<br>
              </p>
            </div>
          </div>
          <div class="col-lg-2 col-md-6">
            <div class="footer-contact">
              <h4>Siga-nos</h4>
              <div class="social-links">
                <a href="https://www.facebook.com/m.de.alcantara.pereira.gas/" target="_blank" class="social-icon"><i class="bi bi-facebook"></i></a>
                <a href="https://www.instagram.com/alcantara_gas" target="_blank" class="social-icon"><i class="bi bi-instagram"></i></a>
                <a href="https://api.whatsapp.com/send/?phone=5511958780556&text=Olá%2C+eu+gostaria+de+fazer+um+pedido%21%0AProduto%28s%29%3A%0AQuantidade%3A%0AMeu+endereço%3A%0AMeu+nome%3A%0ARetirar+ou+entrega%3A&type=phone_number&app_absent=0" target="_blank" class="social-icon"><i class="bi bi-whatsapp"></i></a>
              </div>
            </div>
          </div>


        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Alcântara Gás</span></strong><br>
        Todos os direitos reservados
      </div>
    </div>
  </footer><!-- FINAL DO RODAPÉ -->

</body>

</html>