app.controller('vistaAsignacion', function (BASEURL, ID, $scope, $http) {
	$scope.codigo = '';
	$scope.nombre = '';

	$scope.nombreEmpleado = '';

	$scope.arrayAgregados = [];
	var arrayEquipoGuardado = $scope.arrayAgregados;
	// var miBoton = document.getElementById('miBoton');

	// var relacionArray = {
	var	listaEmpleado= []
	var	listaEquipo=[]
	var	listaFolio= []
	//  
	$scope.productosAgregados = [];
	$scope.equiposAgregados = [];
	  
	function contarElementos(array) {
		return array.length;
	}
	$scope.botonesHabilitados = {}; // Un objeto para mantener el estado de los botones

	// let cantidadAlmacenada  = contarElementos(relacionArray[listaEmpleado]);
	// console.log('La cantidadAlmacenada de elementos en el array es:', cantidadAlmacenada);
	
	// $scope.agregarEmpleado = function(codigoempleado, nombre) {
	// 	if (cantidadAlmacenada === 0) {
	// 		listaEmpleado = [codigoempleado];
	// 		$scope.nombreEmpleado=nombre;
	// 	} 
	// 	else{
	// 		Swal.fire({
	// 			title: 'Cambio de empleado.',
	// 			text: '¿Estas seguro que deseas reemplazar al empleado?',
	// 			icon: 'warning',
	// 			showCancelButton: true,
	// 			confirmButtonColor: 'green',
	// 			cancelButtonColor: 'red',
	// 			confirmButtonText: 'Aceptar',
	// 			cancelButtonText: 'Cancelar'
	// 		}).then((result )=> {
				
	// 			if (result.isConfirmed) {
	// 				var empleadoExistente = listaEmpleado.find(function(empleado) {
	// 					return empleado === codigoempleado; });
					
	// 				if (codigoempleado/=listaEmpleado){
	// 					listaEmpleado = [codigoempleado];
	// 				}
	// 			}else {return listaEmpleado}
	// 		})
			
	// 	}
		
	// 	console.log('esto esta en mi array de empleado', listaEmpleado);
		
	// 	// Utiliza la función contarElementos para verificar la cantidad almacenada
	// 	var cantidadAlmacenada = contarElementos(listaEmpleado);
	
	// 	if (cantidadAlmacenada === 0) {
	// 		listaEmpleado = [codigoempleado];
	// 	} 
		
	// 	// console.log('esto es el array empleado', relacionArray.listaEmpleado);
	// 	// console.log('esto es el array equipo', relacionArray.listaEquipo);
	// }
	$scope.agregarEmpleadolow = function(codigoempleado, nombre) {
		
		// console.log('esto esta en mi array de empleado', listaEmpleado);
	
		// Busca si el empleado ya existe en el array
		var empleadoExistente = listaEmpleado.find(function(empleado) {
			return empleado !== codigoempleado;
		});
	
		if (empleadoExistente) {
			Swal.fire({
				title: 'Cambio de empleado.',
				text: '¿Estás seguro que deseas reemplazar al empleado?',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: 'green',
				cancelButtonColor: 'red',
				confirmButtonText: 'Aceptar',
				cancelButtonText: 'Cancelar'
			}).then((result) => {
	
				if (result.isConfirmed) {
					$scope.nombreEmpleado = nombre;
					// Si el empleado ya existe, reemplázalo
					var indice = listaEmpleado.indexOf(empleadoExistente);
					if (indice !== -1) {
						listaEmpleado[indice] = codigoempleado;
						$scope.nombreEmpleado = nombre;
					}
				} else {
					return listaEmpleado;
					// return $scope.nombreEmpleado = nombre;
				}
			})
		} 
		else {
			// Si el empleado no existe, agrégalo
			listaEmpleado = [codigoempleado];
			$scope.nombreEmpleado = nombre;
		}
		console.log('esto es el array empleado', listaEmpleado);
	}
	$scope.agregarEmpleado = function(codigoempleado, nombre) {
		console.log('codigo', codigoempleado);
		console.log('nombre', nombre);
		codigoempleado=codigoempleado;
		empleado =  codigoempleado + ' - ' + nombre;
		$scope.nombreEmpleado = empleado;
	}
	$scope.quitaremplado = function(){
		$scope.nombreEmpleado = '';
	}
	

	function actualizarTablaEquiposAgregados() {
		// Puedes utilizar $scope.equiposAgregados para actualizar la tabla en la vista
		// Por ejemplo, puedes generar dinámicamente filas HTML y agregarlas a la tabla
		var tablaEquiposAgregados = document.getElementById('tablaEquiposAgregados');
		tablaEquiposAgregados.innerHTML = ''; // Borra el contenido actual de la tabla
	
		// Itera sobre los equipos agregados y crea filas para la tabla
		$scope.equiposAgregados.forEach(function (equipo) {
			var fila = '<tr><td>' + equipo.folio + '</td></tr>';
			tablaEquiposAgregados.innerHTML += fila;
		});
	}

	$scope.agregarEquipoLow = function(cve_cequipo, folio) {
		// $scope.equipoEmpleado=listaFolio;
		// Verifica si el botón ya está deshabilitado
		if (!$scope.botonesHabilitados[cve_cequipo]) {
			// Deshabilita el botón
			$scope.botonesHabilitados[cve_cequipo] = true;
			var equipoExistente = $scope.equiposAgregados.find(function (equipo) {
				return equipo.cve_cequipo === cve_cequipo;
			});
	
			if (!equipoExistente) {
				// Agrega el equipo a la lista de equipos agregados
				$scope.equiposAgregados.push({
					// cve_cequipo: cve_cequipo,
					folio: folio
				});
	
				// Aquí puedes realizar cualquier otra lógica que necesites
	
				// Por ejemplo, puedes mostrar los equipos en una tabla en la vista
				// Actualiza la tabla de equipos agregados en la vista
				actualizarTablaEquiposAgregados();
			}
	
			// Tu lógica para agregar el equipo aquí
			console.log('este es el botón', cve_cequipo);
			
				
	
			var cantidadAlmacenada = contarElementos(listaEquipo);
	
			if (cantidadAlmacenada === 0) {
				listaEquipo = [cve_cequipo];
				// relacionArray.listaEquipo = [folio];
			} else {
				listaEquipo.push(cve_cequipo);
				// relacionArray.listaEquipo.push(folio);
			}
			// if (folio) {
			var cantidadAlmacenada = contarElementos(listaFolio);
	
			if (cantidadAlmacenada === 0) {
				listaFolio = [folio];
				// relacionArray.listaFolio = [folio];
			} else {
				listaFolio.push(folio);
				// relacionArray.listaFolio.push(folio);
			}
	
			console.log('esto es el array de folio', listaFolio);
			console.log('esto es el array de equipo', listaEquipo);
			console.log('esto es el array de empleado', listaEmpleado);
		}
	};

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
	$scope.eliminarEquipoAgregado = function(i){
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
			$scope.$apply(function(){
				$scope.quitarProducto(i);
			}, 2000)
		    
		  }
		});
	}
	$scope.quitarProducto = function(i){
		$scope.arrayAgregados.splice(i, 1);
		$scope.productosAgregados.splice(i, 1);
	}

	$scope.limpiarCampos = function(){
		$scope.codigo = '';
		$scope.nombre = '';
	}

	$scope.getEquipos = function(){
	// para mostrar el folio de los equipos
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

	$scope.getEmpleados = function(){
		// tabla para traer los datos del empleado
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
	$scope.getEmpleados();

	$scope.validaEquipo = function () {

		$http.post('Controller.php', {
			'task': 'getMarca',
			'nombre': $scope.nombre
		}).then(function (response){
			response = response.data;
			// // console.log('getMarca', response[0].marca);
			// console.log('getPresentacion', response[0].presentacion);
			$scope.marca = response[0].marca;
			$scope.modelo = response[0].modelo;
			$scope.descripcion = response[0].descripcion;
		}, function(error){
			console.log('error', error);
		})

	}



// 123jas12
// era para validar si un equipo está asigando, no se puede porque tengo un evento que también está funcionando
	$scope.GuardarAsignacion = function( ){
		var codigoempleado = empleado.substring(0, empleado.indexOf(' - '));
		console.log("este es una pruea para btener el numero del equipo",arrayEquipoGuardado)
		console.log("este es el codigo del empleado",$scope.arrayAgregados)
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


	$scope.eliminarAsignacion = function (cve_cequipo) {

		Swal.fire({
			title: 'Estás a punto de eliminar esta asignación.',
			text: '¿Es correcta la información agregada?',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: 'green',
			cancelButtonColor: 'red',
			confirmButtonText: 'Aceptar',
			cancelButtonText: 'Cancelar'
		}).then((result) => {
			if (result.isConfirmed) {
				jsShowWindowLoad('Capturando caracteristicas...');
				
				$http.post('Controller.php', {
					'task': 'eliminarAsignacion',
					'id': ID,
					'nombreEliminar': cve_cequipo
				}).then(function(response){
					response = response.data;
					// console.log('response', response);
					jsRemoveWindowLoad();
					if (response.code == 200) {
						Swal.fire({
						  title: '¡Éxito!',
						  html: 'Su asignación de equipo se generó correctamente',
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
		});

	}
	$scope.verEquipo=function(marca, modelo, descripcion, numero_factura, numero_serie, sistema_operativo, procesador, vel_procesador, memoria_ram, tipo_almacenamiento, capacidad_almacenamiento){
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
		$scope.verMarca = marca;
		$scope.verModelo=modelo;
		$scope.verDescripcion = descripcion;
		$scope.verNumeroSerie = numero_serie;
		$scope.verNumeroFactura= numero_factura;
		// $scope.verFactura=numero_factura;
		
		$scope.verSistemaOperativo = sistema_operativo;
		$scope.verProcesador = procesador;
		$scope.verVelocidadProcesador=vel_procesador;
		$scope.verMemoriaRam = memoria_ram;
		$scope.verTipoAlmacenamiento = tipo_almacenamiento;
		$scope.verCapaAlmacenamiento=capacidad_almacenamiento;
		// $scope.verRegistro=fecha_ingreso;

	}

	$scope.consultar = function (cve_asignacion ,nombrecompleto) {
		// $scope.numero=cve_equipo;
		$scope.numeroAsignacion = cve_asignacion;
		$scope.nombreEmpleado = nombrecompleto;
	}
	$scope.consultarEliminar = function (cve_asignacion) {
		// $scope.numero=cve_equipo;
		$scope.nombreEliminar = cve_asignacion;
	}
	// $http.post('Controller.php', {
	// 	'task': 'getEquipos'
	// }).then(function (response){
	// 	response = response.data;
	// 	console.log('getEquipos', response);
	// 	$scope.equipo = response;
	// },function(error){
	// 	console.log('error', error);
	// });


// seleccionamos al empleado y nos muestra la clave y su nombre
	// $http.post('Controller.php', {
	// 	'task': 'getEmpleado'
	// }).then(function (response){
	// 	response = response.data;
	// 	console.log('getEmpleado', response);
	// 	$scope.empleado = response;
	// },function(error){
	// 	console.log('error', error);
	// });


	// para ver la marca, modelo y descripción al seleccionar un producto
// 	$http.post('Controller.php', {
// 		'task': 'getCaracteristicas'
// 	}).then(function (response){
// 		response = response.data;
// 		console.log('getCaracteristicas', response);
// 		$scope.caracteristicas = response;
// 	},function(error){
// 		console.log('error', error);
// 	});
});