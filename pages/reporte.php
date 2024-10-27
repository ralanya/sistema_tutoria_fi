<?php
  include("conexion.php");
  include("auth.php");

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
  <title>Reporte | FI 2019</title>
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
      <!-- search form -->
      
      <!-- /.search form -->
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
        <li><a href="http://192.168.1.50:8080/sistemacolegio/vistas/tutoria.php" target="_blank"><i class="fa fa-user"></i> <span>Datos Familiares</span></a></li>
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
        Reportes de Información - 
        <small>CONTROL DE INCIDENCIAS 2019</small>
      </h1>
      
    </section>
    
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Incidencias por Estudiante</h3>
            </div>
            
            <form role="form" method="post" enctype="multipart/form-data" action="reporte_incidencia_est" autocomplete="off">
              <div class="box-body">
                <div class="form-group">
                  <label>Ingrese DNI del Estudiante:</label>
                  <input type="text" maxlength="8" name="txtDniEst" id="txtDniEst" class="form-control" placeholder="Por favor ingrese el DNI" required />
                </div> 
                <div class="form-group">
                  <label>Seleccione Fecha Inicio:</label>
                  <input type="date" maxlength="8" name="txtFIniEst" id="txtFIniEst" class="form-control" required/>
                </div> 
                <div class="form-group">
                  <label>Seleccione Fecha Fin:</label>
                  <input type="date" maxlength="8" name="txtFFinEst" id="txtFFinEst" class="form-control" required/>
                </div> 
              </div>              
              <div class="box-footer">
                <button type="submit" class="btn btn-primary"><img src="images/ver.png"/> Ver Reporte</button>
              </div>
            </form>
          </div>
          
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Logros por Grado y Sección</h3>
            </div>
            <form role="form" method="post" enctype="multipart/form-data" action="reporte_logro_gs">
            <div class="box-body">                
                
                <div class="form-group">
                  <label>Seleccione un grado y sección:</label>
                  <select class="form-control" name="lstOpcion" id="lstOpcion">
                    <option value="Todos">TODOS</option>
                  <?php
                  $sqlgs = "SELECT DISTINCT GSEst FROM estudiante";
                  $filags = mysqli_query($cn,$sqlgs);
                  while($rgs = mysqli_fetch_array($filags))
                  {
                    echo '<option value="'.utf8_encode($rgs["GSEst"]).'">'.utf8_encode($rgs["GSEst"]).'</option>';
                  }
                  ?>                   
                  </select>
                </div>   
                <div class="form-group">
                  <label>Seleccione Fecha Inicio:</label>
                  <input type="date" maxlength="8" name="txtFIniEst5" id="txtFIniEst5" class="form-control" required />
                </div> 
                <div class="form-group">
                  <label>Seleccione Fecha Fin:</label>
                  <input type="date" maxlength="8" name="txtFFinEst5" id="txtFFinEst5" class="form-control" required />
                </div>             
              </div>
             
             <div class="box-footer">
                <button type="submit" class="btn btn-primary"><img src="images/ver.png" /> Ver Reporte</button>                
              </div>
            </form>
            <!-- /.box-body -->
          </div>
        </div>
        
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-6">
          <!-- Horizontal Form -->
          <!-- Form Element sizes -->
          <?php
          if($Tipo!=5){
          ?>
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Incidencias por Grado y Sección</h3>
            </div>
            <form role="form" method="post" enctype="multipart/form-data" action="reporte_incidencia_gs">
            <div class="box-body">                
                
                <div class="form-group">
                  <label>Seleccione un grado y sección:</label>
                  <select class="form-control" name="lstOpcion" id="lstOpcion">
                    <option value="Todos">TODOS</option>
                  <?php
                  $sqlgs = "SELECT DISTINCT GSEst FROM estudiante";
                  $filags = mysqli_query($cn,$sqlgs);
                  while($rgs = mysqli_fetch_array($filags))
                  {
                    echo '<option value="'.utf8_encode($rgs["GSEst"]).'">'.utf8_encode($rgs["GSEst"]).'</option>';
                  }
                  ?>                   
                  </select>
                </div>   
                <div class="form-group">
                  <label>Seleccione Fecha Inicio:</label>
                  <input type="date" maxlength="8" name="txtFIniEst3" id="txtFIniEst3" class="form-control" required />
                </div> 
                <div class="form-group">
                  <label>Seleccione Fecha Fin:</label>
                  <input type="date" maxlength="8" name="txtFFinEst3" id="txtFFinEst3" class="form-control" required />
                </div>             
              </div>
              
             <div class="box-footer">
                <button type="submit" class="btn btn-primary"><img src="images/ver.png"> Ver Reporte</button>
              </div>
            </form>
            <!-- /.box-body -->
          </div>   
          <?php
          }
          else{}
          ?>       
            
              <script src="../dist/js/jquery-1.11.1.min.js"></script>
              <script>
              function reporteWord(){
                var fini = $('#txtFIniEst').val();
                var ffin = $('#txtFFinEst').val();       

                if(fini==""){                
                  alert("Por favor seleccione la fecha Inicio");               
                } 
                else if(ffin==""){
                  alert("Por favor seleccione la fecha Fin");    
                }   
                else{
                  window.open('../pages/reportederivacionword.php?fini='+fini+'&ffin='+ffin);
                } 
              }
              function reporteExcel(){
                var fini = $('#txtFIniEst').val();
                var ffin = $('#txtFFinEst').val();       

                if(fini==""){                
                  alert("Por favor seleccione la Fecha Inicio");               
                } 
                else if(ffin==""){
                  alert("Por favor seleccione la Fecha Fin");    
                }   
                else{
                  window.open('../pages/reportederivacionexcel.php?fini='+fini+'&ffin='+ffin);
                } 
              }
              </script>
                            
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Derivaciones</h3>
            </div>
            <form role="form" method="post" enctype="multipart/form-data" action="reporte_derivacion">
              <div class="box-body">
                <div class="form-group">
                    <label>Seleccione Fecha Inicio:</label>
                    <input type="date" maxlength="8" name="txtFIniEst2" id="txtFIniEst2" class="form-control" required/>
                  </div>
                <div class="form-group">
                  <label>Seleccione Fecha Fin:</label>
                  <input type="date" maxlength="8" name="txtFFinEst2" id="txtFFinEst2" class="form-control" required/>
                  </div> 
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary"><img src="images/ver.png"> Ver Reporte</button>
              </div>
            </form> 
            <!-- /.box-body -->
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
    <strong>Derechos de Autor: RAC ENGINEERS | Derechos Reservados &copy; FI 2019</strong> 
  </footer>

  
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
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
</body>
</html>
