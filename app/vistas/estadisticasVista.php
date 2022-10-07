<?php include_once 'templates/admin/header.php'; ?>
<?php include_once 'templates/admin/barra.php'; ?>
<?php include_once 'templates/admin/menu.php';?>

<div class="content-wrapper">
   <div class="content-header text-left text-dark h5 lead">Estadisticas </div>

   <div class="row d-flex justify-content-between">
      <div class="col-md-12  border">
         <div id="piechart"></div>
      </div>
      <!-- <div class="col-md-6  border">
         <div id="curve_chart"></div>
      </div> -->
   </div>

   <div class="row">
         <div class="col-md-12 border">
            <div id="chart_div"></div>
         </div>
   </div>
</div>



<?php include_once 'templates/admin/footer.php'; ?>

<!-- SCRIPT PARA DATATABLE Y DATATABLE RESPONSIVE  -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js" charset="utf-8"></script>
<script src="//cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.js" charset="utf-8"></script>

<!-- SCRIPT PARA GOOGLE CHARTS -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>



<!-- MAIN -->
<script src="<?php echo RUTA; ?>js/admin/estadisticas.js" charset="utf-8" type="module"></script>
