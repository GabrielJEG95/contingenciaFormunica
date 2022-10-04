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
            {"defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-success btn-sm btnMostrar'><i class='material-icons'>Detalles</i></button> </div></div>"}
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