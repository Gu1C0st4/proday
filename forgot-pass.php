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

    <style>
        .confirm-message, .error-message {
            display: none;
            background-color: #ffffff; /* Cor de fundo branca */
            color: #333; /* Cor do texto */
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); /* Sombra */
            text-align: center;
            position: fixed;
            bottom: 20px; /* Posiciona na parte inferior */
            left: 50%; /* Centraliza horizontalmente */
            transform: translateX(-50%);
            z-index: 1000; /* Garante que esteja na frente de outros elementos */
        }
    </style>
</head>

<body class="body_forgot">

    <div class="preloader">
        <div class="loader"></div>
    </div>

    <div class="wrapper">
        <form action="forgot-pass.php" method="POST">
            <h1>Recuperar Password</h1>
            <div class="input-box">
                <input type="text" name="user" id="username" placeholder="Nome de Utilizador ou E-mail" required />
                <i class='bx bx-user-plus'></i>
            </div>
        
            <button type="submit" class="btn" id="btn-registar" name="submit"> Enviar Pedido </button>
        </form>
    </div>

    <!-- Elemento de mensagem de confirmação -->
    <div class="confirm-message" id="confirm-message">
        <i class='bx bx-check-circle'></i> Pedido enviado com sucesso!
    </div>

    <!-- Mensagem de erro -->
    <div class="error-message" id="error-message">
        <i class='bx bx-error-circle'></i> Não foi possível enviar o pedido. Utilizador ou e-mail não encontrado.
    </div>

    <noscript>Seu navegador não suporta JavaScript!</noscript>
    <script src="./scripts.js"></script>

    <?php
    if (isset($_POST['submit'])) {
        $user_input = mysqli_real_escape_string($link, $_POST['user']);
        $user_type = filter_var($user_input, FILTER_VALIDATE_EMAIL) ? 'email' : 'nome';
        $pedido = $user_input;

        // Verifica se o utilizador ou e-mail existe na base de dados
        $stmt_check = mysqli_prepare($link, "SELECT id_user FROM utilizadores WHERE $user_type = ?");
        if ($stmt_check) {
            mysqli_stmt_bind_param($stmt_check, 's', $pedido);
            mysqli_stmt_execute($stmt_check);
            mysqli_stmt_store_result($stmt_check);

            // Se houver resultados, atualiza a senha temporária
            if (mysqli_stmt_num_rows($stmt_check) > 0) {
                // Usando prepared statements para evitar SQL Injection
                $stmt_update = mysqli_prepare($link, "UPDATE utilizadores SET senha_temporaria = ? WHERE $user_type = ?");
                if ($stmt_update) {
                    mysqli_stmt_bind_param($stmt_update, 'ss', $pedido, $user_input);

                    $result = mysqli_stmt_execute($stmt_update);

                    if ($result) {
                        // Mostra a mensagem de confirmação após o envio bem-sucedido e redireciona após 3 segundos
                        echo "<script>document.getElementById('confirm-message').style.display = 'block'; setTimeout(function() { window.location.href = 'index.php'; }, 5000);</script>";
                    } else {
                        echo "Erro ao atualizar senha temporária: " . mysqli_stmt_error($stmt_update);
                    }

                    mysqli_stmt_close($stmt_update);
                } else {
                    echo "Erro ao preparar a statement de atualização: " . mysqli_error($link);
                }
            } else {
                // Mostra mensagem de erro porque o utilizador ou e-mail não foi encontrado e redireciona após 3 segundos
                echo "<script>document.getElementById('error-message').style.display = 'block'; setTimeout(function() { window.location.href = 'index.php'; }, 3000);</script>";
            }

            mysqli_stmt_close($stmt_check);
        } else {
            echo "Erro ao preparar a statement de verificação: " . mysqli_error($link);
        }

        mysqli_close($link);
    }
    ?>
</body>
</html>
