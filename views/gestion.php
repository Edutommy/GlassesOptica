<?php

use models\UsuarioModel as UsuarioModel;

session_start();
require_once "../models/UsuarioModel.php";

ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

if (isset($_SESSION["user"])) {
    $model = new UsuarioModel();
    $usuario = $model->getAllUsuarios();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap' rel='stylesheet'>
    <link rel="stylesheet" href="../css/style.css">
    <link rel='stylesheet' href='../css/estilos.css' />
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
    <title>Glasses Optica - Gestión de Usuarios</title>
</head>

<body>
    <?php if (isset($_SESSION["user"])) { ?>
        <div class="container">
            <div class="row">
                <nav class="colorborde fondoazul">
                    <div class="nav-wrapper">
                        <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                        <ul id="nav-mobile" class="right hide-on-med-and-down">
                            <li class="activo"><a href="gestion.php"><span title="Gestión de Usuarios"><span title="Gestión de Usuarios"><i class="fas fa-user-cog azul"></i></span></a></li>
                            <li><a href="salir.php"><span title="Salir"><i class="fas fa-power-off"></i></span></a></li>
                        </ul>
                    </div>
                </nav>
                <!-- NAV MOVIL -->
                <ul id="slide-out" class="sidenav fondoazul">
                    <li>
                        <div class="user-view">
                            <div class="background">
                                <img src="https://www.designyourway.net/blog/wp-content/uploads/2016/07/Dark-wallpaper-desktop-background-30-700x438.jpg">
                            </div>
                            <a href="gestion.php"><img class="circle" src="../img/perfilnav.jpg"></a>
                            <a href="gestion.php" class="brand-logo white-text"><?= $_SESSION["user"]["nombre"] ?></a>
                        </div>
                    </li>
                    <li class="active"><a class="white-text" href="gestion.php">Gestión de Usuarios<i class="fas fa-user-cog fa-2x white-text"></i></a></li>
                    <li><a class="white-text" href="salir.php">Salir<i class="fas fa-power-off fa-2x white-text"></i></a></li>
                </ul>

                <!-- FIN DE NAV -->
                <div class="col l4 m4 s12">
                    <!-- EDITAR USUARIO -->
                    <?php if (isset($_SESSION["editar"])) { ?>
                        <div class="card">
                            <div class="card-content">
                                <i class="fas fa-users fa-2x azul"></i>
                                <h4 class="center blue-text accent-2">Editar Usuario</h4>
                                <form action="../controllers/ControlEdit.php" method="POST">
                                    <div class="input-field">
                                        <input id="rut" type="text" name="rut" value="<?= $_SESSION["usuario"]["rut"] ?>">
                                        <label for="rut">Rut de usuario</label>
                                    </div>
                                    <div class="input-field">
                                        <input id="nombre" type="text" name="nombre" value="<?= $_SESSION["usuario"]["nombre"] ?>">
                                        <label for="nombre">Nombre del Usuario</label>
                                    </div>
                                    <div class="input-field col s12">
                                        <select name="estado" id="estado">
                                            <option value="1">Habilitado</option>
                                            <option value="0">Bloqueado</option>
                                        </select>
                                        <label>Estado del Vendedor</label>
                                    </div>
                                    <button class="btn orange ancho-100 redondo">Editar Usuario</button>
                                </form>
                            </div>
                        </div>
                    <?php
                        unset($_SESSION["editar"]);
                        unset($_SESSION["usuario"]);
                    } else { ?>
                        <!-- NUEVO USUARIO -->
                        <div class="card">
                            <div class="card-content">
                                <i class="fas fa-users fa-2x azul"></i>
                                <h5 class="center blue-text accent-2">Nuevo Vendedor</h5>
                            </div>
                            <div class="card-action">
                                <form action="../controllers/ControlInsert.php" method="POST">
                                    <div class="input-field">
                                        <input id="rut" type="text" name="rut">
                                        <label for="rut">Rut Vendedor</label>
                                    </div>
                                    <div class="input-field">
                                        <input id="nombre" type="text" name="nombre">
                                        <label for="nombre">Nombre Vendedor</label>
                                    </div>
                                    <p class="green-text">
                                        <?php if (isset($_SESSION["respuesta"])) {
                                            echo $_SESSION["respuesta"];
                                            unset($_SESSION["respuesta"]);
                                        } ?>
                                    </p>
                                    <p class="red-text">
                                        <?php if (isset($_SESSION["error"])) {
                                            echo $_SESSION["error"];
                                            unset($_SESSION["error"]);
                                        } ?>
                                    </p>
                                    <br>
                                    <input type="hidden" name="rol" value="Vendedor">
                                    <input type="hidden" name="clave" value="123456">
                                    <input type="hidden" name="estado" value="1">
                                    <button class="btn fondoazul">Crear Vendedor</button>
                                </form>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="col l8 m8 s12">
                    <div class="card">
                        <div class="card-content">
                            <h4 class="center blue-text accent-2">Lista de Vendedores</h4>
                            <form action="../controllers/ControlTabla.php" method="POST">
                                <table class="blue-text accent-2">
                                    <tr>
                                        <th>Rut</th>
                                        <th>Nombre</th>
                                        <th>Estado</th>
                                        <th>Acción</th>
                                    </tr>
                                    <?php foreach ($usuario as $item) { ?>
                                        <tr>
                                            <td> <?= htmlspecialchars($item["rut"]) ?> </td>
                                            <td> <?= htmlspecialchars($item["nombre"]) ?> </td>
                                            <?php if ($item["estado"] == 1) { ?>
                                                <td class="green-text fa-2x"> <?= $item["estado"] = "<i class='fas fa-user-check'></i>" ?> </td>
                                            <?php } else { ?>
                                                <td class="red-text fa-2x"> <?= $item["estado"] = "<i class='fas fa-user-times'></i>" ?> </td>
                                            <?php } ?>
                                            <td>
                                                <button name="bt_edit" value="<?= $item["rut"] ?>" class="btn-floating orange">
                                                    <i class="material-icons">edit</i>
                                                </button>
                                                <button name="bt_delete" value="<?= $item["rut"] ?>" class="btn-floating red">
                                                    <i class="material-icons">delete</i>
                                                </button>

                                            </td>
                                        </tr>
                                    <?php } ?>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } else {
        header("Location: ../index.php"); ?>
    <?php } ?>
    <script src='https://kit.fontawesome.com/2c36e9b7b1.js' crossorigin='anonymous'></script>
    <link rel='stylesheet' href='https://pro.fontawesome.com/releases/v5.10.0/css/all.css' integrity='sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p' crossorigin='anonymous' />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('select');
            var instances = M.FormSelect.init(elems);

            var elems = document.querySelectorAll('.sidenav');
            var instances = M.Sidenav.init(elems);
        });
    </script>
</body>

</html>