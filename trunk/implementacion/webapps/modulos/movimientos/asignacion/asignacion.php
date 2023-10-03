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
<div class="modal fade bd-example-modal-lg " id="verModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-light" id="exampleModalLabel">EDITAR EQUIPOS</h5>
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
                        <input  hidden="true" class="form-control UpperCase" ng-model="verNombre" id="verNombre" autocomplete="off"  disabled>
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
                        <input class="form-control UpperCase text-center" ng-model="verProcesador" id="verProcesador" autocomplete="off" >
                        <label>Procesador</label>
                    </div>
                    <div style=" width:100%; margin-bottom: 10px  " class="form-floating mx-1 w-25">
                        <input class="form-control validanumericos text-center"  ng-model="verVelocidadProcesador" id="verVelocidadProcesador" autocomplete="off" >
                        <label>Velocidad de procesador</label>
                    </div>
                    <div style=" width:100%; margin-bottom: 10px  " class="form-floating mx-1 w-25">
                        <input class="form-control validanumericos text-center"  ng-model="verMemoriaRam" id="verMemoriaRam" autocomplete="off" >
                        <label>Memoria ram</label>
                    </div>
                    <div style=" width:100%; margin-bottom: 10px  " class="form-floating mx-1 w-25">
                        <input class="form-control UpperCase text-center"  ng-model="verTipoAlmacenamiento" id="verTipoAlmacenamiento" autocomplete="off" >
                        <label>Tipo de almacenamiento</label>
                    </div>
                    <div style=" width:100%; margin-bottom: 10px  " class="form-floating mx-1 w-25">
                        <input class="form-control validanumericos text-center"  ng-model="verCapaAlmacenamiento" id="verCapaAlmacenamiento" autocomplete="off" >
                        <label>C. de almacenamiento</label>
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
              <h1><i class="fas fa-boxes"></i> Asignación de equipos a personal</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
              <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
              <li class="breadcrumb-item"><a href="asignacion.php"> Relación de los equipos</a></li>
            </ul>
        </div>
        <!-- <div class="container"> -->
            <div class="row">
                <div class="col-md-12">
                <div class= "row form-group form-group-sm">
                        <div class="col-lg-12 d-lg-flex">
                            <label>Selecciona al usuario o grupos..</label>
                        </div>
                        <div class="col-lg-12 d-lg-flex">
                            <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="Radio1" ng-model="checkh" value="1">
                                <label class="form-check-label">USUARIOS </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="Radio2" ng-model="checkh" value="2">
                                <label class="form-check-label">GRUPOS</label>
                            </div>
                        </div>
                    </div> 
                </div>
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

                            <!-- ESTTE CÓDIGO COMENTADO SERVIRÁ MÁS ADELANTE SI SE QUOERE AGREGAR LOS GRUPOS DE PERSONAS -->
                           
                               
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
                <!-- esto es una tabla para grupos -->
                <div class="col-md-6"> 
                    <div class="tile">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">GRUPOS </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                            <button type="button" class="btn btn-success btn-sm" ng-click="agregarGrupo(obj.codigoempleado, obj.nombre)">Seleccionar</button>
                                <!-- <div class="table-responsive">
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
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>

                <!-- para la tabla equipos -->
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
                                                    <button type="button" class="btn btn-info btn-sm fas fa-eye"  ng-click="verEquipo(obj.marca, obj.modelo, obj.descripcion, obj.numero_serie, 
                                                    obj.numero_factura, obj.sistema_operativo, obj.procesador, obj.vel_procesador, obj.memoria_ram, obj.tipo_almacenamiento, obj.capacidad_almacenamiento)" title="Ver equipo" data-toggle="modal" data-target="#verModal"></button>
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
                                            <input type="text" ng-model="nombreEmpleado" id="nombreEmpleado" name="nombreEmpleado" class="form-control form-control-md text-center" value={{obj.codigoempleado}}  disabled >
                                            <label>nombre de empleado</label>
                                        </div>
                                        <!-- <input type="button" class="btn btn-danger"> -->
                                            <button type="button" class="btn btn-danger fas fa-trash-alt" title="Quitar empleado" ng-click="quitaremplado()"></button>
                                        <div style="width: 50%;" class="form-floating mx-1" align="right" >
                                            <button type="button" class="btn btn-success" ng-click="GuardarAsignacion()">Guardar</button>                          
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