<?php

namespace controllers;

use models\RecetaModel as RecetaModel;

session_start();
require_once "../models/RecetaModel.php";

class BuscarRecetaFecha
{
  public $fecha;

  public function __construct()
  {
    $this->fecha = $_POST["fecha"];
  }
  public function recetas()
  {
    if (isset($_SESSION["user"])) {
      $modelo = new RecetaModel();
      $arr = $modelo->recetasXFecha($this->fecha);
      echo json_encode($arr);
    } else {
      echo json_encode(["msg" => "<i class='fas fa-exclamation-circle'></i> Acceso Denegado"]);
    }
  }
}

$obj = new BuscarRecetaFecha();
$obj->recetas();
