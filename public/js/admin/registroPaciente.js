   import {ruta} from '../config.js';

   window.onload = main;

   function main()
   {
      llenarSelectTratamiento();

      let btnPaciente = document.getElementById('btnPaciente');
      let nombrePaciente = document.getElementById('nombrePaciente');
      let apellidoPaciente = document.getElementById('apellidoPaciente');
      let edad = document.getElementById('edadPaciente');
      let telefono = document.getElementById('telefonoPaciente');
      let domicilio = document.getElementById('domicilioPaciente');
      let correo = document.getElementById('correoPaciente');
      let genero = document.getElementById('generoPaciente');
      let fechaCita = document.getElementById('fechaCita');
      let horaCita = document.getElementById('horaCita');


      btnPaciente.onclick = enviarDatos;
      nombrePaciente.addEventListener('change', validarNombre);
      apellidoPaciente.addEventListener('change', validarNombre);
      genero.addEventListener('change', validarGenero);
      edad.addEventListener('change' , validarEdad);
      telefono.addEventListener('change',validarTelefono);
      domicilio.addEventListener('change',validarDomicilio);
      correo.addEventListener('change',validarCorreo);
      document.getElementById('tratamientoPaciente').addEventListener('change',llenarSelectDentista);
      fechaCita.addEventListener('change' , validarFecha);
      horaCita.addEventListener('change',validarHora);

   }

   function cambiarValidacion()
   {
      if(document.getElementById('horaCita').classList.contains('is-valid'))
      {
         document.getElementById('horaCita').classList.remove('is-valid');
      }

      document.getElementById('horaCita').classList.add('is-invalid');

      if(document.getElementById('fechaCita').classList.contains('is-valid'))
      {
         document.getElementById('fechaCita').classList.remove('is-valid');
      }

      document.getElementById('fechaCita').classList.add('is-invalid');
   }

   function validarHora(e){

      const valor = e.target.value;
      const aux = valor.split(':');

      if(aux[0] < 9 || aux[0] > 21)
      {
         if(document.getElementById('horaCita').classList.contains('is-valid'))
         {
            document.getElementById('horaCita').classList.remove('is-valid');
         }

         document.getElementById('horaCita').classList.add('is-invalid');

      }
      else
      {
         if(document.getElementById('horaCita').classList.contains('is-invalid'))
         {
            document.getElementById('horaCita').classList.remove('is-invalid');
         }

         document.getElementById('horaCita').classList.add('is-valid');
      }

   }

   function validarFecha(){
      let valor = document.getElementById('fechaCita').value;


      if(moment(valor).isBefore(moment().format('YYYY-MM-D')))
      {

         if(document.getElementById('fechaCita').classList.contains('is-valid'))
         {
            document.getElementById('fechaCita').classList.remove('is-valid');
         }

         document.getElementById('fechaCita').classList.add('is-invalid');

      }
      else
      {
         if(document.getElementById('fechaCita').classList.contains('is-invalid'))
         {
            document.getElementById('fechaCita').classList.remove('is-invalid');
         }

         document.getElementById('fechaCita').classList.add('is-valid');
      }

   }

   function validarNombre(e)
   {
      let expresion = /^([a-zA-Z]+)(\s)?([a-zA-Z]+)?$/g;
      let valor = e.target.value;


      if(expresion.test(valor))
      {
         if(!e.target.classList.contains('is-valid'))
         {
            if(e.target.classList.contains('is-invalid'))
            {
               e.target.classList.remove('is-invalid');
            }

            e.target.classList.add('is-valid');
         }

      }
      else
      {
         if(!e.target.classList.contains('is-invalid'))
         {
            if(e.target.classList.contains('is-valid'))
            {
               e.target.classList.remove('is-valid');
            }

            e.target.classList.add('is-invalid');
         }
      }

   }

   function validarEdad(e)
   {
      let expresion = /^([0-99]+)$/g;

      let valor = e.target.value;


      if(expresion.test(valor))
      {
         if(!e.target.classList.contains('is-valid'))
         {
            if(e.target.classList.contains('is-invalid'))
            {
               e.target.classList.remove('is-invalid');
            }

            e.target.classList.add('is-valid');
         }

      }
      else
      {
         if(!e.target.classList.contains('is-invalid'))
         {
            if(e.target.classList.contains('is-valid'))
            {
               e.target.classList.remove('is-valid');
            }

            e.target.classList.add('is-invalid');
         }
      }
   }

   function validarTelefono(e)
   {
      let expresion = /^[0-9]{10}$/g;

      let valor = e.target.value;


      if(expresion.test(valor))
      {
         if(!e.target.classList.contains('is-valid'))
         {
            if(e.target.classList.contains('is-invalid'))
            {
               e.target.classList.remove('is-invalid');
            }

            e.target.classList.add('is-valid');
         }

      }
      else
      {
         if(!e.target.classList.contains('is-invalid'))
         {
            if(e.target.classList.contains('is-valid'))
            {
               e.target.classList.remove('is-valid');
            }

            e.target.classList.add('is-invalid');
         }
      }
   }


   function validarDomicilio(e){
      let expresion = /^([a-zA-Z0-9#,]\s?)+$/g;

      let valor = e.target.value;


      if(expresion.test(valor))
      {
         if(!e.target.classList.contains('is-valid'))
         {
            if(e.target.classList.contains('is-invalid'))
            {
               e.target.classList.remove('is-invalid');
            }

            e.target.classList.add('is-valid');
         }

      }
      else
      {
         if(!e.target.classList.contains('is-invalid'))
         {
            if(e.target.classList.contains('is-valid'))
            {
               e.target.classList.remove('is-valid');
            }

            e.target.classList.add('is-invalid');
         }
      }
   }

   function validarGenero()
   {
      let valor = document.getElementById('generoPaciente');

      if(valor.value == 'N')
      {
         if(!valor.classList.contains('is-valid'))
         {
            valor.classList.add('is-invalid');
         }else{
            valor.classList.remove('is-valid');
         }

         valor.classList.add('is-invalid');

      }
      else
      {
         if(valor.classList.contains('is-invalid'))
         {
            valor.classList.remove('is-invalid');
         }

         valor.classList.add('is-valid');
      }
   }


   function validarCorreo(e)
   {
      let expresion = /^(([^<>()[\]\.,&%$#!=?¡¿;:\s@\"]+(\.[^<>()[\]\.,&%$#!=?¡¿;:\s@\"]+)*)|(\".+\")){2,63}@(hotmail.com|gmail.com|uteg.edu.mx|outlook.com)$/i

      let valor = e.target.value;


      if(expresion.test(valor))
      {
         if(!e.target.classList.contains('is-valid'))
         {
            if(e.target.classList.contains('is-invalid'))
            {
               e.target.classList.remove('is-invalid');
            }

            e.target.classList.add('is-valid');
         }

      }
      else
      {
         if(!e.target.classList.contains('is-invalid'))
         {
            if(e.target.classList.contains('is-valid'))
            {
               e.target.classList.remove('is-valid');
            }

            e.target.classList.add('is-invalid');
         }
      }
   }

   /**Aqui termina el bloque de funciones de  validaciones*/

   /*Aqui comienza el bloque de funciones complementarias*/

   /*En esta función, voy a llenar el select de tratamiento por medio de una peticion a la BD*/
   function llenarSelectTratamiento(){
      //Instanciamos la clase XMLHttpRequest()
      let req = new XMLHttpRequest();
      let cadena = "<option selected disabled value = 'e'>Elige un tratamiento</option>";

      req.open('POST', ruta + 'administrador/getTratamientos');

      req.onreadystatechange = function(){

         if(req.status == 200 && req.readyState == 4)
         {
            let valor = JSON.parse(req.responseText);

            for (let i = 0; i < valor.length; i++) {
               cadena += `<option value = "${i}">${valor[i]['nombre']}</option>`;
            }

            document.getElementById('tratamientoPaciente').innerHTML = cadena;
         }

      }

      req.send(null);

   }//cierra funcion llenarSelectTratamiento

   /*Con esta funcion voy a limpiar los estilos del formulario. O sea, le voy a quitar la validation bootstrap*/
   function limpiarEstilos()
   {
      let nombrePaciente = document.getElementById('nombrePaciente');
      let apellidoPaciente = document.getElementById('apellidoPaciente');
      let edad = document.getElementById('edadPaciente');
      let telefono = document.getElementById('telefonoPaciente');
      let domicilio = document.getElementById('domicilioPaciente');
      let correo = document.getElementById('correoPaciente');
      let genero = document.getElementById('generoPaciente');
      let fechaCita = document.getElementById('fechaCita');
      let horaCita = document.getElementById('horaCita');


      nombrePaciente.classList.contains('is-valid') ? nombrePaciente.classList.remove('is-valid') : '';
      apellidoPaciente.classList.contains('is-valid') ? apellidoPaciente.classList.remove('is-valid') : '';
      edad.classList.contains('is-valid') ? edad.classList.remove('is-valid') : '';
      telefono.classList.contains('is-valid') ? telefono.classList.remove('is-valid') : '';
      domicilio.classList.contains('is-valid') ? domicilio.classList.remove('is-valid') : '';
      correo.classList.contains('is-valid') ? correo.classList.remove('is-valid') : '';
      genero.classList.contains('is-valid') ? genero.classList.remove('is-valid') : '';
      fechaCita.classList.contains('is-valid') ? fechaCita.classList.remove('is-valid') : '';
      horaCita.classList.contains('is-valid') ? horaCita.classList.remove('is-valid') : '';


   }

   function llenarSelectDentista()
   {
      // Instanciamos la clase XMLHttpRequest()
      let req = new XMLHttpRequest();
      let cadena = "<option selected disabled>Elige un dentista</option>";
      let cargo = document.getElementById('tratamientoPaciente').value;

      req.open('GET', ruta +'administrador/llenarSelectDentista/?cargo='+cargo);

      req.onreadystatechange = function(){

         if(req.status == 200 && req.readyState == 4)
         {
            let valor = JSON.parse(req.responseText);

            for (let i = 0; i < valor.length; i++) {
               cadena += `<option value = "${valor[i]['idPersona']}">${valor[i]['nombre']} ${valor[i]['apellidos']}</option>`;
            }

            document.getElementById('dentistaPaciente').innerHTML = cadena;
         }

      }

      req.send();
   }

   function mensajeError(mensaje){
      Swal.fire({
         position: 'top-end',
         icon: 'error',
         title: mensaje,
         showConfirmButton: false,
         timer: 1500
      });
   }

   function mensajeRegistroGood(){

      Swal.fire(
            'Buen trabajo!',
            'El paciente se registró correctamente!',
            'success'
         ).then(function(){
            document.getElementById('formPaciente').reset();
            limpiarEstilos();
         });
   }

   //fechaCita  horaCita
   //Antes de enviar los datos vamos a validar que los datos de la fecha y hora sean correctos
   function validarHoraFecha(){
      const hora = document.getElementById('horaCita').value;
      const fecha = document.getElementById('fechaCita').value;
      const aux = hora.split(':');

      if( !(aux[0] < 9 || aux[0] > 21) ){
         //ahora validamos la fecha
         if(!moment(fecha).isBefore(moment().format('YYYY-MM-D'))){
            return true;
         }else{
            return false;
         }
      }else{
         return false;
      }
   }

   /*
      En esta función, vamos a enviar los datos que el usuario haya ingresado en el formulario al controlador.
    */
   function enviarDatos(e)
   {
      //Antes de enviar los datos, vamos a revisar que la cita y hora sean en dias correctos
      if(validarHoraFecha())
      {
         let req = new XMLHttpRequest();
         let data = $('#formPaciente').serialize();


         req.open('POST', ruta + 'administrador/registrarPaciente');
         req.setRequestHeader("content-type","application/x-www-form-urlencoded");

         req.onreadystatechange = function()
         {
            if(req.status == 200 && req.readyState == 4)
            {
               let valor = req.responseText;

               console.log(valor);

               switch(valor)
               {
                  case 'nombre':
                     mensajeError('Verifiqué el nombre');
                  break;
                  case 'apellido':
                     mensajeError('Verifiqué los apellidos');
                  break;
                  case 'telefono':
                     mensajeError('Teléfono incorrecto');
                  break;
                  case 'edad':
                     mensajeError('Edad incorrecta');
                  break;
                  case 'false 1':
                     mensajeError('Datos incorrectos');
                  break;
                  case 'false 2':
                     mensajeError('Eliga un doctor');
                  break;
                  case 'domicilio':
                     mensajeError('Domicilio incorrecto');
                  break;
                  case 'correo':
                     mensajeError('Correo incorrecto');
                  break;
                  case 'genero':
                     mensajeError('Genero incorrecto');
                  break;
                  case 'good':
                     mensajeRegistroGood();
                  break;
                  case 'cita':
                     mensajeError('Cita ocupada');
                     cambiarValidacion();
                  break;
               }
            }
         }

         req.send(data);

      }else{
         mensajeError('Datos de la cita incorrectos');
      }

      e.preventDefault();



   }
