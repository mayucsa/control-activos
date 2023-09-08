<?php
date_default_timezone_set('America/Chihuahua');
function dd($var){
    if (is_array($var) || is_object($var)) {
        die(json_encode($var));
    }else{
        die($var);
    }
}

function guardarServicio($dbcon, $Datos){
    $fecha = date('Y-m-d H:i:s');
    $status = '1';
    $conn = $dbcon->conn();
    if ($Datos->caracteristica==''){
		$Datos->caracteristica=NULL;
	}
    $sql = "INSERT INTO cat_servicios (nombre_servicio, descripcion, creado_por, estatus_servicio, fecha_registro)
            VALUES ('".$Datos->servicioEntrada."', '".$Datos->caracteristica."', ".$Datos->id.", ".$status.", '".$fecha."' )";
    $qBuilder = $dbcon->qBuilder($conn, 'do', $sql);
    if ($qBuilder) {
		$getId = "SELECT max(cve_servicio) cve_servicio FROM cat_servicios WHERE 
		fecha_registro = '".$fecha."'
		AND creado_por = ".$Datos->id."
		AND estatus_servicio =  ".$status."
		AND descripcion = '".$Datos->caracteristica."'
		AND nombre_servicio = '".$Datos->servicioEntrada."' ";
		$getId = $dbcon->qBuilder($conn, 'first', $getId);

		dd(['code'=>200,'msj'=>'Carga ok', 'folio'=>$getId->cve_servicio]);
	}else{
		dd(['code'=>300, 'msj'=>'error al crear folio.', 'sql'=>$sql]);
}

    // $sql2=" UPDATE caracteristicas_equipos ce SET ce.estatus_equipo=2
    // where ce.cve_cequipo=".$Datos->nombre."";
    // $qBuilder = $dbcon->qBuilder($conn, 'do', $sql2);

}
function validacionServicio($dbcon, $Datos) {
    $conn = $dbcon->conn();
	

    // Verificar si ya existe un registro con la misma serie
    $sql = "SELECT COUNT(*) AS count FROM cat_servicios WHERE nombre_servicio = '".$Datos->servicio."' ";
    $resultado = $dbcon->qBuilder($conn, 'first', $sql);
	
    if ($resultado->count >= 1) {
        dd(['code'=>400,'msj'=>'Un equipo se ha registrado con ese numero de serie']);
    }
	
}
// trae los datos de los servicios que se guardaron
function getServicio($dbcon){
	$conn = $dbcon->conn();
	$sql = "	SELECT *
				FROM cat_servicios";
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
	case 'guardarServicio':
		guardarServicio($dbcon, $objDatos);
		break;
	case 'validacionServicio':
		validacionServicio($dbcon,$objDatos );
		break;	
    case 'getServicio':
        getServicio($dbcon );
        break;
        // esto es una prueba
}

?>