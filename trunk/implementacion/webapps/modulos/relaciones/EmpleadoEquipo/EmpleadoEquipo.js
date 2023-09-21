app.controller('vistaEmpleadoEquipo', function (BASEURL, ID, $scope, $http) {
    $scope.checkh = '';
	$scope.mantenimiento = '';
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
// trae los datos de la tabla asignación detalle, para que se muestre los equipos que tiene cierto usuario

// trae los datos de la tabla asignación para que podamos ver los usuarios 
    $http.post('Controller.php', {
        'task': 'getRelacionEmpleados'
    }).then(function(response) {
        response = response.data;
        console.log('verRelaciones', response);
        $scope.verRelaciones = response;
        setTimeout(function(){
            $('#tablaRelacion').DataTable({
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
        },800);
    }, function(error){
        console.log('error', error);
    });
	

});