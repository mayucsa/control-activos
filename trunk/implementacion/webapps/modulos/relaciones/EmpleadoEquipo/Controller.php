<?php
date_default_timezone_set('America/Chihuahua');
function dd($var){
    if (is_array($var) || is_object($var)) {
        die(json_encode($var));
    }else{
        die($var);
    }
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
// trae a los empleados que tienen equipos
function getRelacionEmpleados ($dbcon){
	$sql = "SELECT DISTINCT cun.nombre ,CONCAT(cun.apellidopaterno, ' ', cun.apellidomaterno) apellidos, ae.codigoempleado
    FROM asignacion_equipo ae 
    inner join cat_usuario_nomina cun on cun.codigoempleado =ae.codigoempleado ";
    $datos = $dbcon->qBuilder($dbcon->conn(), 'all', $sql);
    dd($datos);
}
// trae a los grupos que tienen equipos
function getRelacionGrupos ($dbcon){
	$sql = "SELECT DISTINCT nombre_gpo, descripcion, cve_grupo, codigoempleado
    from grupos_usuarios gu
    inner join asignacion_equipo ae on gu.cve_grupo = ae.codigoempleado  ;";
    $datos = $dbcon->qBuilder($dbcon->conn(), 'all', $sql);
    dd($datos);
}
// trae los equipos de los empleados

// function getRelacionEquipos ($dbcon, $Datos){
// 	$sql = "SELECT aed.cve_asignacion, aed.cve_cequipo,ce2.nombre_equipo, CONCAT(nombre, apellidopaterno, apellidomaterno)nombrecompleto, puesto, ae.codigoempleado,cun.departamento, marca, modelo, numero_serie,numero_factura,
//     procesador, vel_procesador, memoria_ram, capacidad_almacenamiento, sistema_operativo, DATE(aed.fecha_asignacion) fechaasignacion,
//     CONCAT('MYS - TIC', ce2.nombre_equipo, ce.cve_cequipo, ' - ', DATE_FORMAT(ce.fecha_ingreso, '%d%m%Y') ) folio,
//     CONCAT(DATE_FORMAT(ae.fecha_asignacion, '%d%m%Y') , 'MYS - ', ae.cve_asignacion) numeroresguardo
//     FROM asignacion_equipo_detalle aed
//     INNER JOIN asignacion_equipo ae ON ae.cve_asignacion = aed.cve_asignacion
//     INNER JOIN caracteristicas_equipos ce on ce.cve_cequipo =aed.cve_cequipo
//     INNER JOIN cat_equipos ce2 ON ce2.cve_equipo = ce.cve_equipo
//     INNER JOIN cat_usuario_nomina cun on cun.codigoempleado =ae.codigoempleado
//             WHERE ae.codigoempleado =".$Datos->codigo." AND estatus_asignacion_detalle=1";
//     $datos = $dbcon->qBuilder($dbcon->conn(), 'all', $sql);
//     dd($datos);

    
// }

function getRelacionEquipos($dbcon, $Datos)
{
    $sql = "SELECT aed.cve_asignacion, aed.cve_cequipo, ce2.nombre_equipo, 
    CONCAT(nombre, apellidopaterno, apellidomaterno) nombrecompleto, puesto, 
    ae.codigoempleado, cun.departamento, marca, modelo, numero_serie, numero_factura,
            CASE
                WHEN ce2.nombre_equipo NOT IN ('laptop', 'cpu', 'all in one') THEN NULL
                ELSE procesador
            END AS procesador,
            CASE
                WHEN ce2.nombre_equipo NOT IN ('laptop', 'cpu', 'all in one') THEN NULL
                ELSE vel_procesador
            END AS vel_procesador,
            CASE
                WHEN ce2.nombre_equipo NOT IN ('laptop', 'cpu', 'all in one') THEN NULL
                ELSE memoria_ram
            END AS memoria_ram,
            CASE
                WHEN ce2.nombre_equipo NOT IN ('laptop', 'cpu', 'all in one') THEN NULL
                ELSE capacidad_almacenamiento
            END AS capacidad_almacenamiento,
            CASE
                WHEN ce2.nombre_equipo NOT IN ('laptop', 'cpu', 'all in one') THEN NULL
                ELSE sistema_operativo
            END AS sistema_operativo,
            DATE(aed.fecha_asignacion) fechaasignacion,
            CONCAT('MYS - TIC', ce2.nombre_equipo, ce.cve_cequipo, ' - ', DATE_FORMAT(ce.fecha_ingreso, '%d%m%Y') ) folio,
            CONCAT(DATE_FORMAT(ae.fecha_asignacion, '%d%m%Y') , 'MYS - ', ae.cve_asignacion) numeroresguardo
    FROM asignacion_equipo_detalle aed
    INNER JOIN asignacion_equipo ae ON ae.cve_asignacion = aed.cve_asignacion
    INNER JOIN caracteristicas_equipos ce ON ce.cve_cequipo = aed.cve_cequipo
    INNER JOIN cat_equipos ce2 ON ce2.cve_equipo = ce.cve_equipo
    INNER JOIN cat_usuario_nomina cun ON cun.codigoempleado = ae.codigoempleado
    WHERE ae.codigoempleado = ".$Datos->codigo." AND estatus_asignacion_detalle = 1";

    $datos = $dbcon->qBuilder($dbcon->conn(), 'all', $sql);
    dd($datos);
}

// trae los equipos de los empleados

function getRelacionEquiposGrupos ($dbcon, $Datos){
	$sql = "SELECT aed.cve_asignacion, aed.cve_cequipo, ae.codigoempleado, marca, modelo, ce2.nombre_equipo, aed.fecha_asignacion
    from asignacion_equipo_detalle aed
    INNER JOIN asignacion_equipo ae ON ae.cve_asignacion = aed.cve_asignacion
    INNER JOIN caracteristicas_equipos ce on ce.cve_cequipo =aed.cve_cequipo
    INNER JOIN cat_equipos ce2 ON ce2.cve_equipo = ce.cve_equipo
    where ae.codigoempleado =".$Datos->codigo." AND estatus_asignacion_detalle=1";
    $datos = $dbcon->qBuilder($dbcon->conn(), 'all', $sql);
    dd($datos);
}
function editarRelacion ($dbcon, $Datos){
	$sql = "UPDATE asignacion_equipo_detalle  set estatus_asignacion_detalle=0
    where cve_cequipo= ".$Datos->codigo."  ";
    $datos = $dbcon->qBuilder($dbcon->conn(), 'do', $sql);
    // dd($datos);

    $sql2=" UPDATE caracteristicas_equipos SET estatus_equipo=1
		where cve_cequipo=".$Datos->codigo."";
		$datos2 = $dbcon->qBuilder($dbcon->conn(), 'do', $sql2);
        if (!$datos2) {
            // Manejar el error, imprimir un mensaje de error o registrar detalles del error.
            echo "Error al ejecutar la segunda consulta SQL: " . $dbcon->error(); // Asegúrate de tener un método de manejo de errores adecuado en tu clase $dbcon.
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
    case 'getGruposDetalle': 
		getGruposDetalle($dbcon, $objDatos->cve_grupo);
    break;
    case 'getRelacionEmpleados':
        getRelacionEmpleados($dbcon);
    break; 
    case 'getRelacionGrupos':
        getRelacionGrupos($dbcon);
    break; 
    case 'getRelacionEquipos':
        getRelacionEquipos($dbcon, $objDatos);
    break; 
    case 'getRelacionEquiposGrupos':
        getRelacionEquiposGrupos($dbcon, $objDatos);
    break;
    case 'editarRelacion':
        editarRelacion($dbcon, $objDatos);
    break; 
    
}