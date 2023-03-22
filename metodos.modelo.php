<?php


class MetodosModelo{

        #Inicio de sesión
        public static function M_iniciarSesion($usuario,$password,$tabla){


          $con = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE contraseña=:password and usuario=:usuario");
          
          $con->bindValue(':usuario', $usuario, PDO::PARAM_STR);
          $con->bindValue(':password', $password, PDO::PARAM_STR);
          
          $con->execute(); 
        
          $filas = $con->rowCount();
          
          return $filas; 
      }#end


      

#################################

    #Registrar alumno
    public static function M_registrarAlumno($datos, $tabla){

      //conexión a la bd 
      $con = Conexion::conectar()->prepare("INSERT INTO $tabla(id,nombre,direccion,num_telefono,num_celular,correo_personal,correo_buap,correo_doctorado) VALUES (:matricula,:nombre,:direccion,:num_telefono,:num_celular,:correo_personal,:correo_buap,:correo_doctorado)");
      
      $con -> bindParam(":matricula", $datos["id"], PDO::PARAM_STR);
      $con -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
      $con -> bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
      $con -> bindParam(":num_telefono", $datos["num_telefono"], PDO::PARAM_STR);
      $con -> bindParam(":num_celular", $datos["num_celular"], PDO::PARAM_STR);
      $con -> bindParam(":correo_personal", $datos["correop"], PDO::PARAM_STR);
      $con -> bindParam(":correo_buap", $datos["correob"], PDO::PARAM_STR);
      $con -> bindParam(":correo_doctorado", $datos["correod"], PDO::PARAM_STR);
  
      if($con -> execute()){

          return "true";

      }else{

          return "false";

      }
  }#end

   #Registrar docente
   public static function M_registrarDocente($datos, $tabla){

      $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id,nombre,num_telefono,num_celular,fecha_nacimiento,facultad_adscripcion,
      cubiculo,correoBuap,correoVIEP,tipo_tesista) VALUES(:id_docente,:nombre,:num_telefono,:num_celular,:fecha_nacimiento,:facultad_adscripcion,
      :cubiculo,:correoBuap,:correoVIEP,:tipo_tesista)");	
   
      $stmt -> bindParam(":id_docente", $datos["id_docente"], PDO::PARAM_STR);
      $stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
      $stmt -> bindParam(":num_telefono", $datos["num_telefono"], PDO::PARAM_STR);
      $stmt -> bindParam(":num_celular", $datos["num_celular"], PDO::PARAM_STR);
      $stmt -> bindParam(":fecha_nacimiento", $datos["fecha_nacimiento"], PDO::PARAM_STR);
      $stmt -> bindParam(":facultad_adscripcion", $datos["facultad"], PDO::PARAM_STR);
      $stmt -> bindParam(":cubiculo", $datos["cubiculo"], PDO::PARAM_STR);
      $stmt -> bindParam(":correoBuap", $datos["correoBuap"], PDO::PARAM_STR);
      $stmt -> bindParam(":correoVIEP", $datos["correoVIEP"], PDO::PARAM_STR);
      $stmt -> bindParam(":tipo_tesista", $datos["tipo_tesista"], PDO::PARAM_STR);



      if($stmt -> execute()){

          return "true";

      }else{

          return "false";

      }

  }#end



   #Registrar coloquio
   public static function M_registrarColoquio($datos, $tabla){

      //conexión a la bd 
      $con = Conexion::conectar()->prepare("INSERT INTO $tabla(titulo,fecha,lugar,hora) VALUES (:titulo,:fecha,:lugar,:hora)");
      
      $con -> bindParam(":titulo", $datos["titulo"], PDO::PARAM_STR);
      $con -> bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
      $con -> bindParam(":lugar", $datos["lugar"], PDO::PARAM_STR);
      $con -> bindParam(":hora", $datos["hora"], PDO::PARAM_STR);
     

      if($con -> execute()){

          return "true";

      }else{

          return "false";

      }

  }#end
  #Expediente de alumno
  public static function M_expedienteAlumno($matricula,$datos,$tabla){

      $con = Conexion::conectar()->prepare("INSERT INTO $tabla(matricula,IFE,
      carta_compromiso,carta_recomendacion1,carta_recomendacion2,protocolo,
      comprobante_TOEFL,EXANIII,titulo_licenciatura,titulo_maestria,cedula_licenciatura,
      cedula_maestria,curriculum_vitae,publicaciones,kardex_semestral,pago_inscripcion) VALUES(:matricula,:IFE,:carta_compromiso,
      :carta_recomendacion1,:carta_recomendacion2,:protocolo,
      :comprobante_TOEFL,:EXANIII,:titulo_licenciatura,
      :titulo_maestria,:cedula_licenciatura,:cedula_maestria,:curriculum_vitae,:publicaciones,:kardex_semestral,:pago_inscripcion)");

      $con -> bindParam(":matricula", $matricula, PDO::PARAM_STR);
      $con -> bindParam(":IFE", $datos[0], PDO::PARAM_STR);
      $con -> bindParam(":carta_compromiso", $datos[1], PDO::PARAM_STR);
      $con -> bindParam(":carta_recomendacion1", $datos[2], PDO::PARAM_STR);
      $con -> bindParam(":carta_recomendacion2", $datos[3], PDO::PARAM_STR);
      $con -> bindParam(":protocolo", $datos[4], PDO::PARAM_STR);
      $con -> bindParam(":comprobante_TOEFL", $datos[5], PDO::PARAM_STR);
      $con -> bindParam(":EXANIII", $datos[6], PDO::PARAM_STR);
      $con -> bindParam(":titulo_licenciatura", $datos[7], PDO::PARAM_STR);
      $con -> bindParam(":titulo_maestria", $datos[8], PDO::PARAM_STR);
      $con -> bindParam(":cedula_licenciatura", $datos[9], PDO::PARAM_STR);
      $con -> bindParam(":cedula_maestria", $datos[10], PDO::PARAM_STR);
      $con -> bindParam(":curriculum_vitae", $datos[11], PDO::PARAM_STR);
      $con -> bindParam(":publicaciones", $datos[12], PDO::PARAM_STR);
      $con -> bindParam(":kardex_semestral", $datos[13], PDO::PARAM_STR);
      $con -> bindParam(":pago_inscripcion", $datos[14], PDO::PARAM_STR);

      if($con -> execute()){

          return "true";

      }else{

          return "false";

      }

  }//end de M_expedienteAlumno



  
  #################################

  #Asignar curso a alumno
  public static function M_asignarAlumno($solicitantes,$datos,$curso,$tabla){
      $bandera = true;

      for($i=0;$i<$solicitantes;$i++)
      {

              $con= Conexion::conectar()->prepare("INSERT INTO $tabla(curso,matricula) VALUES (:curso,:matricula)");

              $con -> bindParam(":curso", $curso, PDO::PARAM_STR);
              $con -> bindParam(":matricula", $datos[$i], PDO::PARAM_STR);
      
              if($con -> execute()){

                  $bandera= "true";
      
              }else{
      
                  $bandera = "false";
      
              }

              $con = null;
              
      }

     if($bandera == "true"){

          return "true";

      }else{

          return "false";

      }
      
     

  }#end

   #Asignar tutoria a docente
   public static function M_asignarTutoria($datos, $tabla){
      
      //conexión a la bd 
      $con= Conexion::conectar()->prepare("INSERT INTO $tabla(curso,id_docente,docente,num_solicitantes) VALUES (:curso,:id_docente,
      :docente,:solicitantes)");
      
      $con -> bindParam(":curso", $datos["curso"], PDO::PARAM_STR);
      $con -> bindParam(":id_docente", $datos["id_docente"], PDO::PARAM_STR);
      $con -> bindParam(":docente", $datos["docente"], PDO::PARAM_STR);
      $con -> bindParam(":solicitantes", $datos["solicitantes"], PDO::PARAM_STR);
     

      if($con -> execute()){

          return "true";

      }else{

          return "false";

      }

  }#end

  #Asignar otra materia

  public static function M_asignarMateria($datos, $tabla){

      $con= Conexion::conectar()->prepare("INSERT INTO $tabla(curso,id_docente,docente,id_aux,docente_aux,num_solicitantes) VALUES (:curso,
      :id_docente,:docente,:id_aux,:docente_aux,:solicitantes)");
      
      $con -> bindParam(":curso", $datos["curso"], PDO::PARAM_STR);
      $con -> bindParam(":id_docente", $datos["id"], PDO::PARAM_STR);
      $con -> bindParam(":docente", $datos["docente"], PDO::PARAM_STR);
      $con -> bindParam(":id_aux", $datos["id_aux"], PDO::PARAM_STR);
      $con -> bindParam(":docente_aux", $datos["docente_aux"], PDO::PARAM_STR);
      $con -> bindParam(":solicitantes", $datos["solicitantes"], PDO::PARAM_STR);
      
     

      if($con -> execute()){

          return "true";

      }else{

          return "false";

      }

  }#end









#####################################

  #Seleccionar un registro
  public static function M_seleccion($tabla,$id){

      $con = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id=:id");
      $con -> bindParam(":id", $id, PDO::PARAM_STR);
      $con -> execute();
  
      $resultado = $con -> fetchAll();
      return $resultado;
      
      $resultado = null;
      $con = null;

  }#end



  ####################################

  
   #Modificar registro
   public static function M_modificar($datos, $tabla){

      $var=$datos["rubro"];

      $con = Conexion::conectar()->prepare("UPDATE $tabla set $var=:modificacion where id=:id");

      $con->bindValue(':id', $datos["id"], PDO::PARAM_INT);
      $con->bindValue(':modificacion', $datos["modificacion"], PDO::PARAM_STR);

      
      if($con -> execute()){

          return "true";

      }else{

          return "false";

      }

  }#end

######################################

    #Eliminar registro
    public static function M_eliminar($datos, $tabla){

  
      $stmt = Conexion::conectar()->prepare("DELETE from  $tabla where id =:id");

      $stmt -> bindParam(":id", $datos, PDO::PARAM_STR);

      if($stmt -> execute()){

          return "true";

      }else{

          return "false";

      }

  }#end

  
################################

  #Validar registro
  public static function M_validar($id,$tabla){

    $con = Conexion::conectar()->prepare("SELECT id FROM $tabla WHERE id=:id");
    $con -> bindParam(":id", $id, PDO::PARAM_STR);
    $con->execute(); 

    $filas = $con->rowCount();#Obtiene el numero de filas
    return $filas;
}#end

###################################

  #Mostrar tablas
  public static function M_mostrarTabla($tabla){

      $con = Conexion::conectar()->prepare("SELECT * FROM $tabla");
      $con -> execute();
  
      $resultado = $con -> fetchAll();
      return $resultado;
      
      $resultado = null;
      $con = null;

      
  }#end






  ######################

  #Validar curso
  public static function M_validarCurso($tabla,$curso){
  
      $con = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE curso=:curso");
      $con -> bindParam(":curso", $curso, PDO::PARAM_STR);
      $con->execute(); 

      $filas = $con->rowCount();#Obtiene el numero de filas
      return $filas;
   }#end


   #Buscar inf. del curso
  public static function M_buscarCurso($tabla,$curso){

      $con = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE curso=:curso;");

      $con -> bindParam(":curso", $curso, PDO::PARAM_STR);
      
      $con -> execute();
  
      $resultado = $con -> fetchAll();
      return $resultado;
      
      $resultado = null;
      $con = null;
      
  }


   #Buscar inf. del curso
   public static function M_buscarAlumno($curso){

      $con = Conexion::conectar()->prepare("SELECT a.nombre,asig.matricula
      FROM alumno AS a INNER JOIN alumno_asignacion AS asig
      ON a.id=asig.matricula WHERE asig.curso=:curso;");

      $con -> bindParam(":curso", $curso, PDO::PARAM_STR);
      
      $con -> execute();
  
      $resultado = $con -> fetchAll();
      return $resultado;
      
      $resultado = null;
      $con = null;
      
  }


#####################################################


  #Almacena la inf. seleccionada en un archivo
  public static function M_almacenarSeleccion($datos){

            $archivo = fopen('Documentos/archivo.txt',"a");

            if( $archivo == false ){
                $bandera=0;
            }
            else{

                fwrite($archivo, $datos. PHP_EOL);

                // Fuerza a que se escriban los datos pendientes en el buffer:
                fflush($archivo);
              
                fclose($archivo);
                $bandera=1;
            }
              
             return $bandera;
  }#end

  
    #Mostrar archivo
    public static function M_mostrarSeleccion(){

        
        #Abre archivo
        $archivo = fopen("Documentos/archivo.txt", "r");
        
        #Recorremos todo el contenido del archivo

        while(!feof($archivo)){

            #Lee linea
            $linea = fgets($archivo,1024);

            #Imprime un salto de linea y el contenido 
            echo nl2br($linea);
        }
        
        // Cerrando el archivo
        fclose($archivo);
        
    }

  #Limpia archivo
  public static function M_limpiarSeleccion(){

    # $ar="Documentos/archivo.txt";
     #unlink($ar);
     $datos="    ";
     $archivo = fopen('Documentos/archivo.txt',"w");

     if( $archivo == false ) {
         echo "Error al crear el archivo";
     }
     else
     {
         fwrite($archivo, $datos. PHP_EOL);
         fwrite($archivo, PHP_EOL);
         // Fuerza a que se escriban los datos pendientes en el buffer:
         fflush($archivo);
     }
     // Cerrar el archivo:
    fclose($archivo);

 }




























}#clase


?>







