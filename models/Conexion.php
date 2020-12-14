<?php

namespace models;

class Conexion
{
  public static $user = "uszcfwlnyj4kx83o";
  public static $pass = "3YYNo72sWCQ4QMDtTdXL";
  public static $URL = "mysql:host=bgmykwwo2imhrgeas5hm-mysql.services.clever-cloud.com;dbname=bgmykwwo2imhrgeas5hm";

  //public static $user = "root";
  //public static $pass = "";
  //public static $URL = "mysql:host=localhost;dbname=optica_2020";

  public static function conector()
  {
    try {
      return new \PDO(Conexion::$URL, Conexion::$user, Conexion::$pass);
    } catch (\PDOException $e) {
      return null;
    }
  }
}
