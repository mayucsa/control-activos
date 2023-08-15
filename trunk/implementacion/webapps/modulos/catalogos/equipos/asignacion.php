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
<div class="modal fade" id="asignacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div style="width: 100%;" class="form-floating mx-1">
                <input class="form-control UpperCase" ng-model="numeroAsignacion" id="numero" autocomplete="off"  ng-disabled="false">
                <label>Numero de asignación</label>
            </div>
            <div style="width: 100%;" class="form-floating mx-1">
                <input class="form-control UpperCase" ng-model="nombreEmpleado" id="numero" autocomplete="off"  ng-disabled="false">
                <label>Nombre empleado</label>
            </div>
            <div style="width: 100%;" class="form-floating mx-1">
                <select class="form-control form-group-md" ng-model="nombre"  ng-blur="habilitarinput()" autocomplete="off">
                    <option selected="selected" value="">[Seleccione una opción..]</option>
                    <option ng-repeat="(i, obj) in caracteristicas" value="{{obj.cve_cequipo}}">{{obj.cve_cequipo}} - {{obj.numero_serie}} (Número de serie)</option>
                </select>
                <label>Producto</label>
            </div>
            <div class="col-lg-12 d-lg-flex">
                <div style="width: 100%;" class="form-floating mx-1">
                    <input type="text" ng-model="marca" id="marca" name="marca" class="form-control form-control-md " disabled>
                    <label>Marca</label>
                </div>
                <div style="width: 100%;" class="form-floating mx-1">
                    <input type="text" ng-model="modelo" id="modelo" name="modelo" class="form-control form-control-md " disabled>
                    <label>Modelo</label>
                </div>
                <div style="width: 100%;" class="form-floating mx-1">
                    <input type="text" ng-model="descripcion" id="descripcion" name="descripcion" class="form-control form-control-md " disabled>
                    <label>Descripción</label>
                </div>
            </div>
        </div>
        <!-- aca termina el cuerpo del modal -->
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">cerrar</button>
            <button type="button" class="btn btn-primary" ng-click="cambioAsignacion()">Guardar Datos</button>
        </div>
        </div>
    </div>
    </div>
    <main class="app-content">
        <div class="app-title">
            <div>
              <h1><i class="fas fa-boxes"></i> Asignación de equipos a personal</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
              <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
              <li class="breadcrumb-item"><a href="caracteristicas_equipos.php">Caracteristicas de equipos</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="card card-info" ng-show="perfilUsu.catalogo_equipos_captura == 1">
                        <div class="card-header">
                            <h3 class="card-title">RELACIÓN </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row form-group form-group-sm">
                                <div class="col-lg-12 d-lg-flex">
                                    <!-- para empleado -->
                                    <div style="width: 100%;" class="form-floating mx-1">
                                        <select class="form-control form-group-md" ng-model="codigo" autocomplete="off">
                                            <option selected="selected" value="">[Seleccione al empleado..]</option>
                                            <option ng-repeat="(i, obj) in empleado" value="{{obj.codigoempleado}}">Código:{{obj.codigoempleado}}--Nombre:{{obj.nombre}}</option>
                                        </select>
                                        <label>Empleado</label>
                                    </div>

                                    <!-- para equipo -->
                                    <div style="width: 100%;" class="form-floating mx-1">
                                        <select class="form-control form-group-md" ng-model="nombre" ng-blur="validaEquipo(nombre)" ng-click="habilitarinput()" autocomplete="off">
                                            <option selected="selected" value="">[Seleccione una opción..]</option>
                                            <option ng-repeat="(i, obj) in caracteristicas" value="{{obj.cve_cequipo}}">{{obj.cve_cequipo}} - {{obj.numero_serie}} (Número de serie)</option>
                                        </select>
                                        <label>Producto</label>
                                    </div>
                                </div>
                                
                                
                                <div class="col-lg-12 d-lg-flex">
                                    <div style="width: 100%;" class="form-floating mx-1">
                                        <input type="text" ng-model="marca" id="marca" name="marca" class="form-control form-control-md " disabled>
                                        <label>Marca</label>
                                    </div>
                                    <div style="width: 100%;" class="form-floating mx-1">
                                        <input type="text" ng-model="modelo" id="modelo" name="modelo" class="form-control form-control-md " disabled>
                                        <label>Modelo</label>
                                    </div>
                                    <div style="width: 100%;" class="form-floating mx-1">
                                        <input type="text" ng-model="descripcion" id="descripcion" name="descripcion" class="form-control form-control-md " disabled>
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
                                        <th>codigo/nombre empleado</th>
                                        <th> numero de serie del equipo</th>
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
                                        <td>{{obj.numero_serie}}</td>
                                        <td class="text-center">{{obj.marca}}</td>
                                        <td class="text-center">{{obj.modelo}}</td>
                                        <td class="text-center">{{obj.descripcion}}</td>
                                        <td class="text-center">{{obj.fecha_asignacion}}</td>
                                        <td class="text-center">
                                                <button type="button" class="btn btn-info btn-lg fas fa-edit" ng-click="consultar(obj.cve_asignacion, obj.nombrecompleto)" data-toggle="modal" data-target="#asignacion">
                                                
                                                </button>
                                                <span class= "btn btn-danger btn-xs" title="Descargar PDF"><i class="fas fa-trash-alt"></i> </span>
                                               
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