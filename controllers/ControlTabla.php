<?php

namespace controllers;

use models\UsuarioModel as UsuarioModel;

session_start();

require_once "../models/UsuarioModel.php";

class ControlTabla
{
  public $bt_edit;

  public function __construct()
  {
    $this->bt_edit = $_POST["bt_edit"];
    $this->bt_delete = $_POST["bt_delete"];
  }
  public function procesar()
  {
    if (isset($this->bt_edit)) {
      $modelo = new UsuarioModel();
      $_SESSION["editar"] = "ON";
      $usuario = $modelo->buscarUsuario($this->bt_edit);
      $_SESSION["usuario"] = $usuario[0];

      header("Location: ../views/gestion.php");
    } else {
      $modelo = new UsuarioModel();
      $modelo->eliminarUsuario($this->bt_delete);
      header("Location: ../views/gestion.php");
    }
  }
}
$obj = new ControlTabla();
$obj->procesar();
