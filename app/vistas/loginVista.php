<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Login</title>
	   <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet">
	   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	   <link rel="stylesheet" href="<?php echo RUTA; ?>css/styles.css">
      <link rel="stylesheet" href="<?php echo RUTA; ?>css/login.css">
      <script src="https://www.google.com/recaptcha/api.js?render="></script> <!-- en render ponemos clave publica de recaptcha -->
	</head>
	<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-12 col-lg-10">

					<div class="wrap d-md-flex">
						<div class="text-wrap p-4 p-lg-5 text-center d-flex align-items-center order-md-last ocultarImagen"  style="background-image: url(<?php echo RUTA;?>images/ab1.jpg); background-size:cover;">
			         </div>

						<div class="login-wrap p-4 p-lg-5">

   			      	<div class="d-flex">

   			      		<div class="w-80">
   			      			<h3 class="mb-4">Bienvenido</h3>
   			      		</div>

   							<div class="w-100">

   								<p class="social-media d-flex justify-content-end">

   									<a target="_blank" href="https://www.facebook.com/Dentfer-Cl%C3%ADnica-Dental-112671450142247" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-facebook"></span>
                              </a>

   									<a target="_blank" href="https://twitter.com/cdental4" class="social-icon d-flex align-items-center justify-content-center">
                                 <span class="fa fa-twitter"></span>
                              </a>

                                 <a  href="<?php echo RUTA; ?>" class="social-icon d-flex align-items-center justify-content-center">
                                    <span class="fa fa-sign-out"></span>
                                 </a>
   									</p>
   							</div>
   			      	</div>

                     <form  id="formLogin" class="signin-form" method="POST">
   			      		<div class="form-group mb-3">
   			      			<label class="label" for="name">Usuario</label>
   			      			<input id="name" name="name" type="text" class="form-control" placeholder="Usuario" required  maxlength="15">
   			      		</div>
      		            <div class="form-group mb-3">
      		              <label class="label" for="password">Password</label>
      		              <input id="password" name="password" type="password" class="form-control" placeholder="Password" required maxlength="20">
      		            </div>

                        <div id="spinnerLogin" class="d-flex justify-content-center" style="visibility:hidden">
                           <div  class="spinner-border text-danger" role="status">
                           </div>
                        </div>


      		            <div id="btnIngresarLogin" class="form-group">
                         <button id="btnIngresar" type="button" class="form-control btn btn-primary submit px-3 g-recaptcha"  data-sitekey="6LcaSOkfAAAAAGgvOh5HZwxPyTXEs04NShZfAGf5" data-callback='onClick' data-action='submit'>Ingresar</button>
                      </div>
		              </form>


		            </div>
		         </div>
				</div>
			</div>
		</div>
   </section>
 <?php require_once 'templates/scripts.php'; ?>
  <script src="<?php echo RUTA; ?>js/login.js" charset="utf-8" type='module'></script>
</body>
</html>
