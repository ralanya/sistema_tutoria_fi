<?php
include("../../pages/conexion.php");


$txtIdLogro = $_GET['txtIdLogro'];
$txtIdEstudiante = $_GET['txtIdEstudiante'];

	$sql = "UPDATE logro SET EstLog = '0'
			WHERE IdLogro = '$txtIdLogro'";
	$fila = mysqli_query($cn,$sql);

	header('location:../../pages/reporte_logro.php?txtIdEstudiante='.$txtIdEstudiante.'');


?>