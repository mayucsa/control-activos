app.controller('vistaAsignacion', function (BASEURL, ID, $scope, $http) {
	$scope.codigo = '';
	$scope.nombre = '';
	// var miBoton = document.getElementById('miBoton');

	var relacionArray = {
		listaEmpleado: [],
		listaEquipo: [],
		listaFolio: []
	  };
	  
	function contarElementos(array) {
		return array.length;
	}
	$scope.botonesHabilitados = {}; // Un objeto para mantener el estado de los botones

	

	// let cantidadAlmacenada  = contarElementos(relacionArray[listaEmpleado]);
	// console.log('La cantidadAlmacenada de elementos en el array es:', cantidadAlmacenada);
	
	$scope.agregarEmpleado = function(codigoempleado) {
		console.log('empleado', codigoempleado);
		
		// Utiliza la función contarElementos para verificar la cantidad almacenada
		var cantidadAlmacenada = contarElementos(relacionArray.listaEmpleado);
	
		if (cantidadAlmacenada === 0) {
			relacionArray.listaEmpleado = [codigoempleado];
		} else {
			relacionArray.listaEmpleado = [codigoempleado];
		}
		// console.log('esto es el array empleado', relacionArray.listaEmpleado);
		// console.log('esto es el array equipo', relacionArray.listaEquipo);
	}
	$scope.agregarEquipo = function(cve_cequipo, folio) {
		$scope.marca=folio;
		// Verifica si el botón ya está deshabilitado
		if (!$scope.botonesHabilitados[cve_cequipo]) {
			// Deshabilita el botón
			$scope.botonesHabilitados[cve_cequipo] = true;
	
			// Tu lógica para agregar el equipo aquí
			console.log('este es el botón', cve_cequipo);
	
			var cantidadAlmacenada = contarElementos(relacionArray.listaEquipo);
	
			if (cantidadAlmacenada === 0) {
				relacionArray.listaEquipo = [cve_cequipo];
				// relacionArray.listaEquipo = [folio];
			} else {
				relacionArray.listaEquipo.push(cve_cequipo);
				// relacionArray.listaEquipo.push(folio);
			}
			var cantidadAlmacenada = contarElementos(relacionArray.listaFolio);
	
			if (cantidadAlmacenada === 0) {
				relacionArray.listaFolio = [folio];
				// relacionArray.listaFolio = [folio];
			} else {
				relacionArray.listaFolio.push(folio);
				// relacionArray.listaFolio.push(folio);
			}
	
			console.log('esto es el array de folio', relacionArray.listaFolio);
			console.log('esto es el array de equipo', relacionArray.listaEquipo);
			console.log('esto es el array de empleado', relacionArray.listaEmpleado);
		}
	};
	
	// $scope.agregarEquipo = function(cve_cequipo, button) {
	// 	// var mibutton = document.getElementById('mibutton');
		
	// 	console.log('este es el botón', cve_cequipo);
	
	// 	// Utiliza la función contarElementos para verificar la cantidad almacenada
	// 	var cantidadAlmacenada = contarElementos(relacionArray.listaEquipo);
	
	// 	if (cantidadAlmacenada === 0) {
	// 		relacionArray.listaEquipo = [cve_cequipo];
	// 	} else {
	// 		// Utiliza push para agregar el nuevo dato al array existente
	// 		relacionArray.listaEquipo.push(cve_cequipo);
	// 	}
	
	// 	console.log('esto es el array de equipo', relacionArray.listaEquipo);
	// 	console.log('esto es el array de empleado', relacionArray.listaEmpleado);
	// }
	

	$scope.limpiarCampos = function(){
		$scope.codigo = '';
		$scope.nombre = '';
	}
// tabla para traer los datos una vez que ya se asignó el equipo al empleado
	$http.post('Controller.php', {
		'task': 'getProduccion'
	}).then(function(response) {
		response = response.data;
		console.log('getProduccion', response);
		$scope.ssProduccionMorteros = response;
		setTimeout(function(){
			$('#tablaProduccion').DataTable({
				"processing": true,
				"bDestroy": true,
				"order": [5, 'desc'],
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
// para mostrar el folio de los equipos
	$http.post('Controller.php', {
		'task': 'getCaracteristicas'
	}).then(function(response) {
		response = response.data;
		console.log('getCaracteristicas', response);
		$scope.caracteristicas = response;
		setTimeout(function(){
			$('#tablaProducto').DataTable({
				"processing": true,
				"bDestroy": true,
				"order": [1, 'desc'],
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
		},1000);
	}, function(error){
		console.log('error', error);
	});

	// tabla para traer los datos del empleado
	$http.post('Controller.php', {
		'task': 'getEmpleado'
		}).then(function(response) {
			response = response.data;
			console.log('getEmpleado', response);
			$scope.empleado = response;
			setTimeout(function(){
				$('#tablaEmpleado').DataTable({
					"paging": false,
					"bScrollCollapse": true,
					"sScrollY": '200px',
					// "scrollX" '50px'
					// "processing": true,
					// "bDestroy": true,
					// "order": [2, 'desc'],
					// "lengthMenu": [[5, 20, 30], [5, 20, 30]],
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
			},1000);
		}, function(error){
			console.log('error', error);
		});


	

	$scope.validaEquipo = function () {

		$http.post('Controller.php', {
			'task': 'getMarca',
			'nombre': $scope.nombre
		}).then(function (response){
			response = response.data;
			// // console.log('getMarca', response[0].marca);
			// console.log('getPresentacion', response[0].presentacion);
			$scope.marca = response[0].marca;
			$scope.modelo = response[0].modelo;
			$scope.descripcion = response[0].descripcion;
		}, function(error){
			console.log('error', error);
		})

	}



// 123jas12
// era para validar si un equipo está asigando, no se puede porque tengo un evento que también está funcionando
	$scope.validacionCampos = function(){
		if ($scope.codigo == '' || $scope.codigo == null) {
			Swal.fire(
			  'Campo faltante',
			  'Es necesario llenar todos los campos',
			  'warning'
			);
			return;
		}
		if ($scope.nombre == '' || $scope.nombre == null) {
			Swal.fire(
			  'Campo faltante',
			  'Es necesario llenar todos los campos',
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
					'task': 'guardarAsignacion',
					'id': ID,
					'codigo': $scope.codigo,
                    'nombre': $scope.nombre,
					
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


	$scope.eliminarAsignacion = function (cve_cequipo) {

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
					'nombreEliminar': cve_cequipo
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

	$scope.consultar = function (cve_asignacion ,nombrecompleto) {
		// $scope.numero=cve_equipo;
		$scope.numeroAsignacion = cve_asignacion;
		$scope.nombreEmpleado = nombrecompleto;
	}
	$scope.consultarEliminar = function (cve_asignacion) {
		// $scope.numero=cve_equipo;
		$scope.nombreEliminar = cve_asignacion;
	}
	// $http.post('Controller.php', {
	// 	'task': 'getEquipos'
	// }).then(function (response){
	// 	response = response.data;
	// 	console.log('getEquipos', response);
	// 	$scope.equipo = response;
	// },function(error){
	// 	console.log('error', error);
	// });


// seleccionamos al empleado y nos muestra la clave y su nombre
	// $http.post('Controller.php', {
	// 	'task': 'getEmpleado'
	// }).then(function (response){
	// 	response = response.data;
	// 	console.log('getEmpleado', response);
	// 	$scope.empleado = response;
	// },function(error){
	// 	console.log('error', error);
	// });


	// para ver la marca, modelo y descripción al seleccionar un producto
// 	$http.post('Controller.php', {
// 		'task': 'getCaracteristicas'
// 	}).then(function (response){
// 		response = response.data;
// 		console.log('getCaracteristicas', response);
// 		$scope.caracteristicas = response;
// 	},function(error){
// 		console.log('error', error);
// 	});
});