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
    <link rel='stylesheet' href='../css/estilos.css'>
    <link rel="stylesheet" href="../css/pene.css">
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
    <title>Glasses Optica - Ingresar Receta</title>
</head>

<body>
    <?php if (isset($_SESSION["user"])) { ?>
        <div class="container">
            <div class="row">
                <nav class="fondoazul">
                    <div class="nav-wrapper">
                        <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                        <ul id="nav-mobile" class="right hide-on-med-and-down">
                            <li><a href="clientes.php"><span title="Crear Cliente"><i class="fas fa-user-plus"></i></span></a></li>
                            <li><a href="buscarReceta.php"><span title="Buscar Receta"><i class="fas fa-file-search"></i></span></a></li>
                            <li class="activo"><a href="ingreso.php"><span title="Ingreso de Receta"><i class="fas fa-file-plus azul"></i></span></a></li>
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
                            <a href="ingreso.php"><img class="circle" src="../img/perfilnav.jpg"></a>
                            <a href="ingreso.php" class="brand-logo white-text"><?= $_SESSION["user"]["nombre"] ?></a>
                        </div>
                    </li>
                    <li><a class="white-text" href="clientes.php">Crear Cliente<i class="fas fa-user-plus fa-2x white-text"></i></a></li>
                    <li class="activo"><a class="white-text" href="buscarReceta.php">Buscar Receta<i class="fas fa-file-search fa-2x white-text azul"></i></a></li>
                    <li><a class="white-text" href="ingreso.php">Ingreso de Receta<i class="fas fa-file-plus fa-2x white-text"></i></a></li>
                    <li><a class="white-text" href="salir.php">Salir<i class="fas fa-power-off fa-2x white-text"></i></a></li>
                </ul>

                <!-- FIN DE NAV -->
                <br>
                <div class="col l1 m4 s12"></div>
                <div class="col l10 m4 s12 colorborde">
                    <h4 class="azul center">Ingresar una Receta</h4>
                    <br><br>
                    <div class="row" id="app">
                        <div class="col l6">
                            <form @submit.prevent="buscar">
                                <input type="text" class="col l6" placeholder="Rut" v-model="rut">
                                <button class="btn fondoazul col l4">BUSCAR</button>
                            </form>
                        </div>
                        <div class="col l6 m12 s12">
                            <p>
                                <ul v-if="esta == true" class="collection">
                                    <li class="collection-item">{{cliente.nombre_cliente}}</li>
                                    <li class="collection-item">{{cliente.direccion_cliente}}</li>
                                    <li class="collection-item">{{cliente.telefono_cliente}}</li>
                                    <li class="collection-item">{{cliente.email_cliente}}</li>
                                </ul>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <br>
                        <div class="col l6" id="cargaCBO">
                            <Select v-model="id_material_cristal" class="browser-default">
                                <option disabled selected value="">Seleccione...</option>
                                <option v-for="m in materiales" :value="m.id_material_cristal">
                                    {{m.material_cristal}}
                                </option>
                            </Select>
                            <Select v-model="id_tipo_cristal" class="browser-default ">
                                <option disabled selected value="">Seleccione...</option>
                                <option v-for="t in tipos" :value="t.id_tipo_cristal">
                                    {{t.tipo_cristal}}
                                </option>
                            </Select>
                            <Select class="browser-default" v-model="id_armazon">
                                <option disabled selected value="">Seleccione...</option>
                                <option v-for="a in armazones" :value="a.id_armazon">
                                    {{a.nombre_armazon}}
                                </option>
                            </Select>
                        </div>
                        <div class="col l3 center azul">
                            <p>Ojo Izquierdo</p>
                            <input type="number" placeholder="Esfera" name="esfeizq">
                            <input type="number" placeholder="Cilindro" name="cilizq">
                            <input type="number" placeholder="Eje" name="ejeizq">
                        </div>
                        <div class="col l3 center azul">
                            <p>Ojo Derecho</p>
                            <input type="number" placeholder="Esfera" name="esfeder">
                            <input type="number" placeholder="Cilindro" name="cilder">
                            <input type="number" placeholder="Eje" name="ejeder">
                        </div>
                        <div class="col l12">
                            <hr>
                            <div class="col l6 m6 s6 azul">
                                <p>Tipo Lente:</p>
                                <label>
                                    <input type="checkbox" name="xx" value="1" />
                                    <span>Lejos</span>
                                </label>
                                <label>
                                    <input type="checkbox" name="xy" value="2" />
                                    <span>Cerca</span>
                                </label>
                            </div>
                            <div class="col l3">
                                <div class="input-field">
                                    <input id="prisma" type="number" name="prisma">
                                    <label for="prisma">Prisma</label>
                                </div>
                            </div>
                            <div class="col l3">
                                <div class="input-field">
                                    <input id="pupilar" type="number" name="pupilar">
                                    <label for="pupilar">Distancia Pupilar</label>
                                </div>
                            </div>
                            <div class="col l6">
                                <div class="input-field">
                                    <i class="material-icons md-blue prefix">date_range</i>
                                    <input id="fechaentrega" type="text" class="validate datepicker" name="fechaentrega">
                                    <label for="fechaentrega">Fecha de entrega</label>
                                </div>
                            </div>
                            <div class="col l6">
                                <div class="input-field">
                                    <i class="material-icons md-blue prefix">date_range</i>
                                    <input id="fecharetiro" type="text" class="validate datepicker" name="fecharetiro">
                                    <label for="fecharetiro">Fecha de retiro</label>
                                </div>
                            </div>
                        </div>
                        <div class="col l12">
                            <hr>
                            <div class="col l4">
                                <div class="input-field">
                                    <input id="rutmed" type="text" name="rutmed">
                                    <label for="rutmed">Rut del Medico</label>
                                </div>
                            </div>
                            <div class="col l8">
                                <div class="input-field">
                                    <input id="nombremed" type="text" name="nombremed">
                                    <label for="nombremed">Nombre del Medico</label>
                                </div>
                            </div>
                            <div class="col l12">
                                <div class="input-field">
                                    <input id="obs" type="text" name="obs">
                                    <label for="obs">Observaciones</label>
                                </div>
                            </div>
                            <div class="col l4"></div>
                            <div class="col l4">
                                <div class="input-field">
                                    <input id="precio" type="number" name="precio">
                                    <label for="precio">Valor Lente</label>
                                </div>
                            </div>
                            <div class="col l4">
                                <div class="input-field">
                                    <button class="btn fondoazul">Crear Receta</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } else {
        header("Location: ../index.php"); ?>
    <?php } ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
    <script src="../js/buscar_cliente.js"></script>
    <script src="../js/combobox.js"></script>
    <script src='https://kit.fontawesome.com/2c36e9b7b1.js' crossorigin='anonymous'></script>
    <link rel='stylesheet' href='https://pro.fontawesome.com/releases/v5.10.0/css/all.css' integrity='sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p' crossorigin='anonymous' />
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('select');
            var instances = M.FormSelect.init(elems);
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
</body>

</html>