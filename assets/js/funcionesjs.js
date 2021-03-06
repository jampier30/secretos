function login() {
    var email = $('#Email').val();
    var pass = $('#Clave').val();
    var params = {email,pass};
    var url = "logica/logica.php?accion=login";
    $.ajax({
      url: url,
      type: 'POST',
      cache: false,
      dataType: 'json',
      data: params,
    }).done(function(result) {
      if(result == 1){
        $("#msg").html("<div class='alert alert-dismissible alert-success'><strong>Redireccionando !!</strong></div>");
        location.href="modulos/principal/principal.php";
      } else {
        $("#msg").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> Las credenciales son incorrectas.</div>");
        location.reload(); 
      }
    });
    $("#msg").delay(3000).fadeOut(300);
  }

function EditPrograma(){
    var IdPrograma=$('#formeditProgramaid').val();
    var CodigoProgramaEdit = $('#formeditProgramaCodigo').val();
    var DescProgramaEdit = $('#formeditProgramaDescripcion').val();
    var EstadoProgramaEdit = $('#formeditProgramaEstado').val();
    if (DescProgramaEdit === "" || CodigoProgramaEdit==="") {
      $("#msgProgramaEdit").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> El campo descripcion debe estar lleno</div>");
    } else {
      var params = {IdPrograma,CodigoProgramaEdit,DescProgramaEdit,EstadoProgramaEdit};
      var url = "../../logica/logica.php?accion=EditPrograma";
      $.ajax({
        url: url,
        type: 'POST',
        cache: false,
        dataType: 'json',
        data: params,
      }).done(function(result) {
        if(result == 1){
          $("#msgProgramaEdit").html("<div class='alert alert-dismissible alert-success'>EUREKA: <strong>Editado con Exito !!</strong></div>");
          location.reload(); 
        } else if (result == 3) {
          $("#msgProgramaEdit").html("<div class='alert alert-dismissible alert-warning'><strong>Los datos quedeseas cambiar ya existen.  Intenta nuevamente</strong></div>");
        } else {
          $("#msgProgramaEdit").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> No se realizo ningun cambio en el programa, no hay nada que editar</div>");
        }
      });
  }
  $("#msgProgramaEdit").delay(3000).fadeOut(300);
  return;
}

function EditarUsuario() {  
  var IdUsuarioFM=$('#IdUsuarioFM').val();
  var NombreUsuarioFM=$('#NombreUsuariof').val();
  var EstadoUsuarioFM=$('#EstadoUsuario').val();
  if (NombreUsuarioFM === "") {
    $("#msgEditUsuario").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> Los campos no pueden estar vacios</div>");
  } else {
    var params = {IdUsuarioFM,NombreUsuarioFM,EstadoUsuarioFM};
      var url = "../../logica/logica.php?accion=EditUsuario";
      $.ajax({
        url: url,
        type: 'POST',
        cache: false,
        dataType: 'json',
        data: params,
      }).done(function(result) {
        if(result == 1){
          $("#msgEditUsuario").html("<div class='alert alert-dismissible alert-success'>EUREKA: <strong>Editado con Exito !!</strong></div>");
          location.reload(); 
        } else if (result == 3) {
          $("#msgEditUsuario").html("<div class='alert alert-dismissible alert-warning'><strong>Los datos quedeseas cambiar ya existen.  Intenta nuevamente</strong></div>");
        } else {
          $("#msgEditUsuario").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> No se realizo ningun cambio en los datos del usuario, no hay nada que cambiar</div>");
        }
      });
  }
  $("#msgEditUsuario").delay(3000).fadeOut(300);
}

function formeditUsuario(datoUsuario){
  deditI=datoUsuario.split('||');
  $('#IdUsuarioFM').val(deditI[0]);
  $('#NombreUsuariof').val(deditI[4]);
  $('#CorreoUsuario').val(deditI[1]);
  $("#EstadoUsuario option[value="+ deditI[3] +"]").attr("selected",true);
}

  function formeditPrograma(datoPrograma){
    deditI=datoPrograma.split('||');
    $('#formeditProgramaid').val(deditI[0]);
    $('#formeditProgramaCodigo').val(deditI[1]);
    $('#formeditProgramaDescripcion').val(deditI[2]);
    $("#formeditProgramaEstado option[value="+ deditI[3] +"]").attr("selected",true);
  }

  function formeditTipoGasto(datoPrograma){
    deditI=datoPrograma.split('||');
    $('#IdTipoGastoFM').val(deditI[0]);
    $('#CodigoTipoGastoFM').val(deditI[1]);
    $('#descTipoGastoFM').val(deditI[2]);
    $("#EstadoTipoGastoFM option[value="+ deditI[3] +"]").attr("selected",true);
  }

  function formeditPlanCuentas(datoPrograma){
    deditI=datoPrograma.split('||');
    $('#IdPlanCuentasFM').val(deditI[0]);
    $('#CodigoPlanCuentasFM').val(deditI[1]);
    $('#descPlanCuentasFM').val(deditI[2]);
    $("#EstadoPlanCuentasFM option[value="+ deditI[3] +"]").attr("selected",true);
  }

  function formeditConceptoGasto(dato2Programa){
    deditI=dato2Programa.split('||');
    $('#idConceptodeGastoFM').val(deditI[0]);
    $('#CodigoConceptoGastoFM').val(deditI[1]);
    $('#DesConceptoGastoFM').val(deditI[2]);
    if (deditI[3]==1) {
      $('#TarifaSNConceptoGastoFM').prop('checked',true);
    } else {
      $('#TarifaSNConceptoGastoFM').prop('checked',false);
    }
    $("#TipoGastoConceptoGastoFM option[value="+ deditI[7] +"]").attr("selected",true);
    $("#PlanCuentasConceptoGastoFM option[value="+ deditI[8] +"]").attr("selected",true);
    $("#EstadoConceptoGastoFM option[value="+ deditI[6] +"]").attr("selected",true);
  }

  function formeditTipoMaterial(datoPrograma){
    deditI=datoPrograma.split('||');
    $('#IdTipoMaterialFM').val(deditI[0]);
    $('#descTipoMaterialFM').val(deditI[1]);
  }

  function formeditTipoNovedadesPlan(datoPrograma){
    deditI=datoPrograma.split('||');
    $('#IdTipoNovedadesPlanFM').val(deditI[0]);
    $('#descTipoNovedadesPlanFM').val(deditI[1]);
  }

  function formeditCentroCostosP(datoPrograma){
    deditI=datoPrograma.split('||');
    $('#IdCentroCostosPFM').val(deditI[0]);
    $('#CodigoCentroCostosPFM').val(deditI[1]);
    $('#descCentroCostosPFM').val(deditI[2]);
  }

  function formeditCentroCostosH(datoPrograma){
    deditI=datoPrograma.split('||');
    $('#IdCentroCostosHFM').val(deditI[0]);
    $('#CodigoCentroCostosHFM').val(deditI[1]);
    $('#descCentroCostosHFM').val(deditI[2]);
    $("#CodCentroCostosPFM option[value="+ deditI[3] +"]").attr("selected",true);
  }

  function formeditEntidades(datoPrograma){
    deditI=datoPrograma.split('||');
    $('#IdEntidadesFM').val(deditI[0]);
    $('#NitEntidadesFM').val(deditI[1]);
    $('#NombreEntidadesFM').val(deditI[2]);
  }

  function formeditProyecto(datoPrograma){
    deditI=datoPrograma.split('||');
    $('#IdProyectoFM').val(deditI[0]);
    $('#DescProyectoFM').val(deditI[1]);
    $("#idCentrodeCostosHijoFM option[value="+ deditI[2] +"]").attr("selected",true);
    $("#idProgramaFM option[value="+ deditI[3] +"]").attr("selected",true);
  }

  function formeditDotaciones(datoPrograma){
    deditI=datoPrograma.split('||');
    $('#IdDotacionesFM').val(deditI[0]);
    $('#descDotacionesFM').val(deditI[1]);
  }

  function formeditFuentes(datoPrograma){
      deditI=datoPrograma.split('||');
      $('#IdFuentesFM').val(deditI[0]);
      $('#descFuentesFM').val(deditI[1]);
  }

  function formeditClasificacionC(datoPrograma){
    deditI=datoPrograma.split('||');
    $('#IdClasificacionCFM').val(deditI[0]);
    $('#descClasificacionCFM').val(deditI[1]);
  }

  function formmasinfoContacto(datoPrograma){
    deditI=datoPrograma.split('||');
      $('#NombreMI').html(deditI[2]);
      $('#TelefonoContactoMI').html(deditI[4]);
      $('#CelularContactoMI').html(deditI[5]);
      $('#emailContactoMI').html(deditI[6]);
      $('#RegionMI').html(deditI[7]);
      $('#idClasificacionMI').html(deditI[1]);
      $('#CargoContactoMI').html(deditI[3]);
      $('#idDepartamentoMI').html(deditI[8]);
      $('#idTipoMunicipioMI').html(deditI[9]);
  }

  function formeditContacto(datoPrograma){
    deditI=datoPrograma.split('||');
      $('#idContactoFM').val(deditI[0]);
      $('#NombreFM').val(deditI[2]);
      $('#TelefonoContactoFM').val(deditI[4]);
      $('#CelularContactoFM').val(deditI[5]);
      $('#emailContactoFM').val(deditI[6]);
      $('#CargoContactoFM').val(deditI[3]);
      $("#idClasificacionFM option[value="+ deditI[1] +"]").attr("selected",true);
      $("#idDepartamentoFM option[value="+ deditI[8] +"]").attr("selected",true);
      $("#idTipoMunicipioFM option[value="+ deditI[9] +"]").attr("selected",true);
      $("#idRegionFM option[value="+ deditI[7] +"]").attr("selected",true);
      
  }

  function formeditInstitucion(datoPrograma){
    deditI=datoPrograma.split('||');
    $('#idInstitucionFM').val(deditI[0]);
    $('#CodDaneInstitucionFM').val(deditI[1]);
    $('#NombreInstitucionFM').val(deditI[2]);
    $("#idTipoInstitucionFM option[value="+ deditI[3] +"]").attr("selected",true);
    $("#idVeredaFM option[value="+ deditI[4] +"]").attr("selected",true);
  }

  // Javier Octubre 25

  function formeditRegion(datoPrograma){
    deditI=datoPrograma.split('||');
    $('#idRegionFM').val(deditI[0]);
    $('#descRegionFM').val(deditI[1]);
  }

  function formeditActividad(datoPrograma){
    deditI=datoPrograma.split('||');
    $('#idActividadFM').val(deditI[0]);
    $('#descActividadFM').val(deditI[1]);
    $('#undTiempActividadFM').val(deditI[2]);
  }

  function formeditTipoInst(datoPrograma){
    deditI=datoPrograma.split('||');
    $('#idTipoInstFM').val(deditI[0]);
    $('#descTipoInstFM').val(deditI[1]);
  }

  function formeditTipoMcpio(datoPrograma){
    deditI=datoPrograma.split('||');
    $('#idTipoMcpioFM').val(deditI[0]);
    $('#CodTipoMcpioFM').val(deditI[1]);
    $('#descTipoMcpioFM').val(deditI[2]);

  }

  function formeditTipoEncInf(datoPrograma){
    deditI=datoPrograma.split('||');
    $('#idTipoEncInfFM').val(deditI[0]);
    $('#descTipoEncInfFM').val(deditI[1]);
  }
 
  function formeditProceso(datoPrograma){
    deditI=datoPrograma.split('||');
    $('#idProcesoFM').val(deditI[0]);
    $('#descProcesoFM').val(deditI[1]);
  }

  function formeditTipoTaller(datoPrograma){
    deditI=datoPrograma.split('||');
    $('#idTipoTallerFM').val(deditI[0]);
    $('#descTipoTallerFM').val(deditI[1]);
    $('#estadoTipoTallerFM').val(deditI[2]);
  }

  function formeditTipoMaterial(datoPrograma){
    deditI=datoPrograma.split('||');
    $('#IdTipoMaterialFM').val(deditI[0]);
    $('#descTipoMaterialFM').val(deditI[1]);
  }

  // Modulo usuario
  
  function InsertUsuario() {
    var NombreUsuario=$('#NombreUsuario').val();
    var EmailUsuario=$('#EmailUsuario').val();
    var EstadoUsuario=$('#EstadoUsuario').val();
    var ClaveUsuario=$('#ClaveUsuario').val();
    if (NombreUsuario === "" && EmailUsuario === "" && ClaveUsuario==="") {
      $("#msgUsuarioNuevo").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> Los campos 'Nombre, Correo y Clave' son obligatorios</div>");
    } else {
      var params = {NombreUsuario,EmailUsuario,EstadoUsuario,ClaveUsuario};
      var url = "../../logica/logica.php?accion=InsertUsuario";
      $.ajax({
        url: url,
        type: 'POST',
        dataType: 'json',
        data: params,
      }).done(function(result) {
        if(result == 1){
          $("#msgUsuarioNuevo").html("<div class='alert alert-dismissible alert-success'><strong>Usuario insertado Con Exito !!</strong></div>");
          location.reload(); 
        } else if (result == 3) {
          $("#msgUsuarioNuevo").html("<div class='alert alert-dismissible alert-warning'><strong>Ese correo electronico ya existe.</strong></div>");
        } else {
          $("#msgUsuarioNuevo").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong>No fue posible insertar el dato, por favorcomuniquese con soporte tecnico.</div>");
          return;
        }
      });
    }
    $("#msgUsuarioNuevo").delay(3000).fadeOut(300);
  }

  function InsertPrograma(){
    var codigoPrograma=$('#codigoprograma').val();
    var descPrograma = $('#descPrograma').val();
    var estado = $('#estado').val();
    if (descPrograma === "" && codigoPrograma=="") {
      $("#msgPrograma").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> El campo descripcion debe estar lleno</div>");
    } else {
      var params = {descPrograma,estado,codigoPrograma};
      var url = "../../logica/logica.php?accion=InsertPrograma";
      $.ajax({
        url: url,
        type: 'POST',
        dataType: 'json',
        data: params,
      }).done(function(result) {
        if(result == 1){
          $("#msgPrograma").html("<div class='alert alert-dismissible alert-success'><strong>Insertado Con Exito !!</strong></div>");
          location.reload(); 
        } else if (result == 3) {
          $("#msgPrograma").html("<div class='alert alert-dismissible alert-warning'><strong>La descripcion ya existe.</strong></div>");
        } else {
          $("#msgPrograma").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong>No fue posible insertar el Dato. Comuniquese con soporte.</div>");
          return;
        }
        
      });
    }
    $("#msgPrograma").delay(3000).fadeOut(300);
  }

  function InsertTipoGasto() {
    var CodTipoGasto=$('#CodTipoGasto').val();
    var DescTipoGasto=$('#DescTipoGasto').val();
    var EstadoTipoGasto=$('#EstadoTipoGasto').val();
    if (CodTipoGasto === "" && DescTipoGasto === "") {
      $("#msgTipoGastoNuevo").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> Los campos 'Nombre, Correo y Clave' son obligatorios</div>");
    } else {
      var params = {CodTipoGasto,DescTipoGasto,EstadoTipoGasto};
      var url = "../../logica/logica.php?accion=InsertTipoGasto";
      $.ajax({
        url: url,
        type: 'POST',
        dataType: 'json',
        data: params,
      }).done(function(result) {
        if(result == 1){
          $("#msgTipoGastoNuevo").html("<div class='alert alert-dismissible alert-success'><strong>Tipo de gasto insertado Con Exito !!</strong></div>");
          location.reload(); 
        } else if (result == 3) {
          $("#msgTipoGastoNuevo").html("<div class='alert alert-dismissible alert-warning'><strong>Esecoigo de tipo de gasto ya existe.</strong></div>");
        } else {
          $("#msgTipoGastoNuevo").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong>No fue posible insertar el dato, por favor comuniquese con soporte tecnico.</div>");
          return;
        }
      });
    }
    $("#msgTipoGastoNuevo").delay(3000).fadeOut(300);
  }

  function EditarTipoGastoFM(){
    var IdTipoGastoFM=$('#IdTipoGastoFM').val();
    var CodigoTipoGastoFM = $('#CodigoTipoGastoFM').val();
    var descTipoGastoFM = $('#descTipoGastoFM').val();
    var EstadoTipoGastoFM = $('#EstadoTipoGastoFM').val();
    if (CodigoTipoGastoFM === "" || descTipoGastoFM==="") {
      $("#msgEditTipoGastoFM").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> Los campos no pueden estar vacios</div>");
    } else {
      var params = {IdTipoGastoFM,CodigoTipoGastoFM,descTipoGastoFM,EstadoTipoGastoFM};
      var url = "../../logica/logica.php?accion=EditTipoGasto";
      $.ajax({
        url: url,
        type: 'POST',
        cache: false,
        dataType: 'json',
        data: params,
      }).done(function(result) {
        if(result == 1){
          $("#msgEditTipoGastoFM").html("<div class='alert alert-dismissible alert-success'>EUREKA: <strong>Editado con Exito !!</strong></div>");
          location.reload(); 
        } else if (result == 3) {
          $("#msgEditTipoGastoFM").html("<div class='alert alert-dismissible alert-warning'><strong>Los datos quedeseas cambiar ya existen.  Intenta nuevamente</strong></div>");
        } else {
          $("#msgEditTipoGastoFM").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> No se realizo ningun cambio en el programa, no hay nada que editar</div>");
        }
      });
  }
  $("#msgEditTipoGastoFM").delay(3000).fadeOut(300);
  return;
}

// Insertar nueva Cuenta Contable en Plan de Cuentas
function InsertPLanCuenta(){
  var CodPlanCuentas=$('#CodPlanCuentas').val();
  var DescPlanCuentas=$('#DescPlanCuentas').val();
  var EstadoPlanCuentas=$('#EstadoPlanCuentas').val();
  if (CodPlanCuentas === "" && DescPlanCuentas === "") {
    $("#msgPlanCuentasNuevo").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> Los campos 'Nombre, Correo y Clave' son obligatorios</div>");
  } else {
    var params = {CodPlanCuentas,DescPlanCuentas,EstadoPlanCuentas};
    var url = "../../logica/logica.php?accion=InsertPlanCuentas";
    $.ajax({
      url: url,
      type: 'POST',
      dataType: 'json',
      data: params,
    }).done(function(result) {
      if(result == 1){
        $("#msgPlanCuentasNuevo").html("<div class='alert alert-dismissible alert-success'><strong>Cuenta insertada Con Exito !!</strong></div>");
        location.reload(); 
      } else if (result == 3) {
        $("#msgPlanCuentasNuevo").html("<div class='alert alert-dismissible alert-warning'><strong>Ese Codigo de Cuenta ya existe.</strong></div>");
      } else {
        $("#msgPlanCuentasNuevo").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong>No fue posible insertar el dato, por favor comuniquese con soporte tecnico.</div>");
        return;
      }
    });
  }
  $("#msgPlanCuentasNuevo").delay(3000).fadeOut(300);
}

function EditarPlanCuentasFM(){
  var IdPlanCuentasFM=$('#IdPlanCuentasFM').val();
  var CodigoPlanCuentasFM = $('#CodigoPlanCuentasFM').val();
  var descPlanCuentasFM = $('#descPlanCuentasFM').val();
  var EstadoPlanCuentasFM = $('#EstadoPlanCuentasFM').val();
  if (CodigoPlanCuentasFM === "" || descPlanCuentasFM==="") {
    $("#msgEditTipoGastoFM").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> Los campos no pueden estar vacios</div>");
  } else {
    var params = {IdPlanCuentasFM,CodigoPlanCuentasFM,descPlanCuentasFM,EstadoPlanCuentasFM};
    var url = "../../logica/logica.php?accion=EditPlanCuentas";
    $.ajax({
      url: url,
      type: 'POST',
      cache: false,
      dataType: 'json',
      data: params,
    }).done(function(result) {
      if(result == 1){
        $("#msgEditTipoGastoFM").html("<div class='alert alert-dismissible alert-success'>EUREKA: <strong>Editado con Exito !!</strong></div>");
        location.reload(); 
      } else if (result == 3) {
        $("#msgEditTipoGastoFM").html("<div class='alert alert-dismissible alert-warning'><strong>Los datos quedeseas cambiar ya existen.  Intenta nuevamente</strong></div>");
      } else {
        $("#msgEditTipoGastoFM").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> No se realizo ningun cambio en el programa, no hay nada que editar</div>");
      }
    });
}
$("#msgEditTipoGastoFM").delay(3000).fadeOut(300);
return;
}

// Proceso Insertar Concepto de Gasto
function InsertConceptoGasto(){
  var CodigoConceptoGasto=$('#CodigoConceptoGasto').val();
  var DesConceptoGasto=$('#DesConceptoGasto').val();
  var TarifaSNConceptoGasto=$('#TarifaSNConceptoGasto').val();
  var TipoGastoConceptoGasto=$('#TipoGastoConceptoGasto').val();
  var PlanCuentasConceptoGasto=$('#PlanCuentasConceptoGasto').val();
  var EstadoConceptoGasto=$('#EstadoConceptoGasto').val();
  if (CodigoConceptoGasto === "" && DesConceptoGasto === "") {
    $("#msgConceptoGastoNuevo").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> Los campos 'Codigo y Descripcion' son obligatorios</div>");
  } else {
    var params = {CodigoConceptoGasto,DesConceptoGasto,TarifaSNConceptoGasto,TipoGastoConceptoGasto,PlanCuentasConceptoGasto,EstadoConceptoGasto};
    var url = "../../logica/logica.php?accion=InsertConceptoGasto";
    $.ajax({
      url: url,
      type: 'POST',
      dataType: 'json',
      data: params,
    }).done(function(result) {
      if(result == 1){
        $("#msgConceptoGastoNuevo").html("<div class='alert alert-dismissible alert-success'><strong>Concepto de gasto insertado Con Exito !!</strong></div>");
        location.reload(); 
      } else if (result == 3) {
        $("#msgConceptoGastoNuevo").html("<div class='alert alert-dismissible alert-warning'><strong>Ese Codigo de Concepto de gasto ya existe.</strong></div>");
      } else {
        $("#msgConceptoGastoNuevo").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong>No fue posible insertar el dato, por favor comuniquese con soporte tecnico.</div>");
        return;
      }
    });
  }
  $("#msgConceptoGastoNuevo").delay(3000).fadeOut(300);
}

//Editar Concepto de Gasto
function EditarConceptoGastoFM(){
  var idConceptodeGastoFM=$('#idConceptodeGastoFM').val();
  var CodigoConceptoGastoFM = $('#CodigoConceptoGastoFM').val();
  var DesConceptoGastoFM = $('#DesConceptoGastoFM').val();
  var TarifaSNConceptoGastoFM = $('#TarifaSNConceptoGastoFM').prop('checked');
  var TipoGastoConceptoGastoFM = $('#TipoGastoConceptoGastoFM').val();
  var PlanCuentasConceptoGastoFM = $('#PlanCuentasConceptoGastoFM').val();
  var EstadoConceptoGastoFM = $('#EstadoConceptoGastoFM').val();
  if (CodigoConceptoGastoFM === "" || DesConceptoGastoFM==="") {
    $("#msgEditConceptoGasto").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> Los campos no pueden estar vacios</div>");
  } else {
    var params = {idConceptodeGastoFM,CodigoConceptoGastoFM,DesConceptoGastoFM,TarifaSNConceptoGastoFM,TipoGastoConceptoGastoFM,PlanCuentasConceptoGastoFM,EstadoConceptoGastoFM};
    var url = "../../logica/logica.php?accion=EditConceptoGasto";
    $.ajax({
      url: url,
      type: 'POST',
      cache: false,
      dataType: 'json',
      data: params,
    }).done(function(result) {
      if(result == 1){
        $("#msgEditConceptoGasto").html("<div class='alert alert-dismissible alert-success'>EUREKA: <strong>Editado con Exito !!</strong></div>");
        location.reload(); 
      } else if (result == 3) {
        $("#msgEditConceptoGasto").html("<div class='alert alert-dismissible alert-warning'><strong>Los datos quedeseas cambiar ya existen.  Intenta nuevamente</strong></div>");
      } else {
        $("#msgEditConceptoGasto").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> No se realizo ningun cambio en el programa, no hay nada que editar</div>");
      }
    });
}
$("#msgEditConceptoGasto").delay(3000).fadeOut(300);
return;
}

function insertarDpto(){
  var codDaneDpto= $('#codDANEDpto').val();
  var descripDpto=$('#descripDpto').val();
  if(codDaneDpto=="" || descripDpto==""){
    $("#msgDpto").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> Los campos no pueden estar vacios</div>");
  }else{
    var parametros={codDaneDpto,descripDpto};
    $.ajax({
      url: "../../logica/logica.php?accion=insertarDpto",
      type: 'POST',
      cache: false,
      dataType: 'json',
      data: parametros,
    }).done(function(result) {
      if(result == 1){
        location.reload(); 
      } else if (result == 3) {
        $("#msgDpto").html("<div class='alert alert-dismissible alert-warning'><strong>Los datos quedeseas cambiar ya existen.  Intenta nuevamente</strong></div>");
      } else {
        $("#msgDpto").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> No fue posible insertar el dato, por favor comuniquese con soporte tecnico.</div>");
      }
    });
  }
}

function InsertTipoMaterial() {
  
  var DescTipoMaterial=$('#DescTipoMaterial').val();
  
  if (DescTipoMaterial === "") {
    $("#msgTipoMaterialNuevo").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> Los campos 'Nombre, Correo y Clave' son obligatorios</div>");
  } else {
    var params = {DescTipoMaterial};
    var url = "../../logica/logica.php?accion=InsertTipoMaterial";
    $.ajax({
      url: url,
      type: 'POST',
      dataType: 'json',
      data: params,
    }).done(function(result) {
      if(result == 1){
        $("#msgTipoMaterialNuevo").html("<div class='alert alert-dismissible alert-success'><strong>Tipo de gasto insertado Con Exito !!</strong></div>");
        location.reload(); 
      } else if (result == 3) {
        $("#msgTipoMaterialNuevo").html("<div class='alert alert-dismissible alert-warning'><strong>Esecoigo de tipo de gasto ya existe.</strong></div>");
      } else {
        $("#msgTipoMaterialNuevo").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong>No fue posible insertar el dato, por favor comuniquese con soporte tecnico.</div>");
        return;
      }
    });
  }
  $("#msgTipoMaterialNuevo").delay(3000).fadeOut(300);
}

function EditarTipoMaterialFM(){
  var IdTipoMaterialFM=$('#IdTipoMaterialFM').val();
  var descTipoMaterialFM = $('#descTipoMaterialFM').val();
  if (descTipoMaterialFM==="") {
    $("#msgEditTipoMaterialFM").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> Los campos no pueden estar vacios</div>");
  } else {
    var params = {IdTipoMaterialFM,descTipoMaterialFM};
    var url = "../../logica/logica.php?accion=EditTipoMaterial";
    $.ajax({
      url: url,
      type: 'POST',
      cache: false,
      dataType: 'json',
      data: params,
    }).done(function(result) {
      if(result == 1){
        $("#msgEditTipoMaterialFM").html("<div class='alert alert-dismissible alert-success'>EUREKA: <strong>Editado con Exito !!</strong></div>");
        location.reload(); 
      } else if (result == 3) {
        $("#msgEditTipoMaterialFM").html("<div class='alert alert-dismissible alert-warning'><strong>Los datos quedeseas cambiar ya existen.  Intenta nuevamente</strong></div>");
      } else {
        $("#msgEditTipoMaterialFM").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> No se realizo ningun cambio en el programa, no hay nada que editar</div>");
      }
    });
}
$("#msgEditTipoMaterialFM").delay(3000).fadeOut(300);
return;
}

function InsertTipoNovedadesPlan() {
  
  var DescTipoNovedadesPlan=$('#DescTipoNovedadesPlan').val();
  
  if (DescTipoNovedadesPlan === "") {
    $("#msgTipoNovedadesPlanNuevo").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> Los campos 'Nombre, Correo y Clave' son obligatorios</div>");
  } else {
    var params = {DescTipoNovedadesPlan};
    var url = "../../logica/logica.php?accion=InsertTipoNovedadesPlan";
    $.ajax({
      url: url,
      type: 'POST',
      dataType: 'json',
      data: params,
    }).done(function(result) {
      if(result == 1){
        $("#msgTipoNovedadesPlanNuevo").html("<div class='alert alert-dismissible alert-success'><strong>Tipo de gasto insertado Con Exito !!</strong></div>");
        location.reload(); 
      } else if (result == 3) {
        $("#msgTipoNovedadesPlanNuevo").html("<div class='alert alert-dismissible alert-warning'><strong>Esecoigo de tipo de gasto ya existe.</strong></div>");
      } else {
        $("#msgTipoNovedadesPlanNuevo").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong>No fue posible insertar el dato, por favor comuniquese con soporte tecnico.</div>");
        return;
      }
    });
  }
  $("#msgTipoNovedadesPlanNuevo").delay(3000).fadeOut(300);
}

function EditarTipoNovedadesPlanFM(){
  var IdTipoNovedadesPlanFM=$('#IdTipoNovedadesPlanFM').val();
  var descTipoNovedadesPlanFM = $('#descTipoNovedadesPlanFM').val();
  if (descTipoNovedadesPlanFM==="") {
    $("#msgEditTipoNovedadesPlanFM").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> Los campos no pueden estar vacios</div>");
  } else {
    var params = {IdTipoNovedadesPlanFM,descTipoNovedadesPlanFM};
    var url = "../../logica/logica.php?accion=EditTipoNovedadesPlan";
    $.ajax({
      url: url,
      type: 'POST',
      cache: false,
      dataType: 'json',
      data: params,
    }).done(function(result) {
      if(result == 1){
        $("#msgEditTipoNovedadesPlanFM").html("<div class='alert alert-dismissible alert-success'>EUREKA: <strong>Editado con Exito !!</strong></div>");
        location.reload(); 
      } else if (result == 3) {
        $("#msgEditTipoNovedadesPlanFM").html("<div class='alert alert-dismissible alert-warning'><strong>Los datos quedeseas cambiar ya existen.  Intenta nuevamente</strong></div>");
      } else {
        $("#msgEditTipoNovedadesPlanFM").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> No se realizo ningun cambio en el programa, no hay nada que editar</div>");
      }
    });
}
$("#msgEditTipoNovedadesPlanFM").delay(3000).fadeOut(300);
return;
}

function InsertCentroCostosP() {
  var CodCentroCostosP=$('#CodCentroCostosP').val();
  var DescCentroCostosP=$('#DescCentroCostosP').val();
  
  if (DescCentroCostosP === "") {
    $("#msgCentroCostosPNuevo").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> Los campos 'Nombre, Correo y Clave' son obligatorios</div>");
  } else {
    var params = {DescCentroCostosP,CodCentroCostosP};
    var url = "../../logica/logica.php?accion=InsertCentroCostosP";
    $.ajax({
      url: url,
      type: 'POST',
      dataType: 'json',
      data: params,
    }).done(function(result) {
      if(result == 1){
        $("#msgCentroCostosPNuevo").html("<div class='alert alert-dismissible alert-success'><strong>Tipo de gasto insertado Con Exito !!</strong></div>");
        location.reload(); 
      } else if (result == 3) {
        $("#msgCentroCostosPNuevo").html("<div class='alert alert-dismissible alert-warning'><strong>Esecoigo de tipo de gasto ya existe.</strong></div>");
      } else {
        $("#msgCentroCostosPNuevo").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong>No fue posible insertar el dato, por favor comuniquese con soporte tecnico.</div>");
        return;
      }
    });
  }
  $("#msgCentroCostosPNuevo").delay(3000).fadeOut(300);
}

function EditarCentroCostosPFM(){
  var IdCentroCostosPFM=$('#IdCentroCostosPFM').val();
  var CodigoCentroCostosPFM = $('#CodigoCentroCostosPFM').val();
  var descCentroCostosPFM = $('#descCentroCostosPFM').val();
  
  if (CodigoCentroCostosPFM === "" || descCentroCostosPFM==="") {
    $("#msgEditCentroCostosPFM").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> Los campos no pueden estar vacios</div>");
  } else {
    var params = {IdCentroCostosPFM,CodigoCentroCostosPFM,descCentroCostosPFM};
    var url = "../../logica/logica.php?accion=EditCentroCostosP";
    $.ajax({
      url: url,
      type: 'POST',
      cache: false,
      dataType: 'json',
      data: params,
    }).done(function(result) {
      if(result == 1){
        $("#msgEditCentroCostosPFM").html("<div class='alert alert-dismissible alert-success'>EUREKA: <strong>Editado con Exito !!</strong></div>");
        location.reload(); 
      } else if (result == 3) {
        $("#msgEditCentroCostosPFM").html("<div class='alert alert-dismissible alert-warning'><strong>Los datos quedeseas cambiar ya existen.  Intenta nuevamente</strong></div>");
      } else {
        $("#msgEditCentroCostosPFM").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> No se realizo ningun cambio en el programa, no hay nada que editar</div>");
      }
    });
}
$("#msgEditCentroCostosPFM").delay(3000).fadeOut(300);
return;
}

function InsertCentroCostosH(){
  var CodCentroCostosP=$('#CodCentroCostosP').val();
  var CodCentroCostosH = $('#CodCentroCostosH').val();
  var DescCentroCostosH = $('#DescCentroCostosH').val();
  
  if (CodCentroCostosH === "" || DescCentroCostosH==="") {
    $("#msgCentroCostosHNuevo").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> Los campos no pueden estar vacios</div>");
  } else {
    var params = {CodCentroCostosP,CodCentroCostosH,DescCentroCostosH};
    var url = "../../logica/logica.php?accion=InsertCentroCostosH";
    $.ajax({
      url: url,
      type: 'POST',
      cache: false,
      dataType: 'json',
      data: params,
    }).done(function(result) {
      if(result == 1){
        $("#msgCentroCostosHNuevo").html("<div class='alert alert-dismissible alert-success'>EUREKA: <strong>Editado con Exito !!</strong></div>");
        location.reload(); 
      } else if (result == 3) {
        $("#msgCentroCostosHNuevo").html("<div class='alert alert-dismissible alert-warning'><strong>Los datos quedeseas cambiar ya existen.  Intenta nuevamente</strong></div>");
      } else {
        $("#msgCentroCostosHNuevo").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> No se realizo ningun cambio en el programa, no hay nada que editar</div>");
      }
    });
}
$("#msgCentroCostosHNuevo").delay(3000).fadeOut(300);
return;
}

function EditarCentroCostosHFM(){
  var IdCentroCostosHFM=$('#IdCentroCostosHFM').val();
  var CodigoCentroCostosHFM = $('#CodigoCentroCostosHFM').val();
  var descCentroCostosHFM = $('#descCentroCostosHFM').val();
  var CodCentroCostosPFM=$('#CodCentroCostosPFM').val();
  if (CodigoCentroCostosHFM === "" || descCentroCostosHFM==="") {
    $("#msgEditCentroCostosHFM").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> Los campos no pueden estar vacios</div>");
  } else {
    var params = {IdCentroCostosHFM,CodigoCentroCostosHFM,descCentroCostosHFM,CodCentroCostosPFM};
    var url = "../../logica/logica.php?accion=EditCentroCostosH";
    $.ajax({
      url: url,
      type: 'POST',
      cache: false,
      dataType: 'json',
      data: params,
    }).done(function(result) {
      if(result == 1){
        $("#msgEditCentroCostosHFM").html("<div class='alert alert-dismissible alert-success'>EUREKA: <strong>Editado con Exito !!</strong></div>");
        location.reload(); 
      } else if (result == 3) {
        $("#msgEditCentroCostosHFM").html("<div class='alert alert-dismissible alert-warning'><strong>Los datos quedeseas cambiar ya existen.  Intenta nuevamente</strong></div>");
      } else {
        $("#msgEditCentroCostosHFM").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> No se realizo ningun cambio en el programa, no hay nada que editar</div>");
      }
    });
}
$("#msgEditCentroCostosHFM").delay(3000).fadeOut(300);
return;
}

function InsertEntidades(){
  var NitEntidad=$('#NitEntidad').val();
  var Nombreentidad = $('#Nombreentidad').val();
   
  if (NitEntidad === "" || Nombreentidad==="") {
    $("#msgEntidadesNuevo").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> Los campos no pueden estar vacios</div>");
  } else {
    var params = {NitEntidad,Nombreentidad};
    var url = "../../logica/logica.php?accion=InsertEntidad";
    $.ajax({
      url: url,
      type: 'POST',
      cache: false,
      dataType: 'json',
      data: params,
    }).done(function(result) {
      if(result == 1){
        $("#msgEntidadesNuevo").html("<div class='alert alert-dismissible alert-success'>EUREKA: <strong>Editado con Exito !!</strong></div>");
        location.reload(); 
      } else if (result == 3) {
        $("#msgEntidadesNuevo").html("<div class='alert alert-dismissible alert-warning'><strong>Los datos quedeseas cambiar ya existen.  Intenta nuevamente</strong></div>");
      } else {
        $("#msgEntidadesNuevo").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> No se realizo ningun cambio en el programa, no hay nada que editar</div>");
      }
    });
}
$("#msgEntidadesNuevo").delay(3000).fadeOut(300);
return;
}

function EditarEntidadesFM(){
  var IdEntidadesFM=$('#IdEntidadesFM').val();
  var NitEntidadesFM = $('#NitEntidadesFM').val();
  var NombreEntidadesFM = $('#NombreEntidadesFM').val();
  
  if (NitEntidadesFM === "" || NombreEntidadesFM==="") {
    $("#msgEditEntidadesFM").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> Los campos no pueden estar vacios</div>");
  } else {
    var params = {IdEntidadesFM,NitEntidadesFM,NombreEntidadesFM};
    var url = "../../logica/logica.php?accion=EditarEntidades";
    $.ajax({
      url: url,
      type: 'POST',
      cache: false,
      dataType: 'json',
      data: params,
    }).done(function(result) {
      if(result == 1){
        $("#msgEditEntidadesFM").html("<div class='alert alert-dismissible alert-success'>EUREKA: <strong>Editado con Exito !!</strong></div>");
        location.reload(); 
      } else if (result == 3) {
        $("#msgEditEntidadesFM").html("<div class='alert alert-dismissible alert-warning'><strong>Los datos quedeseas cambiar ya existen.  Intenta nuevamente</strong></div>");
      } else {
        $("#msgEditEntidadesFM").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> No se realizo ningun cambio en el programa, no hay nada que editar</div>");
      }
    });
}
$("#msgEditEntidadesFM").delay(3000).fadeOut(300);
return;
}

function InsertProyecto(){
  var DescProyecto=$('#DescProyecto').val();
  var idCentrodeCostosHijo = $('#idCentrodeCostosHijo').val();
  var idPrograma=$('#idPrograma').val();
   
  if (DescProyecto === "") {
    $("#msgProyectoNuevo").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> Los campos no pueden estar vacios</div>");
  } else {
    var params = {DescProyecto,idCentrodeCostosHijo,idPrograma};
    var url = "../../logica/logica.php?accion=InsertProyecto";
    $.ajax({
      url: url,
      type: 'POST',
      cache: false,
      dataType: 'json',
      data: params,
    }).done(function(result) {
      if(result == 1){
        $("#msgProyectoNuevo").html("<div class='alert alert-dismissible alert-success'>EUREKA: <strong>Editado con Exito !!</strong></div>");
        location.reload(); 
      } else if (result == 3) {
        $("#msgProyectoNuevo").html("<div class='alert alert-dismissible alert-warning'><strong>Los datos quedeseas cambiar ya existen.  Intenta nuevamente</strong></div>");
      } else {
        $("#msgProyectoNuevo").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> No se realizo ningun cambio en el programa, no hay nada que editar</div>");
      }
    });
}
$("#msgProyectoNuevo").delay(3000).fadeOut(300);
return;
}

function EditarProyectoFM(){
  var IdProyectoFM=$('#IdProyectoFM').val();
  var DescProyectoFM=$('#DescProyectoFM').val();
  var idCentrodeCostosHijoFM = $('#idCentrodeCostosHijoFM').val();
  var idProgramaFM=$('#idProgramaFM').val();
  
  if (DescProyectoFM === "") {
    $("#msgEditProyectoFM").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> Los campos no pueden estar vacios</div>");
  } else {
    var params = {IdProyectoFM,DescProyectoFM,idCentrodeCostosHijoFM,idProgramaFM};
    var url = "../../logica/logica.php?accion=EditarProyecto";
    $.ajax({
      url: url,
      type: 'POST',
      cache: false,
      dataType: 'json',
      data: params,
    }).done(function(result) {
      if(result == 1){
        $("#msgEditProyectoFM").html("<div class='alert alert-dismissible alert-success'>EUREKA: <strong>Editado con Exito !!</strong></div>");
        location.reload(); 
      } else if (result == 3) {
        $("#msgEditProyectoFM").html("<div class='alert alert-dismissible alert-warning'><strong>Los datos quedeseas cambiar ya existen.  Intenta nuevamente</strong></div>");
      } else {
        $("#msgEditProyectoFM").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> No se realizo ningun cambio en el programa, no hay nada que editar</div>");
      }
    });
}
$("#msgEditProyectoFM").delay(3000).fadeOut(300);
return;
}

function InsertDotaciones() {
  
  var DescDotaciones=$('#DescDotaciones').val();
  
  if (DescDotaciones === "") {
    $("#msgDotacionesNuevo").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> Los campos 'Nombre, Correo y Clave' son obligatorios</div>");
  } else {
    var params = {DescDotaciones};
    var url = "../../logica/logica.php?accion=InsertDotaciones";
    $.ajax({
      url: url,
      type: 'POST',
      dataType: 'json',
      data: params,
    }).done(function(result) {
      if(result == 1){
        $("#msgDotacionesNuevo").html("<div class='alert alert-dismissible alert-success'><strong>Tipo de gasto insertado Con Exito !!</strong></div>");
        location.reload(); 
      } else if (result == 3) {
        $("#msgDotacionesNuevo").html("<div class='alert alert-dismissible alert-warning'><strong>Esecoigo de tipo de gasto ya existe.</strong></div>");
      } else {
        $("#msgDotacionesNuevo").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong>No fue posible insertar el dato, por favor comuniquese con soporte tecnico.</div>");
        return;
      }
    });
  }
  $("#msgDotacionesNuevo").delay(3000).fadeOut(300);
}

function EditarDotacionesFM(){
  var IdDotacionesFM=$('#IdDotacionesFM').val();
  var descDotacionesFM = $('#descDotacionesFM').val();
  if (descDotacionesFM==="") {
    $("#msgEditDotacionesFM").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> Los campos no pueden estar vacios</div>");
  } else {
    var params = {IdDotacionesFM,descDotacionesFM};
    var url = "../../logica/logica.php?accion=EditDotaciones";
    $.ajax({
      url: url,
      type: 'POST',
      cache: false,
      dataType: 'json',
      data: params,
    }).done(function(result) {
      if(result == 1){
        $("#msgEditDotacionesFM").html("<div class='alert alert-dismissible alert-success'>EUREKA: <strong>Editado con Exito !!</strong></div>");
        location.reload(); 
      } else if (result == 3) {
        $("#msgEditDotacionesFM").html("<div class='alert alert-dismissible alert-warning'><strong>Los datos quedeseas cambiar ya existen.  Intenta nuevamente</strong></div>");
      } else {
        $("#msgEditDotacionesFM").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> No se realizo ningun cambio en el programa, no hay nada que editar</div>");
      }
    });
}
$("#msgEditDotacionesFM").delay(3000).fadeOut(300);
return;
}

function InsertFuentes() {
  var DescFuentes=$('#DescFuentes').val(); 
  if (DescFuentes === "") {
    $("#msgFuentesNuevo").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> Los campos 'Nombre, Correo y Clave' son obligatorios</div>");
  } else {
    var params = {DescFuentes};
    var url = "../../logica/logica.php?accion=InsertFuentes";
    $.ajax({
      url: url,
      type: 'POST',
      dataType: 'json',
      data: params,
    }).done(function(result) {
      if(result == 1){
        $("#msgFuentesNuevo").html("<div class='alert alert-dismissible alert-success'><strong>Tipo de gasto insertado Con Exito !!</strong></div>");
        location.reload(); 
      } else if (result == 3) {
        $("#msgFuentesNuevo").html("<div class='alert alert-dismissible alert-warning'><strong>Esecoigo de tipo de gasto ya existe.</strong></div>");
      } else {
        $("#msgFuentesNuevo").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong>No fue posible insertar el dato, por favor comuniquese con soporte tecnico.</div>");
        return;
      }
    });
  }
  $("#msgFuentesNuevo").delay(3000).fadeOut(300);
}

function EditarFuentesFM(){
  var IdFuentesFM=$('#IdFuentesFM').val();
  var descFuentesFM = $('#descFuentesFM').val();
  if (descFuentesFM==="") {
    $("#msgEditFuentesFM").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> Los campos no pueden estar vacios</div>");
  } else {
    var params = {IdFuentesFM,descFuentesFM};
    var url = "../../logica/logica.php?accion=EditFuentes";
    $.ajax({
      url: url,
      type: 'POST',
      cache: false,
      dataType: 'json',
      data: params,
    }).done(function(result) {
      if(result == 1){
        $("#msgEditFuentesFM").html("<div class='alert alert-dismissible alert-success'>EUREKA: <strong>Editado con Exito !!</strong></div>");
        location.reload(); 
      } else if (result == 3) {
        $("#msgEditFuentesFM").html("<div class='alert alert-dismissible alert-warning'><strong>Los datos quedeseas cambiar ya existen.  Intenta nuevamente</strong></div>");
      } else {
        $("#msgEditFuentesFM").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> No se realizo ningun cambio en el programa, no hay nada que editar</div>");
      }
    });
}
$("#msgEditFuentesFM").delay(3000).fadeOut(300);
return;
}

function InsertClasificacionC() {
  var DescClasificacionC=$('#DescClasificacionC').val();
  if (DescClasificacionC === "") {
    $("#msgClasificacionCNuevo").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> Los campos 'Nombre, Correo y Clave' son obligatorios</div>");
  } else {
    var params = {DescClasificacionC};
    var url = "../../logica/logica.php?accion=InsertClasificacionC";
    $.ajax({
      url: url,
      type: 'POST',
      dataType: 'json',
      data: params,
    }).done(function(result) {
      if(result == 1){
        $("#msgClasificacionCNuevo").html("<div class='alert alert-dismissible alert-success'><strong>Tipo de gasto insertado Con Exito !!</strong></div>");
        location.reload(); 
      } else if (result == 3) {
        $("#msgClasificacionCNuevo").html("<div class='alert alert-dismissible alert-warning'><strong>Esecoigo de tipo de gasto ya existe.</strong></div>");
      } else {
        $("#msgClasificacionCNuevo").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong>No fue posible insertar el dato, por favor comuniquese con soporte tecnico.</div>");
        return;
      }
    });
  }
  $("#msgClasificacionCNuevo").delay(3000).fadeOut(300);
}

function EditarClasificacionCFM(){
  var IdClasificacionCFM=$('#IdClasificacionCFM').val();
  var descClasificacionCFM = $('#descClasificacionCFM').val();
  if (descClasificacionCFM==="") {
    $("#msgEditClasificacionCFM").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> Los campos no pueden estar vacios</div>");
  } else {
    var params = {IdClasificacionCFM,descClasificacionCFM};
    var url = "../../logica/logica.php?accion=EditClasificacionC";
    $.ajax({
      url: url,
      type: 'POST',
      cache: false,
      dataType: 'json',
      data: params,
    }).done(function(result) {
      if(result == 1){
        $("#msgEditClasificacionCFM").html("<div class='alert alert-dismissible alert-success'>EUREKA: <strong>Editado con Exito !!</strong></div>");
        location.reload(); 
      } else if (result == 3) {
        $("#msgEditClasificacionCFM").html("<div class='alert alert-dismissible alert-warning'><strong>Los datos quedeseas cambiar ya existen.  Intenta nuevamente</strong></div>");
      } else {
        $("#msgEditClasificacionCFM").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> No se realizo ningun cambio en el programa, no hay nada que editar</div>");
      }
    });
}
$("#msgEditClasificacionCFM").delay(3000).fadeOut(300);
return;
}

function InsertContacto() {
  var Nombre=$('#Nombre').val();
  var idClasificacion=$('#idClasificacion').val();
  var CargoContacto=$('#CargoContacto').val();
  var TelefonoContacto=$('#TelefonoContacto').val();
  var CelularContacto=$('#CelularContacto').val();
  var emailContacto=$('#emailContacto').val();
  var idRegion=$('#idRegion').val();
  var idDepartamento=$('#idDepartamento').val();
  var idTipoMunicipio=$('#idTipoMunicipio').val();
  if (Nombre=="" && CargoContacto=="" && TelefonoContacto=="" && CelularContacto=="" && emailContacto == "") {
    $("#msgContactoNuevo").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> Los campos 'Nombre, Correo y Clave' son obligatorios</div>");
  } else {
    var params = {Nombre,idClasificacion,CargoContacto,TelefonoContacto,CelularContacto,emailContacto,idRegion,idDepartamento,idTipoMunicipio};
    var url = "../../logica/logica.php?accion=InsertContacto";
    $.ajax({
      url: url,
      type: 'POST',
      dataType: 'json',
      data: params,
    }).done(function(result) {
      if(result == 1){
        $("#msgContactoNuevo").html("<div class='alert alert-dismissible alert-success'><strong>Tipo de gasto insertado Con Exito !!</strong></div>");
        location.reload(); 
      } else if (result == 3) {
        $("#msgContactoNuevo").html("<div class='alert alert-dismissible alert-warning'><strong>Esecoigo de tipo de gasto ya existe.</strong></div>");
      } else {
        $("#msgContactoNuevo").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong>No fue posible insertar el dato, por favor comuniquese con soporte tecnico.</div>");
        return;
      }
    });
  }
  $("#msgContactoNuevo").delay(3000).fadeOut(300);
}

function EditarContactoFM(){
  var idContactoFM=$('#idContactoFM').val();
  var NombreFM=$('#NombreFM').val();
  var idClasificacionFM=$('#idClasificacionFM').val();
  var CargoContactoFM=$('#CargoContactoFM').val();
  var TelefonoContactoFM=$('#TelefonoContactoFM').val();
  var CelularContactoFM=$('#CelularContactoFM').val();
  var emailContactoFM=$('#emailContactoFM').val();
  var idRegionFM=$('#idRegionFM').val();
  var idDepartamentoFM=$('#idDepartamentoFM').val();
  var idTipoMunicipioFM=$('#idTipoMunicipioFM').val();
  if (NombreFM=="" && CargoContactoFM=="" && TelefonoContactoFM=="" && CelularContactoFM=="" && emailContactoFM == "") {
    $("#msgEditContactoFM").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> Los campos 'Nombre, Correo y Clave' son obligatorios</div>");
  } else {
    var params = {idContactoFM,NombreFM,idClasificacionFM,CargoContactoFM,TelefonoContactoFM,CelularContactoFM,emailContactoFM,idRegionFM,idDepartamentoFM,idTipoMunicipioFM};
    var url = "../../logica/logica.php?accion=EditarContacto";
    $.ajax({
      url: url,
      type: 'POST',
      dataType: 'json',
      data: params,
    }).done(function(result) {
      if(result == 1){
        $("#msgEditContactoFM").html("<div class='alert alert-dismissible alert-success'><strong>Tipo de gasto insertado Con Exito !!</strong></div>");
        location.reload(); 
      } else if (result == 3) {
        $("#msgEditContactoFM").html("<div class='alert alert-dismissible alert-warning'><strong>Esecoigo de tipo de gasto ya existe.</strong></div>");
      } else {
        $("#msgEditContactoFM").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong>No fue posible insertar el dato, por favor comuniquese con soporte tecnico.</div>");
        return;
      }
    });
  }
$("#msgEditContactoFM").delay(3000).fadeOut(300);
return;
}

// Modulo Institucion
function InsertInstitucion(){
  var CodDaneInstitucion=$('#CodDaneInstitucion').val();
  var NombreInstitucion = $('#NombreInstitucion').val();
  var idTipoInstitucion=$('#idTipoInstitucion').val();
  var idVereda=$('#idVereda').val();
  if (CodDaneInstitucion=="" && NombreInstitucion=="") {
    $("#msgInstitucionNuevo").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> Los campos no pueden estar vacios</div>");
  } else {
    var params = {CodDaneInstitucion,NombreInstitucion,idTipoInstitucion,idVereda};
    var url = "../../logica/logica.php?accion=InsertInstitucion";
    $.ajax({
      url: url,
      type: 'POST',
      cache: false,
      dataType: 'json',
      data: params,
    }).done(function(result) {
      if(result == 1){
        $("#msgInstitucionNuevo").html("<div class='alert alert-dismissible alert-success'>EUREKA: <strong>Insertado con Exito !!</strong></div>");
        location.reload(); 
      } else if (result == 3) {
        $("#msgInstitucionNuevo").html("<div class='alert alert-dismissible alert-warning'><strong>Los datos ingresados ya existen.  Intenta nuevamente</strong></div>");
      } else {
        $("#msgInstitucionNuevo").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> No se realizo ningun cambio en el programa, no hay nada que editar</div>");
      }
    });
}
$("#msgInstitucionNuevo").delay(3000).fadeOut(300);
return;
}

function EditarInstitucionFM(){
  var idInstitucionFM=$('#idInstitucionFM').val();
  var CodDaneInstitucionFM=$('#CodDaneInstitucionFM').val();
  var NombreInstitucionFM=$('#NombreInstitucionFM').val();
  var idTipoInstitucionFM=$('#idTipoInstitucionFM').val();
  var idVeredaFM=$('#idVeredaFM').val();
 
  if (CodDaneInstitucionFM=="" && NombreInstitucionFM==="") {
    $("#msgEditInstitucion").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> Los campos no pueden estar vacios</div>");
  } else {
    var params = {idInstitucionFM,CodDaneInstitucionFM,NombreInstitucionFM,idTipoInstitucionFM,idVeredaFM};
    var url = "../../logica/logica.php?accion=EditInstitucion";
    $.ajax({
      url: url,
      type: 'POST',
      cache: false,
      dataType: 'json',
      data: params,
    }).done(function(result) {
      if(result == 1){
        $("#msgEditInstitucion").html("<div class='alert alert-dismissible alert-success'>EUREKA: <strong>Editado con Exito !!</strong></div>");
        location.reload(); 
      } else if (result == 3) {
        $("#msgEditInstitucion").html("<div class='alert alert-dismissible alert-warning'><strong>Los datos quedeseas cambiar ya existen.  Intenta nuevamente</strong></div>");
      } else {
        $("#msgEditInstitucion").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> No se realizo ningun cambio en el programa, no hay nada que editar</div>");
      }
    });
}
$("#msgEditInstitucion").delay(3000).fadeOut(300);
return;
}
//Modulo departamento
function formeditdpto(datoPrograma){
  deditI=datoPrograma.split('||');
  $('#idDptoFM').val(deditI[0]);
  $('#CodDANEDptoFM').val(deditI[1]);
  $('#DescDptoFM').val(deditI[2]);
}

function EditarDpto(){
  var IdDpto=$('#idDptoFM').val();
  var codDANEDpto=$('#CodDANEDptoFM').val();
  var descDpto = $('#DescDptoFM').val();
  if (IdDpto===""||codDANEDpto==""||descDpto=="") {
    $("#msgEditDpto").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> Los campos no pueden estar vacios</div>");
  } else {
    var params = {IdDpto,codDANEDpto,descDpto};
    var url = "../../logica/logica.php?accion=EditarDpto";
    $.ajax({
      url: url,
      type: 'POST',
      cache: false,
      dataType: 'json',
      data: params,
    }).done(function(result) {
      if(result == 1){
        $("#msgEditDpto").html("<div class='alert alert-dismissible alert-success'>EUREKA: <strong>Editado con Exito !!</strong></div>");
        location.reload(); 
      } else if (result == 3) {
        $("#msgEditDpto").html("<div class='alert alert-dismissible alert-warning'><strong>Los datos quedeseas cambiar ya existen.  Intenta nuevamente</strong></div>");
      } else {
        $("#msgEditDpto").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> No se realizo ningun cambio en el programa, no hay nada que editar</div>");
      }
    });
}
$("#msgEditDpto").delay(3000).fadeOut(300);
return;
}

// Modulo de actividad -->
function InsertActividad(){
  var descripcionactividad=$('#descripcionactividad').val();
  var unidadtiempoac=$('#unidadtiempoac').val();
  if(descripcionactividad=="" || unidadtiempoac==""){
    $("#msgInsActividad").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> Los campos no pueden estar vacios</div>");
  }else{
    var parametros={descripcionactividad,unidadtiempoac};
    $.ajax({
      url: "../../logica/logica.php?accion=InsertarActividad",
      type: 'POST',
      cache: false,
      dataType: 'json',
      data: parametros,
    }).done(function(result) {
      if(result == 1){
        $("#msgInsActividad").html("<div class='alert alert-dismissible alert-success'>EUREKA: <strong>Guardado con Exito !!</strong></div>");
        location.reload(); 
      } else if (result == 3) {
        $("#msgInsActividad").html("<div class='alert alert-dismissible alert-warning'><strong>Los datos quedeseas cambiar ya existen.  Intenta nuevamente</strong></div>");
      } else {
        $("#msgInsActividad").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> No fue posible insertar el dato, por favor comuniquese con soporte tecnico.</div>");
      }
    });
  }
}

function EditarActividad(){
  var IdActividad=$('#idActividadFM').val();
  var descActividad=$('#descActividadFM').val(); 
  var unTiemActividad=$('#undTiempActividadFM').val(); 
  if (IdActividad==="" || descActividad=="" || unTiemActividad=="") {
    $("#msgEditActividad").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> Los campos no pueden estar vacios</div>");
  } else {
    var params = {IdActividad,descActividad,unTiemActividad};
    var url = "../../logica/logica.php?accion=EditarActividad";
    $.ajax({
      url: url,
      type: 'POST',
      cache: false,
      dataType: 'json',
      data: params,
    }).done(function(result) {
      if(result == 1){
        $("#msgEditActividad").html("<div class='alert alert-dismissible alert-success'>EUREKA: <strong>Editado con Exito !!</strong></div>");
        location.reload(); 
      } else if (result == 3) {
        $("#msgEditActividad").html("<div class='alert alert-dismissible alert-warning'><strong>Los datos quedeseas cambiar ya existen.  Intenta nuevamente</strong></div>");
      } else {
        $("#msgEditActividad").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> No se realizo ningun cambio en el programa, no hay nada que editar</div>");
      }
    });
}
$("#msgEditActividad").delay(3000).fadeOut(300);
return;
}

// Modulo de tipo de municipio -->
function InsertTipoMunicipio(){
  var codTipoMcpio=$('#codTipoMcpio').val();
  var descTipoMcpio=$('#descTipoMcpio').val();
  
  if(codTipoMcpio=="" || descTipoMcpio==""){
    $("#msgTipoMcpio").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> Los campos no pueden estar vacios</div>");
  }else{
    var parametros={codTipoMcpio,descTipoMcpio};
    $.ajax({
      url: "../../logica/logica.php?accion=insertarTipoMcpio",
      type: 'POST',
      cache: false,
      dataType: 'json',
      data: parametros,
    }).done(function(result) {
      if(result == 1){
        $("#msgTipoMcpio").html("<div class='alert alert-dismissible alert-success'>EUREKA: <strong>Guardado con Exito !!</strong></div>");
        location.reload(); 
      } else if (result == 3) {
        $("#msgTipoMcpio").html("<div class='alert alert-dismissible alert-warning'><strong>Los datos quedeseas cambiar ya existen.  Intenta nuevamente</strong></div>");
      } else {
        $("#msgTipoMcpio").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> No fue posible insertar el dato, por favor comuniquese con soporte tecnico.</div>");
      }
    });
  }
}

function EditarTipoMcpio(){
  var IdTipoMcpio=$('#idTipoMcpioFM').val();
  var descTipoMcpio = $('#descTipoMcpioFM').val();
  var codTipoMcpio=$('#CodTipoMcpioFM').val();
  if (IdTipoMcpio===""||descTipoMcpio=="") {
    $("#msgEditTipoMcpio").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> Los campos no pueden estar vacios</div>");
  } else {
    var params = {codTipoMcpio,IdTipoMcpio,descTipoMcpio};
    var url = "../../logica/logica.php?accion=EditarTipoMcpio";
    $.ajax({
      url: url,
      type: 'POST',
      cache: false,
      dataType: 'json',
      data: params,
    }).done(function(result) {
      if(result == 1){
        $("#msgEditTipoMcpio").html("<div class='alert alert-dismissible alert-success'>EUREKA: <strong>Editado con Exito !!</strong></div>");
        location.reload(); 
      } else if (result == 3) {
        $("#msgEditTipoMcpio").html("<div class='alert alert-dismissible alert-warning'><strong>Los datos quedeseas cambiar ya existen.  Intenta nuevamente</strong></div>");
      } else {
        $("#msgEditTipoMcpio").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> No se realizo ningun cambio en el programa, no hay nada que editar</div>");
      }
    });
}
$("#msgEditTipoMcpio").delay(3000).fadeOut(300);
return;
}

// Modulo de region municipio -->
function InsertRegion(){
  var codRegion=$('#codRegion').val();
  var descripcionRegion=$('#descripcionRegion').val();
  if(codRegion=="" || descripcionRegion==""){
    $("#msgRegion").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> Los campos no pueden estar vacios</div>");
  }else{
    var parametros={codRegion,descripcionRegion};
    $.ajax({
      url: "../../logica/logica.php?accion=InsertRegion",
      type: 'POST',
      cache: false,
      dataType: 'json',
      data: parametros,
    }).done(function(result) {
      if(result == 1){
        $("#msgRegion").html("<div class='alert alert-dismissible alert-success'>EUREKA: <strong>Guardado con Exito !!</strong></div>");
        location.reload(); 
      } else if (result == 3) {
        $("#msgRegion").html("<div class='alert alert-dismissible alert-warning'><strong>Los datos quedeseas cambiar ya existen.  Intenta nuevamente</strong></div>");
      } else {
        $("#msgRegion").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> No fue posible insertar el dato, por favor comuniquese con soporte tecnico.</div>");
      }
    });
  }
}

function EditarRegion(){
  var idRegion=$('#idRegionFM').val();
  var descRegion=$('#descRegionFM').val();
  if (descRegion===""|| idRegion=="") {
    $("#msgEditRegion").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> Los campos no pueden estar vacios</div>");
  } else {
    var params = {descRegion, idRegion};
    var url = "../../logica/logica.php?accion=EditarRegion";
    $.ajax({
      url: url,
      type: 'POST',
      cache: false,
      dataType: 'json',
      data: params,
    }).done(function(result) {
      if(result == 1){
        $("#msgEditRegion").html("<div class='alert alert-dismissible alert-success'>EUREKA: <strong>Editado con Exito !!</strong></div>");
        location.reload(); 
      } else if (result == 3) {
        $("#msgEditRegion").html("<div class='alert alert-dismissible alert-warning'><strong>Los datos quedeseas cambiar ya existen.  Intenta nuevamente</strong></div>");
      } else {
        $("#msgEditRegion").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> No se realizo ningun cambio en el programa, no hay nada que editar</div>");
      }
    });
}
$("#msgEditRegion").delay(3000).fadeOut(300);
return;
}

// Modulo de Tipo Instituciones -->
function insertarTipoInsti(){
  var descTipoInsti=$('#descTipoInsti').val();
  if(descTipoInsti==""){
    $("#msgTipoInstituc").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> Los campos no pueden estar vacios</div>");
  }else{
    var parametros={descTipoInsti};
    $.ajax({
      url: "../../logica/logica.php?accion=insertarTipoInsti",
      type: 'POST',
      cache: false,
      dataType: 'json',
      data: parametros,
    }).done(function(result) {
      if(result == 1){
        $("#msgTipoInstituc").html("<div class='alert alert-dismissible alert-success'>EUREKA: <strong>Guardado con Exito !!</strong></div>");
        location.reload(); 
      } else if (result == 3) {
        $("#msgTipoInstituc").html("<div class='alert alert-dismissible alert-warning'><strong>Los datos quedeseas cambiar ya existen.  Intenta nuevamente</strong></div>");
      } else {
        $("#msgTipoInstituc").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> No fue posible insertar el dato, por favor comuniquese con soporte tecnico.</div>");
      }
    });
  }
}

function EditarTipoInst(){
  var idTipoInst=$('#idTipoInstFM').val();
  var descTipoInst=$('#descTipoInstFM').val();
  if (idTipoInst===""|| descTipoInst=="") {
    $("#msgEditTipoInst").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> Los campos no pueden estar vacios</div>");
  } else {
    var params = {idTipoInst, descTipoInst};
    var url = "../../logica/logica.php?accion=EditarTipoInst";
    $.ajax({
      url: url,
      type: 'POST',
      cache: false,
      dataType: 'json',
      data: params,
    }).done(function(result) {
      if(result == 1){
        $("#msgEditTipoInst").html("<div class='alert alert-dismissible alert-success'>EUREKA: <strong>Editado con Exito !!</strong></div>");
        location.reload(); 
      } else if (result == 3) {
        $("#msgEditTipoInst").html("<div class='alert alert-dismissible alert-warning'><strong>Los datos quedeseas cambiar ya existen.  Intenta nuevamente</strong></div>");
      } else {
        $("#msgEditTipoInst").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> No se realizo ningun cambio en el programa, no hay nada que editar</div>");
      }
    });
}
$("#msgEditTipoInst").delay(3000).fadeOut(300);
return;
}


// Modulo de Tipo Encuesta de infraestructura -->
function insertarTipoEncInf(){
  var descTipoEncInf=$('#descTipoEncInf').val();
  if(descTipoEncInf==""){
    $("#msgTipoEncInf").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> Los campos no pueden estar vacios</div>");
  }else{
    var parametros={descTipoEncInf};
    $.ajax({
      url: "../../logica/logica.php?accion=insertarTipoEncInf",
      type: 'POST',
      cache: false,
      dataType: 'json',
      data: parametros,
    }).done(function(result) {
      if(result == 1){
        $("#msgTipoEncInf").html("<div class='alert alert-dismissible alert-success'>EUREKA: <strong>Guardado con Exito !!</strong></div>");
        location.reload(); 
      } else if (result == 3) {
        $("#msgTipoEncInf").html("<div class='alert alert-dismissible alert-warning'><strong>Los datos quedeseas cambiar ya existen.  Intenta nuevamente</strong></div>");
      } else {
        $("#msgTipoEncInf").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> No fue posible insertar el dato, por favor comuniquese con soporte tecnico.</div>");
      }
    });
  }
}

function EditarTipoEncInf(){
  var idTipoEncInf=$('#idTipoEncInfFM').val();
  var descTipoEncInf=$('#descTipoEncInfFM').val();
  if (idTipoEncInf===""|| descTipoEncInf=="") {
    $("#msgEditTipoEncInf").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> Los campos no pueden estar vacios</div>");
  } else {
    var params = {idTipoEncInf, descTipoEncInf};
    var url = "../../logica/logica.php?accion=EditarTipoEncInf";
    $.ajax({
      url: url,
      type: 'POST',
      cache: false,
      dataType: 'json',
      data: params,
    }).done(function(result) {
      if(result == 1){
        $("#msgEditTipoEncInf").html("<div class='alert alert-dismissible alert-success'>EUREKA: <strong>Editado con Exito !!</strong></div>");
        location.reload(); 
      } else if (result == 3) {
        $("#msgEditTipoEncInf").html("<div class='alert alert-dismissible alert-warning'><strong>Los datos quedeseas cambiar ya existen.  Intenta nuevamente</strong></div>");
      } else {
        $("#msgEditTipoEncInf").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> No se realizo ningun cambio en el programa, no hay nada que editar</div>");
      }
    });
}
$("#msgEditTipoEncInf").delay(3000).fadeOut(300);
return;
}

// Modulo de Procesos -->
function InsertProcesos(){
  var descProceso=$('#descProceso').val();
  if(descProceso=="" ){
    $("#msgProceso").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> Los campos no pueden estar vacios</div>");
  }else{
    var parametros={descProceso};
    $.ajax({
      url: "../../logica/logica.php?accion=InsertProcesos",
      type: 'POST',
      cache: false,
      dataType: 'json',
      data: parametros,
    }).done(function(result) {
      if(result == 1){
        $("#msgProceso").html("<div class='alert alert-dismissible alert-success'>EUREKA: <strong>Guardado con Exito !!</strong></div>");
        location.reload(); 
      } else if (result == 3) {
        $("#msgProceso").html("<div class='alert alert-dismissible alert-warning'><strong>Los datos quedeseas cambiar ya existen.  Intenta nuevamente</strong></div>");
      } else {
        $("#msgProceso").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> No fue posible insertar el dato, por favor comuniquese con soporte tecnico.</div>");
      }
    });
  }
}

function EditarProceso(){
  var idProceso=$('#idProcesoFM').val();
  var descProceso=$('#descProcesoFM').val();
  if (idProceso===""|| descProceso=="") {
    $("#msgEditProceso").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> Los campos no pueden estar vacios</div>");
  } else {
    var params = {idProceso, descProceso};
    var url = "../../logica/logica.php?accion=EditarProceso";
    $.ajax({
      url: url,
      type: 'POST',
      cache: false,
      dataType: 'json',
      data: params,
    }).done(function(result) {
      if(result == 1){
        $("#msgEditProceso").html("<div class='alert alert-dismissible alert-success'>EUREKA: <strong>Editado con Exito !!</strong></div>");
        location.reload(); 
      } else if (result == 3) {
        $("#msgEditProceso").html("<div class='alert alert-dismissible alert-warning'><strong>Los datos quedeseas cambiar ya existen.  Intenta nuevamente</strong></div>");
      } else {
        $("#msgEditProceso").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> No se realizo ningun cambio en el programa, no hay nada que editar</div>");
      }
    });
}
$("#msgEditProceso").delay(3000).fadeOut(300);
return;
}

// Modulo de Tipo de taller -->
function InsertTipoTaller(){
  var descTipoTaller=$('#descTipoTaller').val();
  var estadoTipoTaller=$('#estadoTipoTaller').val();
  if(descTipoTaller==""|| estadoTipoTaller=="" ){
    $("#msgtipotaller").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> Los campos no pueden estar vacios</div>");
  }else{
    var parametros={descTipoTaller,estadoTipoTaller};
    $.ajax({
      url: "../../logica/logica.php?accion=InsertTipoTaller",
      type: 'POST',
      cache: false,
      dataType: 'json',
      data: parametros,
    }).done(function(result) {
      if(result == 1){
        $("#msgtipotaller").html("<div class='alert alert-dismissible alert-success'>EUREKA: <strong>Guardado con Exito !!</strong></div>");
        location.reload(); 
      } else if (result == 3) {
        $("#msgtipotaller").html("<div class='alert alert-dismissible alert-warning'><strong>Los datos quedeseas cambiar ya existen.  Intenta nuevamente</strong></div>");
      } else {
        $("#msgtipotaller").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> No fue posible insertar el dato, por favor comuniquese con soporte tecnico.</div>");
      }
    });
  }
}

function EditarTipoTaller(){
  var IdTipoTaller=$('#idTipoTallerFM').val();
  var descTipoTaller=$('#descTipoTallerFM').val();
  var estadoTipoTaller = $('#estadoTipoTallerFM').val();
  if (IdTipoTaller===""||descTipoTaller==""||estadoTipoTaller=="") {
    $("#msgEditTipoTaller").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> Los campos no pueden estar vacios</div>");
  } else {
    var params = {IdTipoTaller,descTipoTaller,estadoTipoTaller};
    var url = "../../logica/logica.php?accion=EditarTipoTaller";
    $.ajax({
      url: url,
      type: 'POST',
      cache: false,
      dataType: 'json',
      data: params,
    }).done(function(result) {
      if(result == 1){
        $("#msgEditTipoTaller").html("<div class='alert alert-dismissible alert-success'>EUREKA: <strong>Editado con Exito !!</strong></div>");
        location.reload(); 
      } else if (result == 3) {
        $("#msgEditTipoTaller").html("<div class='alert alert-dismissible alert-warning'><strong>Los datos quedeseas cambiar ya existen.  Intenta nuevamente</strong></div>");
      } else {
        $("#msgEditTipoTaller").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> No se realizo ningun cambio en el programa, no hay nada que editar</div>");
      }
    });
}
$("#msgEditTipoTaller").delay(3000).fadeOut(300);
return;
}

// Modulo de Colecciones -->
function formeditColeccion(datoPrograma){
  deditI=datoPrograma.split('||');
  $('#idColeccionFM').val(deditI[0]);
  $('#descColeccionFM').val(deditI[1]);
}

function InsertColeccion(){
  var descColeccion=$('#descColeccion').val();
  var idEntColeccion=$('#idEntColeccion').val();
  if(descColeccion==""|| idEntColeccion=="" ){
    $("#msgColeccion").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> Los campos no pueden estar vacios</div>");
  }else{
    var parametros={descColeccion,idEntColeccion};
    $.ajax({
      url: "../../logica/logica.php?accion=InsertColeccion",
      type: 'POST',
      cache: false,
      dataType: 'json',
      data: parametros,
    }).done(function(result) {
      if(result == 1){
        $("#msgColeccion").html("<div class='alert alert-dismissible alert-success'>EUREKA: <strong>Guardado con Exito !!</strong></div>");
        location.reload(); 
      } else if (result == 3) {
        $("#msgColeccion").html("<div class='alert alert-dismissible alert-warning'><strong>Los datos quedeseas cambiar ya existen.  Intenta nuevamente</strong></div>");
      } else {
        $("#msgColeccion").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> No fue posible insertar el dato, por favor comuniquese con soporte tecnico.</div>");
      }
    });
  }
}

function EditarColeccion(){
  var idColeccion=$('#idColeccionFM').val();
  var DescColeccion=$('#descColeccionFM').val();
  if (idColeccion===""|| DescColeccion=="") {
    $("#msgEditColeccion").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> Los campos no pueden estar vacios</div>");
  } else {
    var params = {idColeccion, DescColeccion};
    var url = "../../logica/logica.php?accion=EditarColeccion";
    $.ajax({
      url: url,
      type: 'POST',
      cache: false,
      dataType: 'json',
      data: params,
    }).done(function(result) {
      if(result == 1){
        $("#msgEditColeccion").html("<div class='alert alert-dismissible alert-success'>EUREKA: <strong>Editado con Exito !!</strong></div>");
        location.reload(); 
      } else if (result == 3) {
        $("#msgEditColeccion").html("<div class='alert alert-dismissible alert-warning'><strong>Los datos quedeseas cambiar ya existen.  Intenta nuevamente</strong></div>");
      } else {
        $("#msgEditColeccion").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> No se realizo ningun cambio en el programa, no hay nada que editar</div>");
      }
    });
}
$("#msgEditColeccion").delay(3000).fadeOut(300);
return;
}

// Modulo de tipo Tarifa -->
function formeditTipoTarifa(datoPrograma){
  deditI=datoPrograma.split('||');
  $('#idTipoTarifaFM').val(deditI[0]);
  $('#descTipoTarifaFM').val(deditI[1]);
}

function InsertTipoTarifa(){
  var descTipoTarifa=$('#descTipoTarifa').val();
  if(descTipoTarifa==""){
    $("#msgTipoTarifa").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> Los campos no pueden estar vacios</div>");
  }else{
    var parametros={descTipoTarifa};
    $.ajax({
      url: "../../logica/logica.php?accion=InsertTipoTarifa",
      type: 'POST',
      cache: false,
      dataType: 'json',
      data: parametros,
    }).done(function(result) {
      if(result == 1){
        $("#msgTipoTarifa").html("<div class='alert alert-dismissible alert-success'>EUREKA: <strong>Guardado con Exito !!</strong></div>");
        location.reload(); 
      } else if (result == 3) {
        $("#msgTipoTarifa").html("<div class='alert alert-dismissible alert-warning'><strong>Los datos quedeseas cambiar ya existen.  Intenta nuevamente</strong></div>");
      } else {
        $("#msgTipoTarifa").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> No fue posible insertar el dato, por favor comuniquese con soporte tecnico.</div>");
      }
    });
  }
}

function EditarTipoTarifa(){
  var idTipoTarifa=$('#idTipoTarifaFM').val();
  var descTipoTarifa=$('#descTipoTarifaFM').val();
  if (idTipoTarifa===""|| descTipoTarifa=="") {
    $("#msgEditTipoTarifa").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> Los campos no pueden estar vacios</div>");
  } else {
    var params = {idTipoTarifa, descTipoTarifa};
    var url = "../../logica/logica.php?accion=EditarTipoTarifa";
    $.ajax({
      url: url,
      type: 'POST',
      cache: false,
      dataType: 'json',
      data: params,
    }).done(function(result) {
      if(result == 1){
        $("#msgEditTipoTarifa").html("<div class='alert alert-dismissible alert-success'>EUREKA: <strong>Editado con Exito !!</strong></div>");
        location.reload(); 
      } else if (result == 3) {
        $("#msgEditTipoTarifa").html("<div class='alert alert-dismissible alert-warning'><strong>Los datos quedeseas cambiar ya existen.  Intenta nuevamente</strong></div>");
      } else {
        $("#msgEditTipoTarifa").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> No se realizo ningun cambio en el programa, no hay nada que editar</div>");
      }
    });
}
$("#msgEditTipoTarifa").delay(3000).fadeOut(300);
return;
}

// Modulo de Vereda -->
function formeditVereda(datoPrograma){
  deditI=datoPrograma.split('||');
  $('#idVeredaFM').val(deditI[0]);
  $('#descVeredaFM').val(deditI[1]);
  $('#IdMcpioFM').val(deditI[2]);
}

function InsertVereda(){
  var descVereda=$('#descVereda').val();
  var IdMcpio=$('#IdMcpio').val();
  if(descVereda=="" || IdMcpio==""){
    $("#msgVereda").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> Los campos no pueden estar vacios</div>");
  }else{
    var parametros={descVereda,IdMcpio};
    $.ajax({
      url: "../../logica/logica.php?accion=InsertVereda",
      type: 'POST',
      cache: false,
      dataType: 'json',
      data: parametros,
    }).done(function(result) {
      if(result == 1){
        $("#msgTipoMcpio").html("<div class='alert alert-dismissible alert-success'>EUREKA: <strong>Guardado con Exito !!</strong></div>");
        location.reload(); 
      } else if (result == 3) {
        $("#msgTipoMcpio").html("<div class='alert alert-dismissible alert-warning'><strong>Los datos quedeseas cambiar ya existen.  Intenta nuevamente</strong></div>");
      } else {
        $("#msgTipoMcpio").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> No fue posible insertar el dato, por favor comuniquese con soporte tecnico.</div>");
      }
    });
  }
}

function EditarVereda(){
  var IdVereda=$('#idVeredaFM').val();
  var descVereda=$('#descVeredaFM').val();
  var IdMcpio=$('#IdMcpioFM').val();
  if (descVereda=="" || IdMcpio=="") {
    $("#msgEditVereda").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> Los campos no pueden estar vacios</div>");
  } else {
    var params = {IdVereda,descVereda,IdMcpio};
    var url = "../../logica/logica.php?accion=EditarVereda";
    $.ajax({
      url: url,
      type: 'POST',
      cache: false,
      dataType: 'json',
      data: params,
    }).done(function(result) {
      if(result == 1){
        $("#msgEditVereda").html("<div class='alert alert-dismissible alert-success'>EUREKA: <strong>Editado con Exito !!</strong></div>");
        location.reload(); 
      } else if (result == 3) {
        $("#msgEditVereda").html("<div class='alert alert-dismissible alert-warning'><strong>Los datos quedeseas cambiar ya existen.  Intenta nuevamente</strong></div>");
      } else {
        $("#msgEditVereda").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> No se realizo ningun cambio en el programa, no hay nada que editar</div>");
      }
    });
}
$("#msgEditVereda").delay(3000).fadeOut(300);
return;
}

// Modulo de Municipio -->
function formeditMunicipio(datoPrograma){
  deditI=datoPrograma.split('||');
  $('#IdMcpioFM').val(deditI[0]);
  $('#codDANEMcpioFM').val(deditI[1]);
  $('#descMcpioFM').val(deditI[2]);
  $("#idRegionFM option[value="+ deditI[3]+"]").attr("selected", true);
  $("#idTipoMcpioFM option[value="+ deditI[4]+"]").attr("selected", true);
  $("#idTipoTarifaFM option[value="+ deditI[5]+"]").attr("selected", true);
  $("#idDptoFM option[value="+ deditI[6]+"]").attr("selected", true);
}

function InsertMunicipio(){
  var codMunicipio=$('#codMunicipio').val();
  var descMunicipio=$('#descMunicipio').val();
  var idRegion=$('#idRegion').val();
  var idTipoMcpio=$('#idTipoMcpio').val();
  var idTipoTarifa=$('#idTipoTarifa').val();
  var idDpto=$('#idDpto').val();
  if(codMunicipio==""||descMunicipio==""||idRegion==""||idTipoMcpio==""||idTipoTarifa==""||idDpto==""){
    $("#msgMunicipio").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> Los campos no pueden estar vacios</div>");
  }else{
    var parametros={codMunicipio,descMunicipio,idRegion,idTipoMcpio,idTipoTarifa,idDpto};
    $.ajax({
      url: "../../logica/logica.php?accion=InsertMunicipio",
      type: 'POST',
      cache: false,
      dataType: 'json',
      data: parametros,
    }).done(function(result) {
      if(result == 1){
        $("#msgMunicipio").html("<div class='alert alert-dismissible alert-success'>EUREKA: <strong>Guardado con Exito !!</strong></div>");
        location.reload(); 
      } else if (result == 3) {
        $("#msgMunicipio").html("<div class='alert alert-dismissible alert-warning'><strong>Los datos quedeseas cambiar ya existen.  Intenta nuevamente</strong></div>");
      } else {
        $("#msgMunicipio").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> No fue posible insertar el dato, por favor comuniquese con soporte tecnico.</div>");
      }
    });
  }
}

function EditarMunicipio(){
  var IdMcpio=$('#IdMcpioFM').val();
  var codMunicipio=$('#codDANEMcpioFM').val();
  var descMunicipio=$('#descMcpioFM').val();
  var idRegion=$('#idRegionFM').val();
  var idTipoMcpio=$('#idTipoMcpioFM').val();
  var idTipoTarifa=$('#idTipoTarifaFM').val();
  var idDpto=$('#idDptoFM').val();

  if (codMunicipio==""||descMunicipio=="") {
    $("#msgEditMunicipio").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> Los campos no pueden estar vacios</div>");
  } else {
    var params = {IdMcpio,codMunicipio,descMunicipio,idRegion,idTipoMcpio,idTipoTarifa,idDpto};
    var url = "../../logica/logica.php?accion=EditarMunicipio";
    $.ajax({
      url: url,
      type: 'POST',
      cache: false,
      dataType: 'json',
      data: params,
    }).done(function(result) {
      if(result == 1){
        $("#msgEditMunicipio").html("<div class='alert alert-dismissible alert-success'>EUREKA: <strong>Editado con Exito !!</strong></div>");
        location.reload(); 
      } else if (result == 3) {
        $("#msgEditMunicipio").html("<div class='alert alert-dismissible alert-warning'><strong>Los datos quedeseas cambiar ya existen.  Intenta nuevamente</strong></div>");
      } else {
        $("#msgEditMunicipio").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> No se realizo ningun cambio en el programa, no hay nada que editar</div>");
      }
    });
}
$("#msgEditMunicipio").delay(3000).fadeOut(300);
return;
}

//Modulo solicitud de gasto
function guardarSolicitudGasto(){
  var IdSolicitudGastoSG=$('#IdSolicitudGastoSG').text();
  var fecha=$('#fecha').text();
  var CodProyectoSG=$('#CodProyectoSG').val();
  var CodProcesoSG=$('#CodProcesoSG').val();
  var CodActividadSG=$('#CodActividadSG').val();
  var CodMunicipioSG=$('#CodMunicipioSG').val();
  var CodEntidadSG=$('#CodEntidadSG').val();
  var FechaHoraSalidaSG=$('#FechaHoraSalidaSG').val();
  var FechaHoraRegresoSG=$('#FechaHoraRegresoSG').val();
  var responsableSG=$('#responsableSG').val();
  var CantColeccionSG=$('#CantColeccionSG').val();
  var TipoColeccionSG=$('#TipoColeccionSG').val();
  var TotalSolicitudGastoSG=$('#TotalSolicitudGastoSG').text();
  
  if (CodProyectoSG==0 || CodProcesoSG==0 || CodActividadSG==0 || CodMunicipioSG==0 || CodEntidadSG==0 || responsableSG==0 ||  FechaHoraSalidaSG==0 || FechaHoraRegresoSG==0 || CantColeccionSG==0 || TipoColeccionSG==0 || TotalSolicitudGastoSG==0) {
    $("#msgSolicitudGasto").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> Los campos no pueden estar vacios</div>");
  } else {
    var params = {IdSolicitudGastoSG,fecha,CodProyectoSG,CodProcesoSG,CodActividadSG,CodMunicipioSG,CodEntidadSG,FechaHoraSalidaSG,FechaHoraRegresoSG,responsableSG,CantColeccionSG,TipoColeccionSG,TotalSolicitudGastoSG};
    var url = "../../logica/logica.php?accion=InsertarSolicitudGasto";
    $.ajax({
      url: url,
      type: 'POST',
      cache: false,
      dataType: 'json',
      data: params,
    }).done(function(result) {
      if(result == 1){
        $("#msgSolicitudGasto").html("<div class='alert alert-dismissible alert-success'>EUREKA: <strong>Editado con Exito !!</strong></div>");
        location.reload();
      } else if (result == 3) {
        $("#msgSolicitudGasto").html("<div class='alert alert-dismissible alert-warning'><strong>Los datos quedeseas cambiar ya existen.  Intenta nuevamente</strong></div>");
      } else {
        $("#msgSolicitudGasto").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> No se realizo ningun cambio en el programa, no hay nada que editar</div>");
      }
    });
  }
  $("#msgSolicitudGasto").delay(3000).fadeOut(300);
  return;
}

function VerSolicitudGasto(datoPrograma,datoresponsables){
  var texto;  
    deditI=datoPrograma.split('||');
    $('#VerLegalizacionSG').hide();
    if (deditI[11]==0) {
      texto='<button Title="Legalizar Gasto" type="button" class="btn-default btn" onclick="LegalizarSolicitudGasto();"><span class="glyphicon glyphicon-arrow-right" style="color:green;"></span> <span style="color:green;">$</span></button>';
    } else {
      texto='<button Title="Ver Legalizacion" type="button" class="btn-default btn" onclick="ShowVerLegalizacionSolicitudGasto();"><span style="color:green;">$</span></button><button Title="Legalizar Gasto" type="button"class="btn-default btn" onclick="RelacionarSolicitudGasto();"><span class="glyphicon glyphicon-arrow-right" style="color:rgb(255, 128, 0);"></span> <span class="glyphicon glyphicon-new-window" style="color:rgb(255, 128, 0);"></span></button>';
    }

    $('#msgBotonAccionSG').html(texto);

    $('#VerIdSolicitudGastoSG').html(deditI[0]);
    $('#VerFechaSolicitudGastoSG').html(deditI[1]);

    $('#VerCodMunicipioSG option[value='+ deditI[5] +']').attr('selected',true);
    $('#VerCodMunicipioSGdiv').html($("#VerCodMunicipioSG option:selected").text());

    $('#VerCodEntidadSG option[value='+ deditI[6] +']').attr('selected',true);
    $('#VerCodEntidadSGdiv').html($("#VerCodEntidadSG option:selected").text());

    $('#VerCodProyectoSG option[value='+ deditI[2] +']').attr('selected',true);
    $('#VerCodProyectoSGdiv').html($("#VerCodProyectoSG option:selected").text());

    $('#VerCodProcesoSG option[value='+ deditI[3] +']').attr('selected',true);
    $('#VerCodProcesoSGdiv').html($("#VerCodProcesoSG option:selected").text());

    $('#VerCodActividadSG option[value='+ deditI[4] +']').attr('selected',true);
    $('#VerCodActividadSGdiv').html($("#VerCodActividadSG option:selected").text());

    $('#VerFechaHoraSalidaSGdiv').html(deditI[7]);
    $('#VerFechaHoraRegresoSGdiv').html(deditI[8]);
    
    $('#VerCantColeccionSGdiv').html(deditI[9]);
    $('#VerTipoColeccionSGdiv').html(deditI[10]);

    var totalSG=formatNumber.new(deditI[12]) ;
    $('#VerValorTotaldiv').html('$  '+ totalSG);
    
    deditR=datoresponsables.split('||');
    $('#VerresponsableSGdiv').val(deditR);
    $('#VerresponsableSGdiv').trigger('change');
    $('#VerresponsableSGdiv').select2({
      disabled: true
    });
    mostrarDetalleSG();
    mostrarLegalizacionSolicitudGasto(deditI[0]);   
}

function CargarResponsablesenSelect2(IdSG){
  var params = {IdSG};
    var url = "../../logica/logica.php?accion=CargarResponsablesSelect2";
    $.ajax({
      url: url,
      type: 'POST',
      cache: false,
      dataType: 'json',
      data: params,
    }).done(function(result) {
        $('#VerresponsableSGdiv2').val(result);
        $('#VerresponsableSGdiv2').trigger('change');
        $('#VerresponsableSGdiv2').select2({
          disabled: true
        });
    });

}

function mostrarLegalizacionSolicitudGasto(idSG){
    var params = {idSG};
    var url = "../../logica/logica.php?accion=BuscarLegalizacionSG";
    $.ajax({
      url: url,
      type: 'POST',
      cache: false,
      dataType: 'json',
      data: params,
    }).done(function(result) {
      var 
            texto='<div class="col-md-6 col-sm-6 col-xs-6">';
              texto+='<div class="panel panel-default">';
                  texto+='<divclass="panel-heading clearfix">';
                      texto+='<h3 class="panel-title">Detalle Legalizacion </h3> - # '+result[1];
                      texto='<div id="close">';
                      texto+='<button Title="Cerrar" type="button" class="btn-default btn" onclick="HideVerLegalizacionSolicitudGasto();">cerrar</button>';
                      texto+='</div>';
                  texto+='</div>';
                  texto+='<div class="panel-body">'
                    texto+='<table class="table table-hover">';
                      texto+='<tbody>';
                        texto+='<tr class="table-light">';
                          texto+='<th scope="row">Id Doc Legalizacion</th>';
                          texto+='<td><div>'+result[0]+'</div></td>';
                        texto+='</tr>';
                        texto+='<tr class="table-light">';
                          texto+='<th scope="row">Fecha Documento</th>';
                          texto+='<td><div>'+result[2]+'</div></td>';
                        texto+='</tr>';
                        texto+='<tr class="table-light">';
                          texto+='<th scope="row">Usuario</th>';
                          texto+='<td><div>'+result[3]+'</div></td>';
                        texto+='</tr>';
                        texto+='<tr class="table-light">';
                          texto+='<th scope="row">Valor Legalizado</th>';
                          texto+='<td><div>$ '+formatNumber.new(result[4])+'</div></td>';
                        texto+='</tr>';
                      texto+='</tbody>';
                    texto+='</table> ';
                  texto+='</div>';
              texto+='</div>';
          texto+='</div>';
      texto+='</div>';
      $('#VerLegalizacionSG').html(texto);
    });
}

var formatNumber = {
  separador: ",", // separador para los miles
  sepDecimal: '.', // separador para los decimales
  formatear:function (num){
  num +='';
  var splitStr = num.split('.');
  var splitLeft = splitStr[0];
  var splitRight = splitStr.length > 1 ? this.sepDecimal + splitStr[1] : '';
  var regx = /(\d+)(\d{3})/;
  while (regx.test(splitLeft)) {
  splitLeft = splitLeft.replace(regx, '$1' + this.separador + '$2');
  }
  return this.simbol + splitLeft +splitRight;
  },
  new:function(num, simbol){
  this.simbol = simbol ||'';
  return this.formatear(num);
  }
 }

function formeditTipoNovMater(datoPrograma){
  deditI=datoPrograma.split('||');
  $('#idTipoNovMaterFM').val(deditI[0]);
  $('#descTipoNovMaterFM').val(deditI[1]);
}

function InsertTipoNovedadMater(){
  var descTipoNovMater=$('#descTipoNovMater').val();
  if(descTipoNovMater==""){
    $("#msgTipoNovMater").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> Los campos no pueden estar vacios</div>");
  }else{
    var parametros={descTipoNovMater};
    $.ajax({
      url: "../../logica/logica.php?accion=InsertTipoNovedadMater",
      type: 'POST',
      cache: false,
      dataType: 'json',
      data: parametros,
    }).done(function(result) {
      if(result == 1){
        $("#msgTipoNovMater").html("<div class='alert alert-dismissible alert-success'>EUREKA: <strong>Guardado con Exito !!</strong></div>");
        location.reload(); 
      } else if (result == 3) {
        $("#msgTipoNovMater").html("<div class='alert alert-dismissible alert-warning'><strong>Los datos quedeseas cambiar ya existen.  Intenta nuevamente</strong></div>");
      } else {
        $("#msgTipoNovMater").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> No fue posible insertar el dato, por favor comuniquese con soporte tecnico.</div>");
      }
    });
  }
}

function EditarTipoNovMater(){
  var idTipoNovMater=$('#idTipoNovMaterFM').val();
  var descTipoNovMater=$('#descTipoNovMaterFM').val();
  if (idTipoNovMater===""|| descTipoNovMater=="") {
    $("#msgEditTipoNovMater").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> Los campos no pueden estar vacios</div>");
  } else {
    var params = {idTipoNovMater, descTipoNovMater};
    var url = "../../logica/logica.php?accion=EditarTipoNovMater";
    $.ajax({
      url: url,
      type: 'POST',
      cache: false,
      dataType: 'json',
      data: params,
    }).done(function(result) {
      if(result == 1){
        $("#msgEditTipoNovMater").html("<div class='alert alert-dismissible alert-success'>EUREKA: <strong>Editado con Exito !!</strong></div>");
        location.reload(); 
      } else if (result == 3) {
        $("#msgEditTipoNovMater").html("<div class='alert alert-dismissible alert-warning'><strong>Los datos quedeseas cambiar ya existen.  Intenta nuevamente</strong></div>");
      } else {
        $("#msgEditTipoNovMater").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> No se realizo ningun cambio en el programa, no hay nada que editar</div>");
      }
    });
}
$("#msgEditTipoNovMater").delay(3000).fadeOut(300);
return;
}

function MostrarSolicitudGastoxid() {
  $('#IdSolicitudGastoSG').change(function(){    
    var IdSG = $("#IdSolicitudGastoSG option:selected").val();
    var params = {IdSG};
    var url = "../../logica/logica.php?accion=getSolcitudGastoxLegalizar";
    $.ajax({
      url: url,
      type: 'POST',
      cache: false,
      dataType: 'json',
      data: params,
    }).done(function(result) {
      console.log("id:"+result[0]);
      console.log("Valor: "+result[12]);          
    });

  })
}

//Modulo legalizacion solicitud Gasto

function guardarLegalizSolicitudGasto(){
  var IdSolicitudGastoSG=$('#IdSolicitudGastoSG2').val();
  var FechaLegalizSG=$("#fecha").text();
  var responsableSG=$('#responsableSG2').val();
  var VrLegSolicGastoSG=$('#VrLegSolicGastoSG').val();
  if (IdSolicitudGastoSG==0 || FechaLegalizSG==0 || responsableSG==0||VrLegSolicGastoSG==0) {
    $("#msgLegalizSolicitudGasto").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> Los campos no pueden estar vacios</div>");
  } else {
    var params = {IdSolicitudGastoSG,FechaLegalizSG,responsableSG,VrLegSolicGastoSG};
    var url = "../../logica/logica.php?accion=InsertarLegalizSolicitudGasto";
    $.ajax({
      url: url,
      type: 'POST',
      cache: false,
      dataType: 'json',
      data: params,
    }).done(function(result) {
      if(result == 1){
        $("#msgLegalizSolicitudGasto").html("<div class='alert alert-dismissible alert-success'>EUREKA: <strong>Editado con Exito !!</strong></div>");
        location.reload();
      } else if (result == 3) {
        $("#msgLegalizSolicitudGasto").html("<div class='alert alert-dismissible alert-warning'><strong>Los datos quedeseas cambiar ya existen.  Intenta nuevamente</strong></div>");
      } else {
        $("#msgLegalizSolicitudGasto").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> No se realizo ningun cambio en el programa, no hay nada que editar</div>");
      }
    });
  }
  $("#msgLegalizSolicitudGasto").delay(3000).fadeOut(300);
  return;
}

function LegalizarSolicitudGasto(datoPrograma){
  deditI=datoPrograma.split('||'); 
  $('#NuevaLegalizSolicitudGasto').modal('show');
  $('#IdSolicitudGastoSG2 option[value='+ deditI[0] +']').attr('selected',true);
  $('#idTipoNovMaterFM').val(deditI[0]);
  $('#descTipoNovMaterFM').val(deditI[1]);
}

function formeditLegalizSolicGasto(datoPrograma){
  deditI=datoPrograma.split('||');
  $('#idLegalizFM').val(deditI[0]);
  $('#idSolicGastoFM').val(deditI[1]);
  $('#FechaLegalizFM').val(deditI[2]);
  $('#UsuarioLegFM').val(deditI[3]);
  $('#ValorLEgalizFM').val(deditI[4]);
}

function EditarLegaliz(){
  var IdLegalizacion=$('#idLegalizFM').val();
  var IdSolicitud=$('#idSolicGastoFM').val();
  var FechaLegaliz = $('#FechaLegalizFM').val();
  var usuarioLegaliz=$('#UsuarioLegFM').val();
  var valorLegaliz = $('#ValorLEgalizFM').val();
  if (valorLegaliz==="") {
    $("#msgLegalizEdit").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> Los campos no pueden estar vacios</div>");
  } else {
    var params = {IdLegalizacion,IdSolicitud,FechaLegaliz,usuarioLegaliz,valorLegaliz};
    var url = "../../logica/logica.php?accion=EditarLegalizacion";
    $.ajax({
      url: url,
      type: 'POST',
      cache: false,
      dataType: 'json',
      data: params,
    }).done(function(result) {
      if(result == 1){
        $("#msgLegalizEdit").html("<div class='alert alert-dismissible alert-success'>EUREKA: <strong>Editado con Exito !!</strong></div>");
        location.reload(); 
      } else if (result == 3) {
        $("#msgLegalizEdit").html("<div class='alert alert-dismissible alert-warning'><strong>Los datos quedeseas cambiar ya existen.  Intenta nuevamente</strong></div>");
      } else {
        $("#msgLegalizEdit").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> No se realizo ningun cambio en el programa, no hay nada que editar</div>");
      }
    });
}
$("#msgLegalizEdit").delay(3000).fadeOut(300);
return;
}

function mostrarCABSG(IdSG,IdRG) {
  var parametros={IdSG};
  $("#CabSG").show();
  $.ajax({
      url:'../../logica/logica.php?accion=ListarCABSG',
      type: "POST",
      data: parametros,
      cache: false,
      dataType: 'json',
      beforeSend: function(objeto){
        $('#CabSG').html('Cargando...');
      },
      success: function(data){
          $().html();
          texto=`<div class="table-responsive">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <h2 class="panel-title"><b>Relacion de Gastos - #  <div id="IdRG">`+IdRG+`</div></b></h2> 
                        Solicitud de Gasto: <label id="IdSG">`+data[0]+`</label> - Fecha elaboracion: `+data[1]+` - Usuario creacion: ?? 
                    </div>
                    <div class="panel-body">
                        <div class="row col-md-6 col-sm-6">
                            <table class="table table-hover">
                                <tbody>
                                    <tr class="table-light">
                                        <th scope="row" style="width:100px">Municipio</th>
                                        <td><div name="VerCodMunicipioSGdiv" id="VerCodMunicipioSGdiv">`+data[13]+`</div></td>
                                    </tr>                                 
                                    <tr class="table-light">
                                        <th scope="row">Entidades</th>
                                        <td><div name="VerCodEntidadSGdiv" id="VerCodEntidadSGdiv">`+data[14]+`</div></td>
                                    </tr>
                                    <tr class="table-light">
                                        <th scope="row">Proyecto</th>
                                        <td><div name="VerCodProyectoSGdiv" id="VerCodProyectoSGdiv">`+data[15]+`</div></td>
                                    </tr>
                                    <tr class="table-light">
                                        <th scope="row">Proceso</th>
                                        <td><div name="VerCodProcesoSGdiv" id="VerCodProcesoSGdiv">`+data[16]+`</div></td>
                                    </tr>
                                    <tr class="table-light">
                                        <th scope="row">Actividad</th>
                                        <td><div name="VerCodActividadSGdiv" id="VerCodActividadSGdiv">`+data[17]+`</div></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row col-md-6 col-sm-6">
                            <table class="table table-hover">
                                <tbody>
                                    <tr class="table-light">
                                        <th scope="row" style="width:170px">Fecha/Hora Salida</th>
                                        <td><div name="VerFechaHoraSalidaSGdiv" id="VerFechaHoraSalidaSGdiv">`+data[7]+`</div></td>
                                    </tr>
                                    <tr class="table-light">
                                        <th scope="row">Fecha/Hora Regreso</th>
                                        <td><div name="VerFechaHoraRegresoSGdiv" id="VerFechaHoraRegresoSGdiv">`+data[8]+`</div></td>
                                    </tr>
                                    <tr class="table-light">
                                        <th scope="row">Cant Colección</th>
                                        <td><div name="VerCantColeccionSGdiv" id="VerCantColeccionSGdiv">`+data[9]+`</div></td>
                                    </tr>
                                    <tr class="table-light">
                                        <th scope="row">Tipo Colección</th>
                                        <td><div name="VerTipoColeccionSGdiv" id="VerTipoColeccionSGdiv"></div>`+data[10]+`</td>
                                    </tr>
                                    <tr class="table-light">
                                        <th scope="row">Valor Legalizado</th>
                                        <td><div name="VerTipoColeccionSGdiv" id="VerTipoColeccionSGdiv"></div> $ `+formatNumber.new(data[18])+`</td>
                                    </tr>       
                                </tbody>
                            </table> 
                        </div>
                    </div>
                </div>
            </div>
        </div>`;
        $('#CabSG').html(texto);
      }
  });
}

function upload_image(IdRG,IdDetalleSG){
  $(".upload-msg").text('Cargando...');
  var inputFileImage = document.getElementById("fileToUpload");
  var file = inputFileImage.files[0];
  var data = new FormData();
  var parametros={data,IdRG,IdDetalleSG};
  data.append('fileToUpload',file);
  $.ajax({
    url: "../../logica/logica.php?accion=uploadimagen",        
    type: "POST",             
    data: parametros, 			  
    contentType: false,       
    cache: false,             
    processData:false,       
    success: function(data)
    {
      $(".upload-msg").html(data);
      window.setTimeout(function() {
      $(".alert-dismissible").fadeTo(500, 0).slideUp(500, function(){
      $(this).remove();
      });	}, 5000);
    }
  });
}

function guardarNuevaRelacionSG(IdSG) {
  var IdSG=IdSG;
  var UsuarioRelacionGastos=$('#VerresponsableSGdiv').val();
  var ObservacionesRelacionGasto=$('#ObservacioneRelacionSGdiv').val();
  var FechaRelacionGastos=$('#fecha').text();

  var inputFileImage = document.getElementById("fileToUpload");
  var file = inputFileImage.files[0];
  var data = new FormData();
  data.append('fileToUpload',file);
  
  var parametros={data,IdSG,FechaRelacionGastos,UsuarioRelacionGastos,ObservacionesRelacionGasto};
    $.ajax({
      url:'../../logica/logica.php?accion=GuardarRelacionSG',
      type: "POST",
      data: parametros,
      cache: false,
      dataType: 'json',     
        success: function(data)
        {
          $('#DocumentoSG').show();
          mostrarDetalleSGRelacion(IdSG);
          mostrarCABSG(IdSG,data);
          CargarResponsablesenSelect2(IdSG);
          $('#ConceptoGastoRelacion').html(data);
        }
      });
  }

  function mostrarDetalleSGRelacion(IdSG) {
    var parametros={IdSG};
    $.ajax({
        url:'../../logica/logica.php?accion=ListarDetalleSGRelacion',
        type: "POST",
        data: parametros,
        beforeSend: function(objeto){
     $('#ListaDetalleSGRelacion').html('Cargando...');
  },success: function(data){
    console.log(data);
            $("#ListaDetalleSGRelacion").html(data).fadeIn('slow');
    }
    });
}

function ResumenenModalRelacion(NombreConcepto,valordias,valorconcepto){
  var dato;
  dato=`
  <table class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
      <th>Nombre Concepto</th>
      <th>Dias</th>
      <th>Valor Concepto</th>
      <th>Total</th>
    </thead>
    <tbody>
      <tr class="odd gradeX">
        <td>`+NombreConcepto+`</td>
        <td class="text-center">`+valordias+`</td>
        <td  class="text-right"> $`+formatNumber.new(valorconcepto)+`</td>
        <td  class="text-right"> $`+formatNumber.new(valordias*valorconcepto)+`</td>
      </tr>
    </tbody>
  </table>
  `;

  $('#ResumenSG').html(dato);
}

function GuardarDetalleRelacion() { 
var IdRG=$('#IdRG').text();
var IdDetalleSG=$('#IdDetalleSG').text();
var NitBeneficiario=$('#NitBeneficiario').val();
var NombreBeneficiario=$('#NombreBeneficiario').val();
var NumeroFactura=$('#NumeroFactura').val();
var ValorFactura=$('#ValorFactura').val();
var PagoTCD=$('#PagoTCD').val();
var Observaciones=$('#Observaciones').val();
var fileToUpload=$('#fileToUpload').val();
upload_image(IdRG,IdDetalleSG);
if (NitBeneficiario=="" || NombreBeneficiario=="" || NumeroFactura=="" || ValorFactura=="" || Observaciones=="" || fileToUpload=="") {
  $("#msgRelacionSolicitudGasto").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> Los campos no pueden estar vacios</div>");
} else {
    if (PagoTCD=='on') {
      PagoTCD=1;
    }else{
      PagoTCD=0;
    }
  var parametros={IdRG,IdDetalleSG,NitBeneficiario,NombreBeneficiario,NumeroFactura,ValorFactura,PagoTCD,Observaciones,fileToUpload};
  console.log(parametros);
  $.ajax({
    url:'../../logica/logica.php?accion=GuardarDetalleRelacion',
    type: "POST",
    data: parametros
    ,success: function(data){
  console.log(data);
        $("#ListaDetalleSGRelacion").html(data).fadeIn('slow');
  }
  });
}
$("#msgRelacionSolicitudGasto").delay(3000).fadeOut(300);
  return;
}

function mostrarCABSGLegaliz(IdSG) {
  var parametros={IdSG};
  $("#CabSG").show();
  console.log(parametros);
  $.ajax({
      url:'../../logica/logica.php?accion=ListarCABSG',
      type: "POST",
      data: parametros,
      cache: false,
      dataType: 'json',
      success: function(data){
          texto=`<div class="table-responsive">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
            
                        Solicitud de Gasto: <label id="IdSG">`+data[0]+`</label> - Fecha elaboracion: `+data[1]+` - Usuario creacion: ?? 
                    </div>
                    <div class="panel-body">
                        <div class="row col-md-6 col-sm-6">
                            <table class="table table-hover">
                                <tbody>
                                    <tr class="table-light">
                                        <th scope="row" style="width:100px">Municipio</th>
                                        <td><div name="VerCodMunicipioSGdiv" id="VerCodMunicipioSGdiv">`+data[13]+`</div></td>
                                    </tr>                                 
                                    <tr class="table-light">
                                        <th scope="row">Entidades</th>
                                        <td><div name="VerCodEntidadSGdiv" id="VerCodEntidadSGdiv">`+data[14]+`</div></td>
                                    </tr>
                                    <tr class="table-light">
                                        <th scope="row">Proyecto</th>
                                        <td><div name="VerCodProyectoSGdiv" id="VerCodProyectoSGdiv">`+data[15]+`</div></td>
                                    </tr>
                                    <tr class="table-light">
                                        <th scope="row">Proceso</th>
                                        <td><div name="VerCodProcesoSGdiv" id="VerCodProcesoSGdiv">`+data[16]+`</div></td>
                                    </tr>
                                    <tr class="table-light">
                                        <th scope="row">Actividad</th>
                                        <td><div name="VerCodActividadSGdiv" id="VerCodActividadSGdiv">`+data[17]+`</div></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="row col-md-6 col-sm-6">
                            <table class="table table-hover">
                                <tbody>
                                    <tr class="table-light">
                                        <th scope="row" style="width:170px">Fecha/Hora Salida</th>
                                        <td><div name="VerFechaHoraSalidaSGdiv" id="VerFechaHoraSalidaSGdiv">`+data[7]+`</div></td>
                                    </tr>
                                    <tr class="table-light">
                                        <th scope="row">Fecha/Hora Regreso</th>
                                        <td><div name="VerFechaHoraRegresoSGdiv" id="VerFechaHoraRegresoSGdiv">`+data[8]+`</div></td>
                                    </tr>
                                    <tr class="table-light">
                                        <th scope="row">Cant Colección</th>
                                        <td><div name="VerCantColeccionSGdiv" id="VerCantColeccionSGdiv">`+data[9]+`</div></td>
                                    </tr>
                                    <tr class="table-light">
                                        <th scope="row">Tipo Colección</th>
                                        <td><div name="VerTipoColeccionSGdiv" id="VerTipoColeccionSGdiv"></div>`+data[10]+`</td>
                                    </tr>
                                    <tr class="table-light">
                                        <th scope="row">Valor Legalizado</th>
                                        <td><div name="VerTipoColeccionSGdiv" id="VerTipoColeccionSGdiv"></div> $ `+formatNumber.new(data[12])+`</td>
                                    </tr>       
                                </tbody>
                            </table> 
                        </div>
                    </div>
                </div>
            </div>
        </div>`;
        $('#CabSG').html(texto);
      }
  });
}

// Modulo de Alumno -->
function formeditAlumno(datoPrograma){
  deditI=datoPrograma.split('||');
  $('#IdAlumnoFM').val(deditI[0]);
  $('#codAlumnoFM').val(deditI[1]);
  $('#descAlumnoFM').val(deditI[2]);
  $('#estadoFM').val(deditI[3]);
  $('#edadFM').val(deditI[4]);
  $("#IdInstitucFM option[value="+ deditI[5]+"]").attr("selected", true);

}

function InsertAlumno(){
  var codAlumno=$('#codAlumno').val();
  var descAlumno=$('#descAlumno').val();
  var estado=$('#estado').val();
  var edad=$('#edad').val();
  var IdInstituc=$('#IdInstitucion').val();
  if(codAlumno==""||descAlumno==""||estado==""||edad==""||IdInstituc==""){
    $("#msgEmpleado").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> Los campos no pueden estar vacios</div>");
  }else{
    var parametros={codAlumno,descAlumno,estado,edad,IdInstituc};
    $.ajax({
      url: "../../logica/logica.php?accion=InsertAlumno",
      type: 'POST',
      cache: false,
      dataType: 'json',
      data: parametros,
    }).done(function(result) {
      if(result == 1){
        $("#msgAlumno").html("<div class='alert alert-dismissible alert-success'>EUREKA: <strong>Guardado con Exito !!</strong></div>");
        location.reload(); 
      } else if (result == 3) {
        $("#msgAlumno").html("<div class='alert alert-dismissible alert-warning'><strong>Los datos quedeseas cambiar ya existen.  Intenta nuevamente</strong></div>");
      } else {
        $("#msgAlumno").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> No fue posible insertar el dato, por favor comuniquese con soporte tecnico.</div>");
      }
    });
  }
}

function EditarAlumno(){
  var IdAlumno=$('#IdAlumnoFM').val();
  var codAlumno=$('#codAlumnoFM').val();
  var nombAlumno=$('#descAlumnoFM').val();
  var estAlumno=$('#estadoFM').val();
  var edadAlumno=$('#edadFM').val();
  var idInstitucion=$('#IdInstitucFM').val();

  if (codAlumno==""||nombAlumno==""||estAlumno==""||edadAlumno==""||idInstitucion=="") {
    $("#msgEditAlumno").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> Los campos no pueden estar vacios</div>");
  } else {
    var params = {IdAlumno,codAlumno,nombAlumno,estAlumno,edadAlumno,idInstitucion};
    var url = "../../logica/logica.php?accion=EditarAlumno";
    $.ajax({
      url: url,
      type: 'POST',
      cache: false,
      dataType: 'json',
      data: params,
    }).done(function(result) {
      if(result == 1){
        $("#msgEditAlumno").html("<div class='alert alert-dismissible alert-success'>EUREKA: <strong>Editado con Exito !!</strong></div>");
        location.reload(); 
      } else if (result == 3) {
        $("#msgEditAlumno").html("<div class='alert alert-dismissible alert-warning'><strong>Los datos quedeseas cambiar ya existen.  Intenta nuevamente</strong></div>");
      } else {
        $("#msgEditAlumno").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> No se realizo ningun cambio en el programa, no hay nada que editar</div>");
      }
    });
}
$("#msgEditAlumno").delay(3000).fadeOut(300);
return;
}

// Modulo de Empleado -->
function formeditEmpleado(datoPrograma){
  deditI=datoPrograma.split('||');
  $('#IdEmpleadoFM').val(deditI[0]);
  $('#DocEmpleadoFM').val(deditI[1]);
  $('#nomEmpleadoFM').val(deditI[2]);
  $('#telEmpleadoFM').val(deditI[3]);
  $('#cargoEmplFM').val(deditI[4]);
  $("#idAreaFM option[value="+ deditI[5]+"]").attr("selected", true);
  $('#estadoEmpleFM').val(deditI[6]);
  $("#idUsuarioEmplFM option[value="+ deditI[7]+"]").attr("selected", true);
}

function InsertEmpleado(){
  var DocEmpleado=$('#DocEmpleado').val();
  var nomEmpleado=$('#nomEmpleado').val();
  var telEmpleado=$('#telEmpleado').val();
  var cargoEmpl=$('#cargoEmpl').val();
  var idArea=$('#idArea').val();
  var estadoEmple=$('#estadoEmple').val();
  var idUsuarioEmpl=$('#idUsuarioEmpl').val();
  if(DocEmpleado==""||nomEmpleado==""||telEmpleado==""||cargoEmpl==""||idArea==""||estadoEmple==""||idUsuarioEmpl==""){
    $("#msgEmpleado").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> Los campos no pueden estar vacios</div>");
  }else{
    var parametros={DocEmpleado,nomEmpleado,telEmpleado,cargoEmpl,idArea,estadoEmple,idUsuarioEmpl};
    $.ajax({
      url: "../../logica/logica.php?accion=InsertEmpleado",
      type: 'POST',
      cache: false,
      dataType: 'json',
      data: parametros,
    }).done(function(result) {
      if(result == 1){
        $("#msgEmpleado").html("<div class='alert alert-dismissible alert-success'>EUREKA: <strong>Guardado con Exito !!</strong></div>");
        location.reload(); 
      } else if (result == 3) {
        $("#msgEmpleado").html("<div class='alert alert-dismissible alert-warning'><strong>Los datos quedeseas cambiar ya existen.  Intenta nuevamente</strong></div>");
      } else {
        $("#msgEmpleado").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> No fue posible insertar el dato, por favor comuniquese con soporte tecnico.</div>");
      }
    });
  }
}

function EditarEmpleado(){
  var idEmpleado=$('#IdEmpleadoFM').val();
  var DocEmpleado=$('#DocEmpleadoFM').val();
  var nomEmpleado=$('#nomEmpleadoFM').val();
  var telEmpleado=$('#telEmpleadoFM').val();
  var cargoEmpl=$('#cargoEmplFM').val();
  var idArea=$('#idAreaFM').val();
  var estadoEmple=$('#estadoEmpleFM').val();
  var idUsuarioEmpl=$('#idUsuarioEmplFM').val();

  if(DocEmpleado==""||nomEmpleado==""||telEmpleado==""||cargoEmpl==""||idArea==""||estadoEmple==""||idUsuarioEmpl==""){
    $("#msgEditEmpleado").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> Los campos no pueden estar vacios</div>");
  } else {
    var params = {idEmpleado,DocEmpleado,nomEmpleado,telEmpleado,cargoEmpl,idArea,estadoEmple,idUsuarioEmpl};
    var url = "../../logica/logica.php?accion=EditarEmpleado";
    $.ajax({
      url: url,
      type: 'POST',
      cache: false,
      dataType: 'json',
      data: params,
    }).done(function(result) {
      if(result == 1){
        $("#msgEditEmpleado").html("<div class='alert alert-dismissible alert-success'>EUREKA: <strong>Editado con Exito !!</strong></div>");
        location.reload(); 
      } else if (result == 3) {
        $("#msgEditEmpleado").html("<div class='alert alert-dismissible alert-warning'><strong>Los datos quedeseas cambiar ya existen.  Intenta nuevamente</strong></div>");
      } else {
        $("#msgEditEmpleado").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> No se realizo ningun cambio en el programa, no hay nada que editar</div>");
      }
    });
}
$("#msgEditEmpleado").delay(3000).fadeOut(300);
return;
}

//Modulo de Area
function InsertArea(){
  var descArea=$('#descArea').val();
  var estadoarea=$('#estadoarea').val();
  if(descArea=="" || estadoarea==""){
    $("#msgArea").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> Los campos no pueden estar vacios</div>");
  }else{
    var parametros={descArea,estadoarea};
    $.ajax({
      url: "../../logica/logica.php?accion=InsertArea",
      type: 'POST',
      cache: false,
      dataType: 'json',
      data: parametros,
    }).done(function(result) {
      if(result == 1){
        $("#msgArea").html("<div class='alert alert-dismissible alert-success'>EUREKA: <strong>Guardado con Exito !!</strong></div>");
        location.reload(); 
      } else if (result == 3) {
        $("#msgArea").html("<div class='alert alert-dismissible alert-warning'><strong>Los datos quedeseas cambiar ya existen.  Intenta nuevamente</strong></div>");
      } else {
        $("#msgArea").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> No fue posible insertar el dato, por favor comuniquese con soporte tecnico.</div>");
      }
    });
  }
}

function formeditArea(datoPrograma){
  deditI=datoPrograma.split('||');
  $('#IdAreaFM').val(deditI[0]);
  $('#desAreaFM').val(deditI[1]);
  $('#estadoAreaFM').val(deditI[2]);
}

function EditarArea(){
  var idArea=$('#idAreaFM').val();
  var desArea=$('#desAreaFM').val();
  var estadoArea=$('#estadoAreaFM').val();
  if (desArea===""|| estadoArea=="") {
    $("#msgEditArea").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> Los campos no pueden estar vacios</div>");
  } else {
    var params = {idArea,desArea,estadoArea};
    var url = "../../logica/logica.php?accion=EditarArea";
    $.ajax({
      url: url,
      type: 'POST',
      cache: false,
      dataType: 'json',
      data: params,
    }).done(function(result) {
      if(result == 1){
        $("#msgEditArea").html("<div class='alert alert-dismissible alert-success'>EUREKA: <strong>Editado con Exito !!</strong></div>");
        location.reload(); 
      } else if (result == 3) {
        $("#msgEditArea").html("<div class='alert alert-dismissible alert-warning'><strong>Los datos quedeseas cambiar ya existen.  Intenta nuevamente</strong></div>");
      } else {
        $("#msgEditArea").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> No se realizo ningun cambio en el programa, no hay nada que editar</div>");
      }
    });
}
$("#msgEditArea").delay(3000).fadeOut(300);
return;
}

//Modulo entrega de anteojos
function insertEntrega(datoPrograma){
  deditI=datoPrograma.split('||');
  $('#MunicipioIn').val(deditI[3]);
}

function guardarEntregaAnteojos(){
  var IdResponsableEntr=$('#IdResponsableEntr').val();
  var idVdaBenef=$('#idVdaBenef').val();
  var mcpioEntrega=$('#Municipio').val();
  var fechaEntrega=$('#fechaEntrega').val();
  var beneficiario=$('#beneficiario').val();
  var telBeneficiario=$('#telBeneficiario').val();
  var correoBeneficiario=$('#correoBeneficiario').val();
  var personaRecibe=$('#personaRecibe').val();
  var tipoAnteojos=$('#tipoAnteojos').val();
  
  if (IdResponsableEntr==0 || idVdaBenef==0 || mcpioEntrega==0 || fechaEntrega==0 || beneficiario==0 || telBeneficiario==0 ||  correoBeneficiario==0 || personaRecibe==0 || tipoAnteojos==0) {
    $("#msgEntregaAnteojos").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> Los campos no pueden estar vacios</div>");
  } else {
    var params = {IdResponsableEntr,idVdaBenef,mcpioEntrega,fechaEntrega,beneficiario,telBeneficiario,correoBeneficiario,personaRecibe,tipoAnteojos};
    var url = "../../logica/logica.php?accion=InsertEntregaAnteojos";
    $.ajax({
      url: url,
      type: 'POST',
      cache: false,
      dataType: 'json',
      data: params,
    }).done(function(result) {
      if(result == 1){
        $("#msgEntregaAnteojos").html("<div class='alert alert-dismissible alert-success'>EUREKA: <strong>Editado con Exito !!</strong></div>");
        location.reload();
      } else if (result == 3) {
        $("#msgEntregaAnteojos").html("<div class='alert alert-dismissible alert-warning'><strong>Los datos quedeseas cambiar ya existen.  Intenta nuevamente</strong></div>");
      } else {
        $("#msgEntregaAnteojos").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> No se realizo ningun cambio en el programa, no hay nada que editar</div>");
      }
    });
  }
  $("#msgEntregaAnteojos").delay(3000).fadeOut(300);
  return;
}

function formatEditarEntrega(datoPrograma){
  deditI=datoPrograma.split('||');
  $('#IdEntregaFM').val(deditI[0]);
  $('#IdResponsableFM').val(deditI[1]);
  $('#idVdaBenefFM').val(deditI[2]);
  $('#MunicipioFM').val(deditI[3]);
  $('#fechaEntregaFM').val(deditI[4]);
  $('#beneficiarioFM').val(deditI[5]);
  $('#telBeneficiarioFM').val(deditI[6]);
  $('#correoBeneficiarioFM').val(deditI[7]);
  $('#personaRecibeFM').val(deditI[8]);
  $('#tipoAnteojosFM').val(deditI[9]);
}

function EditarEntrega(){
  var idEntrega=$('#IdEntregaFM').val();
  var IdResponsableEntr=$('#IdResponsableFM').val();
  var idVdaBenef=$('#idVdaBenefFM').val();
  var mcpioEntrega=$('#MunicipioFM').val();
  var fechaEntrega=$('#fechaEntregaFM').val();
  var beneficiario=$('#beneficiarioFM').val();
  var telBeneficiario=$('#telBeneficiarioFM').val();
  var correoBeneficiario=$('#correoBeneficiarioFM').val();
  var personaRecibe=$('#personaRecibeFM').val();
  var tipoAnteojos=$('#tipoAnteojosFM').val();
  if (IdResponsableEntr===""|| idVdaBenef==""||mcpioEntrega==""||fechaEntrega==""||beneficiario==""||telBeneficiario==""||correoBeneficiario==""||personaRecibe==""||tipoAnteojos=="") {
    $("#msgEditEntrega").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> Los campos no pueden estar vacios</div>");
  } else {
    var params = {idEntrega,IdResponsableEntr,idVdaBenef,mcpioEntrega,fechaEntrega,beneficiario,telBeneficiario,correoBeneficiario,personaRecibe,tipoAnteojos};
    var url = "../../logica/logica.php?accion=EditarEntrega";
    $.ajax({
      url: url,
      type: 'POST',
      cache: false,
      dataType: 'json',
      data: params,
    }).done(function(result) {
      if(result == 1){
        $("#msgEditEntrega").html("<div class='alert alert-dismissible alert-success'>EUREKA: <strong>Editado con Exito !!</strong></div>");
        location.reload(); 
      } else if (result == 3) {
        $("#msgEditEntrega").html("<div class='alert alert-dismissible alert-warning'><strong>Los datos quedeseas cambiar ya existen.  Intenta nuevamente</strong></div>");
      } else {
        $("#msgEditEntrega").html("<div class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> No se realizo ningun cambio en el programa, no hay nada que editar</div>");
      }
    });
}
$("#msgEditEntrega").delay(3000).fadeOut(300);
return;
}