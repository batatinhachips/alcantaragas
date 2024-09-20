 <?php
include '../controladora/conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cpf = $_POST['cpf'];

    // Prevenir SQL Injection
    $cpf = $conn->real_escape_string($cpf);

    // Buscar o cliente pelo CPF
    $sql = "SELECT senha FROM cliente WHERE cpf = '$cpf'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Exibir a senha
        $row = $result->fetch_assoc();
        echo "Sua senha é: " . $row['senha'];
    } else {
        echo "CPF não encontrado.";
    }
}

$conn->close();
?> 
