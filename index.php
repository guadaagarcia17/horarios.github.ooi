<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Iniciar Sesión</title>
<style>
body {
  background: linear-gradient(to bottom, #003366, #007bff);
  color: white;
  text-align: center;
  font-family: Arial, sans-serif;
  padding-top: 100px;
}
form {
  background: rgba(255,255,255,0.15);
  padding: 30px;
  display: inline-block;
  border-radius: 15px;
}
input {
  margin: 10px;
  padding: 8px;
  border: none;
  border-radius: 8px;
}
button {
  background: #00bfff;
  border: none;
  color: white;
  padding: 10px 20px;
  border-radius: 8px;
  cursor: pointer;
}
button:hover { background: #0099cc; }
</style>
</head>
<body>
  <h2>Iniciar Sesión</h2>
  <form onsubmit="return login(event)">
    <input type="text" id="usuario" placeholder="Usuario" required><br>
    <input type="password" id="clave" placeholder="Contraseña" required><br>
    <button type="submit">Entrar</button>
  </form>
  <br>
  <button onclick="window.location.href='registro.html'">Registrarse</button>

  <script>
    // Simulación de inicio de sesión (solo visual)
    function login(event) {
      event.preventDefault();
      const usuario = document.getElementById('usuario').value;
      const clave = document.getElementById('clave').value;

      if (usuario === "" || clave === "") {
        alert("Por favor complete todos los campos");
        return false;
      }

      // Esto es solo una simulación visual
      alert("Inicio de sesión simulado para: " + usuario);
      window.location.href = "horario.html"; // redirige a la página del horario
      return false;
    }
  </script>
</body>
</html>
