<?php 
    if (!$_SESSION['autentic']) {
        //header('Location:../../php_cerrar.php');
    } else {
?>
<!-- /. NAV TOP  -->
    <nav class="navbar-default navbar-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav" id="main-menu">
                <li>
                    <a class="active-menu" href="../principal/principal.php"><i class="fa fa-home fa-3x"></i> Inicio</a>
                </li>
                <li>
                    <a href=""><i class="fa fa-user fa-3x"></i> Aspectos Iniciales</a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href='../programas/indexProgramas.php'> Programas</a>
                        </li>
                        <li>
                            <a href="../plan_cuentas/indexPlanCuentas.php"> Plan Cuentas</a>
                        </li>
                        <li>
                            <a href="../tipo_gastos/indexTipodeGastos.php"> Tipo Gastos</a>
                        </li>
                        <li>
                            <a href="../conceptos_gastos/indexConceptoGastos.php"> Conceptos Gastos</a>
                        </li>
                        <li>
                            <a href="../empleados/indexEmpleados.php"> Empleados</a>
                        </li>
                        <li>
                            <a href="../actividades/indexActividades.php"> Actividades</a>
                        </li>
                        <li>
                            <a href="../departamentos/indexDepartamentos.php"> Departamentos</a>
                        </li>
                        <li>
                            <a href="../tipo_materiales/indexTipoMaterial.php"> Tipo Materiales</a>
                        </li>
                        <li>
                            <a href="../tipo_novedades/indexTipoNovedadesPlan.php"> Tipo Novedades Planeacion</a>
                        </li>
                        <li>
                            <a href="../centro_costos/indexCentroCostosP.php"> Centro de Costos Padre</a>
                        </li>
                        <li>
                            <a href="../centro_costos/indexCentroCostosH.php"> Centro de Costos Hijo</a>
                        </li>
                        <li>
                            <a href="../entidades/indexEntidades.php"> Entidades Vinculadas</a>
                        </li>
                        <li>
                            <a href="../proyectos/indexProyecto.php"> Proyectos</a>
                        </li>
                        <li>
                            <a href="../dotaciones/indexDotaciones.php"> Elementos Dotacion</a>
                        </li>
                        <li>
                            <a href="../fuentes/indexFuentes.php"> Fuentes Abastecimientos</a>
                        </li>
                        <li>
                            <a href="../clasificacionc/indexClasificacionC.php"> Clasificacion Contactos</a>
                        </li>
                        <li>
                            <a href="../contacto/indexContacto.php"> Contactos</a>
                        </li>
                        <li>
                            <a href="../institucion/indexInstitucion.php"> Instituciones</a>
                        </li>
                        <li>
                            <a href="../tipo_encuestas/indexTipoEncuestasInf.php"> Tipo Encuesta Infraestructura</a>
                        </li>					
                        <li>
                            <a href="../procesos/indexProcesos.php"> Procesos</a>
                        </li>					
                        <li>
                            <a href="../regiones/indexRegiones.php"> Regiones</a>
                        </li>			
                        <li>
                            <a href="../tipo_novedades/indexTipoNovedadesMaterial.php"> Tipo Novedades Materiales</a>
                        </li>
                        <li>
                            <a href="../tipo_instituciones/indexTipoInstitucion.php"> Tipo Instituciones</a>
                        </li>	
                        <li>
                            <a href="../tipo_talleres/indexTipoTalleres.php"> Tipo Talleres</a>
                        </li>	
                        <li>
                            <a href="../tipo_municipios/indexTipoMunicipios.php"> Tipo de Municipios</a>
                        </li>
                        <li>
                            <a href="../municipios/indexMunicipios.php"> Municipios</a>
                        </li>	
                        <li>
                            <a href="../veredas/indexVeredas.php"> Veredas</a>
                        </li>		
                        <li>
                            <a href="../colecciones/indexColecciones.php"> Colecciones</a>
                        </li>
                        <li>
                            <a href="../colecciones/indexColecciones.php"> Colecciones</a>
                        </li>
                        <li>
                            <a href="../tipo_tarifas/indexTipoTarifa.php"> Tipo Tarifa</a>
                        </li>																	
                    </ul>
                </li>
                    <li>
                    <a href=""><i class="fa fa-edit fa-3x"></i> Procesos</a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="../solicitud_gastos/indexSolicitudGastos.php"> Solicitud Gastos de Viaje</a>
                        </li>
                        <li>
                            <a href="#"> Asignacion de Donantes</a>
                        </li>							
                        <li>
                            <a href="#"> Requisicion de Materiales</a>
                        </li>							
                        <li>
                            <a href="#"> Recibo Materiales</a>
                        </li>														
                        <li>
                            <a href="#"> Asistencia a Capacitaciones</a>
                        </li>	
                        <li>
                            <a href="#"> Registro Entrega Colecciones</a>
                        </li>	  
                        <li>
                            <a href="#"> Entrega Anteojos</a>
                        </li>	
                        <li>
                            <a href="#"> Encuesta Infraestructura</a>
                        </li>	
                        							
                        </ul>
                </li>
                    <li>
                    <a href="modulos/pacientes/index.php"><i class="fa fa-qrcode fa-3x"></i> Consultas</a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="#"> Instalacion</a>
                        </li>
                        <li>
                            <a href="#"> Escuelas</a>
                        </li>
                    </ul>
                </li>
                    <li>
                    <a href="modulos/pacientes/index.php"><i class="fa fa-bar-chart-o fa-3x"></i> Utilidades</a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="modulos/empresa/index.php"> Copia Seguridad</a>
                        </li>
                    </ul>
                </li>           
                <li>
                    <a href="#"><i class="fa fa-cog fa-3x"></i> Administración<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="../usuarios/indexUsuarios.php"> Usuarios</a>
                        </li>
                        <li>
                            <a href="#"> Empresa</a>
                        </li>
                        <li>
                            <a href="#"> Cargos</a>
                        </li>					
                        <li>
                            <a href="#"> Bodegas</a>
                        </li>
                    </ul>
                    </li>                   
            </ul>
        </div>
    </nav>  
    <!-- /. NAV SIDE  -->
<?php }?>