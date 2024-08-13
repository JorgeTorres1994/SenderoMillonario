<!-- 
<php
include('config.php');

$msg = "";

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    $query = "SELECT * FROM register WHERE reset_token='$token' AND token_expire > NOW()";
    $result = mysqli_query($conx, $query);

    if (mysqli_num_rows($result) > 0) {
        if (isset($_POST['submit'])) {
            $new_password = mysqli_real_escape_string($conx, md5($_POST['new_password']));
            $confirm_password = mysqli_real_escape_string($conx, md5($_POST['confirm_password']));

            if ($new_password === $confirm_password) {
                $update_query = "UPDATE register SET Password='$new_password', reset_token=NULL, token_expire=NULL WHERE reset_token='$token'";
                if (mysqli_query($conx, $update_query)) {
                    $msg = "<div class='alert alert-success'>Tu contraseña ha sido restablecida exitosamente.</div>";
                } else {
                    $msg = "<div class='alert alert-danger'>Hubo un error al actualizar tu contraseña.</div>";
                }
            } else {
                $msg = "<div class='alert alert-danger'>Las contraseñas no coinciden.</div>";
            }
        }
    } else {
        $msg = "<div class='alert alert-danger'>El enlace es inválido o ha expirado.</div>";
    }
} else {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="style.css" />
    <title>Restablecer contraseña</title>
</head>

<body>
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup" style="left: 50%;z-index:99;">
                <form action="" method="POST" class="sign-in-form">
                    <h2 class="title">Restablecer contraseña</h2>
                    <php echo $msg ?>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="new_password" placeholder="Nueva contraseña" />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="confirm_password" placeholder="Confirmar contraseña" />
                    </div>
                    <input type="submit" name="submit" value="Restablecer" class="btn solid" />
                </form>
            </div>
        </div>
    </div>
</body>
</html>

-->

<?php
include('config.php');

$msg = "";

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    $query = "SELECT * FROM register WHERE reset_token='$token' AND token_expire > NOW()";
    $result = mysqli_query($conx, $query);

    if (mysqli_num_rows($result) > 0) {
        if (isset($_POST['submit'])) {
            $new_password = mysqli_real_escape_string($conx, md5($_POST['new_password']));
            $confirm_password = mysqli_real_escape_string($conx, md5($_POST['confirm_password']));

            if ($new_password === $confirm_password) {
                $update_query = "UPDATE register SET Password='$new_password', reset_token=NULL, token_expire=NULL WHERE reset_token='$token'";
                if (mysqli_query($conx, $update_query)) {
                    $msg = "<div class='alert alert-success'>Tu contraseña ha sido restablecida exitosamente.</div>";

                    // Redirigir al index.php después de 3 segundos
                    header("refresh:3;url=index.php");
                } else {
                    $msg = "<div class='alert alert-danger'>Hubo un error al actualizar tu contraseña.</div>";
                }
            } else {
                $msg = "<div class='alert alert-danger'>Las contraseñas no coinciden.</div>";
            }
        }
    } else {
        $msg = "<div class='alert alert-danger'>El enlace es inválido o ha expirado.</div>";
    }
} else {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="style.css" />
    <title>Restablecer contraseña</title>
</head>

<body>
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup" style="left: 50%;z-index:99;">
                <form action="" method="POST" class="sign-in-form">
                    <h2 class="title">Restablecer contraseña</h2>
                    <?php echo $msg ?>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="new_password" placeholder="Nueva contraseña" />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="confirm_password" placeholder="Confirmar contraseña" />
                    </div>
                    <input type="submit" name="submit" value="Restablecer" class="btn solid" />
                </form>
            </div>
        </div>
    </div>
</body>

</html>