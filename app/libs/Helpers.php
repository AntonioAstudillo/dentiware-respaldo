<?php


class Helpers{

   public static function limpiarCadena($dato)
   {
      $dato = filter_var($dato , FILTER_SANITIZE_STRING );
      $dato = strip_tags($dato);
      $dato = trim($dato);
      $dato = htmlentities($dato);
      $dato = htmlspecialchars($dato);
      $dato = addslashes($dato);

      return $dato;
   }

   public static function limpiarCorreo($correo)
   {
      $correo = filter_var($correo , FILTER_SANITIZE_EMAIL );
      $correo = strip_tags($correo);
      $correo = trim($correo);
      $correo = htmlentities($correo);
      $correo = htmlspecialchars($correo);

      return $correo;
   }


   public static function generoValidar($genero){
      if($genero == 'N'){
         return false;
      }else{
         return true;
      }
   }


   public static function correo($dato){
      $expresion = "/^(([^<>()[\]\.,&%$#!=?¡¿;:\s@\"]+(\.[^<>()[\]\.,&%$#!=?¡¿;:\s@\"]+)*)|(\".+\")){2,63}@(hotmail.com|gmail.com|uteg.edu.mx|outlook.com)$/";

      if(preg_match($expresion , $dato)){
         return true;
      }else{
         return false;
      }
   }

   /**
    * [En esta funcion validamos que los datos mandados desde el formulario, existan, no sean vacios y no sean iguales a null]
    * @param  [Array] $dato               [Arreglo de tipo POST]
    * @return [Boolean]       [Si alguno de los campos es incorrecto, regresamos false, de lo contrario true]
    */
   public static function validarCampos($dato)
   {
      $respuesta = true;

      foreach ($dato as $valor ) {
         if($valor == 'null' || !isset($valor) || empty($valor)){
            $respuesta = false;
            break;
         }
      }

      return $respuesta;
   }

   /**
    * [Con esta función, voy a validar que el telefono ingresado por el usuario, sea correcto]
    * @param  [String] $telefono               [telefono a validar]
    * @return [boolean]           [True si el telefono es correcto, false si es incorrecto]
    */
   public static function validarTelefono($telefono)
   {
      $expresion = "/^[0-9]{10}$/";

      if(preg_match($expresion , $telefono)){
         return true;
      }else{
         return false;
      }

   }

   /**
    * [Vamos a validar el nombre que ingresa el usuario]
    * @param  [String] $nombre               [Nombre a validar]
    * @return [Boolean]         [True si el nombre es correcto, false si es incorrecto]
    */
   public static function validarNombre($nombre)
   {
      $expre = "/^(([a-z]|[A-Z]){3,})\s?((([a-z]|[A-Z]){3,}))?\s?(([a-z]|[A-Z]){3,})?\s?(([a-z]|[A-Z]){3,})?$/";

      if(preg_match($expre , $nombre)){
         return true;
      }else{
         return false;
      }
   }

   /**
       * [En esta función, vamos a validar que el usuario sea correcto, un nombre de usuario es correcto cuando tiene de 5 a 10 letras y 1 o 3 numeros]
    * @param  [string] $usuario               [el usuario a ingresar]
    * @return [boolean]          [Retorna true si el usuario es correcto, caso contrario false]
    */
   public static function validarUsuario($usuario){
      $expre = "/^([a-zA-Z]{5,10})([0-9]{1,3})$/";

      if(preg_match($expre , $usuario)){
         return true;
      }else{
         return false;
      }
   }



   /**
    * [Con esta función, vamos a validar la contraseña. La contraseña tiene que tener un formato de 10 caractes, un numero y finalizar con 1 o 2 de estos caractes(.-_)]
    * @param  [string] $password               [contraseña a validar]
    * @return [boolean]           [retorna true si la contraseña es correcta, caso contrario false]
    */
   public static function validarPassword($password){
      $expre = "/^([A-Za-z]|[0-9]|[\!\#\%\$\&\/\(\)\=\¡\?]){10}[0-9]{1,3}[._-]{1,2}$/";

      if(preg_match($expre , $password)){
         return true;
      }else{
         return false;
      }
   }




   /**
    * [Con esta función, voy a validar que el correo ingresado por el usuario, no exista en la base de datos y que sea valido]
    * @param  [string] $correo               [Valor a validar]
    * @return [boolean]         [Retorno falso si el correo es incorrecto, caso contrario true]
    */

   public static function validarEmail($correo)
   {
      $objeto = new Consultas();

      if($objeto->validarCorreo($correo)){
         return false;
      }
      else{
         if(filter_var($correo , FILTER_VALIDATE_EMAIL)){
            return true;
         }else{
            return false;
         }
      }
   }

   /**
    * [En esta función, vamos a validar que el mensaje del usuario sea correcto]
    * @param  [text] $mensaje               [Mensaje a validar]
    * @return [boolean]          [Si es true, el mensaje es correcto, caso contrario false]
    */

   public static function validarMensaje($mensaje){
      $expre = '/^(([A-Z])\s?)+$/';

      if(preg_match($expre , $mensaje)){
         return true;
      }else{
         return false;
      }

   }

   /**
    * [Con esta función, voy a comprobar que todos los datos ingresados en el formulario sean correctos]
    * @param  [array] $bandera               [Es un arreglo, en el cual almacene el resultado de todas las validaciones]
    * @return [boolean]          [Si dentro del arreglo existe un valor en false, significa que unos de los datos ingresados por el usuario
    *                             fue incorrecto, así que retornamos false, caso contrario, true]
    */

   public static function comprobarDatos($bandera)
   {
      foreach ($bandera as $key ) {

         if(!$key){
            return false;
         }
      }

      return true;
   }


   public static function validarEdad($edad)
   {
      $bandera = true;

      $expre = "/^[0-9]+$/";

      if(preg_match($expre , $edad))
      {
         if($edad <= 100 && $edad > 0)
         {
            $bandera = true;
         }
         else
         {
            $bandera = false;
         }
      }
      else
      {
         $bandera =  false;
      }

      return $bandera;
   }

   public static function validarDomicilio($mensaje){
      $expre = '/^([a-zA-Z0-9#,]\s?)+$/';

      if(preg_match($expre , $mensaje)){
         return true;
      }else{
         return false;
      }
   }

   /**
    * [Con esta funcion compruebo que todos los datos del formulario esten correctos
    * La logica es mas o menos asi. Si el valor es false, retorno la llave]
    * @param  [array] $data               [Todos los datos del formulario ]
    * @return [string]       [bandera que voy a utilizar para comprobar el estado de mis datos]
    */


   public static function comprobarFormularioPaciente($data)
   {
      foreach ($data as $key => $value) {

         if(!$value){
            return $key;
         }
      }

      return 'good';
   }

   /**
    * [crearTurno Esta funcion me va servir para modificar el turno, y pueda guardarse en la base de datos como un palabra y no como un numero]
    * @param  [string] $numero               [el valor del turno]
    * @return [string]         [el turno modificado a palabra]
    */

   public static function crearTurno($numero){
      if($numero == 1){
         return 'Diurno';
      }else{
         return 'Vespertino';
      }
   }


   public static function validarRecaptcha($token){

      $cu = curl_init();
      curl_setopt($cu , CURLOPT_URL , "https://www.google.com/recaptcha/api/siteverify");
      curl_setopt($cu, CURLOPT_POST, 1);
      curl_setopt($cu,CURLOPT_POSTFIELDS,http_build_query(array('secret'=>CLAVE , 'response' => $token)));
      curl_setopt($cu,CURLOPT_RETURNTRANSFER,true);
      $response = curl_exec($cu);
      curl_close($cu);

      $datos = json_decode($response, true);

      if($datos['success'] == 1 && $datos['score'] >= 0.8){
         return true;
      }else{
         return false;
      }
   }

   /**
    * [generarTime Esta funcion la utilizo para generar el campo time dentro de mi tabla pagos]
    * @return [string] [retorna la fecha y hora en el siguiente formato YYYY-MM-DD hh:m:ss]
    */
   public static  function generarTime(){
      date_default_timezone_set('America/Mexico_City');
      $date = new DateTime();
      return $date->format('Y-m-d H:i:s');
   }



   /*
      *************************************************************
      *Metodos utilizados dentro del formulario de registro dentistas

   */
   static public function codificarFoto()
   {
      $imagenCodificada = file_get_contents("php://input");

      if(strlen($imagenCodificada < 0)){
         exit('No recibimos nada');
      }

      $imagenLimpia = str_replace("data:image/png;base64,","",urldecode($imagenCodificada));

      $imagenDeCodificada = base64_decode($imagenLimpia);

      $nombreImagen = "foto_" . uniqid() . ".png";

      file_put_contents('images/dentistas/'.$nombreImagen , $imagenDeCodificada);

      echo $nombreImagen;
   }

   static public function guardarFoto()
   {
      $extensiones = ['jpeg' , 'jpg' , 'png'];
      $fileName = $_FILES['foto']['name'];
      $ext = explode('.' , $fileName);
      $ext = end($ext);

      if(in_array($ext , $extensiones))
      {
         $foto = 'foto'. date('YmdHis') . '.'.$ext;
         copy($_FILES['foto']['tmp_name'] , 'images/dentistas/'.$foto);

         return $foto;

      }
      else
      {
         return false;
      }
   }






}//cierra clase







 ?>
