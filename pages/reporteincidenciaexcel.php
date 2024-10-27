<?php
$fecha=date("d-m-Y");

  header("Content-type: application/vnd.ms-excel");
  header("Content-Disposition: attachment; filename=ReporteIncidencia (".$fecha.").xls");
  
  include("conexion.php");	
  include("auth.php");

  if(isset ($_POST['txtFIniEst2']) && ($_POST['txtFFinEst2']))
  {
    $FIniEst = $_POST["txtFIniEst2"];
    list($anio1,$mes1,$dia1) = explode("-",$FIniEst);
    $FFinEst = $_POST["txtFFinEst2"];
    list($anio2,$mes2,$dia2) = explode("-",$FFinEst);

    $sql=mysqli_query($cn,"SELECT * FROM estudiante e, incidencia i, personal p, tipo_incidencia ti
            WHERE e.IdEstudiante = i.IdEstudiante AND i.IdPersonal = p.IdPersonal AND i.IdTipoIncid = ti.IdTipoIncid AND EstIncid = '1'
            AND i.FechaIncid BETWEEN '$FIniEst' AND '$FFinEst'");
    
    $FIniEst = $dia1."/".$mes1."/".$anio1;
    $FFinEst = $dia2."/".$mes2."/".$anio2;
  }
  else
  {
    $FIniEst = '1111-01-01';
    $FFinEst = '9999-12-30';

    $sql=mysqli_query($cn,"SELECT * FROM estudiante e, incidencia i, personal p, tipo_incidencia ti
            WHERE e.IdEstudiante = i.IdEstudiante AND i.IdPersonal = p.IdPersonal AND i.IdTipoIncid = ti.IdTipoIncid
            AND i.FechaIncid BETWEEN '$FIniEst' AND '$FFinEst'");
    
    $FIniEst = '__/__/____';
    $FFinEst = '__/__/____';

  }


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
<title>REPORTE INCIDENCIA</title>
</head>
<body>
<CENTER><h3 style="font-family:Verdana"><strong>LISTA DE INCIDENCIAS DE ESTUDIANTES</strong></h3></CENTER>
<p style="font-family:verdana"><?php echo 'Desde: '.$FIniEst.' - Hasta: '.$FFinEst; ?></p>
 
<table width="100%" border="1" bordercolor="black" cellspacing="0" cellpadding="0" style="text-align:center;">
  
  <tr style="padding:5px 5px 5px 5px; font-size:12px; background:black; color:white;">
    <td><strong>DNI EST</strong></td>
    <td><strong>ESTUDIANTE</strong></td>    
    <td><strong>GRADO Y SECCION</strong></td>
    <td><strong>INCIDENCIA</strong>
    <td><strong>DESCRIPCIÓN</strong></td>
    <td><strong>TIPO</strong>
    <td><strong>DNI PERS</strong></td>
    <td><strong>PERSONAL</strong></td>    
    <td><strong>FECHA</strong></td>
  </tr>
  
<?php
while($res=mysqli_fetch_array($sql)){
  $FInci = $res["FechaIncid"];
  list($anio,$mes,$dia) = explode("-",$FInci);
  $FInci  = $dia."/".$mes."/".$anio;   
  $Tipo = $res["InfoIncid"];
  if($Tipo=="C"){$Tipo="Cotidiano"; } else{$Tipo="Específico";}
?>  
 <tr style="padding:5px 5px 5px 5px; font-size:12px; font-family:Arial;">
  <td><?php echo $res["DniEst"]; ?></td>
	<td><?php echo utf8_encode($res["ApelEst"]).', '.utf8_encode($res["NombEst"]) ?></td>
  <td><?php echo $res["GSEst"]; ?></td>
  <td><?php echo utf8_encode($res["NombTipoIncid"]) ?></td>
  <td><?php echo utf8_encode($res["DescIncid"]) ?></td>
  <td><?php echo $Tipo; ?></td>
  <td><?php echo $res["DniPers"]; ?></td>
	<td><?php echo utf8_encode($res["ApelPers"]).', '.utf8_encode($res["NombPers"]) ?></td>	   
  <td><?php echo $FInci ?></td>                
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
<p style="text-align:center; font-family:Arial; color:gray;">Desarrollado por: RacSolutions</p>
</body>
</html>
