<?php 
	 session_start();
	 if($_SESSION['autentic']){
		 require_once("../conn_BD.php");
         require_once('class/classVeredas.php');
         require_once("../municipios/class/ClassMunicipios.php");
		 require_once("../../modulos/funciones.php");
		 $InstanciaDB=new Conexion();
         $InsVeredas=new Proceso_Vereda($InstanciaDB);
         $InsMcpio=new Proceso_Municipios($InstanciaDB);
         $ListaMcpios=$InsMcpio->ListaMunicipio();
         $ListaMcpiosEd=$InsMcpio->ListaMunicipio();
		 $ListaVeredas=$InsVeredas->listaVereda();
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
                        Veredas
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">                                            	                               
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>ID</i></th>
                                        <th>Decripcion Veredas</th>
                                        <th>Municipio</th>
                                        <th><span class='glyphicon glyphicon-cog' title='Config'></span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        while($row=$ListaVeredas->fetch_array()){
                                        $datos=$row[0]."||".$row[1]."||".$row[2];
                                    ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $row[0]; ?></td>
                                        <td><?php echo $row[1]; ?></td>
                                        <td><?php echo $row[3]; ?></td> 
                                        <td><button title="Edit" onclick="formeditVereda('<?php echo $datos;?>')" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modaleditVeredas"><span class="glyphicon glyphicon-pencil"></span></button></td>
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

    <!-- Modal de insertar Vereda nueva -->
        <div class="modal fade" id="modalinsertPrograma" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h3 class="modal-title" id="exampleModalLabel">Nueva Vereda</h3>
                        <div class="col-md-10">
                            <div id="msgVereda"></div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Descripcion de vereda</label>
                            <input type="text" class="form-control  form-control-sm" name="descVereda" id="descVereda" aria-describedby="Descrip Vereda" autocomplete="off" autofocus require>
                        </div>
                        <div class="form-group">
                            <label for=""> Municipio</label>
                            <select id = IdMcpio>
                                <option value="00"> Seleccione un Municipio</option>
                                <?php
                                while($row=$ListaMcpios->fetch_array()){
                                   echo '<option value ="'.$row[0].'">'.$row[2].'</option>';
                                }
                                ?>
                           </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" onclick="InsertVereda();">Guardar</button>
                    </div>
                </div>
            </div>  
        </div>
    <!-- Fin modal de insertar Vereda  nueva -->
                    
    <!-- Modal para Editar Vereda -->
        <div class="modal fade" id="modaleditVeredas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Editar Vereda</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" action="" method="post">
                        <fieldset>
                            <div id="msgEditVereda"></div>
                            <div class="form-group">
                                <label>Codigo Vereda</label>
                                <input id="idVeredaFM" name="idVeredaFM" type="text" placeholder="formeditVeredaCodigo" class="form-control" autocomplete="off" disabled>
                            </div>                           
                            <div class="form-group">
                                <label>Descripcion Vereda</label>
                                <input id="descVeredaFM" name="descVeredaFM" type="text" placeholder="formeditVeredaDesc" class="form-control" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                             <label for=""> Municipio</label>
                                <select id = "IdMcpioFM">
                                <option value="00"> Seleccione Municipio</option>
                                    <?php
                                    while($row=$ListaMcpiosEd->fetch_array()){
                                    echo '<option value ="'.$row[0].'">'.$row[2].'</option>';
                                    }
                                    ?>
                            </select>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button class="btn btn-primary" onclick="EditarVereda();">Grabar</button>
                </div>
                </div>
            </div>
        </div>
        <!-- /Modal para Editar Vereda -->

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