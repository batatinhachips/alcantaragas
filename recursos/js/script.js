function toggleMenu() {
    const menu = document.getElementById('menu');
    menu.classList.toggle('show');
}

$(document).ready(function() {
    // Centralizar o título
    $('.login-title').css('display', 'flex').css('flex-direction', 'column').css('align-items', 'center');

    // Mostrar o formulário de recuperação de senha e esconder o de login
    $('#forgot-password-btn').click(function() {
      $('#login-form').hide();
      $('#forgot-password-form').show();
    });

    // Voltar ao formulário de login
    $('#back-to-login-btn').click(function() {
      $('#forgot-password-form').hide();
      $('#login-form').show();
    });
  });