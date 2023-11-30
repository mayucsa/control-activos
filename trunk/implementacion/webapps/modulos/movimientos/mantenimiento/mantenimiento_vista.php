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
<div class="modal fade bd-example-modal-lg " id="verModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg " role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-light" id="exampleModalLabel">Caracteristicas de Equipos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row row-cols-4">
                            <div style="width: 100%;" class="form-floating mx-1">
                                <input hidden="true" class="form-control UpperCase" ng-model="VerEquipo" id="VerEquipo" autocomplete="off"  disabled>   
                                <label>Numero</label>
                            </div>
                            <div style="width: 100%;" class="form-floating mx-1 ">
                                <input class="form-control UpperCase" ng-model="verNombre" id="verNombre" autocomplete="off"  >
                                <label>Nombre de equipo</label>
                            </div>
                            <div style=" width:100%; margin-bottom: 10px  " class="form-floating mx-1 w-25">
                                <input class="form-control UpperCase text-center" ng-model="verMarca" id="verMarca" autocomplete="off" >
                                <label class="form-label">Marca</label>
                            </div >
                            <div style=" width:100%; margin-bottom: 10px  " class="form-floating mx-1 w-25">
                                <input class="form-control UpperCase text-center" ng-model="verModelo" id="verModelo" autocomplete="off" >
                                <label>Modelo</label>
                            </div>
                            <div style=" width:100%; margin-bottom: 10px  " class="form-floating mx-1 w-25">
                                <input class="form-control UpperCase text-center" ng-model="verDescripcion" id="verDescripcion" autocomplete="off" >
                                <label>Descripción</label>
                            </div>
                            <div style=" width:100%; margin-bottom: 10px  " class="form-floating mx-1 w-25" >
                                <input class="form-control UpperCase text-center" ng-model="verNumeroFactura" id="verNumeroFactura" autocomplete="off" >
                                <label>Número de factura</label>
                            </div>
                            <div style=" width:100%; margin-bottom: 10px  " class="form-floating mx-1 w-25"> 
                            <!-- poner la condición en la base de datos que si se encuentra serie o factura no se guarde -->
                                <input class="form-control UpperCase text-center" ng-model="verNumeroSerie"  ng-blur="validaSerie(verNumeroSerie)" id="verNumeroSerie"  autocomplete="off" >
                                <label>Número de serie</label>
                            </div>
                            <div style=" width:100%; margin-bottom: 10px  " class="form-floating mx-1 w-25">
                                <input class="form-control UpperCase text-center" ng-model="verSistemaOperativo" id="verSistemaOperativo" autocomplete="off" >
                                <label>Sistema operativo</label>
                            </div>
                            <div style=" width:100%; margin-bottom: 10px  " class="form-floating mx-1 w-25">
                                <input class="form-control UpperCase text-center"  ng-model="verTipoAlmacenamiento" id="verTipoAlmacenamiento" autocomplete="off" >
                                <label>Tipo de almacenamiento</label>
                            </div>
                        </div>
                    </div>
                </div> 
            <!-- aca termina el cuerpo del modal  -->
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
                    <div class="card-body">
                        <div class="row form-group form-group-sm">
                            <div class="col-lg-12 d-lg-flex">
                                 <!-- para equipo -->
                                 <table class="table table-striped table-bordered table-hover w-100 shadow" style="width: 100%;" id="tablaProducto">
                                    <thead>
                                        <tr>
                                            <th>Equipos</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="(i, obj) in producto">
                                            <td class="text-center">{{obj.folio}}</td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-info btn-sm fas fa-eye"  ng-click="verEquipo(obj.nombre_equipo, obj.marca, obj.modelo, obj.descripcion, obj.numero_serie, 
                                                obj.numero_factura, obj.sistema_operativo, obj.tipo_almacenamiento)" title="Ver equipo" data-toggle="modal" data-target="#verModal"></button>
                                                <button type="button" class="btn btn-success btn-sm fas fa-plus" ng-click="agregarEquipo(obj.cve_, obj.nombre_equipo)" title="Asignar equipo"></button>                                                 
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <!-- para servicios -->
                                <table class="table table-striped table-bordered table-hover w-100 shadow" style="width: 100%;" id="tablaProducto">
                                        <thead>
                                            <tr>
                                                <th>Servicio</th>
                                                <th>Opciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="(i, obj) in servicio track by i">
                                                <td class="text-center">{{obj.nombre_servicio}}</td>
                                                <td class="text-center">
                                                    <!-- <button type="button" class="btn btn-info btn-sm fas fa-eye"  ng-click="verEquipo(obj.marca, obj.modelo, obj.descripcion, obj.numero_serie, 
                                                    obj.numero_factura, obj.sistema_operativo, obj.procesador, obj.vel_procesador, obj.memoria_ram, obj.tipo_almacenamiento, obj.capacidad_almacenamiento)" title="Ver equipo" data-toggle="modal" data-target="#verModal"></button> -->
                                                    <button type="button" class="btn btn-success btn-sm fas fa-plus" ng-disabled="agregarEquipo == '' " ng-click="agregarServicio(obj.cve_servicio, obj.nombre_servicio)" title="Asignar equipo"></button>                                                 
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                            </div>
                            <div class="tile" ng-show="arrayAgregados.length > 0 || productosAgregados.length > 0">
                                <div class="card card-info">
                                    <div class="card-header">
                                        <h3 class="card-title">MANTENIMIENTO </h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row form-group form-group-sm">
                                        <!-- <div class="col-lg-12 d-lg-flex">
                                    <label>Selecciona el tipo de equipo a capturar..</label>
                                </div> -->
                                            <div class="col-lg-12 d-lg-flex">
                                                <div style="width: 50%;" class="form-floating mx-1">
                                                    <input type="text" ng-model="nombreEquipo" id="nombreEquipo" name="nombreEquipo" class="form-control form-control-md text-center" value=''  disabled >
                                                    <label>EQUIPO</label>
                                                </div>
                                                <div style="width: 50%;" class="form-floating mx-1">
                                                    <input type="text" ng-model="nombreServicio" id="nombreServicio" name="nombreServicio" class="form-control form-control-md text-center" value='' disabled >
                                                    <label>SERVICIO</label>
                                                </div>
                                               
                                                <div style="width: 50%;" class="form-floating mx-1" align="right" >
                                                    <button type="button" class="btn btn-success" style="margin-bottom: -25px !important" ng-click="GuardarAsignacion()">Guardar</button>    
                                                    <input type="submit" value="Limpiar" href="#" ng-click="limpiarCampos()" class="btn btn-warning" style="margin-bottom: -25px !important">                      
                                                </div>
                                            </div>
                                            <div class="col-lg-12 d-lg-flex">
                                                <div style="width: 100%; margin-top: 10px" class="form-floating mx-1 text-center">
                                                    <select class="form-control form-group-md " ng-model="ingEncargado" autocomplete="off">
                                                        <option selected="selected" value="" >[Seleccione al encargado del mantenimiento..]</option>
                                                        <option class="text-center" ng-repeat="(i, obj) in empleado" value="{{obj.nombreCompleto}}">Encargado:{{obj.nombreCompleto}}</option>
                                                    </select>
                                                    <label>Encargado</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 d-lg-flex">
                                                <div style="width: 100%; margin-top: 10px" class="form-floating mx-1">
                                                     <textarea class="form-control UpperCase text-center" ng-model="comentario" id="comentario" autocomplete="off"></textarea>
                                                    <label>Datos del mantenimiento</label>
                                                </div>
                                            </div>
                                        </div>                
                                    </div>
                                </div>
                </div>
                         
        
                            
                        </div>
                    </div>
                        
                        <!-- <div class="row form-group form-group-sm border-top">
                            <div class="col-sm-12" align="center">
                                <input type="submit" value="Guardar" href="#" ng-click="validacionCampos()" class="btn btn-primary" style="margin-bottom: -25px !important">
                                <input type="submit" value="Limpiar" href="#" ng-click="limpiarCampos()" class="btn btn-warning" style="margin-bottom: -25px !important">
                            </div>
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
                                    <th>NO. Servicio</th>
                                    <th>Encargado</th>
                                    <th>Tipo de mantenimiento</th>
                                    <th>Equipo</th>
                                    <th>Fecha de captura</th>
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