function toggleMenu() {
  const menu = document.getElementById("menu");
  menu.classList.toggle("show");
}

$(document).ready(function () {
  // Centralizar o título
  $(".login-title")
    .css("display", "flex")
    .css("flex-direction", "column")
    .css("align-items", "center");

  // Mostrar o formulário de recuperação de senha e esconder o de login
  $("#forgot-password-btn").click(function () {
    $("#login-form").hide();
    $("#forgot-password-form").show();
  });

  // Voltar ao formulário de login
  $("#back-to-login-btn").click(function () {
    $("#forgot-password-form").hide();
    $("#login-form").show();
  });
});

// Verifica se a página atual é admin.php
if (window.location.pathname.includes("admin.php")) {
  function toggleMenu() {
    const menu = document.getElementById("menu");
    const isVisible = menu.classList.contains("show");

    // Alternar visibilidade do menu
    menu.classList.toggle("show");

    // Se o menu estiver visível, esconder opções admin e sair
    if (isVisible) {
      document.querySelector(
        ".dropdown-content .dropdown-item:nth-child(1)"
      ).style.display = "none"; // Ocultar "Admin"
      document.querySelector(
        ".dropdown-content .dropdown-item:nth-child(2)"
      ).style.display = "none"; // Ocultar "Sair"
    } else {
      // Mostrar os botões novos no menu
      document.querySelector(
        ".dropdown-content .dropdown-item:nth-child(1)"
      ).style.display = "block"; // Mostrar "Novo Admin"
      document.querySelector(
        ".dropdown-content .dropdown-item:nth-child(2)"
      ).style.display = "block"; // Mostrar "Novo Produto"
      document.querySelector(
        ".dropdown-content .dropdown-item:nth-child(3)"
      ).style.display = "block"; // Mostrar "Tabela Clientes"
    }
  }
}
function toggleMenu() {
    var navbar = document.getElementById("navbarNav");
    navbar.classList.toggle("show");
  }
