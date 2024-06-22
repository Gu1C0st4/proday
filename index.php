<?php include "top.php"; ?>

<!DOCTYPE html>
<html lang="pt">

<head>
  <!-- Google Fonts Pre Connect -->
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <!-- Meta Tags -->
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Fonts Links (Poppins) -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet" />

  <!-- Ícone -->
  <link rel="icon" href="img/logos/favicon.png" type="image/png">

  <!-- CSS Files Links -->
  <link rel="stylesheet" href="./styles.css" />

  <!-- Title -->
  <title>Aesthetic</title>
</head>

<body>
  <div class="wrapper">
    <form action="autenticar.php" method="POST">
      <h1>Entrar</h1>
      <div class="input-box">
        <input type="text" name="nome" id="" placeholder="Utilizador" required />
        <i class="bx bx-user-plus"></i>
      </div>

      <div class="input-box">
        <input type="password" name="pass" id="" placeholder="Password" required />
        <i class="bx bxs-lock-alt"></i>
      </div>

      <div class="remember-forgot">
        <label><input type="checkbox" name="lembrar" /> Lembrar-me </label>
        <a href="forgot-pass.php"> Esqueci-me da Password? </a>
      </div>

      <button type="submit" class="btn">Entrar</button>

      <div class="register-link">
        <p>Não tens Conta? <a href="register.php"> Regista-te! </a></p>
      </div>
    </form>
  </div>

  <noscript>Your browser doesn't support JavaScript!</noscript>
  <script src="./scripts.js"></script>
</body>

</html>