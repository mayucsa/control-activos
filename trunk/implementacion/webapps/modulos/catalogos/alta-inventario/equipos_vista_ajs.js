    app.controller('vistaCatalogoEquipos', function (BASEURL, ID, $scope, $http) {
	$scope.nombre = '';
	$scope.equipos = '';
	$scope.insumos = '';

	$scope.limpiarCampos = function(){
		$scope.nombre = '';
		$scope.equipos = '';
		$scope.insumos = '';
	}

// esta relacionado con el input de nombre de equipo
// todo este código se agregó al de validacion
	$scope.ValidaExistencia = function (nombre) {
		// console.log('nombre:', nombre);
		$http.post('Controller.php', {
			'task': 'ValidaExistencia',
			'nombre': nombre
		}).then(function(response){
			response = response.data;
			if (response.code == 400) {
				Swal.fire({
					// confirmButtonColor: '#3085d6',
					title: 'Equipo existente',
					html: response.msj,
					confirmButtonColor: '#1A4672'
					});
					$scope.nombre = '';
			}
			// else{
			// 	$scope.validacionCampos(nombre);
			// }
		}, function(error){
			console.log('error', error);
			jsRemoveWindowLoad();
		});
	}

	$scope.cambioNombre = function () {
		if ($scope.cambioNombreVer == '' ) {
			Swal.fire(
			  'Campo faltante',
			  'Es necesario llenar todos los campos',
			  'warning'
			);
			return;
		}
		
		Swal.fire({
			title: 'Estás a punto de editar la cantidad de una entrada.',
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
					'task': 'editarNombre',
					'numero': $scope.numero,
					'nombre': $scope.cambioNombreVer,
					'descripcion': $scope.cambioDescripcion,
					
					'id': ID,
				}).then(function(response){
					response = response.data;
					if (response.code == 400) {
						Swal.fire({
							// confirmButtonColor: '#3085d6',
							title: 'Equipo existente',
							html: response.msj,
							confirmButtonColor: '#1A4672'
							});
							$scope.nombre = '';
					}else{
						jsShowWindowLoad('Generando entrada...');
						jsRemoveWindowLoad();
						Swal.fire({ 
							title: '¡Éxito!',
							html: 'Se editado el equipo de manera correcta,<br> <b>Folio de equipo: ' + $scope.numero +'</b>',
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
						})}
					
				}, function(error){
					console.log('error', error);
	    			jsRemoveWindowLoad();
				})
			}
		});

	}
	$scope.consultar = function(cve_equipo, nombre_equipo, descripcion){
		$("#numero").attr("disabled", false);
		// console.log('cve', nombre_equipo);
		// console.log('cvemp', cve_mp);
		$scope.numero=cve_equipo;
		$scope.cambioNombreVer = nombre_equipo;
		$scope.cambioDescripcion = descripcion;
		// $('#emateriaprima').val([0]['cve_entrada']);
		// $('#folioe').val([0]['cve_entrada']);
	}
	


// esta relacionado con e boton de guardar
	$scope.validacionCampos = function(nombre, checkh){
		if ($scope.checkh == '' || $scope.checkh == null) {
			Swal.fire(
			  'Campo faltante',
			  'Es necesario seleccionar un tipo',
			  'warning'
			);
			return;
		}
		
		if ($scope.nombre == '' || $scope.nombre == null) {
			Swal.fire(
			  'Campo faltante',
			  'Es necesario indica un nombre de equipo',
			  'warning'
			);
			return;
		}
		// console.log('tipo', $scope.checkh);
		// console.log('nombre', $scope.nombre);
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
				$http.post('Controller.php', {
					'task': 'guardarEquipo',
					'nombre': $scope.nombre,
					'checkh': $scope.checkh,
					'id': ID,
				}).then(function(response){
					response = response.data;
					if(response.code == 200){
						jsShowWindowLoad('Capturando equipo nuevo...');
						jsRemoveWindowLoad();
					Swal.fire({
						title: '¡Éxito!',
						html: 'Su captura de equipo nuevo se generó correctamente.\n <b>Folio: ' +response.folio + '</b>',
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


					}
					else{
						alert('Error en controlador. \nFavor de ponerse en contacto con el administrador del sitio.');
					}
				}, function(error){
					console.log('error', error);
					jsRemoveWindowLoad();
				})
			}
		})
		
	}

	$http.post('Controller.php', {
		'task': 'getEquipos'
	}).then(function(response) {
		response = response.data;
		console.log('getEquipos', response);
		$scope.verequipos= response;
		setTimeout(function(){
			$('#tablaProduccion').DataTable({
		        "processing": true,
		        "bDestroy": true,
				//"order": [5, 'desc'],
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

	$http.post('Controller.php', {
		'task': 'getEquipos'
	}).then(function (response){
		response = response.data;
		console.log('getEquipos', response);
		$scope.equipo = response;
	},function(error){
		console.log('error', error);
	});
});