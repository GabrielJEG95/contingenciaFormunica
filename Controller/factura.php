<?php
date_default_timezone_set('America/Managua');
session_start();
ob_start();
require_once 'conexion.php';
include('log.php');
include('funciones.php');

$codfactura=$_GET['documento'];
$SUCURSAL=$_GET['codSucursal'];
$opcion=$_GET['opcion'];

$usuario = $_SESSION['Usuario'];
$table = 'fafFactura';
$action = '';
$initialVal='';
$finalVal='';
$ip = $_SESSION['IP'];

$contingencia = new contingencia();
$factura = new factura();

switch($opcion) 
{
    case 'get':
        echo $factura->buscarFactura($codfactura,$SUCURSAL,$conexion);

        $action='consultar factura '.$codfactura." de sucursal ".$SUCURSAL;
        $contingencia->logContig($table,$usuario,$action,$initialVal,$finalVal,$ip,$conexion);

        break;
    case 'getID':
        echo $factura->detalleFactura($codfactura,$SUCURSAL,$conexion);

        $table = 'fafFacturaDetalle';

        $action='consultar detalle de factura '.$codfactura." de sucursal ".$SUCURSAL;
        $contingencia->logContig($table,$usuario,$action,$initialVal,$finalVal,$ip,$conexion);
        
        break;
    case 'post':
        break;
    case 'put':
        break;
}


