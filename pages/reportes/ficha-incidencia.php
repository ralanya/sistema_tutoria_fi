<?php
//require_once('../lib/pdf/mpdf.php');
include('../conexion.php');
require_once __DIR__ . '/../dompdf/vendor/autoload.php';

use Dompdf\Dompdf;
$dompdf = new Dompdf();

//Estudiante
$IdIncidencia = $_GET["id"];
$sqlEst = mysqli_query($cn,"SELECT * FROM estudiante e, incidencia i WHERE e.IdEstudiante = i.IdEstudiante AND i.IdIncidencia = '$IdIncidencia'");
$rEst = mysqli_fetch_array($sqlEst);
if($rEst["InfoIncid"]=="C"){ $Tipo="Cotidiana";} else{$Tipo="Específica";}
$fecha = $rEst["FechaIncid"];
list($anio1,$mes1,$dia1) = explode("-",$fecha);
//Persona que deriva
$sqlPersona = mysqli_query($cn,"SELECT * FROM personal p, tipo_personal tp, incidencia i WHERE p.IdPersonal = i.IdPersona AND tp.IdTipoPers = p.IdTipoPers AND i.IdIncidencia = '$IdIncidencia'");
$rPersona = mysqli_fetch_array($sqlPersona);
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

  //Otro motivo
  $sqlMotivo = mysqli_query($cn,"SELECT OtroIncid FROM Incidencia WHERE IdIncidencia = '$IdIncidencia'");
  $rMotivo = mysqli_fetch_array($sqlMotivo);
  $Motivo = $rMotivo["OtroIncid"];

                    

$html = '
	<link rel="stylesheet" href="css/style.css">
	<header class="clearfix">
      <div id="logo">
        <img src="img/logoJEC.png" style="width:6em; vertical-align:middle; margin:0.5em;">
        <img src="img/logoMINEDU.png" style="width:14em; vertical-align:middle; margin:0.5em;">
        <img src="img/logoATI.png" style="width:14em; vertical-align:middle; margin:0.5em;">
        <img src="img/insigniaFI.png" style="width:3em; vertical-align:middle; margin:0.5em;">
      </div>
      <h1>FICHA DE REMISIÓN DE CASOS</h1>
      
      <div id="project">
        <div><span>ESTUDIANTE:</span> '.utf8_encode($rEst['ApelEst']).', '.utf8_encode($rEst["NombEst"]).'</div>
        <div><span>GRADO Y SECCIÓN:</span> '.$rEst["GSEst"].'</div>
        <div><span>EDAD:</span> '.$edad.' AÑOS</div>        
        <div><span>FECHA:</span> '.$dia1.'/'.$mes1.'/'.$anio1.'</div>
        <div><span>TIPO CASO:</span> '.$Tipo.'</div>        
      </div>
    </header>
    <main>';
    	//marcados
        $sqlDeriva = mysqli_query($cn,"SELECT * FROM detalle_incidencia di, tipo_incidencia ti WHERE di.IdTipoIncid = ti.IdTipoIncid AND di.IdIncidencia='$IdIncidencia'");
        //no marcados
         $sqlDeriva2 = mysqli_query($cn,"SELECT * FROM tipo_incidencia WHERE NOT IdTipoIncid IN (SELECT IdTipoIncid FROM detalle_incidencia WHERE IdIncidencia = '$IdIncidencia')");
                    

      $html.='<table>
        <thead>
          <tr>            
            <th colspan="2" style="text-align:left; font-size:1.2em;">DERIVADO POR:</th>
          </tr>
        </thead>
        <tbody>
          <tr>            
            <td style="text-align:left; font-size:1.2em;">';
            while($rDeriva = mysqli_fetch_array($sqlDeriva)){
                $html.= ''.utf8_encode($rDeriva["NombTipoIncid"]).' ( X )<br>';                    
                    }
            if($Motivo !=""){
              $html.= 'OTROS ( X ) : '.strtoupper($Motivo).'';
            }
            $html.='</td>
            <td style="text-align:left; font-size:1.2em;">';
            while($rDeriva2 = mysqli_fetch_array($sqlDeriva2)){                   
                          $html.= ''.utf8_encode($rDeriva2["NombTipoIncid"]).' (  )<br>';
                    }
            if($Motivo==""){
              $html.= 'OTROS (  )';
            }
            $html.='</td>
          </tr>
        </tbody>
      </table>
      <table>
        <thead>
          <tr>            
            <th style="text-align:left; font-size:1.2em;">DESCRIPCIÓN BREVE DEL PROBLEMA:</th>
          </tr>
        </thead>
        <tbody>
          <tr>            
            <td style="text-align:left; font-size:1.2em;">'.utf8_encode($rEst["DescIncid"]).'</td>           
          </tr>
        </tbody>
      </table>
      <div id="project">
        <div><span>NOMBRE DE LA PERSONA QUE DERIVA:</span> '.utf8_encode($rPersona['ApelPers']).', '.utf8_encode($rPersona["NombPers"]).'</div>
        <div><span>CARGO:</span> '.utf8_encode($rPersona["NombTipoPers"]).'</div>           
      </div>
      <div style="height:8em"></div>
      <table>
          <tr style="border:none;">            
            <th style="text-align:center; font-size:1.2em;">
            ..............................................................................<br><b>'.utf8_encode($rPersona['ApelPers']).', '.utf8_encode($rPersona["NombPers"]).'</b><br>
            FIRMA DE LA PERSONA QUE DERIVA
            </th>
            <th style="text-align:center; font-size:1.2em;">
            ..............................................................................<br>
            FIRMA DEL QUE RECIBE EL CASO
            </th>
          </tr>
       </table>
    </main>';

$dompdf->setPaper('A4', 'portrait ');
$dompdf ->set_option('defaultFont','Courier');
$dompdf->set_option('isHtml5ParserEnabled', true);
$dompdf->loadHtml($html);
$dompdf->render();
$dompdf->stream('ficha-incidencia.pdf',array("Attachment"=>false));

?>