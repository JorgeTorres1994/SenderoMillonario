/*document.addEventListener("DOMContentLoaded", function () {
    function showMessage(type, message) {
      const alertBox = document.createElement("div");
      alertBox.className = `alert alert-${type}`;
      alertBox.textContent = message;
      document.querySelector(".signin-signup").prepend(alertBox);
  
      setTimeout(() => {
        alertBox.remove();
      }, 5000);
    }
  
    // Manejo del formulario de inicio de sesión
    const loginForm = document.querySelector(".sign-in-form");
    if (loginForm) {
      loginForm.addEventListener("submit", function (event) {
        event.preventDefault();
        const email = loginForm.querySelector('input[name="email"]').value;
        const password = loginForm.querySelector('input[name="Password"]').value;
  
        if (email === "" || password === "") {
          showMessage("danger", "Por favor, completa todos los campos.");
          return;
        }
  
        fetch("index.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded",
          },
          body: `email=${encodeURIComponent(email)}&Password=${encodeURIComponent(password)}&submit=Login`,
        })
          .then((response) => response.text())
          .then((data) => {
            document.querySelector(".container").innerHTML = data;
  
            if (data.includes("Inicio de sesión exitoso")) {
              showMessage("success", "¡Bienvenido!.");
            } else if (data.includes("El correo o la contraseña no coinciden")) {
              showMessage("danger", "El correo o la contraseña no coinciden.");
            }
          })
          .catch((error) => console.error("Error:", error));
      });
    }
  
    // Manejo del formulario de registro
    const registerForm = document.querySelector(".sign-up-form");
    if (registerForm) {
      registerForm.addEventListener("submit", function (event) {
        event.preventDefault();
        const username = registerForm.querySelector('input[name="Username"]').value;
        const email = registerForm.querySelector('input[name="Email"]').value;
        const password = registerForm.querySelector('input[name="Password"]').value;
        const confirmPassword = registerForm.querySelector('input[name="Conf-Password"]').value;
  
        if (username === "" || email === "" || password === "" || confirmPassword === "") {
          showMessage("danger", "Por favor, completa todos los campos.");
          return;
        }
  
        if (password !== confirmPassword) {
          showMessage("danger", "Las contraseñas no coinciden.");
          return;
        }
  
        fetch("SignUp.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded",
          },
          body: `Username=${encodeURIComponent(username)}&Email=${encodeURIComponent(email)}&Password=${encodeURIComponent(password)}&Conf-Password=${encodeURIComponent(confirmPassword)}&submit=Sign up`,
        })
          .then((response) => response.text())
          .then((data) => {
            document.querySelector(".container").innerHTML = data;
  
            if (data.includes("Registro exitoso")) {
              showMessage("success", "Registro exitoso. Ahora puedes iniciar sesión.");
            } else if (data.includes("ya está registrado")) {
              showMessage("danger", "Este correo ya está registrado.");
            }
          })
          .catch((error) => console.error("Error:", error));
      });
    }
  
    // Manejo del formulario de recuperación de contraseña
    const resetForm = document.querySelector(".sign-in-form");
    if (resetForm && resetForm.querySelector('input[type="submit"]').value === "Send") {
      resetForm.addEventListener("submit", function (event) {
        event.preventDefault();
        const email = resetForm.querySelector('input[name="email"]').value;
  
        if (email === "") {
          showMessage("danger", "Por favor, ingresa tu correo electrónico.");
          return;
        }
  
        fetch("Forget.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded",
          },
          body: `email=${encodeURIComponent(email)}&submit=Send`,
        })
          .then((response) => response.text())
          .then((data) => {
            document.querySelector(".container").innerHTML = data;
  
            if (data.includes("Hemos enviado un código de recuperación")) {
              showMessage("success", "Correo de recuperación enviado.");
            } else if (data.includes("no fue encontrado")) {
              showMessage("danger", "El correo electrónico no fue encontrado.");
            }
          })
          .catch((error) => console.error("Error:", error));
      });
    }
  });
  */