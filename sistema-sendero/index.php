<!--<php
include('config.php');
$msg = "";
$Error_Pass = "";

if (isset($_POST['submit'])) {
  $email = mysqli_real_escape_string($conx, $_POST['email']);
  $Pass = mysqli_real_escape_string($conx, md5($_POST['Password']));
  $sql = "SELECT * FROM register WHERE email='{$email}' and Password='{$Pass}'";
  $resulte = mysqli_query($conx, $sql);

  if (mysqli_num_rows($resulte) === 1) {
    $_SESSION['Email_Session'] = $email;
    header("Location: pagos_yape_plin.php"); // Redirige al nuevo formulario después del inicio de sesión
    exit();
  } else {
    $msg = "<div class='alert alert-danger'>El correo o la contraseña no coinciden</div>";
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
  <title>Ingreso sesión</title>
</head>

<body>
  <div class="container">
    <div class="forms-container">
      <div class="signin-signup">
        <form action="" method="POST" class="sign-in-form">
          <h2 class="title">Ingresa sesión</h2>
          <php if (!empty($msg)) echo $msg; ?>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="text" name="email" placeholder="Correo" />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" name="Password" placeholder="Contraseña" />
          </div>
          <div class="Forget-Pass">
            <a href="Forget.php" class="Forget">¿Recuperar contraseña?</a>
          </div>
          <input type="submit" name="submit" value="Login" class="btn solid" />
        </form>
      </div>
    </div>

    <div class="panels-container">
      <div class="panel left-panel">
        <div class="content">
          <h3>Bienvenido</h3>
          <p>
            Te invitamos a ingresar tu sesión o crear tu cuenta
          </p>
          <a href="SignUp.php" class="btn transparent" id="sign-in-btn" style="padding:10px 20px;text-decoration:none">
            Crear cuenta
          </a>
        </div>
        <img src="img/log.svg" class="image" alt="" />
      </div>
    </div>
  </div>
</body>

</html>
 -->

<?php
session_start(); // Iniciar la sesión
include('config.php'); // Incluir la configuración de la base de datos

$msg = "";

if (isset($_POST['submit'])) {
  // Asegúrate de que $conx está correctamente definida y contiene la conexión a la base de datos
  if (!isset($conx)) {
    die("La variable \$conx no está definida después de incluir config.php");
  }

  $email = mysqli_real_escape_string($conx, $_POST['email']);
  $Pass = mysqli_real_escape_string($conx, md5($_POST['Password']));
  $sql = "SELECT * FROM register WHERE email='{$email}' AND Password='{$Pass}'";
  $resulte = mysqli_query($conx, $sql);

  /*if (mysqli_num_rows($resulte) === 1) {
    $_SESSION['Email_Session'] = $email; // Guardar el email en la sesión
    $_SESSION['loggedin'] = true; // Indicamos que el usuario ha iniciado sesión

    // Verificar si el usuario ya ha ingresado un código anteriormente
    if (isset($_SESSION['codigo_ingresado']) && $_SESSION['codigo_ingresado'] === true) {
      header("Location: landing_page/index.html");
      exit();
    } else {
      // Si no ha ingresado un código, redirigir a pagos_yape_plin.php
      header("Location: pagos_yape_plin.php");
      exit();
    }
  } else {
    $msg = "<div class='alert alert-danger'>El correo o la contraseña no coinciden</div>";
  }*/
  if (mysqli_num_rows($resulte) === 1) {
    $row = mysqli_fetch_assoc($resulte);
    $_SESSION['Email_Session'] = $email; // Guardar el email en la sesión
    $_SESSION['loggedin'] = true; // Indicamos que el usuario ha iniciado sesión

    // Verificar si el usuario ya ha ingresado un código anteriormente
    if ($row['codigo_ingresado'] == 1) {
      header("Location: landing_page/index.html");
      exit();
    } else {
      // Si no ha ingresado un código, redirigir a pagos_yape_plin.php
      header("Location: pagos.php");
      exit();
    }
  } else {
    $msg = "<div class='alert alert-danger'>El correo o la contraseña no coinciden</div>";
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
  <title>Ingreso sesión</title>
</head>

<body>
  <div class="container">
    <div class="forms-container">
      <div class="signin-signup">
        <form action="" method="POST" class="sign-in-form">
          <h2 class="title">Ingresa sesión</h2>
          <?php if (!empty($msg)) echo $msg; ?>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="text" name="email" placeholder="Correo" required />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" name="Password" placeholder="Contraseña" required />
          </div>
          <div class="Forget-Pass">
            <a href="recuperar_password.php" class="Forget">¿Recuperar contraseña?</a>
          </div>
          <input type="submit" name="submit" value="Login" class="btn solid" />
        </form>
      </div>
    </div>

    <div class="panels-container">
      <div class="panel left-panel">
        <div class="content">
          <h3>Bienvenido</h3>
          <p>
            Te invitamos a ingresar tu sesión o crear tu cuenta
          </p>
          <a href="registrar.php" class="btn transparent" id="sign-in-btn" style="padding:10px 20px;text-decoration:none">
            Crear cuenta
          </a>
        </div>
        <img src="img/log.svg" class="image" alt="" />
      </div>
    </div>
  </div>
</body>

</html>