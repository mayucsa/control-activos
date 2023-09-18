<?php
    include_once "../../superior.php";
?>
         <head>
            <title>Caracteristicas de los equipos</title>

            <link rel="stylesheet" type="text/css" href="../../../includes/css/adminlte.min.css">
            <link rel="stylesheet" href="../../../includes/css/data_tables_css/jquery.dataTables.min.css">
            <link rel="stylesheet" href="../../../includes/css/data_tables_css/buttons.dataTables.min.css">

            <style type="text/css">
                body{
                    background-color: #f7f6f6;
                }
                table thead{
                    background-color: #1A4672;
                    color:  white;
                }
                .fixedTable tbody{
                    display: block;
                    height:400px;
                    overflow-y:auto;
                }
                .fixedTable thead, tbody, tr{
                    display: table;
                    width: 100%;
                    table-layout: fixed;
                }
                .fixedTable thead{
                    width: calc( 100% - 1em )
                }
            </style>

        </head>

<div ng-controller="vistaAsignacion">

    <main class="app-content">
        <div class="app-title">
            <div>
              <h1><i class="fas fa-boxes"></i> Asignación de equipos a personal</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
              <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
              <li class="breadcrumb-item"><a href="asignacion.php"> Asignación de equipos</a></li>
            </ul>
        </div>
        <!-- <div class="container"> -->
            <div class="row">
                <div class="col-md-6">
                    <div class="tile">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">EMPLEADOS </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover"  id="tablaEmpleado">
                                        <thead>
                                            <tr>
                                                <th>Código de empleado</th>
                                                <th>Nombre de empleado</th>
                                                <th>Opciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="(i, obj) in empleado ">
                                                <td class="text-center">{{obj.codigoempleado}}</td>
                                                <td >{{obj.nombre}}</td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-success btn-sm" ng-click="agregarEmpleado(obj.codigoempleado, obj.nombre)">Seleccionar</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="tile">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">EQUIPOS</h3>
                                 <div class="card-tools">
                                     <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                         <i class="fas fa-minus"></i>
                                     </button>
                                 </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover w-100 shadow" id="tablaProducto">
                                        <thead>
                                            <tr>
                                                <th>Folio</th>
                                                <th>Opciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="(i, obj) in arrayEquipos track by i">
                                                <td class="text-center">{{obj.folio}}</td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-info btn-sm fas fa-eye" ng-disabled="nombreEmpleado == '' " ng-click="verEquipo(obj.cve_cequipo, obj.folio)" title="Ver equipo"></button>
                                                    <button type="button" class="btn btn-success btn-sm fas fa-plus" ng-disabled="nombreEmpleado == '' " ng-click="agregarEquipo(i)" title="Asignar equipo"></button>
                                                    <!-- <button type="button" class="btn btn-warning  btn-sm  fas fa-edit " ng-click="agregarEquipo(obj.cve_cequipo, this)" data-toggle="modal" data-target="#asignacion">agregar equipo</button> -->
                                                    <!-- <input type="radio" ng-model="marca" id="marca" name="marca" class="form-control form-control-md text-center" > -->
                                                    <!-- <button type="button" class="btn btn-danger  btn-sm fas fa-trash-alt " ng-click="eliminarAsignacion(obj.cve_cequipo)"></button>                                                     -->
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
            <!-- este es para ver al usuario y equipos seleccionados -->
            <div class="row">
                <div class="col-md-12">
                    <div class="tile" ng-show="nombreEmpleado.length > 0 || productosAgregados.length > 0">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">ASIGNACION </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row form-group form-group-sm">
                                    <div class="col-lg-12 d-lg-flex">
                                        <div style="width: 50%;" class="form-floating mx-1">
                                            <input type="text" ng-model="nombreEmpleado" id="nombreEmpleado" name="nombreEmpleado" class="form-control form-control-md text-center" disabled >
                                            <label>nombre de empleado</label>
                                        </div>
                                        <!-- <input type="button" class="btn btn-danger"> -->
                                            <button type="button" class="btn btn-danger fas fa-trash-alt" title="Quitar empleado" ng-click="quitaremplado()"></button>
                                        <div style="width: 50%;" class="form-floating mx-1" align="right">
                                            <button type="button" class="btn btn-success" ng-click="GuardarAdignacion()">Guardar</button>                          
                                        </div>
                                    </div>
                                </div>
                                        
                                <div class="table-responsive" style="margin-bottom: 10px" ng-show="productosAgregados.length > 0">
                                    <!-- Agrega esta tabla para mostrar los equipos agregados -->
                                    <table class="table table-striped table-bordered table-hover" >
                                        <thead>
                                            <tr>
                                                <!-- <th>Cve nombre</th> -->
                                                <th>Equipo</th>
                                                <th>Folio</th>
                                                <th>Marca</th>
                                                <th>Modelo</th>
                                                <th>Opciones</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            <tr ng-repeat="(i,obj) in productosAgregados track by i">
                                                <td>{{obj.nombre_equipo}}</td>
                                                <td>{{obj.folio}}</td>
                                                <td>{{obj.marca}}</td>
                                                <td>{{obj.modelo}}</td>
                                                <td nowrap="nowrap" class="text-center">
                                                    <button class="btn btn-danger" ng-click="eliminarEquipoAgregado(i)">
                                                        Quitar 
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                     <!-- <button type="button" class="btn btn-danger  btn-sm fas fa-trash-alt " ng-click="validacionCampos()"></button> -->
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
    <script src="asignacion.js"></script>

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