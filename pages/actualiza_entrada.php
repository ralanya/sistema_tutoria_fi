<?php
  include("auth.php");
  include("conexion.php");
  $DniPers=$_SESSION["usuario"];

  $sql="select * from personal p, tipo_personal tp where p.IdTipoPers = tp.IdTipoPers and DniPers='$DniPers'";
  $fila=mysqli_query($cn,$sql);
  $r=mysqli_fetch_array($fila);

  $IdEst = $_GET["txtIdEstudiante"];
  $IdIncid = $_GET["txtIdIncidencia"];
  $sql2 = "select * from estudiante e, incidencia i where i.IdEstudiante = e.IdEstudiante and e.IdEstudiante = '$IdEst' and i.IdIncidencia = '$IdIncid'";
  $fila2 = mysqli_query($cn,$sql2);
  $r2 = mysqli_fetch_array($fila2);

  $IdPersona = $r2["IdPersona"];
  $sqlPersona = mysqli_query($cn,"SELECT * FROM incidencia i, personal p, tipo_personal tp WHERE i.IdPersona = p.IdPersonal AND p.IdTipoPers = tp.IdTipoPers AND i.IdPersona = '$IdPersona'");
  $rPersona = mysqli_fetch_array($sqlPersona);

  //fecha de nacimiento
  $FHoy = date("Y-m-d");
  list($ano,$mes,$dia) = explode("-",$FHoy);
  $Fnac = $r2["FNacEst"];
  list($anonaz,$mesnaz,$dianaz) = explode("-",$Fnac);
  
  //si el mes es el mismo pero el día inferior aun no ha cumplido años, le quitaremos un año al actual
  if (($mesnaz == $mes) && ($dianaz > $dia)) {
  $ano=($ano-1); }

  //si el mes es superior al actual tampoco habrá cumplido años, por eso le quitamos un año al actual
  if ($mesnaz > $mes) {
  $ano=($ano-1);}

  //ya no habría mas condiciones, ahora simplemente restamos los años y mostramos el resultado como su edad
  $edad=($ano-$anonaz);

  //Otro motivo
  $sqlMotivo = mysqli_query($cn,"SELECT OtroIncid FROM Incidencia WHERE IdIncidencia = '$IdIncid'");
  $rMotivo = mysqli_fetch_array($sqlMotivo);
  $Motivo = $rMotivo["OtroIncid"];
  
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Actualiza | FI 2019</title>
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
        Actualiza Incidencia - 
        <small>CONTROL DE INCIDENCIAS 2019</small>
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
            $("#btnActualizaIncidencia").on("click", function(){
                            var formData = new FormData($("#FrmIncidencia")[0]);
                            var ruta = "../dist/form/p_actualiza_incidencia.php";
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
            <style>         
          .formulario input[type="radio"]{
            display: none;        
          }
          .formulario .radio label{
            color:#0074D9;
            background: rgba(0,0,0,.1);
            padding: 5px 15px 5px 30px;
            display: inline-block;
            position: relative;
            font-size: 1em;
            border-radius: 3px;
            cursor: pointer;
            -webkit-transition: all 0.3s ease;
            -o-transition: all 0.3s ease;
            transition: all 0.3s ease;  
          } 
          .formulario .radio label:hover{
            background: rgba(0,116,217,0.2);
          }
          .formulario .radio label:before{
            content: "";
            width: 17px;
            height: 17px;
            display: inline-block;
            background: none;
            border:3px solid #0774D9;
            border-radius: 50%;
            position: absolute;
            left: 5px;
            top:middle;
          }
          .formulario input[type="radio"]:checked + label{
            padding: 5px 15px;
            background: #0074D9;
            border-radius: 2px;
            color:#fff;        
          }
          .formulario input[type="radio"]:checked + label:before{
            display: none;      
          }
          </style>
            <!-- form start -->
            <form id="FrmIncidencia" class="formulario" role="form" method="post" enctype="multipart/form-data">
              <div class="box-body">                
                <div class="form-group">
                  <label>ESTUDIANTE</label>
                  <input type="text" id="archivo" name="txtAlumno" class="form-control" value="<?php echo utf8_encode($r2["ApelEst"]).', '.utf8_encode($r2["NombEst"]); ?>" readonly="readonly" style="font-size:14px">
                </div>
                <div class="form-group">
                  <label>GRADO Y SECCIÓN</label>
                  <input type="text" id="archivo" name="txtAlumno" class="form-control" value="<?php echo utf8_encode($r2["GSEst"]); ?>" readonly="readonly" style="font-size:14px">
                </div>
                <div class="form-group">
                  <label>EDAD</label>
                  <input type="text" id="archivo" name="txtAlumno" class="form-control" value="<?php echo $edad.' años'; ?>" readonly="readonly" style="font-size:14px">
                </div>
                <div class="form-group">
                  <label>FECHA DE REGISTRO</label>
                  <?php
                  $fecha1 = $r2['FechaIncid'];
                  list($anio1,$mes1,$dia1) = explode("-",$fecha1);
                  $fecha1 = $dia1."-".$mes1."-".$anio1;
                  ?>
                  <input type="text" id="fecharegistro" name="fecharegistro" class="form-control" style="font-size:14px;" value="<?php echo $fecha1; ?>" readonly="readonly">                  
                </div>
                <div class="form-group">
                  <label>TIPO INFORMACIÓN (*)</label>
                  <div class="radio">                    
                    <?php 
                    if($r2["InfoIncid"]=="C"){
                      echo '<input name="btnradio" id="SI" type="radio" value="C" checked>
                    <label for="SI">COTIDIANA</label>
                    <input name="btnradio" id="NO" type="radio" value="D">
                    <label for="NO">ESPECÍFICA</label>';
                    }
                    else if($r2["InfoIncid"]=="D"){
                      echo '<input name="btnradio" id="SI" type="radio" value="C">
                    <label for="SI">COTIDIANA</label>
                    <input name="btnradio" id="NO" type="radio" value="D" checked>
                    <label for="NO">ESPECÍFICA</label>';
                    }
                    ?>             
                  </div>            
                </div>
                <div class="form-group">
                  <label>DERIVADOR POR: (*)</label><br>
                    <?php 
                    $IdIncid = $r2["IdIncidencia"];
                    $sqlDeriva = mysqli_query($cn,"SELECT * FROM detalle_incidencia di, tipo_incidencia ti WHERE di.IdTipoIncid = ti.IdTipoIncid AND di.IdIncidencia='$IdIncid'");
                    while($rDeriva = mysqli_fetch_array($sqlDeriva)){
                      
                          echo '<input type="checkbox" class="minimal" value="'.$rDeriva["IdTipoIncid"].'" name="tipoderiva1[]" checked> '.utf8_encode($rDeriva["NombTipoIncid"]).'<br>';                    
                    }
                    $sqlDeriva2 = mysqli_query($cn,"SELECT * FROM tipo_incidencia WHERE NOT IdTipoIncid IN (SELECT IdTipoIncid FROM detalle_incidencia WHERE IdIncidencia = '$IdIncid')");
                    while($rDeriva2 = mysqli_fetch_array($sqlDeriva2)){
                      
                          echo '<input type="checkbox" class="minimal" value="'.$rDeriva2["IdTipoIncid"].'" name="tipoderiva2[]"> '.utf8_encode($rDeriva2["NombTipoIncid"]).'<br>';
                    }
                    ?>  
                    <script>
                      function habilitar(value)
                      {
                        if(value==true)
                        {
                          // habilitamos
                          document.getElementById("txtMotivo").disabled=false;
                        }else if(value==false){
                          // deshabilitamos
                          document.getElementById("txtMotivo").disabled=true;
                        }
                      }
                    </script>

                    <?php
                    if($Motivo == ""){
                      echo '<input type="checkbox" class="minimal" value="1" name="chkMotivo" id="chkMotivo" onchange="habilitar(this.checked);"> OTROS
                      <textarea class="form-control" rows="1" name="txtMotivo" id="txtMotivo" style="font-size:14px; width: 50%" disabled/></textarea>';
                    }
                    else{
                      echo '<input type="checkbox" class="minimal" value="2" name="chkMotivo" id="chkMotivo" onchange="habilitar(this.checked);" checked> OTROS
                      <textarea class="form-control" rows="1" name="txtMotivo" id="txtMotivo" style="font-size:14px; width: 50%" />'.$Motivo.'</textarea>';
                    }
                    ?>  
                                         
                </div> 
                               
                <div class="form-group">
                    <label>DESCRIPCIÓN (*)</label>
                    <textarea class="form-control" rows="3" name="txtDescripcion" style="font-size:14px" placeholder="Por favor describa la incidencia..." required/><?php echo utf8_encode($r2["DescIncid"]); ?></textarea>
                </div>

                <div class="form-group">
                    <label>PERSONAL QUIÉN REPORTA EL CASO (*)</label>
                    <select name="txtIdPersona" class="form-control">
                      <option value="<?php echo $rPersona["IdPersonal"] ?>"><?php echo utf8_encode($rPersona["ApelPers"]).", ".utf8_encode($rPersona["NombPers"])." (".utf8_encode($rPersona["NombTipoPers"]).")"; ?></option>
                      <?php
                      $sqlPers = mysqli_query($cn,"SELECT * FROM personal p, tipo_personal tp WHERE p.IdTipoPers = tp.IdTipoPers ORDER BY p.ApelPers ASC");
                      while ($rPers = mysqli_fetch_array($sqlPers)) {
                        echo '<option value="'.$rPers["IdPersonal"].'">'.utf8_encode($rPers["ApelPers"]).', '.utf8_encode($rPers["NombPers"]).' ('.utf8_encode($rPers["NombTipoPers"]).')</option>';
                      }
                      ?>                      
                    </select>
                </div>

                <div class="form-group">
                    <label>OBSERVACIÓN</label>
                    <textarea class="form-control" rows="3" name="txtObservacion" style="font-size:16px" placeholder="" required/><?php echo utf8_encode($r2["ObsIncid"]); ?></textarea>
                </div>
              </div>
              (*) Campos obligatorios
              <div class="box-footer">
                <input type="hidden" name="txtIdIncidencia" value="<?php echo $r2["IdIncidencia"]; ?>" />
                <input type="hidden" name="txtIdEstudiante" value="<?php echo $r2["IdEstudiante"]; ?>" />
                <a class="btn btn-primary" id="btnActualizaIncidencia"><img src="images/save.png" /> Actualizar Incidencia</a>
                <?php echo '<a class="btn btn-primary" href="reporte_academico?txtIdEstudiante='.$r2["IdEstudiante"].'"><img src="images/regresa.png" />  Regresar</a>'; ?>
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
    <strong>Derechos de Autor: RAC ENGINEERS | Derechos Reservados &copy; FI 2019</strong> 
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
