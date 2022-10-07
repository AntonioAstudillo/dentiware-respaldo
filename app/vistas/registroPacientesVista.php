<?php include_once 'templates/admin/header.php'; ?>
<?php include_once 'templates/admin/barra.php'; ?>
<?php include_once 'templates/admin/menu.php';?>


<!-- Contenido -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header text-left text-dark h5">Registro Pacientes</div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <form  id="formPaciente" method="post">
         <div class="row">
            <div class="col-md-6 col-sm-12 mt-1">
               <div class="input-group mb-3">
                  <span class="input-group-text"><i class="fas fa-sort-alpha-down"></i></span>
                  <input type="text" class="form-control" id="nombrePaciente" name="nombrePaciente" value="" placeholder="Nombre del paciente">
               </div>
            </div>

            <div class="col-md-6 col-sm-12 mt-1">
               <div class="input-group mb-3">
                  <span class="input-group-text" ><i class="fas fa-sort-alpha-down"></i></span>
                  <input type="text" class="form-control" id="apellidoPaciente" name="apellidoPaciente" value="" placeholder="Apellidos del paciente">
               </div>
            </div>
         </div>



         <div class="row mt-2">
            <div class="col-md-6 col-sm-12 mt-1">
               <div class="input-group mb-3">
                  <span class="input-group-text"><i class="fas fa-sort-numeric-up"></i></span>
                  <input type="number" name="edadPaciente" id="edadPaciente" value="" class="form-control" placeholder="Edad del paciente">
               </div>

            </div>
            <div class="col-md-6 col-sm-12 mt-1">
               <div class="input-group mb-3">
                  <span class="input-group-text"><i class="fas fa-phone-square"></i></span>
                  <input type="text" name="telefonoPaciente" id="telefonoPaciente" value="" class="form-control" placeholder="Teléfono del paciente">
               </div>
            </div>
         </div>

         <div class="row mt-2">
            <div class="col-md-6 col-sm-12 mt-1">
               <div class="input-group mb-3">
                  <span class="input-group-text"><i class="fas fa-venus-mars"></i></span>
                  <select class="form-select" id="generoPaciente" name="generoPaciente">
                     <option value="N" selected disabled>Género</option>
                     <option value="M">Masculino</option>
                     <option value="F">Femenino</option>
                  </select>
               </div>
            </div>

            <div class="col-md-6 col-sm-12 mt-1">
               <div class="input-group mb-3">
                  <span class="input-group-text"><i class="fas fa-house-user"></i></span>
                  <input type="text" name="domicilioPaciente" id="domicilioPaciente" value="" placeholder="Domicilio del paciente" class="form-control">
               </div>
            </div>
         </div>

         <div class="row">
            <div class="col-md-6 col-sm-12 mt-3">
               <div class="input-group mb-3">
                  <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                  <input type="email" name="correoPaciente" id="correoPaciente" value="" placeholder="Email del paciente" class="form-control">
               </div>
            </div>

            <div class="col-md-6 col-sm-12 mt-3">
               <div class="input-group mb-3">
                  <span class="input-group-text"><i class="fas fa-tooth"></i></span>
                  <select class="form-select" id="tratamientoPaciente" name="tratamientoPaciente">
                  </select>
               </div>
            </div>
         </div>

         <div class="row">
            <div class="col-md-5 col-sm-12 mt-3">
               <div class="input-group mb-3">
                  <span class="input-group-text"><i class="fas fa-user-md"></i></span>
                  <select class="form-select" id="dentistaPaciente" name="dentistaPaciente"></select>
               </div>
            </div>

            <div class="col-md-4 col-sm-12 mt-3">
               <div class="input-group mb-3">
                  <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                  <input type="date" class="form-control" id="fechaCita" name="fechaCita" value="" class="form-control">
               </div>
            </div>

            <div class="col-md-3 col-sm-12 mt-3">
               <div class="input-group mb-3">
                  <span class="input-group-text"><i class="fas fa-clock"></i></span>
                  <input type="time" class="form-control" id="horaCita" name="horaCita" value="" class="form-control">
               </div>
            </div>
         </div>

         <div class="row">
            <div class="col-md-12 col-sm-12 mt-1">
               <div class="input-group">
                  <span class="input-group-text">Descripción</span>
                  <textarea id="comentariosPaciente" name="comentariosPaciente" class="form-control" style="resize:none;" aria-label="With textarea" placeholder="Ejemplo: El paciente cuenta con seguro facultativo."></textarea>
               </div>
            </div>
         </div>

         <div class="row mt-2 mb-3">
            <div class="col text-right">
               <input type="submit" id="btnPaciente" value="Registrar" class="btn btn-primary font-weight-bold">
            </div>
         </div>
      </form>
    </div><!--/. container -->
  </section><!-- /.content -->
</div>

<!-- Fin del contenido -->

<?php include_once 'templates/admin/footer.php'; ?>

<!-- CDN PARA TRABAJAR CON LA LIBRERIA MOMENTS.JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/moment.min.js"></script>
<script src="<?php echo RUTA;?>js/admin/registroPaciente.js" charset="utf-8" type="module"></script>
