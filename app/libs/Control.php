<?php

/*La estructura de la url debe ser la siguiente, el primer parametro que obtenemos es el controlador, el segundo el metodo y los terceros los parametros*/
class Control{
   private $controlador;
   private $metodo;
   private $parametros;

   public function __construct(){
      //Inicializamos los atributos con valores por default
      $this->controlador = 'Views';
      $this->metodo = 'index';
      $this->parametros = array();

      $url = $this->separarURL();

      //Compruebo que el archivo del controlador exista dentro del directorio controllers
      if($url != '' && file_exists('../app/controladores/'.ucwords($url[0]).'.php'  ))
      {
         //si existe el controlador, se lo asignamos
         $this->controlador = ucwords($url[0]);
         unset($url[0]);
      }


      //Hacemos una instancia del controlador que nos mandaron por la URL
      require_once '../app/controladores/'.$this->controlador.'.php';
      $this->controlador = new $this->controlador;

      if(isset($url[1]))
      {
         //Si dentro de la clase exista el metodo, le asignamos a nuestro atributo(metodo) el valor que nos mandaron desde la url
         if(method_exists($this->controlador , $url[1]))
         {
            $this->metodo = $url[1];
            unset($url[1]);
         }
      }

      //asignamos los parametros a mi atributo

      //La funcion array_Values crea un array indexado con los valores que contenga un cierto arreglo
      $this->parametros = $url ? array_values($url) : [];

      //Aqui es donde sucede la magia, en esta parte mandamos a llamar al metodo dentro de la clase del controlador y a dicho metodo le mandamos parametros si es que hay
      //eso lo hacemos gracias a nuestra funcion call_user_func_array. Esta funcion manda a llamar a callback y le envia parametros
      call_user_func_array([$this->controlador , $this->metodo] , $this->parametros);

   }

   private function separarURL()
   {

      $url = '';

      if(isset($_GET['url']))
      {
         //Al string que nos mandaron, le quitamos el caracter / de la ultima posicion
         $url = rtrim($_GET['url'] , '/' );
         $url = rtrim($_GET['url'] , '\\');

         //limpiamos los valores que nos manden desde la url
         $url = filter_var($url , FILTER_SANITIZE_STRING);

         //Creamos un arreglo utilizando como delimitador el /
         $url = explode('/' , $url);
      }

      return $url;
   }
}



 ?>
