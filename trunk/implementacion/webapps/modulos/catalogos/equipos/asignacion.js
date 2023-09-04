app.controller('vistaAsignacion', function (BASEURL, ID, $scope, $http) {
	$scope.codigo = '';
	$scope.nombre = '';

	$scope.limpiarCampos = function(){
		$scope.codigo = '';
		$scope.nombre = '';
	}
// esto 
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
		$scope.nombreEliminar=cve_cequipo;

		
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
				
				$http.post('Controller.php', {
					'task': 'eliminarAsignacion',
					'id': ID,
					'nombreEliminar':$scope.nombreEliminar
				}).then(function(response){
					response = response.data;
					
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
	$http.post('Controller.php', {
		'task': 'getEmpleado'
	}).then(function (response){
		response = response.data;
		console.log('getEmpleado', response);
		$scope.empleado = response;
	},function(error){
		console.log('error', error);
	});


	// para ver la marca, modelo y descripción al seleccionar un producto
	$http.post('Controller.php', {
		'task': 'getCaracteristicas'
	}).then(function (response){
		response = response.data;
		console.log('getCaracteristicas', response);
		$scope.caracteristicas = response;
	},function(error){
		console.log('error', error);
	});
});