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
							$DniEst = utf8_decode($objCelda['A']);										
							$CQVEst = utf8_decode($objCelda['B']);
							$SacraEst = utf8_decode($objCelda['C']);
							$PadreVEst = utf8_decode($objCelda['D']);	
							$ProfPadreEst = utf8_decode($objCelda['E']);	
							$TrabPadreEst = utf8_decode($objCelda['F']);
							$MadreVEst = utf8_decode($objCelda['G']);	
							$ProfMadreEst = utf8_decode($objCelda['H']);	
							$TrabMadreEst = utf8_decode($objCelda['I']);
							$AyudaTareaEst = utf8_decode($objCelda['J']);
							$CantHermEst = utf8_decode($objCelda['K']);
							$LugarHermEst = utf8_decode($objCelda['L']);
							$HermColeEst = utf8_decode($objCelda['M']);
							$ProceEst = utf8_decode($objCelda['N']);
							$CasaEst = utf8_decode($objCelda['O']);
							$PadreCasEst = utf8_decode($objCelda['P']);
							$VioleFPEst = utf8_decode($objCelda['Q']);

							$CodDetaEst = 0;
							$MaxDetaEst = "select max(IdDetalleEst) from detalle_estudiante";
							$cs = mysqli_query($cn,$MaxDetaEst);
							while($resul = mysqli_fetch_array($cs)){
								$CodDetaEst = $resul[0] + 1;
							}
							$InsertDetaEst = "INSERT INTO detalle_estudiante(IdDetalleEst,CQVEst,SacraEst,PadreVEst,ProfPadreEst,TrabPadreEst,MadreVEst,ProfMadreEst,TrabMadreEst,AyudaTareaEst,CantHermEst,LugarHermEst,HermColeEst,ProceEst,CasaEst,PadreCasEst,VioleFPEst) 
							VALUES('$CodDetaEst','$CQVEst','$SacraEst','$PadreVEst','$ProfPadreEst','$TrabPadreEst','$MadreVEst','$ProfMadreEst','$TrabMadreEst','$AyudaTareaEst','$CantHermEst','$LugarHermEst','$HermColeEst','$ProceEst','$CasaEst','$PadreCasEst','$VioleFPEst')";
							mysqli_query($cn,$InsertDetaEst);

							

							$ActuEst="UPDATE estudiante SET IdDetalleEst = '$CodDetaEst' WHERE DniEst = '$DniEst'";
							mysqli_query($cn,$ActuEst);			
						}
						header("location: registro.php");
					