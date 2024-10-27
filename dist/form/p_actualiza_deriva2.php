<?php
include("../../pages/conexion.php");

$IdDerivacion = $_POST['txtIdDerivacion'];
$IdPersonal = $_POST['txtIdPersonal'];
$IdEstudiante = $_POST['txtIdEstudiante'];
$motivo = utf8_decode($_POST["txtMotiDeri"]);
$acciones = utf8_decode($_POST["txtAcciRea"]);
//$Cantidad = $_POST['txtCantidad'];
if($motivo==""){
	echo "Por favor ingrese el motivo de la derivación";
}
else if($acciones==""){
	echo "Por favor ingrese las acciones ya realizadas";
}
else{	
	$sql = ("UPDATE derivacion 
		SET IdPersona = '1',
			DescDeri = '$motivo',
			AcreDeri = '$acciones',
			TipoDeri = '2'
		WHERE IdDerivacion =  '$IdDerivacion'");
	$fila = mysqli_query($cn,$sql);

	if($fila == true){
		echo "Se actualizó correctamente";
	}
	else{
		echo 'Error en el Guardado';
	}
}
?>