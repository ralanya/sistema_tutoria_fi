<?php
include("../../pages/conexion.php");


$txtIdIncidencia = $_GET['txtIdIncidencia'];
$txtIdEstudiante = $_GET['txtIdEstudiante'];

	$sql = "UPDATE incidencia SET EstIncid = '0'
			WHERE IdIncidencia = '$txtIdIncidencia'";
	$fila = mysqli_query($cn,$sql);

	header('location:../../pages/reporte_academico.php?txtIdEstudiante='.$txtIdEstudiante.'');


?>