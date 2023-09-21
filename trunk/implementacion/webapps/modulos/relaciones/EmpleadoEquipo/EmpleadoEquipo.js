app.controller('vistaEmpleadoEquipo', function (BASEURL, ID, $scope, $http) {
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
        'task': 'getRelacionEquipos'
    }).then(function(response) {
        response = response.data;
        console.log('getVercaracteristicas', response);
        $scope.verRelaciones = response;
        setTimeout(function(){
            $('#tablaRelacion').DataTable({
                "processing": true,
                "bDestroy": true,
                // "order": [5, 'desc'],
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
	

});