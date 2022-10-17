<div class="container">
    <div class="row">
        <?php
            $usuario = $_SESSION['Usuario'];
            $role = '7001';
            if($permisos->tienePermiso($usuario,$role,$conexion)) {
                echo '<div class="col-3">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="Views/dist/img/reintegro.jpg" alt="Card image cap" style="height:200px">
                    <div class="card-body">
                        <h5 class="card-title">Reintegro</h5><br>
                        <p class="card-text">Realizar Solicitudes de reintegro y registro de prorrateo</p>
                        <a href="reintegro.php" class="btn btn-success">Abrir</a>
                    </div>
                </div>
            </div>';
            }

        ?>
        
        <?php 
            $usuario = $_SESSION['Usuario'];
            $role = '7002';
            if($permisos->tienePermiso($usuario,$role,$conexion)) {
                echo '<label for="" style="color:white">---</label>
                <div class="col-3">
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="Views/dist/img/cxc.jpg" alt="Card image cap" style="height:200px">
                        <div class="card-body">
                            <h5 class="card-title">SysCobro</h5><br>
                            <p class="card-text">Actualizar plazos de vencimiento en facturas de credito</p>
                            <a href="syscobro.php" class="btn btn-success">Abrir</a>
                        </div>
                    </div>
                </div>';
            }
        ?>

        <?php 
            $usuario = $_SESSION['Usuario'];
            $role = '7003';
            if($permisos->tienePermiso($usuario,$role,$conexion)) {
                echo '<label for="" style="color:white">---</label>
                <div class="col-3">
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="Views/dist/img/factura.png" alt="Card image cap" style="height:200px">
                        <div class="card-body">
                            <h5 class="card-title">Factura Diario</h5><br>
                            <p class="card-text">Actualizar referencias de recibo y eliminar recibos de deposito</p>
                            <a href="factura.php" class="btn btn-success">Abrir</a>
                        </div>
                    </div>
                </div>';
            }
        ?>

<?php 
            $usuario = $_SESSION['Usuario'];
            $role = '7004';
            if($permisos->tienePermiso($usuario,$role,$conexion)) {
                echo '<label for="" style="color:white">---</label>
                <div class="col-3">
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="Views/dist/img/factura.png" alt="Card image cap" style="height:200px">
                        <div class="card-body">
                            <h5 class="card-title">Factura</h5><br>
                            <p class="card-text">Actualizar codigo de vendedor asignado a la factura</p>
                            <a href="facturaVendedor.php" class="btn btn-success">Abrir</a>
                        </div>
                    </div>
                </div>';
            }
        ?>
        
    </div>
</div>