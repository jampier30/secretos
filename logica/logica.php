<?php 
    session_start();
    require_once("../modulos/conn_BD.php");
    
  
    // require_once("../modulos/tipo_gastos/class/ClassTipodeGasto.php");
    // require_once("../modulos/plan_cuentas/class/ClassPlanCuentas.php");
    require_once("../modulos/conceptos_gastos/class/classConceptoGastos.php");
    require_once("../modulos/empleados/class/classEmpleados.php");
    require_once("../modulos/solicitud_gastos/class/ClassSolicitudGastos.php");
    require_once("../modulos/actividades/class/ClassActividades.php");
    require_once("../modulos/departamentos/class/ClassDepartamentos.php");
    require_once("../modulos/tipo_materiales/class/ClassTipoMaterial.php");
    require_once("../modulos/tipo_novedades/class/classTipoNovedadesPlan.php");
    require_once("../modulos/centro_costos/class/classCentrosCostosP.php");
    require_once("../modulos/centro_costos/class/classCentroCostosH.php");
    require_once("../modulos/entidades/class/classEntidades.php");
    require_once('../modulos/proyectos/class/classProyecto.php');
    require_once('../modulos/dotaciones/class/classDotaciones.php');
    require_once('../modulos/fuentes/class/classFuentes.php');
    require_once('../modulos//clasificacionc/class/classClasificacionC.php');
    require_once('../modulos/contacto/class/classContacto.php');
    require_once('../modulos/institucion/class/classInstitucion.php');
    require_once("../modulos/tipo_municipios/class/ClassTipoMunicipios.php");
    require_once("../modulos/regiones/class/ClassRegiones.php");
    require_once("../modulos/tipo_instituciones/class/ClassTipoInstitucion.php");
    require_once("../modulos/tipo_encuestas/class/ClassTipoEncuestasInf.php");
    require_once("../modulos/procesos/class/ClassProcesos.php");
    require_once("../modulos/tipo_talleres/class/ClassTipoTalleres.php");
    require_once("../modulos/colecciones/class/ClassColecciones.php");
    require_once("../modulos/tipo_tarifas/class/ClassTipoTarifa.php");
    require_once("../modulos/veredas/class/classVeredas.php");
    require_once("../modulos/municipios/class/ClassMunicipios.php");
    require_once("../modulos/tipo_novedades/class/classTipoNovedadesMaterial.php");
    
    require_once("../modulos/funciones.php");

    if ($_POST) {
        $accion=$_GET['accion'];
        $InstanciaDB=new Conexion();
        // $InstUsuario=new Proceso_Usuario($InstanciaDB);
      
       
        // $InstPlanCuentas=new Proceso_PlanCuentas($InstanciaDB);
        $InstConceptoGasto=new Proceso_ConceptoGastos($InstanciaDB);
        $InstEmpleados=new Proceso_Empleados($InstanciaDB);
        $InstSolicitudGasto= new Proceso_SolicitudGastos($InstanciaDB);
        $InstActividades=new Proceso_Actividad($InstanciaDB);
        $InstDpto=new Proceso_Departamento($InstanciaDB);
        $InstTipoMaterial=new Proceso_TipoMaterial($InstanciaDB);
        $InstTipoNovedadesPlan=new Proceso_TipoNovedadesPla($InstanciaDB);
        $InstCentroCostosP=new Proceso_CentroCostosP($InstanciaDB);
        $InstCentroCostosH=new Proceso_CentroCostosH($InstanciaDB);
        $InstEntidad=new Proceso_Entidades($InstanciaDB);
        $InstProyecto=new Proceso_Proyecto($InstanciaDB);
        $InstDotaciones=new Proceso_Dotaciones($InstanciaDB);
        $InstFuentes=new Proceso_Fuentes($InstanciaDB);
        $InstClasificacionC=new Proceso_ClasificacionC($InstanciaDB);
        $InstContacto=new Proceso_Contacto($InstanciaDB);
        $InstInstitucion=new Proceso_Institucion($InstanciaDB);
        $InstTipoMcpio=new Proceso_TipoMunicipio($InstanciaDB);
        $InstRegion=new Proceso_Region($InstanciaDB);
        $InstTipoInstitu=new Proceso_TipoInstitucion($InstanciaDB);
        $InstTipoEncInf=new Proceso_TipoEncInfr($InstanciaDB);
        $InstProc=new Proceso_Procesos($InstanciaDB);
        $InstTipoTall=new Proceso_TipoTaller($InstanciaDB);
        $InstColeccion=new Proceso_Coleccion($InstanciaDB);
        $InstTipoTarifa=new Proceso_TipoTarifa($InstanciaDB);
        $InstVereda= new Proceso_Vereda($InstanciaDB);
        $InstMcpio= new Proceso_Municipios($InstanciaDB);
        $InstTipoNovedadesMater=new Proceso_TipoNovedadesMaterial($InstanciaDB);

        switch ($accion) {
            case 'login':
            require_once("../modulos/usuarios/class/ClassUsuario.php");
            $InstUsuario=new Proceso_Usuario($InstanciaDB);
                    $EmailForm=limpiar($_POST['email']);
                    $ClaveForm=limpiar($_POST['pass']);
                    $LoginUser=$InstUsuario->BuscarLogin($EmailForm);
                    
                    if ($LoginUser->num_rows > 0) {
                        $row=$LoginUser->fetch_array(MYSQLI_BOTH);
                        if (password_verify($ClaveForm,$row[3])) {
                            $_SESSION['autentic']=1;
                            $_SESSION['id']=$row[0];
                            $_SESSION['nombre']=$row[1];
                            $_SESSION['email']=$row[2];
                            $_SESSION['estado']=$row[4];
                            
                            echo 1;
                        } else {
                            echo 0;
                        }
                    } else {
                       echo 0;
                    }
            break;
            case 'InsertPrograma':
            require_once("../modulos/programas/class/ClassProgramas.php");
            $InstPrograma=new Proceso_Programa($InstanciaDB);
                $descPrograma=primera_mayuscula(limpiar($_POST['descPrograma']));
                $estado=limpiar($_POST['estado']);
                $codigoPrograma=texto_mayusculas(limpiar($_POST['codigoPrograma']));
                $existe=$InstPrograma->BuscarCodigoPrograma($codigoPrograma);
                if ($existe->num_rows>0) {
                    // Si result es 3, significa que la descripcion del Programa ya existe
                    echo 3;
                } else {
                    $InsertadoPrograma=$InstPrograma->InsertPrograma($descPrograma,$estado,$codigoPrograma);
                    if ($InsertadoPrograma>0 ) {
                        echo 1;
                    } else {
                        echo 0;
                    } 
                }
            break;
            case 'EditPrograma':
            require_once("../modulos/programas/class/ClassProgramas.php");
            $InstPrograma=new Proceso_Programa($InstanciaDB);
                $IdPrograma=limpiar($_POST['IdPrograma']);
                $CodigoProgramaEditarFM=texto_mayusculas(limpiar($_POST['CodigoProgramaEdit']));
                $DescProgramaEditarFM=primera_mayuscula(limpiar($_POST['DescProgramaEdit']));
                $EstadoProgramaEditarFM=limpiar($_POST['EstadoProgramaEdit']);
                $DatosProgramaDB=$InstPrograma->BuscarPrograma($IdPrograma);
                $rowDB=$DatosProgramaDB->fetch_array(MYSQLI_BOTH);
                $diferenciaCodigo=strcmp($CodigoProgramaEditarFM,$rowDB[1]);
                $diferenciaDescripcion=strcmp($DescProgramaEditarFM,$rowDB[2]);
                $diferenciaEstado=strcmp($EstadoProgramaEditarFM,$rowDB[3]);
                $cambio=true;
                if ($diferenciaCodigo==0 && $diferenciaDescripcion==0  && $diferenciaEstado==0 ) {
                    echo 0;
                    $cambio=false;
                } else {
                   switch (true) {
                        case ($diferenciaCodigo != 0):
                            $codigoencontrado=$InstPrograma->BuscarCodigoPrograma($CodigoProgramaEditarFM);
                            if ($codigoencontrado->num_rows>0) {
                                $cambio=false;
                            } else {
                                $cambio=true;
                            }
                        break;
                        case ($diferenciaEstado != 0 ):
                            $cambio=true;
                        break;
                        default:
                            break;
                   }
                   if ($cambio) {
                       $actualizarprograma=$InstPrograma->EditarPrograma($IdPrograma,$CodigoProgramaEditarFM,$DescProgramaEditarFM,$EstadoProgramaEditarFM);
                       echo 1;
                   }else{
                       echo 3;
                   }
                }
            break;
            case 'InsertUsuario':
            require_once("../modulos/usuarios/class/ClassUsuario.php");
            $InstUsuario=new Proceso_Usuario($InstanciaDB);
                $NombreUsuario=primera_mayuscula(limpiar($_POST['NombreUsuario']));
                $EmailUsuario=limpiar($_POST['EmailUsuario']);
                $EstadoUsuario=limpiar($_POST['EstadoUsuario']);
                $ClaveUsuario=password_hash(limpiar($_POST['ClaveUsuario']), PASSWORD_DEFAULT);
                $buscaemail=$InstUsuario->BuscarEmailUsuario($EmailUsuario);
                if ($buscaemail->num_rows>0) {
                    // Si result es 3, significa que el email del usuario ya existe.
                    echo 3;
                } else {
                    $InsertadoUsuario=$InstUsuario->InsertarUsuario($EmailUsuario,$ClaveUsuario,$EstadoUsuario,$NombreUsuario);
                    if ($InsertadoUsuario>0 ) {
                        echo 1;
                    } else {
                        echo 0;
                    }
                }
                break;
            case 'EditUsuario':
            require_once("../modulos/usuarios/class/ClassUsuario.php");
            $InstUsuario=new Proceso_Usuario($InstanciaDB);
                $IdUsuarioFM=limpiar($_POST['IdUsuarioFM']);
                $EmailUsuarioFM=limpiar($_POST['EmailUsuarioFM']);
                $NombreUsuarioEditFM=primera_mayuscula(limpiar($_POST['NombreUsuarioFM']));
                $EstadoUsuarioFM=limpiar($_POST['EstadoUsuarioFM']);
                $DatosUsuarioDB=$InstUsuario->BuscarEmailUsuario($EmailUsuarioFM);
                $EditarUsuario=$InstUsuario->EditarUsuario($IdUsuarioFM,$NombreUsuarioEditFM,$EstadoUsuarioFM);
                if ($EditarUsuario>0) {
                    echo 1;
                } else {
                    echo 0;
                }
            break;

            case 'InsertTipoGasto':
            require_once("../modulos/tipo_gastos/class/ClassTipodeGasto.php");
            $InstTipoGasto=new Proceso_TipoGastos($InstanciaDB);
                $CodTipoGasto=texto_mayusculas(limpiar($_POST['CodTipoGasto']));
                $DescTipoGasto=primera_mayuscula(limpiar($_POST['DescTipoGasto']));
                $EstadoTipoGasto=limpiar($_POST['EstadoTipoGasto']);
                $buscaTipoGasto=$InstTipoGasto->buscartipogasto($CodTipoGasto);
                if ($buscaTipoGasto->num_rows>0) {
                    // Si result es 3, significa que el email del usuario ya existe.
                    echo 3;
                } else {
                    $InsertadoTipoGasto=$InstTipoGasto->creartipogasto($CodTipoGasto,$DescTipoGasto,$EstadoTipoGasto);
                    if ($InsertadoTipoGasto>0 ) {
                        echo 1;
                    } else {
                        echo 0;
                    }
                }
            break;
            case 'EditTipoGasto':
            require_once("../modulos/tipo_gastos/class/ClassTipodeGasto.php");
            $InstTipoGasto=new Proceso_TipoGastos($InstanciaDB);
                $IdTipoGastoFM=limpiar($_POST['IdTipoGastoFM']);
                $CodigoTipoGastoFM=texto_mayusculas(limpiar($_POST['CodigoTipoGastoFM']));
                $descTipoGastoFM=primera_mayuscula(limpiar($_POST['descTipoGastoFM']));
                $EstadoTipoGastoFM=limpiar($_POST['EstadoTipoGastoFM']);
                $DatosProgramaDB=$InstTipoGasto->buscartipogasto($IdTipoGastoFM);
                $rowDB=$DatosProgramaDB->fetch_array(MYSQLI_BOTH);
                $diferenciaCodigo=strcmp($CodigoTipoGastoFM,$rowDB[1]);
                $diferenciaDescripcion=strcmp($descTipoGastoFM,$rowDB[2]);
                $diferenciaEstado=strcmp($EstadoTipoGastoFM,$rowDB[3]);
                $cambio=true;
                if ($diferenciaCodigo==0 || $diferenciaDescripcion==0  || $diferenciaEstado==0 ) {
                    echo 0;
                    $cambio=false;
                } else {
                    switch (true) {
                        case ($diferenciaCodigo != 0):
                            $codigoencontrado=$InstTipoGasto->buscartipogasto($CodigoTipoGastoFM);
                            if ($codigoencontrado->num_rows>0) {
                                $cambio=false;
                            } else {
                                $cambio=true;
                            }
                        break;
                        case ($diferenciaEstado != 0 ):
                            $cambio=true;
                        break;
                        default:
                            break;
                    }
                    if ($cambio) {
                        $actualizarprograma=$InstTipoGasto->actualizartipodegasto($IdTipoGastoFM,$CodigoTipoGastoFM,$descTipoGastoFM,$EstadoTipoGastoFM);
                        echo 1;
                    }else{
                        echo 3;
                    }
                }
            break;
            case 'InsertPlanCuentas':
            require_once("../modulos/plan_cuentas/class/ClassPlanCuentas.php");
            $InstPlanCuentas=new Proceso_PlanCuentas($InstanciaDB);
                $CodPlanCuentas=texto_mayusculas(limpiar($_POST['CodPlanCuentas']));
                $DescPlanCuentas=primera_mayuscula(limpiar($_POST['DescPlanCuentas']));
                $EstadoPlanCuentas=limpiar($_POST['EstadoPlanCuentas']);
                $buscaPlanCuentas=$InstPlanCuentas->BuscarPlanCuentasxcodigo($CodPlanCuentas);
                if ($buscaPlanCuentas->num_rows>0) {
                    // Si result es 3, significa que el email del usuario ya existe.
                    echo 3;
                } else {
                    $InsertadoPlanCuentas=$InstPlanCuentas->InsertarPlanCuentas($CodPlanCuentas,$DescPlanCuentas,$EstadoPlanCuentas);
                    if ($InsertadoPlanCuentas>0 ) {
                        echo 1;
                    } else {
                        echo 0;
                    }
                }
            break;
            case 'EditPlanCuentas':
            require_once("../modulos/plan_cuentas/class/ClassPlanCuentas.php");
            $InstPlanCuentas=new Proceso_PlanCuentas($InstanciaDB);
                $IdPlanCuentasFM=limpiar($_POST['IdPlanCuentasFM']);
                $CodigoPlanCuentasFM=texto_mayusculas(limpiar($_POST['CodigoPlanCuentasFM']));
                $descPlanCuentasFM=primera_mayuscula(limpiar($_POST['descPlanCuentasFM']));
                $EstadoPlanCuentasFM=limpiar($_POST['EstadoPlanCuentasFM']);
                $DatosProgramaDB=$InstPlanCuentas->BuscarPlanCuentasxid($IdPlanCuentasFM);
                $rowDB=$DatosProgramaDB->fetch_array(MYSQLI_BOTH);
                $diferenciaCodigo=strcmp($CodigoPlanCuentasFM,$rowDB[1]);
                $diferenciaDescripcion=strcmp($descPlanCuentasFM,$rowDB[2]);
                $diferenciaEstado=strcmp($EstadoPlanCuentasFM,$rowDB[3]);
                $cambio=true;
                if ($diferenciaCodigo==0 || $diferenciaDescripcion==0  || $diferenciaEstado==0 ) {
                    echo 0;
                    $cambio=false;
                } else {
                    switch (true) {
                        case ($diferenciaCodigo != 0):
                            $codigoencontrado=$InstPlanCuentas->BuscarPlanCuentasxcodigo($CodigoPlanCuentasFM);
                            if ($codigoencontrado->num_rows>0) {
                                $cambio=false;
                            } else {
                                $cambio=true;
                            }
                        break;
                        case ($diferenciaEstado != 0 ):
                            $cambio=true;
                        break;
                        default:
                            break;
                    }
                    if ($cambio) {
                        $actualizarprograma=$InstPlanCuentas->EditarPlanCuentas($IdPlanCuentasFM,$CodigoPlanCuentasFM,$descPlanCuentasFM,$EstadoPlanCuentasFM);
                        echo 1;
                    }else{
                        echo 3;
                    }
                }
            break;
            case 'InsertConceptoGasto':
                $CodigoConceptoGasto=texto_mayusculas(limpiar($_POST['CodigoConceptoGasto']));
                $DesConceptoGasto=primera_mayuscula(limpiar($_POST['DesConceptoGasto']));
                $TarifaSNConceptoGasto=limpiar($_POST['TarifaSNConceptoGasto']);
                $TipoGastoConceptoGasto=limpiar($_POST['TipoGastoConceptoGasto']);
                $PlanCuentasConceptoGasto=limpiar($_POST['PlanCuentasConceptoGasto']);
                $EstadoConceptoGasto=limpiar($_POST['EstadoConceptoGasto']);
               
                if ($TarifaSNConceptoGasto) {
                    $TarifaSNConceptoGasto=1;
                } else {
                    $TarifaSNConceptoGasto=0;
                }
                
                $buscaCodigoConceptoGasto=$InstConceptoGasto->BuscarConceptoGastoxcod($CodigoConceptoGasto);
                if ($buscaCodigoConceptoGasto->num_rows>0) {
                    // Si result es 3, significa que el email del usuario ya existe.
                    echo 3;
                } else {
                    $InsertadoConceptoGasto=$InstConceptoGasto->InsertarConceptoGasto($CodigoConceptoGasto,$DesConceptoGasto,$TarifaSNConceptoGasto,$TipoGastoConceptoGasto,$PlanCuentasConceptoGasto,$EstadoConceptoGasto);
                    if ($InsertadoConceptoGasto>0 ) {
                        echo 1;
                    } else {
                        echo 0;
                    }
                }
            break;
            case 'EditConceptoGasto':
                $idConceptodeGastoFM=limpiar($_POST["idConceptodeGastoFM"]);
                $CodigoConceptoGastoFM=texto_mayusculas(limpiar($_POST["CodigoConceptoGastoFM"]));
                $DesConceptoGastoFM=primera_mayuscula(limpiar($_POST["DesConceptoGastoFM"]));
                $TarifaSNConceptoGastoFM=limpiar($_POST["TarifaSNConceptoGastoFM"]);
                $TipoGastoConceptoGastoFM=limpiar($_POST["TipoGastoConceptoGastoFM"]);
                $PlanCuentasConceptoGastoFM=limpiar($_POST["PlanCuentasConceptoGastoFM"]);
                $EstadoConceptoGastoFM=limpiar($_POST["EstadoConceptoGastoFM"]);
                
                $DatosProgramaDB=$InstConceptoGasto->BuscarConceptoGastoxid($idConceptodeGastoFM);
                $rowDB=$DatosProgramaDB->fetch_array(MYSQLI_BOTH);
               
                $diferenciaCodigo=strcmp($CodigoConceptoGastoFM,$rowDB[1]);
                $diferenciaDescripcion=strcmp($DesConceptoGastoFM,$rowDB[2]);
               
                if ($TarifaSNConceptoGastoFM=='true') {
                    $TarifaSNConceptoGastoFM=1;
                } else {
                    $TarifaSNConceptoGastoFM=0;
                }                
                $diferenciaTarifaSN=strcmp($TarifaSNConceptoGastoFM,$rowDB[3]);
                $diferenciaTipoGasto=strcmp($TipoGastoConceptoGastoFM,$rowDB[7]);
                $diferenciaPlanCuentas=strcmp($PlanCuentasConceptoGastoFM,$rowDB[8]);
                $diferenciaEstado=strcmp($EstadoConceptoGastoFM,$rowDB[6]);
                
                //echo $diferenciaCodigo.",".$diferenciaDescripcion.",".$diferenciaTarifaSN.",".$diferenciaTipoGasto.",".$diferenciaPlanCuentas.",".$diferenciaEstado;
                
                $cambio=true;


                if ($diferenciaCodigo==0 && $diferenciaDescripcion==0 && $diferenciaTarifaSN==0 && $diferenciaTipoGasto==0 && $diferenciaPlanCuentas==0 && $diferenciaEstado==0) {
                    echo 0;
                    $cambio=false;
                } else {
                    switch (true) {
                        case ($diferenciaCodigo != 0):
                            $codigoencontrado=$InstConceptoGasto->BuscarConceptoGastoxcod($CodigoConceptoGastoFM);
                            if ($codigoencontrado->num_rows>0) {
                                $cambio=false;
                            } else {
                                $cambio=true;
                            }
                        break;
                        case($diferenciaDescripcion != 0 || $diferenciaTarifaSN != 0 || $diferenciaTipoGasto != 0 || $diferenciaPlanCuentas !=0 || $diferenciaEstado !=0):
                            $cambio=true;
                        break;
                        default:
                        break;
                    }
                    if ($cambio) {
                        $actualizarconceptogasto=$InstConceptoGasto->EditarConceptoGasto($idConceptodeGastoFM,$CodigoConceptoGastoFM,$DesConceptoGastoFM,$TarifaSNConceptoGastoFM,$TipoGastoConceptoGastoFM,$PlanCuentasConceptoGastoFM,$EstadoConceptoGastoFM);                                            
                        echo 1;
                    }else{
                        echo 3;
                    }
                }
            break;
            case 'BuscarEmpleadosAjax':
                $search = strip_tags(trim($_POST['valorBusqueda']));
                $caracteres_malos = array("<", ">", "\"", "'", "/", "<", ">", "'", "/");
                $caracteres_buenos = array("& lt;", "& gt;", "& quot;", "& #x27;", "& #x2F;", "& #060;", "& #062;", "& #039;", "& #047;");
                $search=str_replace($caracteres_malos, $caracteres_buenos, $search);
                $buscarempleado=$InstEmpleados->BuscarEmpleadoAjax($search);
                if ($buscarempleado->num_rows>0) {
                    $rowEM=$buscarempleado->fetch_array(MYSQLI_BOTH);
                    $Documento = $rowEM[1];
                    $Nombre = $rowEM[2];
                    $mensaje = '
                    <p>
                    <strong>Documento:</strong> ' . $Documento . '<br>
                    <strong>Nombre:</strong> ' . $Nombre . '<br>
                    </p>';
                }
                echo $mensaje;
            break;
                    
            case 'ListarDetalleTMP':
            $listaConceptoGasto=$InstConceptoGasto->ListarConceptoGastos();
                 echo '<div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="table-responsive">
                        <table class="table table-striped  table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">Item</th>
                                    <th>Concepto Gasto</th>
                                    <th class="text-center">Dias</th>
                                    <th class="text-right">Valor</th>
                                    <th class="text-right">Sub Total</th>
                                    <th class="text-right">Eliminar</th>
                                </tr>
                            </thead>
                            <tbody class="items">';
                $listadetalleTMP=$InstSolicitudGasto->listardetalleTMP();
                $items=1;
                $suma=0;
                if ($listadetalleTMP->num_rows > 0) {
                    while($rowTMP=$listadetalleTMP->fetch_array()){
                       echo '
                        <tr>
                            <td class="text-center">'.$items.'</td>
                            <td>'.$InstSolicitudGasto->getnombreconceptoGasto($rowTMP["TMP_IdConceptoSolicitudGastos"]).'</td>
                            <td class="text-center"> '.$rowTMP['TMP_NumDisSolicitudGastos'].'</td>
                            <td class="text-right"> $ '.number_format($rowTMP["TMP_ValorundSolicitudGastos"]).'</td>
                            <td class="text-right"> $ '.number_format((intval($rowTMP['TMP_NumDisSolicitudGastos'])*intval($rowTMP["TMP_ValorundSolicitudGastos"]))).'</td>
                            <td class="text-right">
                                <a href="#" onclick="eliminar_item('.$rowTMP["idTMP_DetalleSolicitudGastos"].');")>
                                    <span class="glyphicon glyphicon-trash" style="color: red;"></span>
                                </a>
                            </td>
                        </tr>';
                        $items++;
                        $suma+=(intval($rowTMP['TMP_NumDisSolicitudGastos'])*intval($rowTMP["TMP_ValorundSolicitudGastos"]));
                    }
                }
                echo '
                            </tbody>
                        </table>

                            <!-- Row start -->
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading clearfix">
                                                <h3 class="panel-title">Insertar Concepto de Gasto</h3>
                                            </div>
                                            
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-4 col-sm-4">
                                                            <div class="input-group">
                                                                <select  class="form-control" name="ConceptoGastoSG" id="ConceptoGastoSG">
                                                                    <option value=0> --- Seleccione un concepto de Gasto --- </option>';
                                                                    
                                                                    while ($rowCG=$listaConceptoGasto->fetch_array()) {
                                                                        echo "<option value='".$rowCG[0]."'>".$rowCG[1]."-\t".$rowCG[2]."</option>";
                                                                    }                
                                                                        echo '
                                                                </select>
                                                            </div>
                                                    </div>
                                                    <div class="col-md-3 col-sm-3">
                                                        <div class="input-group">
                                                            <input class="form-control" type="number" id="NumDiasSG" min="1" max="15" placeholder="Cant Dias">
                                                            <span class="input-group-addon">00</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-sm-4">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">$</span>
                                                            <input  class="form-control" type="number" id="ValorConceptoSG" min="1" max="1500000" placeholder="Valor unidad">
                                                            <span class="input-group-addon">00</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1 col-sm-1">
                                                        <div class="input-group">
                                                            <button type="button" id="AgrgarGastoTMP" onclick="InsertarDetalleTMP();"><span class="glyphicon glyphicon-arrow-up"></span></button> 
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- Row end -->
                                <div class="form-group col-lg-12 text-right">
                                    <div style="width:70%; float:left;"><h4><label>TOTAL</label></h4></div>
                                    <div style="width:30%; float:right;"><h4><b>$</b><label id="TotalSolicitudGastoSG">'.number_format($suma).'</label></h4></div>
                                    <div id="mgEliminarDetalleTMP"></div>
                                </div>                        
                        <div>
                    </div>
                </div>';
            break;

            case 'InsertarDetalleTMP':
                                            
                $IdConceptoGasto=$_POST['ConceptoGastoSG'];
                $NumDias=$_POST['NumDiasSG'];
                $ValorSolicitud=str_replace(',','',$_POST['ValorConceptoSG']);
                $InsertarTPMDetalle=$InstSolicitudGasto->InsertarDetalleTMP($IdConceptoGasto,$NumDias,$ValorSolicitud);
            break;

            case 'eliminar_item':
                $id_detalleTMP_Eliminar=$_POST['id_detalle_TMP'];
                $delete=$InstSolicitudGasto->borrarlineadetalleTMP($id_detalleTMP_Eliminar);
                if ($delete>0) {
                    echo "<div class='alert alert-dismissible alert-danger'><strong>Eliminado:</strong> Registro eliminado !!</div>";
                }
            break;


            case 'InsertTipoMaterial':
                $DescTipoMaterial=primera_mayuscula(limpiar($_POST['DescTipoMaterial']));
                $InsertadoTipoMaterial=$InstTipoMaterial->creartipoMaterial($DescTipoMaterial);
                    if ($InsertadoTipoMaterial>0 ) {
                        echo 1;
                    } else {
                        echo 0;
                    }
            break;
            case 'EditTipoMaterial':
                $IdTipoMaterialFM=limpiar($_POST['IdTipoMaterialFM']);
                $descTipoMaterialFM=primera_mayuscula(limpiar($_POST['descTipoMaterialFM']));
                $DatosProgramaDB=$InstTipoMaterial->buscartipoMaterial($IdTipoMaterialFM);
                $rowDB=$DatosProgramaDB->fetch_array(MYSQLI_BOTH);
                $diferenciaDescripcion=strcmp($descTipoMaterialFM,$rowDB[1]);                
                $cambio=true;
                if ($diferenciaDescripcion==0) {
                    echo 0;
                    $cambio=false;
                } else {
                    $actualizarprograma=$InstTipoMaterial->actualizartipomaterial($IdTipoMaterialFM,$descTipoMaterialFM);
                    echo 1;
                }
            break;

            case 'InsertTipoNovedadesPlan':
                
                $DescTipoNovedadesPlan=primera_mayuscula(limpiar($_POST['DescTipoNovedadesPlan']));
                $InsertadoTipoNovedadesPlan=$InstTipoNovedadesPlan->creartipoNovedadesPlan($DescTipoNovedadesPlan);
                    if ($InsertadoTipoNovedadesPlan>0 ) {
                        echo 1;
                    } else {
                        echo 0;
                    }
            break;

            case 'EditTipoNovedadesPlan':
                $IdTipoNovedadesPlanFM=limpiar($_POST['IdTipoNovedadesPlanFM']);
                $descTipoNovedadesPlanFM=primera_mayuscula(limpiar($_POST['descTipoNovedadesPlanFM']));
                $DatosProgramaDB=$InstTipoNovedadesPlan->buscartipoNovedadesPlan($IdTipoNovedadesPlanFM);
                $rowDB=$DatosProgramaDB->fetch_array(MYSQLI_BOTH);
                $diferenciaDescripcion=strcmp($descTipoNovedadesPlanFM,$rowDB[1]);                
                $cambio=true;
                if ($diferenciaDescripcion==0) {
                    echo 0;
                    $cambio=false;
                } else {
                    $actualizarprograma=$InstTipoNovedadesPlan->actualizartipoNovedadesPlan($IdTipoNovedadesPlanFM,$descTipoNovedadesPlanFM);
                    echo 1;
                }
            break;
            case 'InsertCentroCostosP':
                $CodCentroCostosP=texto_mayusculas(limpiar($_POST['CodCentroCostosP']));
                $DescCentroCostosP=primera_mayuscula(limpiar($_POST['DescCentroCostosP']));
                
                $buscaCentroCostosP=$InstCentroCostosP->BuscarCentroCostosPxcodigo($CodCentroCostosP);
                if ($buscaCentroCostosP->num_rows>0) {
                    echo 3;
                } else {
                    $InsertadoCentroCostosP=$InstCentroCostosP->InsertarCentroCostosP($CodCentroCostosP,$DescCentroCostosP);
                    if ($InsertadoCentroCostosP>0 ) {
                        echo 1;
                    } else {
                        echo 0;
                    }
                }
            break;

            case 'EditCentroCostosP':
                $IdCentroCostosPFM=limpiar($_POST['IdCentroCostosPFM']);
                $CodigoCentroCostosPFM=texto_mayusculas(limpiar($_POST['CodigoCentroCostosPFM']));
                $descCentroCostosPFM=primera_mayuscula(limpiar($_POST['descCentroCostosPFM']));
                $DatosProgramaDB=$InstCentroCostosP->BuscarCentroCostosPxid($IdCentroCostosPFM);
                $rowDB=$DatosProgramaDB->fetch_array(MYSQLI_BOTH);
                $diferenciaCodigo=strcmp($CodigoCentroCostosPFM,$rowDB[1]);
                $diferenciaDescripcion=strcmp($descCentroCostosPFM,$rowDB[2]);
                $cambio=true;
                if ($diferenciaCodigo==0 && $diferenciaDescripcion==0) {
                    echo 0;
                    $cambio=false;
                } else {
                    switch (true) {
                        case ($diferenciaCodigo != 0):
                            $codigoencontrado=$InstCentroCostosP->BuscarCentroCostosPxcodigo($CodigoCentroCostosPFM);
                            if ($codigoencontrado->num_rows>0) {
                                $cambio=false;
                            } else {
                                $cambio=true;
                            }
                        break;
                        case ($diferenciaDescripcion != 0 ):
                            $cambio=true;
                        break;
                        default:
                            break;
                        }
                    if ($cambio) {
                        $actualizarprograma=$InstCentroCostosP->EditarCentroCostosP($IdCentroCostosPFM,$CodigoCentroCostosPFM,$descCentroCostosPFM);
                        echo 1;
                    }else{
                        echo 3;
                    }
                }
            break;

            case 'InsertCentroCostosH':
                $CodCentroCostosH=texto_mayusculas(limpiar($_POST['CodCentroCostosH']));
                $DescCentroCostosH=primera_mayuscula(limpiar($_POST['DescCentroCostosH']));
                $CodCentroCostosP=limpiar($_POST['CodCentroCostosP']);
                $buscaCentroCostosH=$InstCentroCostosH->BuscarCentroCostosHxcodigo($CodCentroCostosH);
                if ($buscaCentroCostosH->num_rows>0) {
                    echo 3;
                } else {
                    $InsertadoCentroCostosH=$InstCentroCostosH->InsertarCentroCostosH($CodCentroCostosH,$DescCentroCostosH,$CodCentroCostosP);
                    if ($InsertadoCentroCostosH>0 ) {
                        echo 1;
                    } else {
                        echo 0;
                    }
                }
            break;

            case 'EditCentroCostosH':
                $IdCentroCostosHFM=limpiar($_POST['IdCentroCostosHFM']);
                $CodigoCentroCostosHFM=texto_mayusculas(limpiar($_POST['CodigoCentroCostosHFM']));
                $descCentroCostosHFM=primera_mayuscula(limpiar($_POST['descCentroCostosHFM']));
                $CodCentroCostosPFM=limpiar($_POST['CodCentroCostosPFM']);
                $DatosProgramaDB=$InstCentroCostosH->BuscarCentroCostosHxid($IdCentroCostosHFM);
                $rowDB=$DatosProgramaDB->fetch_array(MYSQLI_BOTH);
                $diferenciaCodigo=strcmp($CodigoCentroCostosHFM,$rowDB[1]);
                $diferenciaDescripcion=strcmp($descCentroCostosHFM,$rowDB[2]);
                $diferenciaCodCentroCostosPFM=strcmp($CodCentroCostosPFM,$rowDB[3]);
                $cambio=true;
                if ($diferenciaCodigo==0 && $diferenciaDescripcion==0 && $diferenciaCodCentroCostosPFM ==0) {
                    echo 0;
                    $cambio=false;
                } else {
                    switch (true) {
                        case ($diferenciaCodigo != 0):
                            $codigoencontrado=$InstCentroCostosH->BuscarCentroCostosHxcodigo($CodigoCentroCostosHFM);
                            if ($codigoencontrado->num_rows>0) {
                                $cambio=false;
                            } else {
                                $cambio=true;
                            }
                        break;
                        case ($diferenciaDescripcion != 0 ):
                            $cambio=true;
                        break;
                        case ($diferenciaCodCentroCostosPFM != 0):
                            $cambio=true;
                        break;
                        default:
                            break;
                        }
                    if ($cambio) {
                        $actualizarprograma=$InstCentroCostosH->EditarCentroCostosH($IdCentroCostosHFM,$CodigoCentroCostosHFM,$descCentroCostosHFM,$CodCentroCostosPFM);
                        echo 1;
                    }else{
                        echo 3;
                    }
                }
            break;

            
            case 'InsertEntidad':
                $NitEntidad=texto_mayusculas(limpiar($_POST['NitEntidad']));
                $Nombreentidad=primera_mayuscula(limpiar($_POST['Nombreentidad']));
                
                $buscaNitEntidad=$InstEntidad->BuscarEntidadesxnit($NitEntidad);
                if ($buscaNitEntidad->num_rows>0) {
                    echo 3;
                } else {
                    $InsertadoEntidad=$InstEntidad->InsertarEntidades($NitEntidad,$Nombreentidad);
                    if ($InsertadoEntidad>0 ) {
                        echo 1;
                    } else {
                        echo 0;
                    }
                }
            break;

            case 'EditarEntidades':
                $IdEntidadesFM=limpiar($_POST['IdEntidadesFM']);
                $NitEntidadesFM=texto_mayusculas(limpiar($_POST['NitEntidadesFM']));
                $NombreEntidadesFM=primera_mayuscula(limpiar($_POST['NombreEntidadesFM']));
                
                $DatosProgramaDB=$InstEntidad->BuscarEntidadesxid($IdEntidadesFM);
                $rowDB=$DatosProgramaDB->fetch_array(MYSQLI_BOTH);
                $diferenciaCodigo=strcmp($NitEntidadesFM,$rowDB[1]);
                $diferenciaDescripcion=strcmp($NombreEntidadesFM,$rowDB[2]);
                
                $cambio=true;
                if ($diferenciaCodigo==0 && $diferenciaDescripcion==0) {
                    echo 0;
                    $cambio=false;
                } else {
                    switch (true) {
                        case ($diferenciaCodigo != 0):
                            $codigoencontrado=$InstEntidad->BuscarEntidadesxnit($NitEntidadesFM);
                            if ($codigoencontrado->num_rows>0) {
                                $cambio=false;
                            } else {
                                $cambio=true;
                            }
                        break;
                        case ($diferenciaDescripcion != 0 ):
                            $cambio=true;
                        break;
                        
                        default:
                            break;
                        }
                    if ($cambio) {
                        $actualizarprograma=$InstEntidad->EditarEntidad($IdEntidadesFM,$NitEntidadesFM,$NombreEntidadesFM);
                        echo 1;
                    }else{
                        echo 3;
                    }
                }
            break;

            case 'InsertProyecto':
                $DescProyecto=primera_mayuscula(limpiar($_POST['DescProyecto']));
                $idCentrodeCostosHijo=limpiar($_POST['idCentrodeCostosHijo']);
                $idPrograma=limpiar($_POST['idPrograma']);
                $InsertadoProyecto=$InstProyecto->InsertarProyecto($DescProyecto,$idCentrodeCostosHijo,$idPrograma);
                if ($InsertadoProyecto>0 ) {
                    echo 1;
                } else {
                    echo 0;
                }
            break;

            case 'EditarProyecto':
            
                $IdProyectoFM=limpiar($_POST['IdProyectoFM']);
                $DescProyectoFM=primera_mayuscula(limpiar($_POST['DescProyectoFM']));
                $idCentrodeCostosHijoFM=limpiar($_POST['idCentrodeCostosHijoFM']);
                $idProgramaFM=limpiar($_POST['idProgramaFM']);
                $DatosProgramaDB=$InstProyecto->BuscarProyectoxid($IdProyectoFM);
                $rowDB=$DatosProgramaDB->fetch_array(MYSQLI_BOTH);
                $diferenciaDesc=strcmp($DescProyectoFM,$rowDB[1]);
                $diferenciaCCH=strcmp($idCentrodeCostosHijoFM,$rowDB[2]);
                $diferenciaidPrograma=strcmp($idProgramaFM,$rowDB[3]);
                $cambio=true;
                if ($diferenciaDesc==0 && $diferenciaCCH==0 && $diferenciaidPrograma==0) {
                    echo 0;
                    $cambio=false;
                } else {
                    switch (true) {
                        case ($diferenciaDesc != 0):
                            $cambio=true;
                        break;
                        case ($diferenciaCCH != 0 ):
                            $cambio=true;
                        break;
                        case($diferenciaidPrograma != 0):
                            $cambio=true;
                        break;
                        default:
                            $cambio=false;
                            break;
                        }
                    if ($cambio) {
                        $actualizarprograma=$InstProyecto->EditarProyecto($IdProyectoFM,$DescProyectoFM,$idCentrodeCostosHijoFM,$idProgramaFM);
                        echo 1;
                    }else{
                        echo 3;
                    }
                }
            break;
            case 'InsertDotaciones':
                $DescDotaciones=primera_mayuscula(limpiar($_POST['DescDotaciones']));
                $InsertadoDotaciones=$InstDotaciones->crearDotaciones($DescDotaciones);
                    if ($InsertadoDotaciones>0 ) {
                        echo 1;
                    } else {
                        echo 0;
                    }
            break;
            case 'EditDotaciones':
                $IdDotacionesFM=limpiar($_POST['IdDotacionesFM']);
                $descDotacionesFM=primera_mayuscula(limpiar($_POST['descDotacionesFM']));
                $DatosProgramaDB=$InstDotaciones->buscarDotaciones($IdDotacionesFM);
                $rowDB=$DatosProgramaDB->fetch_array(MYSQLI_BOTH);
                $diferenciaDescripcion=strcmp($descDotacionesFM,$rowDB[1]);                
                $cambio=true;
                if ($diferenciaDescripcion==0) {
                    echo 0;
                    $cambio=false;
                } else {
                    $actualizarprograma=$InstDotaciones->actualizarDotaciones($IdDotacionesFM,$descDotacionesFM);
                    echo 1;
                }
            break;
            
            case 'InsertFuentes':
                $DescFuentes=primera_mayuscula(limpiar($_POST['DescFuentes']));
                $InsertadoFuentes=$InstFuentes->crearFuentes($DescFuentes);
                if ($InsertadoFuentes>0 ) {
                    echo 1;
                } else {
                    echo 0;
                }
            break;
            case 'EditFuentes':
                $IdFuentesFM=limpiar($_POST['IdFuentesFM']);
                $descFuentesFM=primera_mayuscula(limpiar($_POST['descFuentesFM']));
                $DatosProgramaDB=$InstFuentes->buscarFuentes($IdFuentesFM);
                $rowDB=$DatosProgramaDB->fetch_array(MYSQLI_BOTH);
                $diferenciaDescripcion=strcmp($descFuentesFM,$rowDB[1]);                
                $cambio=true;
                if ($diferenciaDescripcion==0) {
                    echo 0;
                    $cambio=false;
                } else {
                    $actualizarprograma=$InstFuentes->actualizarFuentes($IdFuentesFM,$descFuentesFM);
                    echo 1;
                }
            break;

            case 'InsertClasificacionC':
                $DescClasificacionC=primera_mayuscula(limpiar($_POST['DescClasificacionC']));
                $InsertadoClasificacionC=$InstClasificacionC->crearClasificacionC($DescClasificacionC);
                if ($InsertadoClasificacionC>0 ) {
                    echo 1;
                } else {
                    echo 0;
                }
            break;
            case 'EditClasificacionC':
                $IdClasificacionCFM=limpiar($_POST['IdClasificacionCFM']);
                $descClasificacionCFM=primera_mayuscula(limpiar($_POST['descClasificacionCFM']));
                $DatosProgramaDB=$InstClasificacionC->buscarClasificacionC($IdClasificacionCFM);
                $rowDB=$DatosProgramaDB->fetch_array(MYSQLI_BOTH);
                $diferenciaDescripcion=strcmp($descClasificacionCFM,$rowDB[1]);                
                $cambio=true;
                if ($diferenciaDescripcion==0) {
                    echo 0;
                    $cambio=false;
                } else {
                    $actualizarprograma=$InstClasificacionC->actualizarClasificacionC($IdClasificacionCFM,$descClasificacionCFM);
                    echo 1;
                }
            break;




            //Contacto
            case 'InsertContacto':
            $Nombre=primera_mayuscula(limpiar($_POST['Nombre']));
            $idClasificacion=limpiar($_POST['idClasificacion']);
            $CargoContacto=primera_mayuscula(limpiar($_POST['CargoContacto']));
            $TelefonoContacto=limpiar($_POST['TelefonoContacto']);
            $CelularContacto=limpiar($_POST['CelularContacto']);
            $emailContacto=limpiar($_POST['emailContacto']);
            $idRegion=$_POST['idRegion'];
            $idDepartamento=$_POST['idDepartamento'];
            $idTipoMunicipio=$_POST['idTipoMunicipio'];
                
                $buscaEmailContacto=$InstContacto->buscarEmailContacto($emailContacto);
                if ($buscaEmailContacto->num_rows>0) {
                    echo 3;
                } else {
                    $InsertadoContacto=$InstContacto->insertarContacto($Nombre,$idClasificacion,$CargoContacto,$TelefonoContacto,$CelularContacto,$emailContacto,$idRegion,$idDepartamento,$idTipoMunicipio);
                    if ($InsertadoContacto>0 ) {
                        echo 1;
                    } else {
                        echo 0;
                    }
                }
            break;
            case'EditarContacto':
                $idContactoFM=limpiar($_POST['idContactoFM']);
                $NombreFM=primera_mayuscula(limpiar($_POST['NombreFM']));
                $idClasificacionFM=limpiar($_POST['idClasificacionFM']);
                $CargoContactoFM=primera_mayuscula(limpiar($_POST['CargoContactoFM']));
                $TelefonoContactoFM=limpiar($_POST['TelefonoContactoFM']);
                $CelularContactoFM=limpiar($_POST['CelularContactoFM']);
                $emailContactoFM=limpiar($_POST['emailContactoFM']);
                $idRegionFM=$_POST['idRegionFM'];
                $idDepartamentoFM=$_POST['idDepartamentoFM'];
                $idTipoMunicipioFM=$_POST['idTipoMunicipioFM'];

                $DatosProgramaDB=$InstContacto->buscarContactoxid($idContactoFM);
                $rowDB=$DatosProgramaDB->fetch_array(MYSQLI_BOTH);
                $diferenciaNombre=strcmp($NombreFM,$rowDB[2]);
                $diferenciaClasificacion=strcmp($idClasificacionFM,$rowDB[1]);
                $diferenciaCargo=strcmp($CargoContactoFM,$rowDB[3]);
                $diferenciaTelefono=strcmp($TelefonoContactoFM,$rowDB[4]);
                $diferenciaCelular=strcmp($CelularContactoFM,$rowDB[5]);
                $diferenciaEmail=strcmp($emailContactoFM,$rowDB[6]);
                $diferenciaRegion=strcmp($idRegionFM,$rowDB[7]);
                $diferenciaDepartamento=strcmp($idDepartamentoFM,$rowDB[8]);
                $diferenciaTipoMunicipio=strcmp($idTipoMunicipioFM,$rowDB[9]);

                $cambio=true;
                if ($diferenciaNombre==0 && $diferenciaClasificacion==0 && $diferenciaCargo==0 && $diferenciaTelefono==0 && 
                $diferenciaCelular==0 && $diferenciaEmail==0 && $diferenciaRegion==0 && $diferenciaDepartamento==0 
                && $diferenciaTipoMunicipio==0) {
                    echo 0;
                    $cambio=false;
                } else {
                    switch (true) {
                        case ($diferenciaNombre != 0):
                            $cambio=true;
                        break;
                        case ($diferenciaClasificacion != 0 ):
                            $cambio=true;
                        break;
                        case($diferenciaCargo != 0):
                            $cambio=true;
                        break;
                        case ($diferenciaTelefono != 0):
                            $cambio=true;
                        break;
                        case ($diferenciaCelular != 0 ):
                            $cambio=true;
                        break;
                        case($diferenciaEmail != 0):
                            $cambio=true;
                        break;
                        case ($diferenciaRegion != 0 ):
                            $cambio=true;
                        break;
                        case($diferenciaDepartamento != 0):
                            $cambio=true;
                        break;
                        case($diferenciaTipoMunicipio != 0):
                            $cambio=true;
                        break;
                        default:
                            $cambio=false;
                            break;
                        }
                    if ($cambio) {
                        $actualizarContacto=$InstContacto->actualizarContacto($idContactoFM,$NombreFM,$idClasificacionFM,$CargoContactoFM,$TelefonoContactoFM,$CelularContactoFM,$emailContactoFM,$idRegionFM,$idDepartamentoFM,$idTipoMunicipioFM);
                        echo 1;
                    }else{
                        echo 3;
                    }
                }

            break;
            case 'InsertInstitucion':

            $CodDaneInstitucion=texto_mayusculas(limpiar($_POST['CodDaneInstitucion']));
            $NombreInstitucion=primera_mayuscula(limpiar($_POST['NombreInstitucion']));
            $idTipoInstitucion=limpiar($_POST['idTipoInstitucion']);
            $idVereda=limpiar($_POST['idVereda']);
            $BuscarcodDANE=$InstInstitucion->buscarInstitucionxDANE($CodDaneInstitucion);
            if ($BuscarcodDANE->num_rows>0) {
                echo 3;
            } else {
                $InsertarInstitucion=$InstInstitucion->InsertarInstitucion($CodDaneInstitucion,$NombreInstitucion,$idTipoInstitucion,$idVereda);
                if ($InsertarInstitucion>0 ) {
                    echo 1;
                } else {
                    echo 0;
                }
            }
            break;

            case 'EditInstitucion':
                $idInstitucionFM=limpiar($_POST['idInstitucionFM']);
                $CodDaneInstitucionFM=texto_mayusculas(limpiar($_POST['CodDaneInstitucionFM']));
                $NombreInstitucionFM=primera_mayuscula(limpiar($_POST['NombreInstitucionFM']));
                $idTipoInstitucionFM=limpiar($_POST['idTipoInstitucionFM']);
                $idVeredaFM=limpiar($_POST['idVeredaFM']);                
                $DatosProgramaDB=$InstInstitucion->buscarInstitucion($idInstitucionFM);
                $rowDB=$DatosProgramaDB->fetch_array(MYSQLI_BOTH);
                $diferenciaCodigoDANE=strcmp($CodDaneInstitucionFM,$rowDB[1]);
                $diferenciaNombre=strcmp($NombreInstitucionFM,$rowDB[2]);
                $diferenciaTipoInstitucion=strcmp($idTipoInstitucionFM,$rowDB[3]);
                $diferenciaVereda=strcmp($idVeredaFM,$rowDB[4]);
                
                $cambio=true;
                if ($diferenciaCodigoDANE==0 && $diferenciaNombre==0 && $diferenciaTipoInstitucion==0 && $diferenciaVereda==0) {
                    echo 0;
                    $cambio=false;
                } else {
                    switch (true) {
                        case ($diferenciaCodigoDANE != 0):
                            $codigoencontrado=$InstInstitucion->buscarInstitucionxDANE($CodDaneInstitucionFM);
                            if ($codigoencontrado->num_rows>0) {
                                $cambio=false;
                            } else {
                                $cambio=true;
                            }
                        break;
                        case ($diferenciaNombre != 0 ):
                            $cambio=true;
                        break;
                        
                        default:
                            $cambio=true;
                            break;
                        }
                    if ($cambio) {
                        $actualizarprograma=$InstInstitucion->actualizarInstitucion($idInstitucionFM,$CodDaneInstitucionFM,$NombreInstitucionFM,$idTipoInstitucionFM,$idVeredaFM);
                        echo 1;
                    }else{
                        echo 3;
                    }
                }


            // Modulos Javier Octubre 25


            case 'InsertarActividad':
            $descripcionactividad=primera_mayuscula(limpiar($_POST['descripcionactividad']));
            $unidadtiempoac=primera_mayuscula(limpiar($_POST['unidadtiempoac']));
            $actividadinsertada=$InstActividades->InsertActividad($descripcionactividad,$unidadtiempoac);
            if($actividadinsertada>0){
                echo 1;
            }else{
                echo 0;
            }
            break;

            case 'EditarActividad':
            $IdActividad=(limpiar($_POST['IdActividad']));
            $descActividad=primera_mayuscula(limpiar($_POST['descActividad']));
            $unTiemActividad=primera_mayuscula(limpiar($_POST['unTiemActividad']));
            $DatosProgramaDB=$InstActividades->BuscarActividad($IdActividad);
            $rowDB=$DatosProgramaDB->fetch_array(MYSQLI_BOTH);
            $diferenciaDescripcion=strcmp($descActividad,$rowDB[1]);
            $diferenciaUdTiemp=strcmp($unTiemActividad,$rowDB[2]);
            $cambio=true;
            if ($diferenciaDescripcion==0  && $diferenciaUdTiemp==0 ) {
                echo 0;
                $cambio=false;
            } else {
                switch (true) {
                    case ($diferenciaDescripcion != 0):
                        $descEncontrado=$InstActividades->BuscardescActividad($descActividad);
                        if ($descEncontrado->num_rows>0) {
                            $cambio=false;
                        } else {
                            $cambio=true;
                        }
                    break;
                    case ($diferenciaUdTiemp != 0 ):
                        $cambio=true;
                    break;
                    default:
                        break;
                }
                if ($cambio) {
                    $actualizarprograma=$InstActividades->EditarActividad($IdActividad,$descActividad,$unTiemActividad);
                    echo 1;
                }else{
                    echo 3;
                }
            }
            break;

            //Modulo departamento.
            case 'insertarDpto':
            $codDaneDpto=limpiar($_POST['codDaneDpto']);
            $DescDpto=primera_mayuscula(limpiar($_POST['descripDpto']));
            $Dptoinsertado=$InstDpto->InsertDepartamento($codDaneDpto,$DescDpto);
            if($Dptoinsertado>0){
                echo 1;
            }else{
                echo 0;
            }
            break;

            case 'EditarDpto':
            $IdDpto=limpiar($_POST['IdDpto']);
            $codDANEDpto=limpiar($_POST['codDANEDpto']);
            $descDpto=primera_mayuscula(limpiar($_POST['descDpto']));
            $DatosProgramaDB=$InstDpto->BuscaridDepartamento($IdDpto);
            $rowDB=$DatosProgramaDB->fetch_array(MYSQLI_BOTH);
            $diferenciaDANE=strcmp($codDANEDpto,$rowDB[1]); 
            $diferenciaDescDpto=strcmp($descDpto,$rowDB[2]);               
            $cambio=true;
            if ($diferenciaDANE ==0 && $diferenciaDescDpto==0) {
                echo 0;
                $cambio=false;
            } else {
                switch(true){
                        case($diferenciaDANE !=0):
                            $codigoDANEEncontrado=$InstDpto->BuscarCodDepartamento($codDANEDpto);
                            if($codigoDANEEncontrado->num_rows>0){
                                $cambio=false;
                            }else{
                                $cambio=true;
                            }
                        break;
                        case($diferenciaDescDpto !=0):
                            $cambio=true;
                        break;
                }
                if($cambio){
                    $actualizarprograma=$InstDpto->EditarDepartamento($IdDpto,$codDANEDpto,$descDpto);
                    echo 1;
                }else{
                    echo 3;
                }
            }
            break;

            // Modulo de tipo Municipio
            case 'insertarTipoMcpio':
            $codTipoMcpio=limpiar($_POST['codTipoMcpio']);
            $DescTipoMcpio=primera_mayuscula(limpiar($_POST['descTipoMcpio']));
            
            
            $buscarCodTipoMcpio=$InstTipoMcpio->BuscarxCodMunicipio($codTipoMcpio);
            if ($buscarCodTipoMcpio->num_rows>0) {
                echo 3;
            } else {
                $TipoMcpioinsertado=$InstTipoMcpio->InsertTipoMunicipio($codTipoMcpio,$DescTipoMcpio);
                if($TipoMcpioinsertado>0){
                    echo 1;
                    }else{
                    echo 0;
                    }
            }
                        
            break;

            case 'EditarTipoMcpio':
            $IdTipoMcpio=limpiar($_POST['IdTipoMcpio']);
            $descTipoMcpio=primera_mayuscula(limpiar($_POST['descTipoMcpio']));
            $codTipoMcpio=limpiar($_POST['codTipoMcpio']);
            $DatosProgramaDB=$InstTipoMcpio->BuscarTipoMunicipio($IdTipoMcpio);
            $rowDB=$DatosProgramaDB->fetch_array(MYSQLI_BOTH);
            $diferenciaDescTipoMcpio=strcmp($descTipoMcpio,$rowDB[2]); 
            $diferenciaCodTipoMcpio=strcmp($codTipoMcpio,$rowDB[1]);              
            $cambio=true;
            if ($diferenciaDescTipoMcpio ==0 && $diferenciaCodTipoMcpio==0) {
                echo 0;
                $cambio=false;
            } else {
                if($cambio){
                    $actualizarprograma=$InstTipoMcpio->EditarTipoMunicipio($IdTipoMcpio,$codTipoMcpio,$descTipoMcpio);
                    echo 1;
                }else{
                    echo 3;
                }
            }
            break;

            //Modulo de Region
            case 'InsertRegion':
            $codRegion=limpiar($_POST['codRegion']);
            $DescRegion=primera_mayuscula(limpiar($_POST['descripcionRegion']));
            $Regioninsertado=$InstRegion->InsertRegion($codRegion,$DescRegion);
            if($Regioninsertado>0){
            echo 1;
            }else{
            echo 0;
            }
            break;

            case 'EditarRegion':
            $IdRegion=limpiar($_POST['idRegion']);
            $descRegion=primera_mayuscula(limpiar($_POST['descRegion']));
            $DatosProgramaDB=$InstRegion->BuscarIdRegion($IdRegion);
            $rowDB=$DatosProgramaDB->fetch_array(MYSQLI_BOTH);
            $diferenciaDescReg=strcmp($descRegion,$rowDB[1]);               
            $cambio=true;
            if ($diferenciaDescReg ==0) {
                echo 0;
                $cambio=false;
            } else {
                if($cambio){
                    $actualizarprograma=$InstRegion->EditarRegion($IdRegion,$descRegion);
                    echo 1;
                }else{
                    echo 3;
                }
            }
            break;

            //Modulo de Municipio
            case 'insertarMunicipio':
            $codDaneDpto=limpiar($_POST['codDaneDpto']);
            $DescDpto=primera_mayuscula(limpiar($_POST['descTipoInsti']));
            $Dptoinsertado=$InstMunicipio->InsertDepartamento($codDaneDpto,$DescDpto);
            if($Dptoinsertado>0){
            echo 1;
            }else{
                echo 0;
                }
            break;

            //Modulo de tipo institucion 
            case 'insertarTipoInsti':
            $descTipoInsti=primera_mayuscula(limpiar($_POST['descTipoInsti']));
            $TipoInstitinsertado=$InstTipoInstitu->InsertTipoInstitucion($descTipoInsti);
            if($TipoInstitinsertado>0){
            echo 1;
            }else{
                echo 0;
                }
            break;

            case 'EditarTipoInst':
            $idTipoInst=limpiar($_POST['idTipoInst']);
            $descTipoInst=primera_mayuscula(limpiar($_POST['descTipoInst']));
            $DatosProgramaDB=$InstRegion->BuscarIdRegion($idTipoInst);
            $rowDB=$DatosProgramaDB->fetch_array(MYSQLI_BOTH);
            $diferenciaDescTipoInst=strcmp($descTipoInst,$rowDB[1]);               
            $cambio=true;
            if ($diferenciaDescTipoInst ==0) {
                echo 0;
                $cambio=false;
            } else {
                if($cambio){
                    $actualizarprograma=$InstTipoInstitu->EditarTipoInstitucion($idTipoInst,$descTipoInst);
                    echo 1;
                }else{
                    echo 3;
                }
            }
            break;

            //Modulo de tipo Encuesta infraestructura
            case 'insertarTipoEncInf':
            $descTipoEncInf=primera_mayuscula(limpiar($_POST['descTipoEncInf']));
            $TipoEncInfinsertado=$InstTipoEncInf->InsertTipoEncInfraes($descTipoEncInf);
            if($TipoEncInfinsertado>0){
            echo 1;
            }else{
            echo 0;
            }
            break;

            case 'EditarTipoEncInf':
            $idTipoEncInf=limpiar($_POST['idTipoEncInf']);
            $descTipoEncInf=primera_mayuscula(limpiar($_POST['descTipoEncInf']));
            $DatosProgramaDB=$InstTipoEncInf->BuscarTipoEncInfraes($idTipoEncInf);
            $rowDB=$DatosProgramaDB->fetch_array(MYSQLI_BOTH);
            $diferenciadescTipoEncInf=strcmp($descTipoEncInf,$rowDB[1]);               
            $cambio=true;
            if ($diferenciadescTipoEncInf ==0) {
                echo 0;
                $cambio=false;
            } else {
                if($cambio){
                    $actualizarprograma=$InstTipoEncInf->EditarTipoEncInfraes($idTipoEncInf,$descTipoEncInf);
                    echo 1;
                }else{
                    echo 3;
                }
            }
            break;

            // modulo Procesos.
            case 'InsertProcesos':
            $descProceso=primera_mayuscula(limpiar($_POST['descProceso']));
            $procesoinsertada=$InstProc->InsertProcesos($descProceso);
            if($procesoinsertada>0){
            echo 1;
            }else{
            echo 0;
            }
            break;

            case 'EditarProceso':
            $idProceso=limpiar($_POST['idProceso']);
            $descProceso=primera_mayuscula(limpiar($_POST['descProceso']));
            $DatosProgramaDB=$InstProc->BuscarCodProcesos($idProceso);
            $rowDB=$DatosProgramaDB->fetch_array(MYSQLI_BOTH);
            $diferenciadescProceso=strcmp($descProceso,$rowDB[1]);               
            $cambio=true;
            if ($diferenciadescProceso ==0) {
            echo 0;
            $cambio=false;
            } else {
            if($cambio){
            $actualizarprograma=$InstProc->EditarProcesos($idProceso,$descProceso);
            echo 1;
            }else{
            echo 3;
            }
            }
            break;

            // modulo Tipo taller.
            case 'InsertTipoTaller':
                $descTipoTaller=primera_mayuscula(limpiar($_POST['descTipoTaller']));
                $estadoTipoTaller=primera_mayuscula(limpiar($_POST['estadoTipoTaller']));
                $tipoTallerinsertado=$InstTipoTall->InsertTipoTaller($descTipoTaller, $estadoTipoTaller);
                if($tipoTallerinsertado>0){
                    echo 1;
                }else{
                    echo 0;
                }
            break;

            case 'EditarTipoTaller':
                $IdTipoTaller=limpiar($_POST['IdTipoTaller']);
                $descTipoTaller=limpiar($_POST['descTipoTaller']);
                $estadoTipoTaller=primera_mayuscula(limpiar($_POST['estadoTipoTaller']));
                $DatosProgramaDB=$InstTipoTall->BuscaridTipoTaller($IdTipoTaller);
                $rowDB=$DatosProgramaDB->fetch_array(MYSQLI_BOTH);
                $diferenciadesc=strcmp($descTipoTaller,$rowDB[1]); 
                $diferenciaestadoTipoTaller=strcmp($estadoTipoTaller,$rowDB[2]);               
                $cambio=true;
                if ($diferenciadesc==0 && $diferenciaestadoTipoTaller==0) {
                    echo 0;
                    $cambio=false;
                } else {
                    switch(true){
                            case($diferenciadesc!=0):
                                $descEncontrado=$InstTipoTall->BuscarTipoTaller($descTipoTaller);
                                if($descEncontrado->num_rows >0){
                                    $cambio=false;
                                }else{
                                    $cambio=true;
                                }
                            break;
                            case($diferenciaestadoTipoTaller!=0):
                                $cambio=true;
                            break;
                    }
                    if($cambio){
                        $actualizarprograma=$InstTipoTall->EditarTipoTaller($IdTipoTaller,$descTipoTaller,$estadoTipoTaller);
                        echo 1;
                    }else{
                        echo 3;
                    }
                }
            break;

            // modulo Colecciones.
            case 'InsertColeccion':
                $descColeccion=primera_mayuscula(limpiar($_POST['descColeccion']));
                $idEntColeccion=primera_mayuscula(limpiar($_POST['idEntColeccion']));
                $coleccioninsertado=$InstColeccion->InsertColecciones($descColeccion, $idEntColeccion);
                if($coleccioninsertado>0){
                    echo 1;
                }else{
                    echo 0;
                }
            break;
// Modulo Javier Octubre 25



            case 'EditarColeccion':
                $idColeccion=limpiar($_POST['idColeccion']);
                $DescColeccion=primera_mayuscula(limpiar($_POST['DescColeccion']));
                $DatosProgramaDB=$InstColeccion->BuscarIdColecciones($idColeccion);
                $rowDB=$DatosProgramaDB->fetch_array(MYSQLI_BOTH);
                $diferenciaDescColeccion=strcmp($DescColeccion,$rowDB[1]);               
                $cambio=true;
                if ($diferenciaDescColeccion ==0) {
                    echo 0;
                    $cambio=false;
                } else {
                    if($cambio){
                        $actualizarprograma=$InstColeccion->EditarColeccion($idColeccion,$DescColeccion);
                        echo 1;
                    }else{
                        echo 3;
                    }
                }
            break;

            // modulo Tipo Tarifas.
            case 'InsertTipoTarifa':
                    $descTipoTarifa=primera_mayuscula(limpiar($_POST['descTipoTarifa']));
                    $TipoTarifainsertado=$InstTipoTarifa->Inserttipotarifa($descTipoTarifa);
                    if($TipoTarifainsertado>0){
                        echo 1;
                    }else{
                        echo 0;
                    }
                break;
    
                case 'EditarTipoTarifa':
                    $idTipoTarifa=limpiar($_POST['idTipoTarifa']);
                    $descTipoTarifa=primera_mayuscula(limpiar($_POST['idTipoTarifa']));
                    $DatosProgramaDB=$InstTipoTarifa->Buscartipotarifa($idTipoTarifa);
                    $rowDB=$DatosProgramaDB->fetch_array(MYSQLI_BOTH);
                    $diferenciadescTipoTarifa=strcmp($descTipoTarifa,$rowDB[1]);               
                    $cambio=true;
                    if ($diferenciadescTipoTarifa ==0) {
                        echo 0;
                        $cambio=false;
                    } else {
                        if($cambio){
                            $actualizarprograma=$InstTipoTarifa->Editartipotarifa($idTipoTarifa,$descTipoTarifa);
                            echo 1;
                        }else{
                            echo 3;
                        }
                    }
                break;
            
                // modulo Veredas.
                case 'InsertVereda':
                    $descVereda=primera_mayuscula(limpiar($_POST['descVereda']));
                    $IdMcpio=primera_mayuscula(limpiar($_POST['IdMcpio']));
                    $Veredainsertado=$InstVereda->Insertvereda($descVereda, $IdMcpio);
                    if($Veredainsertado>0){
                        echo 1;
                    }else{
                        echo 0;
                    }
            break;

            case 'EditarVereda':
            $IdVereda=limpiar($_POST['IdVereda']);
            $descVereda=primera_mayuscula(limpiar($_POST['descVereda']));
            $IdMcpio=limpiar($_POST['IdMcpio']);
            $DatosProgramaDB=$InstVereda->BuscaridVereda($IdVereda);
            $rowDB=$DatosProgramaDB->fetch_array(MYSQLI_BOTH);
            $diferenciadesc=strcmp($descVereda,$rowDB[1]); 
            $diferenciaIdMcpio=strcmp($IdMcpio,$rowDB[2]);               
            $cambio=true;
            if ($diferenciadesc==0 && $diferenciaIdMcpio==0) {
                echo 0;
                $cambio=false;
            } else {
                switch(true){
                        case($diferenciadesc!=0):
                            $descEncontrado=$InstVereda->BuscarVereda($descVereda);
                            if($descEncontrado->num_rows >0){
                                $cambio=false;
                            }else{
                                $cambio=true;
                            }
                        break;
                        case($diferenciaIdMcpio!=0):
                            $cambio=true;
                        break;
                }
                if($cambio){
                    $actualizarprograma=$InstVereda->Editarvereda($IdVereda,$descVereda,$IdMcpio);
                    echo 1;
                }else{
                    echo 3;
                }
            }
            break;

           // modulo Municipios.
           case 'InsertMunicipio':
           $codMunicipio=limpiar($_POST['codMunicipio']);
           $descMunicipio=primera_mayuscula(limpiar($_POST['descMunicipio']));
           $idRegion=limpiar($_POST['idRegion']);
           $idTipoMcpio=limpiar($_POST['idTipoMcpio']);
           $idTipoTarifa=limpiar($_POST['idTipoTarifa']);
           $idDpto=limpiar($_POST['idDpto']);
           $Mcpioinsertado=$InstMcpio->InsertMunicipio($codMunicipio,$descMunicipio,$idRegion,$idTipoMcpio,$idTipoTarifa,$idDpto);
           if($Mcpioinsertado>0){
               echo 1;
           }else{
               echo 0;
           }
       break;

       case 'EditarMunicipio':
           $IdMcpio=limpiar($_POST['IdMcpio']);
           $codMunicipio=limpiar($_POST['codMunicipio']);
           $descMunicipio=primera_mayuscula(limpiar($_POST['descMunicipio']));
           $idRegion=limpiar($_POST['idRegion']);
           $idTipoMcpio=limpiar($_POST['idTipoMcpio']);
           $idTipoTarifa=limpiar($_POST['idTipoTarifa']);
           $idDpto=limpiar($_POST['idDpto']);
           $DatosProgramaDB=$InstMcpio->BuscarMunicipio($IdMcpio);
           $rowDB=$DatosProgramaDB->fetch_array(MYSQLI_BOTH);
           $diferenciaDANEMcpio=strcmp($codMunicipio,$rowDB[1]); 
           $diferenciadescMunicipio=strcmp($descMunicipio,$rowDB[2]);               
           $cambio=true;
           if ($diferenciaDANEMcpio==0 && $diferenciadescMunicipio==0) {
               echo 0;
               $cambio=false;
           } else {
               switch(true){
                       case($diferenciaDANEMcpio!=0):
                           $descEncontrado=$InstMcpio->BuscarCodMunicipio($codMunicipio);
                           if($descEncontrado->num_rows >0){
                               $cambio=false;
                           }else{
                               $cambio=true;
                           }
                       break;
                       case($diferenciadescMunicipio!=0):
                           $cambio=true;
                       break;
               }
               if($cambio){
                   $actualizarprograma=$InstMcpio->EditarMunicipio($IdMcpio,$codMunicipio,$descMunicipio,$idRegion,$idTipoMcpio,$idTipoTarifa,$idDpto);
                   echo 1;
               }else{
                   echo 3;
               }
           }
       break;

// Modulo Javier Octubre 25

            case 'InsertarSolicitudGasto':

                $fecha=$_POST['fecha'];
                $CodProyectoSG=$_POST['CodProyectoSG'];
                $CodProcesoSG=$_POST['CodProcesoSG'];
                $CodActividadSG=$_POST['CodActividadSG'];
                $CodMunicipioSG=$_POST['CodMunicipioSG'];
                $CodEntidadSG=$_POST['CodEntidadSG'];
                $FechaHoraSalidaSG=$_POST['FechaHoraSalidaSG'];
                $FechaHoraRegresoSG=$_POST['FechaHoraRegresoSG'];
                $responsableSG=$_POST['responsableSG'];
                $CantColeccionSG=$_POST['CantColeccionSG'];
                $TipoColeccionSG=$_POST['TipoColeccionSG'];
                $TotalSolicitudGastoSG=str_replace(',','',$_POST['TotalSolicitudGastoSG']);

                $InsertarSolicitudGastoCab=$InstSolicitudGasto->InsertarSolicitudGastos($fecha,$CodProyectoSG,$CodProcesoSG,$CodActividadSG,$CodMunicipioSG,$CodEntidadSG,$FechaHoraSalidaSG,$FechaHoraRegresoSG,$CantColeccionSG,$TipoColeccionSG,$TotalSolicitudGastoSG);

                if($InsertarSolicitudGastoCab>0){
                        for($i=0; $i<count($responsableSG); $i++){
                            $InsertarResponsbleSG=$InstSolicitudGasto->InsertarResponsablesSG($InsertarSolicitudGastoCab,$responsableSG[$i]);
                        }
                        $ListaDetalleTMP=$InstSolicitudGasto->listardetalleTMP();
                        while ($rowDSG=$ListaDetalleTMP->fetch_array(MYSQLI_BOTH)) { 
                            $InsertandoDetalleSG=$InstSolicitudGasto->InsertarTPMaDetalle($InsertarSolicitudGastoCab,$rowDSG[1], $rowDSG[2],$rowDSG[3]);
                        }
                        $BorrarTMPDetalle=$InstSolicitudGasto->vaciarTMPDetalle();
                    echo 1;              
                }else{
                    echo 0;
                }
                
            break;

            // modulo Tipo Novedades Material.
                case 'InsertTipoNovedadMater':
                    $descTipoNovMater=primera_mayuscula(limpiar($_POST['descTipoNovMater']));
                    $TiponovMaterinsertado=$InstTipoNovedadesMater->creartipoNovedadesMater($descTipoNovMater);
                    if($TiponovMaterinsertado>0){
                        echo 1;
                    }else{
                        echo 0;
                    }
                break;

                case 'EditarTipoNovMater':
                    $idTipoNovMater=limpiar($_POST['idTipoNovMater']);
                    $descTipoNovMater=primera_mayuscula(limpiar($_POST['descTipoNovMater']));
                    $DatosProgramaDB=$InstTipoNovedadesMater->buscartipoNovedadesMater($idTipoNovMater);
                    $rowDB=$DatosProgramaDB->fetch_array(MYSQLI_BOTH);
                    $diferenciadescTipoNovMater=strcmp($descTipoNovMater,$rowDB[1]);               
                    $cambio=true;
                    if ($diferenciadescTipoNovMater ==0) {
                        echo 0;
                        $cambio=false;
                    } else {
                        if($cambio){
                            $actualizarprograma=$InstTipoNovedadesMater->EditarNovedadesMater($idTipoNovMater,$descTipoNovMater);
                            echo 1;
                        }else{
                            echo 3;
                        }
                    }
                break;

                case 'ListarDetalleSG':
                    $IsSG=limpiar($_POST['IsSG']);
                        echo '<div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="table-responsive">
                                    <!-- Row start -->
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading clearfix">
                                                        <h3 class="panel-title">Detalle Solicitud de Gastos</h3>
                                                    </div>
                                                    
                                                    <div class="panel-body">
                                                        <div class="row">
                                                            <table class="table table-striped  table-hover">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="text-center">Item</th>
                                                                        <th>Concepto Gasto</th>
                                                                        <th class="text-center">Dias</th>
                                                                        <th class="text-right">Valor</th>
                                                                        <th class="text-right">Sub Total</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody class="items">';
                                                                    $ListaDetalleSG=$InstSolicitudGasto->ListarDetallexidSolicitud($IsSG);
                                                                    $items=1;
                                                                    $suma=0;
                                                                    if ($ListaDetalleSG->num_rows > 0) {
                                                                        while($rowSG=$ListaDetalleSG->fetch_array()){
                                                                        echo '
                                                                            <tr>
                                                                                <td class="text-center">'.$items.'</td>
                                                                                <td>'.$InstSolicitudGasto->getnombreconceptoGasto($rowSG[2]).'</td>
                                                                                <td class="text-center"> '.$rowSG[3].'</td>
                                                                                <td class="text-right"> $ '.number_format($rowSG[4]).'</td>
                                                                                <td class="text-right"> $ '.number_format((intval($rowSG[3])*intval($rowSG[4]))).'</td>
                                                                            </tr>';
                                                                            $items++;
                                                                            $suma+=(intval($rowSG[3])*intval($rowSG[4]));
                                                                        }
                                                                    }
                                                                    echo '
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <!-- Row end -->
                                    
                                    <div class="form-group col-lg-12 text-right">
                                        <div style="width:70%; float:left;"><h4><label>TOTAL</label></h4></div>
                                        <div style="width:30%; float:right;"><h4><b>$</b><label id="TotalSolicitudGastoSG">'.number_format($suma).'</label></h4></div>
                                    </div>                        
                                <div>
                            </div>';
                break;
                case 'getSolcitudGastoxLegalizar':
                    $IdSG=$_POST['IdSG'];
                    $listaSolicGastos=$InstSolicitudGasto->BuscarSolicitudGastosxid($IdSG);
                    echo json_encode($listaSolicGastos->fetch_array());
                break;

                // Modulo Legalizacion solicitud de gastos

                case 'InsertarLegalizSolicitudGasto':
                    require_once("../modulos/legalizacionSolicGasto/class/ClasslegalizacionSolicGasto.php");
                    $InstLegalizSolictGasto= new Proceso_LegalizacionSolicitudGastos($InstanciaDB);

                    $IdSolicitudGastoSG=$_POST['IdSolicitudGastoSG'];
                    $FechaLegalizSG=$_POST['FechaLegalizSG'];
                    $responsableSG=$_POST['responsableSG'];
                    $VrLegSolicGastoSG=$_POST['VrLegSolicGastoSG'];       
                    $InsertarLegalizSolicGastoCab=$InstLegalizSolictGasto->InsertarLegalizSolicitudGastos($IdSolicitudGastoSG,$FechaLegalizSG,$responsableSG,$VrLegSolicGastoSG);
                    
                    if($InsertarLegalizSolicGastoCab>0){
                        $CambioEstdoSG=$InstSolicitudGasto->CambiarEstadoSG($IdSolicitudGastoSG);
                        echo 1;             
                    }else{
                    echo 0;
                    }
                break;

            default:
                break;
            }
    } else {
         include('../vista/indexvista.php');
    }
?>