<?php
  include("auth.php");
  include("conexion.php");
  $DniPers=$_SESSION["usuario"];

  $sql="select * from personal p, tipo_personal tp where p.IdTipoPers = tp.IdTipoPers and DniPers='$DniPers'";
  $fila=mysqli_query($cn,$sql);
  $r=mysqli_fetch_array($fila);
  $IdTipo = $r["IdTipoPers"];
  if($IdTipo==5){ $IdTipo="('C')"; } else{$IdTipo="('C','D')";}

  $DniEst = $_POST["txtDniEst"];
  $Fecha1="";
  $Fecha2="";
if(isset ($_POST['txtFIniEst']) && ($_POST['txtFFinEst']))
{
  $FIniEst = $_POST["txtFIniEst"];
  $Fecha1 = $FIniEst;
  list($anio1,$mes1,$dia1) = explode("-",$FIniEst);
  $FFinEst = $_POST["txtFFinEst"];
  $Fecha2 = $FFinEst;
  list($anio2,$mes2,$dia2) = explode("-",$FFinEst);
  
  $sql2 = "SELECT * FROM estudiante e, incidencia i, personal p
      WHERE e.IdEstudiante = i.IdEstudiante AND i.IdPersona = p.IdPersonal AND e.DniEst = '$DniEst' AND EstIncid = '1' AND i.FechaIncid BETWEEN '$FIniEst' AND '$FFinEst' AND i.InfoIncid IN $IdTipo";
  $fila2 = mysqli_query($cn,$sql2);
  $FIniEst2 = $dia1."/".$mes1."/".$anio1;
  $FFinEst2 = $dia2."/".$mes2."/".$anio2;
}
else
{
  $FIniEst = '1111-01-01';
  $FFinEst = '9999-12-30';
  $sql2 = "SELECT * FROM estudiante e, incidencia i
      WHERE e.IdEstudiante = i.IdEstudiante 
     AND e.DniEst = '$DniEst' AND EstIncid = '1' AND i.FechaIncid BETWEEN '$FIniEst' AND '$FFinEst' AND i.InfoIncid IN $IdTipo ORDER BY i.FechaIncid";
  $fila2 = mysqli_query($cn,$sql2);

  $FIniEst = '__/__/____';
  $FFinEst = '__/__/____';
}
$sql3 = "SELECT e.IdEstudiante, e.NombEst, e.ApelEst, e.GSEst, e.FNacEst FROM estudiante e
        WHERE e.DniEst = '$DniEst'";
$fila3 = mysqli_query($cn,$sql3);
$r3 = mysqli_fetch_array($fila3);

//Calculando edad
  //fecha de nacimiento
  if($r3["FNacEst"]!=""){
    $FHoy = date("Y-m-d");
    list($ano,$mes,$dia) = explode("-",$FHoy);
    $Fnac = $r3["FNacEst"];
    list($anonaz,$mesnaz,$dianaz) = explode("-",$Fnac);
    
    //si el mes es el mismo pero el día inferior aun no ha cumplido años, le quitaremos un año al actual
    if (($mesnaz == $mes) && ($dianaz > $dia)) {
    $ano=($ano-1); }

    //si el mes es superior al actual tampoco habrá cumplido años, por eso le quitamos un año al actual
    if ($mesnaz > $mes) {
    $ano=($ano-1);}

    //ya no habría mas condiciones, ahora simplemente restamos los años y mostramos el resultado como su edad
    $edad=($ano-$anonaz);
  }
  else{
    $edad = "0";
  }
  
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Incidencia | FI 2019</title>
  <link  rel="shortcut icon" href="../dist/img/insigniaFI.png" />
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="../index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">FI</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">CONTROL FI 2019</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="../dist/img/usuario.png" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo utf8_encode($r["NombPers"]); ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="../dist/img/usuario.png" class="img-circle" alt="User Image">
                <p>
                  <?php echo utf8_encode($r["NombPers"]); ?>
                  <small>DNI: <?php echo $r["DniPers"]; ?></small>
                </p>
              </li>
              <!-- Menu Body -->
              
              <!-- Menu Footer-->
              <li class="user-footer">                
                <div class="pull-right">
                  <a href="actualiza_datos.php" class="btn btn-default btn-flat">Ver Datos</a>
                </div>
              </li>
            </ul>
          </li>          
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../dist/img/user.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo utf8_encode($r["NombPers"]); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Conectado</a>
        </div>
      </div>
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MENU PRINCIPAL</li>        
        <li><a href="registro"><i class="fa fa-table"></i> <span>Registro</span></a></li>
        <?php
        if($r["NombTipoPers"]=="CIST"){
          echo '<li><a href="cargadatos"><i class="fa fa-edit"></i> <span>Carga de datos</span></a></li>';
        }
        else if($r["IdTipoPers"]==1 || $r["IdTipoPers"]==7 || $r["IdTipoPers"]==8){
          echo '<li><a href="derivacion"><i class="fa fa-edit"></i> <span>Derivacion</span></a></li>';
        }
        else{}
        ?>
        <li class="active"><a href="reporte"><i class="fa fa-book"></i> <span>Reportes</span></a></li>
        <li><a href="cerrarsesion"><i class="fa fa-share"></i> <span>Salir</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Registro de Incidencias - 
        <small>CONTROL DE INCIDENCIAS 2019</small>
      </h1>
      
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         

          <div class="box">
            <div class="box-body">            
            <?php 
            if($r3["ApelEst"]=="") {
              echo 'ESTUDIANTE:<input type="text" id="archivo" name="txtAlumno" class="form-control" value="ESTUDIANTE NO REGISTRADO" readonly="readonly"> <br>';
            }
            else{
              echo 'ESTUDIANTE:<input type="text" id="archivo" name="txtAlumno" class="form-control" value="'.utf8_encode($r3["ApelEst"]).', '.utf8_encode($r3["NombEst"]).'" readonly="readonly" style="font-size:16px"> <br>';
            }
            ?>
            GRADO Y SECCIÓN: <input type="text" class="form-control" value="<?php echo utf8_encode($r3["GSEst"]) ?>" readonly="readonly" style="font-size:16px"/><br>
            EDAD: <input type="text" class="form-control" value="<?php echo $edad.' años'; ?>" readonly="readonly" style="font-size:16px"/><br>
            FECHAS: <input type="text" class="form-control" value="<?php echo 'Desde: '.$FIniEst2.' - Hasta: '.$FFinEst2; ?>" readonly="readonly" style="font-size:16px"/>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Código</th>
                  <th>Persona quien derivo el caso</th>
                  <th>Incidencias</th>
                  <th width="20%">Descripción</th>
                  <th>Tipo</th>
                  <th>Fecha</th>                 
                </tr>
                </thead>
                <tbody>
                <?php
                while($r2 = mysqli_fetch_array($fila2))
                {    
                  $FIncid = $r2["FechaIncid"];
                  list($anio,$mes,$dia) = explode("-",$FIncid);
                  $FIncid  = $dia."/".$mes."/".$anio;         
                  $Tipo2 = $r2["InfoIncid"];
                  if($Tipo2 == "C"){   $Tipo2 = "Cotidiana";  } else { $Tipo2 = "Específica"; }        
                  echo '
                  <tr>                  
                    <td style="vertical-align:middle;">'.$r2["IdIncidencia"].'</td>  
                    <td style="vertical-align:middle;">'.utf8_encode($r2["ApelPers"]).', '.utf8_encode($r2["NombPers"]).'</td> 
                    <td>'; 
                    $IdIncid = $r2["IdIncidencia"];
                    $sqlDeriva = mysqli_query($cn,"SELECT * FROM detalle_incidencia di, tipo_incidencia ti WHERE di.IdTipoIncid = ti.IdTipoIncid AND di.IdIncidencia='$IdIncid'");
                    //Otro motivo
                    $sqlMotivo = mysqli_query($cn,"SELECT OtroIncid FROM Incidencia WHERE IdIncidencia = '$IdIncid'");
                    $rMotivo = mysqli_fetch_array($sqlMotivo);
                    $Motivo = $rMotivo["OtroIncid"];

                    while($rDeriva = mysqli_fetch_array($sqlDeriva)){                      
                      echo '<input type="checkbox" class="minimal" value="'.$rDeriva["IdTipoIncid"].'" name="tipoderiva1[]" checked disabled> '.utf8_encode($rDeriva["NombTipoIncid"]).'<br>';                    
                    }
                    if($Motivo!=""){
                      echo '<input type="checkbox" class="minimal" value="" name="" checked disabled> OTROS: '.$Motivo.'<br>';
                    }
                    echo'</td>
                    <td style="vertical-align:middle;">'.substr(utf8_encode($r2["DescIncid"]),0,80).'...</td>
                    <td style="vertical-align:middle;">'.$Tipo2.'</td>
                    <td style="vertical-align:middle;">'.$FIncid.'</td>                    
                  </tr>';
                }
                ?>
                </tbody>
              </table>
              <input type="hidden" maxlength="8" name="txtDniEst" id="txtDniEst" class="form-control" value="<?php echo $DniEst; ?>" />
              <input type="hidden" maxlength="8" name="txtFIniEst" id="txtFIniEst" class="form-control" value="<?php echo $Fecha1; ?>" />
              <input type="hidden" maxlength="8" name="txtFFinEst" id="txtFFinEst" class="form-control" value="<?php echo $Fecha2; ?>" />
              
              <div class="box-footer">
                <a class="btn btn-primary" href="reporte"><img src="images/regresa.png"/> Regresar</a>
                <?php echo '<a class="btn btn-primary" target="_blank" href="reportes/ficha-incidencia-est?Dni='.$DniEst.'&FIniEst='.$FIniEst.'&FFinEst='.$FFinEst.'&Tipo='.$r["IdTipoPers"].'"><img src="images/print.png"/> Imprimir</a>'; ?>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.0
    </div>
    <strong>Derechos de Autor: RAC ENGINEERS | Derechos Reservados &copy; FI 2019</strong> 
  </footer>

  
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>
</body>
</html>
