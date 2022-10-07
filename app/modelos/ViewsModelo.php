<?php


class ViewsModelo
{

   private $conexion;

   function __construct(){
      //hago una instancia de la conexion para poder hacer operaciones a la base de datos
      $this->conexion = new Mysql();
      $this->conexion = $this->conexion->getConexion();
   }

   //metodo utilizado para llenar la servicioVista
   //recibe como parametro un Sting que corresponde al id del servicio que vamos a mostrar
   // retorna un array asociativo
   public function getTratamiento($id){
      $consulta = "SELECT nombre , descripcion , imagen , precio FROM tratamiento WHERE idtratamiento = ?";
      $sth = $this->conexion->prepare($consulta);
      $sth->execute(array($id));

      return $sth->fetch();
   }
}



 ?>
