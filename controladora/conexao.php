<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

$servername = "localhost";
$username = "ifhostgru_alcantaragas";
$password= "alcantaragas";
$dbname = "ifhostgru_alcantaragas";

//criação da conexão
$conn = new mysqli ($servername, $username, $password, $dbname);

//verificando a conexão
if (!$conn){
    die("conexão falhou" . mysqli_connect_error());
}
else{
    echo " ";
}

