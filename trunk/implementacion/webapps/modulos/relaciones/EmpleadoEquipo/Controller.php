<?php
date_default_timezone_set('America/Chihuahua');
function dd($var){
    if (is_array($var) || is_object($var)) {
        die(json_encode($var));
    }else{
        die($var);
    }
}

function getRelacionEquipos ($dbcon){
	$sql = "SELECT cun.nombre ,CONCAT(cun.apellidopaterno, ' ', cun.apellidomaterno) apellidos, ae.codigoempleado
    FROM asignacion_equipo ae 
    inner join cat_usuario_nomina cun on cun.codigoempleado =ae.codigoempleado ";
    $datos = $dbcon->qBuilder($dbcon->conn(), 'all', $sql);
    dd($datos);
}

// function getProducto ($dbcon){
// 	$sql = "SELECT CONCAT('MYS - TIC', ce.cve_cequipo, ' - ', DATE_FORMAT(ce.fecha_ingreso, '%d%m%Y') ) folio
//     FROM caracteristicas_equipos ce
//     INNER JOIN cat_equipos ce2 ON ce.cve_equipo  = ce2.cve_equipo; ";
//     $datos = $dbcon->qBuilder($dbcon->conn(), 'all', $sql);
//     dd($datos);
// }






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
    case 'getRelacionEquipos':
        getRelacionEquipos($dbcon);
    break; 
    // case 'getProducto':
    //     getProducto($dbcon);
    // break; 
    
}