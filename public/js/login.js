  import {ruta} from './config.js';

   window.onload = main;

   function main()
   {
      let btn = document.getElementById('btnIngresar');

     btn.addEventListener('click',onClick);

   }//cierra funcion main

   function onClick(e)
   {

     e.preventDefault();
     ocultarBoton();
     mostrarSpinner();

     grecaptcha.ready(function() { //ponemos clave pulica de recaptcha
            grecaptcha.execute('', {action: 'loguearse'}).then(function(token) {
            loguearse(token);
         });
     });
   }

   function mostrarSpinner(){
      document.getElementById('spinnerLogin').style.visibility = 'visible';
   }

   function ocultarSpinner(){
      document.getElementById('spinnerLogin').style.visibility = 'hidden';
   }

   function mostrarBoton(){
      document.getElementById('btnIngresarLogin').style.display = 'block';
   }

   function ocultarBoton(){

      document.getElementById('btnIngresarLogin').style.display = 'none';
   }

   function loguearse(token)
   {
      //Capturamos los datos e instanciamos el objeto para hacer las peticiones
      let formElement = document.getElementById('formLogin');
      let xhr = new XMLHttpRequest();
      let form = new FormData(formElement);

      form.append('token',token);

      xhr.open('POST' , ruta + 'login/validar');

      xhr.onreadystatechange = function(){

         if(xhr.readyState == 4 && xhr.status == 200)
         {
            console.log(xhr.responseText);

            if(xhr.responseText)
            {
               //guardamos al usuario en una variable global
               localStorage.setItem('usuario' , document.getElementById('name').value);
               goodMensaje('Bienvenido a Dentiware');
            }
            else
            {
               errorMensaje('Datos incorrectos!');
            }

            ocultarSpinner();
            mostrarBoton();
         }
      }//cierra callback

      xhr.send(form);
   }

   function errorMensaje(mensaje){
      Swal.fire({
        position: 'top-end',
        icon: 'error',
        title: mensaje,
        showConfirmButton: false,
        timer: 1500
      })
   }


   function goodMensaje(mensaje){
      Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: mensaje,
        showConfirmButton: false,
        timer: 1500
     }).then(()=>{
        window.location.href = ruta + 'administrador/index';
       })
   }
