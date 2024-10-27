<?php  
  include("conexion.php");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Encuesta | FI 2019</title>
  <link rel="shortcut icon" href="../dist/img/insigniaFI.png">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
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
          <script src="../dist/js/jquery-1.11.1.min.js"></script>
            <script>
            $(function(){
            $("#btnGuardaIncidencia").on("click", function(){
                            var formData = new FormData($("#FrmIncidencia")[0]);
                            var ruta = "../dist/form/p_incidencia.php";
                            $.ajax({
                                url: ruta,
                                type: "POST",
                                data: formData,
                                contentType: false,
                                processData: false,
                                success: function(resp){
                                    if(resp=="Incidencia Guardado Correctamente"){
                                      alert(resp)
                                      $('#FrmIncidencia')[0].reset()      
                                    }
                                    else if(resp!="Incidencia Guardado Correctamente"){
                                        alert(resp)
                                         return false;
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
              <span class="hidden-xs">ESTUDIANTE</span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                <img src="../dist/img/usuario.png" class="img-circle" alt="User Image">
                <p>
                  ESTUDIANTE
                  <small>Bienvenido(a)</small>
                </p>
              </li>
              <!-- Menu Body -->
             
              <!-- Menu Footer-->
              <li class="user-footer">               
                <div class="pull-right">
                  <a href="acceso" class="btn btn-default btn-flat">Salir</a>
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
          <p>ESTUDIANTE</p>
          <a href="#"><i class="fa fa-circle text-success"></i> EN LÍNEA</a>
        </div>
      </div>
      
      
      <ul class="sidebar-menu">
        <li class="header">MENU PRINCIPAL</li>        
        <li class="active"><a href="encuesta"><i class="fa fa-table"></i> <span>Encuesta</span></a></li>        
        <li><a href="acceso"><i class="fa fa-share"></i> <span>Salir</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Encuesta Estudiante 
        <small>CONTROL DE INCIDENCIAS 2018</small>
      </h1>
      
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-xs-6">
          <!-- general form elements -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">1. DATOS PERSONALES</h3>
            </div>
            <!-- /.box-header -->            
            <!-- form start -->
            <form id="FrmIncidencia" class="formulario" role="form" method="post" enctype="multipart/form-data">
              <div class="box-body">                
                <div class="form-group">
                  <label>APELLIDOS</label>
                  <input type="text" id="txtApellidos" name="txtApellidos" class="form-control" style="font-size:14px" placeholder="Ingrese sus apellidos...">
                </div>
                <div class="form-group">
                  <label>NOMBRES</label>
                  <input type="text" id="txtNombres" name="txtNombres" class="form-control" style="font-size:14px" placeholder="Ingrese sus nombres...">
                </div>
                <div class="form-group">
                  <label>EDAD</label>
                  <input type="text" id="txtEdad" name="txtEdad" class="form-control" style="font-size:14px" placeholder="Ingrese su edad...">
                </div>
                <div class="form-group">
                  <label>DOMILICIO | DIRECCIÓN</label>
                  <input type="text" id="txtEdad" name="txtEdad" class="form-control" style="font-size:14px" placeholder="Ingrese su domilicio o dirección...">
                </div>
                <div class="form-group">
                  <label>LOCALIDAD</label>
                  <input type="text" id="txtEdad" name="txtEdad" class="form-control" style="font-size:14px" placeholder="Ingrese su localidad...">
                </div>
                <div class="form-group">
                  <label>TELÉFONO</label>
                  <input type="text" id="txtEdad" name="txtEdad" class="form-control" style="font-size:14px" placeholder="Ingrese su teléfono...">
                </div>
                <div class="form-group">
                  <label>CELULAR</label>
                  <input type="text" id="txtEdad" name="txtEdad" class="form-control" style="font-size:14px" placeholder="Ingrese su celular...">
                </div>  
                <div class="form-group">
                  <label>CELULAR PAPÁ</label>
                  <input type="text" id="txtEdad" name="txtEdad" class="form-control" style="font-size:14px" placeholder="Ingrese celular del padre...">
                </div> 
                <div class="form-group">
                  <label>CELULAR MAMÁ</label>
                  <input type="text" id="txtEdad" name="txtEdad" class="form-control" style="font-size:14px" placeholder="Ingrese celular de la madre...">
                </div> 
                <div class="form-group">
                  <label>FECHA DE NACIMIENTO</label>
                  <input type="date" id="txtEdad" name="txtEdad" class="form-control" style="font-size:14px">
                </div>   
                <div class="form-group">
                  <label>LUGAR DE NACIMIENTO</label>
                  <input type="text" id="txtEdad" name="txtEdad" class="form-control" style="font-size:14px" placeholder="Ingrese lugar de nacimiento...">
                </div>
                <div class="form-group">
                  <label>DISTRITO</label>
                  <input type="text" id="txtEdad" name="txtEdad" class="form-control" style="font-size:14px" placeholder="Ingrese lugar de nacimiento...">
                </div>
                <div class="form-group">
                  <label>PROVINCIA</label>
                  <input type="text" id="txtEdad" name="txtEdad" class="form-control" style="font-size:14px" placeholder="Ingrese lugar de nacimiento...">
                </div>
                <div class="form-group">
                  <label>DEPARTAMENTO</label>
                  <input type="text" id="txtEdad" name="txtEdad" class="form-control" style="font-size:14px" placeholder="Ingrese lugar de nacimiento...">
                </div>       
              </div>
              <div class="box-footer">
                <input type="hidden" name="txtIdEstudiante" value="<?php echo $r2["IdEstudiante"]; ?>" />
                <input type="hidden" name="txtIdDocente" value="<?php echo $IdPersonal; ?>" />
                <a class="btn btn-primary" id="btnGuardaIncidencia"><img src="images/save.png" /> Guardar Encuesta</a>
              </div>

            </form>
          </div>  

        </div>
        <div class="col-xs-6">
          <!-- general form elements -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">2. DATOS FAMILIARES</h3>
            </div>
            <!-- /.box-header -->            
            <!-- form start -->
            <form id="FrmIncidencia" class="formulario" role="form" method="post" enctype="multipart/form-data">
              <div class="box-body">                
                <div class="form-group">
                  <label>APELLIDOS DEL PADRE</label>
                  <input type="text" id="txtApellidos" name="txtApellidos" class="form-control" style="font-size:14px" placeholder="Ingrese apellidos del padre...">
                </div>
                <div class="form-group">
                  <label>NOMBRES DEL PADRE</label>
                  <input type="text" id="txtApellidos" name="txtApellidos" class="form-control" style="font-size:14px" placeholder="Ingrese nombres del padre...">
                </div>
                <div class="form-group">
                  <label>EDAD DEL PADRE</label>
                  <input type="number" id="txtApellidos" name="txtApellidos" class="form-control" style="font-size:14px" placeholder="Ingrese edad del padre...">
                </div>
                <div class="form-group">
                  <label>PROFESIÓN DEL PADRE</label>
                  <input type="text" id="txtApellidos" name="txtApellidos" class="form-control" style="font-size:14px" placeholder="Ingrese profesión del padre...">
                </div>
                <div class="form-group">
                  <label>¿DONDE TRABAJA EL PADRE?</label>
                  <input type="text" id="txtApellidos" name="txtApellidos" class="form-control" style="font-size:14px" placeholder="Ingrese lugar de trabajo del padre...">
                </div>
                <div class="form-group">
                  <label>APELLIDOS DE LA MADRE</label>
                  <input type="text" id="txtApellidos" name="txtApellidos" class="form-control" style="font-size:14px" placeholder="Ingrese apellidos de la madre...">
                </div>
                <div class="form-group">
                  <label>NOMBRES DE LA MADRE</label>
                  <input type="text" id="txtApellidos" name="txtApellidos" class="form-control" style="font-size:14px" placeholder="Ingrese nombres de la madre...">
                </div>
                <div class="form-group">
                  <label>EDAD DE LA MADRE</label>
                  <input type="number" id="txtApellidos" name="txtApellidos" class="form-control" style="font-size:14px" placeholder="Ingrese edad de la madre...">
                </div>
                <div class="form-group">
                  <label>PROFESIÓN DE LA MADRE</label>
                  <input type="text" id="txtApellidos" name="txtApellidos" class="form-control" style="font-size:14px" placeholder="Ingrese profesión de la madre...">
                </div>
                <div class="form-group">
                  <label>¿DONDE TRABAJA LA MADRE?</label>
                  <input type="text" id="txtApellidos" name="txtApellidos" class="form-control" style="font-size:14px" placeholder="Ingrese lugar de trabajo de la madre...">
                </div>
                <div class="form-group">
                  <label>¿CUÁNTOS HERMANOS Y HERMANAS TIENES?</label>
                  <input type="number" id="txtApellidos" name="txtApellidos" class="form-control" style="font-size:14px" placeholder="Ingrese cantidad hermanos(as)...">
                </div>
                <div class="form-group">
                  <label>ACTUALMENTE VIVES CON:</label>
                  <div class="radio">                    
                    <input name="btnradio" id="AP" type="radio" value="C" checked>
                    <label for="AP">AMBOS PADRES</label>
                    <input name="btnradio" id="P" type="radio" value="D">
                    <label for="P">PADRE</label>   
                    <input name="btnradio" id="M" type="radio" value="D">
                    <label for="M">MADRE</label>   
                    <input name="btnradio" id="H" type="radio" value="D">
                    <label for="H">HERMANOS</label>   
                    <input name="btnradio" id="O" type="radio" value="D">
                    <label for="O">OTROS</label>                   
                  </div>            
                </div>
                <div class="form-group">
                  <label>¿TUS PADRES ESTÁN?</label>
                  <div class="radio">                    
                    <input name="btnradio2" id="CA" type="radio" value="CA" checked>
                    <label for="CA">CASADOS</label>
                    <input name="btnradio2" id="SD" type="radio" value="SD">
                    <label for="SD">SEPARADOS | DIVORCIADOS</label>   
                    <input name="btnradio2" id="UL" type="radio" value="UL">
                    <label for="UL">UNIÓN LIBRE</label>                    
                  </div>            
                </div>
                <div class="form-group">
                  <label>¿AMBOS VIVEN?</label>
                  <div class="radio">                    
                    <input name="btnradio3" id="SI" type="radio" value="SI" checked>
                    <label for="SI">SI</label>
                    <input name="btnradio3" id="NO" type="radio" value="NO">
                    <label for="NO">NO</label>                    
                  </div>            
                </div>
                <div class="form-group">
                  <label>SÓLO VIVE</label>
                  <div class="radio">                    
                    <input name="btnradio4" id="PA" type="radio" value="SI" checked>
                    <label for="PA">PADRE</label>
                    <input name="btnradio4" id="MA" type="radio" value="NO">
                    <label for="MA">MADRE</label>                    
                  </div>            
                </div>
                <div class="form-group">
                  <label>INCIDENCIA (*)</label>
                  <select id="lstCategoria" name="lstCategoria" class="form-control">  
                  <?php
                  $sql3 = mysqli_query($cn,"SELECT * FROM tipo_incidencia");
                  while($r3 = mysqli_fetch_array($sql3))
                  {
                    echo '<option value="'.$r3["IdTipoIncid"].'">'.utf8_encode($r3["NombTipoIncid"]).'</option>';
                  } 
                  ?>                      
                  </select>               
                </div>
                <div class="form-group">
                  <label>AFECTADOS (*)</label>
                  <textarea class="form-control" rows="2" name="txtAfectado" style="font-size:16px" placeholder="Por favor ingrese lo(s) afectado(s)..." required/></textarea>                 
                </div> 
                <div class="form-group">
                    <label>DESCRIPCIÓN (*)</label>
                    <textarea class="form-control" rows="3" name="txtIncidencia" style="font-size:16px" placeholder="Por favor describa la incidencia..." required/></textarea>
                </div>
                <div class="form-group">
                    <label>ACCIÓN REPARADORA</label>
                    <textarea class="form-control" rows="3" name="txtAccion" style="font-size:16px" placeholder="Por favor describa la acción reparadora..."/></textarea>
                </div>
                <div class="form-group">
                    <label>OBSERVACIONES</label>
                    <textarea class="form-control" rows="3" name="txtObservacion" style="font-size:16px" placeholder="Por favor ingrese una observación..."/></textarea>
                </div>
                (*) Campos obligatorios
              </div>
              <div class="box-footer">
                <input type="hidden" name="txtIdEstudiante" value="<?php echo $r2["IdEstudiante"]; ?>" />
                <input type="hidden" name="txtIdDocente" value="<?php echo $IdPersonal; ?>" />
                <a class="btn btn-primary" id="btnGuardaIncidencia"><img src="images/save.png" /> Guardar Encuesta</a>
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
      <b>Version</b> 1.0
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
