<?php
include("conexion.php");
$tam = 9;
for ($i; $i<$tam;$i++)
{
	$codDeri = "select max(IdDetalleAula) as id from detalle_aula";
	$r = mysqli_query($cn,$codDeri);
	if($row=mysqli_fetch_row($r)){
		$id = trim($row[0]+1);
	}
	//id
	$idDetalle = $id;
	$codDeri2 = "select IdAula from detalle_aula where IdDetalleAula = '$idDetalle'";
	$r2 = mysqli_query($cn,$codDeri2);
	if($row2=mysqli_fetch_row($r2)){
		$id2 = trim($row2[0]+1);
	}

	$sql = mysqli_query($cn,"INSERT INTO detalle_aula VALUES('$id','$id2','28')"); 	
}
?>