<?php

use models\UsuarioModel as UsuarioModel;

session_start();
require_once "models/UsuarioModel.php";
if (isset($_SESSION["usuario"])) {
  $model = new UsuarioModel();
  $usuario = $model->getAllUsuarios();

  print_r($usuario);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='css/login.css' />
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link href='https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap' rel='stylesheet'>
    <title>Glasses Optica - Iniciar Sesión</title>
</head>

<body>

<div class="box">
<img src="img/logodos.png" alt="" class="logo">
      <h2>Inicia Sesión</h2>
      <p>Usa tu cuenta de Vendedor</p>
      <form action="controllers/LoginController.php" method="POST">
        <div class="inputBox">
          <input type="text" name="rut" required onkeyup="this.setAttribute('value', this.value);" value="" />
          <label for="rut">RUT</label>
        </div>
        <div class="inputBox">
          <input type="password" name="clave" required onkeyup="this.setAttribute('value', this.value);" value="" />
          <label for="clave">Contraseña</label>
        </div>
        <p class="rojo">
                                <?php if (isset($_SESSION["error"])) {
                                  echo $_SESSION["error"];
                                  unset($_SESSION["error"]);
                                } ?>
                            </p>
        <input type="submit" name="sign-in" value="Iniciar Sesión" />
      </form>
      <label class="pequeno">¿Eres Administrador? <br> Click<a href="admin.php"> Aquí</a></label>
</div>
<script src='https://kit.fontawesome.com/2c36e9b7b1.js' crossorigin='anonymous'></script>
</body>
</html>