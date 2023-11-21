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
function getRelacionGrupos ($dbcon, $Datos){
	$sql = "SELECT DISTINCT nombre_gpo, descripcion, gu.cve_grupo, codigoempleado 
        from grupos_usuarios gu
        INNER JOIN asignacion_equipo ae on gu.cve_grupo = ae.codigoempleado
       INNER JOIN grupos_usuarios_detalle gud on gud.cve_grupo =gu.cve_grupo
       ;";
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
    CONCAT(nombre,' ', apellidopaterno, ' ', apellidomaterno) nombrecompleto, puesto, 
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
    WHERE  ae.codigoempleado = ".$Datos->codigo." AND estatus_asignacion_detalle = 1
    ";

    $datos = $dbcon->qBuilder($dbcon->conn(), 'all', $sql);
    dd($datos);
}

// trae los equipos de los empleados 

function getRelacionEquiposGrupos ($dbcon, $Datos){
	$sql = "SELECT 
    gu.cve_grupo,
    gu.nombre_gpo,
   group_concat(concat(gud.numeroempleado,'.- ',cun.nombre,' ',cun.apellidopaterno,' ',cun.apellidomaterno,
' ',cun.departamento, ' ', cun.puesto)separator ',') nombrecompleto,
    COUNT(*) as cantidad_empleados,
    aed.cve_cequipo,
    ce.marca,
    ce.modelo,
    ce.descripcion,
    ce.numero_serie,
    ce.numero_factura,
    ce.sistema_operativo,
    ce.procesador,
    ce.vel_procesador,
    ce.memoria_ram,
    ce.tipo_almacenamiento,
    ce.capacidad_almacenamiento,
    ce2.nombre_equipo,
    ce2.tipo
    from 
    grupos_usuarios gu
    inner join grupos_usuarios_detalle gud on gu.cve_grupo=gud.cve_grupo
    inner join cat_usuario_nomina cun on gud.numeroempleado=cun.codigoempleado
    inner join asignacion_equipo ae on ae.codigoempleado=gu.cve_grupo 
    inner join asignacion_equipo_detalle aed on ae.cve_asignacion=aed.cve_asignacion and aed.cve_asignacion=3
    inner join caracteristicas_equipos ce on ce.cve_cequipo=aed.cve_cequipo
    inner join cat_equipos ce2 on ce2.cve_equipo=ce.cve_equipo
    where gu.cve_grupo=2
    group by  aed.cve_cequipo";

      // Segunda consulta
    $sql2 = "SELECT cun.codigoempleado, CONCAT(cun.nombre, ' ',cun.apellidopaterno ,' ',cun.apellidomaterno) nombrecompleto, 
    cun.puesto, cun.departamento FROM cat_usuario_nomina cun
    where cun.codigoempleado =2553;";

// Ejecutar ambas consultas
$datos1 = $dbcon->qBuilder($dbcon->conn(), 'all', $sql);
$datos2 = $dbcon->qBuilder($dbcon->conn(), 'all', $sql2);

// Puedes acceder a los resultados de ambas consultas usando $datos1 y $datos2
$respuesta = array('datos1' => $datos1, 'datos2' => $datos2);

// Enviar la respuesta como JSON
echo json_encode($respuesta);
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
        getRelacionGrupos($dbcon,  $objDatos);
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