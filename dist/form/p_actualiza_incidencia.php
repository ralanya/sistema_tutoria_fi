<?php
include("../../pages/conexion.php");

$txtDescripcion = utf8_decode($_POST['txtDescripcion']);
$txtIdIncidencia = $_POST['txtIdIncidencia'];
$txtIdEstudiante = $_POST['txtIdEstudiante'];
$txtPersona = utf8_decode($_POST['txtIdPersona']);
$Observacion = utf8_decode($_POST['txtObservacion']);
$Tipo = $_POST['btnradio'];
if(isset($_POST["chkMotivo"])){
	$TipoMotivo = $_POST["chkMotivo"];
}
else{
	$TipoMotivo = "2";
}

if($TipoMotivo == "1"){
	$txtMotivo = $_POST["txtMotivo"];	
}
else{
	if(isset($_POST["txtMotivo"]))
	{
		$txtMotivo = $_POST["txtMotivo"];
	}
	else{
		$txtMotivo = "";
	}
}



if($txtDescripcion==""){
	echo "Por favor ingrese la descripción";
}
else if($txtPersona=="")
{
	echo "Por favor seleccione al personal";
}
else{
	$sql = "UPDATE incidencia
			SET DescIncid = '$txtDescripcion',
				IdPersona = '$txtPersona',
				ObsIncid = '$Observacion',
				InfoIncid = '$Tipo',
				OtroIncid = '$txtMotivo'			
			WHERE IdIncidencia = '$txtIdIncidencia'";
	$fila = mysqli_query($cn,$sql);
	$sql_elimina = mysqli_query($cn,"DELETE FROM detalle_incidencia WHERE IdIncidencia = '$txtIdIncidencia'");

	if(empty($_POST['tipoderiva1'])) {
	//Vacio
	}
	else{
		foreach($_POST['tipoderiva1'] as $idtipoderiva){ 
			$cod_detalle_inci = "select max(IdDetalleIncidencia) as id from detalle_incidencia";
			$r2 = mysqli_query($cn,$cod_detalle_inci);
			if($row2=mysqli_fetch_row($r2)){
				$id2 = trim($row2[0]+1);
			}
		    $sqlTipoDeriva = mysqli_query($cn,"INSERT INTO detalle_incidencia VALUES ('$id2','$txtIdIncidencia','$idtipoderiva')");
		}
	}
	if(empty($_POST['tipoderiva2'])) {
	//Está vació
	} else {
		foreach($_POST['tipoderiva2'] as $idtipoderiva2){ 
			$cod_detalle_inci = "select max(IdDetalleIncidencia) as id from detalle_incidencia";
			$r3 = mysqli_query($cn,$cod_detalle_inci);
			if($row3=mysqli_fetch_row($r3)){
				$id3 = trim($row3[0]+1);
			}
		    $sqlTipoDeriva = mysqli_query($cn,"INSERT INTO detalle_incidencia VALUES ('$id3','$txtIdIncidencia','$idtipoderiva2')");
		}
	}

	if($fila == true){
	echo "Incidencia Actualizada Correctamente";
	}
	else{
	echo 'Error en el Guardado';
	}
}
	


?>