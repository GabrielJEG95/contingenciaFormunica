<?php
session_start();
ob_start();
date_default_timezone_set('America/Managua');
require_once 'conexion.php';

$user = $_POST['user'];
$pass = $_POST['pass'];
$passhash = $_POST['passHash'];


$IpCliente=$_POST['ip'];

if ($IpCliente=='') {
    $ip=$_SERVER['REMOTE_ADDR']." Publica";
}else{
    $ip=$IpCliente." Local";
}

$_SESSION['IP'] = $ip;

$sql ="SELECT *
from fnica.globalUSUARIO where USUARIO='$user' and PASSWORD='$pass'";

$result=sqlsrv_query($conexion,$sql);
$tabla= array();

while($item = sqlsrv_fetch_array($result)){
    $tabla[] = array (
        'USUARIO' => $item['USUARIO'],
        'DESCR' => $item['DESCR'],
        'SUCURSAL' => $item['SUCURSAL']
    );
    $users=$item['USUARIO'];
}

$numRows= count($tabla);

if($numRows >=1 ) {
    $_SESSION['sesion_exitosa']=1;
    $_SESSION['Usuario']=$users;
    echo "1";
} else {
    echo "2";
}