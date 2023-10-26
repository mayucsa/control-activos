<?php
    include_once "../../superior.php";
?>
         <head>
            <title>Empleadooo</title>

            <link rel="stylesheet" type="text/css" href="../../../includes/css/adminlte.min.css">
            <link rel="stylesheet" href="../../../includes/css/data_tables_css/jquery.dataTables.min.css">
            <link rel="stylesheet" href="../../../includes/css/data_tables_css/buttons.dataTables.min.css">
        </head>
<style>
.tablas{
    margin-bottom: 80px;

};

</style>
<div ng-controller="vistaGrupos">

<!-- modal para ver lista de empleados en grupo -->
    <div class="modal fade bd-example-modal-lg " id="modalLista" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg " role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-light" id="exampleModalLabel">Empleados en el grupo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover"  id="tablaGruposDetalle">
                            <thead>
                                <tr>
                                    <th class="text-center">Numero empleado</th>
                                    <th class="text-center">Nombre</th>
                                    <th class="text-center">Quitar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="(i, obj) in gruposDetalle track by i">
                                    <td class="text-center">{{obj.numeroempleado}}</td>
                                    <td class="text-center">{{obj.empleado}}</td>
                                    <td class="text-center">
                                        <!-- <button type="button" class="btn btn-info btn-sm" ng-click="verLista(obj.cve_grupo)"></button> -->
                                        <!-- <span class="btn btn-warning btn-sm" title="Ver lista" data-toggle="modal" data-target="#modalLista" ng-click="verLista(obj.cve_grupo)"><i class="fas fa-list-ol"></i></span> -->
                                        <span class="btn btn-danger btn-sm" title="Eliminar del grupo" ng-click="QuitardelGrupo(obj.cve_gpo_detalle)"><i class="fas fa-trash-alt"></i></span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <!-- <button type="button" class="btn btn-primary" ng-click="cambioCaracteristica()">Guardar Datos</button> -->
                </div>
            </div>
        </div>
    </div>

<main class="app-content">
    <div class="app-title">
        <div>
          <h1><i class="fas fa-boxes"></i> LISTA DE GRUPOS</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="grupo.php"> Grupos</a></li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="card card-info">
                    <div class="card-body">
                        <button type="button" class="btn btn-success btn-sm" ng-show="nuevogrupo == false" ng-click="agregar()">Nuevo Grupo</button>
                        <button type="button" class="btn btn-danger btn-sm" ng-show="nuevogrupo == true" ng-click="agregar()">Regresar</button>
                        <button type="button" class="btn btn-success btn-sm" ng-show="nuevogrupo == true" ng-click="guardarGrupo(obj.codigo)">Guardar Grupo</button>
                    </div>
        
                </div>
            </div>
        </div>
    </div>

    <div class="row" >
        <div class="col-md-6">
            <div class="tile" ng-model="nuevogrupo" id="nuevogrupo" ng-show="nuevogrupo == true">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Nuevo Grupo </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div>
                            <div style="width: 100%;  " class="form-floating mx-1 ">
                                <input class="form-control UpperCase text-center"  ng-model="nombreGrupo" id="nombreGrupo" autocomplete="off" ng-blur="ValidaExistencia(nombreGrupo)">
                                <label>Nombre del grupo</label>
                            </div>
                            <div style="width: 100%" class="form-floating mx-1">
                                <input class="form-control UpperCase text-center" ng-model="descripcion" id="descripcion" autocomplete="off" >
                                <label>Descripción</label>
                            </div>
                            <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover"  id="tablaEmpleadoAgregado">
                                <thead>
                                    <tr>
                                        <th>Código de empleado</th>
                                        <th>Nombre de empleado</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="(i, obj) in empleadosAgregados ">
                                        <td class="text-center">{{obj.codigo}}</td>
                                        <td >{{obj.nombre}}</td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-success btn-sm" id="agregarEmpleado" ng-click="eliminar(i)">Eliminar</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        </div>
                
                        
                    
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="col-md-6">                    
            <div class="tile"  ng-model="nuevogrupoEmpleado" id="nuevogrupoEmpleado" ng-show="nuevogrupoEmpleado == true">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Agregar Empleado </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">

                    <!-- ESTTE CÓDIGO COMENTADO SERVIRÁ MÁS ADELANTE SI SE QUOERE AGREGAR LOS GRUPOS DE PERSONAS -->
                    
                        
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover"  id="tablaEmpleado">
                                <thead>
                                    <tr>
                                        <th>Código de empleado</th>
                                        <th>Nombre de empleado</th>
                                        <!-- <th>Apellido</th> -->
                                        <!-- <th>Puesto</th> -->
                                        <th>Departamento</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="(i, obj) in empleado ">
                                        <td class="text-center">{{obj.codigoempleado}}</td>
                                        <td >{{obj.nombreC}}</td>
                                        <!-- <td class="text-center">{{obj.apellido}}</td> -->
                                        <!-- <td class="text-center">{{obj.puesto}}</td> -->
                                        <td class="text-center">{{obj.departamento}}</td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-success btn-sm" id="agregarEmpleado" ng-click="agregarEmpleado(obj.codigoempleado, obj.nombreC)">Seleccionar</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="card card-info">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover"  id="tablaGrupos">
                                <thead>
                                    <tr>
                                        <th class="text-center">Código de grupo</th>
                                        <th class="text-center">Nombre de grupo</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="(i, obj) in grupos ">
                                        <td class="text-center">{{obj.cve_grupo}}</td>
                                        <td class="text-center">{{obj.nombre_gpo}}</td>
                                        <td class="text-center">
                                            <!-- <button type="button" class="btn btn-info btn-sm" ng-click="verLista(obj.cve_grupo)"></button> -->
                                            <span class="btn btn-info btn-sm" title="Ver lista" data-toggle="modal" data-target="#modalLista" ng-click="verLista(obj.cve_grupo)"><i class="fas fa-list-ol"></i></span>
                                            <span class="btn btn-danger btn-sm" title="Eliminar grupo completo" ng-click="eliminarGrupo(obj.cve_grupo)"><i class="fas fa-trash-alt"></i></span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once "../../footer.php" ?>
</main>
</div>


<script src="../../../includes/js/adminlte.min.js"></script>

<?php include_once "../../inferior.php" ?>
    <script src="grupo.js"></script>

    <script src="../../../includes/js/jquery331.min.js"></script>

    <script src="../../../includes/js/sweetalert2.min.js"></script>

    <script src="../../../includes/bootstrap/js/bootstrap.js"></script>

    <script src="../../../includes/bootstrap/js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="../../../includes/css/datatables.min.css"/>

    <script type="text/javascript" src="../../../includes/js/datatables.min.js"></script>

    <script src="../../../includes/js/data_tables_js/jquery.dataTables.min.js"></script>
    <script src="../../../includes/js/data_tables_js/dataTables.buttons.min.js"></script>
    <script src="../../../includes/js/data_tables_js/jszip.min.js"></script>
    <script src="../../../includes/js/data_tables_js/pdfmake.min.js"></script>
    <script src="../../../includes/js/data_tables_js/vfs_fonts.js"></script>
    <script src="../../../includes/js/data_tables_js/buttons.html5.min.js"></script>
    <script src="../../../includes/js/data_tables_js/buttons.print.min.js"></script>