<?php
    include_once "../../superior.php";
?>
         <head>
            <title>Caracteristicas de los equipos</title>

            <link rel="stylesheet" type="text/css" href="../../../includes/css/adminlte.min.css">
            <link rel="stylesheet" href="../../../includes/css/data_tables_css/jquery.dataTables.min.css">
            <link rel="stylesheet" href="../../../includes/css/data_tables_css/buttons.dataTables.min.css">
        </head>
<div ng-controller="vistaServicio">
<div class="modal fade bd-example-modal-lg " id="ejemploServicio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content">
        <div class="modal-header bg-primary">
            <h5 class="modal-title text-light" id="exampleModalLabel">EDITAR SERVICIO</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="container">
                <div c class="row row-cols-4">
                    <div style="width: 100%;" class="form-floating mx-1">
                        <input class="form-control UpperCase" hidden="true" ng-model="numeroEquipoModal" id="numeroEquipoModal" autocomplete="off"  disabled>
                        <label>Numero </label>
                    </div>
                    <div style="width: 100%; margin-bottom: 10px " class="form-floating mx-1 w-40">
                        <input  class="form-control UpperCase text-center" ng-model="cambioNombre" id="cambioNombre" autocomplete="off"  ng-blur='verificarServicioM(cambioNombre)' >
                        <label>Nombre de servicio</label>
                    </div>
                    <div style=" width:100%; margin-bottom: 10px  " class="form-floating mx-1 w-40">
                        <input class="form-control UpperCase text-center" ng-model="cambioDescripcion" id="cambioDescripcion" autocomplete="off" >
                        <label class="form-label">Descripción</label>
                    </div >

                 </div>
            </div>
        </div>
        <!-- aca termina el cuerpo del modal -->
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            <!-- <button type="button" class="btn btn-primary" ng-click="cambioServicio()">Guardar Datos</button> -->
        </div>
        </div>
    </div>
    </div>

<main class="app-content">
    <div class="app-title">
        <div>
          <h1><i class="fas fa-boxes"></i> Servicios</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="caracteristicas_equipos.php"> s</a></li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="card card-info" ng-show="perfilUsu.catalogo_equipos_captura == 1">
                    <div class="card-header">
                        <h3 class="card-title">SERVICIOS </h3>
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
                                    <input type="text" ng-model="servicioEntrada" ng-blur='verificarServicio(servicioEntrada)' id="servicioEntrada" name="servicioEntrada" class="form-control UpperCase text-center" >
                                    <label>Servicio</label>
                                </div>
                                <div style="width: 100%;" class="form-floating mx-1">
                                    <input type="text" ng-model="caracteristica" id="caracteristica" name="caracteristica" class="form-control UpperCase text-center" >
                                    <label>Caracteristicas</label>
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
                    <h3 class="card-title">servicios</h3>
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
                                    <th>Número de servicio</th>
                                    <th>Nombre del servicio</th>
                                    <th>Caracteristicas</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="(i, obj) in servicio ">
                                    <td class="text-center">{{obj.cve_servicio}}</td>
                                    <td class="text-center" >{{obj.nombre_servicio}}</td>
                                    <td class="text-center">{{obj.descripcion}}</td>
                                    <td class="text-center">
                                            <button type="button" class="btn btn-warning  btn-sm  fas fa-edit " style="margin-bottom: 10px" ng-click="consultar(obj.cve_servicio, obj.nombre_servicio, obj.descripcion)" data-toggle="modal" data-target="#ejemploServicio">
                                            </button>
                                            <button type="button" class="btn btn-success btn-sm fas fa-unlock " style="margin-bottom: 10px" ng-show="[[obj.estatus_servicio]]==0" ng-click="activar(obj.cve_servicio)">                                           
                                                </button>
                                            <button type="button" class="btn btn-danger  btn-sm fas fa-lock " style="margin-bottom: 10px"ng-show="[[obj.estatus_servicio]]==1" ng-click="descativar(obj.cve_servicio)">                                           
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
    <script src="servicio_vista_ajs.js"></script>

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