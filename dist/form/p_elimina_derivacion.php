<?php
include("../../pages/conexion.php");


$txtIdDerivacion = $_GET['txtIdDerivacion'];

	$sql = "UPDATE derivacion SET EstDeri = '0'
			WHERE IdDerivacion = '$txtIdDerivacion'";
	$fila = mysqli_query($cn,$sql);

	header('location:../../pages/derivacion.php');


?>