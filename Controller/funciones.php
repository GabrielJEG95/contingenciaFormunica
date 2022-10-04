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
    public function tienePermiso($usuario,$role,$conexion) {
        $sql = "SELECT *
        from fnica.secUSUARIOROLE
        where USUARIO='$usuario' and IDROLE=$role";

        $result = sqlsrv_query($conexion,$sql);

        $data = array();
        $IdRole = '';

        while($item = sqlsrv_fetch_array($result)) {
            $data[] = array (
                'IDRole' => $item['IDROLE'],
                'USUARIO' => $item['USUARIO'],
                'IdModulo' => $item['IDMODULO']
            );
            $IdRole = $item['IDROLE'];
            
        }
        
        if($IdRole != 0) {
            return true;
        } else {
            return false;
        }

    }
}


class factura {
    public function buscarFactura($factura,$sucursal,$conexion) {
        $sql = "SELECT a.FACTURA,a.CODCLIENTE,b.NOMBRESCLIENTE+' '+b.APELLIDOSCLIENTE as Cliente,
        a.CODSUCURSAL,c.SUCURSAL,a.CODVENDEDOR, d.NOMBRESVENDEDOR,a.TIPOPAGO,a.SUBTOTAL,a.DESCUENTO,
        a.TOTALFACTURA,a.FECHAFACTURA
        from fnica.fafFACTURA a
        join fnica.ccfCLIENTES b
        on a.CODCLIENTE=b.CODCLIENTE
        join fnica.GlobalSucursales c
        on a.CODSUCURSAL=c.CODSUCURSAL
        join fnica.globalVENDEDORES d
        on a.CODVENDEDOR=d.CODVENDEDOR
        where FACTURA=$factura and a.CODSUCURSAL='$sucursal'";

        $result=sqlsrv_query($conexion,$sql);
        $data = array();


        while($item = sqlsrv_fetch_array($result)) {
            $data[] = array (
                'FACTURA' => $item['FACTURA'],
                'CODCLIENTE' => $item['CODCLIENTE'],
                'Cliente' => $item['Cliente'],
                'CODSUCURSAL' => $item['CODSUCURSAL'],
                'SUCURSAL' => $item['SUCURSAL'],
                'CODVENDEDOR' => $item['CODVENDEDOR'],
                'NOMBRESVENDEDOR' => $item['CODVENDEDOR']."-".$item['NOMBRESVENDEDOR'],
                'TIPOPAGO' => $item['TIPOPAGO'],
                'SUBTOTAL' => $item['SUBTOTAL'],
                'DESCUENTO' => $item['DESCUENTO'],
                'TOTALFACTURA' => $item['TOTALFACTURA'],
                'FECHAFACTURA' => $item['FECHAFACTURA']->format('Y-m-d'),
            );
            
        }

        $jsonString = json_encode($data);
        return $jsonString;

    }

    public function detalleFactura($factura,$sucursal,$conexion) {
        $sql = "SELECT a.CODSUCURSAL,b.Descr,a.ARTICULO,c.DESCRIPCION,a.CODCLIENTE,
        a.CANTIDAD,a.PRECIOUNITARIODOLAR,a.SUBTOTALDOLAR,a.TOTALDOLAR,a.LOTE
        from fnica.fafFACTURADETALLE a
        join fnica.fafTIPO b
        on a.TIPO=b.Tipo
        join fnica.ARTICULO c
        on a.ARTICULO=c.ARTICULO
        where FACTURA=$factura and CODSUCURSAL='$sucursal';";

        $result = sqlsrv_query($conexion,$sql);

        $data = array();
        while($item = sqlsrv_fetch_array($result)) {
            $data[] = array (
                'CODSUCURSAL' => $item['CODSUCURSAL'],
                'TipoFact' => $item['Descr'],
                'ARTICULO' => $item['ARTICULO'],
                'NombreArticulo' => $item['DESCRIPCION'],
                'CODCLIENTE' => $item['CODCLIENTE'],
                'CANTIDAD' => $item['CANTIDAD'],
                'PRECIOUNITARIODOLAR' => $item['PRECIOUNITARIODOLAR'],
                'SUBTOTALDOLAR' => $item['SUBTOTALDOLAR'],
                'TOTALDOLAR' => $item['TOTALDOLAR'],
                'LOTE' => $item['LOTE']
            );
            
        }

        $jsonString = json_encode($data);
        return $jsonString;

    }
}

class diario {
    
    public function buscarDiario($diario,$sucursal,$conexion) {
        
        $sql = "SELECT *
        from fnica.fafDIARIO
        where NUMEROCONSECUTIVO=$diario and CODSUCURSAL='$sucursal'";

        $result = sqlsrv_query($conexion,$sql);

        $data = array();
        while($item = sqlsrv_fetch_array($result)) {
            $data[] = array (
                'CODSUCURSAL' => $item['CODSUCURSAL'],
                'NUMEROCONSECUTIVO' => $item['NUMEROCONSECUTIVO'],
                'EFECTIVOCORDOBA' => $item['EFECTIVOCORDOBA'],
                'EFECTIVODOLAR' => $item['EFECTIVODOLAR'],
                'CHEQUECORDOBA' => $item['CHEQUECORDOBA'],
                'CHEQUEDOLAR' => $item['CHEQUEDOLAR'],
                'OTROS' => $item['OTROS'],
                'TIPOCAMBIO' => $item['TIPOCAMBIO'],
                'RETENCION' => $item['RETENCION']
            );
            
        }

        $jsonString = json_encode($data);
        return $jsonString;

    }

    public function detalleDiario($diario,$sucursal,$conexion) {
        $sql = "SELECT a.LINEA,a.CODSUCURSAL,a.FECHACIERRE,a.NUMEROCONSECUTIVO,a.NOMBRECLIENTE,
        c.DESCRIPCION as BancoEmisor,a.BANCORECEPTOR,a.NUMERODEPOSITO,a.MONTOCORDOBA,
        a.MONTODOLAR,b.DESCRIPCION as TipoPago,a.NUMERODOCUMENTO
        from fnica.fafDIARIODETALLE a
        join fnica.fafTIPOSPAGO b
        on a.TIPOPAGO=b.TIPOPAGO
        join fnica.fafBANCOS c
        on a.BANCOEMISOR = c.CODBANCO
        where NUMEROCONSECUTIVO='$diario' and CODSUCURSAL='$sucursal';";

        $result = sqlsrv_query($conexion,$sql);

        $data = array();
        while($item = sqlsrv_fetch_array($result)) {
            $data[] = array (
                'LINEA' => $item['LINEA'],
                'CODSUCURSAL' => $item['CODSUCURSAL'],
                'FECHACIERRE' => $item['FECHACIERRE'],
                'NUMEROCONSECUTIVO' => $item['NUMEROCONSECUTIVO'],
                'TipoPago' => $item['TipoPago'],
                'NOMBRECLIENTE' => $item['NOMBRECLIENTE'],
                'BancoEmisor' => $item['BancoEmisor'],
                'BANCORECEPTOR' => $item['BANCORECEPTOR'],
                'NUMERODEPOSITO' => $item['NUMERODEPOSITO'],
                'MONTOCORDOBA' => $item['MONTOCORDOBA'],
                'MONTODOLAR' => $item['MONTODOLAR'],
                'NUMERODOCUMENTO' => $item['NUMERODOCUMENTO']
            );
            
        }

        $jsonString = json_encode($data);
        return $jsonString;
    }

    public function obtenerUltimaLinea($diario,$sucursal,$conexion) {
        $sql = "SELECT LINEA 
        FROM fnica.fafDIARIODETALLE
        where NUMEROCONSECUTIVO='$diario' and CODSUCURSAL='$sucursal';";

        $result = sqlsrv_query($conexion,$sql);
        $Linea = '';

        while($item = sqlsrv_fetch_array($result)) {
            $Linea = $item['LINEA'];
            
        }
        $Linea=$Linea+1;

        return $Linea;

    }

    public function registrarDiarioDetalle($consecutivo,$sucursal,$monto,$moneda,$cliente,$bancoEmisor,$bancoReceptor,$fechaCierre) {
        $montoCordoba = 0;
        $montoDolar = 0;

        switch($moneda)
        {
            case 'dol':
                    $montoDolar = $monto;
                break;
            case 'cor':
                    $montoCordoba = $monto;
                break;
        }


    }
}