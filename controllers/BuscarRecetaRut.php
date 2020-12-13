<?php

namespace controllers;

use models\RecetaModel as RecetaModel;

session_start();
require_once "../models/RecetaModel.php";

class BuscarRecetaRut
{
  public $rut;

  public function __construct()
  {
    $this->rut = $_POST["rut"];
  }
  public function recetas()
  {
    if (isset($_SESSION["user"])) {
      $modelo = new RecetaModel();
      $arr = $modelo->recetasXRut($this->rut);
      echo json_encode($arr);
    } else {
      echo json_encode(["msg" => "<i class='fas fa-exclamation-circle'></i> Acceso Denegado"]);
    }
  }
}

$obj = new BuscarRecetaRut();
$obj->recetas();
