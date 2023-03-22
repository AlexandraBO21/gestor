

   

    <div class="container p-0 w-50 mt-5 pt-3 shadow ">

        <form method="post" id="formulario">

                <div class="row text-center" >
                    <h1><i class="bi bi-mortarboard-fill"></i></h1>
                </div>
                <div class="row text-center" >
                   <h4>Selección de Información de Alumnos</h4>
                </div>

                <div class="row d-flex align-items-center justify-content-center my-5">

                        <div class="col-3 form-floating ">
                            
                            <input type="number" class="form-control"  name=id id="matricula" placeholder="Matricula" maxlength="9" oninput="validar_longitud(this.id)" required>
                            <label for="matricula"><i class="bi bi-pencil-square mx-1"></i>Matricula</label>
                        </div>
    
                </div>

                <div class="row my-3">
                        <div class="col">

                            <input class="form-check-input" type="checkbox" name="matricula" id="flexCheckDefault"> 
                            <label class="form-check-label" for="flexCheckDefault">
                                Matricula
                            </label>
                        </div>
                        <div class="col ">
                            <input class="form-check-input" type="checkbox" name="nombre" id="flexCheckDefault"> 
                            <label class="form-check-label" for="flexCheckDefault">
                                Nombre
                            </label>
                        </div>
                        <div class="col ">
                            <input class="form-check-input" type="checkbox" name="direccion" id="flexCheckDefault"> 
                            <label class="form-check-label" for="flexCheckDefault">
                                Dirección
                            </label>
                        </div>
                        <div class="col ">
                            <input class="form-check-input" type="checkbox" name="telefono" id="flexCheckDefault"> 
                            <label class="form-check-label" for="flexCheckDefault">
                                Teléfono
                            </label>
                        </div>
                      
                       
                </div>

                <div class="row my-3">
                        <div class="col-3 ">
                            <input class="form-check-input" type="checkbox" name="celular" id="flexCheckDefault"> 
                            <label class="form-check-label" for="flexCheckDefault">
                                Celular
                            </label>
                        </div>

                        <div class="col ">
                            <input class="form-check-input" type="checkbox" name="correop" id="flexCheckDefault"> 
                            <label class="form-check-label" for="flexCheckDefault">
                                Correo Personal
                            </label>
                        </div>
                        <div class="col ">
                            <input class="form-check-input" type="checkbox" name="correob" id="flexCheckDefault"> 
                            <label class="form-check-label" for="flexCheckDefault">
                                Correo Buap
                            </label>
                        </div>
                        <div class="col ">
                            <input class="form-check-input" type="checkbox" name="correod" id="flexCheckDefault"> 
                            <label class="form-check-label" for="flexCheckDefault">
                                Correo Doctorado
                            </label>
                        </div>

                </div>

              
                <div class="row   py-3  text-center">
                    <input type="submit" class="btn btn-primary" value="Enviar" >
                </div>
                
                <?php 
                      $seleccion = new MetodosControlador();
                      $seleccion-> C_seleccionAlumno();
                ?>

        </form>
    </div>


   
    
    <script type="text/javascript">
        
        function validar_longitud(id) {
            let input = document.getElementById(id);
            let value = input.value;
            if (value.length > input.maxLength) {
                input.value = value.substring(0, input.maxLength);
            }
        }

        
        function imprimir(){

            //jquery para borrar el formulario e imprimir la tabla
            $(document).ready(function() {
                $("#btnImprimir").click(function(event) {
                    $("#formulario").remove();
                    $("#btns").remove();
                    window.print();
                });
            });
        }


          
    </script>
    