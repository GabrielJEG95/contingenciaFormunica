<?php

date_default_timezone_set('America/Managua');
require_once 'conexion.php';

$opcion=$_GET['opcion'];
$IdSolicitud = $_GET['IDSol'];

switch($opcion) {
    case "get":
            $sql="SELECT * FROM fnica.reiSolicitudReintegroDePagoDetalle where IdSolicitud='$IdSolicitud'";

            $result=sqlsrv_query($conexion,$sql);
            
            $tabla= array();
            
            while($item = sqlsrv_fetch_array($result)){
                $tabla[] = array (
                    'IdSolicitud' => $item['IdSolicitud'],
                    'CENTRO_COSTO' => $item['CENTRO_COSTO'],
                    'Cuenta_Contable' => $item['Cuenta_Contable'],
                    'Linea' => $item['Linea'],
                    'Concepto' => $item['Concepto'],
                    'FechaFactura' => $item['FechaFactura']->format('Y-m-d'),
                    'Monto' => $item['Monto']
                );
            }
            
            $jsonString = json_encode($tabla);
            echo $jsonString;
        break;
    case "post":
            $IdSolicitud = $_POST['txtIdSolic'];
            $CentroCosto = $_POST['centroCosto'];
            $CuentaContable = $_POST['cuentaContable'];
            $FechaFactura = $_POST['dtpFechaFactura'];
            $NumFactura = $_POST['txtNumFact'];
            $NombreEstablecimiento = $_POST['txtNombreEst'];
            $monto = $_POST['txtMonto'];
            $concepto = $_POST['txtConcepto'];

            $consulta="SELECT max(Linea) as Linea from fnica.reiSolicitudReintegroDePagoDetalle where IdSolicitud='$IdSolicitud'";
            $result = sqlsrv_query($conexion,$consulta);
            while($item = sqlsrv_fetch_array($result)){
                $Linea = $item['Linea'];
            }
            $Linea=$Linea+1;
            $sql="INSERT INTO fnica.reiSolicitudReintegroDePagoDetalle (IdSolicitud,CENTRO_COSTO,Cuenta_Contable,Linea,Concepto,FechaFactura,NumeroFactura,NombreEstablecimiento_Persona,Monto)
            values('$IdSolicitud','$CentroCosto','$CuentaContable','$Linea','$concepto','$FechaFactura','$NumFactura','$NombreEstablecimiento','$monto')";

            if(sqlsrv_query($conexion,$sql)) {
                echo 1;
            } else {
                echo 2;
            }

        break;
    case "put":
        break;
    case "delete":
            $CentroCosto = $_GET['CentroCosto'];
            $Linea = $_GET['Linea'];
            $sql="DELETE FROM fnica.reiSolicitudReintegroDePagoDetalle where IdSolicitud='$IdSolicitud' and CENTRO_COSTO = '$CentroCosto' and Linea = '$Linea'";
            
        break;
}

