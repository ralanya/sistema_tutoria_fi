<?php
include("auth.php");
include("conexion.php");
$DniPers=$_SESSION["usuario"];
$IdInci = $_GET["id"];

  $sql2 = "SELECT * FROM estudiante e, incidencia i, tipo_incidencia ti, personal p, tipo_personal tp
    WHERE e.IdEstudiante = i.IdEstudiante AND i.IdTipoIncid = ti.IdTipoIncid 
    AND i.IdPersonal = p.IdPersonal AND p.IdTipoPers = tp.IdTipoPers
    AND i.IdIncidencia = '$IdInci'";
  $fila2 = mysqli_query($cn,$sql2);
  $r2 = mysqli_fetch_array($fila2);
  $fecha = date('Y/m/d');
  header("Content-type: application/vnd.ms-word");
  header("Content-Disposition: attachment; filename=ReporteBoletaEst (".$r2['DniEst']."-".$fecha.").doc");

  $fecha = $r2["FechaIncid"];
  list($anio,$mes,$dia) = explode("-",$fecha);
  switch ($mes) {
    case '01': $mes = 'Enero'; break; case '02': $mes = 'Febrero'; break; case '03': $mes = 'Marzo'; break; case '04': $mes = 'Abril'; break;
                    case '05': $mes = 'Marzo'; break; case '06': $mes = 'Junio'; break;
                    case '07': $mes = 'Julio'; break; case '08': $mes = 'Agosto'; break; case '09': $mes = 'Setiembre'; break;
                    case '10': $mes = 'Octubre'; break; case '11': $mes = 'Noviembre'; break; case '12': $mes = 'Diciembre'; break;             
  }
  $fecha2 = $dia.' de '.$mes.' del '.$anio;               
  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html" charset="UTF-8" />
<title>REPORTE DERIVACION</title>
</head>
<body>
<CENTER><h3 style="font-family:Verdana"><strong>BOLETA DE INCIDENCIA</strong></h3></CENTER>
<form id="FrmIncidencia" class="formulario" role="form" method="post" enctype="multipart/form-data" style="font-family:Arial;">
              <div class="box-body">                
                <div class="form-group">
                  <label><b>ESTUDIANTE:</b></label>
                  <p><?php echo utf8_encode($r2["ApelEst"]).', '.utf8_encode($r2["NombEst"]).' - '.utf8_encode($r2["GSEst"]); ?></p>                 
                </div> 
                <div class="form-group">
                  <label><b>PERSONAL:</b></label>
                  <p><?php echo utf8_encode($r2["ApelPers"]).', '.utf8_encode($r2["NombPers"]).' ('.utf8_encode($r2["NombTipoPers"]).')'; ?> </p>                 
                </div> 
                <div class="form-group">
                  <label><b>FECHA:</b></label>
                  <?php
                  $fecha = $r2["FechaIncid"];
                  list($anio,$mes,$dia) = explode("-",$fecha);
                  switch ($mes) {
                    case '01': $mes = 'Enero'; break; case '02': $mes = 'Febrero'; break; case '03': $mes = 'Marzo'; break; case '04': $mes = 'Abril'; break;
                    case '05': $mes = 'Marzo'; break; case '06': $mes = 'Junio'; break;
                    case '07': $mes = 'Julio'; break; case '08': $mes = 'Agosto'; break; case '09': $mes = 'Setiembre'; break;
                    case '10': $mes = 'Octubre'; break; case '11': $mes = 'Noviembre'; break; case '12': $mes = 'Diciembre'; break;                 
                  }
                  $fecha2 = $dia.' de '.$mes.' del '.$anio;
                  ?>
                  <p><?php echo $fecha2; ?></p>                 
                </div> 
                
                <div class="form-group">
                  <label><b>TIPO INFORMACIÓN:</b></label>
                  <div class="radio">                    
                    <?php 
                    if($r2["InfoIncid"]=="C"){
                      echo '<p>COTIDIANA</p>';                    
                    }
                    else if($r2["InfoIncid"]=="D"){
                      echo '<p>ESPECÍFICA</p>';
                    }
                    ?>                                     
                  </div>            
                </div>
                <div class="form-group">
                  <label><b>INCIDENCIA:</b></label>
                  <p><?php echo $r2["NombTipoIncid"]; ?></p>
                </div> 
                <div class="form-group">
                    <label><b>AFECTADOS:</b></label>
                    <p><?php echo utf8_encode($r2["AfecIncid"]); ?></p>
                </div>                
                <div class="form-group">
                    <label><b>DESCRIPCIÓN:</b></label>
                    <p><?php echo utf8_encode($r2["DescIncid"]); ?></p>
                </div>
                <div class="form-group">
                    <label><b>ACCIÓN REPARADORA:</b></label>
                    <p><?php 
                    if($r2["AcreIncid"]==""){
                      echo '----------';
                    }
                    else{
                      echo utf8_encode($r2["AcreIncid"]);   
                    }
                    ?>
                    </p>
                </div>
                <div class="form-group">
                    <label><b>OBSERVACIÓN:</b></label>
                    <p><?php 
                    if($r2["ObsIncid"]==""){
                      echo '----------';
                    }
                    else{
                      echo utf8_encode($r2["ObsIncid"]);  
                    }
                    ?>
                    </p>
                </div>

              </div>              
            </form>
            
<br>
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
