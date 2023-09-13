<?php
// session_start();
    include_once "../../../modulos/seguridad/login/datos_usuario.php";
    

    if (empty($_SESSION['usuario'])) {
        $type = "error";
        $detalle = "Sesi&oacute;n terminada.";
        $detalle .= "<ul><li>La sesi&oacute;n de usuario ha finalizado.</li>";
        $detalle .= "<li>Inicie sesi&oacute;n para acceder al sistema.</li></ul>";
        $url_continuar = "index.php";
        $br = "<br/><br/><br/><br/><br/><br/><br/><br/><br/>";
        include_once "../../../mensajes/message.php";
        exit();
    }else{
        $objeto = unserialize($_SESSION['usuario']);
        $nombre = $objeto->nombre_persona;
        $apellido = $objeto->apellido_persona;
        $puesto = $objeto->puesto_persona;
        $clave  = $objeto->rol_persona;
        $id  = $objeto->clave_usuario;
 ?>
<!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <!-- <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="../../../includes/imagenes/team_users.png" alt="User Image"> -->
        <!-- <div class="pull-left image"> -->
                <!-- <img src="../../../includes/imagenes/team_users.png" class="img-circle"> -->
        <!-- </div> -->
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar">
        <div>
          <p class="app-sidebar__user-name"><?php echo $nombre." ".$apellido?></p>
          <p class="app-sidebar__user-designation"><?php echo $puesto?></p>
        </div>
      </div>
    <!-- </div> -->
      <?php
?>
          <ul class="app-menu">
            <!-- dashboard -->
            <li class="treeview" ng-show="perfilUsu.dashboard_principal == 1">
              <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-chart-line"></i><span class="app-menu__label">Dashboard</span><i class="treeview-indicator fas fa-angle-right"></i></a>
                <ul class="treeview-menu">
                  <!-- <li>
                    <a class="treeview-item" href="../../dashboard/morteros/dashboard_morteros.php"><i class="icon fa fa-circle-o"></i> Morteros</a>
                  </li>
                  <li>
                    <a class="treeview-item" href="../../dashboard/bloqueras/dashboard_bloqueras.php"><i class="icon fa fa-circle-o"></i> Bloqueras</a>
                  </li>
                  <li>
                    <a class="treeview-item" href="../../dashboard/trituradora/dashboard_trituradora.php"><i class="icon fa fa-circle-o"></i> Trituradora</a>
                  </li> -->
                </ul>
            </li>
            <!-- catálogos -->
            <li class="treeview" >
              <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-book"></i><span class="app-menu__label">Catálogos</span><i class="treeview-indicator fas fa-angle-right"></i></a>
                <ul class="treeview-menu">
                  <li ng-show="perfilUsu.catalogo_equipos_vista == 1">
                    <a class="treeview-item" href="../../catalogos/alta-inventario/equipos_vista.php"><i class="icon fas fa-upload"></i> Equipos</a>
                  </li>
                  <li >
                    <a class="treeview-item" href="../../catalogos/equipos/caracteristicas_equipo.php"><i class="icon fas fa-tv"></i> Alta de equipos</a>
                  </li>
                  <li>
                  <a class="treeview-item" href="../../catalogos/servicios/servicio.php"><i class="icon fas fa-tools"></i> Servicios</a>
                </li>
                </ul>
            </li>
            <!-- asignación de equipos -->
            <li class="treeview">
              <a class="app-menu__item" href="#" data-toggle="treeview">
                <i class="app-menu__icon fas fa-network-wired"></i><span class="app-menu__label">Movimientos</span><i class="treeview-indicator fa fa-angle-right"></i>
              </a>
              <ul class="treeview-menu">
                <li>
                  <a class="treeview-item" href="../../movimientos/asignacion/asignacion.php"><i class="icon fas fa-user-check"></i> Asignación</a>
                </li>
                <li>
                  <a class="treeview-item" href="../../movimientos/mantenimiento/mantenimiento_vista.php"><i class="fas fa-laptop-house"></i>Mantenimiento</a>
                </li>
              </ul>
            </li>
            <!-- servicios de equipos -->
            <!-- <li class="treeview">
              <a class="app-menu__item" href="#" data-toggle="treeview">
                <i class="app-menu__icon fas fa-network-wired"></i><span class="app-menu__label">Servicios</span><i class="treeview-indicator fa fa-angle-right"></i>
              </a>
              <ul class="treeview-menu">
                <li>
                  <a class="treeview-item" href="../../catalogo/servicios/servicio.php"><i class="icon fa fa-circle-o"></i> Servicios</a>
                </li>
              </ul>
            </li> -->


            <!-- Seguridad -->
            <li class="treeview" ng-show="perfilUsu.seguridad_principal == 1">
              <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fas fa-cog"></i><span class="app-menu__label">Seguridad</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                  <li ng-show="perfilUsu.crear_usuarios_vista == 1">
                    <a class="treeview-item" href=""><i class="icon fa fa-circle-o"></i> Usuarios</a>
                  </li>
                </ul>
            </li>
            <!-- mis datos -->
            <li class="treeview">
              <a class="app-menu__item" href="#" data-toggle="treeview">
                <i class="app-menu__icon fas fa-user-cog"></i><span class="app-menu__label">Mis datos</span><i class="treeview-indicator fa fa-angle-right"></i>
              </a>
              <ul class="treeview-menu">
                <li>
                  <a class="treeview-item" href="../../misdatos/cambiopassword/vista_password.php"><i class="icon fa fa-circle-o"></i> Cambio de contraseña</a>
                </li>
              </ul>
            </li>
            <!-- cierre sesión -->
            <li>
              <a class="app-menu__item" href="">
                <i class="app-menu__icon fas fa-sign-out-alt"></i>
                <span class="app-menu__label" ng-click="cerrarsesion()">Cerrar sesi&oacute;n</span>
              </a>
            </li>
          </ul>
<?php 
      ?>

    </aside>
    <?php 
  }
     ?>