app.controller('vistaServicio', function (BASEURL, ID, $scope, $http) {
	$scope.servicio = '';

	$scope.limpiarCampos = function(){
		$scope.servicio = '';
		$scope.nombre = '';
	}


});