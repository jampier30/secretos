<?php 
	session_start();
	if($_SESSION['autentic']){
		require_once("../conn_BD.php");
        require_once("../solicitud_gastos/class/ClassSolicitudGastos.php");
        require_once("../empleados/class/classEmpleados.php");
        require_once("../legalizacionSolicGasto/class/ClasslegalizacionSolicGasto.php");
        require_once("class/ClassRelacionGastos.php");
        require_once("../funciones.php");
		$InstanciaDB=new Conexion();
        $InstSolicGastos=new Proceso_SolicitudGastos($InstanciaDB);   
        $InstSolicitudGasto=new Proceso_SolicitudGastos($InstanciaDB);
        $InstEmpleados=new Proceso_Empleados($InstanciaDB);
        $InstLegalizSolicGastos=new Proceso_LegalizacionSolicitudGastos($InstanciaDB);
        $InsRelacionGastos=new Proceso_RelacionGastos($InstanciaDB);

        $ListaSGxRelacionar=$InstSolicGastos->ListarSolicitudGastosxEstado(1);
        $listaEmpleados=$InstEmpleados->ListarEmpleados();
        $ListaLegSolicGastos=$InstLegalizSolicGastos->ListarLegalizSolicitudGastos();
        $ListaRelacionGastos=$InsRelacionGastos->ListarRelacionGasto();

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- <head> -->
    <?php include_once('../headScript.php'); ?>
    
<!-- </head> -->        
<body>
	<?php 
		include_once('../headWeb.php');
		include_once("../../menu/m_principal.php");
	?>
             <div id="wrapper">
                <div id="page-wrapper">
                    <div id="page-inner">
                        <div class="panel-body" align="right">
                            <button type="button" class="btn btn-success btn-circle" data-toggle="modal" data-target="#NuevaRelaciondeGasto">
                                <i class="fa fa-plus fa-2x"></i>
                            </button>
                        </div>
                            <div class="panel panel-primary"> 
                                <div class="panel-heading" style="height:55px;">
                                    <b>Relacion de Solicitudes de Gastos</b><div style="float:right;"><button type="button" class="btn btn-primary"><span class="badge"><?php echo $ListaRelacionGastos->num_rows; ?></span></button></div>
                                    
                                </div>
                                                  
                                <div class="panel-body">
                                    <div class="table-responsive">                                            	                               
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <th>#</th>
                                                <th>Solcicitud Gasto</th>
                                                <th>Fecha Relacion</th>
                                                <th>Valor Relacion</th>
                                                <th>Pendiente Valor x Relacionar</th>
                                                <th><span class='glyphicon glyphicon-cog' title='Config'></span></th>
                                            </thead>
                                            <tbody>
                                                <?php    
                                                    while($row=$ListaRelacionGastos->fetch_array()){
                                                        $datos=$row[0]."||".$row[1]."||".$row[2]."||".$row[3]."||".$row[4]."||".$row[5];
                                                        
                                                        $ListaResponsables=$InstSolicitudGasto->ListaResponsablesxIDsolicitud($row[1]);
                                                        $datosResponsables='';
                                                        while ($rowR=$ListaResponsables->fetch_array()) {
                                                            $datosResponsables=$datosResponsables."||".$rowR[2];
                                                        }
                                                ?>
                                                <tr class="odd gradeX">
                                                    <td><?php echo $row[0]; ?></td>
                                                    <td><?php echo $row[1]; ?></td>
                                                    <td><?php echo $row[2]; ?></td>
                                                    <td><?php echo '$'.number_format($row[4]); ?></td>
                                                    <td></td>
                                                    <td>
                                                    <button title="Ver" onclick="VerSolicitudGasto('<?php echo $datos;?>','<?php echo $datosResponsables;?>')" class="btn btn-default btn-sm" data-toggle="modal" data-target="#VerSolicitudGasto"><span class="glyphicon glyphicon-info-sign" style="color:blue;"></span></button>
                                                        <button title="Editar" onclick="formeditSolicitudGasto('<?php echo $datos;?>')" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modaleditMcpio"><span class="glyphicon glyphicon-pencil"></span></button>
                                                        <button title="Legalizar Gasto" onclick="LegalizarSolicitudGasto('<?php echo $datos;?>')" class="btn btn-default btn-sm" data-toggle="modal" data-target="#NuevaLegalizSolicitudGasto"><span class="glyphicon glyphicon-arrow-right" style="color:green;"></span> <span style="color:green;"> $</span></button>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                                
                                </div>
                            </div>                             
                    </div>               
                </div>
            </div>
    
    <!-- Inicio Modal Nueva Relacion de Solicitud de gastos --> 

            <div class="modal fade" id="NuevaRelaciondeGasto" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="overflow-y: scroll;">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">          
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>															
                            <h3 class="modal-title" id="myModalLabel">Relacion de Gastos</h3>
                        </div>
                        <div class="panel-body center-block">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <select class="js-example-basic-single" name="IdSolicitudGastoSG" id="IdSolicitudGastoSG" style="width:350px">
                                        <option value="0"> -- Seleccione una Solicitud de Gasto -- </option>                 
                                            <?php
                                                mysqli_data_seek($ListaSGxRelacionar, 0);											
                                                while ($rowMun=$ListaSGxRelacionar->fetch_array(MYSQLI_BOTH)) { 
                                                    
                                                    echo "<option value='".$rowMun[0]."'>"."#".$rowMun[0]." - ".$rowMun[1]." - ".$rowMun[13]." - $".number_format($rowMun[12])."</option>";
                                                }
                                            ?> 
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Empleado</label>
                                        <label>
                                            <select class="js-example-basic-single" name="VerresponsableSGdiv" id="VerresponsableSGdiv" style="width:350px">
                                                <?php
                                                    mysqli_data_seek($listaEmpleados, 0);
                                                    while ($rowEM=$listaEmpleados->fetch_array(MYSQLI_BOTH)) { 
                                                        echo "<option value='".$rowEM[0]."'>".$rowEM[2]."</option>";
                                                    }
                                                ?>
                                            </select>
                                        </label> 
                                    </div>
                                    <div class="form-group">
                                          <label for="">Observaciones</label>
                                            <input type="text" class="form-control form-control-xs" name="" id="ObservacioneRelacionSGdiv">
                                    </div>
                                    <div class="form-group" id="BotonesGuardarRelacionSG"></div>                              
                                </div>
                            </div>

                <!-- Carga de documento de Solicitud de gasto -->
                            <div class="row" id="DocumentoSG">
                                <label id="IDRelacionSG"></label>
                                <div id="CabSG"></div> <!-- Encabezado de la solicitud de Gasto -->
                                <div> <!-- Responsables en la solicitud de Gasto -->
                                    <label>Responsables</label>
                                    <label>
                                        <select class="js-example-basic-multiple" name="VerresponsableSGdiv2" id="VerresponsableSGdiv2" multiple="multiple">
                                            <?php
                                                mysqli_data_seek($listaEmpleados, 0);
                                                while ($rowEM=$listaEmpleados->fetch_array(MYSQLI_BOTH)) { 
                                                    echo "<option value='".$rowEM[0]."'>".$rowEM[2]."</option>";
                                                }
                                            ?>
                                        </select>
                                    </label>
                                </div>
                                <div id="ListaDetalleSGRelacion"></div> <!-- detalle de la Solicitud de Gasto para relacionar -->
                            </div>
                <!-- Fin de documento de Solicitud de gasto -->
                            
                        </div>
                            
                        <div class="modal-footer">
                            <div style="width:70%; float:left;" id="msgBotonAccionSG" class="btn-group" role="group"></div>
                            <div style="width:30%; float:right;" class="btn-group" role="group">
                                <button type="button" class="btn btn-default" onclick="limpiarmodal()" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>                                      									 
                    </div>                                          
                </div>
            </div>

    <!-- Inicio Modal subir archivo -->
        <div id="ModalUpLoadRelacion" class="modal fade" role="dialog" style="overflow-y: scroll;"> 
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header"> 
                        <h4 class="modal-tittle">Relacion de Gasto</h4>
                    </div>
                    <div id="msgRelacionSolicitudGasto"></div>
                    <div class="modal-body"> 
                        <form class="form-horizontal" role="form">
                            <div class="form-group">
                                <label class="col-sm-12 control-label"><div class="text-left">Resumen Gasto</div></label>
                            </div>
                            <div class="form-group">
                                <label for="ConceptoGastoRelacion" class="col-sm-12 control-label" id="ResumenSG"></label>
                            </div>
                            <div class="form-group">
                                <label for="NitBeneficiario" class="col-sm-4 control-label">Nit Beneficiario</label>
                                <div class="col-sm-8">
                                    <input type="text" id="NitBeneficiario" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="NombreBeneficiario" class="col-sm-4 control-label">Nombre Beneficiario</label>
                                <div class="col-sm-8">
                                    <input type="text" id="NombreBeneficiario" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="NumeroFactura" class="col-sm-4 control-label">Numero Factura</label>
                                <div class="col-sm-8">
                                    <input type="text" id="NumeroFactura" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="ValorFactura" class="col-sm-4 control-label">Valor Factura</label>
                                <div class="col-sm-8">
                                    <input type="text" id="ValorFactura" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="ValorFactura" class="col-sm-4 control-label">Pago Tarjeta Credito?</label>
                            
                                <div class="col-sm-8">
                                    <div class="form-check">
                                      <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="PagoTCD" id="PagoTCD">
                                      </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Observaciones" class="col-sm-4 control-label">Observaciones</label>
                                <div class="col-sm-8">
                                    <input type="text" id="Observaciones" class="form-control">
                                </div>
                            </div>
                            <div class="form-group" id="SubirImagenes">
                                <label for="AdjuntarImagenes" class="col-sm-4 control-label">Adjuntar Imagenes</label>
                                <div class="col-sm-8">        
                                    <input type="file"  id="fileToUpload">
                                    <div id="preview"></div>
                                </div> 
                            </div>
                        </form> 
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            <span class="glyphicon glyphicon-remove"></span><span class="hidden-xs"> Cerrar</span>
                        </button>
                        <button type="button" id="GuardarRelacion" name="GuardarRelacion" onclick="GuardarDetalleRelacion();" class="btn btn-primary">
                            <span class="fa fa-save"></span><span class="hidden-xs"> Guardar</span>
                            
                        </button>
                    </div>
                </div>
            </div>
        </div>

    <!-- Final Modal Nueva Relacion de Solicitud de gastos --> 

    <script src="../../assets/js/jquery-1.10.2.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>
    <script src="../../assets/js/jquery.metisMenu.js"></script>
    <script src="../../assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="../../assets/js/dataTables/dataTables.bootstrap.js"></script>
    <script src="../../assets/js/jasny-bootstrap.min.js"></script>
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <style>
        #preview {
            border:1px solid #ddd;
            padding:5px;
            border-radius:2px;
            background:#fff;
            max-width:200px;
        }

        #preview img {width:100%;display:block;}
    
    </style>
    <script>
       $(document).ready(function() {
        $('#DocumentoSG').hide();
        $('.js-example-basic-multiple').select2({
                    placeholder:"Responsables",
                    allowClear: true,
                    disabled: true
                });

            $('.js-example-basic-single').select2({
                dropdownParent: $("#NuevaRelaciondeGasto")
            });

            $('#IdSolicitudGastoSG').change(function () {
                var IdSG=$(this).val();

                var texto=`<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            <button type="button" onclick="guardarNuevaRelacionSG(`+IdSG+`);" class="btn btn-primary">Crear Nueva Relacion</button>`;
                
                $('#BotonesGuardarRelacionSG').html(texto);
            });

            jQuery('#NuevaRelaciondeGasto').on('hidden.bs.modal', function (e) {
                jQuery(this).removeData('bs.modal');
                jQuery(this).find('.modal-content').empty();
            })

        });
        
        function limpiarmodal() {
            $('#DocumentoSG').hide();
            $('#IdSolicitudGastoSG').find('option:first').attr('selected', 'selected').parent('select');
            $('#ListaDetalleSGRelacion').html('');
            $('#BotonesGuardarRelacionSG').html('');
            $('#VerresponsableSGdiv2 option[value="0"]').attr('selected',true);
            $('#ObservacioneRelacionSGdiv').val('');
        }

        
        $('#fileToUpload').change(function (e) {
                let reader = new FileReader();
            reader.onload = function(){
                let preview = document.getElementById('preview'),
                        image = document.createElement('img');
                image.src = reader.result;  
                preview.innerHTML = '';
                preview.append(image);
            };
            reader.readAsDataURL(e.target.files[0]);
            });
        
    </script>
   
</body>
</html>
<?php 
	}else{
		header('Location:../../php_cerrar.php');
	}
?>
