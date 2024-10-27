<?php
//require_once('../lib/pdf/mpdf.php');
require_once __DIR__ . '/../dompdf/vendor/autoload.php';
include('../conexion.php');

use Dompdf\Dompdf;
$dompdf = new Dompdf();

//Estudiante
$GSEst = $_GET["GSEst"];
$FIniEst = $_GET["FIniEst"];
$FFinEst = $_GET["FFinEst"];

if($GSEst=="Todos"){ 
  $sql2 = mysqli_query($cn,"SELECT * FROM estudiante e, logro l
            WHERE e.IdEstudiante = l.IdEstudiante AND EstLog = '1'
            AND l.FechaLog BETWEEN '$FIniEst' AND '$FFinEst'");
}
else{
  $sql2 = mysqli_query($cn,"SELECT * FROM estudiante e, logro l
            WHERE e.IdEstudiante = l.IdEstudiante AND EstLog = '1'
            AND e.GSEst = '$GSEst' AND l.FechaLog BETWEEN '$FIniEst' AND '$FFinEst'");
}

list($anio1,$mes1,$dia1) = explode("-",$FIniEst);
list($anio2,$mes2,$dia2) = explode("-",$FFinEst);

$html = '
	<link rel="stylesheet" href="css/style.css">
	<header class="clearfix">
      <div id="logo">
        <img src="img/logoJEC.png" style="width:7em; vertical-align:middle; margin:1em; margin-right:4em">
        <img src="img/logoMINEDU.png" style="width:16em; vertical-align:middle; margin:0.5em; margin-right:4em">
        <img src="img/logoATI.png" style="width:16em; vertical-align:middle; margin:0.5em; margin-right:4em">
        <img src="img/insigniaFI.png" style="width:3em; vertical-align:middle; margin:0.5em;">
      </div>
      <h1>REPORTE DE LOGROS POR GRADO Y SECCIÓN</h1>
      
      <div id="project">        
        <div><span>GRADO Y SECCIÓN:</span> '.$GSEst.'</div>        
        <div><span>DESDE:</span> '.$dia1.'/'.$mes1.'/'.$anio1.'<span> HASTA:</span> '.$dia2.'/'.$mes2.'/'.$anio2.'</div>        
      </div>
    </header>
    <main>';
      $html.='<table>
        <thead>
          <tr>            
            <th>DNI</th>
            <th>ESTUDIANTE</th>
            <th>GRADO Y SECCIÓN</th>
            <th>DESCRIPCIÓN</th>
            <th>OBSERVACIÓN</th>
            <th>FECHA</th>
          </tr>
        </thead>
        <tbody>';
        while($r2 = mysqli_fetch_array($sql2)){
          list($anio3,$mes3,$dia3) = explode("-",$r2["FechaLog"]);     
          $html.='<tr>
            <td>'.$r2["DniEst"].'</td>
            <td>'.utf8_encode($r2["ApelEst"]).', <br>'.utf8_encode($r2["NombEst"]).'</td>
            <td style="text-align:center;">'.$r2["GSEst"].'</td>
            <td>'.utf8_encode($r2["DescLog"]).'</td>
            <td>'.utf8_encode($r2["ObsLog"]).'</td>
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
$dompdf->stream('ficha-logro-gs.pdf',array("Attachment"=>false));

?>