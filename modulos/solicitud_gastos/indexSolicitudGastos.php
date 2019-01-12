<?php 
	session_start();
	if($_SESSION['autentic']){
		require_once("../conn_BD.php");
		require_once("../plan_cuentas/class/ClassPlanCuentas.php");
		require_once("../tipo_gastos/class/ClassTipodeGasto.php");
        require_once("../conceptos_gastos/class/classConceptoGastos.php");
        require_once("class/ClassSolicitudGastos.php");
        require_once("../empleados/class/classEmpleados.php");
        require_once("../proyectos/class/classProyecto.php");
        require_once("../municipios/class/ClassMunicipios.php");
        require_once("../procesos/class/ClassProcesos.php");
        require_once("../entidades/class/classEntidades.php");
        require_once("../actividades/class/ClassActividades.php");
        require_once("../funciones.php");
		$InstanciaDB=new Conexion();
        $InstConceptoGastos=new Proceso_ConceptoGastos($InstanciaDB);
        $InstSolicitudGasto=new Proceso_SolicitudGastos($InstanciaDB);
        $InstEmpleados=new Proceso_Empleados($InstanciaDB);
        $InstProyecto=new Proceso_Proyecto($InstanciaDB);
        $InstMunicipio=new Proceso_Municipios($InstanciaDB);
        $InstProcesos=new Proceso_Procesos($InstanciaDB);
        $InstEntidades=new Proceso_Entidades($InstanciaDB);
        $InstActividades=new Proceso_Actividad($InstanciaDB);
        $listaConceptoGasto=$InstConceptoGastos->ListarConceptoGastos();
        $listaEmpleados=$InstEmpleados->ListarEmpleados();
        $listaProyecto=$InstProyecto->ListarProyecto();
        $listaMunicipios=$InstMunicipio->ListaMunicipio();
        $listaProcesos=$InstProcesos->ListaProcesos();
        $listaEntidades=$InstEntidades->ListarEntidades();
        $listaActividades=$InstActividades->ListaActividad();
        $NextSolicitud=$InstSolicitudGasto->ObtenerultimaSolicitudGasto();
        $ListaSGxLegalizar=$InstSolicitudGasto->ListarSolicitudGastosxEstado(0);
        $ListaSGxRelacionar=$InstSolicitudGasto->ListarSolicitudGastosxEstado(1);
        $ListaRelacionSGconsaldo=$InstSolicitudGasto->RelacionSGSaldo();
        
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
                <button type="button" class="btn btn-success btn-circle" data-toggle="modal" data-target="#NuevaSolicitudGasto">
                    <i class="fa fa-plus fa-2x"></i>
                </button>
            </div>		
            <div class="panel panel-primary">
                <div class="panel-heading" style="height:55px;">
                    Solicitudes de Gastos <b>pendientes por Legalizar</b>
                    <div style="float:right;"><button type="button" class="btn btn-primary"><span class="badge"><?php echo $ListaSGxLegalizar->num_rows;?></span></button></div>
                    
                </div>
                <div class="panel-body">

                    <div class="table-responsive">                                            	                               
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <th>#</th>
                                <th>Fecha Solicitud</th>
                                <th>Municipio</th>
                                <th>Valor Total</th>
                                <th><span class='glyphicon glyphicon-cog' title='Config'></span></th>
                            </thead>
                            <tbody>
                                <?php
                                    
                                    while($row=$ListaSGxLegalizar->fetch_array()){
                                        $datos=$row[0]."||".$row[1]."||".$row[2]."||".$row[3]."||".$row[4]."||".$row[5]."||".$row[6]."||".$row[7]."||".$row[8]."||".$row[9]."||".$row[10]."||".$row[11]."||".$row[12];
                                        
                                        $ListaResponsables=$InstSolicitudGasto->ListaResponsablesxIDsolicitud($row[0]);
                                        $datosResponsables='';
                                        while ($rowR=$ListaResponsables->fetch_array()) {
                                            $datosResponsables=$datosResponsables."||".$rowR[2];
                                        }
                                ?>
                                <tr class="odd gradeX">
                                    <td><?php echo $row[0]; ?></td>
                                    <td><?php echo $row[1]; ?></td>
                                    <td><?php echo $row[13]; ?></td>
                                    <td><?php echo '$'.number_format($row[12]); ?></td>
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
            <br>
            <hr>
            <br>

            <div class="panel panel-primary">
                <div class="panel-heading" style="height:55px;">
                    Solicitudes de Gastos <b>X Relacionar</b>
                    <div style="float:right;"><button type="button" class="btn btn-primary"><span class="badge"><?php echo $ListaSGxRelacionar->num_rows;?></span></button></div>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">                                            	                               
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <th>#</th>
                                <th>Fecha Solicitud</th>
                                <th>Municipio</th>
                                <th>Valor Total</th>
                                <th><span class='glyphicon glyphicon-cog' title='Config'></span></th>
                            </thead>
                            <tbody>
                                <?php
                                    
                                    while($row=$ListaSGxRelacionar->fetch_array()){
                                    $datos=$row[0]."||".$row[1]."||".$row[2]."||".$row[3]."||".$row[4]."||".$row[5]."||".$row[6]."||".$row[7]."||".$row[8]."||".$row[9]."||".$row[10]."||".$row[11]."||".$row[12];

                                        $ListaResponsables=$InstSolicitudGasto->ListaResponsablesxIDsolicitud($row[0]);
                                        $datosResponsables='';
                                        while ($rowR=$ListaResponsables->fetch_array()) {
                                            $datosResponsables=$datosResponsables."||".$rowR[2];
                                        }
                                ?>
                                <tr class="odd gradeX">
                                    <td><?php echo $row[0]; ?></td>
                                    <td><?php echo $row[1]; ?></td>
                                    <td><?php echo $row[13]; ?></td>
                                    <td><?php echo '$'.number_format($row[12]); ?></td>
                                    <td>
                                    <button title="Ver" onclick="VerSolicitudGasto('<?php echo $datos;?>','<?php echo $datosResponsables;?>')" class="btn btn-default btn-sm" data-toggle="modal" data-target="#VerSolicitudGasto"><span class="glyphicon glyphicon-info-sign" style="color:blue;"></span></button>
                                        <button title="Editar" onclick="SolicitudGasto('<?php echo $datos;?>')" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modaleditMcpio"><span class="glyphicon glyphicon-pencil"></span></button>
                                        <button title="Relacionar Gastos" onclick="RelacionarSolicitudGasto('<?php echo $datos;?>')" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modaleditMcpio"><span class="glyphicon glyphicon-arrow-right" style="color:rgb(255, 128, 0);"></span> <span class="glyphicon glyphicon-new-window" style="color:rgb(255, 128, 0);"></span></button>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <br><br><br>

            <div class="panel panel-primary">
                <div class="panel-heading" style="height:55px;">
                    Relacion de Gastos <b>con Saldo Pendiente</b>
                    <div style="float:right;"><button type="button" class="btn btn-primary"><span class="badge"><?php echo $ListaRelacionSGconsaldo->num_rows;?></span></button></div>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">                                            	                               
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <th>#</th>
                                <th>Fecha Solicitud</th>
                                <th>Municipio</th>
                                <th>Valor Solicitud</th>
                                <th>Valor Relacionado</th>
                                <th>Valro Legalizado</th>
                                <th>Saldo L-R</th>
                                <th><span class='glyphicon glyphicon-cog' title='Config'></span></th>
                            </thead>
                            <tbody>
                                <?php
                                    
                                    while($row=$ListaRelacionSGconsaldo->fetch_array()){
                                    $datos=$row[0]."||".$row[1]."||".$row[2]."||".$row[3]."||".$row[4]."||".$row[5]."||".$row[6]."||".$row[7]."||".$row[8]."||".$row[9]."||".$row[10]."||".$row[11]."||".$row[12];

                                        $ListaResponsables=$InstSolicitudGasto->ListaResponsablesxIDsolicitud($row[0]);
                                        $datosResponsables='';
                                        while ($rowR=$ListaResponsables->fetch_array()) {
                                            $datosResponsables=$datosResponsables."||".$rowR[2];
                                        }
                                ?>
                                <tr class="odd gradeX">
                                    <td><?php echo $row[0]; ?></td>
                                    <td><?php echo $row[1]; ?></td>
                                    <td><?php echo $row[13]; ?></td>
                                    <td><?php echo '$'.number_format($row[13]); ?></td>
                                    <td><?php echo '$'.number_format($row[14]); ?></td>
                                    <td><?php 
                                        $saldo=($row[14]-$row[13]);
                                        if ($saldo < 0) {
                                            $color='red';
                                        } else {
                                            $color='black';
                                        }
                                        echo '<p style="color:'.$color.'">$'.number_format($saldo).'</p>';
                                         
                                    ?></td>
                                    <td>
                                    <button title="Ver" onclick="VerSolicitudGasto('<?php echo $datos;?>','<?php echo $datosResponsables;?>')" class="btn btn-default btn-sm" data-toggle="modal" data-target="#VerSolicitudGasto"><span class="glyphicon glyphicon-info-sign" style="color:blue;"></span></button>
                                        <button title="Editar" onclick="SolicitudGasto('<?php echo $datos;?>')" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modaleditMcpio"><span class="glyphicon glyphicon-pencil"></span></button>
                                        <button title="Completar Relacion" onclick="Editar('<?php echo $datos;?>')" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modaleditMcpio"><span class="glyphicon glyphicon-arrow-right" style="color:rgb(255, 128, 0);"></span> <span class="glyphicon glyphicon-new-window" style="color:rgb(255, 128, 0);"></span></button>
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
</div>
    
    

    <!-- Inicio Modal Nueva Solicitud de gastos --> 

        <div class="modal fade" id="NuevaSolicitudGasto" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>															
                            <h3 align="center" class="modal-title" id="myModalLabel">Nueva Solicitud de Gastos</h3>
                            <div id="msgSolicitudGasto"></div>
                        </div>
                        <div id="msgInstitucionNuevo"></div>
                        <div class="panel-body">
                            <div class="row col-sm-5">                                   
                                <div class="form-group">
                                    <select class="js-example-basic-single" name="CodMunicipioSG" id="CodMunicipioSG" style="width:250px">
                                    <option value="00"> -- Seleccione un Municipio -- </option>
                                        <?php
                                            mysqli_data_seek($listaMunicipios,0);																		
                                            while ($rowMun=$listaMunicipios->fetch_array(MYSQLI_BOTH)) { 
                                                echo "<option value='".$rowMun[0]."'>".$rowMun[2]."</option>";
                                                }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" name="CodEntidadSG" id="CodEntidadSG" style="width:250px">
                                        <option value="00"> -- Seleccione una Entidad -- </option>
                                        <?php
                                            mysqli_data_seek($listaEntidades, 0);																		
                                            while ($rowEnt=$listaEntidades->fetch_array(MYSQLI_BOTH)) { 
                                                echo "<option value='".$rowEnt[0]."'>".$rowEnt[2]."</option>";
                                                }
                                        ?>
                                    </select>
                                </div> 
                                <div class="form-group">
                                    <select class="form-control" name="CodProyectoSG" id="CodProyectoSG" style="width:250px">
                                        <option value="00"> -- Seleccione un Proyecto -- </option>
                                        <?php
                                            mysqli_data_seek($listaProyecto, 0);																		
                                            while ($rowProy=$listaProyecto->fetch_array(MYSQLI_BOTH)) { 
                                                echo "<option value='".$rowProy[0]."'>".$rowProy[1]."</option>";
                                                }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" name="CodProcesoSG" id="CodProcesoSG" style="width:250px">
                                        <option value="00"> -- Seleccione un Proceso -- </option>
                                        <?php
                                            mysqli_data_seek($listaProcesos, 0);																			
                                            while ($rowProc=$listaProcesos->fetch_array(MYSQLI_BOTH)) { 
                                                echo "<option value='".$rowProc[0]."'>".$rowProc[1]."</option>";
                                                }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="form-control js-example-basic-single" name="CodActividadSG" id="CodActividadSG" style="width:250px">
                                        <option value="00"> -- Seleccione una Actividad --</option>
                                        <?php
                                            mysqli_data_seek($listaActividades, 0);																			
                                            while ($rowAct=$listaActividades->fetch_array(MYSQLI_BOTH)) { 
                                                echo "<option value='".$rowAct[0]."'>".$rowAct[1]."</option>";
                                                }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row col-sm-2"></div>
                            <div class="row col-sm-5">
                                    <div class="form-group">
                                        <div class="input-append date form_datetime" data-date="<?php echo $fechadatetimepicker;?>">
                                            <input id="FechaHoraSalidaSG" size="16" type="text"  class="form-control" autocomplete="off" readonly style="width:230px" placeholder="Fecha y Hora de salida"> 
                                            <span class="add-on"><i class='fas fa-calendar-alt'></i></span>
                                            <span class="add-on"><i class="icon-th"></i></span>
                                        
                                        </div>
                                    </div>
                                <div class="form-group">
                                    <div class="input-append date form_datetime" data-date="<?php echo $fechadatetimepicker;?>">
                                        <input id="FechaHoraRegresoSG" size="16" type="text"  class="form-control" autocomplete="off" readonly style="width:230px" placeholder="Fecha y Hora de regreso">
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
                                <div class="form-group" style="width:230px">
                                    <input name="CantColeccionSG" id="CantColeccionSG"  type="text"  class="form-control" autocomplete="off" placeholder="Cantidad Coleccion">
                                </div>
                                <div class="form-group" style="width:230px">
                                    <input name="TipoColeccionSG" id="TipoColeccionSG"  type="text"  class="form-control" autocomplete="off" placeholder="Tipo Coleccion">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div id="msgDetalleSolicitudGastoLista"></div>          
                                </div>
                            </div>
                        </div> 
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            <button type="button" onclick="guardarSolicitudGasto();" class="btn btn-primary">Guardar</button>
                        </div>										 
                    </div>
                </div>
        </div>
    <!-- Final Modal Nuevo Solicitud de gastos --> 




<!-- Inicio modal visualizacion Solicitud Gasto -->


            <div class="modal fade" id="VerSolicitudGasto" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div style="display:none;">
                            <select class="form-control" name="VerCodEntidadSG" id="VerCodEntidadSG">
                                <?php
                                    mysqli_data_seek($listaEntidades, 0);																		
                                    while ($rowEnt=$listaEntidades->fetch_array(MYSQLI_BOTH)) { 
                                        echo "<option value='".$rowEnt[0]."'>".$rowEnt[2]."</option>";
                                        }
                                ?>
                            </select>

                            <select class="form-control"  name="VerCodMunicipioSG" id="VerCodMunicipioSG">
                                <?php
                                    mysqli_data_seek($listaMunicipios,0);																		
                                    while ($rowMun=$listaMunicipios->fetch_array(MYSQLI_BOTH)) { 
                                        echo "<option value='".$rowMun[0]."'>".$rowMun[2]."</option>";
                                        }
                                ?>
                            </select>

                            <select class="form-control" name="VerCodProyectoSG" id="VerCodProyectoSG">
                                <?php
                                    mysqli_data_seek($listaProyecto, 0);																		
                                    while ($rowProy=$listaProyecto->fetch_array(MYSQLI_BOTH)) { 
                                        echo "<option value='".$rowProy[0]."'>".$rowProy[1]."</option>";
                                        }
                                ?>
                            </select>

                            <select class="form-control" name="VerCodProcesoSG" id="VerCodProcesoSG">
                                <?php
                                    mysqli_data_seek($listaProcesos, 0);																			
                                    while ($rowProc=$listaProcesos->fetch_array(MYSQLI_BOTH)) { 
                                        echo "<option value='".$rowProc[0]."'>".$rowProc[1]."</option>";
                                        }
                                ?>
                            </select> 

                            <select class="form-control" name="VerCodActividadSG" id="VerCodActividadSG">
                                <?php
                                    mysqli_data_seek($listaActividades, 0);																			
                                    while ($rowAct=$listaActividades->fetch_array(MYSQLI_BOTH)) { 
                                        echo "<option value='".$rowAct[0]."'>".$rowAct[1]."</option>";
                                        }
                                ?>
                            </select>
                            <select class="js-example-basic-multiple" name="VerresponsableSG" id="VerresponsableSG" multiple="multiple" style="width:230px">
                                <?php
                                    mysqli_data_seek($listaEmpleados, 0);
                                    while ($rowEM=$listaEmpleados->fetch_array(MYSQLI_BOTH)) { 
                                        echo "<option value='".$rowEM[0]."'>".$rowEM[2]."</option>";
                                    }
                                ?>
                            </select>
                        </div>           
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>															
                            <h3 class="modal-title" id="myModalLabel">Solicitud de Gastos - # <label id="VerIdSolicitudGastoSG"></Label></h3>
                            Fecha Elaboracion  <label align="right" id="VerFechaSolicitudGastoSG"></label>
                            <div id="msgEstado"></div>
                        </div>
                        
                        <div class="panel-body center-block">
                                    <!-- Row start -->
                                    <div >
                                        <div class="table-responsive">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading clearfix">
                                                        <h3 class="panel-title">Datos Documento</h3>
                                                    </div>
                                                    <div class="panel-body">
                                                        <div class="row col-md-6 col-sm-6">
                                                            <table class="table table-hover">
                                                                <tbody>
                                                                    <tr class="table-light">
                                                                        <th scope="row">Municipio</th>
                                                                        <td><div name="VerCodMunicipioSGdiv" id="VerCodMunicipioSGdiv"></div></td>
                                                                    </tr>                                 
                                                                    <tr class="table-light">
                                                                        <th scope="row">Entidades</th>
                                                                        <td><div name="VerCodEntidadSGdiv" id="VerCodEntidadSGdiv"></div></td>
                                                                    </tr>
                                                                    <tr class="table-light">
                                                                        <th scope="row">Proyecto</th>
                                                                        <td><div name="VerCodProyectoSGdiv" id="VerCodProyectoSGdiv"></div></td>
                                                                    </tr>
                                                                    <tr class="table-light">
                                                                        <th scope="row">Proceso</th>
                                                                        <td><div name="VerCodProcesoSGdiv" id="VerCodProcesoSGdiv"></div></td>
                                                                    </tr>
                                                                    <tr class="table-light">
                                                                        <th scope="row">Actividad</th>
                                                                        <td><div name="VerCodActividadSGdiv" id="VerCodActividadSGdiv"></div></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="row col-md-6 col-sm-6">
                                                            <table class="table table-hover">
                                                                <tbody>
                                                                    <tr class="table-light">
                                                                        <th scope="row">Fecha/Hora Salida</th>
                                                                        <td><div name="VerFechaHoraSalidaSGdiv" id="VerFechaHoraSalidaSGdiv"></div></td>
                                                                    </tr>
                                                                    <tr class="table-light">
                                                                        <th scope="row">Fecha/Hora Regreso</th>
                                                                        <td><div name="VerFechaHoraRegresoSGdiv" id="VerFechaHoraRegresoSGdiv"></div></td>
                                                                    </tr>
                                                                    <tr class="table-light">
                                                                        <th scope="row">Cant Colección</th>
                                                                        <td><div name="VerCantColeccionSGdiv" id="VerCantColeccionSGdiv"></div></td>
                                                                    </tr>
                                                                    <tr class="table-light">
                                                                        <th scope="row">Tipo Colección</th>
                                                                        <td><div name="VerTipoColeccionSGdiv" id="VerTipoColeccionSGdiv"></div></td>
                                                                    </tr>    
                                                                </tbody>
                                                            </table> 
                                                        </div>
                                                                       
                                                        <div class="row col-md-12 col-sm-12">
                                                        <hr />
                                                                <label>Responsables</label>
                                                                <label>
                                                                    <select class="js-example-basic-multiple" name="VerresponsableSGdiv" id="VerresponsableSGdiv" multiple="multiple">
                                                                        <?php
                                                                            mysqli_data_seek($listaEmpleados, 0);
                                                                            while ($rowEM=$listaEmpleados->fetch_array(MYSQLI_BOTH)) { 
                                                                                echo "<option value='".$rowEM[0]."'>".$rowEM[2]."</option>";
                                                                            }
                                                                        ?>
                                                                    </select>
                                                                </label>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Row end -->
                            

                            <hr>                            
                            <div class="row">
                                <div class="col-sm-12">
                                    <div id="ListaDetalleSG"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                   <div id="VerLegalizacionSG"></div>                                          
                                </div>
                            </div>
                            
                            
                        </div> 
                        <div class="modal-footer">
                            <div style="width:70%; float:left;" id="msgBotonAccionSG" class="btn-group" role="group"></div>
                            <div style="width:30%; float:right;" class="btn-group" role="group">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            </div>
                            
                            
                        </div>										 
                    </div>
                </div>
            </div>

<!-- fin modal visualizacion Solicitud Gasto -->



    <!-- Inicio Modal de legalizacion de Gastos -->
        <?php 
            require_once('../legalizacionSolicGasto/modalnuevalegalizacion.php');
        ?>

    <!-- Fin Modal de leglizacion de Gastos -->

    <script src="../../assets/js/jquery-1.10.2.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>
    <script src="../../assets/js/jquery.metisMenu.js"></script>
    <script src="../../assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="../../assets/js/dataTables/dataTables.bootstrap.js"></script>
    <script src="../../assets/js/jasny-bootstrap.min.js"></script>
     
    <style>
        table {
   width: 70%;
   margin: 0 auto;"
}
    </style>
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    
    <script>
       $(document).ready(function() {               
                $('.js-example-basic-multiple').select2({
                    placeholder:"Responsables",
                    allowClear: true,
                });

                $('.js-example-basic-single').select2({
                    dropdownParent: $("#NuevaSolicitudGasto"),
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
  
    function ShowVerLegalizacionSolicitudGasto() {
        $("#VerLegalizacionSG").show();
    }

    function HideVerLegalizacionSolicitudGasto(){
        $("#VerLegalizacionSG").hide();
    }

    function mostrarDetalleSG() {
        var IdSG=$('#VerIdSolicitudGastoSG').text();
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
    var ConceptoGastoSG=$('#ConceptoGastoSG').val();
    var NumDiasSG=$('#NumDiasSG').val();
    var ValorConceptoSG=$('#ValorConceptoSG').val();
    var parametros =  {ConceptoGastoSG,NumDiasSG,ValorConceptoSG};
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
