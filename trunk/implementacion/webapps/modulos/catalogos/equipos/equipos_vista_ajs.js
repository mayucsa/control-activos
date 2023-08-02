app.controller('vistaCatalogoEquipos', function (BASEURL, ID, $scope, $http) {
	$scope.nombre = '';
	$scope.descripcion = '';

	$scope.limpiarCampos = function(){
		$scope.nombre = '';
		$scope.descripcion = '';
	}
	$scope.validacionCampos = function(){
		if ($scope.nombre == '' || $scope.nombre == null) {
			Swal.fire(
			  'Campo faltante',
			  'Es necesario indica un nombre de equipo',
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
					'task': 'guardarEquipo',
					'nombre': $scope.nombre,
					'id': ID,
				}).then(function(response){
					response = response.data;
					// console.log('response', response);
					jsRemoveWindowLoad();
					if (response.code == 200) {
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
					}else{
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