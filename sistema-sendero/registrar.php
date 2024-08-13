<!-- <php
include('config.php');

$msg = "";
$Error_Pass = "";

if (isset($_POST['submit'])) {
  $name = mysqli_real_escape_string($conx, $_POST['Username']);
  $email = mysqli_real_escape_string($conx, $_POST['Email']);
  $Password = mysqli_real_escape_string($conx, md5($_POST['Password']));
  $Confirm_Password = mysqli_real_escape_string($conx, md5($_POST['Conf-Password']));
  $Code = mysqli_real_escape_string($conx, md5(rand()));

  if (mysqli_num_rows(mysqli_query($conx, "SELECT * FROM register where email='{$email}'")) > 0) {
    $msg = "<div class='alert alert-danger'>Este correo: '{$email}' ya está registrado.</div>";
  } else {
    if ($Password === $Confirm_Password) {
      $query = "INSERT INTO register(`Username`, `email`, `Password`, `CodeV`) values('$name','$email','$Password','$Code')";
      $result = mysqli_query($conx, $query);

      if ($result) {
        $msg = "<div class='alert alert-success'>Registro exitoso. Ahora puedes iniciar sesión.</div>";
      } else {
        $msg = "<div class='alert alert-danger'>Ocurrió un error durante el registro.</div>";
      }
    } else {
      $msg = "<div class='alert alert-danger'>Las contraseñas no coinciden.</div>";
      $Error_Pass = 'style="border:1px Solid red;box-shadow:0px 1px 11px 0px red"';
    }
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
  <title>Crear cuenta</title>
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

    .alert-info {
      background-color: #2E9AFE;
    }

    .alert-warning {
      background-color: #ff9966;
    }
  </style>
</head>

<body>
  <div class="container sign-up-mode">
    <div class="forms-container">
      <div class="signin-signup">
        <form action="" method="POST" class="sign-up-form">
          <h2 class="title">Crea tu cuenta</h2>
          <php echo $msg ?>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="text" name="Username" placeholder="Usuario" value="<php if (isset($_POST['Username'])) { echo $name; } ?>" />
          </div>
          <div class="input-field">
            <i class="fas fa-envelope"></i>
            <input type="email" name="Email" placeholder="Correo" value="<php if (isset($_POST['Email'])) { echo $email; } ?>" />
          </div>
          <div class="input-field" <php echo $Error_Pass ?>>
            <i class="fas fa-lock"></i>
            <input type="password" name="Password" placeholder="Contraseña" />
          </div>
          <div class="input-field" <php echo $Error_Pass ?>>
            <i class="fas fa-lock"></i>
            <input type="password" name="Conf-Password" placeholder="Confirmar contraseña" />
          </div>
          <input type="submit" name="submit" class="btn" value="Sign up" />
        </form>
      </div>
    </div>
    <div class="panels-container">
      <div class="panel left-panel">
      </div>
      <div class="panel right-panel">
        <div class="content">
          <h3>¿Ya tienes cuenta?</h3>
          <p>
            ¡Por favor, inicia sesión!
          </p>
          <a href="index.php" class="btn transparent" id="sign-in-btn" style="padding:10px 20px;text-decoration:none">
            Iniciar sesión
          </a>
        </div>
        <img src="img/register.svg" class="image" alt="" />
      </div>
    </div>
  </div>
</body>

</html>
 -->

<?php
include('config.php');

$msg = "";
$Error_Pass = "";

if (isset($_POST['submit'])) {
  $name = mysqli_real_escape_string($conx, $_POST['Username']);
  $email = mysqli_real_escape_string($conx, $_POST['Email']);
  $Password = mysqli_real_escape_string($conx, md5($_POST['Password']));
  $Confirm_Password = mysqli_real_escape_string($conx, md5($_POST['Conf-Password']));
  $Code = mysqli_real_escape_string($conx, md5(rand()));

  if (mysqli_num_rows(mysqli_query($conx, "SELECT * FROM register where email='{$email}'")) > 0) {
    $msg = "<div class='alert alert-danger'>Este correo: '{$email}' ya está registrado.</div>";
  } else {
    if ($Password === $Confirm_Password) {
      $query = "INSERT INTO register(`Username`, `email`, `Password`, `CodeV`) values('$name','$email','$Password','$Code')";
      $result = mysqli_query($conx, $query);

      if ($result) {
        $msg = "<div class='alert alert-success'>Registro exitoso. Ahora puedes iniciar sesión.</div>";
      } else {
        $msg = "<div class='alert alert-danger'>Ocurrió un error durante el registro.</div>";
      }
    } else {
      $msg = "<div class='alert alert-danger'>Las contraseñas no coinciden.</div>";
      $Error_Pass = 'style="border:1px Solid red;box-shadow:0px 1px 11px 0px red"';
    }
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
  <title>Crear cuenta</title>
</head>

<body>
  <div class="container sign-up-mode">
    <div class="forms-container">
      <div class="signin-signup">
        <form action="" method="POST" class="sign-up-form">
          <h2 class="title">Crea tu cuenta</h2>
          <?php echo $msg ?>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="text" name="Username" placeholder="Usuario" value="<?php if (isset($_POST['Username'])) { echo $name; } ?>" />
          </div>
          <div class="input-field">
            <i class="fas fa-envelope"></i>
            <input type="email" name="Email" placeholder="Correo" value="<?php if (isset($_POST['Email'])) { echo $email; } ?>" />
          </div>
          <div class="input-field" <?php echo $Error_Pass ?>>
            <i class="fas fa-lock"></i>
            <input type="password" name="Password" placeholder="Contraseña" />
          </div>
          <div class="input-field" <?php echo $Error_Pass ?>>
            <i class="fas fa-lock"></i>
            <input type="password" name="Conf-Password" placeholder="Confirmar contraseña" />
          </div>
          <input type="submit" name="submit" class="btn" value="Registrar" />
        </form>
      </div>
    </div>
    <div class="panels-container">
      <div class="panel left-panel">
      </div>
      <div class="panel right-panel">
        <div class="content">
          <h3>¿Ya tienes cuenta?</h3>
          <p>
            ¡Por favor, inicia sesión!
          </p>
          <a href="index.php" class="btn transparent" id="sign-in-btn" style="padding:10px 20px;text-decoration:none">
            Iniciar sesión
          </a>
        </div>
        <img src="img/register.svg" class="image" alt="" />
      </div>
    </div>
  </div>
</body>

</html>
