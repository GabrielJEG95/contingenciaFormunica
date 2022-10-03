<?php
date_default_timezone_set('America/Managua');

class sysCobro {
    public function actualizarPlazoCCF($documento,$plazo,$codSucursal,$conexion) {
        $sql = "UPDATE fnica.ccfDocumentosCC 
        set Plazo=$plazo,Vencimiento=dateadd(day,$plazo,Fecha),VencimientoVar=dateadd(day,$plazo,Fecha)
        where Documento='$documento' and CodSucursal='$codSucursal'";

        if(sqlsrv_query($conexion,$sql)) {
            return 1;
        } else {
            return 0;
        }
    }

    public function actualizarPlazoFact($plazo,$documento,$codSucursal,$conexion) {
        $sql="UPDATE fnica.fafFACTURA
        set FECHAVENCIMIENTO=dateadd(day,$plazo,FECHAFACTURA)
        where FACTURA = '$documento' and CODSUCURSAL = '$codSucursal'";

        if(sqlsrv_query($conexion,$sql)) {
            return 1;
        } else {
            return 0;
        }
    }

    public function mostrarFactura($documento,$CodCliente,$codSucursal,$conexion) {
        $sql = "SELECT a.*,b.NOMBRESCLIENTE+' '+b.APELLIDOSCLIENTE as Cliente
            FROM fnica.ccfDocumentosCC a
            join fnica.ccfCLIENTES b
            on a.CodCliente=b.CODCLIENTE
            where a.Documento='$documento' and a.CodCliente='$CodCliente' and a.CodSucursal='$codSucursal'";

            $result = sqlsrv_query($conexion,$sql);

            
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
            return $jsonString;
    }
}


class permisos {
    public function obtenerPermisos($usuario,$role,$conexion) {
        $sql = "SELECT *
        from fnica.secUSUARIOROLE
        where USUARIO='$usuario' and IDROLE=$role";

        $result = sqlsrv_query($conexion,$sql);
    }
}