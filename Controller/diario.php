<?php

date_default_timezone_set('America/Managua');
session_start();
ob_start();
require_once 'conexion.php';
include('log.php');
include('funciones.php');
include ('validaAutorizacion.php');
$validate = new autorize();

if(!$validate->validate()) {
    echo '[{error:No Autorizado,statusCode:401}]';
} else {
    $consecutivo=$_GET['diario'];
    $sucursal=$_GET['codSucursal'];
    $opcion=$_GET['opcion'];



    $usuario = $_SESSION['Usuario'];
    $table = 'fafDIARIO';
    $action = '';
    $initialVal='';
    $finalVal='';
    $ip = $_SESSION['IP'];

    $contingencia = new contingencia();
    $diario = new diario();

    switch($opcion)
    {
        case 'get':
                echo $diario->buscarDiario($consecutivo,$sucursal,$conexion);

                $action='consultar diario '.$consecutivo." de sucursal ".$sucursal;
                $contingencia->logContig($table,$usuario,$action,$initialVal,$finalVal,$ip,$conexion);

            break;
        case 'getID':
                echo $diario->detalleDiario($consecutivo,$sucursal,$conexion);
                $table = "fafDIARIODETALLE";
                $action='consultar detalle diario '.$consecutivo." de sucursal ".$sucursal;
                $contingencia->logContig($table,$usuario,$action,$initialVal,$finalVal,$ip,$conexion);
            break;
        case 'post':

                $monto=$_POST['monto'];
                $moneda=$_POST['moneda'];
                $cliente=$_POST['cliente'];
                $bancoEmisor=$_POST['bancoEmisor'];
                $bancoReceptor=$_POST['bancoReceptor'];
                $fechaCierre=$_POST['fechaCierre'];
                $diarioPost=$_POST['diario'];
                $tipoPago=$_POST['tipoPago'];
                $documento=$_POST['documento'];
                $deposito=$_POST['deposito'];

                echo $diario->registrarDiarioDetalle($consecutivo,$sucursal,$monto,$moneda,$cliente,$bancoEmisor,$bancoReceptor,$fechaCierre,$diarioPost,$conexion,$tipoPago,$documento,$deposito);
                    
                
            break;
        case 'put':
            break;
        case 'delete':
                $linea = $_GET['linea'];
                $deposito = $_GET['deposito'];
                
                echo $diario->eliminarLineaDiario($linea,$sucursal,$consecutivo,$deposito,$conexion);
            break;
    }
}




?>