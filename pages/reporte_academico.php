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
 
  $sql2 = "select * from estudiante where IdEstudiante = '$IdEst'";
  $fila2 = mysqli_query($cn,$sql2);
  $r2 = mysqli_fetch_array($fila2);
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
        <li class="active"><a href="registro"><i class="fa fa-table"></i> <span>Registro</span></a></li>
        <?php
        if($r["IdTipoPers"]==11){
          echo '<li><a href="cargadatos"><i class="fa fa-edit"></i> <span>Carga de datos</span></a></li>';
        }
        if($r["IdTipoPers"]==1 || $r["IdTipoPers"]==7 || $r["IdTipoPers"]==8 || $r["IdTipoPers"]==5 || $r["IdTipoPers"]==15){
          echo '<li><a href="derivacion"><i class="fa fa-edit"></i> <span>Derivacion</span></a></li>';
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
        Registro de Incidencias - 
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
                            var ruta = "../dist/form/p_deriva.php";
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
                            var ruta = "../dist/form/p_deriva2.php";
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
          
          <div class="box">
            <div class="box-body">
            <?php
            if($r["IdTipoPers"]==5 or $r["IdTipoPers"]==15){
              $sql3 = "select * from incidencia i, personal p where i.IdPersona = p.IdPersonal and IdEstudiante = '$IdEst' and i.InfoIncid = 'C' and EstIncid = '1'";  
            }
            else{
              $sql3 = "select * from incidencia i, personal p where i.IdPersona = p.IdPersonal and IdEstudiante = '$IdEst' and EstIncid = '1'";
            }
            $ejecuta3 = mysqli_query($cn,$sql3);
            $cant_inci = mysqli_num_rows($ejecuta3);
            ?>

            APELLIDOS Y NOMBRES: <input type="text" id="archivo" name="txtAlumno" class="form-control" value="<?php echo utf8_encode($r2["ApelEst"]).', '.utf8_encode($r2["NombEst"]).''; ?>" readonly="readonly" style="font-size:16px"> <br>
            GRADO Y SECCIÓN: <input type="text" id="archivo" name="txtAlumno" class="form-control" value="<?php echo utf8_encode($r2["GSEst"]); ?>" readonly="readonly" style="font-size:16px"> <br>
            FECHA: <input type="text" id="archivo" name="txtAlumno" class="form-control" value="<?php echo date("d-m-Y"); ?>" readonly="readonly" style="font-size:16px"> <br>
            CANTIDAD INCIDENCIAS: <input type="text" id="txtCantidad" name="txtCantidad" class="form-control" value="<?php echo $cant_inci; ?>" readonly="readonly" style="font-size:16px"/>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Codigo</th>
                  <th>Personal que deriva el caso</th>
                  <th width="20%">Descripción</th>
                  <th>Tipo</th>
                  <th>Fecha</th>
                  <?php 
                  $Tipo = $r["IdTipoPers"];
                  if($Tipo==7 or $Tipo==11){
                    echo '<th style="text-align:center;">Actualizar</th>   
                          <th style="text-align:center;">Eliminar</th>';
                  }
                  ?>
                  <th style="text-align:center;">Boleta</th>                
                </tr>
                </thead>
                <tbody>
                <?php
                while($r3 = mysqli_fetch_array($ejecuta3))
                {               
                $FIncid = $r3["FechaIncid"];
                $Tipo2 = $r3["InfoIncid"];
                if($Tipo2 == "C"){   $Tipo2 = "Cotidiana";  } else { $Tipo2 = "Específico"; }
                list($anio,$mes,$dia) = explode("-",$FIncid);
                $FIncid  = $dia."/".$mes."/".$anio;   
                $url="images/eliminar.png";
                $url2="images/actualiza.png";
                $url3="images/boleta.png";
                  echo '
                  <tr>            
                    <td style="vertical-align:middle;">'.($r3["IdIncidencia"]).'</td>     
                    <td style="vertical-align:middle;">'.utf8_encode($r3["ApelPers"]).', '.utf8_encode($r3["NombPers"]).'</td>   
                    <td style="vertical-align:middle;">'.substr(utf8_encode($r3["DescIncid"]),0,80).'...</td>
                    <td style="vertical-align:middle;">'.$Tipo2.'</td>
                    <td style="vertical-align:middle;">'.$FIncid.'</td>';
                    if($Tipo==7 or $Tipo==11){
                    echo '
                    <td style="text-align:center; vertical-align:middle;">
                    <a href="actualiza_entrada?txtIdEstudiante='.$IdEst.'&txtIdIncidencia='.$r3["IdIncidencia"].'" title="Actualizar"><img src="images/actualizar.png" /></a>                      
                    </td>'; 
                    ?>

                    <td style="text-align:center; vertical-align:middle;">
                      <a onclick="javascript:return confirm('¿Seguro de eliminar este registro?');" href="../dist/form/p_elimina_incidencia.php?txtIdIncidencia=<?php echo $r3["IdIncidencia"] ?>&txtIdEstudiante=<?php echo $IdEst;  ?>"><img src="images/eliminar.png" /></a>
                    </td>

                    <?php
                    }
                    echo '<td style="text-align:center; vertical-align:middle;">                    
                      <a href="detalle_incidencia?txtIdIncidencia='.$r3["IdIncidencia"].'&txtIdEstudiante='.$IdEst.'" title="Ver Boleta" /><img src="'.$url3.'" style="width:50px; height:50px; color:transparent; border:none;"/></a>                      
                    </td>                                
                  </tr>';
                }
                ?>
                </tbody>
              </table>
            
              <div class="box-footer">
                <input type="hidden" id="txtIdEstudiante" name="txtIdEstudiante" value="<?php echo $r2["IdEstudiante"]; ?>" />
                <input type="hidden" id="txtIdPersonal" name="txtIdPersonal" value="<?php echo $IdPersonal ?>" />
                <?php       
                if($Tipo==7 or $Tipo==5 or $Tipo==15){
                echo '<a class="btn btn-primary" href="entrada?txtIdEstudiante='.$IdEst.'" style="background:#1B8FB0"><img src="images/falta2.png" /> Agregar caso</a>'; 
                }
                ?>
                <a class="btn btn-primary" href="registro" style="background:#1B8FB0"><img src="images/regresa.png" /> Regresar</a>
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