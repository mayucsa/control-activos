app.controller('vistaAsignacion', function (BASEURL, ID, $scope, $http) {
	$scope.codigo = '';
	$scope.nombre = '';
	$scope.empleados= "";
	$scope.btneg = "";
	$scope.valueEmpleado="";
	// $scope.valueEmpleado="B";

	// agregarEquipo
	

	$scope.nombreEmpleado = '';

	$scope.arrayAgregados = [];
	var arrayEquipoGuardado = $scope.arrayAgregados;
	 
	$scope.productosAgregados = [];
	$scope.equiposAgregados = [];
	
	  
	function contarElementos(array) {
		return array.length;
	}
	$scope.botonesHabilitados = {}; // Un objeto para mantener el estado de los botones
	$scope.valor=function(){
		$scope.value="B"
		console.log('codigo', $scope.value);
	}
	$scope.agregar = function(){
		if ($scope.empleados == false) {
			$scope.empleados = true
			$scope.grupos = true
		}else{
			$scope.empleados = false
			$scope.grupos = false
		}
	}
	$scope.agregari = function(){
		console.log('valor', $scope.btneg);
	}

// este si va
// se utiliza para crear un array con el nombre y codigo de empleado
	$scope.agregarEmpleado = function(codigoempleado, nombre) {
		console.log('codigo', codigoempleado);
		console.log('nombre', nombre);
		
		codigoempleado=codigoempleado;
		empleado =  codigoempleado + ' - ' + nombre;
		$scope.nombreEmpleado = empleado;
		$scope.valueEmpleado="A"
		console.log('valor', $scope.valueEmpleado);
	}

	// este si va
	$scope.quitaremplado = function(){
		$scope.nombreEmpleado = '';
	}
// hace lo mismo que el fragmento de arriba pero con los grupos
	$scope.agregarGrupo = function(cve_grupo, nombre_gpo) {
		// console.log('valor boton', value);
		console.log('codigo', cve_grupo);
		console.log('nombre', nombre_gpo);
		codigoGrupo=cve_grupo;
		empleado =  codigoGrupo + ' - ' + nombre_gpo;
		$scope.nombreEmpleado = empleado;
		$scope.valueEmpleado="B"
		console.log('valor', $scope.valueEmpleado);

	}

	// este si va
	$scope.quitarGrupo = function(){
		$scope.nombreEmpleado = '';
	}


// este si va
	$scope.agregarEquipo = function(i) {
		if ($scope.nombreEmpleado == '' || $scope.nombreEmpleado == null) {
			Swal.fire(
			  '',
			  'Elija primero el empleado a asignar los equipos',
			  'warning'
			)
		}else{
			if ($scope.arrayAgregados.indexOf($scope.arrayEquipos[i].cve_cequipo) < 0) {
				$scope.productosAgregados.push({
					'nombre_equipo': $scope.arrayEquipos[i].nombre_equipo,
					'folio': $scope.arrayEquipos[i].folio,
					'marca': $scope.arrayEquipos[i].marca,
					'modelo': $scope.arrayEquipos[i].modelo,
					
				});
				$scope.arrayAgregados.push($scope.arrayEquipos[i].cve_cequipo)
			}else{
				Swal.fire(
				  '',
				  'Equipo elegido previamente',
				  'warning'
				)
			} console.log("este es un array agregado",$scope.arrayAgregados)
		}
	}
	// se encuentra en el botón de quitar
// esta función se encuentra en el div que aparece una vez que escoges al empleado y al producto

	$scope.eliminarEquipoAgregado = function(i){
		console.log("codigo",$scope.arrayAgregados);
		console.log("todo",$scope.productosAgregados);

		Swal.fire({
		  title: 'Eliminar Equipo',
		  text: '¿Realmente deseas eliminar '+$scope.productosAgregados[i].nombre_equipo+'?',
		  icon: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Eliminar',
		  cancelButtonText: 'Cancelar'
		}).then((result) => {
		  if (result.isConfirmed) {
			$scope.quitarProducto(i);
			// $scope.$apply(function(){
			// 	$scope.quitarProducto(i);
			// }, 2000)
		    
		  }
		});
	}

	// esta función quita el producto que queremos guardar
	// se puede ver en la tabla de asignación
	$scope.quitarProducto = function(i){
		// console.log(quitarProducto);
		// console.log(arrayAgregados);
		// $scope.arrayAgregados.splice(i, 1);
		$scope.productosAgregados.splice(i, 1);
		$scope.arrayAgregados.splice(i, 1);
		$scope.$apply();
	}

	// $scope.limpiarCampos = function(){
	// 	$scope.codigo = '';
	// 	$scope.nombre = '';
	// }

	// trae los codigos de los equipos
	$scope.getEquipos = function(){
		$http.post('Controller.php', {
			'task': 'getCaracteristicas'
		}).then(function(response) {
			response = response.data;
			console.log('getCaracteristicas', response);
			$scope.arrayEquipos = response;
			setTimeout(function(){
				$('#tablaProducto').DataTable({
					"paging": false,
					"bScrollCollapse": true,
					"sScrollY": '200px',
					// "processing": true,
					// "bDestroy": true,
					// "order": [1, 'desc'],
					// "lengthMenu": [[15, 30, 45], [15, 30, 45]],
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
			},1000);
		}, function(error){
			console.log('error', error);
		});
	}
	$scope.getEquipos();

	// tabla para traer los datos del empleado
	// $scope.getEmpleados = function(){
		
		$http.post('Controller.php', {
			'task': 'getEmpleado'
		}).then(function(response) {
			response = response.data;
			console.log('getEmpleado', response);
			$scope.empleado = response;
			setTimeout(function(){
				$('#tablaEmpleado').DataTable({
					"paging": false,
					"bScrollCollapse": true,
					"sScrollY": '200px',
					// "scrollX" '50px'
					// "processing": true,
					// "bDestroy": true,
					// "order": [2, 'desc'],
					// "lengthMenu": [[5, 20, 30], [5, 20, 30]],
					"language": {
						"lengthMenu": "Mostrar _MENU_ registros por página.",
						"zeroRecords": "No se encontró registro.",
						"info": "  _START_ de _END_ (_TOTAL_ registros totales).",
						"infoEmpty": "0 de 0 de 0 registros",
						"infoFiltered": "(Encontrado de _MAX_ registros)",
						"search": "Buscar: ",
						"processing": "Procesando...",
						// 		"paginate": {
						// 	"first": "Primero",
						// 	"previous": "Anterior",
						// 	"next": "Siguiente",
						// 	"last": "Último"
						// }

					}
				});
			},1000);
		}, function(error){
			console.log('error', error);
		});
		
	// }
	// este linea llama a la funcion para que muestre todos los empleados
	// $scope.getEmpleados();
	

	// $scope.validaEquipo = function () {

	// 	$http.post('Controller.php', {
	// 		'task': 'getMarca',
	// 		'nombre': $scope.nombre
			
	// 	}).then(function (response){
	// 		response = response.data;
	// 		console.log(getMarca);
	// 		// // console.log('getMarca', response[0].marca);
	// 		// console.log('getPresentacion', response[0].presentacion);
	// 		$scope.marca = response[0].marca;
	// 		$scope.modelo = response[0].modelo;
	// 		$scope.descripcion = response[0].descripcion;
	// 	}, function(error){
	// 		console.log('error', error);
	// 	})

	// }

	// este trae los datos de los grupos
	$http.post('Controller.php', {
		'task': 'getGrupos'
	}).then(function(response)	{
		response = response.data;
		console.log('getGrupos', response);
		$scope.gruposVer = response;
		setTimeout(function(){
			$('#tablaGrupos').DataTable({
				"paging": false,
				"bScrollCollapse": true,
				"sScrollY": '200px',
				// "scrollX" '50px'
				// "processing": true,
				// "bDestroy": true,
				// "order": [2, 'desc'],
				// "lengthMenu": [[5, 20, 30], [5, 20, 30]],
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

		
	



// 123jas12
// era para validar si un equipo está asigando, no se puede porque tengo un evento que también está funcionando
	$scope.GuardarAsignacion = function( ){
		// la linea de codigo de abajo, 
		// toma un valor del array y lo guarda en mi array codigoempleado
		// este valor, comienza en la primera posición (0) hasta que encuentre un guión
		var codigoempleado  = empleado.substring(0, empleado.indexOf(' - '));
		console.log("este es una pruea para btener el numero del equipo",arrayEquipoGuardado)
		console.log("este es el codigo del empleado",$scope.arrayAgregados)
		$scope.valueEmpleado
		console.log("valor", $scope.valueEmpleado)
		
		if ($scope.nombreEmpleado=='' || $scope.nombreEmpleado==null){
			Swal.fire(
				'Campo faltante',
				'Es necesario seleccionar al empleado',
				'warning'
			  );
			  return;
		}
		if ($scope.arrayAgregados.length === 0) {
			Swal.fire(
			  'Campo faltante',
			  'Es necesario seleccionar al menos un producto',
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
					'task': 'guardarAsignacion',
					'id': ID,
					'codigoempleado': codigoempleado,
                    'arrayEquipoGuardado': $scope.arrayAgregados,
					'valor': $scope.valueEmpleado,
					
					
				}
				).then(function(response){
					response = response.data;
					if (response.code == 400) {
						Swal.fire({
							// confirmButtonColor: '#3085d6',
							title: 'Equipo existente',
							html: response.msj,
							confirmButtonColor: '#1A4672'
							});
							jsRemoveWindowLoad();
							// $scope.nombre = '';
					}else{	// console.log('response', response);
						jsRemoveWindowLoad();
						// if (response.code == 200) {
							Swal.fire({
							title: '¡Éxito!',
							html: 'Su captura de equipo nuevo se generó correctamente. ',
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
							});}
					
					// // }else{
					// 	alert('Error en controlador. \nFavor de ponerse en contacto con el administrador del sitio.');
					// }
				}, function(error){
					console.log('error', error);
					jsRemoveWindowLoad();
				})
			}
		})
	}


	// $scope.eliminarAsignacion = function (cve_cequipo) {

	// 	Swal.fire({
	// 		title: 'Estás a punto de eliminar esta asignación.',
	// 		text: '¿Es correcta la información agregada?',
	// 		icon: 'warning',
	// 		showCancelButton: true,
	// 		confirmButtonColor: 'green',
	// 		cancelButtonColor: 'red',
	// 		confirmButtonText: 'Aceptar',
	// 		cancelButtonText: 'Cancelar'
	// 	}).then((result) => {
	// 		if (result.isConfirmed) {
	// 			jsShowWindowLoad('Capturando caracteristicas...');
				
	// 			$http.post('Controller.php', {
	// 				'task': 'eliminarAsignacion',
	// 				'id': ID,
	// 				'nombreEliminar': cve_cequipo
	// 			}).then(function(response){
	// 				response = response.data;
	// 				// console.log('response', response);
	// 				jsRemoveWindowLoad();
	// 				if (response.code == 200) {
	// 					Swal.fire({
	// 					  title: '¡Éxito!',
	// 					  html: 'Su asignación de equipo se generó correctamente',
	// 					  icon: 'success',
	// 					  showCancelButton: false,
	// 					  confirmButtonColor: 'green',
	// 					  confirmButtonText: 'Aceptar'
	// 					}).then((result) => {
	// 					  if (result.isConfirmed) {
	// 						  location.reload();
	// 					  }else{
	// 						  location.reload();
	// 					  }
	// 					});
	// 				}else{
	// 					alert('Error en controlador. \nFavor de ponerse en contacto con el administrador del sitio.');
	// 				}
	// 			}, function(error){
	// 				console.log('error', error);
	// 				jsRemoveWindowLoad();
	// 			})
	// 		}
	// 	});

	// }

	// $scope.verEquipo=function(marca, modelo, descripcion, numero_factura, numero_serie, sistema_operativo, procesador, vel_procesador, memoria_ram, tipo_almacenamiento, capacidad_almacenamiento){
		// $http.post('Controller.php', {
		// 	'task': 'getMarca'
		// }).then(function (response){
		// 	response = response.data;
		// 	console.log('getCaracteristicas', response);
		// 	$scope.caracteristicas = response;
		// },function(error){
		// 	console.log('error', error);
		// 	console.log('error', caracteristicas.marca);
		// 	console.log('error', caracteristicas.modelo);
		// });
		// $scope.verNumeroE = cve_cequipo;
		// $scope.verEquipo = nombre_equipo;
		// $scope.verMarca = marca;
		// $scope.verModelo=modelo;
		// $scope.verDescripcion = descripcion;
		// $scope.verNumeroSerie = numero_serie;
		// $scope.verNumeroFactura= numero_factura;
		// $scope.verFactura=numero_factura;
		
		// $scope.verSistemaOperativo = sistema_operativo;
		// $scope.verProcesador = procesador;
		// $scope.verVelocidadProcesador=vel_procesador;
		// $scope.verMemoriaRam = memoria_ram;
		// $scope.verTipoAlmacenamiento = tipo_almacenamiento;
		// $scope.verCapaAlmacenamiento=capacidad_almacenamiento;
		// $scope.verRegistro=fecha_ingreso;

	// }

	// $scope.consultar = function (cve_asignacion ,nombrecompleto) {
	// 	// $scope.numero=cve_equipo;
	// 	$scope.numeroAsignacion = cve_asignacion;
	// 	$scope.nombreEmpleado = nombrecompleto;
	// }
	// $scope.consultarEliminar = function (cve_asignacion) {
	// 	// $scope.numero=cve_equipo;
	// 	$scope.nombreEliminar = cve_asignacion;
	// }
	
});