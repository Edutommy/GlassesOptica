<?php

namespace controllers;

use models\UsuarioModel as UsuarioModel;

require_once "../models/UsuarioModel.php";
session_start();

class ControlEdit
{
  public $rut;
  public $nombre;
  public $estado;

  public function __construct()
  {
    $this->rut = $_POST["rut"];
    $this->nombre = $_POST["nombre"];
    $this->estado = $_POST["estado"];
  }

  public function editar()
  {
    if ($this->rut == "" || $this->nombre == "") {
      $_SESSION["errorEdit"] = "<i class='fas fa-exclamation-circle'></i>  Completa todos los campos";
      header("Location: ../views/gestion.php");
      return;
    }

    $data = ["nombre" => $this->nombre, "estado" => $this->estado];
    $model = new UsuarioModel();

    $count = $model->editarUsuario($this->rut, $data);
    if ($count == 1) {
      $_SESSION["ok_edit"] = "Usuario Actualizado";
    } else {
      $_SESSION["errorEdit"] = "<i class='fas fa-exclamation-circle'></i>  Error en la Base de Datos";
    }
    header("Location: ../views/gestion.php");
  }
}

$obj = new ControlEdit();
$obj->editar();
