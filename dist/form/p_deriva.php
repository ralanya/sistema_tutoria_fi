<?php
include("../../pages/conexion.php");

$IdPersonal = $_POST['txtIdPersonal'];
$IdEstudiante = $_POST['txtIdEstudiante'];
//$Cantidad = $_POST['txtCantidad'];
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
	$fecha = $_POST['fechaactual'];
	$codDeri = "select max(IdDerivacion) as id from derivacion";
	$r = mysqli_query($cn,$codDeri);
	if($row=mysqli_fetch_row($r)){
		$id = trim($row[0]+1);
	}
	date_default_timezone_set('America/Lima');  
		        $horareg = date("H:i:s A");

	$sql = ("INSERT INTO derivacion(IdDerivacion,IdEstudiante,IdPersonal,IdPersona,DescDeri,AcreDeri,FechDeri,HoraDeri,TipoDeri,AteDeri,EstDeri) 
	VALUES('$id','$IdEstudiante','$IdPersonal','$Psicologo','$motivo','$acciones','$fecha','$horareg','1','0','1')");
	$fila = mysqli_query($cn,$sql);

	if($fila == true)
	{
		echo "La derivación a psicología se realizó correctamente";
	}
	else
	{
		echo 'Error en el Guardado';
	}	
}
?>