$(document).ready(function(){
    
    $('#cmbSucursal').load('Controller/obtenerSucursal.php');
})

$('#frmSysCobro').submit(function(e){
    e.preventDefault();
});

$('#cmbSucursal').on('change',function(){
    $('#cmbCliente').load("Controller/obtenerCliente.php?codSucursal="+this.value)
})

$('#btnBuscar').click(()=>{
    let opcion = 'get'
    let documento = $('#txtDocumento').val()
    let sucursal = $('#cmbSucursal').val()
    let cliente = $('#cmbCliente').val()

    buscarDocumento(opcion,documento,sucursal,cliente)
})

function buscarDocumento(opcion,documento,codSucursal,CodCliente) {
    $('#tblDocumenetoCC').DataTable({
        "bDeferRender":true,
        "sPaginationType": "full_numbers",
        "ajax":{
            "url": "Controller/syscobro.php",
            "method": 'GET', 
            "data":{opcion:opcion,documento:documento,codSucursal:codSucursal,CodCliente:CodCliente},
            "dataSrc":""
        },
        "columns":[
            {"data": "IDDocumentoCC"},
            {"data": "CodCliente"},
            {"data": "CodSucursal"},
            {"data": "Documento"},
            {"data": "MontoDocument"},
            {"data": "Plazo"},
            {"data": "Vencimiento"},
            {"data": "VencimientoVar"},
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