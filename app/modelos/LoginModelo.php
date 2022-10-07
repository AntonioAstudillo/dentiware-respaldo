<?php



class LoginModelo{
   private $user;
   private $password;
   private $conexion;

   public function __construct(){
      //hago una instancia de la conexion para poder hacer operaciones a la base de datos
      $this->conexion = new Mysql();
      $this->conexion = $this->conexion->getConexion();
   }

   public function setUser($user){
      $this->user = $user;
   }

   public function setPassword($password){
      $this->password = $password;
   }

   //Con esta funcion compruebo que el usuario esté registrado en la BD para poder darle acceso
   public function comprobarUsuario(){
      $sql = 'SELECT * FROM administradores WHERE user = ?  and password = ?';
      $sth = $this->conexion->prepare($sql);
      $sth->execute(array($this->user , $this->password));

      if($sth->rowCount() > 0){
         return true;
      }else{
         return false;
      }
   }

   //Con esta funcion  compruebo si el usuario es administrador para de esa manera poder mostrarle un modulo más.
   public function isAdmin($usuario){
      $sql = "SELECT tipo FROM administradores WHERE user = ?";
      $statement = $this->conexion->prepare($sql);
      $statement->execute(array($usuario));

      return $statement->fetch(PDO::FETCH_ASSOC);
   }

   public function getFoto($usuario){
      $sql = "SELECT CONCAT(persona.nombre , ' ' , persona.apellidos) as 'nombre' , administradores.foto FROM persona INNER JOIN administradores
               ON administradores.idPersona = persona.idPersona WHERE administradores.user = ? ";

      $statement = $this->conexion->prepare($sql);
      $statement->execute(array($usuario));

      return $statement->fetch();
   }
}





 ?>
