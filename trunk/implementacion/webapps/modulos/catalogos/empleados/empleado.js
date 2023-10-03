app.controller('vistaEmpleados', function (BASEURL, ID, $scope, $http) {
	$scope.getEmpleadoCata = function(){
		// tabla para traer los datos del empleado
		$http.post('Controller.php', {
			'task': 'getEmpleadoCata'
		}).then(function(response) {
			response = response.data;
			console.log('getEmpleadoCata', response);
			$scope.empleado = response;
			setTimeout(function(){
				$('#tablaEmpleado').DataTable({
					"paging": false,
					"bScrollCollapse": true,
					"sScrollY": '200px',
					// "scrollX" '50px'
					// "processing": true,
					// "bDestroy": true,
					"order": [3, 'desc'],
					"lengthMenu": [[15, 20, 30], [15, 20, 30]],
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
			},100);
		}, function(error){
			console.log('error', error);
		});
		
	}
	// este linea llama a la funcion para que muestre todos los empleados
	$scope.getEmpleadoCata();
	
		
});