<?php
$db_host = 'localhost';
$db_name='bd_dnj_tutoria';
$db_user='root';
$db_pass='';

$fecha = date("Ymd-His");
//$salida_sql = $db_name.'_'.$fecha.'.sql';
$salida_sql = $db_name.'.sql';
$ruta = 'D:\prueba bd';
$dump = "mysqldump -h$db_host -u$db_user -p$db_pass --opt $db_name > $salida_sql";
system($dump,$output);
echo $output;
?>