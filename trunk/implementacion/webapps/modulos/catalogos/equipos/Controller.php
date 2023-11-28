<?php
date_default_timezone_set('America/Chihuahua');
function dd($var){
    if (is_array($var) || is_object($var)) {
        die(json_encode($var));
    }else{
        die($var);
    }
}



// me sirve para mostrar en la pantalla de caracteristicas 
// todas las caracteristicas que se han puesto a los equipos
function getVercaracteristicas($dbcon){
	$sql = "SELECT CONCAT('MYS - TIC', ce.cve_cequipo, ' - ', DATE_FORMAT(ce.fecha_ingreso, '%d%m%Y') ) folio, ce.cve_cequipo, nombre_equipo, numero_serie, marca, modelo, ce.descripcion, numero_serie, cve_proveedor, numero_factura, fecha_factura, sistema_operativo, procesador, vel_procesador, memoria_ram, tipo_almacenamiento, capacidad_almacenamiento, fecha_ingreso
			FROM caracteristicas_equipos ce
			INNER JOIN cat_equipos ce2 ON ce.cve_equipo  = ce2.cve_equipo";
    $datos = $dbcon->qBuilder($dbcon->conn(), 'all', $sql);
    dd($datos);
}
// este trae a los equipos de la base de datos
function getEquipos ($dbcon){
	$sql = "select *  from cat_equipos   ";
    $datos = $dbcon->qBuilder($dbcon->conn(), 'all', $sql);
    dd($datos);
}
// trae a los proveedores
function getProveedor ($dbcon){
	$sql = "SELECT * from cat_proveedores cp  ";
    $datos = $dbcon->qBuilder($dbcon->conn(), 'all', $sql);
    dd($datos);
}
function ValidaQueEquipoEs($dbcon, $Datos){
	$conn = $dbcon->conn();

    $sql = "SELECT nombre_equipo FROM cat_equipos WHERE cve_equipo = ".$Datos->cve_equipo." ";
    $resultado = $dbcon->qBuilder($conn, 'first', $sql);

    if ($resultado->nombre_equipo == 'CPU' || $resultado->nombre_equipo == 'LAPTOP'|| $resultado->nombre_equipo == 'ALL IN ONE') {
    	dd(['code'=>400]);
    }
	
}



// aca comienzan las validaciones, la primera es sobre si se repite el nombre
// ya se agregó al controlador de validaciones


// validacion para factura y numero de serie
function validacionSerie($dbcon, $Datos) {
    $conn = $dbcon->conn();
	

    // Verificar si ya existe un registro con la misma serie
    $sql = "SELECT COUNT(*) AS count FROM caracteristicas_equipos WHERE numero_serie = '".$Datos->numeroserie."' ";
    $resultado = $dbcon->qBuilder($conn, 'first', $sql);
	
    if ($resultado->count >= 1) {
        dd(['code'=>400,'msj'=>'Un equipo se ha registrado con ese numero de serie']);
    }
	
}




// aqui comienzan las funciones de guardar

function guardarCaracteristicas($dbcon, $Datos){
	$fecha = date('Y-m-d H:i:s');
	$Datos->fechafactura = date('Y-m-d H:i:s');

	$status = '1';
	$conn = $dbcon->conn();
	if ($Datos->descripcion==''){
		$Datos->descripcion=NULL;
	}
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
		
	

		$sql = "INSERT INTO caracteristicas_equipos (cve_equipo, marca, modelo, descripcion, numero_serie, cve_proveedor,
		numero_factura, fecha_factura, sistema_operativo, procesador, vel_procesador, memoria_ram, tipo_almacenamiento, capacidad_almacenamiento, 
		creado_por, estatus_equipo, fecha_ingreso)
				VALUES (".$Datos->nombre.", '".$Datos->marca."', '".$Datos->modelo."', 
				'".$Datos->descripcion."', '".$Datos->numeroserie."', ".$Datos->proveedor.", '".$Datos->numerofactura."', '".$Datos->fechafactura."',
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
			AND cve_proveedor =".$Datos->proveedor."
			AND numero_factura = '".$Datos->numerofactura."'
			AND fecha_factura = '".$Datos->fechafactura."'
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

// funciones para editar
// editar el nombre y la descripción

function editarCaracteristica($dbcon, $Datos){
	$fecha = date('Y-m-d H:i:s');
	$conn = $dbcon->conn();
	if ($Datos->descripcion==''){
		$Datos->descripcion=NULL;}

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
	if ($Datos->descripcion==''){
		$Datos->descripcion=NULL;
	}
	$sql = " UPDATE caracteristicas_equipos
		SET  marca  ='".$Datos->marca."', modelo  ='".$Datos->modelo."',  descripcion  ='".$Datos->descripcion."', numero_serie  ='".$Datos->numeroserie."',
		 cve_proveedor  =".$Datos->proveedor.", numero_factura  ='".$Datos->numerofactura."', fecha_factura  ='".$Datos->fechafactura."', sistema_operativo  ='".$Datos->sistemaoperativo."', procesador  ='".$Datos->procesador."', 
		 vel_procesador  =".$Datos->velocidadprocesador.",  memoria_ram  =".$Datos->memoriaram.", 
		tipo_almacenamiento  ='".$Datos->tipoalmacenamiento."', capacidad_almacenamiento  =".$Datos->capaalmacenamiento."
		WHERE cve_cequipo =" .$Datos->numeroEquipo."";
		$qBuilder = $dbcon->qBuilder($dbcon->conn(), 'do', $sql);

}

function scanner($dbcon, $cve){
	$conn = $dbcon->conn();

	$sql = "SELECT CONCAT('MYS - TIC',ce2.nombre_equipo , ce.cve_cequipo, ' - ', DATE_FORMAT(ce.fecha_ingreso, '%d%m%Y') ) folio
			FROM caracteristicas_equipos ce
			INNER JOIN cat_equipos ce2 ON ce.cve_equipo  = ce2.cve_equipo
			WHERE ce.cve_cequipo = ".$cve." ";
	$resultado = $dbcon->qBuilder($conn, 'first', $sql);
	dd($resultado);
}


// para traer el codigo del empleado

// para traer las caracteristicas del equipo


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
	case 'guardarCaracteristicas':
		guardarCaracteristicas($dbcon, $objDatos);
		break;
	case 'editarCaracteristica':
		editarCaracteristica($dbcon, $objDatos);
		break;
		
	case 'getProveedor':
		getProveedor($dbcon );
		break;
		// los get son para traer informción y que este se muestre
	case 'getEquipos':
		getEquipos($dbcon );
		break;
	case 'getVercaracteristicas':
		getVercaracteristicas($dbcon);
		break;	
		// para las validaciones
	case 'validacionSerie':
		validacionSerie($dbcon,$objDatos);
		break;

	case 'ValidaQueEquipoEs':
		ValidaQueEquipoEs($dbcon,$objDatos);
	break;
	case 'scanner':
		scanner($dbcon,$objDatos->cve);
	break;
	
		
		
}







?>


