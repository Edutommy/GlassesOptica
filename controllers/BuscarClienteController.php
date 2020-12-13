<?php

namespace controllers;

use models\ClienteModel as ClienteModel;

session_start();
require_once "../models/ClienteModel.php";

class BuscarCliente
{
  public $rut;

  public function __construct()
  {
    $this->rut = $_POST["rut"];
  }

  public function buscarCliente()
  {
    if (isset($_SESSION["user"])) {
      $modelo = new ClienteModel();
      $arr = $modelo->buscarClientes($this->rut);

      if (count($arr) == 1) {
        echo json_encode($arr[0]);
      } else {
        echo json_encode(null);
      }
    } else {
      echo json_encode(["msg" => "<i class='fas fa-exclamation-circle'></i> acceso denegado"]);
    }
  }
}

$obj = new BuscarCliente();
$obj->buscarCliente();
