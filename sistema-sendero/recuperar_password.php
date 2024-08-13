<!--<php
include('config.php');

$msg = "";

if (isset($_POST['submit'])) {
  $email = mysqli_real_escape_string($conx, $_POST['email']);
  $CodeReset = mysqli_real_escape_string($conx, md5(rand()));

  if (mysqli_num_rows(mysqli_query($conx, "SELECT * FROM register WHERE email='{$email}'")) > 0) {
    $query = mysqli_query($conx, "UPDATE register SET CodeV='{$CodeReset}' WHERE email='{$email}'");
    
    if ($query) {
      $msg = "<div class='alert alert-success'>Hemos enviado un código de recuperación a tu correo.</div>";
    } else {
      $msg = "<div class='alert alert-danger'>Ocurrió un error al intentar enviar el código de recuperación.</div>";
    }
  } else {
    $msg = "<div class='alert alert-danger'>Este correo no fue encontrado.</div>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="style.css" />
  <title>Recuperar contraseña</title>
  <style>
    .alert {
      padding: 1rem;
      border-radius: 5px;
      color: white;
      margin: 1rem 0;
      font-weight: 500;
      width: 65%;
    }

    .alert-success {
      background-color: #42ba96;
    }

    .alert-danger {
      background-color: #fc5555;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="forms-container">
      <div class="signin-signup" style="left: 50%;z-index:99;">
        <form action="" method="POST" class="sign-in-form">
          <h2 class="title">Recuperar contraseña</h2>
          <php echo $msg ?>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="text" name="email" placeholder="Correo" />
          </div>
          <input type="submit" name="submit" value="Send" class="btn solid" />
        </form>
      </div>
    </div>
  </div>

  <script src="app.js"></script>
</body>

</html>
 -->

<?php
session_start();
include('config.php');

$msg = "";

if (isset($_POST['submit'])) {
  $email = mysqli_real_escape_string($conx, $_POST['email']);
  $token = bin2hex(random_bytes(50));  // Generar un token aleatorio de 50 caracteres

  $user_check_query = "SELECT * FROM register WHERE email='$email' LIMIT 1";
  $result = mysqli_query($conx, $user_check_query);

  if (mysqli_num_rows($result) > 0) {
    // Almacenar el token en la base de datos junto con la fecha actual
    $query = "UPDATE register SET reset_token='$token', token_expire=DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE email='$email'";
    if (mysqli_query($conx, $query)) {
      // Generar el enlace de restablecimiento
      $reset_link = "http://localhost/senderomillonario/sistema-sendero/reset_password.php?token=" . $token;

      // Mostrar el enlace en la página para pruebas locales
      $msg = "<div class='alert alert-success'>Hemos generado un enlace para restablecer tu contraseña. <a href='$reset_link'>Haz clic aquí para restablecerla</a></div>";

      // Opcional: Puedes imprimir el enlace directamente en la página si prefieres
      //echo "Enlace de restablecimiento: <a href='$reset_link'>$reset_link</a>";
    } else {
      $msg = "<div class='alert alert-danger'>Hubo un error al procesar tu solicitud.</div>";
    }
  } else {
    $msg = "<div class='alert alert-danger'>Este correo no fue encontrado.</div>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="style.css" />
  <title>Recuperar contraseña</title>
</head>

<body>
  <div class="container">
    <div class="forms-container">
      <div class="signin-signup" style="left: 50%;z-index:99;">
        <form action="" method="POST" class="sign-in-form">
          <h2 class="title">Recuperar contraseña</h2>
          <?php echo $msg ?>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="text" name="email" placeholder="Correo" />
          </div>
          <input type="submit" name="submit" value="Enviar" class="btn solid" />
        </form>
      </div>
    </div>
  </div>
</body>

</html>