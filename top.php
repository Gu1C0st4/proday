<?php
// Inclui o arquivo de conexão com o banco de dados
include "DBConnection.php";

// Inicia a sessão
session_start();

// Verifica se o usuário já está logado
if (isset($_SESSION['iduser'])) {
    header('Location: index.php');
    exit;
}
?>