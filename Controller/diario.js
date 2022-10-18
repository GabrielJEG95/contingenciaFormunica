$(document).ready(function(){
    $('#cmbSucursal').load('Controller/obtenerSucursal.php');
})

$('#frmFact').submit(function(e){
    e.preventDefault();
});

$('#btnBuscar').click(()=>{
    let opcion = 'get'
    let diario = $('#txtDiario').val()
    let sucursal = $('#cmbSucursal').val()

    buscarDiario(opcion,diario,sucursal)
})

$(document).on("click",".btnMostrar",function(){
    $('#cmbBancoEmisor').load('Controller/obtenerBancos.php');
    $('#cmbBancoReceptor').load('Controller/obtenerBancos.php');
    $('#cmbTipoPago').load('Controller/obtenerTipoPago.php?opcion=2')

    $(".modal-header").css("background-color", "#4c8c4a");
    $(".modal-header").css("color", "white" );
    $('#modalCRUD').modal('show');
    fila=$(this).closest("tr");
    let opcion = "getID"
    let diario = $('#txtDiario').val()
    let sucursal = $('#cmbSucursal').val()

    $('#txtNumDiario').val(diario)

    buscarDetalleDiario(opcion,diario,sucursal)


})

<<<<<<< HEAD
$(document).on("click",".btnUpt",function(){
    
    $(".modal-header").css("background-color", "#4c8c4a");
    $(".modal-header").css("color", "white" );
    
    $('#modalUpt').modal('show');
    fila=$(this).closest("tr");

    let EFC = fila.find('td:eq(2)').text()==".0000" ? "0.00" :fila.find('td:eq(2)').text()
    let EFD = fila.find('td:eq(3)').text()==".0000" ? "0.00" :fila.find('td:eq(3)').text()
    let chequeC = fila.find('td:eq(4)').text()==".0000" ? "0.00" :fila.find('td:eq(4)').text()
    let chequeD = fila.find('td:eq(5)').text()==".0000" ? "0.00" :fila.find('td:eq(5)').text()
    let otros = fila.find('td:eq(6)').text()==".0000" ? "0.00" :fila.find('td:eq(6)').text()
    let otrosD = fila.find('td:eq(9)').text()==".0000" ? "0.00" :fila.find('td:eq(9)').text()
    let retencion = fila.find('td:eq(8)').text()==".0000" ? "0.00" :fila.find('td:eq(8)').text()

    let diario = fila.find('td:eq(0)').text()
    let sucursal = fila.find('td:eq(1)').text()
    
    $('#exampleModalLabel').text(`Diario ${diario} de sucursal ${sucursal}`)

    $('#txtEF').val(EFC)
    $('#txtEFD').val(EFD)
    $('#txtCheq').val(chequeC)
    $('#txtCheqD').val(chequeD)
    $('#OtrosC').val(otros)
    $('#txtOtrosD').val(otrosD)
    $('#txtRetencion').val(retencion)
    $('#txtDiario').val(diario)
    $('#txtSuc').val(sucursal)
})

$('#btnActualizarDiario').click(()=>{
    let diario = $('#txtDiario').val()
    let sucursal = $('#txtSuc').val()
    let EF = $('#txtEF').val()
    let EFD = $('#txtEFD').val()
    let CHK = $('#txtCheq').val()
    let CHKD = $('#txtCheqD').val()
    let OTRO = $('#OtrosC').val()
    let OTROD = $('#txtOtrosD').val()
    let RETENCION = $('#txtRetencion').val()

    let data = new FormData()

    data.append('ef',EF)
    data.append('efd',EFD)
    data.append('chk',CHK)
    data.append('chkd',CHKD)
    data.append('otro',OTRO)
    data.append('otroD',OTROD)
    data.append('retencion',RETENCION)

    alertify.confirm('Advertencia', '¿Seguro que desea actualizar los montos del diario?', function(){ 
        $.ajax({
            url:`Controller/diario.php?opcion=put&codSucursal=${sucursal}&diario=${diario}`,
			method:"POST",
            contentType: false,
            dataType: 'json',
            data:data,
			cache:false,
            processData: false,
            success:function(data){
                if(data===1) {
                    alertify.success('Registro actualizado con exito') 
                    limpiarCampos()
                    buscarDetalleDiario(opcion,consecutivo,sucursal)
                    buscarDiario(opcion,consecutivo,sucursal)
                } else {
                    alertify.alert("Error","Error al actualizar el registro");
					return false;
                }
            }
        })
        
    }
    ,function(){ 
        alertify.error('Operacion Cancelada')
    });
})

=======
>>>>>>> 5faed471b40383b1c11d613d10c585c687024c2f
$(document).on("click",".btnAnular",function(){
    fila=$(this).closest("tr");
    let Linea = fila.find('td:eq(0)').text();
    let sucursal = fila.find('td:eq(1)').text();
    let consecutivo = fila.find('td:eq(2)').text();
    let deposito = fila.find('td:eq(8)').text();

    alertify.confirm('Advertencia', '¿Seguro que desea eliminar este recibo?', function(){ 
        $.ajax({
            url:`Controller/diario.php?opcion=delete&codSucursal=${sucursal}&diario=${consecutivo}&linea=${Linea}&deposito=${deposito}`,
			method:"GET",
            contentType: false,
            dataType: 'json',
			cache:false,
            processData: false,
            success:function(data){
                if(data===1) {
                    alertify.success('Registro anulado con exito') 
                    limpiarCampos()
                    buscarDetalleDiario(opcion,consecutivo,sucursal)
                    buscarDiario(opcion,consecutivo,sucursal)
                } else {
                    alertify.alert("Error","Error al anular el registro");
					return false;
                }
            }
        })
        
    }
    ,function(){ 
        alertify.error('Operacion Cancelada')
    });
    
})

<<<<<<< HEAD
$(document).on("click",".btnUpt",function(){
    fila=$(this).closest("tr");
    let Linea = fila.find('td:eq(0)').text();

})

=======
>>>>>>> 5faed471b40383b1c11d613d10c585c687024c2f
$('#btnAddDetalle').click(()=>{
    let monto=$('#txtMonto').val()
    let moneda=$("input[type=radio][name=rdbEsDol]").filter(":checked").val()
    let cliente = $('#txtNombreCliente').val()
    let bancoEmisor = $('#cmbBancoEmisor').val()
    let bancoReceptor =$('#cmbBancoReceptor').val()
    let fechaCierre = $('#dtpFechaCierre').val()
    let diario = $('#txtNumDiario').val()
    let TipoPago = $('#cmbTipoPago').val()
    let documento = $('#txtDocumento').val()
    let deposito = $('#txtDeposito').val()
    let opcion = "getID"

    let sucursal = $('#cmbSucursal').val()

    let data = new FormData()
    data.append('monto',monto)
    data.append('moneda',moneda)
    data.append('cliente',cliente)
    data.append('bancoEmisor',bancoEmisor)
    data.append('bancoReceptor',bancoReceptor)
    data.append('fechaCierre',fechaCierre)
    data.append('diario',diario)
    data.append('tipoPago',TipoPago)
    data.append('documento',documento)
    data.append('deposito',deposito)

    $.ajax({
            url:`Controller/diario.php?opcion=post&codSucursal=${sucursal}&diario=${diario}`,
			method:"POST",
            contentType: false,
            dataType: 'json',
			data:data,
			cache:false,
            processData: false,
            success:function(data){
                if(data===1) {
                    alertify.alert("Exito","Registro creado con exito");
                    limpiarCampos()
                    buscarDetalleDiario(opcion,diario,sucursal)
                } else {
                    alertify.alert("Error","Error al completar el registro");
					return false;
                }
            }
    })
})


function buscarDiario(opcion,diario,codSucursal) {
    $('#tblDiario').DataTable({
        "bDeferRender":true,
        "sPaginationType": "full_numbers",
        "ajax":{
            "url": "Controller/diario.php",
            "method": 'GET', 
            "data":{opcion:opcion,diario:diario,codSucursal:codSucursal},
            "dataSrc":""
        },
        "columns":[
            {"data": "NUMEROCONSECUTIVO"},
            {"data": "CODSUCURSAL"},
            {"data": "EFECTIVOCORDOBA"},
            {"data": "EFECTIVODOLAR"},
            {"data": "CHEQUECORDOBA"},
            {"data": "CHEQUEDOLAR"},
            {"data": "OTROS"},
            {"data": "TIPOCAMBIO"},
            {"data": "RETENCION"},
            {"data": "OTROSDOLAR"},
<<<<<<< HEAD
            {"defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-success btn-sm btnUpt'><i class='material-icons'>Editar</i></button><button class='btn btn-success btn-sm btnMostrar'><i class='material-icons'>Detalles</i></button> </div></div>"}
=======
            {"defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-success btn-sm btnMostrar'><i class='material-icons'>Detalles</i></button> </div></div>"}
>>>>>>> 5faed471b40383b1c11d613d10c585c687024c2f
       ],
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "destroy":true,
        "language":{
            "emptyTable":"No existe el documento en la base de datos",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
            "lengthMenu": "Mostrar _MENU_ registros",
            "infoFiltered": "(Filtrado de _MAX_ total registros)",
            "infoEmpty": "Mostrando 0 de 0 de 0 registros",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        }
    });
}

function buscarDetalleDiario(opcion,diario,codSucursal) {
    $('#tblDetalleDiario').DataTable({
        "bDeferRender":true,
        "sPaginationType": "full_numbers",
        "ajax":{
            "url": "Controller/diario.php",
            "method": 'GET', 
            "data":{opcion:opcion,diario:diario,codSucursal:codSucursal},
            "dataSrc":""
        },
        "columns":[
            {"data": "LINEA"},
            {"data": "CODSUCURSAL"},
            {"data": "NUMEROCONSECUTIVO"},
            {"data": "TipoPago"},
            {"data": "BancoEmisor"},
            {"data": "NUMERODOCUMENTO"},
            {"data": "NOMBRECLIENTE"},
            {"data": "BANCORECEPTOR"},
            {"data": "NUMERODEPOSITO"},
            {"data": "MONTOCORDOBA"},
            {"data": "MONTODOLAR"},
            {"defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-danger btn-sm btnAnular'><i class='material-icons'>Anular</i></button> </div></div>"}
       ],
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "destroy":true,
        "language":{
            "emptyTable":"No existe el documento en la base de datos",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
            "lengthMenu": "Mostrar _MENU_ registros",
            "infoFiltered": "(Filtrado de _MAX_ total registros)",
            "infoEmpty": "Mostrando 0 de 0 de 0 registros",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        }
    });
}

function limpiarCampos() {
    $('#txtDeposito').val('')
    $('#txtDocumento').val('')
    $('#txtMonto').val('')
    $('#txtNombreCliente').val('')
}