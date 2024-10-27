<?php

$fecha=date("d-m-Y");


include("conexion.php");

  $IdEst = $_GET["txtIdEstudiante"];
  $sql2 = "select * from estudiante e, detalle_estudiante de where e.IdDetalleEst = de.IdDetalleEst and IdEstudiante = '$IdEst'";
  $fila2 = mysqli_query($cn,$sql2);
  $r2 = mysqli_fetch_array($fila2);
  $DNI = $r2["DniEst"];
  header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment; filename=ReporteFamilia (".$DNI."-".$fecha.").doc");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
<title>REPORTE FAMILIA</title>
</head>
<body>

    <center>
      <h2>REPORTE FAMILIA DE ESTUDIANTE</h2>      
    </center>
      
      <h3>Datos Personal</h3>
           
      <table style="border:1px solid; font-family:Arial;">
        <tr>
          <td>Estudiante</td>
          <td><?php echo utf8_encode($r2["ApelEst"]).', '.$r2["NombEst"] ?></td>
        </tr>
        <tr>
          <td>Grado y Sección</td>
          <td><?php echo ($r2["GSEst"]); ?></td>
        </tr>
        <tr>
          <td>¿Con quién vives?</td>
          <td><?php echo utf8_encode($r2["CQVEst"]) ?></td>
        </tr>
        <tr>
          <td>Sacramento</td>
          <td><?php echo utf8_encode($r2["SacraEst"]) ?></td>
        </tr>
        <tr>
          <td>¿Quien te ayuda con la tarea?</td>
          <td><?php echo utf8_encode($r2["AyudaTareaEst"]) ?></td>
        </tr>
        <tr>
          <td>¿Cuántos hermanos son?</td>
          <td><?php echo utf8_encode($r2["CantHermEst"]) ?></td>
        </tr>
        <tr>
          <td>Hermanos en el colegio</td>
          <td><?php echo utf8_encode($r2["HermColeEst"]) ?></td>
        </tr>
        <tr>
          <td>Procedencia de la familia</td>
          <td><?php echo utf8_encode($r2["ProceEst"]) ?></td>
        </tr>
        <tr>
          <td>Casa</td>
          <td><?php echo utf8_encode($r2["CasaEst"]) ?></td>
        </tr>
        <tr>
          <td>¿Tus padres estan casados?</td>
          <td><?php echo utf8_encode($r2["PadreCasEst"]) ?></td>
        </tr>
        <tr>
          <td>¿Violencia fisica y/o psicologica?</td>
          <td><?php echo utf8_encode($r2["VioleFPEst"]) ?></td>
        </tr>
      </table>   

      <h3>Datos Padre</h3>
      <table style="border:1px solid; font-family:Arial;">
        <tr>
          <td>¿Tu padre vive?</td>
          <td><?php echo utf8_encode($r2["PadreVEst"]) ?></td>
        </tr>
        <tr>
          <td>Profesión y/o oficio del padre</td>
          <td><?php echo utf8_encode($r2["ProfPadreEst"]) ?></td>
        </tr>
        <tr>
          <td>¿Donde trabaja tu padre?</td>
          <td><?php echo utf8_encode($r2["TrabPadreEst"]) ?></td>
        </tr>
      </table>
      
      <h3>Datos Madre</h3>
      <table style="border:1px solid; font-family:Arial;">
        <tr>
          <td>¿Tu madre vive?</td>
          <td><?php echo utf8_encode($r2["MadreVEst"]) ?></td>
        </tr>
        <tr>
          <td>Profesión y/o oficio de la madre</td>
          <td><?php echo utf8_encode($r2["ProfMadreEst"]) ?></td>
        </tr>
        <tr>
          <td>¿Donde trabaja tu madre?</td>
          <td><?php echo utf8_encode($r2["TrabMadreEst"]) ?></td>
        </tr>
      </table>  
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
