<?php

session_start();

class Administrador extends Controlador
{

   private $modelo;
   private $datosUsuario;


   public function __construct()
   {
      if(!isset($_SESSION['usuario']))
      {
         header("location:". RUTA .'login/index');
         die();
      }


      $this->modelo = $this->modelo('AdministradorModelo');
      $this->datos = $this->modelo->getFoto($_SESSION['usuario']);
   }

   //mostramos la vista princial la cual es la de registro pacientes
   public function index()
   {
      $this->vista('registroPacientesVista' , $this->datos);
   }


   //retorno todos los tratamientos que tengamos almacenados en la database
   public function getTratamientos()
   {
      header("Content-Type: application/json");
      $result = $this->modelo->readAll();
      echo json_encode($result);
   }

   //llenamos el select de dentistas dentro del formulario de registro pacientes
   public function llenarSelectDentista()
   {
      header("Content-Type: application/json");

      $cargo = $_GET['cargo'];

      switch($cargo)
      {
         case 0:
            $cargo = 'Odontologo';
         break;
         case 1:
            $cargo = 'Pediatra';
         break;
         case 2:
            $cargo = 'Cirujano';
         break;
         case 3:
            $cargo = 'Odontologo';
         break;
         case 4:
            $cargo = 'Periodontologo';
         break;
         case 5:
            $cargo = 'General';
         break;
         case 6:
            $cargo = 'General';
         break;
         case 7:
            $cargo = 'General';
         break;
         case 8:
            $cargo = 'General';
         break;
         case 9:
            $cargo = 'Cirujano';
         break;
         default:
           $cargo = 1;
         break;
      }

      $result = $this->modelo->obtenerDentista($cargo);

      echo json_encode($result);

   }

   //registramos los datos del paciente en la database
   public function registrarPaciente()
   {
      $data = array();
      $bandera = array();

      if(isset($_POST))
      {

         $data['nombrePaciente'] = isset($_POST['nombrePaciente']) ? $_POST['nombrePaciente']  :  'null' ;
         $data['apellidoPaciente'] = isset($_POST['apellidoPaciente']) ? $_POST['apellidoPaciente'] :   'null';
         $data['edadPaciente'] = isset($_POST['edadPaciente']) ? $_POST['edadPaciente']  : 'null'  ;
         $data['telefonoPaciente'] = isset($_POST['telefonoPaciente']) ? $_POST['telefonoPaciente'] :  'null' ;
         $data['domicilioPaciente'] = isset($_POST['domicilioPaciente']) ? $_POST['domicilioPaciente'] :   'null' ;
         $data['fechaCita'] = isset($_POST['fechaCita']) ? $_POST['fechaCita']  :  'null' ;
         $data['horaCita'] = isset($_POST['horaCita']) ? $_POST['horaCita']  :  'null' ;
         $data['dentistaPaciente'] = isset($_POST['dentistaPaciente'])  ? $_POST['dentistaPaciente'] :   'null' ;
         $data['comentariosPaciente']  = isset($_POST['comentariosPaciente']) ? $_POST['comentariosPaciente'] :  'null' ;
         $data['correoPaciente'] = isset($_POST['correoPaciente']) ? $_POST['correoPaciente'] : 'null' ;
         $data['tratamientoPaciente']  = isset($_POST['tratamientoPaciente']) ? $_POST['tratamientoPaciente'] + 1 :  'null' ;
         $data['generoPaciente'] = isset($_POST['generoPaciente']) ? $_POST['generoPaciente'] : 'null' ;


         //Validamos que todos los datos no sean null
         if(Helpers::validarCampos($data))
         {
            //Acuerdate de + 1 al valor de idTratamiento

            /*Limpiamos todos los valores para evitar injection sql o XSS */
            $data['nombrePaciente'] = ucwords(Helpers::limpiarCadena($data['nombrePaciente']));
            $data['apellidoPaciente'] = ucwords(Helpers::limpiarCadena($data['apellidoPaciente']));
            $data['edadPaciente'] = Helpers::limpiarCadena($data['edadPaciente']);
            $data['telefonoPaciente'] = Helpers::limpiarCadena($data['telefonoPaciente']);
            $data['domicilioPaciente'] = ucwords(Helpers::limpiarCadena($data['domicilioPaciente']));
            $data['fechaCita'] = Helpers::limpiarCadena($data['fechaCita']);
            $data['horaCita'] = Helpers::limpiarCadena($data['horaCita']);
            $data['dentistaPaciente'] = Helpers::limpiarCadena($data['dentistaPaciente']);
            $data['comentariosPaciente']  = Helpers::limpiarCadena($data['comentariosPaciente']);
            $data['correoPaciente'] = Helpers::limpiarCadena($data['correoPaciente']);
            $data['tratamientoPaciente']  = Helpers::limpiarCadena($data['tratamientoPaciente']);
            $data['generoPaciente'] = Helpers::limpiarCadena($data['generoPaciente']);


            //Ya despues de limpiar los datos, vamos a comenzar a validarlos
            $bandera['nombre'] = Helpers::validarNombre($data['nombrePaciente']);
            $bandera['apellido'] = Helpers::validarNombre($data['apellidoPaciente']);
            $bandera['edad'] = Helpers::validarEdad($data['edadPaciente']);
            $bandera['telefono'] = Helpers::validarTelefono($data['telefonoPaciente']);
            $bandera['domicilio'] = Helpers::validarDomicilio($data['domicilioPaciente']);
            $bandera['correo'] = Helpers::correo($data['correoPaciente']);
            $bandera['genero'] = Helpers::generoValidar($data['generoPaciente']);
            $bandera = $this->modelo->validarCita($data['horaCita'] , $data['fechaCita'] , $data['dentistaPaciente'] , $this->modelo);


            if(!$bandera)
            {
               $resultado = $this->modelo->insertGeneric($data);

               if($resultado)
               {
                  echo 'good';
               }else{
                  echo 'false 1';
               }
            }
            else
            {
               echo $resultado;
            }
         }
         else
         {
            echo 'false 2';
         }
      }
   }

   //mostramos vista de registroDentistas
   public function dentistas()
   {
      $this->vista('dentistasVista' , $this->datos);
   }


   public function editarPacientes()
   {
      $this->vista('editarPacientesVista' , $this->datos);
   }

   public function editarDentistas()
   {
      $this->vista('editarDentistas' , $this->datos);
   }


   public function getAllPacientes()
   {
      header('Content-Type: application/json; charset=utf-8');
      $data = $this->modelo->getAll(2);
      echo json_encode($data);
   }


   public function getAllDentistas()
   {
      header('Content-Type: application/json; charset=utf-8');
      $data = $this->modelo->getAll(1);
      echo json_encode($data);
   }

   //comprobamos que el correo del dentista ingresado, no este ya registrado
   public function validarCorreoDentista()
   {
      $correo = Helpers::limpiarCadena($_POST['correo']);
      echo $this->modelo->checkEmail($correo);
   }


   public function registroDentista()
   {

      $data = array();
      $bandera = array();

      if(isset($_POST))
      {
         if(is_uploaded_file($_FILES['foto']['tmp_name']))
         {
            $data['nombreDentista'] = isset($_POST['nombreDentista']) ? $_POST['nombreDentista']  :  'null' ;
            $data['apellidoDentista'] = isset($_POST['apellidoDentista']) ? $_POST['apellidoDentista'] :   'null';
            $data['edadDentista'] = isset($_POST['edadDentista']) ? $_POST['edadDentista']  : 'null'  ;
            $data['telefonoDentista'] = isset($_POST['telefonoDentista']) ? $_POST['telefonoDentista'] :  'null' ;
            $data['domicilioDentista'] = isset($_POST['domicilioDentista']) ? $_POST['domicilioDentista'] :   'null' ;
            $data['generoDentista'] = isset($_POST['generoDentista']) ? $_POST['generoDentista']  :  'null' ;
            $data['correoDentista'] = isset($_POST['correoDentista']) ? $_POST['correoDentista']  :  'null' ;
            $data['especialidadDentista'] = isset($_POST['especialidadDentista'])  ? $_POST['especialidadDentista'] :   'null' ;
            $data['ssDentista']  = isset($_POST['ssDentista']) ? $_POST['ssDentista'] :  'null' ;
            $data['rfcDentista'] = isset($_POST['rfcDentista']) ? $_POST['rfcDentista'] : 'null' ;
            $data['cedulaDentista']  = isset($_POST['cedulaDentista']) ? $_POST['cedulaDentista']  :  'null' ;
            $data['horarioDentista'] = isset($_POST['horarioDentista']) ? $_POST['horarioDentista'] : 'null' ;
            $data['fechaIngreso'] = isset($_POST['fechaIngreso']) ? $_POST['fechaIngreso'] : 'null' ;
            $data['sueldoDentista'] = isset($_POST['sueldoDentista']) ? $_POST['sueldoDentista'] : 'null' ;
            $data['clabeDentista'] = isset($_POST['clabeDentista']) ? $_POST['clabeDentista'] : 'null' ;
            $data['numCuentaBanco'] = isset($_POST['numCuentaBanco']) ? $_POST['numCuentaBanco'] : 'null' ;
            $data['imagenDentista'] = Helpers::guardarFoto();

            //Validamos que todos los datos no sean null
            if(Helpers::validarCampos($data))
            {
               /*Limpiamos todos los valores para evitar injection sql o XSS */
               $data['nombreDentista'] = ucwords(Helpers::limpiarCadena($data['nombreDentista']));
               $data['apellidoDentista'] = ucwords(Helpers::limpiarCadena($data['apellidoDentista']));
               $data['edadDentista'] = Helpers::limpiarCadena($data['edadDentista']);
               $data['telefonoDentista'] = Helpers::limpiarCadena($data['telefonoDentista']);
               $data['domicilioDentista'] = ucwords(Helpers::limpiarCadena($data['domicilioDentista']));
               $data['correoDentista'] = Helpers::limpiarCorreo(Helpers::limpiarCadena($data['correoDentista']));
               $data['especialidadDentista'] = Helpers::limpiarCadena($data['especialidadDentista']);
               $data['ssDentista'] = Helpers::limpiarCadena($data['ssDentista']);
               $data['rfcDentista']  = Helpers::limpiarCadena($data['rfcDentista']);
               $data['cedulaDentista'] = Helpers::limpiarCadena($data['cedulaDentista']);
               $data['horarioDentista']  = Helpers::limpiarCadena($data['horarioDentista']);
               $data['fechaIngreso'] = Helpers::limpiarCadena($data['fechaIngreso']);
               $data['sueldoDentista'] = Helpers::limpiarCadena($data['sueldoDentista']);
               $data['clabeDentista'] = Helpers::limpiarCadena($data['clabeDentista']);
               $data['numCuentaBanco'] = Helpers::limpiarCadena($data['numCuentaBanco']);
               $data['generoDentista'] = Helpers::limpiarCadena($data['generoDentista']);
               $data['imagenDentista'] = Helpers::limpiarCadena($data['imagenDentista']);


               //Modificamos el valor del horario del dentista, de numerico lo convertimos a palabra.
               $data['horarioDentista'] = Helpers::crearTurno($data['horarioDentista']);


               //Esto es solo en prueba. Debo eliminarlo cuando comience a validar los datos del Dentista
               $resultado = 'good';

               if($resultado == 'good')
               {
                  $resultado = $this->modelo->registrarDentista($data);

                  if($resultado){
                     echo 'good';
                  }else{
                     echo 'false';
                  }
               }
               else
               {
                  echo $resultado;
               }
            }
            else
            {
               echo 'false';
            }

         }else{
            echo 'false1';
         }


      }//cierra if
   }



   public function actualizarDatosPaciente()
   {

      $data = array();

      $data['nombre'] = ucwords(Helpers::limpiarCadena($_POST['nombre']));
      $data['apellidos'] = ucwords(Helpers::limpiarCadena($_POST['apellidos']));
      $data['edad'] = Helpers::limpiarCadena($_POST['edad']);
      $data['telefono'] = Helpers::limpiarCadena($_POST['telefono']);
      $data['correo'] = Helpers::limpiarCadena($_POST['correo']);
      $data['direccion'] = Helpers::limpiarCadena($_POST['direccion']);
      $data['genero'] = Helpers::limpiarCadena($_POST['genero']);
      $data['idPersona'] = Helpers::limpiarCadena($_POST['id']);


      //despues de sanitizar los datos, los mandamos al modelo.
      $resultado = $this->modelo->changePaciente($data);

      echo $resultado;
   }


   public function actualizarDatosDentista()
   {

      $data = array();

      $data['nombre'] = ucwords(Helpers::limpiarCadena($_POST['nombre']));
      $data['apellidos'] = ucwords(Helpers::limpiarCadena($_POST['apellidos']));
      $data['edad'] = Helpers::limpiarCadena($_POST['edad']);
      $data['telefono'] = Helpers::limpiarCadena($_POST['telefono']);
      $data['correo'] = Helpers::limpiarCadena($_POST['correo']);
      $data['direccion'] = Helpers::limpiarCadena($_POST['direccion']);
      $data['genero'] = Helpers::limpiarCadena($_POST['genero']);
      $data['id'] = Helpers::limpiarCadena($_POST['id']);
      $data["especialidad"] = Helpers::limpiarCadena($_POST["especialidad"]);
      $data["clabe"] = Helpers::limpiarCadena($_POST["clabe"]);
      $data["numCuenta"] = Helpers::limpiarCadena($_POST["numCuenta"]);
      $data["sueldo"] = Helpers::limpiarCadena($_POST["sueldo"]);
      $data["fechaIngreso"] = Helpers::limpiarCadena($_POST["fechaIngreso"]);
      $data["rfc"] = Helpers::limpiarCadena($_POST["rfc"]);
      $data["cedula"] = Helpers::limpiarCadena($_POST["cedula"]);
      $data["nss"] = Helpers::limpiarCadena($_POST["nss"]);
      $data["turno"] = Helpers::limpiarCadena($_POST["turno"]);

      //despues de sanitizar los datos, los mandamos al modelo.
      $resultado = $this->modelo->updateDentist($data);

      if($resultado){
         echo true;
      }else{
         echo false;
      }
   }


   //generamos vista para eliminar dentista
   public function eliminarDentistas()
   {
      $this->vista('eliminarDentistasVista' , $this->datos);
   }

   public function eliminarDentista()
   {
      if(isset($_POST['id']))
      {
         $id = $_POST['id'];

         $resultado = $this->modelo->delete($id);

         if($resultado){
            echo 'true';
         }else{
            echo 'false';
         }

      }
      else
      {
         echo 'false';
      }
   }


   //generamos vista de eliminnar pacientes
   public function eliminarPacientes()
   {
      $this->vista('eliminarPacientesVista' , $this->datos);
   }

   //eliminamos un paciente de la database
   public function deletePaciente()
   {
      if(isset($_POST['id']))
      {

         $id = $_POST['id'];

         $resultado = $this->modelo->delete($id);

         if($resultado){
            echo 'true';
         }else{
            echo 'false';
         }

      }
      else
      {
         echo 'false';
      }

   }


   //generamos vista de buscarPacientes
   public function buscarPacientes()
   {
      $this->vista('buscarPacientesVista' , $this->datos);
   }


   //generamos la vista de buscarDentistas
   public function buscarDentistas()
   {
      $this->vista('buscarDentistasVista' , $this->datos);
   }


   //obtenemos información especifica del dentista, para mostrarlas en el modulo de busqueda dentistas
   public function getDentistas()
   {
      header('Content-Type: application/json; charset=utf-8');
      $data = $this->modelo->getDentistas(1);
      echo json_encode($data);
   }

   //generamos la vista nomina
   public function nomina()
   {
      $this->vista('nominaVista' , $this->datos);
   }

   //obtenemos los datos necesarios para generar la nomina
   public function getNomina()
   {
      header('Content-Type: application/json; charset=utf-8');
      $data = $this->modelo->getNomina();
      echo json_encode($data);
   }


   //obtenemos el salario para generar la nomina
   public function obtenerSalario()
   {
      $data = $this->modelo->getSalaryTotal();
      echo $data['total'];
   }


   //almacenamos los datos relacionados al nomina dentro de nuestra databse
   public function guardarNomina()
   {
      if(isset($_POST))
      {

         $_POST['date'] = Helpers::generarTime();;
         $resultado = $this->modelo->insertData($_POST);

         if($resultado > 0){
            echo 'true';
         }else{
            echo 'false';
         }

      }
   }

   //generamos la vista de pago citas
   public function pagoCitas(){
      $this->vista('cobroCitasVista' , $this->datos);
   }


   //obtenemos las citas para poder llenar el datatable de pago citas
   public function getPagoCitas()
   {
         $result = $this->modelo->getCitas();
         echo json_encode($result);
   }


   //obtenemos la informacion del dentista para mostrarla en el modal
   public function getDataDentista()
   {
      if(isset($_POST['idCita'] , $_POST['idPersona'] ))
      {
         header("Content-Type: application/json");
         $result = $this->modelo->getDataDentist($_POST);
         echo json_encode($result);
      }else{
         echo 'false';
      }
   }




   public function generarPagoCita()
   {
      //Este case me va servir para almacenar los datos en la tabla pagos.
      if(isset($_POST))
      {
         header("Content-Type: application/json");


         $_POST['time'] =  Helpers::generarTime();
         $result = $this->modelo->insertPago($_POST);

         if($result>=1){
            //ahora actualizamos el status de la cita
            $result = $this->modelo->updateAppointment($_POST['idCita']);

            //actualizamos tambien el historialtratamiento
            $result = $this->modelo->updateHistory($_POST);
            echo json_encode($result);
         }
         else
         {
            echo 'false';
         }

      }
      else
      {
         echo 'false';
      }

   }


   //obtenemos los datos del saldo para poder generar el ticket del pago de cita
   public function getSaldo()
   {

         if(isset($_POST['idPaciente']))
         {
            $resultado = $this->modelo->getSaldo($_POST['idPaciente']);
            echo $resultado;
         }
         else
         {
            echo 'false';
         }
   }


   //generamos la vista de crear cita
   public function generarCita()
   {
      $this->vista('crearCitaVista' , $this->datos);
   }



   //obtenemos los datos del paciente, para poder generar el datatable dentro del modulo de citas
   public function getPacientes()
   {
      header("Content-Type: application/json");
      $result = $this->modelo->getPacientes();
      echo json_encode($result);
   }

   //generamos cita
   public function crearCita()
   {
      if(isset($_POST))
      {

         $data = array();
         $bandera = array();

         $data['fechaCita'] = isset($_POST['fechaCita']) ? $_POST['fechaCita']  :  'null' ;
         $data['horaCita'] = isset($_POST['horaCita']) ? $_POST['horaCita']  :  'null' ;
         $data['dentistaPaciente'] = isset($_POST['dentistaPaciente'])  ? $_POST['dentistaPaciente'] :   'null' ;
         $data['comentario']  = isset($_POST['comentario']) ? $_POST['comentario'] :  'null' ;
         $data['tratamientoPaciente']  = isset($_POST['tratamientoPaciente']) ? $_POST['tratamientoPaciente'] + 1 :  'null' ;
         $data['idPaciente'] = $_POST['idPaciente'];


         //Validamos que todos los datos no sean null
         if(Helpers::validarCampos($data))
         {
            /*Limpiamos todos los valores para evitar injection sql o XSS */
            $data['fechaCita'] = Helpers::limpiarCadena($data['fechaCita']);
            $data['horaCita'] = Helpers::limpiarCadena($data['horaCita']);
            $data['dentistaPaciente'] = Helpers::limpiarCadena($data['dentistaPaciente']);
            $data['comentario']  = Helpers::limpiarCadena($data['comentario']);
            $data['tratamientoPaciente']  = Helpers::limpiarCadena($data['tratamientoPaciente']);



            //Ya despues de limpiar los datos, vamos a comenzar a validarlos
            $resultado = $this->modelo->validarCita($data['horaCita'] , $data['fechaCita'] , $data['dentistaPaciente']);

            //si resultado es false, significa que el dia y la hora no esta ocupados, asi que creamos la cita
            if(!$resultado)
            {
               $resultado = $this->modelo->createCita($data);

               if($resultado)
               {
                  echo 'good';
               }else{
                  echo 'false';
               }
            }
            else
            {
               echo $resultado;
            }
         }
         else
         {
            echo 'false';
         }
      }
   }

   //generamos vista de editarCita
   public function editarCita()
   {
      $this->vista('editarCitaVista' , $this->datos);
   }


   //actuaizamos la cita
   public function updateCita()
   {
      //Case usado para actualizar la cita
      if(isset($_POST))
      {
         $data = array();
         $bandera = array();

         $data['fechaCita'] = isset($_POST['fechaCita']) ? $_POST['fechaCita']  :  'null' ;
         $data['horaCita'] = isset($_POST['horaCita']) ? $_POST['horaCita']  :  'null' ;
         $data['dentistaPaciente'] = isset($_POST['dentistaPaciente'])  ? $_POST['dentistaPaciente'] :   'null' ;
         $data['comentario']  = isset($_POST['comentario']) ? $_POST['comentario'] :  'null' ;
         $data['tratamientoPaciente']  = isset($_POST['tratamientoPaciente']) ? $_POST['tratamientoPaciente'] + 1 :  'null' ;
         $data['idPaciente'] = $_POST['idPaciente'];


         //Validamos que todos los datos no sean null
         if(Helpers::validarCampos($data))
         {
            /*Limpiamos todos los valores para evitar injection sql o XSS */
            $data['fechaCita'] = Helpers::limpiarCadena($data['fechaCita']);
            $data['horaCita'] = Helpers::limpiarCadena($data['horaCita']);
            $data['dentistaPaciente'] = Helpers::limpiarCadena($data['dentistaPaciente']);
            $data['comentario']  = Helpers::limpiarCadena($data['comentario']);
            $data['tratamientoPaciente']  = Helpers::limpiarCadena($data['tratamientoPaciente']);


            //Ya despues de limpiar los datos, vamos a comenzar a validarlos
            $bandera = $this->modelo->validarCita($data['horaCita'] , $data['fechaCita'] , $data['dentistaPaciente']);

            if(!$bandera)
            {
               $resultado = $this->modelo->updateCita($data);

               if($resultado)
               {
                  echo 'good';
               }else{
                  echo 'false';
               }
            }
            else
            {
               echo 'false';
            }
         }
         else
         {
            echo 'false';
         }
      }
   }





   //generamos la vista de estadisticas

   public function estadisticas()
   {
      if(isset($_GET['bandera']))
      {
         header('Content-Type: application/json; charset=utf-8');

         switch($_GET['bandera'])
         {
            case '1':
               //Este case lo voy a utilizar para generar la grafica pieChart
               $resultado = $this->modelo->pieChart();

               echo json_encode($resultado);
            break;
            case '2':
               //Este case lo voy a utilizar para generar la grafica pieChart
               $resultado = $this->modelo->comboChart();

               echo json_encode($resultado);
            break;
         }
      }
      else
      {
         $this->vista('estadisticasVista' , $this->datos);
      }


   }

























}//cierra clase AdministradorModelo






 ?>
