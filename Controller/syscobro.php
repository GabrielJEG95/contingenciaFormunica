<?php
date_default_timezone_set('America/Managua');
session_start();
ob_start();
require_once 'conexion.php';

$opcion=$_GET['opcion'];
$documento=$_GET['documento'];
$codSucursal=$_GET['codSucursal'];
$CodCliente =$_GET['CodCliente'];

$usuario = $_SESSION['Usuario'];
$table = 'ccfDocumentoCC';
$action = '';
$initialVal='';
$finalVal='';
$ip = $_SESSION['IP'];
$contingencia = new contingencia();

switch($opcion) 
{
    case 'get':
            $sql = "SELECT * FROM fnica.ccfDocumentoCC where Documento='$documento' and CodCliente='$CodCliente' and CodSucursal='$codSucursal'";
            $result = sqlsrv_query($conexion,$sql);

            $action='consultar documento '.$documento." de sucursal ".$codSucursal;
            $contingencia->logContig($table,$usuario,$action,$initialVal,$finalVal,$ip,$conexion);

            $tabla= array();

            while($item = sqlsrv_fetch_array($result)){
                $tabla[] = array (
                    'IDDocumentoCC' => $item['IDDocumentoCC'],
                    'CodCliente' => $item['CodCliente'],
                    'CodSucursal' => $item['CodSucursal'],
                    'Documento' => $item['Documento'],
                    'Plazo' => $item['Plazo'],
                    'Vencimiento' => $item['Vencimiento']->format('Y-m-d'),
                    'VencimientoVar' => $item['VencimientoVar']->format('Y-m-d'),
                    'MontoOriginal' => $item['MontoOriginal'],
                    'SaldoActual' => $item['SaldoActual']
                );
            }
            
            $jsonString = json_encode($tabla);
            echo $jsonString;

        break;
    case 'post':
        break;
    case 'put':
        break;
    case 'delete':
        break;
}