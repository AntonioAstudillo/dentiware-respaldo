
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a  href="dashboard.php" class="brand-link text-center">
       <!-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
       <span class="brand-text font-weight-dark text-center">Dentiware</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
       <!-- Sidebar user panel (optional) -->
       <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
             <img src="<?php echo RUTA ?>images/dentistas/<?php echo $data['foto'] ?>" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
             <a href="#" class="d-block"><?php echo $data['nombre'];  ?></a>
          </div>
       </div>

       <!-- Sidebar Menu -->
       <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
             <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-user-plus"></i>
                  <p>Registrar
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo RUTA; ?>administrador/index" class="nav-link">
                      <i class="fas fa-user"></i>
                      <p>Pacientes</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo RUTA; ?>administrador/dentistas" class="nav-link">
                      <i class="fas fa-user-md"></i>
                      <p>Dentistas</p>
                    </a>
                  </li>
                </ul>
             </li>

             <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-user-edit"></i>
                  <p>
                    Editar
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo RUTA; ?>administrador/editarPacientes" class="nav-link">
                      <i class="fas fa-user"></i>
                      <p>Pacientes</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo RUTA; ?>administrador/editarDentistas" class="nav-link">
                      <i class="fas fa-user-md"></i>
                      <p>Dentistas</p>
                    </a>
                  </li>
                </ul>
             </li>

             <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-trash-alt"></i>
                  <p>
                    Eliminar
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo RUTA; ?>administrador/eliminarPacientes" class="nav-link">
                      <i class="fas fa-user"></i>
                      <p>Pacientes</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo RUTA; ?>administrador/eliminarDentistas" class="nav-link">
                      <i class="fas fa-user-md"></i>
                      <p>Dentistas</p>
                    </a>
                  </li>
                </ul>
             </li>


             <li class="nav-item">
                 <a href="#" class="nav-link">
                   <i class="fas fa-search"></i>
                   <p>
                     Buscar
                     <i class="right fas fa-angle-left"></i>
                   </p>
                 </a>
                 <ul class="nav nav-treeview">
                   <li class="nav-item">
                     <a href="<?php echo RUTA; ?>administrador/buscarPacientes" class="nav-link">
                       <i class="fas fa-user"></i>
                       <p>Pacientes</p>
                     </a>
                   </li>
                   <li class="nav-item">
                     <a href="<?php echo RUTA; ?>administrador/buscarDentistas" class="nav-link">
                       <i class="fas fa-user-md"></i>
                       <p>Dentistas</p>
                     </a>
                   </li>
                 </ul>
             </li>

             <li class="nav-item">
                 <a href="#" class="nav-link">
                   <i class="fas fa-cash-register"></i>
                   <p>
                     Finanzas
                     <i class="right fas fa-angle-left"></i>
                   </p>
                 </a>
                 <ul class="nav nav-treeview">
                   <li class="nav-item">
                     <a href="<?php echo RUTA; ?>administrador/nomina" class="nav-link">
                       <i class="fas fa-wallet"></i>
                       <p>Nómina</p>
                     </a>
                   </li>
                   <li class="nav-item">
                     <a href="<?php echo RUTA; ?>administrador/pagoCitas" class="nav-link">
                       <i class="fas fa-money-bill"></i>
                       <p>Citas</p>
                     </a>
                   </li>
                 </ul>
             </li>

             <li class="nav-item">
                <a href="#" class="nav-link">
                   <i class="fas fa-hospital"></i>
                   <p>
                     Citas
                     <i class="right fas fa-angle-left"></i>
                   </p>
                </a>
                <ul class="nav nav-treeview">
                 <li class="nav-item">
                    <a href="<?php echo RUTA; ?>administrador/generarCita" class="nav-link">
                      <i class="fas fa-plus"></i>
                      <p>Crear</p>
                    </a>
                 </li>
                 <li class="nav-item">
                    <a href="<?php echo RUTA; ?>administrador/editarCita" class="nav-link">
                     <i class="fas fa-edit"></i>
                      <p>Editar</p>
                    </a>
                 </li>
                </ul>
             </li>

             <li class="nav-item">
                <a href="<?php echo RUTA; ?>administrador/estadisticas" class="nav-link">
                   <i class="fas fa-chart-area"></i>
                   <p>
                     Estadísticas
                   </p>
                </a>
             </li>

            <?php if(isset($data['admin'])): ?>
               <li class="nav-item">
                  <a href="administrador.php" class="nav-link">
                     <i class="fas fa-user-shield"></i>
                     <p>
                       Administrador
                     </p>
                  </a>
               </li>
            <?php endif; ?>

          </ul>
       </nav>
       <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
 </aside>
