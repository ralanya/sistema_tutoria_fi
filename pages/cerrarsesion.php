<?php
	include("auth.php");
  include("conexion.php");
  $DniPers=$_SESSION["usuario"];

  $sql="select * from personal p, tipo_personal tp where p.IdTipoPers = tp.IdTipoPers and DniPers='$DniPers'";
  $fila=mysqli_query($cn,$sql);
  $r=mysqli_fetch_array($fila);
  $IdPersonal = $r["IdPersonal"];
				//bitacora
		        $codBita = "select max(IdBitacora) as id from bitacora";
		        $rBita = mysqli_query($cn,$codBita);
		        if($row=mysqli_fetch_row($rBita)){
		          $id = trim($row[0]+1);
		        }
		        $IdPersonal = $r["IdPersonal"];
		        $fbita = date("Y-m-d");
		        date_default_timezone_set('America/Lima');  
		        $hbita = date("H:i:s");
		        $sqlBitacora = mysqli_query($cn,"INSERT INTO bitacora VALUES('$id','$fbita','$hbita','SALIDA DEL SISTEMA','$IdPersonal')");	
session_start();
session_destroy();		        
header('location: login');

?>