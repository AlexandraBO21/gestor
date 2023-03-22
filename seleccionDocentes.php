

    
    <div class="container p-0 w-50 mt-5 pt-3 shadow ">

        <form method="post" id="formulario">

        <div class="row text-center" >
                    <h1><i class="bi bi-person-video3"></i></h1>
                </div>
                <div class="row text-center" >
                   <h4>Selección de Información de Docentes</h4>
                </div>

                <div class="row d-flex align-items-center justify-content-center my-5">

                        <div class="col-3 form-floating ">
                            
                            <input type="text" class="form-control"  name=id id="id" placeholder="ID" required>
                            <label for="id"><i class="bi bi-pencil-square mx-1"></i>ID</label>
                        </div>
    
                </div>

                <div class="row my-3">
                        <div class="col">

                            <input class="form-check-input" type="checkbox" name="codigo" id="flexCheckDefault"> 
                            <label class="form-check-label" for="flexCheckDefault">
                                ID
                            </label>
                        </div>
                        <div class="col ">
                            <input class="form-check-input" type="checkbox" name="nombre" id="flexCheckDefault"> 
                            <label class="form-check-label" for="flexCheckDefault">
                                Nombre
                            </label>
                        </div>
                      
                        <div class="col ">
                            <input class="form-check-input" type="checkbox" name="telefono" id="flexCheckDefault"> 
                            <label class="form-check-label" for="flexCheckDefault">
                                Teléfono
                            </label>
                        </div>

                        <div class="col-3 ">
                            <input class="form-check-input" type="checkbox" name="celular" id="flexCheckDefault"> 
                            <label class="form-check-label" for="flexCheckDefault">
                                Celular
                            </label>
                        </div>
                       
                       
                </div>

                <div class="row my-3">
                        <div class="col ">
                            <input class="form-check-input" type="checkbox" name="cubiculo" id="flexCheckDefault"> 
                            <label class="form-check-label" for="flexCheckDefault">
                                Cubiculo
                            </label>
                        </div>
                        <div class="col ">
                            <input class="form-check-input" type="checkbox" name="t_tesista" id="flexCheckDefault"> 
                            <label class="form-check-label" for="flexCheckDefault">
                                Tipo Tesista
                            </label>
                        </div>
                        
                       
                        <div class="col ">
                            <input class="form-check-input" type="checkbox" name="correob" id="flexCheckDefault"> 
                            <label class="form-check-label" for="flexCheckDefault">
                                Correo BUAP
                            </label>
                        </div>    

                            <div class="col ">
                            <input class="form-check-input" type="checkbox" name="correov" id="flexCheckDefault"> 
                            <label class="form-check-label" for="flexCheckDefault">
                                Correo VIEP
                            </label>
                        </div>


                           
                      
                       
                </div>

                <div class="row my-3">

                <div class="col ">
                            <input class="form-check-input" type="checkbox" name="fecha" id="flexCheckDefault"> 
                            <label class="form-check-label" for="flexCheckDefault">
                                Fecha de Nacimiento
                            </label>
                        </div>
                       
                        <div class="col ">
                            <input class="form-check-input" type="checkbox" name="facultad" id="flexCheckDefault"> 
                            <label class="form-check-label" for="flexCheckDefault">
                                Facultad de Adscripcion
                            </label>
                        </div>

                        



                </div>


              
                <div class="row   py-3  text-center">
                    <input type="submit" class="btn btn-primary" value="Enviar" >
                </div>
                
                <?php 
                      $seleccion = new MetodosControlador();
                      $seleccion-> C_seleccionDocente();
                ?>

        </form>
    </div>

    
    
   