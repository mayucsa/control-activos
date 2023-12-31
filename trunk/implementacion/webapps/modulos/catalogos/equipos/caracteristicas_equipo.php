<?php
    include_once "../../superior.php";
?>
         <head>  
            <title>Caracteristicas de los equipos</title>

            <link rel="stylesheet" type="text/css" href="../../../includes/css/adminlte.min.css">
            <link rel="stylesheet" href="../../../includes/css/data_tables_css/jquery.dataTables.min.css">
            <link rel="stylesheet" href="../../../includes/css/data_tables_css/buttons.dataTables.min.css">
        </head>
 
<div ng-controller="vistaCaracteristicasEquipos">
<!-- MODAL VER SCANNER -->
<div id="modalScanner" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="exampleModalLabel">Código de Barras</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center" id="modalBarCode">
        <!-- <img class="codigo" id="imgcodigo" ng-model="imgcodigo" name="imgcodigo"/> -->
      </div>
      <div class="modal-footer">
        <input type="button" value="Imprimir" onclick="imprSelec('modalBarCode')" class="btn btn-primary">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

    <div class="modal fade bd-example-modal-lg " id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <div c class="row row-cols-4">
                                <div style="width: 100%;" class="form-floating mx-1">
                                    <input hidden="true" class="form-control UpperCase" ng-model="numeroEquipo" id="numeroEquipo" autocomplete="off"  disabled>
                                    <!-- <label>Numero</label> -->
                                </div> 
                                <div style="width: 100%;" class="form-floating mx-1 ">
                                    <input  hidden="true" class="form-control UpperCase" ng-model="verNombre" id="verNombre" autocomplete="off"  disabled>
                                    <label>Nombre de equipo</label>
                                </div>
                                <div style=" width:100%; margin-bottom: 10px  " class="form-floating mx-1 w-25">
                                    <input class="form-control UpperCase text-center" ng-model="cambiaMarca" id="cambiaMarca" autocomplete="off" >
                                    <label class="form-label">Marca</label>
                                </div >
                                <div style=" width:100%; margin-bottom: 10px  " class="form-floating mx-1 w-25">
                                    <input class="form-control UpperCase text-center" ng-model="cambiaModelo" id="cambiaModelo" autocomplete="off" >
                                    <label>Modelo</label>
                                </div>
                                <div style=" width:100%; margin-bottom: 10px  " class="form-floating mx-1 w-25">
                                    <input class="form-control UpperCase text-center" ng-model="cambiaDescripcion" id="cambiaDescripcion" autocomplete="off" >
                                    <label>Descripción</label>
                                </div>
                                <div style=" width:100%; margin-bottom: 10px  " class="form-floating mx-1 w-25">
                                <!-- poner la condición en la base de datos que si se encuentra serie o factura no se guarde -->
                                    <input class="form-control UpperCase text-center" ng-model="cambiaNumeroserie"  ng-blur="validaSerie(cambiaNumeroserie)" id="cambiaNumeroserie"  autocomplete="off" >
                                    <label>Número de serie</label>
                                </div>
                                <div style=" width:100%; margin-bottom: 10px  " class="form-floating mx-1 w-25">
                                        <select class="form-control form-group-md" ng-model="cambioProveedor" autocomplete="off" >
                                            <option selected="selected" value="" disabled >[Seleccione una opción..]</option>
                                            <option ng-repeat="(i, obj) in proveedor" value="{{obj.cve_proveedor}}">{{obj.razon_social}}</option>
                                        </select>
                                        <label>Proveedor</label>
                                    </div>
                                    <div style=" width:100%; margin-bottom: 10px  " class="form-floating mx-1 w-25">
                                        <input class="form-control UpperCase text-center" ng-model="cambiaNumerofactura" id="numerofactura"  autocomplete="off" >
                                        <label>Número de factura</label>
                                    </div>
                                    <div style=" width:100%; margin-bottom: 10px  " class="form-floating mx-1 w-25"> 
                                        <label for="start">Fecha de factura:</label>
                                    <input class="form-control UpperCase text-center" type="date" id="start" name="trip-start" value="1990-07-22" min="1999-01-01" max="2100-12-31" ng-model="cambioFechaFactura"/>
                                </div>
                                
                                <div style=" width:100%; margin-bottom: 10px  " class="form-floating mx-1 w-25">
                                    <input class="form-control UpperCase text-center" ng-model="cambiaSistemaoperativo" id="cambiaSistemaoperativo" autocomplete="off" >
                                    <label>Sistema operativo</label>
                                </div>
                                <div style=" width:100%; margin-bottom: 10px  " class="form-floating mx-1 w-25">
                                    <input class="form-control UpperCase text-center" ng-model="cambiaProcesador" id="cambiaProcesador" autocomplete="off" >
                                    <label>Procesador</label>
                                </div>
                                <div style=" width:100%; margin-bottom: 10px  " class="form-floating mx-1 w-25">
                                    <input class="form-control validanumericos text-center"  ng-model="cambiaVelocidadprocesador" id="cambiaVelocidadprocesador" autocomplete="off" >
                                    <label>Velocidad de procesador</label>
                                </div>
                                <div style=" width:100%; margin-bottom: 10px  " class="form-floating mx-1 w-25">
                                    <input class="form-control validanumericos text-center"  ng-model="cambiaMemoriaram" id="cambiaMemoriaram" autocomplete="off" >
                                    <label>Memoria ram</label>
                                </div>
                                <div style=" width:100%; margin-bottom: 10px  " class="form-floating mx-1 w-25">
                                    <input class="form-control UpperCase text-center"  ng-model="cambiaTipoalmacenamiento" id="cambiaTipoalmacenamiento" autocomplete="off" >
                                    <label>Tipo de almacenamiento</label>
                                </div>
                                <div style=" width:100%; margin-bottom: 10px  " class="form-floating mx-1 w-25">
                                    <input class="form-control validanumericos text-center"  ng-model="cambiaCapaalmacenamiento" id="capaalmacenamiento" autocomplete="off" >
                                    <label>C. de almacenamiento</label>
                                </div>
                        </div>
                    </div>
                </div>
                <!-- aca termina el cuerpo del modal -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" ng-click="cambioCaracteristica()">Guardar Datos</button>
                </div>
            </div>
        </div>
    </div>

    <!-- modal para ver -->
    <div class="modal fade bd-example-modal-lg"  style="width: 100%;" id="borrarModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header bg-primary">
            <h5 class="modal-title text-light" id="exampleModalLabel">VER EQUIPOS</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
        <div class="card-footer">
                        <!-- <div class="table-responsive"> -->
                            <table class="table table-striped table-bordered table-hover table-responsive " style="width: 100%;" id="tablaProduccion">
                                <thead>
                                <tr>
                                    <th > Equipo</th>
                                    <th> Marca</th>
                                    <th>Modelo</th>
                                    <th>Descripción</th>
                                    <th>Número de serie</th>
                                    <th>Nombre del proveedor</th>
                                    <th>Número de factura</th>
                                    <th>Fecha de factura</th>
                                    <th>Sistema operativo</th>
                                    <th> Procesador</th>
                                    <th> Velocidad de procesador</th>
                                    <th>Memoria ram</th>
                                    <th>Tipo de almacenamiento</th> 
                                    <th>Capacidad de almacenamiento</th>
                                    <th>Fecha de registro</th>
                                </tr>
                                </thead>
                                <tbody>
                                <!-- <tr ng-repeat="(i, obj) in vercaracteristicas track by i">      -->
                                                <td ><input class="sinborde my-class" w-25 ng-model=verEquipo  disabled></td> 
                                                <td ><input class="sinborde my-class" w-25 ng-model=verMarca  disabled></td>
                                                <td ><input class="sinborde my-class" w-25 ng-model=verModelo disabled></td>
                                                <td><input class="sinborde my-class" w-25 ng-model=verDescripcion  disabled></td>
                                                <td><input  class="sinborde my-class" w-25 ng-model=verSerie  disabled></td>
                                                <td><input  class="sinborde my-class" w-25 ng-model=verNombreProveedor disabled></td>
                                                <td><input  class="sinborde my-class" w-25 ng-model=verFactura disabled></td>
                                                <td><input  class="sinborde my-class" w-25 ng-model=verFechaFactura disabled></td>
                                                <td><input class="sinborde my-class"  w-25 ng-model=verSistema  disabled></td>
                                                <td><input class="sinborde my-class"  w-25 ng-model=verProcesador  disabled></td>
                                                <td><input class="sinborde my-class"  w-25 ng-model=verVelocidad  disabled></td>
                                                <td><input class="sinborde my-class"  w-25 ng-model=verRam  disabled></td>
                                                <td><input class="sinborde my-class"  w-25 ng-model=verAlmacenamiento  disabled></td>
                                                <td><input class="sinborde my-class"  w-25 ng-model=verCapacidad  disabled></td>
                                                <td><input class="sinborde my-class"  w-25 ng-model=verRegistro></td>
                                                
                                </tbody>
                            </table>
                        </div>
                    <!-- </div> -->
        
        </div>
        <!-- aca termina el cuerpo del modal -->
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        </div>
        </div>
    </div>
    </div>




    <main class="app-content">
        <div class="app-title">
            <div>
              <h1><i class="fas fa-boxes"></i> Caracteristicas de equipos</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
              <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
              <li class="breadcrumb-item"><a href="../../bienvenida/bienvenida/bienvenida.php">INICIO</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="card card-info" ng-show="perfilUsu.catalogo_equipos_captura == 1">
                        <div class="card-header">
                            <h3 class="card-title">ASIGNACIÓN DE CARACTERISTICAS </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row form-group form-group-sm">
                                <div class="col-lg-12 d-lg-flex d-grid gap-3">
                                    <div style="width: 100%;" class="form-floating mx-1">
                                        <select class="form-control form-group-md" ng-model="nombre" autocomplete="off" ng-blur="habilitarProducto(nombre)">
                                            <option selected="selected" value="" disabled >[Seleccione una opción..]</option>
                                            <option ng-repeat="(i, obj) in equipo" value="{{obj.cve_equipo}}">{{obj.nombre_equipo}}</option>
                                        </select>
                                        <label>Equipo</label>
                                    </div>
                                    <div style="width: 100%;  " class="form-floating mx-1 ">
                                        <input class="form-control UpperCase text-center" ng-model="marca" id="marca" autocomplete="off" ng-disabled="true">
                                        <label>Marca</label>
                                    </div>
                                    <div style="width: 100%;" class="form-floating mx-1">
                                        <input class="form-control UpperCase text-center" ng-model="modelo" id="modelo" autocomplete="off" ng-disabled="true">
                                        <label>Modelo</label>
                                    </div>
                                    <div style="width: 100%;" class="form-floating mx-1">
                                        <input class="form-control UpperCase text-center" ng-model="descripcion" id="descripcion" autocomplete="off" ng-disabled="true">
                                        <label>Descripción</label>
                                    </div>
                                    <div style="width: 100%" class="form-floating mx-1">
                                        <input class="form-control UpperCase text-center" ng-model="numeroserie" id="numeroserie" autocomplete="off" ng-blur="validaSerie(numeroserie)" ng-disabled="true">
                                        <label>Número de serie</label>
                                    </div>
                                </div>
                                <div class="col-lg-12 d-lg-flex">
                                    
                                    <div style="width: 100%; margin-top: 10px" class="form-floating mx-1">
                                        <select class="form-control form-group-md" ng-model="nombreProveedor" autocomplete="off" >
                                            <option selected="selected" value="" disabled >[Seleccione una opción..]</option>
                                            <option ng-repeat="(i, obj) in proveedor" value="{{obj.cve_proveedor}}">{{obj.razon_social}}</option>
                                        </select>
                                        <label>Proveedor</label>
                                    </div>
                                    <div style="width: 100%; margin-top: 10px " class="form-floating mx-1">
                                        <input class="form-control UpperCase text-center" ng-model="numerofactura" id="numerofactura"  autocomplete="off"  ng-disabled="true">
                                        <label>Número de factura</label>
                                    </div>
                                    <div  style=" width:100%; margin-top: 10px  " class="form-floating mx-1 w-25"> 
                                        <label for="start; style=font-size: smaller;">Fecha de factura:</label>
                                    <input class="form-control UpperCase text-center" type="date" id="start" name="trip-start" value="1990-07-22" min="1999-01-01" max="2100-12-31" ng-model="fechaFactura"/>
                                    </div>
                                    
                                    <div style="width: 100%; margin-top: 10px" class="form-floating mx-1">
                                        <input class="form-control UpperCase text-center" ng-model="sistemaoperativo" id="sistemaoperativo" autocomplete="off" ng-disabled="true">
                                        <label>Sistema operativo</label>
                                    </div>
                                    <div style="width: 100%; margin-top: 10px" class="form-floating mx-1">
                                        <input class="form-control UpperCase text-center" ng-model="procesador" id="procesador" autocomplete="off" ng-disabled="true">
                                        <label>Procesador</label>
                                    </div>
                                </div>
                                <div class="col-lg-12 d-lg-flex">
                                    <div style="width: 100%; margin-top: 10px" class="form-floating mx-1">
                                        <input class="form-control validanumericos text-center" ng-model="velocidadprocesador" id="velocidadprocesador" autocomplete="off" ng-disabled="true">
                                        <label>Velocidad de procesador</label>
                                    </div>
                                    <div style="width: 100%; margin-top: 10px" class="form-floating mx-1">
                                        <input class="form-control validanumericos text-center" ng-model="memoriaram" id="memoriaram" autocomplete="off" ng-disabled="true">
                                        <label>Memoria ram</label>
                                    </div>
                                    <div style="width: 100%; margin-top: 10px" class="form-floating mx-1">
                                        <input class="form-control UpperCase text-center" ng-model="tipoalmacenamiento" id="tipoalmacenamiento" autocomplete="off" ng-disabled="true">
                                        <label>Tipo de almacenamiento</label>
                                    </div>
                                    <div style="width: 100%; margin-top: 10px" class="form-floating mx-1">
                                        <input class="form-control validanumericos text-center" ng-model="capaalmacenamiento" id="almacenamiento" autocomplete="off" ng-disabled="true">
                                        <label>Capacidad de almacenamiento</label>
                                    </div>
                                   
                                    <!-- <div style="width: 100%;" class="form-floating mx-1">
                                        <input class="form-control validanumericos" ng-model="prueba" id="prueba2" autocomplete="off" ng-disabled="true">
                                        <label>Prueba</label>
                                    </div> -->
                                </div>
                                <div class="col-lg-12 d-lg-flex">
                                  
                                   
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
                            <h3 class="card-title">EQUIPOS CREADOS</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" style="width: 100%;" id="tablaEquipos">
                                    <thead>
                                    <tr>
                                        <th>Folio</th>
                                        <th>Equipo</th>
                                        <th>Marca</th>
                                        <!-- <th>Modelo</th> -->
                                        <!-- <th>Descripción</th> -->
                                        <!-- <th>Número de factura</th> -->
                                        <th>Número de serie</th>
                                        <!-- <th>Sistema operativo</th>
                                        <th> Procesador</th>
                                        <th> Velocidad de procesador</th>
                                        <th>Memoria ram</th>
                                        <th>Tipo de almacenamiento</th>
                                        <th>Capacidad de almacenamiento</th>
                                        <th>Fecha de registro</th> -->
                                        <th>Opciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr ng-repeat="(i, obj) in vercaracteristicas track by i">
                                                    <td class="text-center">{{obj.folio}}</td>
                                                    <td class="text-center">{{obj.nombre_equipo}}</td>
                                                    <td class="text-center">{{obj.marca}}</td>
                                                    <!-- <td class="text-center">{{obj.modelo}}</td> -->
                                                    <!-- <td class="text-center">{{obj.descripcion}}</td> -->
                                                    <!-- <td class="text-center">{{obj.numero_factura}}</td> -->
                                                    <td class="text-center">{{obj.numero_serie}}</td>
                                                    <!-- <td class="text-center">{{obj.sistema_operativo}}</td>
                                                    <td>{{obj.procesador}}</td>
                                                    <td class="text-center">{{obj.vel_procesador}}</td>
                                                    <td class="text-center">{{obj.memoria_ram}}</td>
                                                    <td class="text-center">{{obj.tipo_almacenamiento}}</td>
                                                    <td class="text-center">{{obj.capacidad_almacenamiento}}</td>
                                                    <td class="text-center">{{obj.fecha_ingreso}}</td> -->
                                                    <td class="text-center">
                                                        <span class= "btn btn-info btn-sm" title="Scanner" ng-click="scanner(obj.cve_cequipo)" data-toggle="modal" data-target="#modalScanner" data-whatever="@getbootstrap"><i class="fas fa-barcode"></i></span>
                                                        <button type="button" class="btn btn-info btn-sm"  ng-click="ver(obj.cve_cequipo, obj.nombre_equipo, obj.marca, obj.modelo, obj.descripcion,obj.numero_serie, obj.cve_proveedor, obj.numero_factura, obj.fecha_factura,
                                                            obj.sistema_operativo, obj.procesador, obj.vel_procesador, obj.memoria_ram, obj.tipo_almacenamiento, obj.capacidad_almacenamiento, obj.fecha_ingreso)"  data-toggle="modal" data-target="#borrarModal"><i class="far fa-eye"></i></button>
                                                        <button type="button" class="btn btn-warning btn-sm" ng-click="consultar(obj.cve_cequipo, obj.nombre_equipo, obj.marca, obj.modelo, obj.descripcion, obj.numero_serie, obj.cve_proveedor, obj.numero_factura, obj.fecha_factura,
                                                            obj.sistema_operativo, obj.procesador, obj.vel_procesador, obj.memoria_ram, obj.tipo_almacenamiento,
                                                            obj.capacidad_almacenamiento)" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-edit"></i></button>
                                                    </td>
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
    
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.0/dist/JsBarcode.all.min.js"></script>

    <script src="caracteristicas_vista_ajs.js"></script>

    <script src="../../../includes/js/jquery331.min.js"></script>

    <script src="../../../includes/js/sweetalert2.min.js"></script>

    <script src="../../../includes/bootstrap/js/bootstrap.js"></script>

    <script src="../../../includes/bootstrap/js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="../../../includes/css/datatables.min.css"/>
    <!-- <link rel="stylesheet" type="text/css" href="../../../includes/css/style.css"/> -->

    <script type="text/javascript" src="../../../includes/js/datatables.min.js"></script>

    <script src="../../../includes/js/data_tables_js/jquery.dataTables.min.js"></script>
    <script src="../../../includes/js/data_tables_js/dataTables.buttons.min.js"></script>
    <script src="../../../includes/js/data_tables_js/jszip.min.js"></script>
    <script src="../../../includes/js/data_tables_js/pdfmake.min.js"></script>
    <script src="../../../includes/js/data_tables_js/vfs_fonts.js"></script>
    <script src="../../../includes/js/data_tables_js/buttons.html5.min.js"></script>
    <script src="../../../includes/js/data_tables_js/buttons.print.min.js"></script>

   <script type="text/javascript">
        JsBarcode(".codigo").init();
    </script>