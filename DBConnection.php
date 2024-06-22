<?php
$host = 'localhost';
$username = 'root';
$password = '';
$db_name = 'proday';

// Cria a conexão
$link = mysqli_connect($host, $username, $password, $db_name);

// Verifica a conexão
if (!$link) {
    die('Erro de conexão: ' . mysqli_connect_error());
}
?>
