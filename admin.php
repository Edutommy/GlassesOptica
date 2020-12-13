<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/login.css">
    <title>Glasses Optica - Iniciar Sesión Administrador</title>
</head>

<body>
<div class="box">
    <img src="img/logodos.png" alt="" class="logo center">
      <h2>Inicia Sesión</h2>
      <p>Usa tu cuenta de Administrador</p>
      <form action="controllers/LoginControllerAdmin.php" method="POST">
        <div class="inputBox">
          <input type="text" name="rut" required onkeyup="this.setAttribute('value', this.value);" value="" />
          <label for="rut">RUT</label>
        </div>
        <div class="inputBox">
          <input type="password" name="clave" required onkeyup="this.setAttribute('value', this.value);" value="" />
          <label for="clave">Contraseña</label>
        </div>
        <p class="rojo">
            <?php
            session_start();
            if (isset($_SESSION["error"])) {
              echo $_SESSION["error"];
              unset($_SESSION["error"]);
            }
            ?>
        </p>
        <input type="submit" name="sign-in" value="Iniciar Sesión" />
      </form>
      <label class="pequeno">¿Eres Vendedor? <br> Click<a href="index.php"> Aquí</a></label>
</div>
<script src='https://kit.fontawesome.com/2c36e9b7b1.js' crossorigin='anonymous'></script>
</body>

</html>