<?php
//require_once('../lib/pdf/mpdf.php');
include('../conexion.php');
require_once __DIR__ . '/../dompdf/vendor/autoload.php';

use Dompdf\Dompdf;
$dompdf = new Dompdf();

//Estudiante
$DniEst = $_GET["Dni"];
$FIniEst = $_GET["FIniEst"];
$FFinEst = $_GET["FFinEst"];
$IdTipo = $_GET["Tipo"];
if($IdTipo==5 || $IdTipo==15){ $IdTipo="('C')"; } else{$IdTipo="('C','D')";}
$sqlEst = mysqli_query($cn,"SELECT * FROM estudiante e, incidencia i, personal p
      WHERE e.IdEstudiante = i.IdEstudiante AND i.IdPersona = p.IdPersonal AND e.DniEst = '$DniEst' AND EstIncid = '1' AND i.FechaIncid BETWEEN '$FIniEst' AND '$FFinEst' AND i.InfoIncid IN $IdTipo");
$sqlEst2 = mysqli_query($cn,"SELECT * FROM estudiante e, incidencia i, personal p
      WHERE e.IdEstudiante = i.IdEstudiante AND i.IdPersona = p.IdPersonal AND e.DniEst = '$DniEst' AND EstIncid = '1' AND i.FechaIncid BETWEEN '$FIniEst' AND '$FFinEst' AND i.InfoIncid IN $IdTipo");
$rEst = mysqli_fetch_array($sqlEst);


list($anio1,$mes1,$dia1) = explode("-",$FIniEst);
list($anio2,$mes2,$dia2) = explode("-",$FFinEst);
//Persona que deriva

//fecha de nacimiento
  $FHoy = date("Y-m-d");
  list($ano,$mes,$dia) = explode("-",$FHoy);
  $Fnac = $rEst["FNacEst"];
  list($anonaz,$mesnaz,$dianaz) = explode("-",$Fnac);
  
  //si el mes es el mismo pero el día inferior aun no ha cumplido años, le quitaremos un año al actual
  if (($mesnaz == $mes) && ($dianaz > $dia)) {
  $ano=($ano-1); }

  //si el mes es superior al actual tampoco habrá cumplido años, por eso le quitamos un año al actual
  if ($mesnaz > $mes) {
  $ano=($ano-1);}

  //ya no habría mas condiciones, ahora simplemente restamos los años y mostramos el resultado como su edad
  $edad=($ano-$anonaz);

$html = '
	<link rel="stylesheet" href="css/style.css">
	<header class="clearfix">
      <div id="logo">
        <img src="img/logoJEC.png" style="width:7em; vertical-align:middle; margin:1em; margin-right:4em">
        <img src="img/logoMINEDU.png" style="width:16em; vertical-align:middle; margin:0.5em; margin-right:4em">
        <img src="img/logoATI.png" style="width:16em; vertical-align:middle; margin:0.5em; margin-right:4em">
        <img src="img/insigniaFI.png" style="width:3em; vertical-align:middle; margin:0.5em;">
      </div>
      <h1>REPORTE DE INCIDENCIAS DE ESTUDIANTE</h1>
      
      <div id="project">
        <div><span>ESTUDIANTE:</span> '.utf8_encode($rEst['ApelEst']).', '.utf8_encode($rEst["NombEst"]).'</div>
        <div><span>GRADO Y SECCIÓN:</span> '.$rEst["GSEst"].'</div>
        <div><span>EDAD:</span> '.$edad.' AÑOS</div>        
        <div><span>DESDE:</span> '.$dia1.'/'.$mes1.'/'.$anio1.'<span> - HASTA:</span> '.$dia2.'/'.$mes2.'/'.$anio2.'</div>        
      </div>
    </header>
    <main>';
      $html.='<table>
        <thead>
          <tr>            
            <th>PERSONA QUIEN <br>DERIVO EL CASO</th>
            <th>INCIDENCIAS</th>
            <th>DESCRIPCIÓN</th>
            <th>TIPO</th>
            <th>FECHA</th>
          </tr>
        </thead>
        <tbody>';
        while($r = mysqli_fetch_array($sqlEst2)){
          //marcados
          $IdIncidencia = $r["IdIncidencia"];
          //Otro motivo
          $sqlMotivo = mysqli_query($cn,"SELECT OtroIncid FROM incidencia WHERE IdIncidencia = '$IdIncidencia'");
          $rMotivo = mysqli_fetch_array($sqlMotivo);
          $Motivo = $rMotivo["OtroIncid"];

          $sqlDeriva = mysqli_query($cn,"SELECT * FROM detalle_incidencia di, tipo_incidencia ti WHERE di.IdTipoIncid = ti.IdTipoIncid AND di.IdIncidencia='$IdIncidencia'");
          $Tipo2 = $r["InfoIncid"];
          if($Tipo2 == "C"){   $Tipo2 = "Cotidiana";  } else { $Tipo2 = "Específica"; }
          list($anio3,$mes3,$dia3) = explode("-",$r["FechaIncid"]);
          $html.='<tr>
            <td>'.utf8_encode($r["ApelPers"]).', <br>'.utf8_encode($r["NombPers"]).'</td>
            <td>';
            while($rDeriva = mysqli_fetch_array($sqlDeriva)){
              $html.='- '.utf8_encode($rDeriva["NombTipoIncid"]).'<br>';                    
            }
            if($Motivo!=""){
              $html.='- OTROS: '.$Motivo.'<br>';
            }
            $html.='</td>
            <td>'.utf8_encode($r["DescIncid"]).'</td>
            <td>'.$Tipo2.'</td>
            <td>'.$dia3.'/'.$mes3.'/'.$anio3.'</td>
          </tr>';
        }
        $html.='</tbody>
      </table>           
    </main>';

$dompdf->setPaper('A4', 'landscape');
$dompdf ->set_option('defaultFont','Courier');
$dompdf->set_option('isHtml5ParserEnabled', true);
$dompdf->loadHtml($html);
$dompdf->render();
$dompdf->stream('ficha-incidencia-est.pdf',array("Attachment"=>false));

?>