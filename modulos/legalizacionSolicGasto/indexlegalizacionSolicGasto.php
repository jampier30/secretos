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
       
        $ListaSGxLegalizar=$InstSolicGastos->ListarSolicitudGastosxEstado(0);
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
                        <div class="panel-body" align="right">
                            <button type="button" class="btn btn-success btn-circle" data-toggle="modal" data-target="#NuevaLegalizSolicitudGasto">
                                <i class="fa fa-plus fa-2x"></i>
                            </button>
                        </div>
                            <div class="panel panel-primary"> 
                                <div class="panel-heading" style="height:55px;">
                                    <b>Relacion de Legalizaciones de Gastos</b><div style="float:right;"><button type="button" class="btn btn-primary"><span class="badge"><?php echo $ListaLegSolicGastos->num_rows; ?></span></button></div>
                                    
                                </div>
                                                  
                                <div class="panel-body">
                                    <div class="table-responsive">                                            	                               
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <th># Legalizacion</th>
                                                <th>Solicitud Gasto</th>
                                                <th>Fecha Legalizacion</th>
                                                <th>Usuario Legalizacion</th>
                                                <th>Valor Legalizacion</th>
                                                <th><span class='glyphicon glyphicon-cog' title='Config'></span></th>
                                            </thead>
                                            <tbody>
                                                <?php    
                                                    while($row=$ListaLegSolicGastos->fetch_array()){
                                                        $datos=$row[0]."||".$row[1]."||".$row[2]."||".$row[3]."||".$row[4];
                                                        
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
                                                    <td><?php echo $row[3]; ?></td>
                                                    <td><?php echo '$'.number_format($row[4]); ?></td>
                                                    <td></td>
                                                    <td>
                                                    
                                                        <button title="Editar" onclick="formeditLegalizSolicGasto('<?php echo $datos;?>')" 
                                                             class="btn btn-default btn-sm" data-toggle="modal" data-target="#modaleditLegaliz"><span class="glyphicon glyphicon-pencil"></span></button>
                                                     
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

    <!-- Modal para Editar legalizacion-->
    <div class="modal fade" id="modaleditLegaliz" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Editar Legalizacion</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" action="" method="post">
                        <fieldset>
                            <div id="msgLegalizEdit"></div>
                            <div class="form-group">
                                <label>Id Legalizacion</label>
                                <input id="idLegalizFM" name="idLegalizFM" type="text" placeholder="formeditIdLegaliz" class="form-control" autocomplete="off" disabled>
                            </div>                           
                            <div class="form-group">
                                <label>Id Solicitud Gasto</label>
                                <input id="idSolicGastoFM" name="idSolicGastoFM" type="text" placeholder="formeditIdSolicGasto" class="form-control" autocomplete="off" disabled>
                            </div>
                            <div class="form-group">
                                <label>Fecha de Legalizacion</label>
                                <input id="FechaLegalizFM" name="FechaLegalizFM" type="text" placeholder="formeditFechalegal" class="form-control" autocomplete="off" disabled>
                            </div>
                            <div class="form-group">
                                <label>Usuario Legalizacion</label>
                                <input id="UsuarioLegFM" name="UsuarioLegFM" type="text" placeholder="formeditUsuarioLeg" class="form-control" autocomplete="off" disabled>
                            </div>
                            <div class="form-group">
                                <label>Valor Legalizar</label>
                                <input id="ValorLEgalizFM" name="ValorLEgalizFM" type="text" placeholder="formeditValorLEgaliz" class="form-control" autocomplete="off" required>
                            </div>
                          
                        </fieldset>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button class="btn btn-primary" onclick="EditarLegaliz();">Grabar</button>
                </div>
                </div>
            </div>
        </div>
        <!-- /Modal para Editar Legalizacion -->

               <!-- Inicio Modal Nueva Legalizacion de solicitud de gastos --> 

                    <?php include_once('modalnuevalegalizacion.php'); ?>

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
      
        $('#IdSolicitudGastoSG2').change(function () {
            var IdSG =$('#IdSolicitudGastoSG2').val(); 
            console.log(IdSG);
            mostrarCABSGLegaliz(IdSG);
            mostrarDetalleSG();
            });

 function mostrarDetalleSG() {
        var IdSG=$('#IdSolicitudGastoSG2').val();
        var parametros={IdSG};
        
        $.ajax({
            url:'../../logica/logica.php?accion=ListarDetalleSG',
            type: "POST",
            data: parametros,
            beforeSend: function(objeto){
				 $('#ListaDetalleSG').html('Cargando...');
		  },
			success: function(data){
                $("#ListaDetalleSG").html(data).fadeIn('slow');
		}
        });   
    }

    
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
    mostrar_items();
    </script>
   
</body>
</html>
<?php 
	}else{
		header('Location:../../php_cerrar.php');
	}
?>
