<?php

namespace models;

require_once "Conexion.php";

class UsuarioModel
{
  public function buscarUsuarioVendedor($rut, $clave)
  {
    $stm = Conexion::conector()->prepare("SELECT * FROM usuario WHERE rut=:A AND clave=:B AND rol='Vendedor' AND estado='1'");
    $stm->bindParam(":A", $rut);
    $stm->bindParam(":B", md5($clave));
    $stm->execute();
    return $stm->fetchAll(\PDO::FETCH_ASSOC);
  }
  public function buscarUsuarioAdmin($rut, $clave)
  {
    $stm = Conexion::conector()->prepare("SELECT * FROM usuario WHERE rut=:A AND clave=:B AND rol='Administrador'");
    $stm->bindParam(":A", $rut);
    $stm->bindParam(":B", md5($clave));
    $stm->execute();
    return $stm->fetchAll(\PDO::FETCH_ASSOC);
  }

  public function insertarUsuario($data)
  {
    $stm = Conexion::conector()->prepare("INSERT INTO usuario VALUES(:A, :B, :C, :D, :E)");
    $stm->bindParam(":A", $data["rut"]);
    $stm->bindParam(":B", $data["nombre"]);
    $stm->bindParam(":C", $data["rol"]);
    $stm->bindParam(":D", md5($data["clave"]));
    $stm->bindParam(":E", $data["estado"]);
    return $stm->execute();
  }

  public function getAllUsuarios()
  {
    $stm = Conexion::conector()->prepare("SELECT * FROM usuario WHERE rol='vendedor'");
    $stm->execute();
    return $stm->fetchAll(\PDO::FETCH_ASSOC);
  }

  public function buscarUsuario($rut)
  {
    $stm = Conexion::conector()->prepare("SELECT * FROM usuario WHERE rut=:A");
    $stm->bindParam(":A", $rut);
    $stm->execute();
    return $stm->fetchAll(\PDO::FETCH_ASSOC);
  }

  public function editarUsuario($rut, $data)
  {
    $stm = Conexion::conector()->prepare("UPDATE usuario SET nombre=:A, estado=:B WHERE rut=:E");
    $stm->bindParam(":A", $data["nombre"]);
    $stm->bindParam(":B", $data["estado"]);
    $stm->bindParam(":E", $rut);
    return $stm->execute();
  }
  public function eliminarUsuario($rut)
  {
    $stm = Conexion::conector()->prepare("DELETE FROM usuario WHERE rut=:A");
    $stm->bindParam(":A", $rut);
    return $stm->execute();
  }
}
