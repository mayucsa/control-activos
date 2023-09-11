<?php
    include_once "../../superior.php";
?>
         <head>
            <title>Caracteristicas de los equipos</title>

            <link rel="stylesheet" type="text/css" href="../../../includes/css/adminlte.min.css">
            <link rel="stylesheet" href="../../../includes/css/data_tables_css/jquery.dataTables.min.css">
            <link rel="stylesheet" href="../../../includes/css/data_tables_css/buttons.dataTables.min.css">
        </head>

<div ng-controller="vistaAsignacion">

    <main class="app-content">
        <div class="app-title">
            <div>
              <h1><i class="fas fa-boxes"></i> Asignación de equipos a personal</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
              <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
              <li class="breadcrumb-item"><a href="caracteristicas_equipos.php"> Asignación de equipos</a></li>
            </ul>
        </div>
        <div class="container">
            <div class="card bg-light mb-3" >
            <div class="card-header">
                <h2 class="card-title">RELACIÓN DE LOS EQUIPOS DE COMPUTO</h2>
                <!-- <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>  -->
            </div>
                <div class="row">

                    <div class="col">
                        <div class="card card-info ">
                        <div class="card-header">
                                <h3 class="card-title">EMPLEADO</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div> 
                            </div>
                            <div class="card-footer">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" style="width: 100%;" id="tablaEmpleado">
                                        <thead>
                                            <tr>
                                                <th>Código de empleado</th>
                                                <th> Nombre de empleado</th>
                                                <th>Opciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="(i, obj) in empleado ">
                                                <td class="text-center">{{obj.codigoempleado}}</td>
                                                <td >{{obj.nombre}}</td>
                                                
                                                <td class="text-center">
                                                        <!-- <button type="button" class="btn btn-warning  btn-sm  fas fa-edit " ng-click="consultar(obj.cve_asignacion, obj.nombrecompleto)" data-toggle="modal" data-target="#asignacion">
                                                        </button> -->
                                                        <input type="radio" ng-model="marca" ng-click="marca(obj.codigoempleado, obj.nombre )" id="marca" name="marca" class="form-control form-control-md text-center" >
                                                        <!-- <button type="button" class="btn btn-danger  btn-sm fas fa-trash-alt " style="margin-bottom: 10px" ng-click="eliminarAsignacion(obj.cve_cequipo)">                                           
                                                            </button> -->
                                                    
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div> 
                            </div>
                            
                        </div>
                    
                    </div>
                    <div class="col">
                        <div class="card card-info ">
                            <div class="card-header">
                                <h3 class="card-title">EQUIPOS DISPONIBLES</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div> 
                            </div>
                            <div class="card-footer">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" style="width: 100%;" id="tablaProducto">
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
                                                        <!-- <button type="button" class="btn btn-warning  btn-sm  fas fa-edit " ng-click="consultar(obj.cve_asignacion, obj.nombrecompleto)" data-toggle="modal" data-target="#asignacion">
                                                        </button> -->
                                                        <input type="radio" ng-model="marca" id="marca" name="marca" class="form-control form-control-md text-center" >

                                                        <!-- <button type="button" class="btn btn-danger  btn-sm fas fa-trash-alt " style="margin-bottom: 10px" ng-click="eliminarAsignacion(obj.cve_cequipo)">                                           
                                                            </button>  -->
                                                    
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

            <!-- <div class="row">
                <div class="col">
                    <div class="card-footer">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" style="width: 100%;" id="tablaEmpleado">
                                <thead>
                                    <tr>
                                        <th>Folio</th>
                                        <th> Nombre de empleado</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="(i, obj) in empleado ">
                                        <td class="text-center">{{obj.codigoempleado}}</td>
                                        <td >{{obj.nombre}}</td>
                                        
                                        <td class="text-center">
                                                <button type="button" class="btn btn-warning  btn-sm  fas fa-edit " ng-click="consultar(obj.cve_asignacion, obj.nombrecompleto)" data-toggle="modal" data-target="#asignacion">
                                                </button>
                                                <input type="radio" ng-model="marca" id="marca" name="marca" class="form-control form-control-md text-center" >
                                                <button type="button" class="btn btn-danger  btn-sm fas fa-trash-alt " style="margin-bottom: 10px" ng-click="eliminarAsignacion(obj.cve_cequipo)">                                           
                                                    </button>
                                            
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> 
                    </div>
                </div>
                <div class="col-5">
                2 of 3 (wider)
                </div>
                <div class="col">
                3 of 3
                </div>
            </div> -->
<!-- acá termina el contenedor -->
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="tile col-lg-12 d-lg-flex">
                    <div class="card card-info col col-lg-6 " ng-show="perfilUsu.catalogo_equipos_captura == 1">
                        <div class="card-header">
                            <h3 class="card-title">ASIGNACIÓN DE EQUIPOS </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            
                            <div class="row form-group form-group-sm">
                                
                                
                                
                                <div class="col-lg-12 d-lg-flex " style=" margin-top: 15px">
                                    <div style="width: 100%;" class="form-floating mx-1">
                                        <input type="text" ng-model="marca" id="marca" name="marca" class="form-control form-control-md text-center" disabled>
                                        <label>Marca</label>
                                    </div>
                                    <div style="width: 100%;" class="form-floating mx-1">
                                        <input type="text" ng-model="modelo" id="modelo" name="modelo" class="form-control form-control-md text-center" disabled>
                                        <label>Modelo</label>
                                    </div>
                                    <div style="width: 100%;" class="form-floating mx-1">
                                        <input type="text" ng-model="descripcion" id="descripcion" name="descripcion" class="form-control form-control-md text-center" disabled>
                                        <label>Descripción</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                            
                            <div class="row form-group form-group-sm border-top">
                                <div class="col-sm-12" align="center">
                                    <input type="submit" value="Guardar" href="#" ng-click="validacionCampos()" class="btn btn-primary" style="margin-bottom: -25px !important">
                                    <input type="submit" value="Limpiar" href="#" ng-click="limpiarCampos()" class="btn btn-warning" style="margin-bottom: -25px !important">
                                </div>
                            </div>
                    </div>
                    
                </div>
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">RELACIÓN DE LOS EQUIPOS DE COMPUTO</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div> 
                    </div>
                    <div class="card-footer">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" style="width: 100%;" id="tablaProduccion">
                                <thead>
                                    <tr>
                                        <th>código/nombre empleado</th>
                                        <th>código/nombre empleado</th>
                                        <th> número de serie del equipo</th>
                                        <th>Marca</th>
                                        <th>Modelo</th>
                                        <th>Caracteristicas</th>
                                        <th>Fecha de captura</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="(i, obj) in ssProduccionMorteros ">
                                        <td class="text-center">{{obj.codigo_empleado}}--{{obj.nombrecompleto}}</td>
                                        <td class="text-center" ng-model="nombreEliminar">{{obj.cve_asignacion}}</td>

                                        <input class="sinborde my-class" w-25 ng-model="nombre"  >{{obj.cve_asignacion}}
                                        <td >{{obj.numero_serie}}</td>
                                        <td class="text-center">{{obj.marca}}</td>
                                        <td class="text-center">{{obj.modelo}}</td>
                                        <td class="text-center">{{obj.descripcion}}</td>
                                        <td class="text-center">{{obj.fecha_asignacion}}</td>
                                        <td class="text-center">
                                                <!-- <button type="button" class="btn btn-warning  btn-sm  fas fa-edit " ng-click="consultar(obj.cve_asignacion, obj.nombrecompleto)" data-toggle="modal" data-target="#asignacion">
                                                </button> -->
                                                <button type="button" class="btn btn-danger  btn-sm fas fa-trash-alt " style="margin-bottom: 10px" ng-click="eliminarAsignacion(obj.cve_cequipo)">                                           
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