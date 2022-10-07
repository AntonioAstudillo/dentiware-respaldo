<?php include_once 'templates/admin/header.php'; ?>
<?php include_once 'templates/admin/barra.php'; ?>
<?php include_once 'templates/admin/menu.php';?>




<div class="content-wrapper">

   <div class="content-header text-left text-dark h5 lead">Nómina </div>
   <div class="container ">

      <div class="d-flex justify-content-center">
        <div id="cargando" class="spinner-border text-primary m-5 text-center" role="status" style="width: 8rem; height: 8rem;">
          <span class="visually-hidden">Loading...</span>
        </div>
      </div>


      <div id="tabla" class="row d-none">
         <div class="col-md-12">
            <table id="tablaNomina" class="table table-bordered  nowrap"  style = 'width:100%'>
               <thead  class="">
                 <tr class="text-center">
                     <th>Id</th>
                     <th>Nombre</th>
                     <th>Apellidos</th>
                     <th>Clabe</th>
                     <th>Cuenta Bancaria</th>
                     <th>Sueldo</th>
                     <th>RFC</th>
                  </tr>
               </thead>
               <tbody class="text-center"></tbody>
            </table>
         </div>
      </div>
   </div>
   <div id="btnPayPal" class="container-fluid d-none">
      <div class="row mt-4">
         <div class="col-lg-12 d-flex justify-content-center">
            <div id="paypal-button-container"></div>
         </div>
      </div>
   </div>
</div>


<?php include_once 'templates/admin/footer.php'; ?>

<!-- SCRIPT PARA DATATABLE Y DATATABLE RESPONSIVE  -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js" charset="utf-8"></script>
<script src="//cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.js" charset="utf-8"></script>


<!-- Scripts para botones en el datatable -->
<script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js" charset="utf-8" type="text/javascript"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js" charset="utf-8" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" charset="utf-8" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" charset="utf-8" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" charset="utf-8" type="text/javascript"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"  type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/datatables-buttons/2.2.0/js/buttons.print.min.js"></script>



<!-- SCRIPTS PARA PAYPAL Y MAIN -->
<script src="https://www.paypal.com/sdk/js?client-id=Ac_x7e9gx95FTFTfrBjXKi-uKaGvdUABUnVDgOdxfHbBjIhpUVSjlXigQ4PNgllL8SJ5xtYHiwzkkXgB&currency=MXN"></script>
<script src="<?php echo RUTA; ?>js/admin/nomina.js" charset="utf-8" type="module"></script>
