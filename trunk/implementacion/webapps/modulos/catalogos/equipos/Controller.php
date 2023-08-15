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
INNER JOIN caracteristicas_equipos ce ON ce.cve_cequipo = ae.cve_cequipo";
    $datos = $dbcon->qBuilder($dbcon->conn(), 'all', $sql);
    dd($datos);
}

// me sirve para mostrar en la pantalla de caracteristicas 
// todas las caracteristicas que se han puesto a los equipos
function getVercaracteristicas($dbcon){
	$sql = "SELECT ce.cve_cequipo, modelo, marca, numero_serie, numero_factura, sistema_operativo, procesador, vel_procesador,
	memoria_ram, tipo_almacenamiento, capacidad_almacenamiento, fecha_ingreso, ce.cve_equipo, nombre_equipo
	FROM caracteristicas_equipos ce
	INNER JOIN cat_equipos ce2 ON ce.cve_equipo  = ce2.cve_equipo;";
    $datos = $dbcon->qBuilder($dbcon->conn(), 'all', $sql);
    dd($datos);
}

// me sirve para mostrar en la pantalla de equipos 
// todas los equipos que se han puesto guardado
// function getVerEquipos($dbcon){
// 	$sql = "SELECT ce.cve_cequipo, modelo, marca, numero_serie, numero_factura, sistema_operativo, procesador, vel_procesador,
// 	memoria_ram, tipo_almacenamiento, capacidad_almacenamiento, fecha_ingreso, ce.cve_equipo, nombre_equipo
// 	FROM caracteristicas_equipos ce
// 	INNER JOIN cat_equipos ce2 ON ce.cve_equipo  = ce2.cve_equipo;";
//     $datos = $dbcon->qBuilder($dbcon->conn(), 'all', $sql);
//     dd($datos);
// }

// aca comienzan las validaciones, la primera es sobre si se repite el nombre
function agregarSiNoExiste($dbcon, $Datos) {
    $conn = $dbcon->conn();

    // Verificar si ya existe un registro con el mismo nombre
    $sql = "SELECT COUNT(*) AS count FROM cat_equipos WHERE nombre_equipo = '".$Datos->nombre."'";
    $resultado = $dbcon->qBuilder($conn, 'first', $sql);
	
    if ($resultado->count >= 1) {
        dd(['code'=>400,'msj'=>'El equipo no se puede duplicar']);
    }else{
		$fecha = date('Y-m-d H:i:s');
		$status = '1';
		$conn = $dbcon->conn();
		$sql = "INSERT INTO cat_equipos (nombre_equipo, creado_por, estatus_equipo, fecha_registro)
				VALUES ('".$Datos->nombre."', ".$Datos->id.", ".$status.", '".$fecha."' )";
		$qBuilder = $dbcon->qBuilder($conn, 'do', $sql);
	}
}
// validacion para factura y numero de serie
function validacionSerie($dbcon, $Datos) {
    $conn = $dbcon->conn();
	

    // Verificar si ya existe un registro con la misma serie
    $sql = "SELECT COUNT(*) AS count FROM caracteristicas_equipos WHERE numero_serie = '".$Datos->numeroserie."' ";
    $resultado = $dbcon->qBuilder($conn, 'first', $sql);
	
    if ($resultado->count >= 1) {
        dd(['code'=>400,'msj'=>'Un equipo se ha registrado con ese numero de serie']);
    }
	// else{
	// 	$fecha = date('Y-m-d H:i:s');
	// 	$status = '1';
	// 	$conn = $dbcon->conn();
	// 	$sql = "INSERT INTO caracteristicas_equipos (cve_equipo, marca, modelo, descripcion, numero_serie, 
	// 	numero_factura, sistema_operativo, procesador, vel_procesador, memoria_ram, tipo_almacenamiento, capacidad_almacenamiento, 
	// 	creado_por, estatus_equipo, fecha_ingreso)
	// 			VALUES (".$Datos->nombre.", '".$Datos->marca."', '".$Datos->modelo."', 
	// 			'".$Datos->descripcion."', '".$Datos->numeroserie."', '".$Datos->numerofactura."',
	// 			'".$Datos->sistemaoperativo."', '".$Datos->procesador."', ".$Datos->velocidadprocesador.",
	// 			".$Datos->memoriaram.", '".$Datos->tipoalmacenamiento."', ".$Datos->capaalmacenamiento.",
	// 			".$Datos->id.", ".$status.", '".$fecha."')";
				
	// 	$qBuilder = $dbcon->qBuilder($conn, 'do', $sql);
	// }
}
function validacionFactura($dbcon, $Datos) {
    $conn = $dbcon->conn();
	

    // Verificar si ya existe un registro con la misma serie
    $sql = "SELECT COUNT(*) AS count FROM caracteristicas_equipos WHERE numero_factura = '".$Datos->numerofactura."' ";
    $resultado = $dbcon->qBuilder($conn, 'first', $sql);
	
    if ($resultado->count >= 1) {
        dd(['code'=>400,'msj'=>'Ya ha registrado este numero de factura a un equipo']);
    }
	// else{
	// 	$fecha = date('Y-m-d H:i:s');
	// 	$status = '1';
	// 	$conn = $dbcon->conn();
	// 	$sql = "INSERT INTO caracteristicas_equipos (cve_equipo, marca, modelo, descripcion, numero_serie, 
	// 	numero_factura, sistema_operativo, procesador, vel_procesador, memoria_ram, tipo_almacenamiento, capacidad_almacenamiento, 
	// 	creado_por, estatus_equipo, fecha_ingreso)
	// 			VALUES (".$Datos->nombre.", '".$Datos->marca."', '".$Datos->modelo."', 
	// 			'".$Datos->descripcion."', '".$Datos->numeroserie."', '".$Datos->numerofactura."',
	// 			'".$Datos->sistemaoperativo."', '".$Datos->procesador."', ".$Datos->velocidadprocesador.",
	// 			".$Datos->memoriaram.", '".$Datos->tipoalmacenamiento."', ".$Datos->capaalmacenamiento.",
	// 			".$Datos->id.", ".$status.", '".$fecha."')";
				
	// 	$qBuilder = $dbcon->qBuilder($conn, 'do', $sql);
	// }
}




function guardarEquipo($dbcon, $Datos){
	$fecha = date('Y-m-d H:i:s');
	$status = '1';
	$conn = $dbcon->conn();
	$sql = "INSERT INTO cat_equipos (nombre_equipo, creado_por, estatus_equipo, fecha_registro)
			VALUES ('".$Datos->nombre."', ".$Datos->id.", ".$status.", '".$fecha."' )";
	$qBuilder = $dbcon->qBuilder($conn, 'do', $sql);

	if ($qBuilder) {
		$getId = "SELECT max(cve_equipo) cve_equipo FROM cat_equipos WHERE 
		fecha_registro = '".$fecha."'
		AND creado_por = ".$Datos->id."
		AND estatus_equipo =  ".$status."
		AND nombre_equipo = '".$Datos->nombre."' ";
		$getId = $dbcon->qBuilder($conn, 'first', $getId);

		dd(['code'=>200,'msj'=>'Carga ok', 'folio'=>$getId->cve_equipo]);
	}else{
		dd(['code'=>300, 'msj'=>'error al crear folio.', 'sql'=>$sql]);
	}
}

function guardarCaracteristicas($dbcon, $Datos){
	$fecha = date('Y-m-d H:i:s');
	$status = '1';
	$conn = $dbcon->conn();
	if ($Datos->sistemaoperativo==''){
		$Datos->sistemaoperativo=NULL;
	}
	if ($Datos->procesador==''){
		$Datos->procesador=NULL;
	}
	if ($Datos->velocidadprocesador==''){
		$Datos->velocidadprocesador=0;
	}
	if ($Datos->memoriaram==''){
		$Datos->memoriaram=0;
	}
	if ($Datos->tipoalmacenamiento==''){
		$Datos->tipoalmacenamiento=NULL;
	}
	if ($Datos->capaalmacenamiento==''){
		$Datos->capaalmacenamiento=0;
	}
		
	

		$sql = "INSERT INTO caracteristicas_equipos (cve_equipo, marca, modelo, descripcion, numero_serie, 
		numero_factura, sistema_operativo, procesador, vel_procesador, memoria_ram, tipo_almacenamiento, capacidad_almacenamiento, 
		creado_por, estatus_equipo, fecha_ingreso)
				VALUES (".$Datos->nombre.", '".$Datos->marca."', '".$Datos->modelo."', 
				'".$Datos->descripcion."', '".$Datos->numeroserie."', '".$Datos->numerofactura."',
				'".$Datos->sistemaoperativo."', '".$Datos->procesador."', ".$Datos->velocidadprocesador.",
				".$Datos->memoriaram.", '".$Datos->tipoalmacenamiento."', ".$Datos->capaalmacenamiento.",
				".$Datos->id.", ".$status.", '".$fecha."')";
				
		$qBuilder = $dbcon->qBuilder($conn, 'do', $sql);
		// dd($sql);

		if ($qBuilder) {
			$getId = "SELECT max(cve_cequipo) as cve_cequipo FROM caracteristicas_equipos WHERE 
			fecha_ingreso = '".$fecha."'
			AND creado_por = ".$Datos->id."
			AND estatus_equipo =  ".$status."
			AND cve_equipo=".$Datos->nombre."
			AND marca = '".$Datos->marca."'
			AND modelo = '".$Datos->modelo."'
			AND descripcion = '".$Datos->descripcion."'
			AND numero_serie = '".$Datos->numeroserie."'
			AND numero_factura = '".$Datos->numerofactura."'
			AND sistema_operativo = '".$Datos->sistemaoperativo."'
			AND procesador = '".$Datos->procesador."'
			AND vel_procesador = ".$Datos->velocidadprocesador."
			AND memoria_ram = ".$Datos->memoriaram."
			AND tipo_almacenamiento = '".$Datos->tipoalmacenamiento."'
			AND capacidad_almacenamiento = ".$Datos->capaalmacenamiento." ";
			
			$getId = $dbcon->qBuilder($conn, 'first', $getId);

			dd(['code'=>200,'msj'=>'Carga ok', 'Equipo'=>$getId->cve_cequipo]);
		}else{
			dd(['code'=>300, 'msj'=>'error al crear folio.', 'sql'=>$sql]);
		}
}

function guardarAsignacion($dbcon, $Datos){
	$conn = $dbcon->conn();
	$sql = "SELECT COUNT(*) AS count FROM asignacion_equipos WHERE cve_cequipo = ".$Datos->nombre." ";
    $resultado = $dbcon->qBuilder($conn, 'first', $sql);
	
    if ($resultado->count >= 1) {
        dd(['code'=>400,'msj'=>'Este equipo ya esta asignado a un empleado']);
    }else{
		$fecha = date('Y-m-d H:i:s');
		$status = '1';
		$conn = $dbcon->conn();
		$sql = "INSERT INTO asignacion_equipos (codigo_empleado, cve_cequipo, estatus_asignacion, fecha_asignacion)
				VALUES (".$Datos->codigo.", ".$Datos->nombre.", ".$status.", '".$fecha."' )";
		$qBuilder = $dbcon->qBuilder($conn, 'do', $sql);
	}
}

// funciones para editar
// editar el nombre y la descripción
function editarNombre($dbcon, $Datos){
	$fecha = date('Y-m-d H:i:s');
	$conn = $dbcon->conn();

	$sql = " UPDATE cat_equipos
	SET  nombre_equipo  ='".$Datos->nombre."', descripcion  ='".$Datos->descripcion."'
	WHERE cve_equipo =" .$Datos->numero."";
	$qBuilder = $dbcon->qBuilder($dbcon->conn(), 'do', $sql);
	// dd($sql);
}

function editarCaracteristica($dbcon, $Datos){
	$fecha = date('Y-m-d H:i:s');
	$conn = $dbcon->conn();

	
	$sql = " UPDATE caracteristicas_equipos
	SET  marca  ='".$Datos->marca."', modelo  ='".$Datos->modelo."', numero_serie  ='".$Datos->numeroserie."',
	 numero_factura  ='".$Datos->numerofactura."', sistema_operativo  ='".$Datos->sistemaoperativo."', procesador  ='".$Datos->procesador."', 
	 vel_procesador  =".$Datos->velocidadprocesador.",  memoria_ram  =".$Datos->memoriaram.", 
	tipo_almacenamiento  ='".$Datos->tipoalmacenamiento."', capacidad_almacenamiento  =".$Datos->capaalmacenamiento."
	WHERE cve_cequipo =" .$Datos->numeroEquipo."";
	$qBuilder = $dbcon->qBuilder($dbcon->conn(), 'do', $sql);
	// dd($sql);
}

function editarAsignacion($dbcon, $Datos){
	$fecha = date('Y-m-d H:i:s');
	$conn = $dbcon->conn();

	$sql = " UPDATE asignacion_equipos
	SET  cve_cequipo  =".$Datos->nombre."
	WHERE cve_asignacion =" .$Datos->numeroAsignacion."";
	$qBuilder = $dbcon->qBuilder($dbcon->conn(), 'do', $sql);
	// dd($sql);
}






// para traer el codigo del equipo que se agrego
function getEquipos ($dbcon){
	$sql = "select *  from cat_equipos   ";
    $datos = $dbcon->qBuilder($dbcon->conn(), 'all', $sql);
    dd($datos);
}


// para traer el codigo del empleado
function getEmpleado ($dbcon){
	$sql = "select codigoempleado, nombre from cat_usuario_nomina  ";
    $datos = $dbcon->qBuilder($dbcon->conn(), 'all', $sql);
    dd($datos);
}
// para traer las caracteristicas del equipo
function getCaracteristicas ($dbcon){
	$sql = "select cve_cequipo, marca, modelo, numero_serie from caracteristicas_equipos  ";
    $datos = $dbcon->qBuilder($dbcon->conn(), 'all', $sql);
    dd($datos);
}

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
	case 'guardarEquipo':
		guardarEquipo($dbcon, $objDatos);
		break;
	case 'guardarCaracteristicas':
		guardarCaracteristicas($dbcon, $objDatos);
		break;
	case 'guardarAsignacion':
		guardarAsignacion($dbcon, $objDatos);
		break;
	case 'editarNombre':
		editarNombre($dbcon, $objDatos);
		break;
	case 'editarCaracteristica':
		editarCaracteristica($dbcon, $objDatos);
		break;
	case 'editarAsignacion':
		editarAsignacion($dbcon,$objDatos );
		break;
		// los get son para traer informción y que este se muestre
	case 'getEquipos':
		getEquipos($dbcon, );
		break;
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
		// para las validaciones
	case 'agregarSiNoExiste':
		agregarSiNoExiste($dbcon,$objDatos);
		break;
	case 'validacionSerie':
		validacionSerie($dbcon,$objDatos);
		break;
	case 'validacionFactura':
		validacionFactura($dbcon,$objDatos);
	break;
	// case 'validacionEquipo':
	// 	validacionEquipo($dbcon,$objDatos);
	// break;
	
		
		
}







?>


