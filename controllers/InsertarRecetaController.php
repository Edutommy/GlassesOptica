<?php

namespace controllers;

use models\RecetaModel as RecetaModel;

require_once("../models/RecetaModel.php");
session_start();
class insertarReceta
{
    public $tipo_lente;
    public $esfera_oi;
    public $esfera_od;
    public $cilindro_oi;
    public $cilindro_od;
    public $eje_oi;
    public $eje_od;
    public $prisma;
    public $base;
    public $armazon;
    public $material_cristal;
    public $tipo_cristal;
    public $distancia_pupilar;
    public $valor_lente;
    public $fecha_entrega;
    public $fecha_retiro;
    public $observacion;
    public $rut_cliente;
    public $fecha_visita_medico;
    public $rut_medico;
    public $nombre_medico;
    public $rut_usuario;

    public function __construct()
    {
        $this->tipo_lente = $_POST['tipo_lente'];
        $this->esfera_oi = $_POST['esfera_oi'];
        $this->esfera_od = $_POST['esfera_od'];
        $this->cilindro_oi = $_POST['cilindro_oi'];
        $this->cilindro_od = $_POST['cilindro_od'];
        $this->eje_oi = $_POST['eje_oi'];
        $this->eje_od = $_POST['eje_od'];
        $this->prisma = $_POST['prisma'];
        $this->base = $_POST['base'];
        $this->armazon = $_POST['armazon'];
        $this->material_cristal = $_POST['material_cristal'];
        $this->tipo_cristal = $_POST['tipo_cristal'];
        $this->distancia_pupilar = $_POST['distancia_pupilar'];
        $this->valor_lente = $_POST['valor_lente'];
        $this->fecha_entrega = $_POST['fecha_entrega'];
        $this->fecha_retiro = $_POST['fecha_retiro'];
        $this->observacion = $_POST['observacion'];
        $this->rut_cliente = $_POST['rut_cliente'];
        $this->rut_medico = $_POST['rut_medico'];
        $this->nombre_medico = $_POST['nombre_medico'];
    }
    public function insertarReceta()
    {
        if(isset($_SESSION['user'])){
            $usuario = $_SESSION['user'];
            $rutUser = $usuario['rut'];
            $this->rut_usuario = $rutUser;
            $this->fecha_visita_medico = date("Y/m/d");
            $model = new RecetaModel();
            $data = ["tipo_lente"=>$this->tipo_lente,"esfera_oi"=>$this->esfera_oi,"esfera_od"=>$this->esfera_od,
            "cilindro_oi"=>$this->cilindro_oi,"cilindro_od"=>$this->cilindro_od,"eje_oi"=>$this->eje_oi,"eje_od"=>$this->eje_od,
            "prisma"=>$this->prisma,"base"=>$this->base,"armazon"=>$this->armazon,"material_cristal"=>$this->material_cristal,
            "tipo_cristal"=>$this->tipo_cristal,"distancia_pupilar"=>$this->distancia_pupilar,"valor_lente"=>$this->valor_lente,
            "fecha_entrega"=>$this->fecha_entrega,"fecha_retiro"=>$this->fecha_retiro,
            "observacion"=>$this->observacion,"rut_cliente"=>$this->rut_cliente,
            "fecha_visita_medico"=>$this->fecha_visita_medico,"rut_medico"=>$this->rut_medico,"nombre_medico"=>$this->nombre_medico,
            "rut_usuario"=>$this->rut_usuario];
            if ($this->rut_cliente == ""){
                $mensaje = ["msg"=>"ingrese un rut valido"];
                echo json_encode($mensaje);
                return;
            }
            if ($this->tipo_lente == "" || $this->tipo_cristal == "" || $this->material_cristal == "" || $this->armazon == "" || $this->distancia_pupilar == "" 
                || $this->esfera_oi == "" || $this->esfera_od == "" || $this->cilindro_oi == "" || $this->cilindro_od == "" || $this->eje_oi == ""
                || $this->eje_od == "" || $this->rut_medico == "" || $this->nombre_medico == "" || $this->fecha_entrega =="" || $this->fecha_retiro == "" || $this->valor_lente == "") {
                    $mensaje = ["msg"=>"Complete todos los campos"];
                    echo json_encode($mensaje);
            }

            if ((isset($mensaje))){
                echo json_encode($mensaje); 
                return;
            }

            $count = $model->insertarReceta($data);
            if ($count == 1) {
                $mensaje = ["msg"=>"Receta Creada"];
                echo json_encode($mensaje);
            } else {
                $mensaje = ["msg"=>"no se ha podido generar la receta"];
                echo json_encode($mensaje);
            }
        } else {
            $mensaje = ["msg"=>"session no iniciada"];
            echo json_encode($mensaje);
        }
    }
}
