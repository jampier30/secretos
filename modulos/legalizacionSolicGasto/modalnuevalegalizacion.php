        <div class="modal fade" id="NuevaLegalizSolicitudGasto" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>															
                        <h3 align="center" class="modal-title" id="myModalLabel">Nueva Legalizacion Solicitud de Gastos </h3>
                        <div id="msgLegalizSolicitudGasto"></div>
                    </div>
                        <div id="msgInstitucionNuevo"></div>
                    <div class="panel-body">
                        <div class="row col-sm-5">                                   
                            <div class="form-group">
                                <select class="js-example-basic-single" name="IdSolicitudGastoSG" id="IdSolicitudGastoSG" style="width:350px">
                                <option value="00"> -- Seleccione una solicitud de gasto -- </option>                 
                                    <?php											
                                        while ($rowMun=$listaSolicGastos->fetch_array(MYSQLI_BOTH)) {  
                                            echo "<option value='".$rowMun[0]."'>"."#".$rowMun[0]." - ".$rowMun[1]." - ".$rowMun[13]." - $".number_format($rowMun[12])."</option>";
                                        }
                                    ?> 
                                </select>
                            </div>

                            <div class="form-group">   
                                <select class="js-example-basic-single" name="responsableSG2" id="responsableSG2" style="width:230px">
                                    <?php
                                        mysqli_data_seek($listaEmpleados, 0);
                                        while ($rowEM=$listaEmpleados->fetch_array(MYSQLI_BOTH)) { 
                                            echo "<option value='".$rowEM[2]."'>".$rowEM[2]."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                    <?php
                                    // $ValorSolcitud=$InstSolicGastos->BuscarSolicitudGastosxid("IdSolicitudGastoSG");
                                    ?>
                                        <label for="">Valor  Legalizar</label>
                                        <input type="text" class="form-control  form-control-sm" name="VrLegSolicGastoSG" id="VrLegSolicGastoSG" aria-describedby="Valor"  autocomplete="off" require>
                                    </div>        
                                </div>
                            </div>
                        </div>                                                  									 
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="button" onclick="guardarLegalizSolicitudGasto();" class="btn btn-primary">Guardar</button>
                    </div>	
                </div>    
            </div>
        </div>