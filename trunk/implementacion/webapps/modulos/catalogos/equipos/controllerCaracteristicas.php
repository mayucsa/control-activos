<?php 
// date_default_timezone_set('America/Chihuahua');
// function dd($var){
//     if (is_array($var) || is_object($var)) {
//         die(json_encode($var));
//     }else{
//         die($var);
//     }
// }

// function guardarCaracteristicas($dbcon, $Datos){
//     $fecha = date('Y-m-d H:i:s');
// 	$status = '1';
// 	$conn = $dbcon->conn();
// 	$sql = "INSERT INTO caracteristicas_equipos (marca, modelo, numero_serie, numero_factura, creado_por, estatus_equipo, fecha_registro)
// 			VALUES ('".$Datos->nombre."', ".$Datos->id.", ".$status.", '".$fecha."' )";
// 	$qBuilder = $dbcon->qBuilder($conn, 'do', $sql);

// 	if ($qBuilder) {
// 		$getId = "SELECT max(cve_equipo) cve_equipo FROM cat_equipos WHERE 
// 		fecha_registro = '".$fecha."'
// 		AND creado_por = ".$Datos->id."
// 		AND estatus_equipo =  ".$status."
// 		AND nombre_equipo = '".$Datos->nombre."' ";
// 		$getId = $dbcon->qBuilder($conn, 'first', $getId);

// 		dd(['code'=>200,'msj'=>'Carga ok', 'folio'=>$getId->cve_equipo]);
// 	}else{
// 		dd(['code'=>300, 'msj'=>'error al crear folio.', 'sql'=>$sql]);
// 	}
// }

// include_once "../../../dbconexion/conn.php";
// $dbcon	= 	new MysqlConn;
// $conn 	= 	$dbcon->conn();
// // inicio
// $tarea = isset($_REQUEST['task']) ? $_REQUEST['task'] : '';
// if ($tarea == '') {
// 	// en caso de que el llamado al controlador haya sido por http post y no por formulario
// 	$objDatos = json_decode(file_get_contents("php://input"));
// 	$tarea = $objDatos->task;
// }
// switch ($tarea) {
// 	case 'guardarEquipo':
// 		guardarEquipo($dbcon, $objDatos);
// 		break;
// }


?> 