<?php


class AdministradorModelo{

   private $conexion;
   private $bandera;

   function __construct()
   {
      $this->conexion = new Mysql();
      $this->conexion = $this->conexion->getConexion();
      $this->bandera = array();
   }


   //Obtenemos el nombre y el nombre de la foto asociada al usuario que se acaba de loguear
   public function getFoto($usuario)
   {
      $sql = "SELECT CONCAT(persona.nombre , ' ' , persona.apellidos) as 'nombre' , administradores.foto FROM persona INNER JOIN administradores
               ON administradores.idPersona = persona.idPersona WHERE administradores.user = ? ";

      $statement = $this->conexion->prepare($sql);
      $statement->execute(array($usuario));

      return $statement->fetch();
   }


   /**
   * [Con esta función, voy a leer todos los tratamientos que esten registrados]
   * @return [array] [Retornaremos un array associativo con el valor de todos los tratamientos]
   */
   public function readAll()
   {
      $consulta = "SELECT * from tratamiento";

      $sth = $this->conexion->prepare($consulta);
      $sth->execute();
      $result = $sth->fetchAll();

      return $result;
   }



   /**
   * [Con esta función, voy a leer los dentistas que tengan el cargo mandado como argumento]
   * @return [array] [Retornaremos un array associativo con el valor de todos los dentistas]
   */
   public function obtenerDentista($cargo)
   {
      if($cargo == 1){
         $consulta = "SELECT idPersona , nombre , apellidos FROM persona WHERE tipo = ?";
      }else{
         $consulta = "SELECT idPersona , nombre, apellidos FROM persona WHERE idPersona IN (select idPersona FROM dentista WHERE cargo = ?);";
      }

      $sth = $this->conexion->prepare($consulta);
      $sth->execute(array($cargo));
      $result = $sth->fetchAll();

      return $result;
   }


   /**
   * [Con esta funcion, voy a poder registrar a un paciente con su respectiva cita.
   * Esta funcion solo me sirve para registrar pacientes nuevos]
   * @param  [array] $data               [Datos que voy a almacenar]
   * @return [boolean]       [Valo booleano. True operacion exitosa, False. Hubo un problema al registrar]
   */


   public function insertGeneric($data)
   {

      $nombre = $data['nombrePaciente'];
      $apellidos = $data['apellidoPaciente'];
      $edad = $data['edadPaciente'];
      $telefono = $data['telefonoPaciente'];
      $domicilio = $data['domicilioPaciente'];
      $fecha = $data['fechaCita'];
      $hora = $data['horaCita'];
      $idDentista = $data['dentistaPaciente'];
      $comentarios  = $data['comentariosPaciente'];
      $correo = $data['correoPaciente'];
      $idTratamiento  = $data['tratamientoPaciente'];
      $genero = $data['generoPaciente'];

      $saldo = $this->getSaldo($idTratamiento);


      try
      {

         $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $this->conexion->beginTransaction();

         $consulta = "INSERT INTO persona values(?,?,?,?,?,?,?,?,?)";
         $sentencia = $this->conexion->prepare($consulta);
         $sentencia->execute(array(null, $nombre , $apellidos , $edad , $telefono , $correo , $domicilio , $genero , 2));
         $lastInsertId = $this->conexion->lastInsertId();
         array_push($this->bandera , $sentencia->rowCount());

         $consulta = "INSERT INTO paciente values(? , ? , ?)";
         $sentencia = $this->conexion->prepare($consulta);
         $sentencia->execute(array(null , $lastInsertId , $comentarios));
         array_push($this->bandera , $sentencia->rowCount());

         $consulta = "INSERT INTO cita(idcita , fecha , hora , idPaciente , idDentista , idTratamiento, abono,  idComentarios) values(? ,? ,? ,? ,? ,?, ? , ?  )";
         $sentencia = $this->conexion->prepare($consulta);
         $sentencia->execute(array(null , $fecha , $hora , $lastInsertId , $idDentista , $idTratamiento , $saldo , null));
         array_push($this->bandera , $sentencia->rowCount());

         $consulta = "INSERT INTO historialtratamiento values(? ,? ,? ,?)";
         $sentencia = $this->conexion->prepare($consulta);
         $sentencia->execute(array(null , $lastInsertId , '1' , $saldo));
         array_push($this->bandera , $sentencia->rowCount());

         $this->conexion->commit();

      }catch(Exception $e){

         $this->conexion->rollBack();
         echo $e->getMessage();
      }

      if($this->comprobarBandera()){
         return true;
      }else{
         return false;
      }
   }


   /**
   * [validarCita Con esta funcion voy a comprobar que una cita no exista, para que no exista una colición]
   * @param  [string] $hora                   [la hora de la cita]
   * @param  [string] $fecha                  [la fecha de la cita]
   * @param  [string] $dentista               [el dentista que va a atender esa cita]
   * @return [boolean]           [si el valor devuelto es true, significa que exista una cita registrada ya]
   */
   public function validarCita($hora , $fecha , $dentista)
   {
      $consulta = 'SELECT * FROM cita WHERE hora = ? AND fecha = ? AND idDentista = ? AND status = ?';
      $gsent = $this->conexion->prepare($consulta);
      $gsent->execute(array($hora , $fecha , $dentista , 1));

      if($gsent->rowCount() >=1){
         return true;
      }else{
         return false;
      }
   }


   public function getSaldo($idTratamiento){
      $saldo = 0;

      $consulta = "SELECT precio FROM tratamiento WHERE idtratamiento = ?";
      $sentencia = $this->conexion->prepare($consulta);
      $sentencia->execute(array($idTratamiento));

      $sentencia = $sentencia->fetch(PDO::FETCH_ASSOC);



      $saldo = $sentencia['precio'];

      return $saldo;
   }


   /**
   * [comprobarBandera Esta funcion comprueba que todas las inserciones ala DB se hayan hecho de forma correcta]
   * @return [booleano] [Retorna un valor boolean. True exito, False hubo un error]
   */
   private function comprobarBandera()
   {
      foreach ($this->bandera as $value)
      {
         if($value == 0)
         {
            return false;
         }
      }

      return true;
   }


   /**
    * [checkEmail Metodo para comprobar si un correo ya se encuentra registrado en la database]
    * @param  [String] $correo               [correo a buscar]
    * @return [int]         [cantidad de registros afectados que cumplan la condición dentro del where]
    */
   public function checkEmail($correo)
   {
      $consulta = "SELECT * FROM persona WHERE correo = ? AND tipo = ?";
      $gsent = $this->conexion->prepare($consulta);
      $resultado = $gsent->execute(array($correo , 1));

      return $gsent->rowCount();
   }


   /**
   * [Con esta funcion voy a registrar a un dentista. Esta funcion debe ejecutar dos querys. Una a Persona y la otra a dentista]
   * @param  [array] $data               [los datos a ingresar]
   * @return [boolean]       [True operacion exitosa, False hubo un fallo al insertar]
   */
   public function registrarDentista($data)
   {
      $nombre = $data['nombreDentista'];
      $apellidos = $data['apellidoDentista'];
      $edad = $data['edadDentista'];
      $telefono = $data['telefonoDentista'];
      $genero = $data['generoDentista'];
      $domicilio = $data['domicilioDentista'];
      $correo = $data['correoDentista'];
      $especialidad = $data['especialidadDentista'];
      $ssDentista  = $data['ssDentista'];
      $rfcDentista = $data['rfcDentista'];
      $cedulaDentista  = $data['cedulaDentista'];
      $horarioDentista = $data['horarioDentista'];
      $fechaIngreso = $data['fechaIngreso'];
      $sueldoDentista = $data['sueldoDentista'];
      $clabeDentista = $data['clabeDentista'];
      $numCuentaBanco = $data['numCuentaBanco'];
      $imagenDentista = $data['imagenDentista'];
      $cargo = $this->comprobarCargo($especialidad);
      $bandera = array();

      try
      {

         $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $this->conexion->beginTransaction();

         //Insertamos los datos primero en persona
         $consulta = "INSERT INTO persona(idPersona , nombre , apellidos , edad , telefono , correo , direccion , genero , tipo )    values(?,?,?,?,?,?,?,?,?)";
         $sentencia = $this->conexion->prepare($consulta);
         $sentencia->execute(array(null, $nombre , $apellidos , $edad , $telefono , $correo , $domicilio , $genero , 1));
         $lastInsertId = $this->conexion->lastInsertId();
         array_push($this->bandera , $sentencia->rowCount());

         //Ahora insertamos los datos en la tabla dentista
         $consulta = "INSERT INTO dentista(iddentista , especialidad , cargo , turno , fechaIngreso , sueldo , foto , idPersona , numSocial ,rfc , cedula , clabe , cuentaBancaria) values(?,?,?,?,?,?,?,?,?,?,?,?,?)";

         $sentencia = $this->conexion->prepare($consulta);
         $sentencia->execute(array(null, $especialidad , $cargo , $horarioDentista , $fechaIngreso , $sueldoDentista ,$imagenDentista ,$lastInsertId,
         $ssDentista , $rfcDentista, $cedulaDentista , $clabeDentista , $numCuentaBanco));
         array_push($this->bandera , $sentencia->rowCount());

         $this->conexion->commit();

      }catch(Exception $e){

         $this->conexion->rollBack();
         echo $e->getMessage();
      }

      if($this->comprobarBandera()){
         return true;
      }else{
         return false;
      }

   }//cierra metodo insertData



   /**
   * [Con esta funcion voy a generar el cargo correspondiente a la especialidad del dentista
   *  Lo que pasa es que dentro del select en la option a cada especialidad le di un valor numerico,
   *  pero dentro de la base de datos no puedo almacenarlo de esa forma, por tal razon hago una conversion con esta funcion]
   * @param  [string] $especialidad               [La especialidad que debo validar]
   * @return [string]               [El cargo correspondiente a la especialidad ingresada]
   */
   private function comprobarCargo($especialidad)
   {
      $cargo = '';

      switch ($especialidad) {
         case '1':
            $cargo = 'Pediatra';
            break;
         case '2':
            $cargo = 'Periodontologo';
            break;
         case '3':
               $cargo = 'Cirujano';
               break;
         case '4':
               $cargo = 'General';
               break;
         case '5':
               $cargo = 'Odontologo';
               break;
      }

      return $cargo;
   }


   //obtenemos los datos de los pacientes para mostrarlos en los datatables " 2 = paciente  1 = dentista  3 = administrador"
   public function getAll($tipo)
   {
      if($tipo == 1)
      {
         $consulta = "SELECT persona.idPersona ,persona.nombre ,
                     persona.apellidos, persona.edad , persona.telefono ,
                     persona.correo , persona.direccion , persona.genero , dentista.cargo , dentista.turno ,
                     dentista.fechaIngreso, dentista.sueldo , dentista.numSocial , dentista.rfc ,
                     dentista.cedula , dentista.clabe , dentista.cuentaBancaria
                     FROM persona INNER JOIN dentista ON dentista.idPersona = persona.IdPersona WHERE persona.tipo = ?;";
      }else
      {
         $consulta = "SELECT persona.idPersona , persona.nombre , persona.apellidos ,persona.edad , persona.correo , persona.telefono , persona.direccion , persona.genero  FROM persona WHERE persona.tipo = ? ";
      }

      $gsent = $this->conexion->prepare($consulta);
      $gsent->execute(array($tipo));

      $data = $gsent->fetchAll();

      return $data;

   }


   //modificamos la información general de un cierto paciente
   public function changePaciente($data){
      $consulta = "UPDATE persona SET nombre = ? , apellidos = ? , edad = ? , telefono = ? , correo = ? , direccion = ? , genero = ? WHERE idPersona = ? ";

      $gsent = $this->conexion->prepare($consulta);
      $gsent->execute(array($data['nombre'] , $data['apellidos'] , $data['edad'] , $data['telefono'] , $data['correo'] , $data['direccion'] , $data['genero'] , $data['idPersona']));

      return $gsent->rowCount();
   }

   //actualizamos datos del dentista
   public function updateDentist($data)
   {
      $bandera = true;


      try
      {
         $cargo = $this->comprobarCargo($data['especialidad']);
         $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $this->conexion->beginTransaction();


         //Insertamos los datos primero en persona
         $consulta = "UPDATE persona SET nombre = ? , apellidos = ? , edad = ? , telefono = ? , correo = ? , direccion = ? , genero = ? where idPersona = ?  ";
         $sentencia = $this->conexion->prepare($consulta);
         $sentencia->execute(array($data['nombre'], $data['apellidos'] , $data['edad'] , $data['telefono'] , $data['correo'] , $data['direccion'] , $data['genero'] , $data['id']) );
         //Ahora insertamos los datos en la tabla dentista
         $consulta = "UPDATE dentista SET especialidad = ? , cargo = ? , turno = ? , fechaIngreso = ? , sueldo = ? , numSocial = ? , rfc = ? ,cedula = ? ,  clabe = ?,  cuentaBancaria = ? where idPersona = ?  ";

         $sentencia = $this->conexion->prepare($consulta);
         $sentencia->execute(array($data['especialidad'] , $cargo , $data['turno'] , $data['fechaIngreso'] , $data['sueldo'] , $data['nss'] ,$data['rfc'], $data['cedula'] , $data['clabe'], $data['numCuenta'], $data['id']));
         $this->conexion->commit();

      }catch(Exception $e){

         $this->conexion->rollBack();
         $bandera = false;
      }

      return $bandera;
   }

   //modificamos el contenido de especialidad
   private function generarCargo($especialidad){
   $cargo = '';

   switch ($especialidad) {
      case 'Odontopediatra':
         $cargo = 'Pediatra';
         break;
      case 'Periodoncista':
         $cargo = 'Periodontologo';
         break;
      case 'Cirujano Maxilofacial':
            $cargo = 'Cirujano';
            break;
      case 'Cirujano Dentista':
            $cargo = 'Cirujano';
            break;
      case 'Dentista General':
            $cargo = 'General';
            break;
      case 'Odontología':
            $cargo = 'Odontologo';
            break;
   }

   return $cargo;
}


//eliminamos un paciente de la base de datos. Este metodo recibe como parametro un id
public function delete($idPaciente)
{
   $bandera = true;
   try
   {

      $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $this->conexion->beginTransaction();

      $consulta = "DELETE FROM persona WHERE idPersona = ?";
      $sentencia = $this->conexion->prepare($consulta);
      $sentencia->execute(array($idPaciente));

      $consulta = "DELETE FROM paciente WHERE idPersona = ?";
      $sentencia = $this->conexion->prepare($consulta);
      $sentencia->execute(array($idPaciente));

      $consulta = "DELETE FROM cita WHERE idPaciente = ?";
      $sentencia = $this->conexion->prepare($consulta);
      $sentencia->execute(array($idPaciente));

      $this->conexion->commit();

   }catch(Exception $e){

      $this->conexion->rollBack();
      $bandera = false;
   }

   return $bandera;

}//cierra funcion delete



//obtenemos los dentistas para mostrarlos en la tabla de busqueda
public function getDentistas($tipo)
{
   $consulta = 'SELECT nombre , apellidos , edad , telefono , correo , direccion , cargo , date_format(fechaIngreso , "%c / %m / %Y" ) FROM persona INNER JOIN dentista
               ON dentista.idPersona = persona.idPersona WHERE persona.tipo = ?;';
   $sentencia = $this->conexion->prepare($consulta);
   $sentencia->execute(array($tipo));

   return $sentencia->fetchAll();

}

//obtenemos el salario para poder generar la nomina
public function getSalaryTotal(){
   $consulta = "SELECT sum(sueldo) as 'total' FROM dentista;";

   $gsent = $this->conexion->prepare($consulta);
   $gsent->execute();

   $data = $gsent->fetch();

   return $data;
}

//enviamos los datos referentes a la nomina para poder generarla dentro del datatable modulo finanzas
public function getNomina(){
   $consulta = "SELECT persona.idPersona, persona.nombre , persona.apellidos , dentista.clabe , dentista.cuentaBancaria , dentista.sueldo , dentista.rfc
   FROM persona INNER JOIN dentista ON dentista.idPersona = persona.idPersona WHERE tipo = ?;";

   $gsent = $this->conexion->prepare($consulta);
   $gsent->execute(array(1));

   $data = $gsent->fetchAll();

   return $data;

}



/**
* [insertData Esta funcion me va servir para insertar en la tabla nomina todos los datos referentes a la transaccion de la nomina]
* @param  [array] $data               [los datos que debemos insertar ]
* @return [boolean]       [una bandera en caso de ser true significa que la insercion se hizo de forma correcta, en caso de false la insercion fallo ]
*/
public function insertData($data)
{
   $query = "INSERT INTO nomina VALUES(?,?,?,?,?,?,?,?)";
   $statement = $this->conexion->prepare($query);
   $statement->execute( array ( null , $data['idTransaccion'] , $data['payerId'] , $data['merchant_id'], $data['amount'], $data['usuario'] , $data['updateTime'] , null ) );

   return $statement->rowCount();
}



/**
* [getCitas Con esta funcion, voy a obtener todas las citas que esten registradas dentro de mi BD]
* @return [array] [Todos los registros obtenidos de la consulta]
*/
public function getCitas()
{
   $consulta = "SELECT cita.idcita , persona.idPersona , cita.fecha , cita.hora , concat(persona.nombre , ' ', persona.apellidos) AS 'nombre', persona.correo , cita.abono , tratamiento.nombre AS 'tratamiento'
   FROM cita INNER JOIN tratamiento ON cita.idTratamiento = tratamiento.idtratamiento
   INNER JOIN persona ON persona.idPersona = cita.idPaciente WHERE cita.status = '1';";

   $sentencia = $this->conexion->prepare($consulta);
   $sentencia->execute();
   $data = $sentencia->fetchAll();

   return $data;
}


//obtengo la informacion del dentista para poder mostrarla dentro del modal de pagar cita
public function getDataDentist($data){

   $consulta = "SELECT dentista.idPersona , concat(persona.nombre, ' ' , persona.apellidos) AS 'nombre' , persona.edad ,  dentista.cargo , dentista.turno  , persona.correo
      FROM persona inner JOIN dentista ON dentista.idPersona = persona.idPersona WHERE dentista.idPersona = ( SELECT idDentista FROM cita WHERE idPaciente = ? and status = ? and idcita = ?)";

   $sentencia = $this->conexion->prepare($consulta);
   $sentencia->execute(array($data['idPersona'], '1' , $data['idCita']));
   $data = $sentencia->fetchAll();

   return $data;

}

//almacenamos los datos correspondiente al pago de la cita, dentro de nuestra database
public function insertPago($data)
{
   $consulta = "INSERT INTO pagos VALUES(?,?,?,?,?,?,?)";

   $sentencia = $this->conexion->prepare($consulta);

   $sentencia->execute(array(null, $data['cantidad'], $data['hora'] , $data['fecha'] , $data['folio'] , $data['idCita'], $data['time'] ));

   return $sentencia->rowCount();
}

//actualizamos el estado de la cita, para que deje de mostrarse en el modulo de pago de citas
public function updateAppointment($idCita){
   $consulta = 'UPDATE cita SET status = ? WHERE idcita = ?';
   $sentencia = $this->conexion->prepare($consulta);
   $sentencia->execute(array('0',$idCita));

   return $sentencia->rowCount();

}


// Con esta funcion voy actualizar la tabla historialtratamiento
public function updateHistory($data){

   $consulta = "UPDATE historialtratamiento SET saldo = (saldo - ?) where idPaciente = ?";
   $sentencia = $this->conexion->prepare($consulta);
   $sentencia->execute(array($data['cantidad'] , $data['idPaciente']));

   if($sentencia->rowCount() >0){
      return true;
   }else{
      return false;
   }

}





   /**
    * [getDataDentist Con este metodo obtengo los datos que se deben mostrar en el datatable del modulo de crear cita]
    *
    * @return [array]     [Un arreglo con todos los pacientes registrados]
    *
    */
   public function getPacientes(){
      $consulta = "SELECT persona.idPersona , concat(persona.nombre , ' ' , persona.apellidos) as 'nombre' ,persona.edad , persona.correo , persona.telefono FROM persona
      WHERE persona.tipo = ? ";

      $sentencia = $this->conexion->prepare($consulta);
      $sentencia->execute(array('2'));
      $data = $sentencia->fetchAll();

      return $data;
   }


   //creamos una cita dentro del modo de citas
   public function createCita($data)
   {
      $bandera = true;

      $fecha = $data['fechaCita'];
      $hora = $data['horaCita'];
      $idDentista = $data['dentistaPaciente'];
      $comentarios  = $data['comentario'];
      $idTratamiento  = $data['tratamientoPaciente'];
      $idPaciente = $data['idPaciente'];
      $abono = $this->getSaldo($idTratamiento);



      try
      {

         $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $this->conexion->beginTransaction();

         $consulta = "INSERT INTO comentarios values(? , ?)";
         $sentencia = $this->conexion->prepare($consulta);
         $sentencia->execute(array(null , $comentarios));
         $lastInsertId = $this->conexion->lastInsertId();


         $consulta = "INSERT INTO cita(idcita , fecha , hora , idPaciente , idDentista , idTratamiento , idComentarios , abono) values(? ,? ,? ,? ,? ,?, ? , ?)";
         $sentencia = $this->conexion->prepare($consulta);
         $sentencia->execute(array(null , $fecha , $hora , $idPaciente , $idDentista , $idTratamiento , $lastInsertId , $abono));

         $consulta = "INSERT INTO  historialtratamiento VALUES(? , ? , ? ,? )";
         $sentencia = $this->conexion->prepare($consulta);
         $sentencia->execute(array(null , $idPaciente , 1 ,$abono));




         $this->conexion->commit();

      }catch(Exception $e){

         $this->conexion->rollBack();
         $bandera = false;
      }

      return $bandera;

   }


   //actualizamos los datos de la cita
   public function updateCita($data)
   {
      $bandera = true;

      $fecha = $data['fechaCita'];
      $hora = $data['horaCita'];
      $idDentista = $data['dentistaPaciente'];
      $comentarios  = $data['comentario'];
      $idTratamiento  = $data['tratamientoPaciente'];
      $idPaciente = $data['idPaciente'];
      $abono = $this->getSaldo($idTratamiento); //obtenemos el abono, para poder actualizar la tabla de historialtratamiento

      try
      {

         $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $this->conexion->beginTransaction();

         $consulta = "INSERT INTO comentarios values(? , ?)";
         $sentencia = $this->conexion->prepare($consulta);
         $sentencia->execute(array(null , $comentarios));
         $lastInsertId = $this->conexion->lastInsertId();


         $consulta = "UPDATE cita SET fecha = ? , hora = ?  , idDentista = ? , idTratamiento = ? , idComentarios = ?  , abono = ? WHERE idcita = ?";
         $sentencia = $this->conexion->prepare($consulta);
         $sentencia->execute(array($fecha , $hora  , $idDentista , $idTratamiento , $lastInsertId , $abono , $idPaciente));


         // $consulta = "UPDATE historialtratamiento SET abono = ? WHERE idPaciente = ?";
         // $sentencia = $this->conexion->prepare($consulta);
         // $sentencia->execute(array($abono ,  $idPaciente));


         $this->conexion->commit();

      }catch(Exception $e){

         $this->conexion->rollBack();
         $bandera = false;
      }

      return $bandera;

   }


   public function pieChart(){
      $consulta = "SELECT tratamiento.nombre as 'nombre' , count(*) as 'total' FROM tratamiento inner join cita on cita.idTratamiento = tratamiento.idTratamiento  group by tratamiento.nombre;";

      $sentencia = $this->conexion->prepare($consulta);
      $sentencia->execute();

      return $sentencia->fetchAll();
   }

   public function comboChart(){
      $consulta = "SELECT fecha , count(*) AS 'cantidad' FROM cita GROUP BY fecha;";

      $sentencia = $this->conexion->prepare($consulta);
      $sentencia->execute();

      return $sentencia->fetchAll();
   }












}//cierra clase AdministradorModelo








 ?>
