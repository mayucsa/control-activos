app.controller('vistaCaracteristicasEquipos', function (BASEURL, ID, $scope, $http) {
	$scope.marca = '';
	$scope.modelo = '';
    $scope.descripcion = '';
	$scope.numeroserie = '';
	$scope.nombreProveedor = '';
    $scope.numerofactura = '';
	$scope.fechaFactura = '';
	$scope.sistemaoperativo = '';
    $scope.procesador = '';
	$scope.velocidadprocesador = '';
    $scope.memoriaram = '';
	$scope.tipoalmacenamiento = '';
    $scope.capaalmacenamiento = '';
	$scope.cambioFechaFactura = new Date(); // o inicializa con una fecha válida


	$scope.limpiarCampos = function(){
		$scope.nombre = '';
		$scope.marca = '';
        $scope.modelo = '';
        $scope.descripcion = '';
        $scope.numeroserie = ''; 
		$scope.nombreProveedor = '';
        $scope.numerofactura = '';
		$scope.fechaFactura = '';
        $scope.sistemaoperativo = '';
        $scope.procesador = '';
        $scope.velocidadprocesador = '';
        $scope.memoriaram = '';
        $scope.tipoalmacenamiento = '';
        $scope.capaalmacenamiento = '';
	}
	$scope.scanner = function(cve){
		// console.log('cve', cve);
		$http.post('Controller.php', {
			'task': 'scanner',
			'cve': cve
		}).then(function(response){
			// jsShowWindowLoad('Generando codigo de barras...');
			console.log('codigo', response.data.folio);
			response = response.data;
			const imgBarCode = '<img class="codigo" id="imgcodigo" />';
        	$('#modalBarCode').html(imgBarCode);
        	// actualizar el data-value de la imagen
        	JsBarcode("#imgcodigo", response['folio']);

		}, function(error){
			console.log('error', error);
			jsRemoveWindowLoad();
		});
	}

	$scope.validame = function(){
		console.log('nombre', $scope.nombre)
	}

	$scope.validacionCampos = function(){
		console.log("proveedor", $scope.nombreProveedor)
		console.log("proveedor", $scope.fechaFactura)
		$http.post('Controller.php', {
			'task': 'ValidaQueEquipoEs',
			'cve_equipo': $scope.nombre
		}).then(function(response){
			response = response.data;
			if (response.code == 400) {
				if ($scope.nombre == '' || $scope.nombre == null) {
					Swal.fire(
						'Campo faltante',
						'Es necesario indicar un equipo',
						'warning'
						);
						return;
				}if ($scope.marca == '' || $scope.marca == null) {
					Swal.fire(
						'Campo faltante',
						'Es necesario indicar una marca',
						'warning'
						);
						return;
				}if ($scope.modelo == '' || $scope.modelo == null) {
					Swal.fire(
						'Campo faltante',
						'Es necesario indicar un modelo',
						'warning'
						);
						return;
				}if ($scope.numeroserie == '' || $scope.numeroserie == null) {
					Swal.fire(
						'Campo faltante',
						'Es necesario indicar un número de serie',
						'warning'
						);
						return;
				}if ($scope.nombreProveedor == '' || $scope.nombreProveedor == null) {
					Swal.fire(
						'Campo faltante',
						'Es necesario indicar el proveedor',
						'warning'
						);
						return;
				}if ($scope.numerofactura == '' || $scope.numerofactura == null) {
					Swal.fire(
						'Campo faltante',
						'Es necesario indicar el número de factura',
						'warning'
						);
						return;
				}if ($scope.fechaFactura == '' || $scope.fechaFactura == null) {
					Swal.fire(
						'Campo faltante',
						'Es necesario indicar la fecha de factura',
						'warning'
						);
						return;
				}if ($scope.sistemaoperativo == '' || $scope.sistemaoperativo == null) {
					Swal.fire(
						'Campo faltante',
						'Es necesario indicar el sistema operativo',
						'warning'
						);
						return;
				}if ($scope.procesador == '' || $scope.procesador == null) {
					Swal.fire(
						'Campo faltante',
						'Es necesario indicar el procesador',
						'warning'
						);
						return;
				}if ($scope.velocidadprocesador == '' || $scope.velocidadprocesador == null) {
					Swal.fire(
						'Campo faltante',
						'Es necesario indicar la velocidad del procesador',
						'warning'
						);
						return;
				}if ($scope.memoriaram == '' || $scope.memoriaram == null) {
					Swal.fire(
						'Campo faltante',
						'Es necesario indicar la cantidad de memoria ram',
						'warning'
						);
						return;
				}if ($scope.tipoalmacenamiento == '' || $scope.tipoalmacenamiento == null) {
					Swal.fire(
						'Campo faltante',
						'Es necesario indicar el tipo de almacenamiento',
						'warning'
						);
						return;
				}if ($scope.capaalmacenamiento == '' || $scope.capaalmacenamiento == null) {
					Swal.fire(
						'Campo faltante',
						'Es necesario indicar la capacidad de almacenamiento',
						'warning'
						);
						return;
				}
				if ($scope.descripcion == '') {
					$scope.descripción = '';
				}
				Swal.fire({
					title: 'Estás a punto de dar de alta un equipo.',
					text: '¿Es correcta la información agregada?',
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: 'green',
					cancelButtonColor: 'red',
					confirmButtonText: 'Aceptar',
					cancelButtonText: 'Cancelar'
				}).then((result )=> {
					if (result.isConfirmed) {
						jsShowWindowLoad('Capturando caracteristicas...');
						$http.post('Controller.php', {
							'task': 'guardarCaracteristicas',
							'id': ID,
							'nombre': $scope.nombre,
							'marca': $scope.marca,
							'modelo': $scope.modelo,
							'descripcion': $scope.descripcion,
							'numeroserie': $scope.numeroserie,
							'numerofactura': $scope.numerofactura,
							'sistemaoperativo': $scope.sistemaoperativo,
							'procesador': $scope.procesador,
							'velocidadprocesador': $scope.velocidadprocesador,
							'memoriaram': $scope.memoriaram,
							'tipoalmacenamiento': $scope.tipoalmacenamiento,
							'capaalmacenamiento': $scope.capaalmacenamiento,
							'proveedor':$scope.nombreProveedor,
							'fechafactura':$scope.fechaFactura,
							// 	NXR62413FD

						}).then(function(response){
							response = response.data;
							console.log("proveedor", $scope.nombreProveedor)
							console.log("proveedor", $scope.fechaFactura)
							// console.log('response', response);
							jsRemoveWindowLoad();
							if (response.code == 200) {
								Swal.fire({
								  title: '¡Éxito!',
								  html: 'Su captura de equipo nuevo se generó correctamente.',
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
			}else{
				if ($scope.nombre == '' || $scope.nombre == null) {
					Swal.fire(
						'Campo faltante',
						'Es necesario indicar un equipo',
						'warning'
						);
						return;
				}if ($scope.marca == '' || $scope.marca == null) {
					Swal.fire(
						'Campo faltante',
						'Es necesario indicar una marca',
						'warning'
						);
						return;
				}if ($scope.modelo == '' || $scope.modelo == null) {
					Swal.fire(
						'Campo faltante',
						'Es necesario indicar un modelo',
						'warning'
						);
						return;
				}if ($scope.numeroserie == '' || $scope.numeroserie == null) {
					Swal.fire(
						'Campo faltante',
						'Es necesario indicar un número de serie',
						'warning'
						);
						return;
				}if ($scope.nombreProveedor == '' || $scope.nombreProveedor == null) {
					Swal.fire(
						'Campo faltante',
						'Es necesario indicar el proveedor',
						'warning'
						);
						return;
				}if ($scope.numerofactura == '' || $scope.numerofactura == null) {
					Swal.fire(
						'Campo faltante',
						'Es necesario indicar el número de factura',
						'warning'
						);
						return;
				}if ($scope.fechaFactura == '' || $scope.fechaFactura == null) {
					Swal.fire(
						'Campo faltante',
						'Es necesario indicar la fecha de factura',
						'warning'
						);
						return;
				}
				if ($scope.descripcion == '') {
					$scope.descripción = '';
				}
				Swal.fire({
					title: 'Estás a punto de dar de alta un equipo.',
					text: '¿Es correcta la información agregada?',
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: 'green',
					cancelButtonColor: 'red',
					confirmButtonText: 'Aceptar',
					cancelButtonText: 'Cancelar'
				}).then((result )=> {
					if (result.isConfirmed) {
						jsShowWindowLoad('Capturando caracteristicas...');
						$http.post('Controller.php', {
							'task': 'guardarCaracteristicas',
							'id': ID,
							'nombre': $scope.nombre,
							'marca': $scope.marca,
							'modelo': $scope.modelo,
							'descripcion': $scope.descripcion,
							'numeroserie': $scope.numeroserie,
							'numerofactura': $scope.numerofactura,
							'sistemaoperativo': $scope.sistemaoperativo,
							'procesador': $scope.procesador,
							'velocidadprocesador': $scope.velocidadprocesador,
							'memoriaram': $scope.memoriaram,
							'tipoalmacenamiento': $scope.tipoalmacenamiento,
							'capaalmacenamiento': $scope.capaalmacenamiento,
							'proveedor':$scope.nombreProveedor,
							'fechafactura':$scope.fechaFactura,

						}).then(function(response){
							response = response.data;
							// console.log('response', response);
							jsRemoveWindowLoad();
							if (response.code == 200) {
								Swal.fire({
								  title: '¡Éxito!',
								  html: 'Su captura de equipo nuevo se generó correctamente.',
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
		}, function(error){
			console.log('error', error);
			jsRemoveWindowLoad();
		});


		// if ($scope.nombre == '' || $scope.nombre == null) {
		// 		Swal.fire(
		// 		'Campo faltante',
		// 		'Es necesario indicar un equipo',
		// 		'warning'
		// 		);
		// 		return;
		// 	}else{
		// 		if($scope.nombre == '' || $scope.nombre == null,
		// 		$scope.marca == '' || $scope.marca == null, 
		// 		$scope.modelo == '' || $scope.modelo == null,
		// 		$scope.descripcion == '' || $scope.descripcion == null,
		// 		$scope.numeroserie == '' || $scope.numeroserie == null,
		// 		$scope.numerofactura == '' || $scope.numerofactura == null)				
		// 		{
		// 			Swal.fire(
		// 			'Campo faltante',
		// 			'Es necesario llenar todos los campos',
		// 			'warning'
		// 			);
		// 			return;
		// 		}
		// 	}

	}
// Validar si no un producto igual en la base de datos
	$scope.validaSerie = function (numeroserie, cambiaNumeroserie) {
		// console.log('nombre:', numeroserie);
		$http.post('Controller.php', {
			'task': 'validacionSerie',
			'numeroserie': numeroserie,
			'numeroserie:': cambiaNumeroserie,
			'id': ID
		}).then(function (response){
			response = response.data;
			
			if (response.code == 400) {
				Swal.fire({
					// confirmButtonColor: '#3085d6',
					title: 'Número de serie registrado',
					html: response.msj,
					confirmButtonColor: '#1A4672'
					});
					$scope.numeroserie = '';
					$scope.cambiaNumeroserie = '';
			}
		}, function(error){
			console.log('error', error);
		})

	}	

	// $scope.validaFactura = function (numerofactura) {
	// 	// console.log('nombre:', numeroserie);
	// 	$http.post('Controller.php', {
	// 		'task': 'validacionFactura',
	// 		'numerofactura': numerofactura,
	// 		'id': ID
	// 	}).then(function (response){
	// 		response = response.data;
			
	// 		if (response.code == 400) {
	// 			Swal.fire({
	// 				// confirmButtonColor: '#3085d6',
	// 				title: 'Número de factura registrado',
	// 				html: response.msj,
	// 				confirmButtonColor: '#1A4672'
	// 				});
	// 				$scope.numerofactura = '';
	// 		}
	// 	}, function(error){
	// 		console.log('error', error);
	// 	})

	// }	

	// $scope.validaFacturaModal = function (cambiaNumerofactura) {
	// 	// console.log('nombre:', numeroserie);
	// 	$http.post('Controller.php', {
	// 		'task': 'validacionFacturaModal',
	// 		'numerofactura': cambiaNumerofactura,
	// 		'id': ID
	// 	}).then(function (response){
	// 		response = response.data;
			
	// 		if (response.code == 400) {
	// 			Swal.fire({
	// 				// confirmButtonColor: '#3085d6',
	// 				title: 'Número de factura registrado',
	// 				html: response.msj,
	// 				confirmButtonColor: '#1A4672'
	// 				});
	// 				$scope.cambiaNumerofactura = '';
	// 		}
	// 	}, function(error){
	// 		console.log('error', error);
	// 	})

	// }	




	
	$scope.cambioCaracteristica = function () {
		console.log("proveedor", $scope.cambioProveedor)
		console.log("proveedor", $scope.cambioFechaFactura)

		$http.post('Controller.php', {
			'task': 'ValidaQueEquipoEs',
			'cve_equipo': $scope.numeroEquipo
		}).then(function(response){
			response = response.data;
			if (response.code == 400){
				Swal.fire({ 
					title: 'Estás a punto de editar la información de un equipo' ,
					text: '¿Es correcta la información agregada?',
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: 'green',
					cancelButtonColor: 'red',
					confirmButtonText: 'Aceptar',
					cancelButtonText: 'Cancelar'
				}).then((result) => {
					if (result.isConfirmed) {
						
						$http.post('Controller.php', {
							'task': 'editarCaracteristica',
							'id': ID, 
							'numeroEquipo':$scope.numeroEquipo,
							'nombre': $scope.verNombre,
							'marca': $scope.cambiaMarca,
							'modelo': $scope.cambiaModelo,
							'descripcion': $scope.cambiaDescripcion,
							'numeroserie': $scope.cambiaNumeroserie,
							'numerofactura': $scope.cambiaNumerofactura,
							'sistemaoperativo': $scope.cambiaSistemaoperativo,
							'procesador': $scope.cambiaProcesador,
							'velocidadprocesador': $scope.cambiaVelocidadprocesador,
							'memoriaram': $scope.cambiaMemoriaram,
							'tipoalmacenamiento': $scope.cambiaTipoalmacenamiento,
							'capaalmacenamiento': $scope.cambiaCapaalmacenamiento,
							'proveedor':$scope.cambioProveedor,
							'fechafactura':$scope.cambioFechaFactura,

							 
							'id': ID,
						}).then(function(response){
							response = response.data;
							// if (response.code == 400) {
							// 	Swal.fire({
							// 		// confirmButtonColor: '#3085d6',
							// 		title: 'Equipo existente',
							// 		html: response.msj,
							// 		confirmButtonColor: '#1A4672'
							// 		});
							// 		$scope.cambiaNumeroserie = '';}
							{
								jsShowWindowLoad('Generando entrada...');
								jsRemoveWindowLoad();
								Swal.fire({
									title: '¡Éxito!',
									html: 'Se editado el equipo'+ ' ' + $scope.verNombre +' ' + 'de manera correcta,<br> <b>Número de serie: ' + $scope.cambiaNumeroserie +'</b>',
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
								})
						
							}
						
						}, function(error){
							console.log('error', error);
							jsRemoveWindowLoad();
						})
					}
				});
				
			}else {Swal.fire({ 
				title: 'Estás a punto de editar la información de un equipo.',
				text: '¿Es correcta la información agregada?',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: 'green',
				cancelButtonColor: 'red',
				confirmButtonText: 'Aceptar',
				cancelButtonText: 'Cancelar'
			}).then((result) => {
				if (result.isConfirmed) {
					
					$http.post('Controller.php', {
						'task': 'editarCaracteristica',
						'id': ID,
						'numeroEquipo':$scope.numeroEquipo,
						'nombre': $scope.verNombre,
						'marca': $scope.cambiaMarca,
						'modelo': $scope.cambiaModelo,
						'descripcion': $scope.cambiaDescripcion,
						'numeroserie': $scope.cambiaNumeroserie,
						'numerofactura': $scope.cambiaNumerofactura,
						'numeroserie': $scope.cambiaNumeroserie,
						// 'numerofactura': $scope.cambiaNumerofactura,
						'sistemaoperativo': $scope.cambiaSistemaoperativo,
						'procesador': $scope.cambiaProcesador,
						'velocidadprocesador': $scope.cambiaVelocidadprocesador,
						'memoriaram': $scope.cambiaMemoriaram,
						'tipoalmacenamiento': $scope.cambiaTipoalmacenamiento,
						'capaalmacenamiento': $scope.cambiaCapaalmacenamiento,
						'proveedor':$scope.cambioProveedor,
						'fechafactura':$scope.cambioFechaFactura,

					}).then(function(response){
						response = response.data;
						// if (response.code == 400) {
						// 	Swal.fire({
						// 		// confirmButtonColor: '#3085d6',
						// 		title: 'Equipo existente',
						// 		html: response.msj,
						// 		confirmButtonColor: '#1A4672'
						// 		});
						// 		$scope.cambiaNumeroserie = '';}
						{
							jsShowWindowLoad('Generando entrada...');
							jsRemoveWindowLoad();
							Swal.fire({
								title: '¡Éxito!',
								html: 'Se editado el equipo'+ ' ' + $scope.verNombre +' ' + 'de manera correcta,<br> <b>Número de serie: ' + $scope.cambiaNumeroserie +'</b>',
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
							})
					
						}
					
					}, function(error){
						console.log('error', error);
						jsRemoveWindowLoad();
					})
				}
			});
		
		}
		})

	
		
// este trae los datos de los equipos en el modal de editar
	}
	$scope.consultar = function (cve_cequipo ,nombre_equipo, marca, modelo, descripcion, numero_serie, cve_proveedor, numero_factura, fecha_factura,sistema_operativo, procesador, vel_procesador, memoria_ram, tipo_almacenamiento,capacidad_almacenamiento) {
		// $scope.numero=cve_equipo;
		$scope.numeroEquipo = cve_cequipo;
		$scope.verNombre = nombre_equipo;
		$scope.cambiaMarca = marca;
		$scope.cambiaModelo=modelo;
		$scope.cambiaDescripcion = descripcion;
		$scope.cambiaNumeroserie = numero_serie;
		$scope.cambiaNumerofactura=numero_factura;
		$scope.cambiaSistemaoperativo = sistema_operativo;
		$scope.cambiaProcesador = procesador;
		$scope.cambiaVelocidadprocesador=vel_procesador;
		$scope.cambiaMemoriaram = memoria_ram;
		$scope.cambiaTipoalmacenamiento = tipo_almacenamiento;
		$scope.cambiaCapaalmacenamiento=capacidad_almacenamiento;
		$scope.cambioProveedor=cve_proveedor;
		$scope.cambioFechaFactura=null;
	
		}

		// esto trae los equipos en el modal de ver
		$scope.ver = function (cve_cequipo ,nombre_equipo, marca, modelo, descripcion, numero_serie, cve_proveedor, numero_factura, fecha_factura, sistema_operativo, procesador, vel_procesador, memoria_ram, tipo_almacenamiento, capacidad_almacenamiento, fecha_ingreso) {
			// $scope.numero=cve_equipo;
			$scope.verNumeroE = cve_cequipo;
			$scope.verEquipo = nombre_equipo;
			$scope.verMarca = marca;
			$scope.verModelo=modelo;
			$scope.verDescripcion = descripcion;
			$scope.verFactura= numero_factura;
			// $scope.verFactura=numero_factura;
			$scope.verSerie = numero_serie;
			$scope.verSistema = sistema_operativo;
			$scope.verProcesador = procesador;
			$scope.verVelocidad=vel_procesador;
			$scope.verRam = memoria_ram;
			$scope.verAlmacenamiento = tipo_almacenamiento;
			$scope.verCapacidad=capacidad_almacenamiento;
			$scope.verRegistro=fecha_ingreso;
			$scope.verNombreProveedor= cve_proveedor;
			$scope.verFechaFactura= fecha_factura;
		
			}

// se utiliza para desmarcar y poder escribir las areas si es compu o cpu
	$scope.habilitarProducto = function (nombre) {

		$http.post('Controller.php', {
			'task': 'ValidaQueEquipoEs',
			'cve_equipo': nombre
		}).then(function(response){
			response = response.data;
			if (response.code == 400) {
				$("#marca").attr("disabled", false);
				$("#modelo").attr("disabled", false);
				$("#descripcion ").attr("disabled", false);
				$("#numeroserie").attr("disabled", false);
				$("#numerofactura").attr("disabled", false);
				$("#sistemaoperativo").attr("disabled", false);
				$("#procesador").attr("disabled", false);
				$("#velocidadprocesador").attr("disabled", false);
				$("#memoriaram").attr("disabled", false);
				$("#tipoalmacenamiento").attr("disabled", false);
				$("#almacenamiento").attr("disabled", false);
			}else{
				$("#marca").attr("disabled", false);
				$("#modelo").attr("disabled", false);
				$("#descripcion ").attr("disabled", false);
				$("#numeroserie").attr("disabled", false);
				$("#numerofactura").attr("disabled", false);
				$("#sistemaoperativo").attr("disabled", true);
				$("#procesador").attr("disabled", true);
				$("#velocidadprocesador").attr("disabled", true);
				$("#memoriaram").attr("disabled", true);
				$("#tipoalmacenamiento").attr("disabled", true);
				$("#almacenamiento").attr("disabled", true);
			}
		}, function(error){
			console.log('error', error);
			jsRemoveWindowLoad();
		});
		

	}
// esta función se utiliza en la tabla para raer los datos
	$http.post('Controller.php', {
		'task': 'getVercaracteristicas'
	}).then(function(response) {
		response = response.data;
		console.log('getVercaracteristicas', response);
		$scope.vercaracteristicas = response;
		setTimeout(function(){
			$('#tablaEquipos').DataTable({
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


// se utiliza para seleccionar el producto 
	$http.post('Controller.php', {
		'task': 'getEquipos'
	}).then(function (response){
		response = response.data;
		console.log('getEquipos', response);
		$scope.equipo = response;
	},function(error){
		console.log('error', error);
	}); 

	// se utiliza para seleccionar el al proveedor 
	$http.post('Controller.php', {
		'task': 'getProveedor'
	}).then(function (response){
		response = response.data;
		console.log('getProveedor', response);
		$scope.proveedor = response;
	},function(error){
		console.log('error', error);
	}); 
	
});

function imprSelec(id) {
    var div = document.getElementById(id);
    var ventimp = window.open(' ', 'popimpr');
    ventimp.document.write( div.innerHTML );
    ventimp.document.close();
    ventimp.print( );
    ventimp.close();
}