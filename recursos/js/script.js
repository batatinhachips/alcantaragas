function toggleMenu() {
  const menu = document.getElementById("menu");
  menu.classList.toggle(
    "show"
  ); /* Alterna a classe 'show' para mostrar/ocultar o menu */
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

$(document).ready(function () {
  $("#formVenda").on("submit", function (event) {
    event.preventDefault();
    const produto = $("#produto").val();
    const quantidade = parseInt($("#quantidade").val());
    const preco = parseFloat($("#preco").val());
    const formaPagamento = $("#formaPagamento").val();
    const endereco = $("#endereco").val();
    const total = (quantidade * preco).toFixed(2);

    $.ajax({
      url: "add_venda.php",
      type: "POST",
      data: {
        produto,
        quantidade,
        preco,
        total,
        formaPagamento,
        endereco,
      },
      success: function (response) {
        Swal.fire("Sucesso!", "Venda adicionada com sucesso!", "success");
        adicionarVendaNaTabela(response);
        $("#formVenda")[0].reset();
      },
      error: function () {
        Swal.fire("Erro!", "Não foi possível adicionar a venda.", "error");
      },
    });
  });

  function adicionarVendaNaTabela(venda) {
    const row = `<tr>
                <td>${venda.id_venda}</td>
                <td>${venda.produto}</td>
                <td>${venda.quantidade}</td>
                <td>R$ ${parseFloat(venda.preco).toFixed(2)}</td>
                <td>R$ ${venda.total}</td>
                <td>${venda.forma_pagamento}</td>
                <td>${venda.endereco}</td>
            </tr>`;
    $("#tabelaVendas tbody").append(row);
  }
});

$(document).ready(function () {
  $("#formVenda").on("submit", function (event) {
    event.preventDefault();
    const produto = $("#produto").val();
    const quantidade = parseInt($("#quantidade").val());
    const preco = parseFloat($("#preco").val());
    const formaPagamento = $("#formaPagamento").val();
    const endereco = $("#endereco").val();
    const total = (quantidade * preco).toFixed(2);

    $.ajax({
      url: "add_venda.php",
      type: "POST",
      data: {
        produto,
        quantidade,
        preco,
        total,
        formaPagamento,
        endereco,
      },
      success: function (response) {
        Swal.fire("Sucesso!", "Venda adicionada com sucesso!", "success");
        adicionarVendaNaTabela(response);
        $("#formVenda")[0].reset();
      },
      error: function () {
        Swal.fire("Erro!", "Não foi possível adicionar a venda.", "error");
      },
    });
  });

  function adicionarVendaNaTabela(venda) {
    const row = `<tr>
              <td>${venda.id_venda}</td>
              <td>${venda.produto}</td>
              <td>${venda.quantidade}</td>
              <td>R$ ${parseFloat(venda.preco).toFixed(2)}</td>
              <td>R$ ${venda.total}</td>
              <td>${venda.forma_pagamento}</td>
              <td>${venda.endereco}</td>
          </tr>`;
    $("#tabelaVendas tbody").append(row);
  }
});
