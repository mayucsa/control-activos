<?php
date_default_timezone_set('America/Chihuahua');
function dd($var){
    if (is_array($var) || is_object($var)) {
        die(json_encode($var));
    }else{
        die($var);
    }
}
function ValidaExistencia($dbcon, $Datos) {
    $conn = $dbcon->conn();

    // Verificar si ya existe un registro con el mismo nombre
    $sql = "SELECT COUNT(*) AS count FROM cat_equipos WHERE nombre_equipo = '".$Datos->nombre."'";
    $resultado = $dbcon->qBuilder($conn, 'first', $sql);
	
    if ($resultado->count >= 1) {
        dd(['code'=>400,'msj'=>'El equipo no se puede duplicar']);
    }
}
// aqui comienzan las funciones de guardar
function guardarEquipo($dbcon, $Datos){
// if($Datos->nombre==""){ dd(['code'=>400,'msj'=>'El equipo no se pudo guardar']);}

// Verificar si ya existe un registro con el mismo nombre
// $sql = "SELECT COUNT(*) AS count FROM cat_equipos WHERE nombre_equipo = '".$Datos->nombre."'";
// $resultado = $dbcon->qBuilder($conn, 'first', $sql);

// if ($resultado->count >= 1) {
//     dd(['code'=>400,'msj'=>'El equipo no se puede duplicar']);
// }else{
	$fecha = date('Y-m-d H:i:s');
	$status = '1';
	$conn = $dbcon->conn();
	$sql = "INSERT INTO cat_equipos (nombre_equipo, tipo, creado_por, estatus_equipo, fecha_registro)
			VALUES ('".$Datos->nombre."', '".$Datos->checkh."', ".$Datos->id.", ".$status.", '".$fecha."' )";
	$qBuilder = $dbcon->qBuilder($conn, 'do', $sql);
	if ($qBuilder) {
		$getId = "SELECT max(cve_equipo) cve_equipo FROM cat_equipos WHERE 
		fecha_registro = '".$fecha."'
		AND creado_por = ".$Datos->id."
		AND estatus_equipo =  ".$status."
		AND tipo = '".$Datos->checkh."'
		AND nombre_equipo = '".$Datos->nombre."' ";
		$getId = $dbcon->qBuilder($conn, 'first', $getId);

		dd(['code'=>200,'msj'=>'Carga ok', 'folio'=>$getId->cve_equipo]);
	}else{
		dd(['code'=>300, 'msj'=>'error al crear folio.', 'sql'=>$sql]);
}
// $fecha = date('Y-m-d H:i:s');
// $status = '1';
// $conn = $dbcon->conn();
// $sql = "INSERT INTO cat_equipos (nombre_equipo, creado_por, estatus_equipo, fecha_registro)
// 		VALUES ('".$Datos->nombre."', ".$Datos->id.", ".$status.", '".$fecha."' )";
$qBuilder = $dbcon->qBuilder($conn, 'do', $sql);


// }
}

function editarNombre($dbcon, $Datos){
	$conn = $dbcon->conn();

    // Verificar si ya existe un registro con el mismo nombre
    $sql = "SELECT COUNT(*) AS count FROM cat_equipos WHERE nombre_equipo = '".$Datos->nombre."'";
    $resultado = $dbcon->qBuilder($conn, 'first', $sql);
	
    if ($resultado->count > 1) {
        dd(['code'=>400,'msj'=>'El equipo no se puede duplicar']);
    }
	// else if($resultado->count == 1){
	// 	$fecha = date('Y-m-d H:i:s');
	// 	$status = '1';
	// 	$conn = $dbcon->conn();
	// 	$sql = " UPDATE cat_equipos
	// SET  descripcion  ='".$Datos->descripcion."'
	// WHERE cve_equipo =" .$Datos->numero."";
	// $qBuilder = $dbcon->qBuilder($dbcon->conn(), 'do', $sql);
	// }
	else{
		$fecha = date('Y-m-d H:i:s');
		$status = '1';
		$conn = $dbcon->conn();
		$sql = " UPDATE cat_equipos
	SET  nombre_equipo  ='".$Datos->nombre."'
	WHERE cve_equipo =" .$Datos->numero."";
	$qBuilder = $dbcon->qBuilder($dbcon->conn(), 'do', $sql);
	}


	
	// dd($sql);
}
// para traer el codigo del equipo que se agrego 
function getEquipos ($dbcon){
	$sql = "select *  from cat_equipos   ";
    $datos = $dbcon->qBuilder($dbcon->conn(), 'all', $sql);
    dd($datos);
}

function ValidaQueEquipoEs($dbcon, $Datos){
	$conn = $dbcon->conn();

    $sql = "SELECT nombre_equipo FROM cat_equipos WHERE cve_equipo = ".$Datos->cve_equipo." ";
    $resultado = $dbcon->qBuilder($conn, 'first', $sql);

    if ($resultado->nombre_equipo == 'CPU' || $resultado->nombre_equipo == 'LAPTOP') {
    	dd(['code'=>400]);
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
	case 'guardarEquipo':
		guardarEquipo($dbcon, $objDatos);
		break;

	case 'editarNombre':
		editarNombre($dbcon, $objDatos);
		break;
		
		// los get son para traer informción y que este se muestre
	case 'getEquipos':
		getEquipos($dbcon, );
		break;
		// para las validaciones

		// ya se agregó la misma función en otro controlador
	case 'ValidaExistencia':
		ValidaExistencia($dbcon,$objDatos);
		break;
	case 'ValidaQueEquipoEs':
		ValidaQueEquipoEs($dbcon,$objDatos);
	break;
	// case 'validacionEquipo':
	// 	validacionEquipo($dbcon,$objDatos);
	// break;
	
		
		
}







?>


