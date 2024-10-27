<?php
include("../../pages/conexion.php");
$iddetalle=$_POST['txtIdDetalle'];
$idest = $_POST['txtIdEstudiante'];
if($iddetalle!=""){
	$txtCQV = utf8_decode($_POST['txtCQV']);
	$txtSacra = utf8_decode($_POST['txtSacra']);
	$txtAyudaTarea = utf8_decode($_POST['txtAyudaTarea']);
	$txtCantHerm = $_POST['txtCantHerm'];
	$txtLugarHerm = $_POST['txtLugarHerm'];
	$txtHermCole = $_POST['txtHermCole'];
	$txtProce = utf8_decode($_POST['txtProce']);
	$txtCasa = $_POST['txtCasa'];
	$txtPadreCas = $_POST['txtPadreCas'];
	$txtVioleFP = $_POST['txtVioleFP'];
	$txtPadreV = $_POST['txtPadreV'];
	$txtProfPadre = utf8_decode($_POST['txtProfPadre']);
	$txtTrabPadre = utf8_decode($_POST['txtTrabPadre']);
	$txtMadreV = $_POST['txtMadreV'];
	$txtProfMadre = utf8_decode($_POST['txtProfMadre']);
	$txtTrabMadre = utf8_decode($_POST['txtTrabMadre']);
	$txtIdDetalle = $_POST['txtIdDetalle'];

		$sql = "UPDATE detalle_estudiante 
				SET CQVEst = '$txtCQV',
					SacraEst = '$txtSacra',
					PadreVEst = '$txtPadreV',
					ProfPadreEst = '$txtProfPadre',
					TrabPadreEst = '$txtTrabPadre',
					MadreVEst = '$txtMadreV',
					ProfMadreEst = '$txtProfMadre',
					TrabMadreEst = '$txtTrabMadre',
					AyudaTareaEst = '$txtAyudaTarea',
					CantHermEst = '$txtCantHerm',
					LugarHermEst = '$txtLugarHerm',
					HermColeEst = '$txtHermCole',
					ProceEst = '$txtProce',
					CasaEst = '$txtCasa',
					PadreCasEst = '$txtPadreCas',
					VioleFPEst = '$txtVioleFP'
				WHERE IdDetalleEst = '$txtIdDetalle'";
		$fila = mysqli_query($cn,$sql);	

		if($fila == true)
		{
			echo "Datos Actualizados Correctamente";
		}
		else
		{
			echo 'Error en el Guardado';
		}
}
else{
	$txtCQV = utf8_decode($_POST['txtCQV']);
	$txtSacra = utf8_decode($_POST['txtSacra']);
	$txtAyudaTarea = utf8_decode($_POST['txtAyudaTarea']);
	$txtCantHerm = $_POST['txtCantHerm'];
	$txtLugarHerm = $_POST['txtLugarHerm'];
	$txtHermCole = $_POST['txtHermCole'];
	$txtProce = utf8_decode($_POST['txtProce']);
	$txtCasa = $_POST['txtCasa'];
	$txtPadreCas = $_POST['txtPadreCas'];
	$txtVioleFP = $_POST['txtVioleFP'];
	$txtPadreV = $_POST['txtPadreV'];
	$txtProfPadre = utf8_decode($_POST['txtProfPadre']);
	$txtTrabPadre = utf8_decode($_POST['txtTrabPadre']);
	$txtMadreV = $_POST['txtMadreV'];
	$txtProfMadre = utf8_decode($_POST['txtProfMadre']);
	$txtTrabMadre = utf8_decode($_POST['txtTrabMadre']);
	
	$codDeri = "select max(IdDetalleEst) as id from detalle_estudiante";
	$r = mysqli_query($cn,$codDeri);
	if($row=mysqli_fetch_row($r)){
		$txtIdDetalle = trim($row[0]+1);
	}

	$sql = "INSERT INTO detalle_estudiante 
				VALUES('$txtIdDetalle','$txtCQV','$txtSacra','$txtPadreV','$txtProfPadre','$txtTrabPadre','$txtMadreV','$txtProfMadre','$txtTrabMadre','$txtAyudaTarea','$txtCantHerm','$txtLugarHerm','$txtHermCole','$txtProce','$txtCasa','$txtPadreCas','$txtVioleFP')";
		$fila = mysqli_query($cn,$sql);	
	$sql2 = mysqli_query($cn,"UPDATE estudiante SET IdDetalleEst = '$txtIdDetalle' WHERE IdEstudiante = '$idest'");

		if($fila == true)
		{
			echo "Datos Actualizados Correctamente";;
		}
		else
		{
			echo 'Error en el Guardado';
		}
}
	
	


?>