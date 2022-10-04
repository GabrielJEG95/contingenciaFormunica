<?php

date_default_timezone_set('America/Managua');
session_start();
ob_start();
require_once 'conexion.php';
include('log.php');
include('funciones.php');

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
        break;
    case 'put':
        break;
}


?>