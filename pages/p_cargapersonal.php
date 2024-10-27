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
							
							//$IdEstudiante = ($objCelda['A']);
							$ApelPers = utf8_decode($objCelda['B']);
							$NombPers = utf8_decode($objCelda['C']);
							$EspePers = utf8_decode($objCelda['D']);
							$DniPers = $objCelda['E'];
							$TelfPers = $objCelda['F'];
							$EmailPers = utf8_decode($objCelda['G']);
							$FnacPers = $objCelda['H'];
							$SexoPers = $objCelda['I'];
							$TipoPers = $objCelda['J'];
							
							
							$BuscaCar="SELECT IdTipoPers, NombTipoPers FROM tipo_personal WHERE NombTipoPers LIKE  '%$TipoPers%'";
							$filaCar=mysqli_query($cn,$BuscaCar);
							$rCar= mysqli_fetch_array($filaCar);
							$numCar = mysqli_num_rows($filaCar);
							
							$CodTipoPers = 0;

							if($numCar>0){							
								$CodTipoPers = $rCar["IdTipoPers"];
							}
							else{	
									$maxCar = "select max(IdTipoPers) from tipo_personal";
									$filamaxCar = mysqli_query($cn,$maxCar);
									if($rmaxCar=mysqli_fetch_row($filamaxCar)){
										$CodTipoPers = trim($rmaxCar[0]+1);
									}			
								if($TipoPers == "")
								{
									$InsertCar="INSERT INTO tipo_personal(IdTipoPers, NombTipoPers) VALUES ('$CodTipoPers','NO DEFINIDO')";		
									mysqli_query($cn,$InsertCar);
								}	
								else
								{
									$InsertCar="INSERT INTO tipo_personal(IdTipoPers, NombTipoPers) VALUES ('$CodTipoPers','$TipoPers')";		
									mysqli_query($cn,$InsertCar);
								}	
								
							}
								
							$CodPers = 0;
							$MaxEst = "select max(IdPersonal) from personal";
							$cs = mysqli_query($cn,$MaxEst);
							while($resul = mysqli_fetch_array($cs)){
								$CodPers = $resul[0] + 1;
							}
							

							$InsertEst="INSERT INTO personal 
							VALUES('$CodPers','$ApelPers','$NombPers','$EspePers','$TelfPers','$DniPers','$EmailPers','$FnacPers','$SexoPers','$CodTipoPers')";
							mysqli_query($cn,$InsertEst);
						}
						header("location: cargadatos.php");
					