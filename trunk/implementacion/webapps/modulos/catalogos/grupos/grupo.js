app.controller('vistaGrupos', function (BASEURL, ID, $scope, $http) {
	$scope.nuevogrupo= "";
	$scope.empleadosAgregados=[];
	$scope.empleadosCodigo=[];

	$scope.nombreGrupo = '';
	$scope.descripcion = '';
// valida si ya existe el nombre del grupo
	$scope.ValidaExistencia = function (nombreGrupo) {
		// console.log('nombre:', nombre);
		$http.post('Controller.php', {
			'task': 'ValidaExistencia',
			'nombreGrupo': nombreGrupo
		}).then(function(response){
			response = response.data;
			if (response.code == 400) {
				Swal.fire({
					// confirmButtonColor: '#3085d6',
					title: 'Grupo existente',
					html: response.msj,
					confirmButtonColor: '#1A4672'
					});
					$scope.nombreGrupo = '';
			}
			// else{
			// 	$scope.validacionCampos(nombre);
			// }
		}, function(error){
			console.log('error', error);
			// jsRemoveWindowLoad();
		});
	}
	
	$http.post('Controller.php', {
        'task': 'getGrupos'
    }).then(function(response) {
        response = response.data;
        console.log('getGrupos', response);
        $scope.grupos = response;
        setTimeout(function(){
            $('#tablaGrupos').DataTable({
                "processing": true,
                "bDestroy": true,
                // "order": [5, 'desc'],
                "lengthMenu": [[10, 30, 45], [10, 30, 45]],
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
	// , function(error){
    //     console.log('error', error);
    // });

	// $scope.getGrupos =  function () {
	// 	$http.post('Controller.php', {
	// 		'task': 'getGrupos'
	// 	}).then(function(response) {
	// 		response = response.data;
	// 		console.log('grupos', response);
	// 		$scope.grupos = response;
			// $('#tablaGrupos').DataTable({
            //     "processing": true,
            //     "bDestroy": true,
            //     // "order": [5, 'desc'],
            //     "lengthMenu": [[15, 30, 45], [15, 30, 45]],
            //     "language": {
            //         "lengthMenu": "Mostrar _MENU_ registros por página.",
            //         "zeroRecords": "No se encontró registro.",
            //         "info": "  _START_ de _END_ (_TOTAL_ registros totales).",
            //         "infoEmpty": "0 de 0 de 0 registros",
            //         "infoFiltered": "(Encontrado de _MAX_ registros)",
            //         "search": "Buscar: ",
            //         "processing": "Procesando...",
            //                 "paginate": {
            //             "first": "Primero",
            //             "previous": "Anterior",
            //             "next": "Siguiente",
            //             "last": "Último"
            //         }

            //     }
            // })
	// 	})
	// }
	
	// $scope.getGrupos();

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

	// este quita al usuario del  grupo (en el modal se puede ver)
	$scope.QuitardelGrupo = function(cve_gpo_detalle){
		Swal.fire({
			title: 'Eliminar empleado',
			text: '¿Deseas quitar el empleado del grupo?',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: 'green',
			cancelButtonColor: 'red',
			confirmButtonText: 'Aceptar',
			cancelButtonText: 'Cancelar'
		}).then((result) => {
			if (result.isConfirmed) {
				jsShowWindowLoad('Eliminando empleado...');
				$http.post('Controller.php', {
					'task': 'quitarEmpleado',
					'cve': cve_gpo_detalle,
					'id': ID,
				}).then(function(response){
					response = response.data;
					// console.log('response', response);
					jsRemoveWindowLoad();
					Swal.fire({
					  title: '¡Éxito!',
					  html: 'Se elimino el empleado de manera exitosa',
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
					});
				})
			}
		})
	}

// tabla de los empleados para que se visualice
	$scope.getEmpleadoGrupos = function(){
		// tabla para traer los datos del empleado
		$http.post('Controller.php', {
			'task': 'getEmpleadoGrupos'
		}).then(function(response) {
			response = response.data;
			console.log('getEmpleadoGrupos', response);
			$scope.empleado = response;
			setTimeout(function(){
				$('#tablaEmpleado').DataTable({
					"paging": false,
					"bScrollCollapse": true,
					"sScrollY": '200px',
					// "scrollX" '50px'
					// "processing": true,
					// "bDestroy": true,
					"order": [3, 'desc'],
					"lengthMenu": [[15, 20, 30], [15, 20, 30]],
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
			},100);
		}, function(error){
			console.log('error', error);
		});
		
	}
	// este linea llama a la funcion para que muestre todos los empleados
	$scope.getEmpleadoGrupos();

	$scope.agregar = function(){
		
		if ($scope.nuevogrupo == false) {
			$scope.nuevogrupo = true
			$scope.nuevogrupoEmpleado = true
		}else{
			$scope.nuevogrupo = false
			$scope.nuevogrupoEmpleado = false
		}
	}

	$scope.agregarEmpleado = function(codigoempleado, nombreC) {
		// console.log('codigo', codigoempleado);
		// console.log('nombre', nombreC);
	
		const empleadoCompleto = {
			codigo: codigoempleado,
			nombre: nombreC
		};
		const empleadoCod= {
			codigoempleado
		};

		// Variable de bandera para verificar si el empleado existe en el array
		let existe = false;
		let existente = false;
	
		// Verifica si empleadoCompleto ya existe en empleadosAgregados
		for (let i = 0; i < $scope.empleadosAgregados.length; i++) {
			if (empleadoCompleto.codigo === $scope.empleadosAgregados[i].codigo &&
				// empleadoCompleto.codigo === $scope.empleadosCodigo[i].codigo &&
				empleadoCompleto.nombre === $scope.empleadosAgregados[i].nombre) {
				existe = true;
				break;
			}
		}
		for (let j = 0; j < $scope.empleadosCodigo.length; j++) {
			if (empleadoCod === $scope.empleadosCodigo) {
				existente = true;
				break;
			}
		}
		

	
		// Si el empleado no existe, agrégalo al array
		if (!existe) {
			$scope.empleadosAgregados.push(empleadoCompleto);
			console.log('Empleado agregado:', empleadoCompleto);
		} else {
			console.log('El empleado ya existe en el array.');
		}
		if (!existente) {
			$scope.empleadosCodigo.push(empleadoCod);
			// console.log('codigo del empleado', $scope.empleadosCodigo);;
		} else {
			console.log('El empleado ya existe en el array.');
		}
	
		// Imprime el array actualizado en la consola
		console.log('codigo del empleado', $scope.empleadosCodigo)
		// console.log($scope.empleadosAgregados);
		// console.log("codigo",empleados.codigo);
		// console.log("nombre",nombreC);
	};
	

	$scope.eliminar = function(i){
		$scope.empleadosAgregados.splice(i, 1);
		$scope.empleadosCodigo.splice(i, 1);
		// console.log($scope.empleadosAgregados);
	}

	$scope.eliminarGrupo = function(cve_grupo){
		Swal.fire({
			title: 'Eliminar grupo',
			text: '¿Deseas eliminar el grupo por completo?',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: 'green',
			cancelButtonColor: 'red',
			confirmButtonText: 'Aceptar',
			cancelButtonText: 'Cancelar'
		}).then((result) => {
			if (result.isConfirmed) {
				jsShowWindowLoad('Revisando existencia de empleados...');
				$http.post('Controller.php', {
					'task': 'validaExistenciaEmpleados',
					'cve': cve_grupo,
					'id': ID,
				}).then(function(response){
					response = response.data;
					// console.log('response', response);
					jsRemoveWindowLoad();
					if (response.code == 200) {
						Swal.fire({
						  title: 'Alerta!',
						  html: 'Este grupo tiene empleados asignados<br> ¿Deseas eliminar el grupo y los empleados asignados? ',
						  icon: 'warning',
						  showCancelButton: true,
						  confirmButtonColor: 'green',
						  cancelButtonColor: 'red',
						  confirmButtonText: 'Aceptar',
						  cancelButtonText: 'Cancelar'
						}).then((result) => {
						  if (result.isConfirmed) {
						  		jsShowWindowLoad('Eliminando grupo...');
							  $http.post('Controller.php', {
							  	'task': 'eliminarGrupo',
								'cve': cve_grupo,
								'id': ID,
							  }).then(function(response){
							  	response = response.data;
								// console.log('response', response);
								jsRemoveWindowLoad();
								Swal.fire({
								  title: '¡Éxito!',
								  html: 'Se elimino el grupo de manera exitosa',
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
								});
							  }, function(error){
							  	console.log('error', error);
								jsRemoveWindowLoad();
							  })
						  }
						});
					}else{
							jsShowWindowLoad('Eliminando grupo...');
						  $http.post('Controller.php', {
						  	'task': 'eliminarGrupo',
							'cve': cve_grupo,
							'id': ID,
						  }).then(function(response){
						  	response = response.data;
							// console.log('response', response);
							jsRemoveWindowLoad();
							Swal.fire({
							  title: '¡Éxito!',
							  html: 'Se elimino el grupo de manera exitosa',
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
							});
						  }, function(error){
						  	console.log('error', error);
							jsRemoveWindowLoad();
						  });
					}
				}, function(errorLog){
					console.log('error', error);
					jsRemoveWindowLoad();
				})
			}
		})
	}

	$scope.guardarGrupo=function(codigo){
		// $cod=$scope.empleadosCodigo;
		if ($scope.nombreGrupo=='' || $scope.nombreGrupo==null  ) {
			Swal.fire(
				'Campo faltante',
				'Es necesario indicar el nombre del grupo',
				'warning'
			  );
			  return;
		}
		if ($scope.empleadosAgregados.length===0) {
			Swal.fire(
				'Campo faltante',
				'Es necesario tener al menos un integrante',
				'warning'
			  );
			  return;
		}
		Swal.fire({
			title: 'Estás a punto de crear un nuevo grupo.',
			text: '¿Es correcta la información agregada?',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: 'green',
			cancelButtonColor: 'red',
			confirmButtonText: 'Aceptar',
			cancelButtonText: 'Cancelar'
		}).then((result) => {
			if (result.isConfirmed) {
				jsShowWindowLoad('Capturando caracteristicas...');
				
				$http.post('Controller.php', {
					'task': 'guardarGrupos',
					'id': ID,
					'nombreGrupo': $scope.nombreGrupo,
					'descripcion': $scope.descripcion,
					'empleadosCodigo':$scope.empleadosCodigo,
					
				}).then(function(response){
					console.log($scope.empleadosCodigo);
					response = response.data;
					// console.log('response', response);
					jsRemoveWindowLoad();
					if (response.code == 200) {
						Swal.fire({
						  title: '¡Éxito!',
						  html: 'Se generó el grupo: <b> '+ response.nombre+'</b>',
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
						});
					}else{
						alert('Error en controlador. \nFavor de ponerse en contacto con el administrador del sitio.');
					}
				}, function(error){
					console.log('error', error);
					jsRemoveWindowLoad();
				})
			}
		});





	}


		
	
	
		
});