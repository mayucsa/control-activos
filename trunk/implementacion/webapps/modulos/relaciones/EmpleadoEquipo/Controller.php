<?php
date_default_timezone_set('America/Chihuahua');
function dd($var){
    if (is_array($var) || is_object($var)) {
        die(json_encode($var));
    }else{
        die($var);
    }
}

function getRelacionEmpleados ($dbcon){
	$sql = "SELECT cun.nombre ,CONCAT(cun.apellidopaterno, ' ', cun.apellidomaterno) apellidos, ae.codigoempleado
    FROM asignacion_equipo ae 
    inner join cat_usuario_nomina cun on cun.codigoempleado =ae.codigoempleado ";
    $datos = $dbcon->qBuilder($dbcon->conn(), 'all', $sql);
    dd($datos);
}

function getRelacionEquipos ($dbcon, $Datos){
	$sql = "SELECT aed.cve_asignacion, aed.cve_cequipo, ae.codigoempleado, marca, modelo, ce2.nombre_equipo, aed.fecha_asignacion
    from asignacion_equipo_detalle aed
    INNER JOIN asignacion_equipo ae ON ae.cve_asignacion = aed.cve_asignacion
    INNER JOIN caracteristicas_equipos ce on ce.cve_cequipo =aed.cve_cequipo
    INNER JOIN cat_equipos ce2 ON ce2.cve_equipo = ce.cve_equipo
    where ae.codigoempleado =".$Datos->codigo." ";
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
    case 'getRelacionEmpleados':
        getRelacionEmpleados($dbcon);
    break; 
    case 'getRelacionEquipos':
        getRelacionEquipos($dbcon, $objDatos);
    break; 
    
}