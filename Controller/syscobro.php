<?php
date_default_timezone_set('America/Managua');
session_start();
ob_start();
require_once 'conexion.php';
include('log.php');
include('funciones.php');

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
$sysCobro= new sysCobro();

switch($opcion) 
{
    case 'get':
            $sql = "SELECT a.*,b.NOMBRESCLIENTE+' '+b.APELLIDOSCLIENTE as Cliente
            FROM fnica.ccfDocumentosCC a
            join fnica.ccfCLIENTES b
            on a.CodCliente=b.CODCLIENTE
            where a.Documento='$documento' and a.CodCliente='$CodCliente' and a.CodSucursal='$codSucursal'";

            $result = sqlsrv_query($conexion,$sql);

            $action='consultar documento '.$documento." de sucursal ".$codSucursal;
            $contingencia->logContig($table,$usuario,$action,$initialVal,$finalVal,$ip,$conexion);

            $tabla= array();

            while($item = sqlsrv_fetch_array($result)){
                $tabla[] = array (
                    'IDDocumentoCC' => $item['IDDocumentoCC'],
                    'CodCliente' => $item['CodCliente'],
                    'Cliente' => $item['Cliente'],
                    'CodSucursal' => $item['CodSucursal'],
                    'Documento' => $item['Documento'],
                    'Plazo' => $item['Plazo'],
                    'Fecha' => $item['Fecha']->format('Y-m-d'),
                    'Vencimiento' => $item['Vencimiento']->format('Y-m-d'),
                    'VencimientoVar' => $item['VencimientoVar']->format('Y-m-d'),
                    'MontoOriginal' => $item['MontoOriginal'],
                    'SaldoActual' => $item['SaldoActual'],
                    'PorcInteres' => $item['PorcInteres'],
                    'Asiento' => $item['Asiento']
                );
            }
            
            $jsonString = json_encode($tabla);
            echo $jsonString;

        break;
    case 'post':
            
        break;
    case 'put':
        $plazo=$_POST['Plazo'];
        if($sysCobro->actualizarPlazoCCF($documento,$plazo,$codSucursal,$conexion)) {
            echo $sysCobro->actualizarPlazoFact($plazo,$documento,$codSucursal,$conexion);
        }
        
        break;
    case 'delete':
        break;
}