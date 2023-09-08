app.controller('vistaServicio', function (BASEURL, ID, $scope, $http) {
	$scope.servicioEntrada = '';
	$scope.caracteristica = '';

	$scope.limpiarCampos = function(){
		$scope.servicioEntrada = '';
		$scope.caracteristica = '';
	}

	$scope.validacionCampos = function(){
		if ($scope.servicio == '' || $scope.servicio == null) {
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
					'task': 'guardarServicio',
					'id': ID,
					'servicio': $scope.servicio,
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
					title: 'Número de serie registrado',
					html: response.msj,
					confirmButtonColor: '#1A4672'
					});
					$scope.numeroserie = '';
					$scope.cambiaNumeroserie = '';
			}
		}, function(error){
			console.log('error', error);
		})

	}

	$scope.eliminarServicio = function (cve_servicio) {
		$scope.nombreEliminar=cve_servicio;

		
		Swal.fire({
			title: 'Estás a punto de eliminar esta asignación.',
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
					'task': 'eliminarAsignacion',
					'id': ID,
					'nombreEliminar':$scope.nombreEliminar
				}).then(function(response){
					response = response.data;
					// console.log('response', response);
					jsRemoveWindowLoad();
					if (response.code == 200) {
						Swal.fire({
						  title: '¡Éxito!',
						  html: 'Su asignación de equipo se generó correctamente',
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

});