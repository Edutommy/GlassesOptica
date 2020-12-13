<?php 

namespace models;

require_once("Conexion.php");

class ClienteModel
{
    public function insertarCliente($dataCli)
    {
        $stm = Conexion::conector()->prepare("INSERT INTO cliente VALUES(:A, :B, :C, :D, :E, :F)");
        $stm->bindParam(":A", $dataCli['clirut']);
        $stm->bindParam(":B", $dataCli['cliname']);
        $stm->bindParam(":C", $dataCli['clidir']);
        $stm->bindParam(":D", $dataCli['clifono']);
        $stm->bindParam(":E", $dataCli['clifecha']);
        $stm->bindParam(":F", $dataCli['cliemail']);
        return $stm->execute();
    }
    
    public function buscarClientes($rut)
    {
        $stm = Conexion::conector()->prepare("SELECT * FROM cliente WHERE rut_cliente=:A");
        $stm->bindParam(":A", $rut);
        $stm->execute();
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }
}