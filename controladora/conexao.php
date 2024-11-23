<?php
$servername = "localhost";
$username = "ifhostgru_alcantaragas";
$password= "webwebifsp";
$dbname = "ifhostgru_alcantaragas";

//criação da conexão
$conn = new mysqli ($servername, $username, $password, $dbname);

//verificando a conexão
if (!$conn){
    die("conexão falhou" . mysqli_connect_error());
}

