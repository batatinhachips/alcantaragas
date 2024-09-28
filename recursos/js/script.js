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

  // Adicionar lógica de menu apenas se estiver na página admin.php
  if (window.location.pathname.includes('admin.php')) {
      function toggleMenu() {
          const menu = document.getElementById('menu');
          menu.classList.toggle('show');
          
          // Lógica para mostrar/esconder opções
          const adminOption = document.querySelector('.dropdown-content .dropdown-item:nth-child(1)');
          const logoutOption = document.querySelector('.dropdown-content .dropdown-item:nth-child(2)');
          const newAdminOption = document.querySelector('.dropdown-content .dropdown-item:nth-child(3)');
          const newProductOption = document.querySelector('.dropdown-content .dropdown-item:nth-child(4)');
          const clientsTableOption = document.querySelector('.dropdown-content .dropdown-item:nth-child(5)');

          if (menu.classList.contains('show')) {
              // Exibir os botões desejados
              newAdminOption.style.display = 'block';
              newProductOption.style.display = 'block';
              clientsTableOption.style.display = 'block';
              // Ocultar opções "Admin" e "Sair"
              adminOption.style.display = 'none';
              logoutOption.style.display = 'none';
          } else {
              // Voltar ao padrão
              newAdminOption.style.display = 'none';
              newProductOption.style.display = 'none';
              clientsTableOption.style.display = 'none';
              adminOption.style.display = 'block';
              logoutOption.style.display = 'block';
          }
      }

      // Associe a função toggleMenu ao ícone de menu
      $('.menu-icon').click(toggleMenu);
  }
});
