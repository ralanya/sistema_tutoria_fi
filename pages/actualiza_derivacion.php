<?php

  include("auth.php");
  include("conexion.php");
  $DniPers=$_SESSION["usuario"];

  $sql="select * from personal p, tipo_personal tp where p.IdTipoPers = tp.IdTipoPers and DniPers='$DniPers'";
  $fila=mysqli_query($cn,$sql);
  $r=mysqli_fetch_array($fila);
  $IdPersonal = $r["IdPersonal"];
  if(isset($_POST["txtIdEstudiante"]))
  {
    $IdEst = $_POST["txtIdEstudiante"];
  }
  else if(isset($_GET["txtIdEstudiante"]))
  {
    $IdEst = $_GET["txtIdEstudiante"];
  }

  if(isset($_GET["txtIdDerivacion"]))
  {
    $IdDerivacion = $_GET["txtIdDerivacion"];
  }
 
  $sql2 = "select * from estudiante where IdEstudiante = '$IdEst'";
  $fila2 = mysqli_query($cn,$sql2);
  $r2 = mysqli_fetch_array($fila2);

  $sql_deri = mysqli_query($cn,"SELECT * FROM derivacion d, personal p, tipo_personal tp WHERE d.IdPersona = p.IdPersonal AND tp.IdTipoPers = p.IdTipoPers AND IdDerivacion = '$IdDerivacion'");
  $r_deri = mysqli_fetch_array($sql_deri);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Incidencia | FI</title>
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
    <a href="#" class="logo">
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
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="../dist/img/usuario.png" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo utf8_encode($r["NombPers"]); ?></span>
            </a>
            <ul class="dropdown-menu">
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
          <a href="#"><i class="fa fa-circle text-success"></i> <?php echo utf8_encode($r["NombTipoPers"]); ?></a>
        </div>
      </div>
      
      <ul class="sidebar-menu">
        <li class="header">MENU PRINCIPAL</li>        
        <li><a href="registro"><i class="fa fa-table"></i> <span>Registro</span></a></li>
        <?php
        if($r["NombTipoPers"]=="CIST"){
          echo '<li><a href="cargadatos"><i class="fa fa-edit"></i> <span>Carga de datos</span></a></li>';
        }
        else if($r["IdTipoPers"]==1 || $r["IdTipoPers"]==7 || $r["IdTipoPers"]==8){
          echo '<li class="active"><a href="derivacion"><i class="fa fa-edit"></i> <span>Derivacion</span></a></li>';
        }
        else{}
        ?>
        <li><a href="reporte"><i class="fa fa-book"></i> <span>Reportes</span></a></li>
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
        Actualiza Derivación - 
        <small>CONTROL DE INCIDENCIAS 2019</small>
      </h1>
      
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <script src="../dist/js/jquery-1.11.1.min.js"></script>
            <script>
            $(function(){
            $("#btnDeriva").on("click", function(){
                            var formData = new FormData($("#FrmDerivacion")[0]);
                            var ruta = "../dist/form/p_actualiza_deriva.php";
                            $.ajax({
                                url: ruta,
                                type: "POST",
                                data: formData,
                                contentType: false,
                                processData: false,
                                success: function(resp){
                                    alert(resp)                                                                     
                                }
                            });

                        });
            });

            $(function(){
            $("#btnDeriva2").on("click", function(){
                            var formData = new FormData($("#FrmDerivacion")[0]);
                            var ruta = "../dist/form/p_actualiza_deriva2.php";
                            $.ajax({
                                url: ruta,
                                type: "POST",
                                data: formData,
                                contentType: false,
                                processData: false,
                                success: function(resp){
                                    alert(resp)                                                                     
                                }
                            });

                        });
            });
            </script>
          <form id="FrmDerivacion" role="form" method="post" enctype="multipart/form-data" autocomplete="off">
          <center><h3>FICHA DE DETECCIÓN Y DERIVACIÓN DE CASOS DE ESTUDIANTES</h3></center>
          <div class="box">
            <div class="box-body">
            <?php
            if($r["IdTipoPers"]==5){
              $sql3 = "select * from incidencia i, personal p where i.IdPersona = p.IdPersonal and IdEstudiante = '$IdEst' and c.InfoIncid = 'C' and EstIncid = '1'";  
            }
            else{
              $sql3 = "select * from incidencia i, personal p where i.IdPersona = p.IdPersonal and IdEstudiante = '$IdEst' and EstIncid = '1'";
            }
            $ejecuta3 = mysqli_query($cn,$sql3);
            $cant_inci = mysqli_num_rows($ejecuta3);
            ?>
            APELLIDOS Y NOMBRES: <input type="text" id="archivo" name="txtAlumno" class="form-control" value="<?php echo utf8_encode($r2["ApelEst"]).', '.utf8_encode($r2["NombEst"]).''; ?>" readonly="readonly" style="font-size:16px"> <br>
            GRADO Y SECCIÓN: <input type="text" id="archivo" name="txtAlumno" class="form-control" value="<?php echo utf8_encode($r2["GSEst"]); ?>" readonly="readonly" style="font-size:16px"> <br>
            <?php
              $fecha1 = $r_deri['FechDeri'];
              list($anio1,$mes1,$dia1) = explode("-",$fecha1);
              $fecha1 = $dia1."-".$mes1."-".$anio1;
            ?>
            FECHA: <input type="text" id="archivo" name="txtAlumno" class="form-control" value="<?php echo $fecha1; ?>" readonly="readonly" style="font-size:16px"> <br>
                             
                  <div class="form-group">
                    <label>MOTIVO DE DERIVACIÓN</label>
                    <textarea rows="2" value="" name="txtMotiDeri" class="form-control" placeholder="Por favor escriba el motivo de derivación..."><?php echo $r_deri["DescDeri"] ?></textarea>             
                  </div>
                  <div class="form-group">
                    <label>ACCIONES YA REALIZADAS</label>
                    <textarea rows="2" value="" name="txtAcciRea" class="form-control" placeholder="Por favor escriba las acciones ya realizadas..."><?php echo $r_deri["AcreDeri"] ?></textarea>
                  </div>

                  <div class="form-group">
                    <label>PERSONAL QUE RECIBE EL CASO</label>
                    <select id="lstPsicologo" name="lstPsicologo" class="form-control" style="width: 44%">  
                    <?php
                    
                    echo '<option value="'.$r_deri["IdPersonal"].'">'.utf8_encode($r_deri["ApelPers"]).', '.utf8_encode($r_deri["NombPers"]).' ('.utf8_encode($r_deri["NombTipoPers"]).')</option>';
                    $sql3 = mysqli_query($cn,"SELECT * FROM personal p, tipo_personal tp WHERE p.IdTipoPers = tp.IdTipoPers AND tp.IdTipoPers = 8");
                    while($r3 = mysqli_fetch_array($sql3))
                    {
                      echo '<option value="'.$r3["IdPersonal"].'">'.utf8_encode($r3["ApelPers"]).', '.utf8_encode($r3["NombPers"]).'</option>';
                    } 
                    ?>                      
                    </select>               
                  </div>
                  <?php
                  echo '<a id="btnDeriva" class="btn btn-primary"><img src="images/psicologo.png" /> Derivar a psicología</a>
                        <a id="btnDeriva2" class="btn btn-primary" style="background:#1B8FB0;"><img src="images/direccion.png" /> Derivar a dirección</a>';
                  
                  ?>
            </div>
            <div class="box-body">             
            
              <div class="box-footer">
                <input type="hidden" id="txtIdEstudiante" name="txtIdEstudiante" value="<?php echo $r2["IdEstudiante"]; ?>" />
                <input type="hidden" id="txtIdPersonal" name="txtIdPersonal" value="<?php echo $IdPersonal ?>" />
                <input type="hidden" id="txtIdDerivacion" name="txtIdDerivacion" value="<?php echo $r_deri["IdDerivacion"] ?>" />
                <a class="btn btn-primary" href="derivacion" style="background:#1B8FB0"><img src="images/regresa.png" /> Regresar</a>
              </div>
              </form>
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
    <strong>Derechos de Autor: RAC ENGINEERS | Derechos Reservados &copy; FI 2018</strong> 
  </footer>  
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