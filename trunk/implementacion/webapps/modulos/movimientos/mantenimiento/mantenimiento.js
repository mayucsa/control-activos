app.controller('vistaMantenimiento', function (BASEURL, ID, $scope, $http) {
    $scope.checkh = '';
	$scope.mantenimiento = '';
	$scope.nombre = '';

	$scope.limpiarCampos = function(){
        $scope.checkh = '';
		$scope.mantenimiento = '';
		$scope.nombre = '';
	}

});