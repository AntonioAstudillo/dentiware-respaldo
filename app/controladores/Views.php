<?php

//aqui voy a declarar metodos genericos los cuales utilizare dentro de mis controladores
class Views extends Controlador
{
   private $modelo;

   public function __construct()
   {
      $this->modelo =  $this->modelo('ViewsModelo');
   }

   public function index()
   {
      $this->vista('homeVista');
   }


   public function about(){
      $this->vista('aboutVista');
   }


   public function servicios()
   {
      if(isset($_GET['id']))
      {
         //haremos una peticion a la base de datos y mandaremos a la vista de servicios, los respectivos datos de acuerdo al id que nos mandan
         $id = $_GET['id'];
           $resultado = $this->modelo->getTratamiento($id);

            if($resultado === false)
            {
               $resultado['nombre'] = 'Sin resultados';
               $resultado['precio'] = '0';
               $resultado['descripcion'] = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.';
               $resultado['imagen'] = 'not-found.jpg';
            }

            $this->vista('servicioVista' , $resultado);

      }
      else
      {
         $this->vista('serviciosVista');
      }

   }


   public function contacto(){
      $this->vista('contactoVista');
   }


}



 ?>
