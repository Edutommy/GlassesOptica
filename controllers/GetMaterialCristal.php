<?php

namespace controllers;

use models\RecetaModel as RecetaModel;

require_once "../models/RecetaModel.php";

class GetMaterialCristal
{
  public function getMaterialCristal()
  {
    session_start();
    if (isset($_SESSION["user"])) {
      $modelo = new RecetaModel();
      $arr = $modelo->getMaterialCristal();
      echo json_encode($arr);
    } else {
      echo json_encode(["msg" => "<i class='fas fa-exclamation-circle'></i>  Acceso denegado"]);
    }
  }
}

$obj = new GetMaterialCristal();
$obj->getMaterialCristal();
