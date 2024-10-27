<?php

  include("auth.php");
  include("conexion.php");
  $DniPers=$_SESSION["usuario"];

  $sql="select * from personal p, tipo_personal tp where p.IdTipoPers = tp.IdTipoPers and DniPers='$DniPers'";
  $fila=mysqli_query($cn,$sql);
  $r=mysqli_fetch_array($fila);
  $Tipo = $r["IdTipoPers"];

  $IdEst = $_GET["txtIdEstudiante"];
  $sql3 = "select * from estudiante e where IdEstudiante = '$IdEst'";
  $fila3 = mysqli_query($cn,$sql3);
  $r3 = mysqli_fetch_array($fila3);

  $sql2 = "select * from estudiante e, detalle_estudiante de where e.IdDetalleEst = de.IdDetalleEst and IdEstudiante = '$IdEst'";
  $fila2 = mysqli_query($cn,$sql2);
  $r2 = mysqli_fetch_array($fila2);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Familia | FI</title>
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
          <a><i class="fa fa-circle text-success"></i> <?php echo utf8_encode($r["NombTipoPers"]); ?></a>
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
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Resumen Datos Familiares - 
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
              <h3 class="box-title">Datos Personal</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <script src="../dist/js/jquery-1.11.1.min.js"></script>
            <script>
            $(function(){
            $("#btnActualiza").on("click", function(){
                            var formData = new FormData($("#FrmFamilia")[0]);
                            var ruta = "../dist/form/p_actualiza_familia.php";
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
            <form id="FrmFamilia" role="form" method="post" enctype="multipart/form-data" autocomplete="off">
              <div class="box-body">                
                <div class="form-group">
                  <label>Estudiante</label>
                  <input type="text" id="archivo" name="archivo" value="<?php echo utf8_encode($r3["ApelEst"]).', '.$r3["NombEst"].' - '.utf8_encode($r3["GSEst"]); ?>" readonly="readonly" class="form-control">                 
                </div>
                <div class="form-group">
                  <label>¿Con quién vives?</label>
                  <input type="text" id="txtCQV" name="txtCQV" value="<?php echo utf8_encode($r2["CQVEst"]) ?>" class="form-control" >                 
                </div> 
                <div class="form-group">
                  <label>Sacramento</label>
                  <input type="text" id="txtSacra" name="txtSacra" value="<?php echo utf8_encode($r2["SacraEst"]) ?>" class="form-control" >                 
                </div>   
                <div class="form-group">
                  <label>¿Quien te ayuda con la tarea?</label>
                  <input type="text" id="txtAyudaTarea" name="txtAyudaTarea" value="<?php echo utf8_encode($r2["AyudaTareaEst"]) ?>" class="form-control" >                 
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">¿Cuántos hermanos son?</label>
                  <input type="text" id="txtCantHerm" name="txtCantHerm" value="<?php echo utf8_encode($r2["CantHermEst"]) ?>" class="form-control" >                 
                </div> 
                <div class="form-group">
                  <label>¿Qué lugar ocupas?</label>
                  <input type="text" id="txtLugarHerm" name="txtLugarHerm" value="<?php echo utf8_encode($r2["LugarHermEst"]) ?>" class="form-control" >                 
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Hermanos en el colegio</label>
                  <input type="text" id="txtHermCole" name="txtHermCole" value="<?php echo utf8_encode($r2["HermColeEst"]) ?>" class="form-control" >                 
                </div> 
                <div class="form-group">
                  <label>Procedencia de la familia</label>
                  <input type="text" id="txtProce" name="txtProce" value="<?php echo utf8_encode($r2["ProceEst"]) ?>" class="form-control" >                 
                </div>
                <div class="form-group">
                  <label>Casa</label>
                  <input type="text" id="txtCasa" name="txtCasa" value="<?php echo utf8_encode($r2["CasaEst"]) ?>" class="form-control" >                 
                </div>   
                <div class="form-group">
                  <label>¿Tus padres estan casados?</label>
                  <input type="text" id="txtPadreCas" name="txtPadreCas" value="<?php echo utf8_encode($r2["PadreCasEst"]) ?>" class="form-control" >                 
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">¿Violencia fisica y/o psicologica?</label>
                  <input type="text" id="txtVioleFP" name="txtVioleFP" value="<?php echo utf8_encode($r2["VioleFPEst"]) ?>" class="form-control" >                 
                </div>              
              </div>    
          </div>                     
        </div>



        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-6">
          <!-- Horizontal Form -->
          <!-- Form Element sizes -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Datos Padre</h3>
            </div>            
            
            <div class="box-body">
                <div class="form-group">
                  <label>¿Tu padre vive?</label>
                  <input type="text" id="txtPadreV" name="txtPadreV" value="<?php echo utf8_encode($r2["PadreVEst"]) ?>" class="form-control" >                 
                </div>
                <div class="form-group">
                  <label>Profesión y/o oficio del padre</label>
                  <input type="text" id="txtProfPadre" name="txtProfPadre" value="<?php echo utf8_encode($r2["ProfPadreEst"]) ?>" class="form-control" >                 
                </div> 
                <div class="form-group">
                  <label>¿Donde trabaja tu padre?</label>
                  <input type="text" id="txtTrabPadre" name="txtTrabPadre" value="<?php echo utf8_encode($r2["TrabPadreEst"]) ?>" class="form-control" >                 
                </div>  
            </div>
            <!-- /.box-body -->
          </div>
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Datos Madre</h3>
            </div>           
            
            <div class="box-body">
                <div class="form-group">
                  <label>¿Tu madre vive?</label>
                  <input type="text" id="txtMadreV" name="txtMadreV" value="<?php echo utf8_encode($r2["MadreVEst"]) ?>" class="form-control" >                 
                </div>
                <div class="form-group">
                  <label>Profesión y/o oficio de la madre</label>
                  <input type="text" id="txtProfMadre" name="txtProfMadre" value="<?php echo utf8_encode($r2["ProfMadreEst"]) ?>" class="form-control" >                 
                </div> 
                <div class="form-group">
                  <label>¿Donde trabaja tu madre?</label>
                  <input type="text" id="txtTrabMadre" name="txtTrabMadre" value="<?php echo utf8_encode($r2["TrabMadreEst"]) ?>" class="form-control" >                 
                </div>  
            </div>
            <script>
              function reporteFamilia(){
              var txtIdEstudiante = $('#txtIdEstudiante').val();
              window.open('../pages/reportefamiliaword.php?txtIdEstudiante='+txtIdEstudiante);
              }
              </script>
            <div class="box-footer">
                <input type="hidden" id="txtIdDetalle" name="txtIdDetalle" value="<?php echo $r2["IdDetalleEst"] ?>" class="form-control" >                 
                <input type="hidden" id="txtIdEstudiante" name="txtIdEstudiante" value="<?php echo $IdEst ?>" class="form-control" >    
                <?php
                if($Tipo==8){
                ?>             
                <a id="btnActualiza" class="btn btn-primary"><img src="images/save.png" /> Actualizar datos</a>
                <a class="btn btn-primary" target="_blank" href="javascript:reporteFamilia();"><img src="images/Word2013.png" /> Generar Word</a>
                <?php 
                }
                ?>
                <a class="btn btn-primary" href="registro"><img src="images/regresa.png" /> Regresar</a>
            </div>
            </form>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
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
