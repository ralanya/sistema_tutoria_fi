<?php
include("../../pages/conexion.php");

$txtIdLogro = $_POST['txtIdLogro'];
$txtIdEstudiante = $_POST['txtIdEstudiante'];
$txtLogro = utf8_decode($_POST['txtLogro']);
$txtObservacion = utf8_decode($_POST['txtObservacion']);

if($txtLogro==""){
	echo "Por favor ingrese el logro";
}
else{
	$sql = "UPDATE logro
			SET DescLog = '$txtLogro',
				ObsLog = '$txtObservacion'				
			WHERE IdLogro = '$txtIdLogro'";
	$fila = mysqli_query($cn,$sql);

	if($fila == true){
	echo "Datos Actualizados Correctamente";	
	}
	else{
	echo 'Error en el Guardado';
	}
}
	


?>