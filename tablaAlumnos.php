    
    
    
    <div class="container mt-5">

                <div class="row text-center" >
                    <h1><i class="bi bi-mortarboard-fill"></i></h1>
                </div>
                <div class="row text-center" >
                   <h4>Alumnos Registrados</h4>
                </div>
                <div class="row d-flex align-items-center justify-content-center my-3">
                    <div class="col">
                        <a href="seleccionAlumnos" target="_blank"> <input type="button" class="btn btn-primary" value="Imprimir / Exportar" ></a>
                    </div>
                
                </div>

            <div class="row">
                <table class="table">
                
                    <tr>
                        <th >Matricula</th><th>Nombre</th><th>Dirección</th><th>Teléfono</th><th>Celular</th><th>Correo Personal</th><th>Correo BUAP </th><th>Correo Doctorado</th>
                    </tr>

                        <?php 
                        
                            $tabla="alumno";
                            $respuesta = MetodosControlador::C_mostrarTabla($tabla); //realiza la consulta

                            foreach($respuesta as $row) 

                                { ?> <!--Recupera la información de la BD por filas-->

                                    <tr>
                                        <td><?php echo $row["id"];?></td><td><?php echo $row["nombre"];?></td><td><?php echo $row["direccion"];?></td><td><?php echo $row["num_telefono"];?></td> <td><?php echo $row["num_celular"];?></td><td><?php echo $row["correo_personal"];?></td><td><?php echo $row["correo_buap"];?></td><td><?php echo $row["correo_doctorado"];?></td>
                                    </tr>
                            <?php
                                } 
                
                            ?> 
                </table>

            </div>
           



    </div>
            



   