<?php
date_default_timezone_set('America/Chihuahua');
function dd($var){
    if (is_array($var) || is_object($var)) {
        die(json_encode($var));
    }else{
        die($var);
    }
}
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

	if($qBuilder){
		$getIdQuery = "SELECT max(cve_grupo) as cve_grupo FROM grupos_usuarios WHERE
			fecha_registro='".$fecha."'
			AND nombre_gpo= '".$Datos->nombreGrupo."'
			AND estatus_grupo= ".$status."";

		$getIdResult = $dbcon->qBuilder($conn, 'first', $getIdQuery);

		if ($getIdResult && isset($getIdResult->cve_grupo)) {
			foreach ($Datos->empleadosCodigo as $i => $equipo) {
				$sqlDetalle = "INSERT INTO grupos_usuarios_detalle (cve_grupo, numeroempleado, asignado_por, estatus_gpo_detalle, fecha_asignacion)
					VALUES (".$getIdResult->cve_grupo.", ".$equipo.", ".$Datos->id.", ".$status.", '".$fecha."' )";
				$qBuilderDetalle = $dbcon->qBuilder($conn, 'do', $sqlDetalle);

				if(!$qBuilderDetalle){
					dd(['code'=>300,'msj'=>'Error al crear equipo', 'query'=>$sqlDetalle]);
				}

				// Actualizar la tabla caracteristicas_equipos para establecer estatus_equipo=2
				// $sql2 = "UPDATE caracteristicas_equipos ce SET ce.estatus_equipo=2
				// 		WHERE ce.cve_cequipo=".$equipo;
				// $qBuilder2 = $dbcon->qBuilder($conn, 'do', $sql2);

				// if(!$qBuilder2){
				// 	dd(['code'=>300,'msj'=>'Error al actualizar equipo', 'query'=>$sql2]);
				// }
			}
			dd(['code'=>200,'msj'=>'Carga ok', 'folio'=>$getIdResult->cve_grupo]);
		} else {
			dd(['code'=>300,'msj'=>'Error al obtener cve_grupo', 'getIdQuery'=>$getIdQuery]);
		}
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
	case 'getEmpleadoGrupos': 
		getEmpleadoGrupos($dbcon);
		break;

}

?>