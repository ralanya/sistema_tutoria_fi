<?php

  include("auth.php");
  include("conexion.php");
  $DniPers=$_SESSION["usuario"];

  $sql="select * from personal p, tipo_personal tp where p.IdTipoPers = tp.IdTipoPers and DniPers='$DniPers'";
  $fila=mysqli_query($cn,$sql);
  $r=mysqli_fetch_array($fila);
  $IdPers = $r["IdPersonal"];
  if($r["IdTipoPers"]==8){
    $listado = mysqli_query($cn,"SELECT * FROM derivacion d, estudiante e, personal p 
    WHERE d.IdEstudiante = e.IdEstudiante AND d.IdPersonal = p.IdPersonal AND d.IdPersona = '$IdPers' AND TipoDeri = 1 AND EstDeri = '1'"); 
  }
  else if($r["IdTipoPers"]==7){
    $listado = mysqli_query($cn,"SELECT * FROM derivacion d, estudiante e, personal p 
    WHERE d.IdEstudiante = e.IdEstudiante AND d.IdPersona = p.IdPersonal AND EstDeri = '1'"); 
  }
  else if($r["IdTipoPers"]!=8 AND $r["IdTipoPers"]!=7 AND $r["IdTipoPers"]!=5 AND $r["IdTipoPers"]!=15){
    $listado = mysqli_query($cn,"SELECT * FROM derivacion d, estudiante e, personal p 
    WHERE d.IdEstudiante = e.IdEstudiante AND d.IdPersonal = p.IdPersonal AND TipoDeri = 2 AND EstDeri = '1'"); 
  }
  /*else if($r["IdTipoPers"]==5){
    $listado = mysqli_query($cn,"SELECT * FROM derivacion d, estudiante e, personal p 
    WHERE d.IdEstudiante = e.IdEstudiante AND d.IdPersona = p.IdPersonal AND TipoDeri = 3 AND EstDeri = '1'")
  }*/
  else if($r["IdTipoPers"]==5 || $r["IdTipoPers"]==15){
    $listado = mysqli_query($cn,"SELECT * FROM derivacion d, estudiante e, personal p 
    WHERE d.IdEstudiante = e.IdEstudiante AND d.IdPersona = p.IdPersonal AND EstDeri = '1' AND d.IdPersonal = '$IdPers'");
  }
  $IdTipo = $r["IdTipoPers"];
  
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Derivaciones | FI 2019</title>
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
<body class="hold-transition skin-blue sidebar-mini" >
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
                  <a href="cerrarsesion.php" class="btn btn-default btn-flat">Cerrar Sesión</a>
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
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MENU PRINCIPAL</li>        
        <li><a href="registro"><i class="fa fa-table"></i> <span>Registro</span></a></li>
        <?php
        if($r["IdTipoPers"]==11){
          echo '<li><a href="cargadatos"><i class="fa fa-edit"></i> <span>Carga de datos</span></a></li>';
        }
        if($r["IdTipoPers"]==1 || $r["IdTipoPers"]==7 || $r["IdTipoPers"]==8 || $r["IdTipoPers"]==5 || $r["IdTipoPers"]==15){
          echo '<li class="active"><a href="derivacion"><i class="fa fa-edit"></i> <span>Derivacion</span></a></li>';
        }        
        ?>
        <li><a href="http://192.168.1.50:8080/sistemacolegio/vistas/tutoria.php" target="_blank"><i class="fa fa-user"></i> <span>Datos Familiares</span></a></li>
        <?php
        if($r["IdTipoPers"]==1 || $r["IdTipoPers"]==7 || $r["IdTipoPers"]==8 || $r["IdTipoPers"]==11){
          echo '<li><a href="reporte"><i class="fa fa-book"></i> <span>Reportes</span></a></li>';
        }
        ?>        
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
        Registro de Derivaciones - 
        <small>CONTROL DE INCIDENCIAS 2019</small>
      </h1>      
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">   
            <div class="box-body">
              <script src="../dist/js/jquery-1.11.1.min.js"></script>
              <script>
              $(function(){
              $("#btnAtiende").on("click", function(){
                              var formData = new FormData($("#FrmAtiende")[0]);
                              var ruta = "../dist/form/p_atiende_derivacion.php";
                              $.ajax({
                                  url: ruta,
                                  type: "POST",
                                  data: formData,
                                  contentType: false,
                                  processData: false,
                                  success: function(resp){
                                      alert(resp)
                                      document.location.href="derivacion.php";                                 
                                  }
                              });

                          });
              });
              </script>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Código</th>
                  <th>Estudiante</th>
                  <th>GS</th>
                  <?php
                  $Tipo = $r["IdTipoPers"];
                  if($Tipo==8 || $Tipo==1){
                    echo '<th>Persona quien deriva el caso</th>';  
                  } 
                  else if($Tipo==7 || $Tipo==5 || $Tipo==15){
                    echo '<th>Persona quien recibe el caso</th>';  
                  }
                  ?>                
                  <th>Estado</th>
                  <th>Área</th>
                  <th>Fecha</th>
                  <?php                  
                  if($Tipo==8 || $Tipo==1){
                    echo '<th>Acción</th>';                          
                  }
                  else if($Tipo==7){
                    echo '<th>Acción</th>
                          <th>Actualizar</th>
                          ';
                  }
                  ?>
                  <th>Boleta</th>
                </tr>
                </thead>
                <tbody>
                <?php
                while($r = mysqli_fetch_array($listado))
                {
                  if($r["TipoDeri"] == 1){ $Area = "PSICOLOGÍA";} else{ $Area = "DIRECCIÓN"; }
                  $url="images/atiende.png";
                  $FDeri = $r["FechDeri"];
                  list($anio,$mes,$dia) = explode("-",$FDeri);
                  $FDeri  = $dia."/".$mes."/".$anio;   
                  echo '
                  <tr>
                    <td style="vertical-align:middle;">'.utf8_encode($r["IdDerivacion"]).'</td>
                    <td style="vertical-align:middle;">'.utf8_encode($r["ApelEst"]).', '.utf8_encode($r["NombEst"]).'</td>
                    <td style="vertical-align:middle; text-align:center;">'.$r["GSEst"].'</td>
                    <td style="vertical-align:middle;">'.utf8_encode($r["ApelPers"]).', '.utf8_encode($r["NombPers"]).'</td>
                    <td style="vertical-align:middle; text-align:center;">';
                    if($r["AteDeri"]==0){
                      echo "NO ATENDIDO";
                    }
                    else{
                      echo "ATENDIDO";
                    }
                    
                    echo '<td style="vertical-align:middle;">'.$Area.'</td>
                    <td style="vertical-align:middle;">'.$FDeri.'</td>';
                    if($Tipo==7){  ?>      

                    <td style="text-align:center; vertical-align:middle;">
                      <a onclick="javascript:return confirm('¿Seguro de eliminar este registro de <?php echo utf8_encode($r["ApelEst"]); ?>?');" href="../dist/form/p_elimina_derivacion.php?txtIdDerivacion=<?php echo $r["IdDerivacion"]?>"><img src="images/eliminar.png" /></a>
                    </td>
                    <td style="text-align:center; vertical-align:middle;">
                      <a href="actualiza_derivacion.php?txtIdDerivacion=<?php echo $r["IdDerivacion"]?>&txtIdEstudiante=<?php echo $r["IdEstudiante"]; ?>"><img src="images/actualizar.png" /></a>
                    </td>
                    <?php
                    }
                    else if($Tipo==8 || $Tipo==1){
                    echo '<td style="text-align:center; vertical-align:middle;">';
                      if($r["AteDeri"]==0){
                    ?>
                        <a onclick="javascript:return confirm('¿Seguro de ATENDER la derivación de <?php echo utf8_encode($r["ApelEst"]); ?>?');" href="../dist/form/p_atiende_derivacion.php?txtIdDerivacion=<?php echo $r["IdDerivacion"]?>"><img src="images/atiende.png" /></a>
                    <?php
                    }
                    else{
                    ?>
                    <a onclick="javascript:return confirm('¿Seguro de NO ATENDER la derivación de <?php echo utf8_encode($r["ApelEst"]); ?>?');" href="../dist/form/p_atiende_derivacion.php?txtIdDerivacion=<?php echo $r["IdDerivacion"]?>"><img src="images/atiende.png" /></a>
                    <?php   
                    }
                  }
                    echo '<td style="text-align:center; vertical-align:middle;">
                      <a href="detalle_derivacion.php?txtIdDerivacion='.$r["IdDerivacion"].'&txtIdEstudiante='.$r["IdEstudiante"].'"><img src="images/boleta.png" /></a>
                    </td>';
                    echo '</td>';
                    
                  echo '</tr>';
                }
                ?>
                </tbody>
              </table>              
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
