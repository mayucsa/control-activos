<?php
date_default_timezone_set('America/Chihuahua');
function dd($var){
    if (is_array($var) || is_object($var)) {
        die(json_encode($var));
    }else{
        die($var);
    }
}
function getEmpleadoCata ($dbcon){
	$sql = "select codigoempleado, nombre, CONCAT(apellidopaterno,' ', apellidomaterno)apellido,
     puesto, departamento  from cat_usuario_nomina  WHERE estadoempleado IN ('A','R')";
    $datos = $dbcon->qBuilder($dbcon->conn(), 'all', $sql);
    dd($datos);
}


include_once "../../../dbconexion/conn.php";
$dbcon	= 	new MysqlConn;
$conn 	= 	$dbcon->conn();
// inicio
$tarea = isset($_REQUEST['task']) ? $_REQUEST['task'] : '';
if ($tarea == '') {
	// en caso de que el llamado al controlador haya sido por http post y no por formulario
	$objDatos = json_decode(file_get_contents("php://input"));
	$tarea = $objDatos->task;
}
switch ($tarea) { 
    // case 'getServicios':
    //     getServicios($dbcon);
    //     break;
	case 'getEmpleadoCata': 
		getEmpleadoCata($dbcon);
		break;

}

?>