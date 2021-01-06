<?php

namespace models;

use DateTime;

require_once("Conexion.php");


class RecetaModel
{
    public function insertarReceta($data)
    {
        $stm = Conexion::conector()->prepare("INSERT INTO receta VALUES(NULL,:tipo_lente,:esfera_oi,:esfera_od,:cilindro_oi,:cilindro_od,:eje_oi,:eje_od,:prisma,:base,
        :armazon,:material_cristal,:tipo_cristal,
        :distancia_pupilar,:valor_lente,:fecha_entrega,:fecha_retiro,:observacion,:rut_cliente,:fecha_visita_medico,:rut_medico,:nombre_medico,:rut_usuario,1)");

        $stm->bindParam(":tipolente", $data['tipolente']);
        $stm->bindParam(":esferaoiz", $data['esferaoiz']);
        $stm->bindParam(":esferaode", $data['esferaode']);
        $stm->bindParam(":cilindrooiz", $data['cilindrooiz']);
        $stm->bindParam(":cilindroode", $data['cilindroode']);
        $stm->bindParam(":ejeoiz", $data['ejeoiz']);
        $stm->bindParam(":ejeode", $data['ejeode']);
        $stm->bindParam(":prisma", $data['prisma']);
        $stm->bindParam(":base", $data['base']);
        $stm->bindParam(":armazon", $data['armazon']);
        $stm->bindParam(":materialcristal", $data['materialcristal']);
        $stm->bindParam(":tipocristal", $data['tipocristal']);
        $stm->bindParam(":distanciapupilar", $data['distanciapupilar']);
        $stm->bindParam(":valorlente", $data['valorlente']);
        $stm->bindParam(":fechaentrega", $data['fechaentrega']);
        $stm->bindParam(":fecharetiro", $data['fecharetiro']);
        $stm->bindParam(":observacion", $data['observacion']);
        $stm->bindParam(":rutcliente", $data['rutcliente']);
        $stm->bindParam(":fechavimed", $data['fechavimed']);
        $stm->bindParam(":rutmedico", $data['rutmedico']);
        $stm->bindParam(":nombremedico", $data['nombremedico']);
        $stm->bindParam(":rutusuario", $data['rutusuario']);
        return $stm->execute();
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
    public function recetasXId($id)
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
        where receta.id_receta = :A  ';
        $stm = Conexion::conector()->prepare($sql);
        $stm->bindParam(":A", $id);
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
