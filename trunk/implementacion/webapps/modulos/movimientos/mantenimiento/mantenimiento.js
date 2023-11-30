app.controller('vistaMantenimiento', function (BASEURL, ID, $scope, $http) {
    $scope.checkh == '';
	$scope.mantenimiento == '';
	$scope.nombre == '';

	$scope.limpiarCampos = function(){
        $scope.checkh = '';
		$scope.mantenimiento = '';
		$scope.nombre = '';
	}
// trae los datos de la tabla servicio para que se pueda ver en el select
	$http.post('Controller.php', {
		'task': 'getServicio'
	}).then(function (response){
		response = response.data;
		console.log('getEquipos', response);
		$scope.servicio = response;
	},function(error){
		console.log('error', error);
	}); 
// trae los datos de la tabla caracteristicas para que se pueda ver en el select
	$http.post('Controller.php', {
		'task': 'getProducto'
	}).then(function (response){
		response = response.data;
		console.log('getEquipos', response);
		$scope.producto = response;
	},function(error){
		console.log('error', error);
	}); 
	$scope.validacionCampos=function(){
		if ($scope.checkh == ''||$scope.checkh == null) {
			Swal.fire(
				'Campo faltante',
				'Es necesario seleccionar el encargado del mantenimiento',
				'warning'
			  );
			  return;	
		}
		if ($scope.mantenimiento == ''||$scope.mantenimiento == null) {
			Swal.fire(
				'Campo faltante',
				'Es necesario seleccionar un servicio',
				'warning'
			  );
			  return;	
		}
		if ($scope.nombre == ''||$scope.nombre == null) {
			Swal.fire(
				'Campo faltante',
				'Es necesario seleccionar un equipo',
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
	

});