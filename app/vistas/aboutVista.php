<?php require_once 'templates/head.php'; ?>


<body>
   <?php require_once 'templates/headerTop.php'; ?>
   <?php require_once 'templates/header.php'; ?>
	<nav id="breadcrumbs" class="breadcrumbs">
		<div class="container page-wrapper">
			<a href="<?php echo RUTA; ?>">Inicio</a> » <span class="breadcrumb_last" aria-current="page">Sobre Nosotros</span>
		</div>
	</nav>

<section class="w3l-feature-1">
	<div class="feature-1sec py-5">
		<div class="container py-lg-5">
			<div class="feature-1-content">
				<img src="<?php echo RUTA;?>images/banner2.jpg" class="img-fluid" alt="" />
				<h3 class="hny-title mt-4">Bienvenido a nuestra clinica </h3>
				<p class="mt-2">En DENTIWARE sabemos que la salud de su boca es lo más importante.  Por eso nos dedicamos a ofrecer la mejor atención dental, a precios muy asequibles. Y sin olvidarnos de la atención personalizada a cada uno de nuestros pacientes.</p>
				<div class="read">
					<a class="btn mt-4" href="servicios.php">Leer más</a>
				</div>
			</div>
		</div>
	</div>
</section>

	<section class="w3l-content-4">
		<div class="content-4-main py-5">
			<div class="container py-lg-5">
				<div class="content-info-in row">
					<div class="content-right col-lg-6 pl-lg-4">
						<div class="row content4-right-grids mb-lg-5 mb-4">
							<div class="col-md-2 content4-right-icon">
								<div class="content4-icon">
									<span class="fa fa-linode"></span>
								</div>
							</div>
							<div class="col-md-10 content4-right-info">
								<h6>Chequeos anuales</h6>
								<p>Un chequeo dental ayuda a mantener la boca sana y permite que el dentista pueda ver si tiene algún problema dental.</p>
							</div>

						</div>
						<div class="row content4-right-grids mb-lg-5 mb-4">
							<div class="col-md-2 content4-right-icon">
								<div class="content4-icon">
									<span class="fa fa-heartbeat"></span>
								</div>
							</div>
							<div class="col-md-10 content4-right-info">
								<h6>Tu sonrisa nuestra pasion</h6>
								<p>Nuestro personal ha sido escogido por sus valores, buscamos buenas personas que se preocupen por sus pacientes.</p>
							</div>

						</div>
						<div class="row content4-right-grids mb-lg-5 mb-4">
							<div class="col-md-2 content4-right-icon">
								<div class="content4-icon">
									<span class="fa fa-handshake-o"></span>
								</div>
							</div>
							<div class="col-md-10 content4-right-info">
								<h6>Cuidamos tus dientes</h6>
								<p>Gracias a nuestro avanzado sistema de gestión de información, podrás ver paso a paso la evolución de tu sonrisa.</p>
							</div>

						</div>
					</div>
					<div class="content-left col-lg-6 pl-lg-4">
						<h6 class="sub-title">Quiénes somos</h6>
						<h3 class="hny-title">Por qué buscarnos</h3>
						<p>Todos nuestros tratamientos y servicios se brindan en cómodas instalaciones con los más altos estándares de calidad.</p>
					   <img src="<?php echo RUTA;?>images/ab2.jpg" class="img-fluid mt-3" alt="">
					</div>

a
				</div>

			</div>
		</div>
	</section>

		<section class="grids-1 py-5">
			<div class="grids py-lg-5">
				<div class="container">
					<h6 class="sub-title">Cuidamos tu sonrisa</h6>
					<h3 class="hny-title">Servicios destacados</h3>

					<div class="row text-center mt-lg-5 mt-4">
						<div class="col-lg-3 col-md-4 col-sm-6">
							<div class="column">
								<a href="<?php echo RUTA; ?>views/servicios/?id=5"><img src="<?php echo RUTA;?>images/g1.jpg" alt="" class="img-responsive" /></a>
								<h4><a href="<?php echo RUTA; ?>views/servicios/?id=5">Periodoncia</a></h4>
							</div>
						</div>
						<div class="col-lg-3 col-md-4 col-sm-6 mt-sm-0 mt-4">
							<div class="column">
								<a href="<?php echo RUTA; ?>views/servicios/?id=1"><img src="<?php echo RUTA;?>images/g2.jpg" alt="" class="img-responsive" /></a>
								<h4><a href="<?php echo RUTA; ?>views/servicios/?id=1" >Estética dental</a></h4>
							</div>
						</div>
						<div class="col-lg-3 col-md-4 col-sm-6 mt-md-0 mt-4">
							<div class="column">
								<a href="<?php echo RUTA; ?>views/servicios/?id=3"><img src="<?php echo RUTA;?>images/g3.jpg" alt="" class="img-responsive" /></a>
								<h4><a href="<?php echo RUTA; ?>views/servicios/?id=3" >Prótesis Dental</a></h4>
							</div>
						</div>
						<div class="col-lg-3 col-md-4 col-sm-6 mt-lg-0 mt-4">
							<div class="column">
								<a href="<?php echo RUTA; ?>views/servicios/?id=2"><img src="<?php echo RUTA;?>images/g4.jpg" alt="" class="img-responsive" /></a>
								<h4><a href="<?php echo RUTA; ?>views/servicios/?id=2" >Odontopediatría</a></h4>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- //grids -->
		<?php require_once 'templates/footer.php'; ?>
</body>

</html>
<?php require_once 'templates/scripts.php'; ?>
