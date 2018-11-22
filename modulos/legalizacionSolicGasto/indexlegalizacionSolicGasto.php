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
       
        $listaSolicGastos=$InstSolicGastos->ListarSolicitudGastosxEstado(0);
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
    

               <!-- Inicio Modal Nueva Legalizacion de solicitud de gastos --> 

                    <?php require_once('../legalizacionSolicGasto/modalnuevalegalizacion.php'); ?>

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
                    dropdownParent: $("#NuevaLegalizSolicitudGasto")
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
