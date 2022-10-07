(() => {
   window.onload = main;

   function main(){

      let boton = document.getElementById('btnConsultaFree');

      document.getElementById('btnNoticias').addEventListener('click' , registrarCorreo);

      if(boton != null){
         boton.addEventListener('click' , guardarDatos);
      }

   }

   function registrarCorreo(e)
   {
      e.preventDefault();

      let correo = document.getElementById('correoNoticias').value;

      if(correo !== ''){
         peticionNoticias(correo);
      }else{
         Swal.fire('Debe ingresar un correo');
      }
   }

   function peticionNoticias(correo)
   {
      const req = new XMLHttpRequest();
      const formData = new FormData();

      formData.append('correo' , correo);

      req.open('POST','../controllers/noticiaController.php');

      req.onreadystatechange = function ()
      {

         if(req.readyState == 4 && req.status == 200)
         {

            if(req.responseText == 'good')
            {
               Swal.fire(
               'Buen trabajo!',
               'Su correo se registro correctamente!',
               'success'
            ).then(  () => location.reload());
            }
            else
            {
               Swal.fire(
                  'No pudimos concretar la petición!',
                  'Error al hacer la petición!',
                  'error'
               );
            }

         }

      }

      req.send(formData);
   }

   function guardarDatos(){

      //Mostrarmos spinner y ocultamos boton
      mostrarSpinner();
      ocultarBoton();


      //Aqui capturo los datos para poder hacer la peticion a archivo .php y guardarlos en la tabla
      let nombre = document.getElementById('nombre').value;
      let telefono = document.getElementById('telefono').value;
      let correo = document.getElementById('correo').value;
      let tipo = document.getElementById('tipoTratamiento').value;
      let mensaje = document.getElementById('mensaje').value;

      //Creamos un objeto de tipo formData, para poder enviar los datos del formulario en la peticion
      let formData = new FormData();

      formData.append('nombre' , nombre);
      formData.append('telefono',telefono);
      formData.append('correo',correo);
      formData.append('tratamiento',tipo);
      formData.append('mensaje', mensaje);

      // Hacemos la peticion asincrona al controlador consultaController para poder guardar los datos en la tabla
      let peticion = new XMLHttpRequest();
      peticion.open('POST','../controllers/consultaController.php');
      peticion.onreadystatechange = respuestaPeticion;
      peticion.send(formData);


      //En esta funcion voy a validar que la peticion se haya hecho de forma correcta
      // y a su vez, mostrar un mensaje al usuario, donde se le diga que su consulta gratis fue registrada de forma correcta.
      function respuestaPeticion()
      {
         if(peticion.readyState == 4 && peticion.status == 200)
         {
            ocultarSpinner();
            mostrarBoton();

            console.log(peticion.responseText);

            if(peticion.responseText == 'true'){
               Swal.fire(
                  'Buen trabajo!',
                  'Tu consulta quedó registrada. Un colaborador te contactará a la brevedad!',
                  'success'
               );

               //Ahora limpiamos el formulario
               document.getElementById('formConsulta').reset();

            }else if(peticion.responseText == 'bad1'){
               Swal.fire(
                  'Ups!',
                  'Correo ya registrado!',
                  'error'
               );
            }
            else{
               Swal.fire(
                  'Ups!',
                  'Tuvimos un problema al realizar tu consulta!',
                  'error'
               );
            }
         }
      }
   }


   function mostrarSpinner(){
      document.getElementById('spinner').style.display = 'block';
   }

   function mostrarBoton(){
      document.getElementById('btnConsultaFree').style.display = 'block';
   }

   function ocultarSpinner(){
      document.getElementById('spinner').style.display = 'none';
   }

   function ocultarBoton(){
      document.getElementById('btnConsultaFree').style.display = 'none';
   }

})();
