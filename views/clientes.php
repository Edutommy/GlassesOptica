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
    <link rel="stylesheet" href="../css/style.css">
    <link rel='stylesheet' href='../css/estilos.css' />
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
    <title>Glasses Optica - Gestión Clientes</title>

</head>

<body>
    <?php if (isset($_SESSION["user"])) { ?>
        <div class="container">
            <div class="row">
                <nav class="fondoazul">
                    <div class="nav-wrapper">
                        <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                        <ul id="nav-mobile" class="right hide-on-med-and-down">
                            <li class="activo"><a href="clientes.php"><span title="Crear Cliente"><i class="fas fa-user-plus azul"></i></span></a></li>
                            <li><a href="buscarReceta.php"><span title="Buscar Receta"><i class="fas fa-file-search"></i></span></a></li>
                            <li><a href="ingreso.php"><span title="Ingreso de Receta"><i class="fas fa-file-plus"></i></span></a></li>
                            <li><a href="salir.php"><span title="Salir"><i class="fas fa-power-off"></i></span></a></li>
                        </ul>
                    </div>
                </nav>
                <!-- NAV MOVIL -->
                <ul id="slide-out" class="sidenav blue accent-2">
                    <li>
                        <div class="user-view">
                            <div class="background">
                                <img src="https://www.designyourway.net/blog/wp-content/uploads/2016/07/Dark-wallpaper-desktop-background-30-700x438.jpg">
                            </div>
                            <a href="gestion.php"><img class="circle" src="../img/perfilnav.jpg"></a>
                            <a href="gestion.php" class="brand-logo white-text"><?= $_SESSION["user"]["nombre"] ?></a>
                        </div>
                    </li>
                    <li class="active"><a class="white-text" href="clientes.php">Crear Cliente<i class="fas fa-user-plus fa-2x white-text"></i></a></li>
                    <li><a class="white-text" href="buscarReceta.php">Buscar Receta<i class="fas fa-file-search fa-2x white-text"></i></a></li>
                    <li><a class="white-text" href="ingreso.php">Ingreso de Receta<i class="fas fa-file-plus fa-2x white-text"></i></a></li>
                    <li><a class="white-text" href="salir.php">Salir<i class="fas fa-power-off fa-2x white-text"></i></a></li>
                </ul>

                <!-- FIN DE NAV -->
                <div class="col l2 m4 s12"></div>
                <div class="col l8 m4 s12">
                    <div class="card">
                        <div class="card-content">
                            <h4 class="azul">Nuevo Cliente</h4>
                            <p class="green-text">
                                <?php if (isset($_SESSION["respuestaCli"])) {
                                    echo $_SESSION["respuestaCli"];
                                    unset($_SESSION["respuestaCli"]);
                                } ?>
                            </p>
                            <p class="red-text">
                                <?php if (isset($_SESSION["errorCli"])) {
                                    echo $_SESSION["errorCli"];
                                    unset($_SESSION["errorCli"]);
                                } ?>
                            </p>
                            <p class="red-text">
                                <?php if (isset($_SESSION["respuesta"])) {
                                    echo $_SESSION["respuesta"];
                                    unset($_SESSION["respuesta"]);
                                } ?>
                            </p>
                            <form action="../controllers/ClienteController.php" method="POST">
                                <div class="input-field col l4">
                                    <i class="material-icons md-blue prefix">account_box</i>
                                    <input id="clirut" type="text" name="clirut">
                                    <label for="clirut">Rut</label>
                                </div>
                                <div class="input-field col l8">
                                    <i class="material-icons md-blue prefix">perm_identity</i>
                                    <input id="cliname" type="text" name="cliname">
                                    <label for="cliname">Nombre</label>
                                </div>
                                <div class="input-field col l12">
                                    <i class="material-icons md-blue prefix">business</i>
                                    <input id="clidir" type="text" name="clidir">
                                    <label for="clidir">Dirección</label>
                                </div>
                                <div class="input-field col l6">
                                    <i class="material-icons md-blue prefix">call</i>
                                    <input id="clifono" type="number" name="clifono">
                                    <label for="clifono">Teléfono o Celular</label>
                                </div>
                                <div class="input-field col l6">
                                    <i class="material-icons md-blue prefix">date_range</i>
                                    <input id="icon_prefix" type="text" class="validate datepicker" name="clifecha">
                                    <label for="icon_prefix">Fecha de creación</label>
                                </div>
                                <div class="input-field col l12">
                                    <i class="material-icons md-blue prefix">alternate_email</i>
                                    <input id="cliemail" type="email" name="cliemail">
                                    <label for="cliemail">Correo Eléctronico</label>
                                </div>
                                <button class="btn fondoazul">Crear Nuevo Cliente</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php } else {
        header("Location: ../index.php"); ?>

    <?php } ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.datepicker');
            var instances = M.Datepicker.init(elems, {
                'autoClose': true,
                'format': 'yyyy/mm/dd',
                i18n: {
                    months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
                    monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Set", "Oct", "Nov", "Dic"],
                    weekdays: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
                    weekdaysShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
                    weekdaysAbbrev: ["D", "L", "M", "M", "J", "V", "S"],
                    cancel: 'Cancelar',
                    clear: 'Limpiar',
                    done: 'Aceptar'
                }
            });

            var elems = document.querySelectorAll('.sidenav');
            var instances = M.Sidenav.init(elems);
        });
    </script>
    <script src='https://kit.fontawesome.com/2c36e9b7b1.js' crossorigin='anonymous'></script>
    <link rel='stylesheet' href='https://pro.fontawesome.com/releases/v5.10.0/css/all.css' integrity='sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p' crossorigin='anonymous' />
</body>

</html>