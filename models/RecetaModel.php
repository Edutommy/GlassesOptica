<?php

namespace models;

use DateTime;

require_once("Conexion.php");


class RecetaModel
{
    public function insertarReceta($data)
    {
    }

    public function recetasXRut($rut)
    {
        $sql = ' SELECT id_receta "id", tipo_lente, esfera_oi, esfera_od, cilindro_oi, cilindro_od, eje_oi, ';
        $sql.= ' eje_od, prisma, base, ar.nombre_armazon "armazon", mt.material_cristal, tc.tipo_cristal, ';
        $sql.= ' distancia_pupilar, valor_lente "precio", fecha_entrega, fecha_retiro, observacion, cl.rut_cliente, ';
        $sql.= ' cl.nombre_cliente, cl.telefono_cliente, us.nombre "nombre_vendedor", receta.estado FROM receta ';
        $sql.= ' INNER JOIN material_cristal mt on mt.id_material_cristal=receta.material_cristal ';
        $sql.= ' inner join armazon ar on ar.id_armazon=receta.armazon '; 
        $sql.= ' inner join tipo_cristal tc on tc.id_tipo_cristal = receta.tipo_cristal ';
        $sql.= ' inner join cliente cl on cl.rut_cliente = receta.rut_cliente ';
        $sql.= ' inner join usuario us on us.rut = receta.rut_usuario ';
        $sql.= ' WHERE receta.rut_cliente = :A';
        $stm = Conexion::conector()->prepare($sql);
        $stm->bindParam(":A", $rut);
        $stm->execute();
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function recetasXFecha($fecha)
    {
        $sql = '
        select id_receta "id", tipo_lente, esfera_oi, esfera_od,
        cilindro_oi, cilindro_od, eje_oi, eje_od, prisma, base,
        ar.nombre_armazon "armazon", mt.material_cristal,
        tc.tipo_cristal, distancia_pupilar, valor_lente "precio",
        fecha_entrega, fecha_retiro, observacion, cl.rut_cliente,
        cl.nombre_cliente, cl.telefono_cliente, us.nombre "nombre_vendedor",
        receta.estado
        from receta
        inner join material_cristal mt 
            on mt.id_material_cristal=receta.material_cristal
        inner join armazon ar 
            on ar.id_armazon = receta.armazon
        inner join tipo_cristal tc
            on tc.id_tipo_cristal = receta.tipo_cristal
        inner join cliente cl 
            on cl.rut_cliente = receta.rut_cliente
        inner join usuario us
            on us.rut = receta.rut_usuario
        where receta.fecha_entrega = :A  ';
        $stm = Conexion::conector()->prepare($sql);
        $stm->bindParam(":A", $fecha);
        $stm->execute();
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getMaterialCristal()
    {
        $stm = Conexion::conector()->prepare("SELECT * FROM material_cristal");
        $stm->execute();
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function getTipoCristal()
    {
        $stm = Conexion::conector()->prepare("SELECT * FROM tipo_cristal");
        $stm->execute();
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function getArmazon()
    {
        $stm = Conexion::conector()->prepare("SELECT * FROM armazon");
        $stm->execute();
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }
}
