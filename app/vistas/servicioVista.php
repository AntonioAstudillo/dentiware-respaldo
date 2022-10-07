


<!doctype html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Dentiware - Servicios</title>
	<link rel="stylesheet" href="<?php echo RUTA;?>css/style-starter.css">
	<link href="//fonts.googleapis.com/css?family=Poppins:300,400,400i,500,600,700&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
   <link rel="stylesheet" href="<?php echo RUTA;?>css/estilos.css">
</head>

<body>
   <?php require_once 'templates/headerTop.php'; ?>
   <?php require_once 'templates/header.php'; ?>

	<nav id="breadcrumbs" class="breadcrumbs">
		<div class="container page-wrapper">
		</div>
	</nav>

	<div class="w3l-services-block py-5" id="classes">
		<div class="container py-lg-5 py-md-5">
         <section class="features-4">
            <main id="main" class="main-page">
             <!-- ======= Speaker Details Sectionn ======= -->
             <section id="speakers-details">
               <div class="container">
                  <div class="section-header">
                     <h2><?php echo $data['nombre'] ?></h2>
                     <p>El mejor equipo para tu cuidado.</p>
                  </div>

                  <div class="row">
                     <div class="col-md-12">
                        <img src="<?php echo RUTA; ?>images/tratamientos/<?php echo $data['imagen'] ?>" alt="Speaker 1" class="img-fluid">
                     </div>
                  </div>

                  <div class="row">
                     <div class="col-md-12">
                        <div class="details">
                           <h2 class="mt-2">$<span><?php echo $data['precio'] ?></span></h2>
                           <div class="social disabled-link ">
                              <a href=""><i class="bi bi-emoji-smile-fill"></i></a>
                              <a href=""><i class="bi bi-shield-fill-check"></i></a>
                              <a href=""><i class="bi bi-star-fill"></i></a>
                              <a href=""><i class="bi bi-check-square-fill"></i></a>
                           </div>
                           <div class="container border-0">
                              <p class="descripcion "><?php echo $data['descripcion'] ?></p>
                           </div>
                        </div>
                     </div>
                  </div>

               </div>

             </section>

            </main><!-- End #main -->
         </section>
		</div>
	</div>



   <?php require_once 'templates/footer.php'; ?>
</body>
<?php require_once 'templates/scripts.php'; ?>

</html>
