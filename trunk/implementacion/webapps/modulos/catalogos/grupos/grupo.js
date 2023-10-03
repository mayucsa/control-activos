app.controller('vistaGrupos', function (BASEURL, ID, $scope, $http) {
	$scope.nuevogrupo= "";
	$scope.empleadosAgregados=[]

	$scope.getEmpleadoGrupos = function(){
		// tabla para traer los datos del empleado
		$http.post('Controller.php', {
			'task': 'getEmpleadoGrupos'
		}).then(function(response) {
			response = response.data;
			console.log('getEmpleadoGrupos', response);
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
	$scope.getEmpleadoGrupos();

	// function hideDiv() {
	// 	var aux = $("button[name=".esconder."]:.checked.").val();
	// 	if (aux == "show"){
	// 	$(".hideDiv").css("display","block");
	// 	}else{
	// 	$(".hideDiv").css("display","none");
	// 	}
	// 	}
	$scope.agregar = function(){
		
	if ($scope.nuevogrupo == false) {
		$scope.nuevogrupo = true
		$scope.nuevogrupoEmpleado = true
	}else{
		$scope.nuevogrupo = false
		$scope.nuevogrupoEmpleado = false
	}
	}

	// Suponiendo que empleados sea un array definido previamente en tu código.
	// $scope.empleados = [];

	$scope.agregarEmpleado = function(codigoempleado, nombreC) {
		console.log('codigo', codigoempleado);
		console.log('nombre', nombreC);
	
		// Combina el código de empleado y el nombre en un objeto o cadena, según tu necesidad.
		const empleadoCompleto = {
			codigo: codigoempleado,
			nombre: nombreC
		};

		// Variable de bandera para verificar si el empleado existe en el array
		let existe = false;
	
		// Verifica si empleadoCompleto ya existe en empleadosAgregados
		for (let i = 0; i < $scope.empleadosAgregados.length; i++) {
			if (empleadoCompleto.codigo === $scope.empleadosAgregados[i].codigo &&
				empleadoCompleto.nombre === $scope.empleadosAgregados[i].nombre) {
				existe = true;
				break;
			}
		}
	
		// Si el empleado no existe, agrégalo al array
		if (!existe) {
			$scope.empleadosAgregados.push(empleadoCompleto);
			console.log('Empleado agregado:', empleadoCompleto);
		} else {
			console.log('El empleado ya existe en el array.');
		}
	
		// Imprime el array actualizado en la consola
		console.log($scope.empleadosAgregados);
		// console.log("codigo",empleados.codigo);
		// console.log("nombre",nombreC);
	};

	$scope.eliminar = function(i){
		$scope.empleadosAgregados.splice(i, 1);
		// $scope.productosAgregados.splice(i, 1);
		console.log($scope.empleadosAgregados);
	}

	// $scope.agregarEmpleado=function(codigoempleado, nombreC){

		
		// console.log('codigo', codigoempleado);
		// console.log('nombre', nombreC);
		// empleadoCompleto =  codigoempleado + nombreC;
		// // empleadoCompleto = empleados;
		// console.log('nombre', empleados);
		// const agregarEmpleado = document.getElementById('agregarEmpleado');

		// // Agrega un evento de clic al botón
		// agregarEmpleado.addEventListener('click', function() {
		// 	// Obtiene el dato que deseas agregar (puedes obtenerlo de un input u otra fuente de datos)
		// 	const empleadoCompleto = empleados; // Cambia esto con el dato que deseas agregar
			
		// 	// Agrega el nuevo dato al array
		// 	empleados.push(empleadoCompleto);
			
		// 	// Imprime el array actualizado en la consola
		// 	console.log(empleados);
		// });


	// }

// Selecciona el botón por su ID


		
	
	
		
});