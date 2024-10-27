<?php
include("../../pages/conexion.php");

$IdDocente = $_POST['txtIdDocente'];
$IdEstudiante = $_POST['txtIdEstudiante'];
$Descripcion = utf8_decode($_POST['txtDescripcion']);
$Observacion = utf8_decode($_POST['txtObservacion']);
$fecha = date("Y-m-d");

$cod_inci = "select max(IdLogro) as id from logro";
$r = mysqli_query($cn,$cod_inci);
if($row=mysqli_fetch_row($r)){
	$id = trim($row[0]+1);
}

if($Descripcion=="")
{
	echo "Por favor describa el logro";
}
else
{
	date_default_timezone_set('America/Lima');  
		        $horareg = date("H:i:s A");

	$sql = ("INSERT INTO logro
	VALUES('$id','$fecha','$horareg','$Descripcion','$Observacion','1','$IdEstudiante','$IdDocente')");
	$fila = mysqli_query($cn,$sql);

	if($fila == true){
		echo "Logro Guardado Correctamente";
	}
	else{
		echo 'Error en el Guardado';
	}
}


?>