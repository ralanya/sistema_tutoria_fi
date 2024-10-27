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
							$DniEst = $objCelda['A'];
							$ApelEst = utf8_decode($objCelda['B']);
							$NombEst = utf8_decode($objCelda['C']);
							$GSEst = $objCelda['D'];
							$SexoEst = $objCelda['E'];
							$FNac = $objCelda['F'];										
							list($dia,$mes,$anio) = explode("/",$FNac);
							$FNac = $anio."-".$mes."-".$dia;
							$MaxEst = "select max(IdEstudiante) from estudiante";
							$cs = mysqli_query($cn,$MaxEst);
							while($resul = mysqli_fetch_array($cs)){
								$CodEst = $resul[0] + 1;
							}

							$BuscaAula = mysqli_query($cn,"SELECT * FROM aula WHERE NombAula LIKE '%$GSEst%'");
							if(mysqli_num_rows($BuscaAula)>0){
								$rBuscaAula = mysqli_fetch_array($BuscaAula);
								$IdAula = $rBuscaAula["IdAula"];
							}
							else{
								$MaxAula = "select max(IdAula) from aula";
								$csAula = mysqli_query($cn,$MaxAula);
								while($resul = mysqli_fetch_array($csAula)){
									$IdAula = $resul[0] + 1;
								}
								$InsertAula = mysqli_query($cn,"INSERT INTO aula VALUES('$IdAula','$GSEst')");
							}

							$InsertEst="INSERT INTO estudiante(IdEstudiante,ApelEst,NombEst,GSEst,SexoEst,DniEst,FNacEst,IdDetalleEst,IdAula)
							VALUES('$CodEst','$ApelEst','$NombEst','$GSEst','$SexoEst','$DniEst','$FNac','0','$IdAula')";
							mysqli_query($cn,$InsertEst);			
						}
						header("location: registro.php");
					