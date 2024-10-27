<?php
//require_once('../lib/pdf/mpdf.php');
include('../conexion.php');
require_once __DIR__ . '/../dompdf/vendor/autoload.php';

use Dompdf\Dompdf;
$dompdf = new Dompdf();

//Estudiante
$GSEst = $_GET["GSEst"];
$FIniEst = $_GET["FIniEst"];
$FFinEst = $_GET["FFinEst"];
$IdTipo = $_GET["Tipo"];
if($IdTipo==5){ $IdTipo="('C')"; } else{$IdTipo="('C','D')";}
if($GSEst=="Todos"){ 
      $sql2 = mysqli_query($cn,"SELECT * FROM estudiante e, incidencia i, personal p
            WHERE e.IdEstudiante = i.IdEstudiante AND i.IdPersonal = p.IdPersonal AND EstIncid='1'
            AND i.FechaIncid BETWEEN '$FIniEst' AND '$FFinEst' AND i.InfoIncid IN $IdTipo");
    }
    else{
      $sql2 = mysqli_query($cn,"SELECT * FROM estudiante e, incidencia i, personal p
            WHERE e.IdEstudiante = i.IdEstudiante AND i.IdPersonal = p.IdPersonal AND e.GSEst = '$GSEst' AND EstIncid='1' AND i.FechaIncid BETWEEN '$FIniEst' AND '$FFinEst' AND i.InfoIncid IN $IdTipo");
    }

list($anio1,$mes1,$dia1) = explode("-",$FIniEst);
list($anio2,$mes2,$dia2) = explode("-",$FFinEst);

$html = '
<body>
	<link rel="stylesheet" href="css/style.css">
	<header class="clearfix">
      <div id="logo">
        <img src="img/logoJEC.png" style="width:7em; vertical-align:middle; margin:1em; margin-right:4em">
        <img src="img/logoMINEDU.png" style="width:16em; vertical-align:middle; margin:0.5em; margin-right:4em">
        <img src="img/logoATI.png" style="width:16em; vertical-align:middle; margin:0.5em; margin-right:4em">
        <img src="img/insigniaFI.png" style="width:3em; vertical-align:middle; margin:0.5em;">
      </div>
      <h1>REPORTE DE INCIDENCIAS POR GRADO Y SECCIÓN</h1>
      
      <div id="project">
        <div><span>GRADO Y SECCIÓN:</span> '.$GSEst.'</div>        
        <div><span>DESDE:</span> '.$dia1.'/'.$mes1.'/'.$anio1.'<span> - HASTA:</span> '.$dia2.'/'.$mes2.'/'.$anio2.'</div>        
      </div>
    </header>
    <main>';
      $html.='<table>
        <thead>
          <tr>            
            <th>DNI</th>
            <th>APELLIDOS Y NOMBRES</th>
            <th>GRADO <br>Y SECCIÓN</th>
            <th>PERSONA QUIEN <br>DERIVO EL CASO</th>
            <th>INCIDENCIAS</th>
            <th>DESCRIPCIÓN</th>
            <th>FECHA</th>
          </tr>
        </thead>
        <tbody>';
        while($r2 = mysqli_fetch_array($sql2)){
          //marcados
          $IdIncidencia = $r2["IdIncidencia"];
          //Otro motivo
          $sqlMotivo = mysqli_query($cn,"SELECT OtroIncid FROM incidencia WHERE IdIncidencia = '$IdIncidencia'");
          $rMotivo = mysqli_fetch_array($sqlMotivo);
          $Motivo = $rMotivo["OtroIncid"];
          
          $sqlDeriva = mysqli_query($cn,"SELECT * FROM detalle_incidencia di, tipo_incidencia ti WHERE di.IdTipoIncid = ti.IdTipoIncid AND di.IdIncidencia='$IdIncidencia'");
          $Tipo2 = $r2["InfoIncid"];
          if($Tipo2 == "C"){   $Tipo2 = "Cotidiana";  } else { $Tipo2 = "Específica"; }
          list($anio3,$mes3,$dia3) = explode("-",$r2["FechaIncid"]);
          $html.='<tr>
            <td>'.$r2["DniEst"].'</td>
            <td>'.utf8_encode($r2["ApelEst"]).', <br>'.utf8_encode($r2["NombEst"]).'</td>
            <td>'.$r2["GSEst"].'</td>
            <td>'.utf8_encode($r2["ApelPers"]).', <br>'.utf8_encode($r2["NombPers"]).'</td>
            <td>';
            while($rDeriva = mysqli_fetch_array($sqlDeriva)){
              $html.='- '.utf8_encode($rDeriva["NombTipoIncid"]).'<br>';                    
            }
            if($Motivo!=""){
              $html.='- OTROS: '.$Motivo.'<br>';
            }
            $html.='</td>
            <td>'.utf8_encode($r2["DescIncid"]).'</td>
            <td>'.$dia3.'/'.$mes3.'/'.$anio3.'</td>
          </tr>';
        }
        $html.='</tbody>
      </table>           
    </main>
</body>';


/*$dompdf->setPaper( array(0,0,247,156));*/
$dompdf->setPaper('A4', 'landscape');
$dompdf ->set_option('defaultFont','Courier');
$dompdf->set_option('isHtml5ParserEnabled', true);
$dompdf->loadHtml($html);
$dompdf->render();
$dompdf->stream('ficha-incidencia-gs.pdf',array("Attachment"=>false));

?>