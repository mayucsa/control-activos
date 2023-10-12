<?php
date_default_timezone_set('America/Chihuahua');
function dd($var){
    if (is_array($var) || is_object($var)) {
        die(json_encode($var));
    }else{
        die($var);
    }
}
// valida si existe el nombre en la base de datos
function ValidaExistencia($dbcon, $Datos) {
    $conn = $dbcon->conn();

    // Verificar si ya existe un registro con el mismo nombre
    $sql = "SELECT COUNT(*) AS count FROM grupos_usuarios WHERE estatus_grupo = 1 AND nombre_gpo = '".$Datos->nombreGrupo."'";
    $resultado = $dbcon->qBuilder($conn, 'first', $sql);
	
    if ($resultado->count >= 1) {
        dd(['code'=>400,'msj'=>'Actualmente existe un grupo con el mismo nombre']);
    }
}
// trae a los grupos ya creados
function getGrupos ($dbcon){
	$sql = "SELECT * FROM grupos_usuarios gu WHERE estatus_grupo = 1 ";
    $datos = $dbcon->qBuilder($dbcon->conn(), 'all', $sql);
    dd($datos);
}

// trae a los usuarios que estan dentro de los grupos
function getGruposDetalle ($dbcon, $cve_grupo){
	$sql = "SELECT gud.cve_gpo_detalle, gud.cve_grupo, gud.numeroempleado, CONCAT(cun.nombre, ' ', cun.apellidopaterno, ' ', cun.apellidomaterno)empleado
			FROM grupos_usuarios_detalle gud
			INNER JOIN cat_usuario_nomina cun ON gud.numeroempleado = cun.codigoempleado
			WHERE estatus_gpo_detalle = 1 AND cve_grupo = ".$cve_grupo." ";
    $datos = $dbcon->qBuilder($dbcon->conn(), 'all', $sql);
    dd($datos);
}
function quitarEmpleado ($dbcon, $Datos){
	$fecha = date('Y-m-d H:i:s');
	$status = '0';
	$sql = " UPDATE grupos_usuarios_detalle SET estatus_gpo_detalle = ".$status.", desasignado_por = ".$Datos->id.", fecha_desasignacion = '".$fecha."' WHERE cve_gpo_detalle = ".$Datos->cve." ";
    $datos = $dbcon->qBuilder($dbcon->conn(), 'do', $sql);
    // dd($datos);
}
function validaExistenciaEmpleados ($dbcon, $Datos){
	$fecha = date('Y-m-d H:i:s');
	$status = '0';
	$sql = "SELECT COUNT(cve_gpo_detalle)count  FROM grupos_usuarios_detalle gud WHERE estatus_gpo_detalle = 1 AND cve_grupo = ".$Datos->cve." ";
    $datosc = $dbcon->qBuilder($dbcon->conn(), 'first', $sql);
    // dd($consulta);
    if ($datosc->count > 0) {
    	dd(['code'=>200,'msj'=>'Carga ok']);
    }
}
function eliminarGrupo ($dbcon, $Datos){
	$fecha = date('Y-m-d H:i:s');
	$status = '0';
	$sql = "UPDATE grupos_usuarios SET estatus_grupo = ".$status.", eliminado_por = ".$Datos->id.", fecha_eliminado = '".$fecha."' WHERE cve_grupo = ".$Datos->cve." ";
    $datoc = $dbcon->qBuilder($dbcon->conn(), 'do', $sql);
    // dd($consulta);
    $sqldetalle = "UPDATE grupos_usuarios_detalle SET estatus_gpo_detalle = ".$status.", desasignado_por = ".$Datos->id.", fecha_desasignacion = '".$fecha."' WHERE cve_grupo = ".$Datos->cve." ";
    $datod = $dbcon->qBuilder($dbcon->conn(), 'do', $sqldetalle);
}

// trae a los empleados para que podamos escoger 
function getEmpleadoGrupos ($dbcon){
	$sql = "select codigoempleado,CONCAT(nombre,' ',apellidopaterno,' ', apellidomaterno) nombreC, 
    departamento  from cat_usuario_nomina  WHERE estadoempleado IN ('A','R') ";
    $datos = $dbcon->qBuilder($dbcon->conn(), 'all', $sql);
    dd($datos);
}

// $stmt->close();
function guardarGrupos($dbcon, $Datos){
	$fecha = date('Y-m-d H:i:s');
	$status = '1';
	$conn = $dbcon->conn();

	$sql = "INSERT INTO grupos_usuarios (nombre_gpo, descripcion, estatus_grupo, creado_por, fecha_registro)
   			 VALUES ('".$Datos->nombreGrupo."','".$Datos->descripcion."', ".$status.", ".$Datos->id.", '".$fecha."' )";
	$qBuilder = $dbcon->qBuilder($conn, 'do', $sql);
	// dd($sql);
    // dd($Datos);
	
	if($qBuilder){
		$getIdQuery = "SELECT max(cve_grupo) cve_grupo FROM grupos_usuarios WHERE
			fecha_registro='".$fecha."'
			AND nombre_gpo= '".$Datos->nombreGrupo."'
			AND estatus_grupo= ".$status."";

		$getIdResult = $dbcon->qBuilder($conn, 'first', $getIdQuery);
		// dd(['code'=>200,'msj'=>'Carga ok', 'folio'=>$getIdQuery]);
		// if ($getIdResult && isset($getIdResult->cve_grupo)) {
			foreach ($Datos->empleadosCodigo as $i => $equipo) {
				$sqlDetalle = "	INSERT INTO grupos_usuarios_detalle (cve_grupo, numeroempleado, asignado_por, estatus_gpo_detalle, fecha_asignacion) 
								VALUES (".$getIdResult->cve_grupo.", ".$equipo->codigoempleado.", ".$Datos->id.", ".$status.", '".$fecha."' ) ";
				$qBuilderDetalle = $dbcon->qBuilder($conn, 'do', $sqlDetalle);
				// dd($sqlDetalle);
			}
			dd(['code'=>200,'msj'=>'Carga ok', 'folio'=>$getIdResult->cve_grupo, 'nombre'=>$Datos->nombreGrupo]);
		// 		$sqlDetalle = "INSERT INTO grupos_usuarios_detalle (cve_grupo, numeroempleado, asignado_por, estatus_gpo_detalle, fecha_asignacion)
		// 			VALUES (".$getIdResult->cve_grupo.", ".$equipo.", ".$Datos->id.", ".$status.", '".$fecha."' )";
		// 		$qBuilderDetalle = $dbcon->qBuilder($conn, 'do', $sqlDetalle);
		// 		// dd($sqlDetalle);
                

		// 		if(!$qBuilderDetalle){
		// 			dd(['code'=>300,'msj'=>'Error al crear equipo', 'query'=>$sqlDetalle]);
		// 		}

		// 		// Actualizar la tabla caracteristicas_equipos para establecer estatus_equipo=2
		// 		// $sql2 = "UPDATE caracteristicas_equipos ce SET ce.estatus_equipo=2
		// 		// 		WHERE ce.cve_cequipo=".$equipo;
		// 		// $qBuilder2 = $dbcon->qBuilder($conn, 'do', $sql2);

		// 		// if(!$qBuilder2){
		// 		// 	dd(['code'=>300,'msj'=>'Error al actualizar equipo', 'query'=>$sql2]);
		// 		// }
		// 	}

		// 	dd(['code'=>200,'msj'=>'Carga ok', 'folio'=>$getIdResult->cve_grupo]);
		// } else {
		// 	dd(['code'=>300,'msj'=>'Error al obtener cve_grupo', 'getIdQuery'=>$getIdQuery]);
		// }
	}
    if (!$qBuilder) {
        die("Error en la consulta: " . mysqli_error($conn));
    } else {
		dd(['code'=>300, 'msj'=>'error al crear folio.', 'sql'=>$sql]);
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
    case 'guardarGrupos':
        guardarGrupos($dbcon, $objDatos);
        break;
	case 'getGrupos': 
		getGrupos($dbcon);
		break;
	case 'getGruposDetalle': 
		getGruposDetalle($dbcon, $objDatos->cve_grupo);
		break;
	case 'quitarEmpleado': 
		quitarEmpleado($dbcon, $objDatos);
		break;
	case 'validaExistenciaEmpleados': 
		validaExistenciaEmpleados($dbcon, $objDatos);
		break;
	case 'eliminarGrupo': 
		eliminarGrupo($dbcon, $objDatos);
		break;
	case 'getEmpleadoGrupos': 
		getEmpleadoGrupos($dbcon);
		break;
	case 'ValidaExistencia': 
	ValidaExistencia($dbcon, $objDatos);
	break;
		
        

}

?>