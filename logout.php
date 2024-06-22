<?php
//Inicializa Sessão
session_start();

//Destroi as Variaveis
unset($_SESSION['iduser']);
unset($_SESSION['nome']);
session_destroy();

//Redireciona para a tela de login
Header("Location: index.php");
?>