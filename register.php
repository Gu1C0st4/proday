<?php include "top.php"; ?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <!-- Meta Tags -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Google Fonts Pre Connect -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="preconnect" href="https://fonts.googleapis.com" />

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- CSS Files Links -->
    <link rel="stylesheet" href="./styles.css" />

    <!-- Title -->
    <title>Aesthetic</title>
</head>

<body class="body_register">

    <div class="preloader">
        <div class="loader"></div>
    </div>

    <div class="wrapper">
        <form action="register.php" method="POST">
            <h1>Registar</h1>
            <div class="input-box">
                <input type="text" name="nome" id="username" placeholder="Nome de Utilizador" required />
                <i class='bx bx-user-plus'></i>
            </div>

            <div class="input-box">
                <input type="email" name="email" id="email" placeholder="E-mail" required/>
                <i class='bx bx-envelope'></i>
            </div>
        
            <div class="input-box">
                <input type="password" name="pass" id="password" placeholder="Password" required/>
                <i class='bx bxs-lock-alt' ></i>
            </div>
        
            <div class="input-box">
                <input type="password" name="confpass" id="confirm-password" placeholder="Confirmar Password" required/>
                <i class='bx bx-lock-alt'></i>
            </div>
        
            <button type="submit" class="btn" id="btn-registar" name="submit"> Registar </button>
        </form>
    </div>

    <noscript>Seu navegador não suporta JavaScript!</noscript>
    <script src="./scripts.js"></script>

    <?php
    if (isset($_POST['submit'])) {
        // Verifica se as senhas coincidem
        if ($_POST['pass'] !== $_POST['confpass']) {
            echo "<script>alert('As senhas não coincidem');</script>";
        } else {
            // Captura e valida os dados do formulário
            $nome = mysqli_real_escape_string($link, $_POST['nome']);
            $email = mysqli_real_escape_string($link, $_POST['email']);
            $pass = mysqli_real_escape_string($link, $_POST['pass']);
            $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

            // Usando prepared statements para evitar SQL Injection
            $stmt = mysqli_prepare($link, "INSERT INTO utilizadores (nome, pass, email) VALUES (?, ?, ?)");
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, 'sss', $nome, $hashed_pass, $email);

                $result = mysqli_stmt_execute($stmt);

                if ($result) {
                    header("Location: index.php");
                    exit;
                } else {
                    echo "Erro ao registrar usuário: " . mysqli_stmt_error($stmt);
                }

                mysqli_stmt_close($stmt);
            } else {
                echo "Erro ao preparar a statement: " . mysqli_error($link);
            }
        }

        mysqli_close($link);
    }
    ?>
</body>
</html>
