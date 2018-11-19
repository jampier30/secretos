<?php 
	session_start();
	if($_SESSION['autentic']){
		require_once("../conn_BD.php");
        require_once("../solicitud_gastos/class/ClassSolicitudGastos.php");
        require_once("../empleados/class/classEmpleados.php");
        require_once("class/ClasslegalizacionSolicGasto.php");
        require_once("../funciones.php");
		$InstanciaDB=new Conexion();
        $InstSolicGastos=new Proceso_SolicitudGastos($InstanciaDB);   
        $InstSolicitudGasto=new Proceso_SolicitudGastos($InstanciaDB);
        $InstEmpleados=new Proceso_Empleados($InstanciaDB);
        $InstLegalizSolicGastos=new Proceso_LegalizacionSolicitudGastos($InstanciaDB);
       
        $listaSolicGastos=$InstSolicGastos->ListarSolicitudGastos();
        $listaEmpleados=$InstEmpleados->ListarEmpleados();
        $ListaLegSolicGastos=$InstLegalizSolicGastos->ListarLegalizSolicitudGastos();
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
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-primary">     
                            <div class="panel-heading">
                                <h4>Legalización Solicitudes de Gastos</h4>
                            </div>                         
                            <div class="panel-body">
                                <button type="button" class="btn btn-success btn-circle" data-toggle="modal" data-target="#NuevaLegalizSolicitudGasto">
                                    <i class="fa fa-plus fa-2x"></i>
                                </button>
                            </div>
                       
                    </div>
                </div>
            </div>                                
        </div>               
    </div>
</div>
    

    <!-- Inicio Modal Nueva Solicitud de gastos --> 

        <div class="modal fade" id="NuevaLegalizSolicitudGasto" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>															
                            <h3 align="center" class="modal-title" id="myModalLabel">Nueva Legalizacion Solicitud de Gastos - # <label id="IdSolicitudGastoSG"> <?php echo $NextSolicitud; ?></Label></h3>
                            <div id="msgLegalizSolicitudGasto"></div>
                        </div>
                        <div id="msgInstitucionNuevo"></div>
                        <div class="panel-body">
                            <div class="row col-sm-5">                                   
                                <div class="form-group">
                                    <select class="js-example-basic-single" name="IdSolicitudGastoSG" id="IdSolicitudGastoSG" style="width:250px">
                                    <option value="00"> -- Seleccione una solicitud de gasto -- </option>                    
                                         <?php
                                            mysqli_data_seek($listaSolicGastos,0);																		
                                            while ($rowMun=$listaSolicGastos->fetch_array(MYSQLI_BOTH)) { 
                                                echo "<option value='".$rowMun[0]."'>".$rowMun[1]."'>".$rowMun[2]."'>".$rowMun[3]."'>".$rowMun[4]."</option>";
                                                }
                                        ?> 
                                    </select>
                                </div>

                                <div class="form-group">
                                    <div class="input-append date form_datetime" data-date="<?php echo $fechadatetimepicker;?>">
                                        <input id="FechaSG" size="16" type="text"  class="form-control" autocomplete="off" readonly style="width:230px" placeholder="Fecha legalizacion">
                                        <span class="add-on"><i class='fas fa-calendar-alt'></i></span>
                                        <span class="add-on"><i class="icon-th"></i></span>
                                    </div>
                                    <script type="text/javascript">
                                        $(".form_datetime").datetimepicker({
                                            format: "dd/mm/yyyy - HH:ii P",
                                            showMeridian: true,
                                            autoclose: true,
                                            todayBtn: true
                                        });
                                    </script>   
                                </div>
                                <div class="form-group">
                                    
                                    <select class="js-example-basic-multiple" name="responsableSG" id="responsableSG" multiple="multiple" style="width:230px">
                                        <?php
                                            mysqli_data_seek($listaEmpleados, 0);
                                            while ($rowEM=$listaEmpleados->fetch_array(MYSQLI_BOTH)) { 
                                                echo "<option value='".$rowEM[0]."'>".$rowEM[2]."</option>";
                                            }
                                        ?>
                                    </select>
                                </div>

                            <div class="row">
                                <div class="col-sm-12">
                                <div class="form-group">
                            <label for="">Valor  Legalizar</label>
                            <input type="text" class="form-control  form-control-sm" name="TotalSolicitudGastoSG" id="TotalSolicitudGastoSG" aria-describedby="Valor  Legalizar"  autocomplete="off" require>
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
            </form>
        </div>

    <!-- Final Modal Nuevo Solicitud de gastos --> 

    <script src="../../assets/js/jquery-1.10.2.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>
    <script src="../../assets/js/jquery.metisMenu.js"></script>
    <script src="../../assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="../../assets/js/dataTables/dataTables.bootstrap.js"></script>
    <script src="../../assets/js/jasny-bootstrap.min.js"></script>
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    
    <script>
       $(document).ready(function() {
                
                $('.js-example-basic-multiple').select2({
                    placeholder:"Responsables"
                });

                $('.js-example-basic-single').select2({
                    dropdownParent: $("#NuevaSolicitudGasto")
                });


                $('.NumeroDias').on("keypress keyup blur",function (event) {    
                    $(this).val($(this).val().replace(/[^\d].+/, ""));
                    if ((event.which < 48 || event.which > 57)) {
                        if (event.which == 8) {
                            
                        }else{
                            event.preventDefault();
                        }
                    }
                });

                $("#ValorGasto").on({
                    "focus": function(event) {
                        $(event.target).select();
                    },
                    "keyup": function(event) {
                        $(event.target).val(function(index, value) {
                        return value.replace(/\D/g, "")
                            .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
                        });
                    }
                });

                $(".ValorGasto").on("keypress keyup",function (event) {    
                        $(this).val($(this).val().replace(/[^0-9\.]/g,','));
                        if (($(this).val().indexOf(',') != -1) && (event.which < 48 || event.which > 57)) {
                            if (event.which == 8 || event.which == 44) {

                            }else{
                                event.preventDefault();
                            }
                        }
                });
        });
    
    function mostrar_items(){
		var parametros={"action":"ajax"};
		$.ajax({
            url:'../../logica/logica.php?accion=ListarDetalleTMP',
            type: "POST",
            data: parametros,
            beforeSend: function(objeto){
				 $('#msgDetalleSolicitudGastoLista').html('Cargando...');
		  },
			success: function(data){
                $("#msgDetalleSolicitudGastoLista").html(data).fadeIn('slow');
		}
		});
    }

function InsertarDetalleTMP(){
    var IdSolicitudGasto =$('#IdSolicitudGastoSG').text();
    var ConceptoGastoSG=$('#ConceptoGastoSG').val();
    var NumDiasSG=$('#NumDiasSG').val();
    var ValorConceptoSG=$('#ValorConceptoSG').val();
    var parametros =  {IdSolicitudGasto,ConceptoGastoSG,NumDiasSG,ValorConceptoSG};
    $.ajax({
        type: "POST",
        url:'../../logica/logica.php?accion=InsertarDetalleTMP',
        data: parametros,
        success:function(data){
            mostrar_items();
        }
    })
}

function eliminar_item(id_detalle_TMP){
  var parametros = {id_detalle_TMP};
  $.ajax({
    url:'../../logica/logica.php?accion=eliminar_item',
    type: 'POST',
    data: parametros,
    success:function(data){
        mostrar_items();
    }
  });
}
    mostrar_items();
    </script>
   
</body>
</html>
<?php 
	}else{
		header('Location:../../php_cerrar.php');
	}
?>
