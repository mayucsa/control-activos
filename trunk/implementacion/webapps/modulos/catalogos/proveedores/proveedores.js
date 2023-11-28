app.controller('vistaProveedor', function (BASEURL, ID, $scope, $http) {
	
		// tabla para traer los datos del proveedor
		$http.post('Controller.php', {
			'task': 'getProveedor'
		}).then(function(response) {
			response = response.data;
			console.log('getProveedor', response);
			$scope.proveedor = response;
			setTimeout(function(){
				$('#tablaProveedor').DataTable({
					"paging": false,
					"bScrollCollapse": true,
					"sScrollY": '200px',
					// "scrollX" '50px'
					// "processing": true,
					// "bDestroy": true,
					"order": [8, 'desc'],
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
		
	
	// este linea llama a la funcion para que muestre todos los empleados
	// $scope.getEmpleadoCata();
	
		
});