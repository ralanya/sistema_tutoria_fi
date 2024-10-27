<?php
//require_once('../lib/pdf/mpdf.php');
include('../conexion.php');
require_once __DIR__ . '/../dompdf/vendor/autoload.php';

//Estudiante
$IdDerivacion = $_GET["id"];
$sqlEst = mysqli_query($cn,"SELECT * FROM estudiante e, derivacion d WHERE e.IdEstudiante = d.IdEstudiante AND d.IdDerivacion = '$IdDerivacion'");
$rEst = mysqli_fetch_array($sqlEst);
$fecha = $rEst["FechDeri"];
list($anio1,$mes1,$dia1) = explode("-",$fecha);
//Persona que deriva
$sqlPersona = mysqli_query($cn,"SELECT * FROM personal p, tipo_personal tp, derivacion d WHERE p.IdPersonal = d.IdPersona AND tp.IdTipoPers = p.IdTipoPers AND d.IdDerivacion = '$IdDerivacion'");
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

  //DERIVACIONES

                    

$html = '
	<link rel="stylesheet" href="css/style.css">
	<header class="clearfix">
      <div id="logo">
        <img src="img/logoJEC.png" style="width:8em; vertical-align:middle; margin:0.5em;">
        <img src="img/logoMINEDU.png" style="width:18em; vertical-align:middle; margin:0.5em;">
        <img src="img/logoATI.png" style="width:18em; vertical-align:middle; margin:0.5em;">
        <img src="img/insigniaFI.png" style="width:4em; vertical-align:middle; margin:0.5em;">
      </div>
      <h1 style="font-size:2em;">FICHA DE DETECCIÓN Y DERIVACIÓN DE CASOS</h1>
      
      <div id="project">
        <div><span>ESTUDIANTE:</span> '.$rEst['ApelEst'].', '.$rEst["NombEst"].'</div>
        <div><span>GRADO Y SECCIÓN:</span> '.$rEst["GSEst"].'</div>
        <div><span>EDAD:</span> '.$edad.' AÑOS</div>        
        <div><span>FECHA:</span> '.$dia1.'/'.$mes1.'/'.$anio1.'</div>        
      </div>
    </header>
    <main>';
    	//marcados
        $sqlDeriva = mysqli_query($cn,"SELECT * FROM detalle_incidencia di, tipo_incidencia ti WHERE di.IdTipoIncid = ti.IdTipoIncid AND di.IdIncidencia='$IdIncidencia'");
        //no marcados
         $sqlDeriva2 = mysqli_query($cn,"SELECT * FROM tipo_incidencia WHERE NOT IdTipoIncid IN (SELECT IdTipoIncid FROM detalle_incidencia WHERE IdIncidencia = '$IdIncidencia')");
                    

      $html.='
      <table>
        <thead>
          <tr>            
            <th style="text-align:left; font-size:1.2em;">MOTIVO DE DERIVACIÓN:</th>
          </tr>
        </thead>
        <tbody>
          <tr>            
            <td style="text-align:left; font-size:1.2em;">'.utf8_encode($rEst["DescDeri"]).'</td>           
          </tr>
        </tbody>
      </table>
      <table>
        <thead>
          <tr>            
            <th style="text-align:left; font-size:1.2em;">ACCIONES YA REALIZADAS:</th>
          </tr>
        </thead>
        <tbody>
          <tr>            
            <td style="text-align:left; font-size:1.2em;">'.utf8_encode($rEst["AcreDeri"]).'</td>           
          </tr>
        </tbody>
      </table>
      <div id="project">
        <div><span>NOMBRE DE LA PERSONA QUE RECIBE EL CASO:</span> '.utf8_encode($rPersona['ApelPers']).', '.utf8_encode($rPersona["NombPers"]).'</div>
        <div><span>CARGO:</span> '.utf8_encode($rPersona["NombTipoPers"]).'</div>           
      </div>
      <div style="height:8em"></div>
      <table>
          <tr style="border:none;">
            <th style="text-align:center; font-size:1.2em;">
            ..............................................................................<br>
            PERSONAL QUIEN DERIVA
            </th>
            <th style="text-align:center; fsont-size:1.2em;">
            ..............................................................................<br>'.utf8_encode($rPersona['ApelPers']).', '.utf8_encode($rPersona["NombPers"]).'<br><b>
            '.utf8_encode($rPersona["NombTipoPers"]).'</b>           
            </th>
          </tr>
       </table>

      <div style="height:3em"></div>
      <h1 style="font-size:2em;">CARGO HOJA DE DETECCIÓN Y DERIVACIÓN DE CASOS</h1>      
      <div id="project">
        <div><span>ESTUDIANTE:</span> '.$rEst['ApelEst'].', '.$rEst["NombEst"].'</div>
        <div><span>GRADO Y SECCIÓN:</span> '.$rEst["GSEst"].'</div>
        <div><span>EDAD:</span> '.$edad.' AÑOS</div>        
        <div><span>FECHA:</span> '.$dia1.'/'.$mes1.'/'.$anio1.'</div>        
      </div>
      <div style="height:4em"></div>
      <table>
          <tr style="border:none;">
            <th style="text-align:center; font-size:1.2em;">
            ..............................................................................<br>
            PERSONAL QUIEN DERIVA
            </th>
            <th style="text-align:center; fsont-size:1.2em;">
            ..............................................................................<br>'.utf8_encode($rPersona['ApelPers']).', '.utf8_encode($rPersona["NombPers"]).'<br><b>
            '.utf8_encode($rPersona["NombTipoPers"]).'</b>           
            </th>
          </tr>
       </table>
    </main>';
$mpdf = new mPDF('c','A4');
//$css = file_get_contents('css/style.css');
//$mpdf->writeHTML($css, 1);
$mpdf->writeHTML($html);
$mpdf->Output('reporte-caso.php','I');

?>