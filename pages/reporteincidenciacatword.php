<?php
$fecha=date("d-m-Y");
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment; filename=ReporteCategoriaGS (".$fecha.").doc");


include("auth.php");
include("conexion.php");

  $DniPers=$_SESSION["usuario"];

  $sql="select * from personal p, tipo_personal tp where p.IdTipoPers = tp.IdTipoPers and DniPers='$DniPers'";
  $fila=mysqli_query($cn,$sql);
  $r=mysqli_fetch_array($fila);
  $IdTipo = $r["IdTipoPers"];
  if($IdTipo==5){ $IdTipo="('C')"; } else{$IdTipo="('C','D')";}

  $GSEst = $_GET["opcion"];
  $Cat = $_GET["tipo"];

                
  if(isset ($_GET['fini']) && ($_GET['ffin']))
  {
    $FIniEst = $_GET["fini"];
    list($anio1,$mes1,$dia1) = explode("-",$FIniEst);
    $FFinEst = $_GET["ffin"];
    list($anio2,$mes2,$dia2) = explode("-",$FFinEst);

    if($GSEst=="Todos" and $Cat!="Todos"){ 
      $sql2 = "SELECT * FROM estudiante e, incidencia i, tipo_incidencia ti
            WHERE e.IdEstudiante = i.IdEstudiante AND i.IdTipoIncid = ti.IdTipoIncid AND EstIncid = '1'
            AND i.InfoIncid IN $IdTipo AND i.FechaIncid BETWEEN '$FIniEst' AND '$FFinEst' AND ti.NombTipoIncid ='$Cat' ORDER BY i.IdIncidencia DESC";
    }
    else if($Cat=="Todos" and $GSEst!="Todos"){ 
      $sql2 = "SELECT * FROM estudiante e, incidencia i, tipo_incidencia ti
            WHERE e.IdEstudiante = i.IdEstudiante AND i.IdTipoIncid = ti.IdTipoIncid AND EstIncid = '1'
            AND i.InfoIncid IN $IdTipo AND i.FechaIncid BETWEEN '$FIniEst' AND '$FFinEst' AND GSEst = '$GSEst' ORDER BY i.IdIncidencia DESC";
    }
    else if($Cat=="Todos" and $GSEst=="Todos"){ 
      $sql2 = "SELECT * FROM estudiante e, incidencia i, tipo_incidencia ti 
            WHERE e.IdEstudiante = i.IdEstudiante AND i.IdTipoIncid = ti.IdTipoIncid AND EstIncid = '1'
            AND i.InfoIncid IN $IdTipo AND i.FechaIncid BETWEEN '$FIniEst' AND '$FFinEst' ORDER BY i.IdIncidencia DESC";
    }
    else if($Cat!="Todos" and $GSEst!="Todos"){
      $sql2 = "SELECT * FROM estudiante e, incidencia i, tipo_incidencia ti
            WHERE e.IdEstudiante = i.IdEstudiante AND i.IdTipoIncid = ti.IdTipoIncid AND EstIncid = '1'
            AND i.InfoIncid IN $IdTipo AND e.GSEst = '$GSEst' AND i.FechaIncid BETWEEN '$FIniEst' AND '$FFinEst' AND ti.NombTipoIncid ='$Cat' ORDER BY i.IdIncidencia DESC";
    }    
    $fila2 = mysqli_query($cn,$sql2);
    $fila3 = mysqli_query($cn,$sql2);
    $r3 = mysqli_fetch_array($fila3);
    $FIniEst = $dia1."/".$mes1."/".$anio1;
    $FFinEst = $dia2."/".$mes2."/".$anio2;
  }  
  $Cant = mysqli_num_rows($fila2);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html" charset="UTF-8" />
<title>REPORTE DERIVACION</title>
</head>
<body>
<CENTER><h3 style="font-family:Verdana"><strong>REPORTE INCIDENCIAS POR CATEGORIA</strong></h3></CENTER>
<p style="font-family:verdana"><?php echo 'Categoría: '.utf8_encode($Cat); ?></p>
<p style="font-family:verdana"><?php echo 'Grado y Sección: '.utf8_encode($GSEst); ?></p>
<p style="font-family:verdana"><?php echo 'Cantidad: '.$Cant; ?></p>
<p style="font-family:verdana"><?php echo 'Desde: '.$FIniEst.' - Hasta: '.$FFinEst; ?></p>
            
<table width="100%" border="1" bordercolor="black" cellspacing="0" cellpadding="0" style="text-align:center; font-size:12px; font-family:Arial;">
  <tr style="padding:5px 5px 5px 5px; font-size:12px; background:black; color:white;">    
    
    <th>DNI</th>
    <th width="20%">Estudiante</th>    
    <th>Grado y Sección</th>   
    <th>Categoría</th>
    <th width="20%">Descripción</th>
    <th>Tipo</th>
    <th>Fecha</th>  
  </tr>
  
<?php
while($r2 = mysqli_fetch_array($fila2))
                {       
                  $FIncid = $r2["FechaIncid"];
                  list($anio,$mes,$dia) = explode("-",$FIncid);
                  $FIncid  = $dia."/".$mes."/".$anio;       
                  $Tipo = $r2["InfoIncid"];
                  if($Tipo == "C"){   $Tipo = "Cotidiana";  } else { $Tipo = "Especifico"; }         
                  echo '
                  <tr>    
                    
                    <td style="vertical-align:middle;">'.$r2["DniEst"].'</td>           
                    <td style="vertical-align:middle;">'.utf8_encode($r2["ApelEst"]).', '.utf8_encode($r2["NombEst"]).'</td>                              
                    <td style="vertical-align:middle;">'.$r2["GSEst"].'</td> 
                    <td style="vertical-align:middle;">'.utf8_encode($r2["NombTipoIncid"]).'</td>
                    <td style="vertical-align:middle;">'.utf8_encode($r2["DescIncid"]).'</td>
                    <td style="vertical-align:middle;">'.$Tipo.'</td>
                    <td style="vertical-align:middle;">'.$FIncid .'</td>                      
                  </tr>';
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
