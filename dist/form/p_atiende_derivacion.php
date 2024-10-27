<?php
include("../../pages/conexion.php");

$txtIdDerivacion = $_GET['txtIdDerivacion'];
$sqlBuscaDerivacion = mysqli_query($cn,"SELECT * FROM derivacion d, estudiante e WHERE d.IdEstudiante = e.IdEstudiante AND IdDerivacion = '$txtIdDerivacion'");
$rBuscaDerivacion = mysqli_fetch_array($sqlBuscaDerivacion);
$Estado = $rBuscaDerivacion["AteDeri"];
$ApellidoEst = $rBuscaDerivacion["ApelEst"];
if($txtIdDerivacion==""){
	echo "Por favor mande el ID de la derivación";
}
else if($Estado == "0"){
	$sql = "UPDATE derivacion
			SET AteDeri = '1'				
			WHERE IdDerivacion = '$txtIdDerivacion'";
	$fila = mysqli_query($cn,$sql);

	if($fila == true){
	header("location: ../../pages/derivacion.php");
	//echo "LA DERIVACIÓN DE ".$ApellidoEst." FUE ATENDIDA";	
	}
	else{
	echo 'Error en el Guardado';
	}
}
else{
	$sql = "UPDATE derivacion
			SET AteDeri = '0'				
			WHERE IdDerivacion = '$txtIdDerivacion'";
	$fila = mysqli_query($cn,$sql);

	if($fila == true){
	header("location: ../../pages/derivacion.php");
	//echo "LA DERIVACIÓN DE ".$ApellidoEst." NO FUE ATENDIDA";	
	}
	else{
	echo 'Error en el Guardado';
	}
}
	


?>