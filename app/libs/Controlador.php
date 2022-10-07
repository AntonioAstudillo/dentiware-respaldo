<?php

//aqui voy a declarar metodos genericos los cuales utilizare dentro de mis controladores
class Controlador
{
   public function __construct(){}


   public function modelo($modelo)
   {
      require_once '../app/modelos/'.$modelo.'.php';
      return new $modelo();
   }

   public function vista($vista , $data = [] )
   {

      if(file_exists('../app/vistas/'.$vista.'.php'))
      {
         require_once '../app/vistas/'.$vista.'.php';
      }
   }
}



 ?>
