<?php
date_default_timezone_set('America/Chihuahua');
function dd($var){
    if (is_array($var) || is_object($var)) {
        die(json_encode($var));
    }else{
        die($var);
    }
}

 // me sirve para mostrar en la pantalla de asignación 
// todas las asignaciones que se han hecho
function getProduccion($dbcon){
	$sql = "SELECT ae.cve_asignacion, ae.codigo_empleado, CONCAT(cun.nombre, ' ', cun.apellidopaterno, ' ', cun.apellidomaterno) nombrecompleto, ae.cve_cequipo, ce.marca, ce.modelo, ce.numero_serie, ce.descripcion, fecha_asignacion
			FROM asignacion_equipos ae
			INNER JOIN cat_usuario_nomina cun ON ae.codigo_empleado = cun.codigoempleado
			INNER JOIN caracteristicas_equipos ce ON ce.cve_cequipo = ae.cve_cequipo WHERE estatus_asignacion>0";
    $datos = $dbcon->qBuilder($dbcon->conn(), 'all', $sql);
    dd($datos);
}

// me sirve para mostrar en la pantalla de caracteristicas 
// todas las caracteristicas que se han puesto a los equipos
function getVercaracteristicas($dbcon){
	$sql = "SELECT CONCAT('MYS - TIC', ce.cve_cequipo, ' - ', DATE_FORMAT(ce.fecha_ingreso, '%d%m%Y') ) folio, ce.cve_cequipo, nombre_equipo, numero_serie, marca, modelo, ce.descripcion, numero_serie, numero_factura, sistema_operativo, procesador, vel_procesador, memoria_ram, tipo_almacenamiento, capacidad_almacenamiento, fecha_ingreso
			FROM caracteristicas_equipos ce
			INNER JOIN cat_equipos ce2 ON ce.cve_equipo  = ce2.cve_equipo";
    $datos = $dbcon->qBuilder($dbcon->conn(), 'all', $sql);
    dd($datos);
}


// Ahora tienes un array de consultas que puedes utilizar

function guardarAsignacion($dbcon, $Datos){

		$fecha = date('Y-m-d H:i:s');
		$status = '1';
		$conn = $dbcon->conn();
		$sql = "INSERT INTO asignacion_equipos (codigo_empleado, cve_cequipo, estatus_asignacion, fecha_asignacion)
				VALUES (".$Datos->codigo.", ".$Datos->nombre.", ".$status.", '".$fecha."' )";
		$qBuilder = $dbcon->qBuilder($conn, 'do', $sql);

		$sql2=" UPDATE caracteristicas_equipos ce SET ce.estatus_equipo=2
		where ce.cve_cequipo=".$Datos->nombre."";
		$qBuilder = $dbcon->qBuilder($conn, 'do', $sql2);
	
}
// funciones para editar
function eliminarAsignacion($dbcon, $Datos){
	$fecha = date('Y-m-d H:i:s');
	$conn = $dbcon->conn();
	$sql = "UPDATE asignacion_equipos
	SET  estatus_asignacion  =0
	WHERE cve_asignacion =" .$Datos->nombreEliminar." ";
	$qBuilder = $dbcon->qBuilder($dbcon->conn(), 'do', $sql);

	$sql2=" UPDATE caracteristicas_equipos ce SET ce.estatus_equipo=1
		where ce.cve_cequipo=".$Datos->nombreEliminar."";
		$qBuilder = $dbcon->qBuilder($conn, 'do', $sql2);
		// dd($sql);}
	
}

// para traer el codigo del empleado
function getEmpleado ($dbcon){
	$sql = "select codigoempleado, nombre from cat_usuario_nomina  WHERE estadoempleado IN ('A','R') ";
    $datos = $dbcon->qBuilder($dbcon->conn(), 'all', $sql);
    dd($datos);
}
// para traer las caracteristicas del equipo
function getCaracteristicas ($dbcon){
	
	$sql = "SELECT ce.cve_cequipo, CONCAT('MYS - TIC', ces.nombre_equipo, ce.cve_cequipo, ' - ', DATE_FORMAT(ce.fecha_ingreso, '%d%m%Y') ) folio
			FROM caracteristicas_equipos ce
			INNER JOIN cat_equipos ces ON ces.cve_equipo = ce.cve_equipo
			WHERE ce.estatus_equipo = 1 ";
    $datos = $dbcon->qBuilder($dbcon->conn(), 'all', $sql);
    dd($datos);
}
// para traer la marca, modelo y descripción para el modal de asignación
function getMarca($dbcon, $Datos){
	$conn = $dbcon->conn();
	$sql = "	SELECT *
				FROM caracteristicas_equipos ce
				WHERE cve_cequipo = ".$Datos->nombre."  " ;
	$marca = $dbcon->qBuilder($dbcon->conn(), 'all', $sql);
	dd($marca);

	
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
	case 'guardarAsignacion':
		guardarAsignacion($dbcon, $objDatos);
		break;
	case 'eliminarAsignacion':
		eliminarAsignacion($dbcon,$objDatos );
		break;
		
		// los get son para traer informción y que este se muestre

	case 'getEmpleado':
		getEmpleado($dbcon);
		break;
	case 'getCaracteristicas':
		getCaracteristicas($dbcon);
		break;
	// case 'getProducto':
	// 	getProducto($dbcon);
	// 	break;
	case 'getMarca':
		getMarca($dbcon,$objDatos );
		break;
        
	case 'getProduccion':
		getProduccion($dbcon);
		break;
	case 'getVercaracteristicas':
		getVercaracteristicas($dbcon);
		break;
	
		
		
}

?>


