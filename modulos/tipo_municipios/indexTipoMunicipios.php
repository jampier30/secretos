<?php 
	 session_start();
	 if($_SESSION['autentic']){
		 require_once("../conn_BD.php");
         require_once('class/ClassTipoMunicipios.php'); 
		 require_once("../../modulos/funciones.php");
		 $InstanciaDB=new Conexion();
		 $insTipoMcpio=new Proceso_TipoMunicipio($InstanciaDB);
		 $LastidtipoMcpio=$insTipoMcpio->getlastidTipoMunicipio();
		 $ListatipoMcpio=$insTipoMcpio->ListaTipoMunicipio();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- <head> -->
    <?php include_once('../headScript.php'); ?>
<!-- </head> -->        
<body>
    <div id="wrapper">
        <?php 
            include_once('../headWeb.php');
            include_once("../../menu/m_principal.php");
        ?>
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="panel-body" align="right">  
                    <button type="button" class="btn btn-success btn-circle" data-toggle="modal" data-target="#modalinsertPrograma">
                        <i class="fa fa-plus fa-2x"></i>
                    </button>
                </div>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Tipo de Municipio
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">                                            	                               
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>ID</i></th>
                                        <th>Cod Tipo Municipio</th>
                                        <th>Descripcion tipo de Municipio</th>
                                        <th><span class='glyphicon glyphicon-cog' title='Config'></span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        while($row=$ListatipoMcpio->fetch_array()){
                                        $datos=$row[0]."||".$row[1]."||".$row[2];
                                    ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $row[0]; ?></td>
                                        <td><?php echo $row[1]; ?></td>
                                        <td><?php echo $row[2]; ?></td>
                                        <td><button title="Edit" onclick="formeditTipoMcpio('<?php echo $datos;?>')" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modaleditTipoMcpio"><span class="glyphicon glyphicon-pencil"></span></button></td>
                                    </tr> 
                                    <?php } ?>
                                </tbody>									
                            </table>							
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal de insertar Tipo Municipio  nuevo-->
        <div class="modal fade" id="modalinsertPrograma" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h3 class="modal-title" id="exampleModalLabel">Nuevo tipo Municipio</h3>
                        <div class="col-md-10">
                            <div id="msgTipoMcpio"></div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">ID</label>
                            <input type="text" class="form-control  form-control-sm" name="idTipoMunicipio" id="idTipoMunicipio" aria-describedby="Codigo tipo Municipio"  autocomplete="off" autofocus require>
                        </div>
                        <div class="form-group">
                            <label for="">Codigo Tipo Municipio</label>
                            <input type="text" class="form-control  form-control-sm" name="codTipoMcpio" id="CodTipoMunicipio" aria-describedby="Codigo tipo Municipio"  autocomplete="off" autofocus require>
                        </div>
                        <div class="form-group">
                            <label for="">descripcion tipo municipio</label>
                            <input type="text" class="form-control  form-control-sm" name="DescTipoMunicipio" id="DescTipoMunicipio" aria-describedby="Descripcion Tipo Municipio" autocomplete="off" require>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" onclick="InsertTipoMunicipio();">Guardar</button>
                    </div>
                </div>
            </div>  
        </div>
    <!-- Fin modal de insertar Tipo Municipio nuevo -->
                    

    <!-- Modal para Editar tipo Municipio-->
        <div class="modal fade" id="modaleditTipoMcpio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Editar Actividad</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" action="" method="post">
                        <fieldset>
                            <div id="msgEditTipoMcpio"></div>
                            <div class="form-group">
                                <label>ID</label>
                                <input id="idTipoMcpioFM" name="idTipoMcpioFM" type="text" class="form-control" autocomplete="off" disabled>
                            </div> 
                            <div class="form-group">
                                <label>Codigo tipo Municipio</label>
                                <input id="CodTipoMcpioFM" name="CodTipoMcpioFM" type="text" class="form-control" autocomplete="off" required>
                            </div>                           
                            <div class="form-group">
                                <label>Descripcion Tipo de Municipio</label>
                                <input id="descTipoMcpioFM" name="descTipoMcpioFM" type="text" class="form-control" autocomplete="off" required>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button class="btn btn-primary" onclick="EditarTipoMcpio();">Grabar</button>
                </div>
                </div>
            </div>
        </div>
        <!-- /Modal para Editar Tipo de municipio-->

    <script src="../../assets/js/jquery-1.10.2.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>
    <script src="../../assets/js/jquery.metisMenu.js"></script>
    <script src="../../assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="../../assets/js/dataTables/dataTables.bootstrap.js"></script>
	<script src="../../assets/js/jasny-bootstrap.min.js"></script>
        <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
    </script>
         <!-- CUSTOM SCRIPTS -->
    <script src="../../assets/js/custom.js"></script>
</body>
</html>
<?php 
    }else{
		 header('Location:../../php_cerrar.php');
     }
     ?>