<!DOCTYPE html>
<html lang="pt-BR">
<?php
session_start();
?>

<head>
  <title>EDITAR ADMIN</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="../recursos/imagens/icon.png" type="image/png">
  <link href="../recursos/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="../recursos/css/produtos.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <script src="../recursos/js/bootstrap.bundle.min.js"></script>
  <script src="../recursos/js/jquery-3.5.1.slim.min.js"></script>
  <script src="../recursos/js/popper.min.js"></script>
  <script src="../recursos/js/script.js"></script>
</head>

<body>
<div class="login-title text-center">
      <a href="/">
        <img src="../recursos/imagens/logo_nav.png" alt="Logo" class="logo">
      </a>
      <h1>EDITAR ADMIN</h1>
    </div>

<?php
include '../controladora/conexao.php';
include '../modelo/usuario.php';
include '../repositorio/usuarios_repositorio.php';

$usuariosRepositorio = new usuarioRepositorio($conn);

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_usuario = filter_input(INPUT_POST, 'id_usuario', FILTER_VALIDATE_INT);

    if ($id_usuario) {
        $sql = "SELECT * FROM usuario WHERE id_usuario = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $usuario = $result->fetch_assoc();
            ?>

            <!-- Formulário de edição -->
            <form action="../controladora/processar_editar_admin.php" method="POST" enctype="multipart/form-data" class="formulario-edicao">
                <input type="hidden" name="id_usuario" value="<?= $usuario["id_usuario"] ?>">

                <label for="nome" class="titulo-campo">Nome:</label>
                <input type="text" name="nome" value="<?= htmlspecialchars($usuario["nome"]) ?>" class="custom-input" required><br>

                <label for="email" class="titulo-campo">Email:</label>
                <input type="email" name="email" value="<?= htmlspecialchars($usuario["email"]) ?>" class="custom-input" required><br>

                <label for="senha" class="titulo-campo">Senha:</label>
                <input type="password" name="senha" class="custom-input" placeholder="Nova Senha (deixe vazio para manter a atual)"><br>

                <button type="submit" class="btn btn-primary btn-lg btn-block botao-salvar-edicoes">Salvar edições</button>
            </form>

            <?php
        } else {
            echo "Admin não encontrado";
        }

        // Fecha a declaração
        $stmt->close();
    } else {
        echo "ID do usuário não foi fornecido.";
    }
}

$conn->close();
?>

</body>
</html>
