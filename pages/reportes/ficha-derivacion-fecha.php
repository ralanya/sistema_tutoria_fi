<?php
require_once __DIR__ . '/../dompdf/vendor/autoload.php';
include('../conexion.php');

use Dompdf\Dompdf;
$dompdf = new Dompdf();

$FIniEst = $_GET["FIniEst"];
$FFinEst = $_GET["FFinEst"];
list($anio1,$mes1,$dia1) = explode("-",$FIniEst);
list($anio2,$mes2,$dia2) = explode("-",$FFinEst);

$sqlEst = mysqli_query($cn,"SELECT * FROM estudiante e, derivacion d, personal p WHERE e.IdEstudiante = d.IdEstudiante AND p.IdPersonal = d.IdPersona AND d.FechDeri BETWEEN '$FIniEst' AND '$FFinEst'");

$html = '
	<link rel="stylesheet" href="css/style.css">
	<header class="clearfix">
      <div id="logo">
        <img src="img/logoJEC.png" style="width:7em; vertical-align:middle; margin:1em; margin-right:4em">
        <img src="img/logoMINEDU.png" style="width:16em; vertical-align:middle; margin:0.5em; margin-right:4em">
        <img src="img/logoATI.png" style="width:16em; vertical-align:middle; margin:0.5em; margin-right:4em">
        <img src="img/insigniaFI.png" style="width:3em; vertical-align:middle; margin:0.5em;">
      </div>
      <h1 style="font-size:2em;">REPORTE DERIVACIONES POR FECHAS</h1>
      
      <div id="project">
        <div><span>DESDE:</span> '.$dia1.'/'.$mes1.'/'.$anio1.'<span> - HASTA:</span> '.$dia2.'/'.$mes2.'/'.$anio2.'</div>       
      </div>
    </header>
    <main>
      <table>
        <thead>
          <tr>            
            <th>DNI</th>
            <th>APELLIDOS Y NOMBRES</th>
            <th>GRADO Y SECCIÓN</th>
            <th>PERSONA QUIEN RECIBE EL CASO</th>
            <th>ESTADO</th>
            <th>ÁREA</th>
            <th>FECHA</th>
          </tr>
        </thead>
        <tbody>';
        while($r = mysqli_fetch_array($sqlEst)){
          if($r["TipoDeri"] == 1){ $Area = "PSICOLOGÍA";} else{ $Area = "DIRECCIÓN"; }  
          if($r["AteDeri"]==0){ $Atencion = "NO ATENDIDO";  }else{ $Atencion = "ATENDIDO"; }
          list($anio3,$mes3,$dia3) = explode("-",$r["FechDeri"]);
          $html.='<tr>
            <td>'.$r["DniEst"].'</td>
            <td>'.utf8_encode($r["ApelEst"]).', '.utf8_encode($r["NombEst"]).'</td>
            <td>'.$r["GSEst"].'</td>
            <td>'.utf8_encode($r["ApelPers"]).', '.utf8_encode($r["NombPers"]).'</td>
            <td>'.$Atencion.'</td>
            <td>'.$Area.'</td>
            <td>'.$dia3.'-'.$mes3.'-'.$anio3.'</td>
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