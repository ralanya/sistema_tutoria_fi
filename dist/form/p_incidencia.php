<?php
include("../../pages/conexion.php");

$IdDocente = $_POST['txtIdDocente'];
$IdPersona = $_POST['txtIdPersona'];
$IdEstudiante = $_POST['txtIdEstudiante'];
$Incidencia = utf8_decode($_POST['txtIncidencia']);
$Observacion = utf8_decode($_POST['txtObservacion']);
$fecha = $_POST['fechaactual'];
$Tipo = $_POST['btnradio'];

if(isset($_POST["txtMotivo"])){
	$txtMotivo = $_POST["txtMotivo"];
}
else{
	$txtMotivo = "";
}

$cod_inci = "select max(IdIncidencia) as id from incidencia";
$r = mysqli_query($cn,$cod_inci);
if($row=mysqli_fetch_row($r)){
	$id = trim($row[0]+1);
}

if($Incidencia=="")
{
	echo "Por favor describa la incidencia";
}
else if($IdPersona=="")
{
	echo "Por favor seleccione al personal que reporta el caso";
}
else
{
	date_default_timezone_set('America/Lima');  
		        $horareg = date("H:i:s A");

	$sql = ("INSERT INTO incidencia(IdIncidencia,FechaIncid,HoraIncid,DescIncid,ObsIncid,InfoIncid,EstIncid,OtroIncid,IdPersona,IdEstudiante,IdPersonal) 
	VALUES('$id','$fecha','$horareg','$Incidencia','$Observacion','$Tipo','1','$txtMotivo','$IdPersona','$IdEstudiante','$IdDocente')");
	$fila = mysqli_query($cn,$sql);

	
	foreach($_POST['tipoderiva'] as $idtipoderiva){ 
		$cod_detalle_inci = "select max(IdDetalleIncidencia) as id from detalle_incidencia";
		$r2 = mysqli_query($cn,$cod_detalle_inci);
		if($row2=mysqli_fetch_row($r2)){
			$id2 = trim($row2[0]+1);
		}

		$cod_inci2 = "select max(IdIncidencia) as id from incidencia";
		$r3 = mysqli_query($cn,$cod_inci2);
		if($row3=mysqli_fetch_row($r3)){
			$id3 = trim($row3[0]);
		}

	    $sqlTipoDeriva = mysqli_query($cn,"INSERT INTO detalle_incidencia VALUES ('$id2','$id3','$idtipoderiva')");
	}

	if($fila == true){
		echo "Incidencia Guardado Correctamente";
	}
	else{
		echo 'Error en el Guardado';
	}
}


?>