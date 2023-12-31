<?php
    include_once "../../superior.php";
?>
         <head>
            <title>Caracteristicas de los equipos</title>

            <link rel="stylesheet" type="text/css" href="../../../includes/css/adminlte.min.css">
            <link rel="stylesheet" href="../../../includes/css/data_tables_css/jquery.dataTables.min.css">
            <link rel="stylesheet" href="../../../includes/css/data_tables_css/buttons.dataTables.min.css">
        </head>
<div ng-controller="vistaMantenimiento">

<main class="app-content">
    <div class="app-title">
        <div>
          <h1><i class="fas fa-boxes"></i> Mantenimiento de equipos</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="caracteristicas_equipos.php"> a</a></li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="card card-info" ng-show="perfilUsu.catalogo_equipos_captura == 1">
                    <div class="card-header">
                        <h3 class="card-title"> MANTENIMIENTO DE EQUIPOS </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <!-- <div class="card-body">
                        
                    </div> -->  
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
                                    <th>Nombre</th>
                                    <th>apellidos</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="(i, obj) in ssProduccionMorteros ">
                                    <td class="text-center">{{obj.codigo_empleado}}--{{obj.nombrecompleto}}</td>
                                    <td >{{obj.numero_serie}}</td>
                                    <td class="text-center">{{obj.marca}}</td>
                                    <td class="text-center">{{obj.modelo}}</td>
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
    <script src="mantenimiento.js"></script>

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