<?php
  include("auth.php");
  include("conexion.php");
  $DniPers=$_SESSION["usuario"];

  $sql="select * from personal p, tipo_personal tp where p.IdTipoPers = tp.IdTipoPers and DniPers='$DniPers'";
  $fila=mysqli_query($cn,$sql);
  $r=mysqli_fetch_array($fila);

  $IdEst = $_GET["txtIdEstudiante"];
  $IdLog = $_GET["txtIdLogro"];
  $sql2 = "select * from estudiante e, logro l where e.IdEstudiante = l.IdEstudiante and l.IdLogro = '$IdLog'";
  $fila2 = mysqli_query($cn,$sql2);
  $r2 = mysqli_fetch_array($fila2);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Actualiza  | FI 2019</title>
  <link rel="shortcut icon" href="../dist/img/insigniaFI.png">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
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
                  <a href="actualiza_datos" class="btn btn-default btn-flat">Ver Datos</a>
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
        <li class="active"><a href="registro"><i class="fa fa-table"></i> <span>Registro</span></a></li>
        <?php
        if($r["NombTipoPers"]=="CIST"){
          echo '<li><a href="cargadatos"><i class="fa fa-edit"></i> <span>Carga de datos</span></a></li>';
        }
        else if($r["IdTipoPers"]==1 || $r["IdTipoPers"]==7 || $r["IdTipoPers"]==8){
          echo '<li><a href="derivacion"><i class="fa fa-edit"></i> <span>Derivacion</span></a></li>';
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
        Entradas de Logros - 
        <small>CONTROL DE INCIDENCIAS 2018</small>
      </h1>
      
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-xs-12">
          <!-- general form elements -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Datos Personal</h3>
            </div>
            <script src="../dist/js/jquery-1.11.1.min.js"></script>
            <script>
            $(function(){
            $("#btnActualizaLogro").on("click", function(){
                            var formData = new FormData($("#FrmLogro")[0]);
                            var ruta = "../dist/form/p_actualiza_logro.php";
                            $.ajax({
                                url: ruta,
                                type: "POST",
                                data: formData,
                                contentType: false,
                                processData: false,
                                success: function(resp){
                                    if(resp=="Datos Actualizados Correctamente"){
                                      alert(resp)
                                    }
                                    else if(resp!="Datos Actualizados Correctamente"){
                                      alert(resp)
                                    }
                                                                     
                                }
                            });

                        });
            });
            </script>
            <!-- form start -->
            <form id="FrmLogro" class="formulario" role="form" method="post" enctype="multipart/form-data">
              <div class="box-body">                
                <div class="form-group">
                  <label for="exampleInputFile">Estudiante</label>
                  <input type="text" id="archivo" name="txtAlumno" class="form-control" value="<?php echo utf8_encode($r2["ApelEst"]).', '.utf8_encode($r2["NombEst"]).' - '.utf8_encode($r2["GSEst"]); ?>" readonly="readonly">                 
                </div> 
                <div class="form-group">
                    <label>DESCRIPCIÓN (*)</label>
                    <textarea class="form-control" rows="3" name="txtLogro" style="font-size:16px" placeholder="Por favor describa el logro..." required/><?php echo utf8_encode($r2["DescLog"]); ?></textarea>
                </div>
                <div class="form-group">
                    <label>OBSERVACIÓN</label>
                    <textarea class="form-control" rows="3" name="txtObservacion" style="font-size:16px" placeholder=""/><?php echo utf8_encode($r2["ObsLog"]); ?></textarea>
                </div>
              </div>
              (*) Campos obligatorios
              <div class="box-footer">
                <input type="hidden" name="txtIdLogro" value="<?php echo $r2["IdLogro"]; ?>" />
                <input type="hidden" name="txtIdEstudiante" value="<?php echo $r2["IdEstudiante"]; ?>" />
                <a class="btn btn-primary" id="btnActualizaLogro"><img src="images/save.png" /> Actualizar Logro</a>
                <?php echo '<a class="btn btn-primary" href="reporte_logro?txtIdEstudiante='.$r2["IdEstudiante"].'"><img src="images/regresa.png" />  Regresar</a>'; ?>
              </div>
            </form>
          </div>                       
        </div>
        <!--/.col (right) -->
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
    <strong>Derechos de Autor: RAC ENGINNERS | Derechos Reservados &copy; FI 2019</strong> 
  </footer>
  
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
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
</body>
</html>
