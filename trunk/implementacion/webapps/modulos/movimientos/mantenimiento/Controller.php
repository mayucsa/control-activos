<?php
date_default_timezone_set('America/Chihuahua');
function dd($var){
    if (is_array($var) || is_object($var)) {
        die(json_encode($var));
    }else{
        die($var);
    }
}

function getServicio ($dbcon){
	$sql = "select * from cat_servicios  ";
    $datos = $dbcon->qBuilder($dbcon->conn(), 'all', $sql);
    dd($datos);
}

function guardarCaracteristicas($dbcon, $Datos){
	$fecha = date('Y-m-d H:i:s');
	$status = '1';
	$conn = $dbcon->conn();
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
			dd(['code'=>200,'msj'=>'Carga ok']);
		}else{
			dd(['code'=>300, 'msj'=>'error al crear folio.', 'sql'=>$sql]);
		}
}

function getProducto ($dbcon){
	$sql = "SELECT aed.cve_, CONCAT('MYS - TIC', ce.cve_cequipo, ' - ', DATE_FORMAT(ce.fecha_ingreso, '%d%m%Y') ) folio,ce3.nombre_equipo, ce.marca, modelo, ce.descripcion,
    ce.numero_serie, ce.numero_factura, ce.sistema_operativo, tipo_almacenamiento
        FROM caracteristicas_equipos ce
        INNER JOIN asignacion_equipo_detalle aed on aed.cve_cequipo =ce.cve_cequipo 
       INNER JOIN cat_equipos ce3 on ce3.cve_equipo =ce.cve_equipo; ";
    $datos = $dbcon->qBuilder($dbcon->conn(), 'all', $sql);
    dd($datos);
}

function getEmpleado ($dbcon){
	$sql = "SELECT codigoempleado, CONCAT(nombre, ' ', apellidopaterno, ' ', apellidomaterno) nombreCompleto from cat_usuario_nomina  WHERE departamento='informatica';";
    $datos = $dbcon->qBuilder($dbcon->conn(), 'all', $sql);
    dd($datos);
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
    case 'getServicio':
        getServicio($dbcon);
    break; 
    case 'getProducto':
        getProducto($dbcon);
    break;
    case 'getEmpleado':
        getEmpleado($dbcon);
    break;  
    
}