<?php
session_start();

include 'DBConnection.php';

if (isset($_POST['nome']) && isset($_POST['pass'])) {
    $nome = mysqli_real_escape_string($link, $_POST['nome']);
    $pass = mysqli_real_escape_string($link, $_POST['pass']);

    // Consulta SQL para selecionar o usuário com o nome fornecido
    $qry = "SELECT id_user, nome, pass FROM utilizadores WHERE nome='$nome'";
    $result = mysqli_query($link, $qry);

    if (!$result || mysqli_num_rows($result) == 0) {
        // Usuário não encontrado
        $_SESSION['erro'] = 1;
        header("Location: index.php?erro=1");
        exit;
    } else {
        $row = mysqli_fetch_assoc($result);
        $hashed_password = $row['pass']; // Senha criptografada armazenada no banco de dados

        // Verifica se a senha fornecida corresponde à senha criptografada no banco de dados
        if (password_verify($pass, $hashed_password)) {
            $_SESSION['iduser'] = $row['id_user'];
            $_SESSION['nome'] = $row['nome'];
            $_SESSION['erro'] = 0;

            if ($_SESSION['iduser'] == '0') {
                header("Location: page-inicial.php");
                exit;
            } else {
                header("Location: users.php");
                exit;
            }
        } else {
            // Senha incorreta
            $_SESSION['erro'] = 1;
            header("Location: index.php?erro=1");
            exit;
        }
    }

    mysqli_free_result($result);
} else {
    // Dados não foram recebidos corretamente
    $_SESSION['erro'] = 1;
    header("Location: index.php?erro=1");
    exit;
}

mysqli_close($link); // Fecha a conexão com o banco de dados
?>
