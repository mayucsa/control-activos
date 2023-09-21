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
    where ae.codigoempleado =".$Datos->codigo." AND estatus_asignacion_detalle=1";
    $datos = $dbcon->qBuilder($dbcon->conn(), 'all', $sql);
    dd($datos);
}

function editarRelacion ($dbcon, $Datos){
	$sql = "UPDATE asignacion_equipo_detalle  set estatus_asignacion_detalle=0
    where cve_cequipo= ".$Datos->codigo."  ";
    $datos = $dbcon->qBuilder($dbcon->conn(), 'do', $sql);
    // dd($datos);

    $sql2=" UPDATE caracteristicas_equipos SET estatus_equipo=1
		where cve_cequipo=".$Datos->codigo."";
		$datos2 = $dbcon->qBuilder($dbcon->conn(), 'do', $sql2);
        if (!$datos2) {
            // Manejar el error, imprimir un mensaje de error o registrar detalles del error.
            echo "Error al ejecutar la segunda consulta SQL: " . $dbcon->error(); // Asegúrate de tener un método de manejo de errores adecuado en tu clase $dbcon.
        }
		
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
    case 'editarRelacion':
        editarRelacion($dbcon, $objDatos);
    break; 
    
}