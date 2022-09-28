<?php
date_default_timezone_set('America/Managua');
session_start();
ob_start();
require_once 'conexion.php';

$opcion=$_GET['opcion'];
$IdSolicitud = $_GET['IDSol'];

switch($opcion) {
    case "get":
            if($IdSolicitud != null || $IdSolicitud != 0) {
                $sql="SELECT * FROM fnica.reiSolicitudReintegroDePago where IdSolicitud='$IdSolicitud'";
            } else {
                $sql="SELECT top 50 * FROM fnica.reiSolicitudReintegroDePago order by FechaSolicitud desc";
            }
            

            $result=sqlsrv_query($conexion,$sql);
            
            $tabla= array();
            
            while($item = sqlsrv_fetch_array($result)){
                $tabla[] = array (
                    'IdSolicitud' => $item['IdSolicitud'],
                    'CENTRO_COSTO' => $item['CENTRO_COSTO'],
                    'Concepto' => $item['Concepto'],
                    'FechaSolicitud' => $item['FechaSolicitud']->format('Y-m-d'),
                    'Monto' => $item['Monto']
                );
                
            }
            
            $jsonString = json_encode($tabla,JSON_UNESCAPED_UNICODE);
            //echo '{"Data":['.$jsonString.']}';
            echo $jsonString;
        break;
    case "post":
            $centroCosto = $_POST['centroCosto'];
            $beneficiario= $_POST['nombreBeneficiario'];
            $monto= $_POST['monto'];
            $FechaFactura = $_POST['fechaFact'];
            $tipoSol = $_POST['cmbTipoSol'];
            $concepto= $_POST['txtConcepto'];
            $esDolar=$_POST['rdbEsDol'];
            $estadoSol=$_POST['cmbEstadoSol'];
            $usuario = $_SESSION['Usuario'];
            $consulta="SELECT max(IdSolicitud) as IdSolicitud FROM fnica.reiSolicitudReintegroDePago";
            $fechaReg=date('Y-m-d H:m:s');
            $fechaAsientoContable=null;
            $NumCheque=null;
            $asiento=null;

            $usuario1='';
            $fechaUpt='';
            $anulado=0;
            $flgAsientoGenerado=0;

            $result=sqlsrv_query($conexion,$consulta);
            while($item = sqlsrv_fetch_array($result)){
                $IdSolicitud = $item['IdSolicitud'];
            }
            $IdSolicitud=$IdSolicitud+1;
            $sql = "INSERT INTO fnica.reiSolicitudReintegroDePago 
            (IdSolicitud,CENTRO_COSTO,FechaSolicitud,Monto,TipoPago,Beneficiario,Concepto,EsDolar,CodEstado,Usuario,FECHAREGISTRO,Asiento,CUENTA_BANCO,NumCheque,Anulada,flgAsientoGenerado,FechaAsientoContable,USUARIO1,FECHAUPDATE)
                    values('$IdSolicitud','$centroCosto','$FechaFactura','$monto','$tipoSol','$beneficiario','$concepto','$esDolar','$estadoSol','$usuario','$fechaReg','$asiento','','$NumCheque','$anulado','$flgAsientoGenerado','$fechaAsientoContable','$usuario1','$fechaUpt')";
            if(sqlsrv_query($conexion,$sql)){
                echo $IdSolicitud;
            }else {
                echo "2";
            }
        break;
    case "put":
        break;
    case "delete":
        break;
}

