<?php
include("../../pages/conexion.php");

$IdDerivacion = $_POST['txtIdDerivacion'];

$Psicologo = $_POST['lstPsicologo'];

$motivo = utf8_decode($_POST["txtMotiDeri"]);
$acciones = utf8_decode($_POST["txtAcciRea"]);

if($motivo==""){
	echo "Por favor ingrese el motivo de la derivación";
}
else if($acciones==""){
	echo "Por favor ingrese las acciones ya realizadas";
}
else if($Psicologo=="NA"){
	echo "No ha seleccionado un psicólogo(a)";
}
else
{
	$fecha = date("Y-m-d");
	$codDeri = "select max(IdDerivacion) as id from derivacion";
	$r = mysqli_query($cn,$codDeri);
	if($row=mysqli_fetch_row($r)){
		$id = trim($row[0]+1);
	}
	date_default_timezone_set('America/Lima');  
		        $horareg = date("H:i:s A");

	$sql = ("UPDATE derivacion 
		SET IdPersona = '$Psicologo', 
			DescDeri = '$motivo',
			AcreDeri = '$acciones',
			TipoDeri = '1'
	WHERE IdDerivacion = '$IdDerivacion'");
	$fila = mysqli_query($cn,$sql);

	if($fila == true)
	{
		echo "Se actualizó correctamente";
	}
	else
	{
		echo 'Error en el Guardado';
	}	
}
?>