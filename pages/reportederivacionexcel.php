<?php
$fecha=date("d-m-Y");

  header("Content-type: application/vnd.ms-excel");
  header("Content-Disposition: attachment; filename=ReporteDerivacion (".$fecha.").xls");
  
  include("conexion.php");	

  if(isset ($_GET['fini']) && ($_GET['ffin']))
  {
    $FIniEst = $_GET["fini"];
    list($anio1,$mes1,$dia1) = explode("-",$FIniEst);
    $FFinEst = $_GET["ffin"];
    list($anio2,$mes2,$dia2) = explode("-",$FFinEst);

    $sql=mysqli_query($cn,"SELECT * FROM derivacion d, estudiante e, personal p 
    WHERE d.IdEstudiante = e.IdEstudiante AND d.IdPersonal = p.IdPersonal AND d.FechDeri BETWEEN '$FIniEst' AND '$FFinEst' AND EstDeri = '1' ORDER BY FechDeri DESC");
    
    $FIniEst = $dia1."/".$mes1."/".$anio1;
    $FFinEst = $dia2."/".$mes2."/".$anio2;
  }
  else
  {
    $FIniEst = '1111-01-01';
    $FFinEst = '9999-12-30';

    $sql=mysqli_query($cn,"SELECT * FROM derivacion d, estudiante e, personal p 
    WHERE d.IdEstudiante = e.IdEstudiante AND d.IdPersonal = p.IdPersonal AND d.FechDeri BETWEEN '$FIniEst' AND '$FFinEst' AND EstDeri = '1' ORDER BY FechDeri DESC");
    
    $FIniEst = '__/__/____';
    $FFinEst = '__/__/____';

  }


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
<title>REPORTE DERIVACION</title>
</head>
<body>
<CENTER><h3 style="font-family:Verdana"><strong>LISTA DE ESTUDIANTES DERIVADOS</strong></h3></CENTER>
<p style="font-family:verdana"><?php echo 'Desde: '.$FIniEst.' - Hasta: '.$FFinEst; ?></p>
 
<table width="100%" border="1" bordercolor="black" cellspacing="0" cellpadding="0" style="text-align:center;">
  
  <tr style="padding:5px 5px 5px 5px; font-size:12px; background:black; color:white;">
    <td><strong>DNI EST</strong></td>
    <td><strong>ESTUDIANTE</strong></td>
    <td><strong>GRADO Y SECCION</strong></td>
    <td><strong>DNI PERS</strong></td>
    <td><strong>PERSONAL</strong></td>
    <td><strong>ESTADO</strong></td>
    <td><strong>ÁREA</strong></td>
    <td><strong>FECHA</strong></td>
  </tr>
  
<?php
while($res=mysqli_fetch_array($sql)){
  $FDeri = $res["FechDeri"];
  list($anio,$mes,$dia) = explode("-",$FDeri);
  $FDeri  = $dia."/".$mes."/".$anio;   
  if($res["AteDeri"] =="0"){ $Atencion = "NO ATENDIDO";} else{ $Atencion = "ATENDIDO";}
  if($res["TipoDeri"] == 1){ $Area = "PSICOLOGÍA";} else{ $Area = "DIRECCIÓN"; }
?>  
 <tr style="padding:5px 5px 5px 5px; font-size:12px; font-family:Arial;">
  <td><?php echo $res["DniEst"]; ?></td>
	<td><?php echo utf8_encode($res["ApelEst"]).', '.utf8_encode($res["NombEst"]) ?></td>
  <td><?php echo $res["GSEst"]; ?></td>
  <td><?php echo $res["DniPers"]; ?></td>
	<td><?php echo utf8_encode($res["ApelPers"]).', '.utf8_encode($res["NombPers"]) ?></td>
	<td><?php echo $Atencion; ?></td> 
  <td><?php echo $Area; ?></td>   
  <td><?php echo $FDeri ?></td>                
 </tr> 
  <?php
}
  ?>
</table><br>
<?php
$fecha = date('Y/m/d');

$fecha2 = date('l', strtotime($fecha));
$dia = date('d', strtotime($fecha));

$fecha3 = explode("/",$fecha);
$dia = $fecha3[2];
$mes = $fecha3[1];
$anio = $fecha3[0];
switch ($mes) {
  case '01':    $nomMes = "Enero";    break;
  case '02':    $nomMes = "Febrero";    break;
  case '03':    $nomMes = "Marzo";    break;
  case '04':    $nomMes = "Abril";    break;
  case '05':    $nomMes = "Mayo";    break;
  case '06':    $nomMes = "Junio";    break;
  case '07':    $nomMes = "Julio";    break;
  case '08':    $nomMes = "Agosto";    break;
  case '09':    $nomMes = "Setiembre";    break;
  case '10':    $nomMes = "Octubre";    break;
  case '11':    $nomMes = "Noviembre";    break;
  case '12':    $nomMes = "Diciembre";    break;
  
}
?>
<p style="text-align:right; font-family:Arial"><?php echo "Satipo, ".$dia." de ".$nomMes." del ".$anio.""; ?></p>
<br><br>
<p style="text-align:center; font-family:Arial; color:gray;">Desarrollado por: RacEngineers</p>
</body>
</html>
