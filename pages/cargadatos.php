<?php
include("auth.php");
include("conexion.php");
$DniPers=$_SESSION["usuario"];

$sql="select * from personal p, tipo_personal tp where p.IdTipoPers = tp.IdTipoPers and DniPers='$DniPers'";
$fila=mysqli_query($cn,$sql);
$r=mysqli_fetch_array($fila);
$Tipo = $r["IdTipoPers"];
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Carga Datos | FI 2019</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link  rel="shortcut icon" href="../dist/img/insigniaFI.png" />
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/iCheck/square/blue.css">
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
    <a href="" class="logo">
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
      </a>
      <!-- Navbar Right Menu -->
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
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
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
        <li class="active"><a href="cargadatos"><i class="fa fa-edit"></i> <span>Carga de datos</span></a></li>
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
        Carga de Datos -
        <small>CONTROL DE INCIDENCIAS 2018</small>
      </h1>     
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->

        <div class="col-md-6">
          <!-- Horizontal Form -->
          <!-- Form Element sizes -->
          <?php
          if($Tipo == 11){
          ?>
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Datos Estudiante</h3>
            </div>
            <form id="FrmEntrada" role="form" method="post" action="p_cargaestudiante.php" enctype="multipart/form-data">
                      
            <div class="box-body">                
                <div class="form-group">
                  <label for="exampleInputFile">Seleccione Archivo</label>
                  <input type="file" id="archivo" name="archivo" required> 
                  (*) Debe tener el formato correcto<br>
                  <a href="hojas de excel/FORMATO ESTUDIANTE.xlsx" target="_blank">DESCARGAR FORMATO DE ESTUDIANTES</a>                  
                </div>                           
                <div class="box-footer">
                <button type="submit" class="btn btn-primary"><img src="images/subir.png" /> Subir Datos</button>
              </div>
            </form>
            </div>  
          </div> 
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Datos Personal</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="p_cargapersonal.php" method="post" enctype="multipart/form-data">
              <div class="box-body">                
                <div class="form-group">
                  <label for="exampleInputFile">Seleccione Archivo</label>
                  <input type="file" id="archivo" name="archivo" required> 
                  (*) Debe tener el formato correcto<br>
                  <a href="hojas de excel/FORMATO PERSONAL.xlsx" target="_blank">DESCARGAR FORMATO DE PERSONAL</a> 
                </div>                
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary"><img src="images/subir.png" /> Subir Datos</button>
              </div>
            </form>
          </div>
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Asignar Aula</h3>
            </div>
            <script src="../dist/js/jquery-1.11.1.min.js"></script>
            <script>
            $(function(){
            $("#btnGuardaAula").on("click", function(){
                            var formData = new FormData($("#FrmAula")[0]);
                            var ruta = "../dist/form/p_asigna_aula.php";
                            $.ajax({
                                url: ruta,
                                type: "POST",
                                data: formData,
                                contentType: false,
                                processData: false,
                                success: function(resp){
                                    if(resp=="Asignación Guardada Correctamente"){
                                      alert(resp)
                                      $('#FrmAula')[0].reset()      
                                    }
                                    else if(resp!="Asignación Guardada Correctamente"){
                                        alert(resp)
                                         return false;
                                    }                                                                  
                                }
                            });

                        });
            });
            </script>
            <form id="FrmAula" role="form" method="post" action="p_cargaestudiante.php" enctype="multipart/form-data">   
            <div class="box-body">                
                <div class="form-group">
                  <label for="exampleInputFile">Seleccione Grado y Sección</label>
                  <select name="lstGS" class="form-control" >
                    <?php
                    $sql = mysqli_query($cn,"SELECT * FROM aula");
                    while($r = mysqli_fetch_array($sql)){
                      echo '<option value="'.$r["IdAula"].'">'.$r["NombAula"].'</option>';
                    }
                    ?>                    
                  </select>                  
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Seleccione Personal</label>
                  <select name="lstPersonal" class="form-control" >
                    <?php
                    $sql = mysqli_query($cn,"SELECT * FROM personal p, tipo_personal tp WHERE p.IdTipoPers = tp.IdTipoPers AND p.IdTipoPers IN ('15','5')");
                    while($r = mysqli_fetch_array($sql)){
                      echo '<option value="'.$r["IdPersonal"].'">'.utf8_encode($r["ApelPers"]).', '.utf8_encode($r["NombPers"]).' ('.utf8_encode($r["NombTipoPers"]).')</option>';
                    }
                    ?>                    
                  </select>                  
                </div>                           
                <div class="box-footer">
                <a class="btn btn-primary" id="btnGuardaAula"><img src="images/save.png" /> Asignar Aula</a>
              </div>
            </form>
            </div>  
          </div> 
          
          <?php
          }
          else{
          }
          ?> 
          <!-- /.box -->
        </div> 

        <div class="col-md-6">         
          <?php
          if($Tipo == 11){
          ?>
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Datos Familia</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="p_cargafamilia.php" method="post" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputFile">Seleccione Archivo</label>
                  <input type="file" id="archivo" name="archivo" required> 
                  (*) Debe tener el formato correcto<br>
                  <a href="hojas de excel/FORMATO FAMILIA.xlsx" target="_blank">DESCARGAR FORMATO DE FAMILIA</a>

                </div>                
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary"><img src="images/subir.png" /> Subir Datos</button>
              </div>
            </form>
          </div> 
          <?php
          }
          else{}
          ?>
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Incidencias</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="p_cargaincidencia.php" method="post" enctype="multipart/form-data">
              <div class="box-body">                
                <div class="form-group">
                  <label for="exampleInputFile">Seleccione Archivo</label>
                  <input type="file" id="archivo" name="archivo" required> 
                  (*) Debe tener el formato correcto<br>
                  <a href="hojas de excel/FORMATO INCIDENCIA.xlsx" target="_blank">DESCARGAR FORMATO DE INCIDENCIAS</a> 
                </div>                
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary"><img src="images/subir.png" /> Subir Datos</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- /.row -->
    </section>
    
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.0
    </div>
    <strong>Derechos de Autor: RAC SOLUTIONS | Derechos Reservados &copy; FI 2019</strong> 
  </footer>

  
    <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->

      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>


</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../bootstrap/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/app.min.js"></script>
<!-- Sparkline -->
<script src="../plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS 1.0.1 -->
<script src="../plugins/chartjs/Chart.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard2.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
</body>
</html>
