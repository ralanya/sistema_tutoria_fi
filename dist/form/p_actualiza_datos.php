<?php
include("../../pages/conexion.php");
include 'sed.php';
$txtContrasena = utf8_decode($_POST['txtContrasena']);
$txtIdPersonal = $_POST['txtIdPersonal'];
if($txtContrasena==""){
	echo "Por favor ingrese la contraseña";
}
else{
	$txtContrasena = SED::encryption($txtContrasena);
	$sql = "UPDATE personal
			SET ContraPers = '$txtContrasena'							
			WHERE IdPersonal = '$txtIdPersonal'";
	$fila = mysqli_query($cn,$sql);

	if($fila == true){
	echo "Datos Actualizados";	
	}
	else{
	echo 'Error en el Guardado';
	}
}
	


?>