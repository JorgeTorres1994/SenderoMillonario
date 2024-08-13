<!-- 
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pagos Yape y Plin</title>
  <link rel="stylesheet" href="styless_pagos.css">
</head>

<body>

  <div class="bg-image"></div>
  <div class="bg-overlay"></div>

  <div class="content">
    <h2>Elige tu método de pago</h2>
    <div class="payment-options">
      <a href="yape.php">
        <img src="https://seeklogo.com/images/Y/yape-app-logo-1FD46D1120-seeklogo.com.png" alt="Yape">
      </a>
      <a href="plin.php">
        <img src="https://seeklogo.com/images/P/plin-logo-0C4106153C-seeklogo.com.png" alt="Plin">
      </a>
    </div>
    <div class="contact-info">
      <a href="https://wa.me/+51961869348" target="_blank" class="whatsapp-button">
        <i class="fab fa-whatsapp"></i> WhatsApp
      </a>
      <span class="email-text">soporte@miempresa.com</span>
    </div>
    <div class="code-section">
      <form method="POST" action="pagos_yape_plin.php" style="margin: 0; padding: 0;">
        <p class="code-message">Ingresa código</p>
        <input type="text" name="codigo" class="code-input" placeholder="Ingrese su código aquí" required>
      </form>
    </div>
    <php
    if (isset($_POST['codigo'])) {
        $codigo_ingresado = $_POST['codigo'];

        // Especificar la ruta correcta al archivo CSV
        $ruta_csv = __DIR__ . '/codigos_ingreso/codigos_aleatorios.csv';
        
        // Intentar abrir el archivo CSV
        $archivo = fopen($ruta_csv, 'r');
        if ($archivo !== false) {
            $codigo_valido = false;
            while (($linea = fgetcsv($archivo)) !== FALSE) {
                if (trim($linea[0]) === $codigo_ingresado) {
                    $codigo_valido = true;
                    break;
                }
            }
            fclose($archivo);

            // Verificar si el código es válido
            if ($codigo_valido) {
                echo '<p style="color: green; text-align: center;">Código válido. Redirigiendo a la landing page...</p>';
                // Redirigir a la landing page
                echo '<meta http-equiv="refresh" content="2;url=landing_page/landing.html">';
            } else {
                echo '<p style="color: red; text-align: center;">Código inválido. Por favor, intente de nuevo.</p>';
            }
        } else {
            echo '<p style="color: red; text-align: center;">Error: No se pudo abrir el archivo de códigos. Por favor, contacte al administrador.</p>';
        }
    }
    ?>
  </div>
</body>

</html>

-->

<?php
session_start();

// Incluir la conexión a la base de datos
include('config.php');

// Verifica si la sesión está activa; de lo contrario, redirige al index.php
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
  header("Location: index.php");
  exit();
}

// Si el botón de cerrar sesión ha sido presionado
if (isset($_POST['logout'])) {
  session_destroy();
  header("Location: index.php");
  exit();
}

// Verificar y procesar el código ingresado
if (isset($_POST['codigo'])) {
  $codigo_ingresado = $_POST['codigo'];

  // Especificar la ruta correcta al archivo CSV
  $ruta_csv = __DIR__ . '/codigos_ingreso/codigos_aleatorios.csv';
  $temp_csv = __DIR__ . '/codigos_ingreso/temp_codigos.csv';

  if (!file_exists($ruta_csv)) {
    echo '<p style="color: red; text-align: center;">Error: El archivo de códigos no existe.</p>';
    exit();
  }

  $archivo = fopen($ruta_csv, 'r');
  $temp_archivo = fopen($temp_csv, 'w');

  if ($archivo !== false && $temp_archivo !== false) {
    $codigo_valido = false;
    while (($linea = fgetcsv($archivo)) !== FALSE) {
      if (trim($linea[0]) === $codigo_ingresado) {
        $codigo_valido = true;
      } else {
        fputcsv($temp_archivo, $linea);
      }
    }
    fclose($archivo);
    fclose($temp_archivo);

    if ($codigo_valido) {
      // Intentar renombrar el archivo temporal para reemplazar el original
      if (!rename($temp_csv, $ruta_csv)) {
        echo '<p style="color: red; text-align: center;">Error: No se pudo actualizar el archivo de códigos.</p>';
        exit();
      }

      // Actualizar el indicador en la base de datos
      $sql = "UPDATE register SET codigo_ingresado = 1 WHERE email = ?";
      $stmt = $conx->prepare($sql);
      $stmt->bind_param("s", $_SESSION['Email_Session']);
      $stmt->execute();
      $stmt->close();

      echo '<p style="color: green; text-align: center;">Código válido. Redirigiendo a la landing page...</p>';
      echo '<meta http-equiv="refresh" content="2;url=landing_page/index.html">';
    } else {
      unlink($temp_csv);
      echo '<p style="color: red; text-align: center;">Código inválido. Por favor, intente de nuevo.</p>';
    }
  } else {
    echo '<p style="color: red; text-align: center;">Error: No se pudo abrir el archivo de códigos.</p>';
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pagos Yape y Plin</title>
  <link rel="stylesheet" href="styless_pagos.css">
</head>

<body>
  <div class="bg-image"></div>
  <div class="bg-overlay"></div>

  <div class="content">
    <h2>Elige tu método de pago</h2>
    <div class="payment-options">
      <button onclick="showImage('img/yape.jpg')" class="payment-button">
        <img src="https://seeklogo.com/images/Y/yape-app-logo-1FD46D1120-seeklogo.com.png" alt="Yape">
      </button>
      <button onclick="showImage('img/plin.jpg')" class="payment-button">
        <img src="https://seeklogo.com/images/P/plin-logo-0C4106153C-seeklogo.com.png" alt="Plin">
      </button>
    </div>

    <!-- Sección donde se mostrará la imagen seleccionada con un marco, título y botón de cierre -->
    <div id="image-display" class="image-display">
      <div class="image-container">
        <span class="close-btn" onclick="hideImage()">×</span>
        <div class="price-tag">S/. 19.90</div> <!-- Título con el precio -->
        <img id="payment-image" src="" alt="Método de Pago" class="payment-image">
      </div>
    </div>

    <div class="contact-info">
      <a href="https://wa.me/+51961869348?text=¡Hola,%20bienvenido%20a%20Sendero%20Millonario!" target="_blank" class="whatsapp-button">
        <i class="fab fa-whatsapp"></i> WhatsApp
      </a>
      <span class="email-text">senderodelmillonario@gmail.com</span>
    </div>

    <div class="code-section">
      <form method="POST" action="pagos.php">
        <div class="code-container">
          <p class="code-message">Código</p>
          <input type="text" name="codigo" class="code-input" placeholder="Ingrese su código aquí" required>
          <button type="submit" class="code-submit-button">Enviar</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Botón de Cerrar Sesión -->
  <div class="logout-button-container">
    <button type="button" class="logout-button" onclick="confirmLogout()">Cerrar Sesión</button>
  </div>

  <!-- Formulario oculto para cerrar sesión -->
  <form id="logout-form" method="POST" action="pagos.php" style="display: none;">
    <input type="hidden" name="logout">
  </form>

  <!-- Script para confirmar cierre de sesión -->
  <script>
    function confirmLogout() {
      if (confirm("¿Estás seguro de que deseas cerrar sesión?")) {
        document.getElementById('logout-form').submit();
      }
    }

    /*function showImage(imageName) {
      var img = document.getElementById('payment-image');
      var container = document.querySelector('.image-container');
      img.src = imageName;
      document.getElementById('image-display').style.display = 'flex'; // Mostrar el contenedor con la imagen

      // Añadir evento de clic para agrandar la imagen y el contenedor
      container.addEventListener('click', function() {
        container.classList.toggle('active'); // Alternar la clase 'active' para agrandar/reducir el contenedor y la imagen
      });
    }

    function hideImage() {
      var container = document.querySelector('.image-container');
      container.classList.remove('active'); // Asegurarse de que el contenedor vuelva a su tamaño original al cerrar
      document.getElementById('image-display').style.display = 'none'; // Ocultar el contenedor
    }*/
    // Agregar el evento de clic una sola vez cuando la página se carga
    document.addEventListener('DOMContentLoaded', function() {
      var container = document.querySelector('.image-container');

      container.addEventListener('click', function() {
        container.classList.toggle('active'); // Alternar la clase 'active' para agrandar/reducir el contenedor y la imagen
      });
    });

    function showImage(imageName) {
      var img = document.getElementById('payment-image');
      img.src = imageName;
      img.width = 250; // Establece el ancho fijo
      img.height = 250; // Establece la altura fija
      document.getElementById('image-display').style.display = 'flex'; // Mostrar el contenedor con la imagen
    }

    function hideImage() {
      var container = document.querySelector('.image-container');
      container.classList.remove('active'); // Asegurarse de que el contenedor vuelva a su tamaño original al cerrar
      document.getElementById('image-display').style.display = 'none'; // Ocultar el contenedor
    }
  </script>

</body>

</html>