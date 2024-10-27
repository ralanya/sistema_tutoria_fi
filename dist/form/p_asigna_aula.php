<?php
include("../../pages/conexion.php");

$IdAula = $_POST['lstGS'];
$IdPersonal = $_POST['lstPersonal'];

	$cod_inci = "select max(IdDetalleAula) as id from detalle_aula";
	$r = mysqli_query($cn,$cod_inci);
	if($row=mysqli_fetch_row($r)){
		$id = trim($row[0]+1);
	}
	
		$buscaAula = mysqli_query($cn,"SELECT * FROM detalle_aula WHERE IdAula='$IdAula'");
		$numAula = mysqli_num_rows($buscaAula);
		//if($numAula>=1){
			$sql = ("INSERT INTO detalle_aula
			VALUES('$id','$IdAula','$IdPersonal')");
			$fila = mysqli_query($cn,$sql);

			if($fila == true){
				echo "Asignación Guardada Correctamente";
			}
			else{
				echo 'Error en el Guardado';
			}	
		//}
		//else{
			//echo "El aula ya fue asignado a un auxiliar";
		//}	
?>