<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Endereço</title>
    <link href="../recursos/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <h2>Cadastro de Endereço</h2>

        <form action="../controladora/processar_cadastro_endereco.php" method="POST">
            <label for="bairro" class="titulo-campo">Bairro:</label>
            <input type="text" id="bairro" name="bairro" class="custom-input" required>

            <label for="numero" class="titulo-campo">Número:</label>
            <input type="text" id="numero" name="numero" class="custom-input" required>

            <label for="rua" class="titulo-campo">Rua:</label>
            <input type="text" id="rua" name="rua" class="custom-input" required>

            <label for="cidade" class="titulo-campo">Cidade:</label>
            <input type="text" id="cidade" name="cidade" class="custom-input" required>

            <input type="submit" name="cadastrar_endereco" class="btn btn-primary" value="Cadastrar Endereço">
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

</body>

</html>