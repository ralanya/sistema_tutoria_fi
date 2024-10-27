<?php
$fecha=date("d-m-Y");
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment; filename=ReporteIncidenciaGS (".$fecha.").doc");

include("auth.php");
include("conexion.php");

  $DniPers=$_SESSION["usuario"];

  $sql="select * from personal p, tipo_personal tp where p.IdTipoPers = tp.IdTipoPers and DniPers='$DniPers'";
  $fila=mysqli_query($cn,$sql);
  $r=mysqli_fetch_array($fila);
  $IdTipo = $r["IdTipoPers"];
  if($IdTipo==5){     $IdTipo="('C')";   }   else {    $IdTipo="('C','D')";  }

  $GSEst = $_GET["opcion"];
                
  if(isset ($_GET['fini']) && ($_GET['ffin']))
  {
    $FIniEst = $_GET["fini"];
    list($anio1,$mes1,$dia1) = explode("-",$FIniEst);
    $FFinEst = $_GET["ffin"];
    list($anio2,$mes2,$dia2) = explode("-",$FFinEst);
    if($GSEst=="Todos"){ 
      $sql2 = "SELECT * FROM estudiante e, incidencia i, tipo_incidencia ti 
            WHERE e.IdEstudiante = i.IdEstudiante AND i.IdTipoIncid = ti.IdTipoIncid AND EstIncid = '1'
            AND i.FechaIncid BETWEEN '$FIniEst' AND '$FFinEst' AND i.InfoIncid IN $IdTipo ORDER BY i.IdIncidencia DESC";
    }
    else{
      $sql2 = "SELECT * FROM estudiante e, incidencia i, tipo_incidencia ti 
            WHERE e.IdEstudiante = i.IdEstudiante AND i.IdTipoIncid = ti.IdTipoIncid AND EstIncid = '1'
            AND e.GSEst = '$GSEst' AND i.FechaIncid BETWEEN '$FIniEst' AND '$FFinEst' AND i.InfoIncid IN $IdTipo ORDER BY i.IdIncidencia DESC";
    }
    $fila2 = mysqli_query($cn,$sql2);

    $FIniEst = $dia1."/".$mes1."/".$anio1;
    $FFinEst = $dia2."/".$mes2."/".$anio2;
  }
  else
  {
    $FIniEst = '1111-01-01';
    $FFinEst = '9999-12-30';

    $sql2 = "SELECT * FROM estudiante e, incidencia i, tipo_incidencia ti
            WHERE e.IdEstudiante = i.IdEstudiante AND i.IdTipoIncid = ti.IdTipoIncid
            AND e.GSEst = '$GSEst' AND i.FechaIncid BETWEEN '$FIniEst' AND '$FFinEst' AND i.InfoIncid IN $IdTipo ORDER BY i.IdIncidencia DESC";
    $fila2 = mysqli_query($cn,$sql2);

    $FIniEst = '__/__/____';
    $FFinEst = '__/__/____';

  }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html" charset="iso-8859-1" />
<title>REPORTE DERIVACION</title>
</head>
<body>
<CENTER><h3 style="font-family:Verdana"><strong>REPORTE INCIDENCIAS POR GRADO Y SECCION</strong></h3></CENTER>
<p style="font-family:verdana"><?php echo 'Desde: '.$FIniEst.' - Hasta: '.$FFinEst; ?></p>
            
<table width="100%" border="1" bordercolor="black" cellspacing="0" cellpadding="0" style="text-align:center;">
  
  <tr style="padding:5px 5px 5px 5px; font-size:12px; background:black; color:white;">
    <td><strong>DNI</strong></td>
    <td><strong>ESTUDIANTE</strong></td>
    <td><strong>INCIDENCIA</strong></td>
    <td><strong>DESCRIPCION</strong></td>
    <td><strong>TIPO</strong></td>
    <td><strong>FECHA</strong></td>
    <td><strong>GRADO Y SECCION</strong></td>
  </tr>
  
<?php
while($res=mysqli_fetch_array($fila2)){
  $FIncid = $res["FechaIncid"];
  list($anio,$mes,$dia) = explode("-",$FIncid);
  $FIncid  = $dia."/".$mes."/".$anio;  
  $Tipo = $res["InfoIncid"];
  if($Tipo=="C"){ $Tipo="Cotidiano";} else{$Tipo="Especifico";}
?>  
 <tr style="padding:5px 5px 5px 5px; font-size:12px; font-family:Arial;">
  <td><?php echo ($res["DniEst"]) ?></td>
	<td><?php echo ($res["ApelEst"]).', '.($res["NombEst"]) ?></td>
  <td><?php echo ($res["NombTipoIncid"]) ?></td>
	<td><?php echo ($res["DescIncid"]) ?></td>
  <td><?php echo $Tipo; ?></td>  
	<td><?php echo $FIncid; ?></td>   
  <td><?php echo $res["GSEst"] ?></td>                
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
