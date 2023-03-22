<?php

class MetodosControlador{


       #Inicio de Sesión
       public static function C_iniciarSesion(){

        if(isset($_POST["usuario"])){

                $usuario=$_POST["usuario"];
                $password=$_POST["password"];
                $tabla = "coordinador";
                $filas=MetodosModelo::M_iniciarSesion($usuario,$password,$tabla);

               if($filas <=0 ){
                    echo 
                    '<script>
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Error en Autenticación de Usuario"
                    })
                    </script>';
                }else{
                   echo '<script>window.location="inicio" </script>';
                      
                }
        }
    }#end

    
    public static function C_cerrarSesion(){

        session_start();
        error_reporting(0);
        $varsesion =$_SESSION['usuario'];

        if($varsesion == null || $varsesion =''){
            echo 'Usted no tiene autorización';
            die();
        }
        session_destroy();
        header("Location:login");

    }#end

    public static function C_verificarSesion(){
        session_start();
        error_reporting(0);
        $varsesion =$_SESSION['usuario'];

        if($varsesion == null || $varsesion =''){
            echo 'Usted no tiene autorización';
            die();
        }
    }


    ##############################################
      #Registrar alumno
      public static function C_registrarAlumno(){

        if(isset($_POST["id"])){

            $id=$_POST["id"];
            $tabla = "alumno";
        
            $filas=MetodosModelo::M_validar($id,$tabla);

            if ($filas <= 0) {

                $datos = array("id"=>$_POST['id'],"nombre"=>$_POST['nombre'],
                "direccion"=>$_POST['direccion'],"num_telefono"=>$_POST['telefono'],
                "num_celular"=>$_POST['celular'],"correop"=>$_POST['correop'],
                "correob"=>$_POST['correob'],"correod"=>$_POST['correod']);
        
                $respuesta = MetodosModelo::M_registrarAlumno($datos, $tabla);
        
                        if($respuesta == "true"){
                            echo 
                            '<script>
                            Swal.fire({
                                icon: "success",
                                title: "Proceso Exitoso",
                                showConfirmButton: false,
                                timer: 1500
                            })
                            </script>';
                        }
            } else {
                echo 
                '<script>
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Información ya existente en el sistema"
                  })
                  </script>';
            }
        }//end de if isset
    }


    #Registrar docente
    public static function C_registrarDocente(){

        if(isset($_POST["id"])){

            $id=$_POST["id"];
           
            $tabla = "docente";
            $filas=MetodosModelo::M_validar($id,$tabla);
          
            if($filas <=0 ){
              
               $datos = array("id_docente"=>$_POST['id'],"nombre"=>$_POST['nombre'],"num_telefono"=>$_POST['telefono'],
               "num_celular"=>$_POST['celular'],"fecha_nacimiento"=>$_POST['fecha'],"facultad"=>$_POST['facultad'],
               "cubiculo"=>$_POST['cubiculo'],"correoBuap"=>$_POST['correob'],"correoVIEP"=>$_POST['correov'],
               "tipo_tesista"=>$_POST['t_tesista']);

                $respuesta = MetodosModelo::M_registrarDocente($datos, $tabla);

                if($respuesta == "true"){
                    echo 
                    '<script>
                    Swal.fire({
                        icon: "success",
                        title: "Proceso Exitoso",
                        showConfirmButton: false,
                        timer: 1500
                    })
                    </script>';
                }
                
            }else{
               # echo "Si existe";
                echo 
                '<script>
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Información ya existente en el sistema"
                  })
                  </script>';

            }
    }
    }#end


    #Registrar coloquio
     public static function C_registrarColoquio(){
        if(isset($_POST["fecha"])){
        $datos = array("titulo"=>$_POST['titulo'],"fecha"=>$_POST['fecha'],"lugar"=>$_POST['lugar'],"hora"=>$_POST['hora']);

        $tabla = "coloquio";

        $respuesta = MetodosModelo::M_registrarColoquio($datos, $tabla);

        if($respuesta == "true"){
            echo '<script>
            Swal.fire({
                icon: "success",
                title: "Proceso Exitoso",
                showConfirmButton: false,
                timer: 1500
              })
        </script>';
        }else{
            '<script>
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Proceso Fallido",
                footer: "<a href="">Why do I have this issue?</a>"
              })
             </script>';
        }

    }
    }#end

     #Expediente de alumno
     public static function C_expedienteAlumno(){

        if(isset($_POST["id"])){
        
            $num_archivos=count($_FILES['archivo']['name']);//recupera el numero de archivos recibidos 
            $matricula = $_POST["id"];
            $direccion='Documentos/'.$matricula;
            $bandera = true;
            $datos = ['','','','','','','','','','','','','','',''];
            $tabla="alumno";
            $filas=MetodosModelo::M_validar($matricula,$tabla);

            if($filas<=0){
                echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Registro no encontrado"
                  })
                 </script>';
            }else{
                    /*Crea la carpeta con la matricula si no existe*/
                    if (!file_exists($direccion)) {
                        
                        mkdir($direccion, 0777, true);
                    }

                    for ($i=0; $i<=$num_archivos; $i++){

                        if(!empty($_FILES['archivo']['name'][$i]) ){

                                    $ruta_destino = $direccion."/".$_FILES['archivo']['name'][$i];   
                                    
                                    $datos[$i]=$ruta_destino;
                                    
                                    if(file_exists($ruta_destino)){
                                        $bandera = false;
                                    }
                                    else{
                                        $ruta_origen = $_FILES['archivo']['tmp_name'][$i];
                                        move_uploaded_file($ruta_origen, $ruta_destino);
                                    }

                                }
                    }

                    if($bandera == true){
                            $tabla = "expediente";

                            $respuesta = MetodosModelo::M_expedienteAlumno($matricula,$datos,$tabla);
                    
                            if($respuesta == "true"){
                                echo 
                                '<script>
                                Swal.fire({
                                    icon: "success",
                                    title: "Proceso Exitoso",
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                                </script>';
                            }else{
                                    '<script>
                                    alert("Expediente fallido")
                                    </script>';
                            }

                        }
            }

            }
    }#end




  


   




    ##################################


     #Asignar curso a alumnos
     public static function C_asignarAlumno(){
        
        if(isset($_POST["curso"])){

            $longitud =count($_POST['matricula']);//recupera el numero de archivos recibidos 
            $curso=$_POST["curso"];
            $datos= array();
            $faltantes= array();  
            $bandera=0;

            for($i=0;$i<$longitud;$i++)
            {
                $datos[$i]=$_POST['matricula'][$i];
            }

            $tabla_validar="alumno"; 
            for($i=0;$i<$longitud;$i++)
            {
                $id=$datos[$i];
                $filas = MetodosModelo::M_validar($id,$tabla_validar);
                if($filas<=0){
                    $bandera=1;
                    $faltantes[$i]=$id;
                }  
            }
            $tamaño=count($faltantes);
        
            if($bandera==1){
    
                echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Opps...",
                    text: "'.$tamaño.' matriculas no encontradas",
                })
                </script>';

            }else{
                $tabla = "alumno_asignacion";
                $respuesta = MetodosModelo::M_asignarAlumno($longitud,$datos,$curso,$tabla);
                if($respuesta == "true"){
                    echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "Proceso Exitoso",
                        showConfirmButton: false,
                        timer: 1500
                    })
                </script>';
                }else{
                    '<script>
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Proceso Fallido",
                    })
                    </script>';
                }

            }
        }
     }


     #Asignar curso a docentes

     public static function C_asignarTutoria(){
    
        if(isset($_POST["id"])){

            echo "Entra a tutoria docente";
            $id=$_POST["id"];
            $tabla_validar="docente";

            $filas = MetodosModelo::M_validar($id,$tabla_validar);
            echo $filas;

            if($filas<=0){
    
                echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "'.$id.' registro no encontrado",
                  })
                 </script>';

            }else{

                $datos = array("curso"=>$_POST['curso'],"id_docente"=>$_POST['id'],
                "docente"=>$_POST['nombre'],"solicitantes"=>$_POST['solicitantes']);
                $tabla = "docente_asignacion";
    
                $respuesta = MetodosModelo::M_asignarTutoria($datos, $tabla);
    
                if($respuesta == "true"){
                    echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "Proceso Exitoso",
                        showConfirmButton: false,
                        timer: 1500
                      })
                </script>';
                   
                }else{
                   echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Proceso Fallido"
                      })
                     </script>';
                }        


            }
        }

     

     }


       #Asignar otra materia
    public static function C_otraMateria(){

        if(isset($_POST["id"])){

            echo "Entra a otra docente";

            $id=$_POST["id"];
            $id_aux=$_POST["id_aux"];
            $tabla_validar="docente";

            $filas = MetodosModelo::M_validar($id,$tabla_validar);
            echo $filas;
            $filas2 = MetodosModelo::M_validar($id_aux,$tabla_validar);
            echo $filas2;

            if($filas <=0 || $filas2 <=0 ){
                echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Revisar los ID de Docentes"
                  })
                 </script>';

            }else{

                $datos=array("curso"=>$_POST['curso'],"solicitantes"=>$_POST['solicitantes'],"id"=>$_POST['id'],"docente"=>$_POST['docente'],"id_aux"=>$_POST['id_aux'],"docente_aux"=>$_POST['docente_aux']);
    
                $tabla = "docente_asignacion";
        
                $respuesta = MetodosModelo::M_asignarMateria($datos, $tabla);
                if($respuesta == "true"){
                    echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "Proceso Exitoso",
                        showConfirmButton: false,
                        timer: 1500
                      })
                </script>';
                }else{
                    '<script>
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Proceso Fallido"
                      })
                     </script>';
                }







            }

        
    
        }
    
    
    }#end


    ####################################



    #Modificar registro
    public static function C_modificar($tabla){

        if(isset($_POST["id"])){

            $id=$_POST['id'];
           
            $filas=MetodosModelo::M_validar($id,$tabla);
           
            if($filas <=0 ){
                echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Registro no encontrado"
                  })
                 </script>';
            }else{
            
                $datos=array("id"=>$_POST['id'],"rubro"=>$_POST['rubro'],"modificacion"=>$_POST['modificacion']);
               
                $respuesta = MetodosModelo::M_modificar($datos, $tabla);

                if($respuesta == "true"){
                    echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "Proceso Exitoso",
                        showConfirmButton: false,
                        timer: 1500
                      })
                </script>';
                }

            }


        }

    }





    #####################################


    #Eliminar registro
    public static function C_eliminar($tabla){
        if(isset($_POST["id"])){

            $id=$_POST['id'];

            $filas=MetodosModelo::M_validar($id,$tabla);
         
            if($filas <=0 ){
               #echo "No existe";
               echo  '<script>
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Registro no encontrado"
                  })
                 </script>';
            }else{
      
                $respuesta = MetodosModelo::M_eliminar($id, $tabla);
                if($respuesta=="true"){
                    echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "Proceso Exitoso",
                        showConfirmButton: false,
                        timer: 1500
                      })
                </script>';
    
                }
    
            }
    
         }

    }#end


    #########################################

    #Mostrar tabla
    public static function C_mostrarTabla($tabla){

        $respuesta = MetodosModelo::M_mostrarTabla($tabla);
        return $respuesta;
 
    }#end

   

    ########################################

    public static function C_validar($tabla){

        if(isset($_POST["id"])){

            $id = $_POST["id"];
           
            $filas=MetodosModelo::M_validar($id,$tabla);

            if($filas<=0){
                echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Registro no encontrado"
                  })
                 </script>';
            }else{
                   return true;
            }


        }

    }

  
    #Buscar curso
    public static function C_buscarCurso(){

        if(isset($_POST["curso"])){

            $curso=$_POST["curso"];
         
            $tabla="docente_asignacion";

            #validar
            $filas=MetodosModelo::M_validarCurso($tabla,$curso);
            #echo $filas;             

           if($filas==1){
                $respuesta=MetodosModelo::M_buscarCurso($tabla,$curso);
                return $respuesta;
            } 
        }
    }#end

     #Buscar alumno
     public static function C_buscarAlumno(){

        if(isset($_POST["curso"])){

            $curso=$_POST["curso"];
          
            $tabla="alumno_asignacion";

            #validar
            $filas=MetodosModelo::M_validarCurso($tabla,$curso);           

           if($filas>0){
                $respuesta=MetodosModelo::M_buscarAlumno($curso);
                return $respuesta;
            }           
        }
    }#end


  ####################################



    #Registrar seleccion de alumno
    public static function C_seleccionAlumno(){

        if(isset($_POST["id"])){

            $id=$_POST["id"];
            $tabla="alumno";
            $cont=0;

            #Valida la existencia del registro
            $filas=MetodosModelo::M_validar($id,$tabla);

        
            if($filas<=0){
                echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Registro no encontrado"
                  })
                 </script>';
            }
            else{
                                
               $respuesta=MetodosModelo::M_seleccion($tabla,$id);#Selecciona toda la inf del alumno

               foreach($respuesta as $row) {
               /*echo $row['id']; echo "    "; echo $row['nombre'];echo "    "; echo $row['direccion'];echo "    ";
                echo $row['num_telefono'];echo "    ";
                echo $row['num_celular'];echo "    "; echo $row['correo_personal']; echo "    ";echo $row['correo_buap']; 
                echo "    ";echo $row['correo_doctorado']; echo "                     ";*/

                if(isset($_POST['matricula'])){$matricula=$row['id']; $cont=1;}
                else{$matricula=" ";}

                if(isset($_POST['nombre'])){$nombre=$row['nombre']; $cont=1;}
                else{$nombre=" ";}

                if(isset($_POST['direccion'])){$direccion=$row['direccion']; $cont=1;}
                else{ $direccion=" ";}

                if(isset($_POST['telefono'])){$telefono=$row['num_telefono']; $cont=1;}
                else{$telefono=" ";}

                if(isset($_POST['celular'])){$celular=$row['num_celular']; $cont=1;}
                else{$celular=" ";}

                if(isset($_POST['correop'])){$correop=$row['correo_personal']; $cont=1;}
                else{$correop=" ";}

                if(isset($_POST['correob'])){$correob=$row['correo_buap']; $cont=1;}
                else{$correob=" ";}

                if(isset($_POST['correod'])){$correod=$row['correo_doctorado']; $cont=1;}
                else{$correod=" ";}

               }

               if($cont==1){
                    
                
                /*echo "Cont  ".$cont;
                 
                echo "    Valores   ";
                echo $matricula."   ".$nombre."   ".$direccion."        ".$telefono."     ".$celular;
                echo $correop."   ".$correob."    ".$correod;*/

                 
                 $datos = $matricula."   ".$nombre."   ".$direccion."    ".$telefono."  ".$celular."   ".$correop."  ".$correob."  ".$correod;
                 echo " cadena \n$datos";
                 
                 $bandera=MetodosModelo::M_almacenarSeleccion($datos);

                 if ($bandera==1){

                    echo'<script type="text/javascript">
                    Swal.fire({
                        title: "Proceso exitoso",
                        text:"Desea seguir seleccionado información?",
                        showDenyButton: true,
                        confirmButtonText: "Finalizar",
                        denyButtonText: "Seguir",
                        confirmButtonColor:"#3085d6",
                        denyButtonColor:"#3085d6"
                      }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            window.location.href="seleccion"
                        } else if (result.isDenied) {
                          
                        }
                      })
                    </script>';

                 }
                 else{
                    echo  '<script>
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Registro no encontrado"
                    })
                 </script>';

                 }

        

               }









            }








    }
    
    }#end

      #Registrar seleccion de docente
      public static function C_seleccionDocente(){

        if(isset($_POST["id"])){

            $id=$_POST["id"];
            $tabla="docente";
            $cont=0;

            #Valida la existencia del registro
            $filas=MetodosModelo::M_validar($id,$tabla);

            if($filas<=0){
                echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Registro no encontrado"
                  })
                 </scrip>';
            }
            else{
                                
               $respuesta=MetodosModelo::M_seleccion($tabla,$id);#Selecciona toda la inf del docente

               foreach($respuesta as $row) {

                /*echo $row['id']; echo "    "; echo $row['nombre'];echo "    ";echo $row['num_telefono'];echo "    ";
                echo $row['num_celular'];echo "    "; echo $row['fecha_nacimiento']; echo "    ";echo $row['facultad_adscripcion']; 
                echo "    ";echo $row['cubiculo']; echo "         ";echo $row['tipo_tesista']; echo "          ";
                echo $row['correoBuap']; echo "              ";
                echo $row['correoVIEP']; echo "            ";*/

                if(isset($_POST['codigo'])){$codigo=$row['id']; $cont=1;}
                else{$codigo=" ";}

                if(isset($_POST['nombre'])){$nombre=$row['nombre']; $cont=1;}
                else{$nombre=" ";}

                if(isset($_POST['telefono'])){$telefono=$row['num_telefono']; $cont=1;}
                else{$telefono=" ";}

                if(isset($_POST['celular'])){$celular=$row['num_celular'];echo $cont=1;}
                else{$celular=" ";}

                if(isset($_POST['fecha'])){$fecha=$row['fecha_nacimiento']; $cont=1;}
                else{$fecha=" ";}

                if(isset($_POST['facultad'])){$facultad=$row['facultad_adscripcion']; $cont=1;}
                else{$facultad=" ";}

                if(isset($_POST['cubiculo'])){$cubiculo=$row['cubiculo'];  $cont=1;}
                else{$cubiculo=" ";}


                if(isset($_POST['t_tesista'])){$tesista=$row['tipo_tesista']; $cont=1;}
                else{$tesista=" ";}

                if(isset($_POST['correob'])){$correob=$row['correoBuap']; $cont=1;}
                else{$correob=" ";}

                if(isset($_POST['correov'])){$correov=$row['correoVIEP']; $cont=1;}
                else{$correov=" ";}

               }

               if($cont==1){

                 #echo $cont;
         
                 $datos = $codigo."   ".$nombre."   ".$telefono."    ".$celular."  ".$fecha."   ".$facultad."  ".$cubiculo."  ".$correob." ".$correov." ".$tesista;
                 echo " cadena \n$datos";
                 
                 $bandera=MetodosModelo::M_almacenarSeleccion($datos);

                    if ($bandera==1){

                        echo'<script type="text/javascript">
                        Swal.fire({
                            title: "Proceso exitoso",
                            text:"Desea seguir seleccionado información?",
                            showDenyButton: true,
                            confirmButtonText: "Finalizar",
                            denyButtonText: "Seguir",
                            confirmButtonColor:"#3085d6",
                            denyButtonColor:"#3085d6"
                        }).then((result) => {
                            /* Read more about isConfirmed, isDenied below */
                            if (result.isConfirmed) {
                                window.location.href="seleccion"
                            } else if (result.isDenied) {
                            
                            }
                        })
                        </script>';

                    }
                    else{
                        echo  '<script>
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Registro no encontrado"
                        })
                    </script>';

                    }

                

               }









            }








    }
    
    }#end


     #Registrar seleccion de docente
     public static function C_seleccionColoquio(){

        if(isset($_POST["id"])){

            $id=$_POST["id"];
            $tabla="coloquio";
            $cont=0;

            #Valida la existencia del registro
            $filas=MetodosModelo::M_validar($id,$tabla);

            if($filas<=0){
                echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Registro no encontrado"
                  })
                 </script>';
            }
            else{
                                
               $respuesta=MetodosModelo::M_seleccion($tabla,$id);#Selecciona toda la inf del coloquio

               foreach($respuesta as $row) {

                echo $row['id']; echo "    "; echo $row['titulo'];echo "    ";echo $row['fecha'];echo "    ";
                echo $row['lugar'];echo "    "; echo $row['hora'];  
             
                if(isset($_POST['titulo'])){$titulo=$row['titulo'];echo $row['titulo']; $cont=1;}
                else{$titulo=" ";}

                if(isset($_POST['fecha'])){$fecha=$row['fecha'];echo $row['fecha']; $cont=1;}
                else{$fecha=" ";}

                if(isset($_POST['lugar'])){$lugar=$row['lugar'];echo $row['lugar']; $cont=1;}
                else{$lugar=" ";}

                if(isset($_POST['hora'])){$hora=$row['hora'];echo $row['hora']; $cont=1;}
                else{$hora=" ";}

               }

               if($cont==1){

                 echo $cont;
                 $tabla2="seleccion_c";
                 $datos = array("titulo"=>$titulo,"fecha"=>$fecha,"lugar"=>$lugar,"hora"=>$hora);
                 $respuesta = MetodosModelo::M_registrarColoquio($datos, $tabla2);
         

               }









            }








    }
    
    }#end

    
    public static function C_mostrarSeleccion(){
        
        MetodosModelo::M_mostrarSeleccion();

    }

     #Limpiar tabla
     public static function C_limpiarSeleccion(){

        MetodosModelo::M_limpiarSeleccion();


    }#end
    






































}#end clase
?>



































