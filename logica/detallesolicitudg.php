<?php
$action = $_GET['action'];
if($action == 'ajax'){
	setlocale(LC_MONETARY, 'es_CO');
	require_once("../modulos/conn_BD.php");
	require_once("../modulos/solicitud_gastos/class/ClassSolicitudGastos.php");
	$InstanciaDB=new Conexion();
	$IntDetalleSolicitud=new Proceso_SolicitudGastos($InstanciaDB);

	if (isset($_REQUEST['id'])){
		$id=intval($_REQUEST['id']);
		$delete=$IntDetalleSolicitud->borrarlineadetalleTMP($id);
	}
	
	if (isset($_POST['NumeroDias']) && isset($_POST['ValorGasto'])){
		 $ConsecutivoSolcicitudG=intval($_POST['num']);
		 $IdConceptoGasto=$_POST['ConceptoGasto'];
		 $NumDias=$_POST['NumeroDias'];
		 $ValorSolicitud=str_replace(',','',$_POST['ValorGasto']);
		 $InsertarTPMDetalle=$IntDetalleSolicitud->InsertarDetalleTMP($ConsecutivoSolcicitudG,$IdConceptoGasto,$NumDias,$ValorSolicitud);
	}
	
	$query=$IntDetalleSolicitud->listardetalleTMP();
	$items=1;
	$suma=0;
	while($rowTMP=$query->fetch_array()){
		?>
			<tr>
				<td class='text-center'><?php echo $items;?></td>
				
				<td><?php echo $IntDetalleSolicitud->getnombreconceptoGasto($rowTMP['TMP_IdConceptoSolicitudGastos']);?></td>
				<td class='text-center'><?php echo $rowTMP['TMP_NumDisSolicitudGastos'];?></td>
				<td class='text-right'><?php echo '$ '.number_format($rowTMP['TMP_ValorundSolicitudGastos']);?></td>
				<td class='text-right'><a href="#" onclick="eliminar_item('<?php echo $rowTMP['idTMP_DetalleSolicitudGastos']; ?>')" ><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAMAAAAoLQ9TAAAAeFBMVEUAAADnTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDx+VWpeAAAAJ3RSTlMAAQIFCAkPERQYGi40TVRVVlhZaHR8g4WPl5qdtb7Hys7R19rr7e97kMnEAAAAaklEQVQYV7XOSQKCMBQE0UpQwfkrSJwCKmDf/4YuVOIF7F29VQOA897xs50k1aknmnmfPRfvWptdBjOz29Vs46B6aFx/cEBIEAEIamhWc3EcIRKXhQj/hX47nGvt7x8o07ETANP2210OvABwcxH233o1TgAAAABJRU5ErkJggg=="></a></td>
			</tr>	
				<?php
				$items++;
				$suma+=$rowTMP['TMP_ValorundSolicitudGastos'];
			}
		?>
		<tr>
			<td colspan='6'>		
				<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#InsertarConceptoGasto"><span class="glyphicon glyphicon-plus"></span> Agregar gastos</button>
			</td>
		</tr>
		<tr>
			<td colspan='4' class='text-right'>
				<h4>TOTAL</h4>
			</td>
			<th class='text-right'>
				<h4><?php echo '$ '.number_format($suma);?></h4>
			</th>
			<td></td>
		</tr>
<?php

}