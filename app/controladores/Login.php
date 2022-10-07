<?php

session_start();


class Login extends Controlador{

   private $modelo;
   private $bandera;

   public function __construct()
   {
      if(isset($_POST['token']))
      {
         $this->modelo = $this->modelo('LoginModelo');
         $this->validar();
      }
      else if(isset($_SESSION['usuario']))
      {
         header('Location:'. RUTA . 'administrador/index');
      }
      else
      {
         $this->index();
      }


   }


   public function index()
   {
      $this->vista('loginVista');
   }

   public function validar()
   {



         if(isset($_POST['name'] , $_POST['password'] , $_POST['token']))
         {

            /**
             * Antes de mandar los datos al modelo, tenemos que sanitizarlos y validarlos.
             *
             */
            //Incorporamos la clase donde tenemos implementandas las funciones.

            //Sanitizamos los datos.
            $nombre = Helpers::limpiarCadena($_POST['name']);
            $password = Helpers::limpiarCadena($_POST['password']);
            $token = Helpers::limpiarCadena($_POST['token']);

            if(Helpers::validarRecaptcha($token))
            {
               //Validamos los datos. acapulcoop7-
               $bandera =  Helpers::validarUsuario($nombre) ? true : false;

               if($bandera)
               {

                  $this->modelo->setUser($_POST['name']);
                  $this->modelo->setPassword(sha1($_POST['password']));
                  $resultado = $this->modelo->comprobarUsuario();

                  if($resultado)
                  {

                     $_SESSION['usuario'] = $nombre;

                     $resultado = $this->modelo->isAdmin($nombre);

                     if($resultado['tipo'] == '1'){

                        $_SESSION['admin'] = '1';
                     }

                     echo true;

                  }
                  else
                  {
                     echo false;
                  }

               }
               else
               {
                  echo false;
               }
            }
            else
            {
               echo false;
            }
         }else{
            $this->index();
         }
   }//cierra metodo validar


   public function cerrar()
   {
      session_destroy();
      $this->index();
   }



}//




 ?>
