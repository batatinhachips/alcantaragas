<?php

$servername = "localhost";
$username = "ifhostgru_alcantaragas";
$password= "alcantaragas";
$dbname = "ifhostgru_alcantaragas";

//criação da conexão
$conn = new mysqli ($servername, $username, $password, $dbname);

print_r($conn);

//verificando a conexão
if (!$conn){
    die("conexão falhou" . mysqli_connect_error());
}
else{
    echo " ";
}

