    <?php
    include_once "../../superior.php";
?>
         <head>
            <title>Inventario de Producto</title>

            <link rel="stylesheet" type="text/css" href="../../../includes/css/adminlte.min.css">
            <link rel="stylesheet" href="../../../includes/css/data_tables_css/jquery.dataTables.min.css">
            <link rel="stylesheet" href="../../../includes/css/data_tables_css/buttons.dataTables.min.css">
        </head>

<div ng-controller="vistaCatalogoEquipos">
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header bg-primary">
            <h5 class="modal-title text-light" id="exampleModalLabel">EDITAR EQUIPO</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
        <div style="width: 100%;" class="form-floating mx-1" margin >
                                        <input hidden="true" class="form-control UpperCase" ng-model="numero" id="numero" autocomplete="off"  ng-disabled="false"  >
                                        <!-- <label>Numero de equipo</label> -->
                                    </div>
            <div style="width: 100%;" class="form-floating mx-1" pt-5>
                <input class="form-control UpperCase" ng-model="cambioNombreVer" id="cambioNombreVer" autocomplete="off" >
                <label>Nombre del equipo</label>
            </div>
            <!-- <div style="width: 100%;" class="form-floating mx-1">
                    <input type="text" ng-model="cambioDescripcion" id="cambioDescripcion" name="cambioDescripcion" class="form-control form-control-md " >
                    <label>Descripción del equipo</label>
                </div> -->
        </div>
        <!-- aca termina el cuerpo del modal -->
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" ng-click="cambioNombre()">Guardar Datos</button>
        </div>
        </div>
    </div>
    </div>


    <!-- modal para borrar -->
    <!-- <div class="modal fade bd-example-modal-lg" id="borrarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">ELIMINAR REGISTRO</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
        <p>
            ¿Esta seguro que desa elimar este registro? No podrá elimar los cambios 
        </p>
        
        </div>
         aca termina el cuerpo del modal -->
        <!-- <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">cerrar</button>
            <button type="button" class="btn btn-danger" ng-click="eliminarCaracteristicas()">Aceptar</button>
        </div>
        </div>
    </div>
    </div> --> 

    <main class="app-content">
        <div class="app-title">
            <div>
              <h1><i class="fas fa-boxes"></i> Equipos</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
              <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
              <li class="breadcrumb-item"><a href="equipos_vista.php">Equipos</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="card card-info" ng-show="perfilUsu.catalogo_equipos_captura == 1">
                        <div class="card-header">
                            <h3 class="card-title">CREACIÓN DE EQUIPOS </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row form-group form-group-sm">
                                <div class="col-lg-12 d-lg-flex">
                               
                                    <div style="width: 100%;" class="form-floating mx-1">
                                        <input class="form-control UpperCase" ng-model="nombre" id="nombre" autocomplete="off" ng-blur="ValidaExistencia(nombre)" >
                                        <label>Nombre equipo</label>
                                    </div>
                                    <!-- <div style="width: 100%;" class="form-floating mx-1">
                                        <textarea class="form-control" ng-model="descripcion" id="descripcion" autocomplete="off"></textarea>
                                        <label>Descripción de equipo</label>
                                    </div> -->
                                </div>
                            </div>
                            <div class="row form-group form-group-sm border-top">
                                <div class="col-sm-12" align="center">
                                    <input type="submit" value="Guardar" href="#" ng-click="validacionCampos(nombre)" class="btn btn-primary" style="margin-bottom: -20px !important">
                                    <input type="submit" value="Limpiar" href="#" ng-click="limpiarCampos()" class="btn btn-warning" style="margin-bottom: -25px !important">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">EQUIPOS CREADOS</h3>
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
                                        <th>Id</th>
                                        <th>Producto</th>
                                        <th> Opciones</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="(i, obj) in verequipos track by i">
                                        <td class="text-center">{{obj.cve_equipo}}</td>
                                        <td>{{obj.nombre_equipo}}</td>
                                        <td class="text-center">
                                            
                                            <button type="button" class="btn btn-info btn-md fas fa-edit" ng-click="consultar(obj.cve_equipo, obj.nombre_equipo)" data-toggle="modal" data-target="#exampleModal">
                                            </button>
                                            <!-- <button type="button" class="btn btn-danger btn-lg fas fa-trash-alt"  data-toggle="modal" data-target="#borrarModal">                                           
                                                    </button> -->
                                           
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
    <script src="equipos_vista_ajs.js"></script>

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