<?php
date_default_timezone_set('America/Managua');

class sysCobro {
    public function actualizarPlazoCCF($documento,$plazo,$codSucursal,$conexion) {
        $sql = "UPDATE fnica.ccfDocumentosCC 
        set Plazo='$plazo',Vencimiento=dateadd(day,'$plazo',Fecha),VencimientoVar=dateadd(day,'$plazo',Fecha)
        where Documento='$documento' and CodSucursal='$codSucursal'";

        if(sqlsrv_query($conexion,$sql)) {
            return 1;
        } else {
            return 0;
        }
    }

    public function actualizarPlazoFact($plazo,$documento,$codSucursal,$conexion) {
        $sql="UPDATE fnica.fafFACTURA
        set FECHAVENCIMIENTO=DATEADD(day,'$plazo',FECHAFACTURA)
        where FACTURA = '$documento' and CODSUCURSAL = '$codSucursal'";

        if(sqlsrv_query($conexion,$sql)) {
            return 1;
        } else {
            return 0;
        }
    }
}
