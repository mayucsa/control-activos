app.controller('vistaEmpleadoEquipo', function (BASEURL, ID, $scope, $http) {
    var fechaActual = new Date();
        $scope.fechaActual = fechaActual.toLocaleDateString('en-ZA');
        $scope.fechai = $scope.fechaActual;
        $scope.fechaf = $scope.fechaActual;
    
 $scope.empleados='';
 $scope.btneg = "";


    $scope.agregarV = function(){
		
		if ($scope.empleados == false) {
			$scope.empleados = true
            $scope.grupos = true
			// $scope.cambioVistaEmpleado = true
		}else{
			$scope.empleados = false
			$scope.grupos = false
			// $scope.cambioVistaEmpleado = false
		}
	}

// sirve para traer los empleados que hay dentro de los grupos
    $scope.verLista = function(cve_grupo){
		$http.post('Controller.php', {
			'task': 'getGruposDetalle',
			'cve_grupo': cve_grupo
		}).then(function(response) {
			response = response.data;
			console.log('getGruposDetalle', response);
			$scope.gruposDetalle = response;
		})
	}

    // console.log(getMarca);

	$scope.eliminarRelacion=function(cve_cequipo){
        console. log('debe traer el dato de cve_cequipo', cve_cequipo)
        Swal.fire({ 
            title: 'Estás apunto de eliminar este equipo.',
            text: '¿Estás seguro que deseas eliminar este equipo?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: 'green',
            cancelButtonColor: 'red',
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                
                $http.post('Controller.php', {
                    'task': 'editarRelacion',
                    'codigo': cve_cequipo, 
                }).then(function(response){
                    response = response.data;
                    // if (response.code == 400) {
                    // 	Swal.fire({
                    // 		// confirmButtonColor: '#3085d6',
                    // 		title: 'Equipo existente',
                    // 		html: response.msj,
                    // 		confirmButtonColor: '#1A4672'
                    // 		});
                    // 		$scope.cambiaNumeroserie = '';}
                    {
                        Swal.fire({
                            title: '¡Éxito!',
                            html: 'Se editado el equipo'+ ' ' + $scope.verNombre +' ' + 'de manera correcta,<br> <b>Número de serie: ' + $scope.cambiaNumeroserie +'</b>',
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: 'green',
                            confirmButtonText: 'Aceptar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                              }else{
                                  location.reload();
                              }
                        })
                
                    }
                
                }, function(error){
                    console.log('error', error);
                    jsRemoveWindowLoad();
                })
            }
        })
    }
// esta es para la tabla del modal de los empleados
	$scope.consultar = function(codigoempleado){
        console.log("prueba:", codigoempleado);
        // console.log("otra prueba:", codigo);
        $http.post('Controller.php', {
            'task': 'getRelacionEquipos',
            'codigo': codigoempleado
        }).then(function(response) {
            response = response.data;
            console.log('verRelacionesEquipos', response);
            // Destruye la instancia DataTable existente si hay una
            if ($.fn.DataTable.isDataTable('#tablaRelacionEquipo')) 
            {
            $('#tablaRelacionEquipo').DataTable().destroy();
             }
            $scope.verEquipos = response;
            setTimeout(function(){
                $('#tablaRelacionEquipo').DataTable({
                    "processing": true,
                    "bDestroy": true,
                    // "order": [5, 'desc'],
                    "lengthMenu": [[15, 30, 45], [15, 30, 45]],
                    "language": {
                        "lengthMenu": "Mostrar _MENU_ registros por página.",
                        "zeroRecords": "No se encontró registro.",
                        "info": "  _START_ de _END_ (_TOTAL_ registros totales).",
                        "infoEmpty": "0 de 0 de 0 registros",
                        "infoFiltered": "(Encontrado de _MAX_ registros)",
                        "search": "Buscar: ",
                        "processing": "Procesando...",
                                "paginate": {
                            "first": "Primero",
                            "previous": "Anterior",
                            "next": "Siguiente",
                            "last": "Último"
                        }
        
                    }
                });
            },400);
        }, function(error){
            console.log('error', error);
        });
        
	}

    $scope.consultaEquiposGrupos = function(codigoempleado){
        console.log("prueba:", codigoempleado);
        $http.post('Controller.php', {
            'task': 'getRelacionEquiposGrupos',
            'codigo': codigoempleado
        }).then(function(response) {
            response = response.data;
            console.log('verRelacionesEquipos', response);
            // Destruye la instancia DataTable existente si hay una
            // if ($.fn.DataTable.isDataTable('#tablaRelacionEquipo')) 
            // {
            // $('#tablaRelacionEquipo').DataTable().destroy();
            //  }
            $scope.verEquiposGrupos = response;
            setTimeout(function(){
                $('#tablaEquiposGrupos').DataTable({
                    "processing": true,
                    "bDestroy": true,
                    // "order": [5, 'desc'],
                    "lengthMenu": [[15, 30, 45], [15, 30, 45]],
                    "language": {
                        "lengthMenu": "Mostrar _MENU_ registros por página.",
                        "zeroRecords": "No se encontró registro.",
                        "info": "  _START_ de _END_ (_TOTAL_ registros totales).",
                        "infoEmpty": "0 de 0 de 0 registros",
                        "infoFiltered": "(Encontrado de _MAX_ registros)",
                        "search": "Buscar: ",
                        "processing": "Procesando...",
                                "paginate": {
                            "first": "Primero",
                            "previous": "Anterior",
                            "next": "Siguiente",
                            "last": "Último"
                        }
        
                    }
                });
            },400);
        }, function(error){
            console.log('error', error);
        });
        
	}
// trae los datos de la tabla asignación detalle, para que se muestre los equipos que tiene cierto usuario

// hace que se ejecute el pdf que contiene los datos del usuario
    $scope.getPDF =  function(codigoempleado){
        // console.log('codigoempleado', codigoempleado);
        jsShowWindowLoad('Imprimiendo hoja de resguardo de empleado...');
        $http.post('Controller.php', {
            'task': 'getRelacionEquipos',
            'codigo': codigoempleado
        }).then(function (response){
            response = response.data;
            console.log('HojaResguardo', response);
            $scope.resguardo = response;
            setTimeout(function(){
                imprSelec('pdfHojaResguardo');
                jsRemoveWindowLoad();
            }, 700);
        }, function(error){
            console.log('error', error);
            jsRemoveWindowLoad();
        });
    }
// hace lo mismo que lo de arriba pero trae a los grupos
    $scope.getPdfGrup =  function(codigoempleado, numeroempleado){
        console.log('codigoempleado', numeroempleado);
        jsShowWindowLoad('Imprimiendo hoja de resguardo del grupo...');
        $http.post('Controller.php', {
            'task': 'getRelacionEquiposGrupos',
            'codigo': codigoempleado
        }).then(function (response){
            response = response.data;
            console.log('HojaResguardoGrupo', response);
            $scope.resguardoGrupo = response;
            setTimeout(function(){
                imprSelec('pdfHojaResguardoGrupo');
                jsRemoveWindowLoad();
            }, 700);
        }, function(error){
            console.log('error', error);
           
            jsRemoveWindowLoad();
        });
    }
   
// trae los datos de la tabla asignación para que podamos ver los usuarios 
    $http.post('Controller.php', {
        'task': 'getRelacionEmpleados'
    }).then(function(response) {
        response = response.data;
        console.log('verRelaciones', response);
        $scope.verRelacionesEmpleado = response;
        setTimeout(function(){
            $('#tablaRelacionEmpleado').DataTable({
                "processing": true,
                "bDestroy": true,
                // "order": [5, 'desc'],
                "lengthMenu": [[15, 30, 45], [15, 30, 45]],
                "language": {
                    "lengthMenu": "Mostrar _MENU_ registros por página.",
                    "zeroRecords": "No se encontró registro.",
                    "info": "  _START_ de _END_ (_TOTAL_ registros totales).",
                    "infoEmpty": "0 de 0 de 0 registros",
                    "infoFiltered": "(Encontrado de _MAX_ registros)",
                    "search": "Buscar: ",
                    "processing": "Procesando...",
                            "paginate": {
                        "first": "Primero",
                        "previous": "Anterior",
                        "next": "Siguiente",
                        "last": "Último"
                    }

                }
            });
        },200);
    }, function(error){
        console.log('error', error);
    });
// trae a todos los grupos que se han creado
    $http.post('Controller.php', {
        'task': 'getRelacionGrupos'
    }).then(function(response) {
        response = response.data;
        console.log('verRelaciones grupos', response);
        $scope.verRelacionesGrupo = response;
        setTimeout(function(){
            $('#tablaRelacionGrupos').DataTable({
                "processing": true,
                "bDestroy": true,
                // "order": [5, 'desc'],
                "lengthMenu": [[15, 30, 45], [15, 30, 45]],
                "language": {
                    "lengthMenu": "Mostrar _MENU_ registros por página.",
                    "zeroRecords": "No se encontró registro.",
                    "info": "  _START_ de _END_ (_TOTAL_ registros totales).",
                    "infoEmpty": "0 de 0 de 0 registros",
                    "infoFiltered": "(Encontrado de _MAX_ registros)",
                    "search": "Buscar: ",
                    "processing": "Procesando...",
                            "paginate": {
                        "first": "Primero",
                        "previous": "Anterior",
                        "next": "Siguiente",
                        "last": "Último"
                    }

                }
            });
        },200);
    }, function(error){
        console.log('error', error);
    });

});

function imprSelec(id) {
    var div = document.getElementById(id);
    var ventimp = window.open(' ', 'popimpr');
    ventimp.document.write( div.innerHTML );
    ventimp.document.close();
    ventimp.print( );
    ventimp.close();
}