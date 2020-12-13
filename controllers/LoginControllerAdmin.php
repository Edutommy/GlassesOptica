<?php

namespace controllers;

use models\UsuarioModel as UsuarioModel;

session_start();
require_once "../models/UsuarioModel.php";

class LoginController
{
  public $rut;
  public $clave;

  public function __construct()
  {
    $this->rut = $_POST["rut"];
    $this->clave = $_POST["clave"];
  }

  public function iniciarSesion()
  {
    if ($this->rut == "" || $this->clave == "") {
      $_SESSION["error"] = "<i class='fas fa-exclamation-circle'></i> Complete los datos";
      header("Location: ../admin.php");
      return;
    }

    $model = new UsuarioModel();
    $array = $model->buscarUsuarioAdmin($this->rut, $this->clave);

    if (!$model->buscarUsuarioAdmin($this->rut, $this->clave) == true) {
      $_SESSION["error"] = "<i class='fas fa-exclamation-circle'></i> El usuario no es Administrador";
      header("Location: ../admin.php");
      return;
    }

    if (count($array) == 0) {
      $_SESSION["error"] = "<i class='fas fa-exclamation-circle'></i> Email o Contraseña Incorrectos";
      header("Location: ../admin.php");
      return;
    }

    $_SESSION["user"] = $array[0];

    header("Location: ../views/gestion.php");
  }
}

$obj = new LoginController();
$obj->iniciarSesion();
