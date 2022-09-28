<?php
date_default_timezone_set('America/Managua');
require_once 'conexion.php';

$sql="SELECT * FROM fnica.reiTipoEmisionPago";

$result=sqlsrv_query($conexion,$sql);

while ($fila = sqlsrv_fetch_array($result)) {

	echo '<option value="'.$fila['TipoPago'].'">'.$fila['Descripcion'].'</option>';
}