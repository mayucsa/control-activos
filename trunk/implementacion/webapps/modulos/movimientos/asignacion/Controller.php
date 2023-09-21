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
	$sql = "INSERT INTO asignacion_equipo (codigoempleado, estatus_asignacion, fecha_asignacion)
			VALUES (".$Datos->codigoempleado.", ".$status.", '".$fecha."' )";
	$qBuilder = $dbcon->qBuilder($conn, 'do', $sql);

	if($qBuilder){
		$getIdQuery = "SELECT max(cve_asignacion) as cve_asignacion FROM asignacion_equipo WHERE
			fecha_asignacion='".$fecha."'
			AND codigoempleado= ".$Datos->codigoempleado."
			AND estatus_asignacion= ".$status."";

		$getIdResult = $dbcon->qBuilder($conn, 'first', $getIdQuery);

		if ($getIdResult && isset($getIdResult->cve_asignacion)) {
			foreach ($Datos->arrayEquipoGuardado as $i => $equipo) {
				$sqlDetalle = "INSERT INTO asignacion_equipo_detalle (cve_asignacion, cve_cequipo, asignado_por, fecha_asignacion)
					VALUES (".$getIdResult->cve_asignacion.", ".$equipo.", ".$Datos->id.", '".$fecha."' )";
				$qBuilderDetalle = $dbcon->qBuilder($conn, 'do', $sqlDetalle);

				if(!$qBuilderDetalle){
					dd(['code'=>300,'msj'=>'Error al crear equipo', 'query'=>$sqlDetalle]);
				}

				// Actualizar la tabla caracteristicas_equipos para establecer estatus_equipo=2
				$sql2 = "UPDATE caracteristicas_equipos ce SET ce.estatus_equipo=2
						WHERE ce.cve_cequipo=".$equipo;
				$qBuilder2 = $dbcon->qBuilder($conn, 'do', $sql2);

				if(!$qBuilder2){
					dd(['code'=>300,'msj'=>'Error al actualizar equipo', 'query'=>$sql2]);
				}
			}
			dd(['code'=>200,'msj'=>'Carga ok', 'folio'=>$getIdResult->cve_asignacion]);
		} else {
			dd(['code'=>300,'msj'=>'Error al obtener cve_asignacion', 'getIdQuery'=>$getIdQuery]);
		}
	} else {
		dd(['code'=>300, 'msj'=>'error al crear folio.', 'sql'=>$sql]);
	}

	// $fecha = date('Y-m-d H:i:s');
	// $status = '1';
	// $conn = $dbcon->conn();
	// $sql = "INSERT INTO asignacion_equipo (codigoempleado, estatus_asignacion, fecha_asignacion)
	// 		VALUES (".$Datos->codigoempleado.", ".$status.", '".$fecha."' )";
	// $qBuilder = $dbcon->qBuilder($conn, 'do', $sql);

	// if($qBuilder){
	// 	$getIdQuery = "SELECT max(cve_asignacion) as cve_asignacion FROM asignacion_equipo WHERE
	// 		fecha_asignacion='".$fecha."'
	// 		AND codigoempleado= ".$Datos->codigoempleado."
	// 		AND estatus_asignacion= ".$status."";

	// 	$getIdResult = $dbcon->qBuilder($conn, 'first', $getIdQuery);

	// 	if ($getIdResult && isset($getIdResult->cve_asignacion)) {
	// 		foreach ($Datos->arrayEquipoGuardado as $i => $equipo) {
	// 			$sqlDetalle = "INSERT INTO asignacion_equipo_detalle (cve_asignacion, cve_equipo, asignado_por, fecha_asignacion)
	// 				VALUES (".$getIdResult->cve_asignacion.", ".$equipo.",".$Datos->id.", '".$fecha."' )";
	// 			$qBuilderDetalle = $dbcon->qBuilder($conn, 'do', $sql);
	// 			if(!$qBuilderDetalle){
	// 				dd(['code'=>300,'msj'=>'Error al crear equipo', 'query'=>$sql]);
	// 			}
				
	// 			$sql2=" UPDATE caracteristicas_equipos ce SET ce.estatus_equipo=2
	// 			where ce.cve_cequipo=".$equipo."";
	// 			$qBuilder2 = $dbcon->qBuilder($conn, 'do', $sql2);
	// 			if(!$qBuilder2){
	// 				dd(['code'=>300,'msj'=>'Error al crear equipo', 'query'=>$sql2]);
	// 			}

	// 			// Agrega una comprobación para verificar si la consulta se ejecuta correctamente
	// 			dd(['code'=>200,'msj'=>'Carga ok', 'folio'=>$getIdResult->cve_asignacion]);
	// 		}
	// 		dd(['code'=>200,'msj'=>'Carga ok', 'folio'=>$getIdResult->cve_asignacion]);
	// 	} else {
	// 		dd(['code'=>300,'msj'=>'Error al obtener cve_asignacion', 'getIdQuery'=>$getIdQuery]);
	// 	}
	// } else {
	// 	dd(['code'=>300, 'msj'=>'error al crear folio.', 'sql'=>$sql]);
	// }

	// foreach($Datos->arrayEquipoGuardado as $estados) {
	// 	$sql2=" UPDATE caracteristicas_equipos ce SET ce.estatus_equipo=2
	// 	where cve_cequipo=".$estados."";
	// 	$qBuilder = $dbcon->qBuilder($conn, 'do', $sql2);
	// }
	
	


		// // $Equipos=[];
		// $fecha = date('Y-m-d H:i:s');
		// $status = '1';
		// $conn = $dbcon->conn();
		// $sql = "INSERT INTO asignacion_equipo (codigoempleado, estatus_asignacion, fecha_asignacion)
		// 		VALUES (".$Datos->codigoempleado.", ".$status.", '".$fecha."' )";
		// $qBuilder = $dbcon->qBuilder($conn, 'do', $sql);

		

		// if($qBuilder){
		// $getId = "SELECT max (cve_asignacion) cve_asignacion FROM asignacion_equipo WHERE
		// 	fecha_asignacion='".$fecha."'
		// 	AND codigoempleado= ".$Datos->codigoempleado."
		// 	AND estatus_asignacion= ".$status."";

		// 	$getId= $dbcon->qBuilder($conn, 'first', $getId);
		// 	foreach ($Datos->arrayEquipoGuardado as $i=>$equipo) {
		// 		$sql = "INSERT INTO asignacion_equipo_detalle (cve_asignacion, cve_equipo, asignado_por, fecha_asignacion)
		// 			VALUES (".$getId->cve_asignacion.", ".$equipo.",".$Datos->id.", '".$fecha."' )";
		// 		$qBuilder = $dbcon->qBuilder($conn, 'do', $sql);
		// 		if(!$qBuilder){
		// 			dd(['code'=>300,'msj'=>'Error al crear equipo', $getId->cve_asignacion]);
		// 		}
	
				
		// 	}
		// 	dd(['code'=>200,'msj'=>'Carga ok', 'folio'=>$getId->cve_asignacion]);
		// }
		// else{
		// 	dd(['code'=>300, 'msj'=>'error al crear folio.', 'sql'=>$sql]);
		// }

	
		
	
	
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
	
	$sql = "SELECT ce.cve_cequipo, marca, modelo, descripcion, numero_serie, 
	numero_factura, sistema_operativo, procesador, vel_procesador, memoria_ram, tipo_almacenamiento, capacidad_almacenamiento, 
	CONCAT('MYS - TIC', ces.nombre_equipo, ce.cve_cequipo, ' - ', DATE_FORMAT(ce.fecha_ingreso, '%d%m%Y') ) folio, nombre_equipo, marca, modelo 
	FROM caracteristicas_equipos ce
	INNER JOIN cat_equipos ces ON ces.cve_equipo = ce.cve_equipo
	WHERE ce.estatus_equipo = 1 ; ";
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


