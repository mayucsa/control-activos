app.controller('vistaMantenimiento', function (BASEURL, ID, $scope, $http) {
    $scope.checkh = '';
	$scope.mantenimiento = '';
	$scope.nombre = '';

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
	

});