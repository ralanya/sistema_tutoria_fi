<?php 
include("conexion.php");
$archivo=$_FILES["archivo"]["tmp_name"];
$nombrearchivo=$_FILES["archivo"]["name"];
move_uploaded_file($archivo, "hojas de excel/".$nombrearchivo);

						require_once'php/ext/PHPExcel-1.7.7/Classes/PHPExcel/IOFactory.php';
						include("conexion.php");
						//cargamos el archivo que deseamos leer
						$objPHPExcel = PHPExcel_IOFactory::load("hojas de excel/$nombrearchivo");
						//obtenemos los datos de la hoja activa (la primera)
						$objHoja=$objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
						
						//recorremos las filas obtenidas
						foreach ($objHoja as $iIndice=>$objCelda) {							
							
							$DniEst = ($objCelda['A']);
							$Estudiante = utf8_decode($objCelda['B']);
							$GradoSeccion = utf8_decode($objCelda['C']);	
							$Descripcion = utf8_decode($objCelda['D']);						
							$DniPers = ($objCelda['E']);
							$Personal = utf8_decode($objCelda['F']);								
							$Fecha = ($objCelda['G']);								
							list($mes,$dia,$anio) = explode("-",$Fecha);
							$Fecha2 = $anio."-".$mes."-".$dia;
							$sql = mysqli_query($cn,"SELECT * FROM estudiante WHERE DniEst = '$DniEst'");
							$rEst = mysqli_fetch_array($sql);
							$IdEstudiante = $rEst["IdEstudiante"];

							$sql2 = mysqli_query($cn,"SELECT * FROM personal WHERE DniPers = '$DniPers'");
							$rPers = mysqli_fetch_array($sql2);
							$IdPersonal = $rPers["IdPersonal"];

							$CodInci = 0;
							$MaxInci = "select max(IdIncidencia) from incidencia";
							$cs = mysqli_query($cn,$MaxInci);
							while($resul = mysqli_fetch_array($cs)){
								$CodInci = $resul[0] + 1;
							}
							$InsertDeri = "INSERT INTO incidencia
							VALUES('$CodInci','$Fecha2','$Descripcion','$IdEstudiante','$IdPersonal')";
							mysqli_query($cn,$InsertDeri);

						}
						header("location: registro.php");
					