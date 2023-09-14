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
                                                    <button type="button" class="btn btn-success  btn-sm" ng-click="agregarEmpleado(obj.codigoempleado, obj.nombre)" data-toggle="modal" data-target="#asignacion"><label for="">Seleccionar</label></button>
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
                                            <tr ng-repeat="(i, obj) in caracteristicas">
                                                <td class="text-center">{{obj.folio}}</td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-warning btn-sm fas fa-edit" ng-click="agregarEquipo(obj.cve_cequipo, obj.folio)" data-toggle="modal" data-target="#asignacion" ng-disabled=false>agregar equipo</button>
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
                <div class="col">
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
                            <div style="margin-bottom: 10px">
                                <label>nombre de empleado</label>
                                <input type="text" ng-model="nombreEmpleado" id="nombreEmpleado" name="nombreEmpleado" class="form-control form-control-md text-center" disabled >
                            </div>
                                    
                            <div class="table-responsive" style="margin-bottom: 10px">
                                <!-- <table class="table table-striped table-bordered table-hover"  id="tablaEmpleado">
                                    <thead>
                                        <tr>
                                            <th>Empleado</th>
                                            <th>Equipo(s) </th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                            <td><input type="text" ng-model="modelo" id="modelo" name="modelo" class="form-control form-control-md text-center" disabled>
                                                
                                             </td>
                                             <td class="text-center">
                                                <textarea name="equipoEmpleado" ng-model="equipoEmpleado" id="equipoEmpleado" cols="29" rows="5"></textarea>
                                                
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-success  btn-sm" ng-click="agregarEmpleado(obj.codigoempleado)" data-toggle="modal" data-target="#asignacion"><label for="">Seleccionar</label></button>
                                            </td>
                                        
                                    </tbody>
                                </table>  -->
                                <!-- Agrega esta tabla para mostrar los equipos agregados -->
                                <table class="table table-striped table-bordered table-hover" >
                                    <thead>
                                        <tr>
                                            <!-- <th>Cve nombre</th> -->
                                            <th>Folio</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center" id="tablaEquiposAgregados">
                                       
                                        <!-- Los datos de los equipos agregados se actualizarán aquí dinámicamente -->
                                    </tbody>
                                </table>
                                 <button type="button" class="btn btn-danger  btn-sm fas fa-trash-alt " ng-click="validacionCampos()"></button> 

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