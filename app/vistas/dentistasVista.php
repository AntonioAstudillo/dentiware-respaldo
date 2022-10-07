<?php include_once 'templates/admin/header.php'; ?>
<?php include_once 'templates/admin/barra.php'; ?>
<?php include_once 'templates/admin/menu.php';?>

<!-- Contenido -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header text-left text-dark h5">Registro Dentistas</div>
  <!-- /.content-header -->

  <div class="container-fluid">
    <form  id="formDentista" enctype="multipart/form-data" method="post">
       <div class="row">
          <div class="col-md-6 col-sm-12 mt-4">
             <div class="input-group">
                <span class="input-group-text"><i class="fas fa-sort-alpha-down"></i></span>
                <input type="text" class="form-control" id="nombreDentista" name="nombreDentista" value="" placeholder="Nombre del dentista">
             </div>
          </div>

          <div class="col-md-6 col-sm-12 mt-4">
             <div class="input-group">
                <span class="input-group-text" ><i class="fas fa-sort-alpha-down"></i></span>
                <input type="text" class="form-control" id="apellidoDentista" name="apellidoDentista" value="" placeholder="Apellidos del dentista">
             </div>
          </div>
       </div>



       <div class="row">
          <div class="col-md-6 col-sm-12 mt-4">
             <div class="input-group">
                <span class="input-group-text"><i class="fas fa-sort-numeric-up"></i></span>
                <input type="number" name="edadDentista" id="edadDentista" value="" class="form-control" placeholder="Edad del dentista">
             </div>

          </div>
          <div class="col-md-6 col-sm-12 mt-4">
             <div class="input-group">
                <span class="input-group-text"><i class="fas fa-phone-square"></i></span>
                <input type="text" name="telefonoDentista" id="telefonoDentista" value="" class="form-control" placeholder="Teléfono del dentista">
             </div>
          </div>
       </div>

       <div class="row">
          <div class="col-md-6 col-sm-12 mt-4">
             <div class="input-group">
                <span class="input-group-text"><i class="fas fa-venus-mars"></i></span>
                <select class="form-control" id="generoDentista" name="generoDentista">
                   <option value="N" selected disabled>Género</option>
                   <option value="M">Masculino</option>
                   <option value="F">Femenino</option>
                </select>
             </div>
          </div>

          <div class="col-md-6 col-sm-12 mt-4">
             <div class="input-group">
                <span class="input-group-text"><i class="fas fa-house-user"></i></span>
                <input type="text" name="domicilioDentista" id="domicilioDentista" value="" placeholder="Domicilio del dentista" class="form-control">
             </div>
          </div>
       </div>

       <div class="row">
          <div class="col-md-6 col-sm-12 mt-4">
             <div class="input-group">
                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                <input type="email" name="correoDentista" id="correoDentista" value="" placeholder="Email del dentista" class="form-control" >
             </div>
          </div>

          <div class="col-md-6 col-sm-12 mt-4">
             <div class="input-group">
               <span class="input-group-text"><i class="fas fa-user-md"></i></span>
               <select class="form-control" name="especialidadDentista" id="especialidadDentista">
                  <option value="0" disabled selected>Elige una especialidad</option>
                  <option value="1">Odontopediatra</option>
                  <option value="2">Peridoncista</option>
                  <option value="3">Cirujano Maxilofacial</option>
                  <option value="3">Cirujano Dentista</option>
                  <option value="4">Dentista general</option>
                  <option value="5">Odontologo</option>
               </select>
             </div>
          </div>
       </div>

       <div class="row">
          <div class="col-md-6 col-sm-12 mt-4">
             <div class="input-group ">
               <span class="input-group-text"><i class="fas fa-hospital-symbol"></i></span>
               <input type="text" name="ssDentista" id="ssDentista"   value="" class="form-control" placeholder="Número de seguro social">
             </div>
          </div>
          <div class="col-md-6 col-sm-12 mt-4">
             <div class="input-group ">
               <span class="input-group-text"><i class="fas fa-id-card-alt"></i></span>
               <input type="text" name="rfcDentista" id="rfcDentista" value="" class="form-control" placeholder="RFC del dentista">
             </div>
          </div>
       </div>

       <div class="row">
          <div class="col-md-6 col-sm-12 mt-4">
             <div class="input-group">
               <span class="input-group-text"><i class="fas fa-id-card"></i></span>
               <input type="text" name="cedulaDentista" id="cedulaDentista" value="" class="form-control" placeholder="Cédula profesional">
             </div>
          </div>
          <div class="col-md-6 col-sm-12 mt-4">
           <div class="input-group">
               <span class="input-group-text"><i class="fas fa-clock"></i></span>
               <select  id="horarioDentista" class="form-control" name="horarioDentista">
                  <option value="0" disabled selected>Horario</option>
                  <option value="1">Diurno</option>
                  <option value="2">Vespertino</option>
               </select>
           </div>
          </div>
       </div>

       <div class="row">
         <div class="col-md-6 col-sm-12 mt-4">
            <div class="input-group">
               <span class="input-group-text"><i class="fas fa-calendar"></i></span>
               <input type="date" name="fechaIngreso" id="fechaIngreso" value="" class="form-control" placeholder="Fecha Ingreso">
            </div>
         </div>

         <div class="col-md-6 col-sm-12 mt-4">
            <div class="input-group">
               <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
               <input type="number" name="sueldoDentista" id="sueldoDentista" value="" class="form-control" placeholder="Sueldo">
            </div>
         </div>
       </div>

       <div class="row">
          <div class="col-md-6 col-sm-12 mt-4">
             <div class="input-group">
               <span class="input-group-text"><i class="fas fa-money-check-alt"></i></span>
               <input type="text" name="clabeDentista" id="clabeDentista" value="" class="form-control" placeholder="Clabe bancaria">
            </div>
          </div>
          <div class="col-md-6 col-sm-12 mt-4">
             <div class="input-group">
               <span class="input-group-text"><i class="fas fa-money-check"></i></span>
               <input type="text" name="numCuentaBanco" id="numCuentaBanco" value="" class="form-control" placeholder="Número de cuenta bancaria">
            </div>
          </div>
       </div>
       <div class="row">
          <div class="col-6 mt-4">
             <label class="form-label" for="foto">Imagen del Dentista</label>
             <input id="foto" class="form-control form-control-sm" name="foto" type="file" />
          </div>

       </div>
   </form>
   <div class="row mt-2 mb-3">
      <div class="col text-right">
         <input type="button" id="btnDentista" value="Registrar" class="btn btn-primary font-weight-bold">
      </div>
   </div>
 </div><!--/. container -->


</div>

<?php include_once 'templates/admin/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
<script src="<?php echo RUTA; ?>js/admin/registroDentista.js" charset="utf-8" type="module"></script>
