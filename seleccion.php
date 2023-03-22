    
    <div class="container mt-5">

      
        <div class="row text-center" id="titulo">
            <h4>Información Seleccionada</h4>
        </div>
        <div class="row d-flex align-items-center justify-content-center my-3" id="btns">

            <div class="col-1">
                 <button class="btn btn-primary" id="btnImprimir" onclick="imprimir()">Imprimir</button>
            </div>

            <div class="col-1">
                 <button class="btn btn-primary" id="btnExportar" onclick="exportar(this.id)">Exportar</button>
            </div>

            <div class="col-1 ms-2">
                <a href=""> <input type="button" class="btn btn-primary"  name="finalizar "value="Finalizar" onclick="finalizar()"></a>
            </div>

        </div>

        <div class="row" id="tabla">
      
                <?php
                    MetodosControlador::C_mostrarSeleccion(); //realiza la consulta
                ?> 
        </div>




    </div>
    
    <script type="text/javascript">
        
        function imprimir(){

            //jquery para borrar el formulario e imprimir la tabla
            $(document).ready(function() {
                $("#btnImprimir").click(function(event) {
                   // $("#titulo").remove();
                   // $("#btns").remove();
                    window.print();
                });
            });
        }

        function exportar(id){
            const $btnExportar = document.querySelector("#btnExportar"),
                $tabla = document.querySelector("#tabla");

                $btnExportar.addEventListener("click", function() {
                let tableExport = new TableExport($tabla, {
                    exportButtons: false, // No queremos botones
                    filename: "sistema_gestor", //Nombre del archivo de Excel
                    sheetname: "informacion", //Título de la hoja
                });
                let datos = tableExport.getExportData();
                let preferenciasDocumento = datos.tabla.xlsx;
                tableExport.export2file(preferenciasDocumento.data, preferenciasDocumento.mimeType, preferenciasDocumento.filename, preferenciasDocumento.fileExtension, preferenciasDocumento.merges, preferenciasDocumento.RTL, preferenciasDocumento.sheetname);
                });
        }

        
        function finalizar(){
            <?php
                    $limpiar = new MetodosControlador();
                    $limpiar-> C_limpiarSeleccion();
                    
            ?>
             window.close();
        }
    </script>
    