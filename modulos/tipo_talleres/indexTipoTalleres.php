<?php 
	 session_start();
	 if($_SESSION['autentic']){
		 require_once("../conn_BD.php");
         require_once('class/ClassTipoTalleres.php');
		 require_once("../../modulos/funciones.php");
		 $InstanciaDB=new Conexion();
		 $insTipoTall=new Proceso_TipoTaller($InstanciaDB);
		 $LastidTipoTall=$insTipoTall->getlastidTipoTaller();
		 $ListaTipoTall=$insTipoTall->ListaTipoTaller();
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
                        Tipo De Talleres
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">                                            	                               
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>ID Tipo de Talleres</i></th>
                                        <th>Descripcion  Tipo Talleres</th>
                                        <th>Estado de tipo de Talleres</th>
                                        <th><span class='glyphicon glyphicon-cog' title='Config'></span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        while($row=$ListaTipoTall->fetch_array()){
                                        $datos=$row[0]."||".$row[1]."||".$row[2];
                                    ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $row[0]; ?></td>
                                        <td><?php echo $row[1]; ?></td>
                                        <td><?php echo $row[2]; ?></td> 
                                        <td><button title="Edit" onclick="formeditTipoTaller('<?php echo $datos;?>')" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modaleditPrograma"><span class="glyphicon glyphicon-pencil"></span></button></td>
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

    <!-- Modal de insertar tipo de taller nueva -->
        <div class="modal fade" id="modalinsertPrograma" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h3 class="modal-title" id="exampleModalLabel">Nuevo Tipo de taller
                        </h3>
                        <div class="col-md-10">
                            <div id="msgtipotaller"></div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Descripcion Tipo taller</label>
                            <input type="text" class="form-control  form-control-sm" name="descTipoTaller" id="descTipoTaller" aria-describedby="Descripcion Tipo Taller" autocomplete="off" autofocus require>
                        </div>
                        <div class="form-group">
                            <label for="">Estado taller</label>
                            <input type="text" class="form-control  form-control-sm" name="estadoTipoTaller" id="estadoTipoTaller" aria-describedby="Esto tipo Taller" autocomplete="off" require>
                        </div>        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" onclick="InsertTipoTaller();">Guardar</button>
                    </div>
                </div>
            </div>  
        </div>
    <!-- Fin modal de insertar Tipo de taller nuevo -->
                    
    <!-- Modal para Editar Tipo Taller-->
        <div class="modal fade" id="modaleditPrograma" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Editar Tipo Taller</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" action="" method="post">
                        <fieldset>
                            <div id="msgEditTipoTaller"></div>
                            <div class="form-group">
                                <label>Id Tipo Taller</label>
                                <input id="idTipoTallerFM" name="idTipoTallerFM" type="text" placeholder="formeditTipoTallerId" class="form-control" autocomplete="off" disabled>
                            </div>                           
                            <div class="form-group">
                                <label>descripcion Tipo Taller</label>
                                <input id="descTipoTallerFM" name="descTipoTallerFM" type="text" placeholder="formeditTipoTallerDesc" class="form-control" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <label>estado tipo Taller</label>
                                <input id="estadoTipoTallerFM" name="estadoTipoTallerFM" type="text" placeholder="formeditEstadoTipoTaller" class="form-control" autocomplete="off" required>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button class="btn btn-primary" onclick="EditarTipoTaller();">Grabar</button>
                </div>
                </div>
            </div>
        </div>
        <!-- /Modal para Editar Tipo Taller -->

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