<?php
$senha = 'manoel';
$hash_senha = password_hash($senha, PASSWORD_BCRYPT);

// Exibir o hash para inserção no banco de dados
echo $hash_senha;

// Verificar a senha
$senha_admin = 'manoel';
if (password_verify($senha_admin, $hash_senha)) {
    echo 'Senha correta!';
} else {
    echo 'Senha incorreta!';
}
