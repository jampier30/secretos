<?php 
	 session_start();
	 if($_SESSION['autentic']){
		 require_once("../conn_BD.php");
         require_once('../programas/class/ClassProgramas.php');
		 require_once("../../modulos/funciones.php");
		 $InstanciaDB=new Conexion();
		 $insPrograma=new Proceso_Programa($InstanciaDB);
		 $LastidProgramas=$insPrograma->getlastidProgramas();
		 $ListaProgramas=$insPrograma->ListaProgramas();
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
                        Programas
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">                                            	                               
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>ID</i></th>
                                        <th>Codigo programa</th>
                                        <th>Decripcion Programa</th>
                                        <th>Estado</th>
                                        <th><span class='glyphicon glyphicon-cog' title='Config'></span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        while($row=$ListaProgramas->fetch_array()){
                                        $datos=$row[0]."||".$row[1]."||".$row[2]."||".$row[3];
                                    ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $row[0]; ?></td>
                                        <td><?php echo $row[1]; ?></td>
                                        <td><?php echo $row[2]; ?></td>
                                        <td>
                                            <?php 
                                                if ($row[3]==1) {
                                                    echo "<span class='glyphicon glyphicon-ok-sign text-success' title='Activo'></span>"; 
                                                } else {
                                                    echo "<span class='glyphicon glyphicon-minus-sign text-danger' title='Desactivado'></span>";
                                                }
                                            ?>
                                        </td>
                                        <td><button title="Edit" onclick="formeditPrograma('<?php echo $datos;?>')" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modaleditPrograma"><span class="glyphicon glyphicon-pencil"></span></button></td>
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



    <!-- Modal de insertar Programa nuevo -->
        <div class="modal fade" id="modalinsertPrograma" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h3 class="modal-title" id="exampleModalLabel">Nuevo Programa</h3>
                        <div class="col-md-10">
                            <div id="msgPrograma"></div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Codigo programa</label>
                            <input type="text" class="form-control  form-control-sm" name="codigoprograma" id="codigoprograma" aria-describedby="Codigo prograna" placeholder="Codigo programa" autocomplete="off" autofocus require>
                        </div>
                        <div class="form-group">
                            <label for="">Descripcion programa</label>
                            <input type="text" class="form-control  form-control-sm" name="descPrograma" id="descPrograma" aria-describedby="Descripcion prograna" placeholder="Descripcion programa" autocomplete="off" require>
                        </div>
                        <div class="form-group">
                            <label for="">Estado</label>
                            <select class="form-control" name="estado" id="estado" placeholder="Estado" autocomplete="off" required>						
                                <option value="1">Activo</option>
                                <option value="0">No Activo</option>													
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" onclick="InsertPrograma()" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </div>  
        </div>
    <!-- Fin modal de insertar Programa nuevo -->
                    

    <!-- Modal para Editar Programa -->
        <div class="modal fade" id="modaleditPrograma" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Editar Programa</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" action="" method="post">
                        <fieldset>
                            <div id="msgProgramaEdit"></div>
                            <div class="form-group">
                                <label>ID</label> 
                                <input id="formeditProgramaid" name="formeditProgramaCodigo" type="text" placeholder="ID" class="form-control" autocomplete="off" disabled>
                            </div>
                            <div class="form-group">
                                <label>Codigo programa</label>
                                <input id="formeditProgramaCodigo" name="formeditProgramaCodigo" type="text" placeholder="formeditProgramaCodigo" class="form-control" autocomplete="off" required>
                            </div>                           
                            <div class="form-group">
                                <label>Descripcion programa</label>
                                <input id="formeditProgramaDescripcion" name="formeditProgramaDescripcion" type="text" placeholder="formeditProgramaDescripcion" class="form-control" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <label>Estado</label>
                                <select class="form-control" id="formeditProgramaEstado" name="formeditProgramaEstado" placeholder="Estado" autocomplete="off" required>						
                                    <option value="1">Activo</option>
                                    <option value="0">No Activo</option>													
                                </select>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button class="btn btn-primary" onclick="EditPrograma()">Grabar</button>
                </div>
                </div>
            </div>
        </div>
        <!-- /Modal para Editar Programa -->

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