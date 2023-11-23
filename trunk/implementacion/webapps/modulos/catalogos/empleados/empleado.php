<?php
    include_once "../../superior.php";
?>
         <head>
            <title>Empleadooo</title>

            <link rel="stylesheet" type="text/css" href="../../../includes/css/adminlte.min.css">
            <link rel="stylesheet" href="../../../includes/css/data_tables_css/jquery.dataTables.min.css">
            <link rel="stylesheet" href="../../../includes/css/data_tables_css/buttons.dataTables.min.css">
        </head>
<div ng-controller="vistaEmpleados">


<main class="app-content">
    <div class="app-title">
        <div>
          <h1><i class="fas fa-boxes"></i> LISTA DE EMPLEADOS</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="../../bienvenida/bienvenida/bienvenida.php">INICIO</a></li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">                    
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

                    <!-- ESTTE CÓDIGO COMENTADO SERVIRÁ MÁS ADELANTE SI SE QUOERE AGREGAR LOS GRUPOS DE PERSONAS -->
                    
                        
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover"  id="tablaEmpleado">
                                <thead>
                                    <tr>
                                        <th>Código de empleado</th>
                                        <th>Nombre de empleado</th>
                                        <th>Apellido</th>
                                        <th>Puesto</th>
                                        <th>Departamento</th>
                                        <!-- <th>Opciones</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="(i, obj) in empleado ">
                                        <td class="text-center">{{obj.codigoempleado}}</td>
                                        <td >{{obj.nombre}}</td>
                                        <td class="text-center">{{obj.apellido}}</td>
                                        <td class="text-center">{{obj.puesto}}</td>
                                        <td class="text-center">{{obj.departamento}}</td>
                                        <!-- <td class="text-center">
                                            <button type="button" class="btn btn-success btn-sm" ng-click="agregarEmpleado(obj.codigoempleado, obj.nombre)">Seleccionar</button>
                                        </td> -->
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
    <script src="empleado.js"></script>

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