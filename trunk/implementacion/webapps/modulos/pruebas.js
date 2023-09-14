function actualizarTablaEquiposAgregados() {
    // Puedes utilizar $scope.equiposAgregados para actualizar la tabla en la vista
    // Por ejemplo, puedes generar dinámicamente filas HTML y agregarlas a la tabla
    var tablaEquiposAgregados = document.getElementById('tablaEquiposAgregados');
    tablaEquiposAgregados.innerHTML = ''; // Borra el contenido actual de la tabla

    // Itera sobre los equipos agregados y crea filas para la tabla
    $scope.equiposAgregados.forEach(function (equipo) {
        var fila = '<tr><td>' + equipo.cve_cequipo + '</td><td>' + equipo.folio + '</td></tr>';
        tablaEquiposAgregados.innerHTML += fila;
    });
}

$scope.agregarEquipo = function (cve_cequipo, folio) {
    // Verifica si el equipo ya está en la lista de equipos agregados
    var equipoExistente = $scope.equiposAgregados.find(function (equipo) {
        return equipo.cve_cequipo === cve_cequipo;
    });

    if (!equipoExistente) {
        // Agrega el equipo a la lista de equipos agregados
        $scope.equiposAgregados.push({
            cve_cequipo: cve_cequipo,
            folio: folio
        });

        // Aquí puedes realizar cualquier otra lógica que necesites

        // Por ejemplo, puedes mostrar los equipos en una tabla en la vista
        // Actualiza la tabla de equipos agregados en la vista
        actualizarTablaEquiposAgregados();
    }
};

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
            // Si el empleado ya existe, reemplázalo
            var indice = listaEmpleado.indexOf(empleadoExistente);
            if (indice !== -1) {
                listaEmpleado[indice] = codigoempleado;
            }
        } else {
            return listaEmpleado;
        }
    })
} else {
    // Si el empleado no existe, agrégalo
    listaEmpleado.push(codigoempleado);
}
console.log('esto es el array empleado', listaEmpleado);

var nombres = ['Jas'];
var equipos = ['lap', 'mouse', 'teclado'];

var consultas = [];

// Itera a través de los nombres y equipos para crear las consultas
for (var i = 0; i < nombres.length; i++) {
    for (var j = 0; j < equipos.length; j++) {
        var consulta = nombres[i] + ',' + equipos[j];
        consultas.push(consulta);
    }
}

// Ahora tienes un array de consultas que puedes utilizar
console.log(consultas);


