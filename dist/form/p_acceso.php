<?php
include("../../pages/conexion.php");
include 'sed.php';
if(isset($_POST["txtDNI"]) && isset($_POST["txtPassword"])){
	session_start();
	$dni=$_POST["txtDNI"];	
	$contra=$_POST["txtPassword"];	
	$contra = SED::encryption($contra);
	
		$sql = mysqli_query($cn,"SELECT * FROM personal where DniPers='$dni' and ContraPers = '$contra' and EstPers = '1'");
		$r = mysqli_fetch_array($sql);
		$total = mysqli_num_rows($sql);	

		if($total==0)
		{
		    echo "Datos Incorrectos";
		}
		else
		{
			
		    if($r["DniPers"] == $dni AND $r["ContraPers"] == $contra)
		    {				
				$_SESSION["usuario"]=$dni;
		        $_SESSION["auth"]=1;
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
		        $sqlBitacora = mysqli_query($cn,"INSERT INTO bitacora VALUES('$id','$fbita','$hbita','ACCESO AL SISTEMA','$IdPersonal')");		        
				echo "Datos Correctos";				
			}
			else
		    {
		      echo "Datos Incorrectos";
		    }
		}	
}
?>