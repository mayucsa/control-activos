app.controller('vistaMantenimiento', function (BASEURL, ID, $scope, $http) {
    $scope.ingEncargado == '';
	$scope.nombreServicio == '';
	$scope.nombreEquipo == '';
	$scope.comentario == '';
// en array agregados se guarda el 
// codigo de los equipos que le haremos mantenimiento
	$scope.arrayAgregados = '';

	// en array servicios se guarda el 
// codigo del servicio que le haremos al equipo seleccionado
	$scope.arrayServicios = '';
	

	$scope.limpiarCampos = function(){
        $scope.ingEncargado = '';
		$scope.nombreServicio = '';
		$scope.nombreEquipo = '';
		$scope.comentario = '';
	}

	$scope.agregarEquipo=function(cve_, nombre_equipo){
		console.log("codigo",cve_);
		$scope.arrayAgregados=cve_
		console.log("prueba",$scope.arrayAgregados);
		$scope.nombreEquipo=cve_ +'-'+nombre_equipo
		console.log("nombre",$scope.nombreEquipo);
	}
// trae los datos de la tabla servicio para que se pueda v er en el select
	$http.post('Controller.php', {
		'task': 'getServicio'
	}).then(function (response){
		response = response.data;
		console.log('getServicio', response);
		$scope.servicio = response;
	},function(error){
		console.log('error', error);
	}); 
// trae los datos de la tabla caracteristicas para que se pueda ver en el select
	$http.post('Controller.php', {
		'task': 'getProducto'
	}).then(function (response){
		response = response.data;
		console.log('getProducto', response);
		$scope.producto = response;
	},function(error){
		console.log('error', error);
	}); 

	$http.post('Controller.php', {
		'task': 'getEmpleado'
	}).then(function (response){
		response = response.data;
		console.log('getEmpleado', response);
		$scope.empleado = response;
	},function(error){
		console.log('error', error);
	}); 

	$scope.agregarServicio = function(cve_servicio, nombre_servicio) {
		if ($scope.nombreEquipo == '' || $scope.nombreEquipo == null) {
			Swal.fire(
			  '',
			  'Elija primero un equipo',
			  'warning'
			)
		}
		else{
			console.log("codigo",cve_servicio);
			$scope.arrayServicios=cve_servicio
			console.log("prueba",$scope.arrayServicios);
			$scope.nombreServicio=cve_servicio +'-'+nombre_servicio
			console.log("nombre",$scope.nombreServicio);
		}
	}

	$scope.GuardarAsignacion=function(){
		if ($scope.nombreEquipo == ''||$scope.nombreEquipo == null) {
			Swal.fire(
				'Campo faltante',
				'Es necesario seleccionar un equipo',
				'warning'
			  );
			  return;	
		}
		if ($scope.nombreServicio == ''||$scope.nombreServicio == null) {
			Swal.fire(
				'Campo faltante',
				'Es necesario seleccionar un servicio',
				'warning'
			  );
			  return;	
		}
		if ($scope.ingEncargado == ''||$scope.ingEncargado == null) {
			Swal.fire(
				'Campo faltante',
				'Es necesario seleccionar el encargado del mantenimiento',
				'warning'
			  );
			  return;	
		}
		if ($scope.comentario == ''||$scope.comentario == null) {
			Swal.fire(
				'Campo faltante',
				'Es importante detallar todo lo que se le hizo al equipo',
				'warning'
			  );
			  return;	
		}
		Swal.fire({
			title: 'Estás a punto de meter un equipo a mantenimiento.',
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

	$scope.verEquipo=function(nombre_equipo,marca, modelo, descripcion, numero_factura, numero_serie, sistema_operativo, tipo_almacenamiento){
		
		// $scope.VerEquipo = cve_cequipo;
		$scope.verNombre = nombre_equipo;
		$scope.verMarca = marca;
		$scope.verModelo=modelo;
		$scope.verDescripcion = descripcion;
		$scope.verNumeroFactura= numero_factura;
		$scope.verNumeroSerie = numero_serie;
		// $scope.verFactura=numero_factura;
		$scope.verSistemaOperativo = sistema_operativo;
		$scope.verTipoAlmacenamiento = tipo_almacenamiento;

	}
	

});