<?php
    include_once "../../superior.php";
?>
         <head>
            <title>Caracteristicas de los equipos</title>

            <link rel="stylesheet" type="text/css" href="../../../includes/css/adminlte.min.css">
            <link rel="stylesheet" href="../../../includes/css/data_tables_css/jquery.dataTables.min.css">
            <link rel="stylesheet" href="../../../includes/css/data_tables_css/buttons.dataTables.min.css">

            <style>

            table {
                width: 70%;
                height: 300px;
            }

            /* table tr {
                text-align: center;
            }

            table tr:nth-child(even) {
                background-color: #eee;
            }

            table tr:nth-child(odd) {
                background-color: #fff;
            }

            table th {
                color: #fff;
                background-color: #000;
            } */

</style>
        </head>
<div ng-controller="vistaEmpleadoEquipo">
    <!-- modal para ver -->
    <div class="modal fade bd-example-modal-lg"  style="width: 100%;" id="verEquiposUsuario" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-light" id="exampleModalLabel">VER EQUIPOS</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-footer">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover table-responsive " style="width: 100%;" id="tablaRelacionEquipo">
                                <thead>
                                <tr>
                                    <th >Nombre Equipo</th>
                                    <th> Marca</th>
                                    <th>Modelo</th>
                                    <th>Fecha de asignación</th>
                                    <th>Opciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr ng-repeat="(i, obj) in verEquipos track by i">     
                                                <td class="text-center">{{obj.nombre_equipo}} </td> 
                                                <td class="text-center">{{obj.marca}} </td>
                                                <td class="text-center">{{obj.modelo}} </td>
                                                <td class="text-center">{{obj.fecha_asignacion}} </td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-danger  btn-sm fas fa-trash-alt " style="margin-bottom: 10px" ng-click="eliminarRelacion(obj.cve_cequipo)" data-toggle="modal" data-target="#borrarModal">                                           
                                                    </button> 
                                        </td>
                                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                
                </div>
                <!-- aca termina el cuerpo del modal -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

<main class="app-content">
    <div class="app-title">
        <div>
          <h1><i class="fas fa-boxes"></i> Relación de los equipos</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="caracteristicas_equipos.php"> a</a></li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="card card-info">
                    <div class="card-body">
                        <button type="button" class="btn btn-success btn-sm" ng-show="nuevogrupo == false" ng-click="agregar()">Ver grupos</button>
                        <button type="button" class="btn btn-danger btn-sm" ng-show="nuevogrupo == true" ng-click="agregar()">Ver empleados</button>
                        <!-- <button type="button" class="btn btn-success btn-sm" ng-show="nuevogrupo == true" ng-click="guardarGrupo(obj.codigo)">Guardar Grupo</button> -->
                    </div>
        
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile" ng-model="nuevogrupo" id="nuevogrupo" ng-show="nuevogrupo == false">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Relación de empleados</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div> 
                    </div>
                    <div class="card-footer">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" style="width: 100%;" id="tablaRelacion">
                                <thead>
                                    <tr>
                                        <th>Código Empleado</th>
                                        <th>Nombre</th>
                                        <th>apellidos</th>
                                        <th>Equipos Relacionados</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="(i, obj) in verRelaciones ">
                                        <td class="text-center">{{obj.codigoempleado}}</td>
                                        <td class="text-center">{{obj.nombre}}</td>
                                        <td class="text-center">{{obj.apellidos}}</td>
                                        <td class="text-center">
                                                <button type="button" class="btn btn-warning  btn-sm  far fa-eye" ng-click="consultar(obj.codigoempleado)" data-toggle="modal" data-target="#verEquiposUsuario">
                                                </button>
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
            <div class="tile" ng-model="nuevogrupo" id="nuevogrupo" ng-show="nuevogrupo == true">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Relacion de grupos</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div> 
                    </div>
                    <div class="card-footer">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" style="width: 100%;" id="tablaRelacion">
                                <thead>
                                    <tr>
                                        <th>Código Empleado</th>
                                        <th>Nombre</th>
                                        <th>apellidos</th>
                                        <th>Equipos Relacionados</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="(i, obj) in verRelaciones ">
                                        <td class="text-center">{{obj.codigoempleado}}</td>
                                        <td class="text-center">{{obj.nombre}}</td>
                                        <td class="text-center">{{obj.apellidos}}</td>
                                        <td class="text-center">
                                                <button type="button" class="btn btn-warning  btn-sm  far fa-eye" ng-click="consultar(obj.codigoempleado)" data-toggle="modal" data-target="#verEquiposUsuario">
                                                </button>
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
    <script src="EmpleadoEquipo.js"></script>

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