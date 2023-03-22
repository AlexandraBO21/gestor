
          
<div class="container mt-5">

                <div class="row text-center" >
                    <h1><i class="bi bi-person-video3"></i></h1>
                </div>
                <div class="row text-center" >
                   <h4>Docentes Registrados</h4>
                </div>
                <div class="row d-flex align-items-center justify-content-center my-3">
                    <div class="col">
                        <a href="seleccionDocentes" target="_blank"> <input type="button" class="btn btn-primary" value="Imprimir / Explorar" ></a>
                    </div>
                </div>

            <div class="row">
                <table  class="table">
                        <tr>
                        <th>ID</th><th>Nombre</th><th>Teléfono</th><th>Celular</th><th>Fecha de Nacimiento</th><th>Facultad de Adscripcion</th><th>Cubiculo</th><th>Correo BUAP</th><th>Correo VIEP</th><th>Tipo Tesista</th>
                        </tr>

                        <?php 
                        
                            $tabla="docente";
                            $respuesta = MetodosControlador::C_mostrarTabla($tabla); //realiza la consulta


                            foreach($respuesta as $row) 
                                { ?> <!--Recupera la información de la BD por filas-->

                                    <tr>
                                    <td><?php echo $row["id"];?></td><td><?php echo $row["nombre"];?></td><td><?php echo $row["num_telefono"];?></td> <td><?php echo $row["num_celular"];?></td><td><?php echo $row["fecha_nacimiento"];?></td><td><?php echo $row["facultad_adscripcion"];?></td><td><?php echo $row["cubiculo"];?></td><td><?php echo $row["correoBuap"];?></td><td><?php echo $row["correoVIEP"];?></td><td><?php echo $row["tipo_tesista"];?></td>
                                    </tr>
                                <?php
                                } 
                        ?>
                    </table> 
            </div>
           



</div>
            