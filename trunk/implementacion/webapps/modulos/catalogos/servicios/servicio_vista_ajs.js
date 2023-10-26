app.controller('vistaServicio', function (BASEURL, ID, $scope, $http) {
	$scope.servicioEntrada = '';
	$scope.caracteristica = '';

	$scope.limpiarCampos = function(){
		$scope.servicioEntrada = '';
		$scope.caracteristica = '';
	}

	$scope.validacionCampos = function(){
		if ($scope.servicioEntrada == '' || $scope.servicioEntrada == null) {
			Swal.fire(
			  'Campo faltante',
			  'Es necesario indicar el nombre del servicio',
			  'warning'
			);
			return;
		}
		// console.log('nombre:', $scope.nombre);
		Swal.fire({
			title: 'Estás a punto de registrar un nuevo servicio.',
			text: '¿Es correcta la información agregada?',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: 'green',
			cancelButtonColor: 'red',
			confirmButtonText: 'Aceptar',
			cancelButtonText: 'Cancelar'
		}).then((result )=> {
			
			if (result.isConfirmed) {
				jsShowWindowLoad('Capturando equipo nuevo...');
				$http.post('Controller.php', {
					'task': 'guardarServicio',
					'id': ID,
					'servicio': $scope.servicioEntrada,
                    'caracteristica': $scope.caracteristica,
					// console.log('nombre', $scope.servicio),
					
				}).then(function(response){
					response = response.data;
					if (response.code == 400) {
						Swal.fire({
							// confirmButtonColor: '#3085d6',
							title: 'Equipo existente',
							html: response.msj,
							confirmButtonColor: '#1A4672'
							});
							jsRemoveWindowLoad();
							// $scope.nombre = '';
					}else{	// console.log('response', response);
						jsRemoveWindowLoad();
						// if (response.code == 200) {
							Swal.fire({
							title: '¡Éxito!',
							html: 'Su captura del nuevo servicio se generó correctamente. ',
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
							});}
					
					// // }else{
					// 	alert('Error en controlador. \nFavor de ponerse en contacto con el administrador del sitio.');
					// }
				}, function(error){
					console.log('error', error);
					jsRemoveWindowLoad();
				})
			}
		})
	}

	$scope.cambioServicio = function(){
		if ($scope.cambioNombre == '' || $scope.cambioNombre == null) {
			Swal.fire(
			  'Campo faltante',
			  'Es necesario indicar el nombre del servicio',
			  'warning'
			);
			return;
		}
		// console.log('nombre:', $scope.nombre);
		Swal.fire({
			title: 'Estás a punto de registrar un equipo nuevo.',
			text: '¿Es correcta la información agregada?',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: 'green',
			cancelButtonColor: 'red',
			confirmButtonText: 'Aceptar',
			cancelButtonText: 'Cancelar'
		}).then((result )=> {
			
			if (result.isConfirmed) {
				jsShowWindowLoad('Capturando equipo nuevo...');
				$http.post('Controller.php', {
					'task': 'cambioServicio',
					'id': ID,
					'numeroEquipoModal': $scope.numeroEquipoModal,
					'servicio': $scope.cambioNombre,
                    'descripcion': $scope.cambioDescripcion,
					// console.log('nombre', $scope.servicio),
					
				}).then(function(response){
					response = response.data;
					if (response.code == 400) {
						Swal.fire({
							// confirmButtonColor: '#3085d6',
							title: 'Equipo existente',
							html: response.msj,
							confirmButtonColor: '#1A4672'
							});
							jsRemoveWindowLoad();
							// $scope.nombre = '';
					}else{	// console.log('response', response);
						jsRemoveWindowLoad();
						// if (response.code == 200) {
							Swal.fire({
							title: '¡Éxito!',
							html: 'Su captura de equipo nuevo se generó correctamente. ',
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
							});}
					
					// // }else{
					// 	alert('Error en controlador. \nFavor de ponerse en contacto con el administrador del sitio.');
					// }
				}, function(error){
					console.log('error', error);
					jsRemoveWindowLoad();
				})
			}
		})
	}

	$scope.verificarServicio = function (servicioEntrada) {
		// console.log('nombre:', numeroserie);
		$http.post('Controller.php', {
			'task': 'validacionServicio',
			'servicio': servicioEntrada,
			'id': ID
		}).then(function (response){
			response = response.data;
			
			if (response.code == 400) {
				Swal.fire({
					// confirmButtonColor: '#3085d6',
					title: 'Servicio ya registrado',
					html: response.msj,
					confirmButtonColor: '#1A4672'
					});
					$scope.servicioEntrada = '';
			}
		}, function(error){
			console.log('error', error);
		})

	}

	$scope.verificarServicioM = function (cambioNombre) {
		// console.log('nombre:', numeroserie);
		$http.post('Controller.php', {
			'task': 'validacionServicioM',
			'servicio': cambioNombre,
			'id': ID
		}).then(function (response){
			response = response.data;
			
			if (response.code == 400) {
				Swal.fire({
					// confirmButtonColor: '#3085d6',
					title: 'Servicio ya registrado',
					html: response.msj,
					confirmButtonColor: '#1A4672'
					});
					$scope.cambioNombre = '';
			}
		}, function(error){
			console.log('error', error);
		})

	}
	$scope.descativar = function (cve_servicio) {

		console.log('clave servicio', cve_servicio);

		Swal.fire({
			title: 'ACTIVAR SERVICIO.',
			text: '¿Está seguro que desea activar este servicio?',
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
					'task': 'desactivarServicio',
					'id': ID,
					'baja':cve_servicio
				}).then(function(response){
					response = response.data;
					console.log('response', response);

					jsRemoveWindowLoad();
					// if (response.code == 200) {
						Swal.fire({
						  title: '¡Éxito!',
						  html: 'Este servicio ha sido dado de alta',
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
					// }else{
					// 	alert('Error en controlador. \nFavor de ponerse en contacto con el administrador del sitio.');
					// }
				}, function(error){
					console.log('error', error);
					jsRemoveWindowLoad();
				})
			}
		});

	}

	$scope.activar = function (cve_servicio) {

		
		Swal.fire({
			title: 'DESACTIVAR SERVICIO.',
			text: '¿Está seguro que desea desactivar este servicio?',
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
					'task': 'activarServicio',
					'id': ID,
					'alta':cve_servicio
				}).then(function(response){
					response = response.data;
					// console.log('response', response);
					jsRemoveWindowLoad();
					// if (response.code == 200) {
						Swal.fire({
						  title: '¡Éxito!',
						  html: 'Este servicio ha sido dado de baja',
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
					// }else{
					// 	alert('Error en controlador. \nFavor de ponerse en contacto con el administrador del sitio.');
					// }
				}, function(error){
					console.log('error', error);
					jsRemoveWindowLoad();
				})
			}
		});

	}



	$scope.consultar = function (cve_servicio ,nombre_servicio, descripcion) {
		// $scope.numero=cve_equipo;
		$scope.numeroEquipoModal = cve_servicio;
		$scope.cambioNombre = nombre_servicio;
		$scope.cambioDescripcion = descripcion;
	
		}
	
		// tabla para traer los datos de los servicios
		$http.post('Controller.php', {
			'task': 'getServicio'
			}).then(function(response) {
				response = response.data;
				console.log('getEmpleado', response);
				$scope.servicio = response;
				setTimeout(function(){
					$('#tablaServicio').DataTable({
						"processing": true,
						"bDestroy": true,
						"order": [3, 'desc'],
						"lengthMenu": [[5, 20, 30], [5, 20, 30]],
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
	// $http.post('Controller.php', {
	// 	'task': 'getServicios'
	// }).then(function (response){
	// 	response = response.data;
	// 	console.log('getEquipos', response);
	// 	$scope.servicios = response;
	// },function(error){
	// 	console.log('error', error);
	// }); 

});