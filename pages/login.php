<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Iniciar Sesion | FI</title>
  <!-- Tell the browser to be responsive to screen width -->
  <link rel="shortcut icon" href="../dist/img/insigniaFI.png">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
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

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page" style="background-image:url('../dist/img/fondoverde2.jpg');">
<div class="login-box">
  <div class="login-logo">
    <a style="color:white;"><b>SISTEMA TUTORÍA </b><br>(FI 2019) </a>
  </div>
  <!-- /.login-logo -->


  <div class="login-box-body">
    <p class="login-box-msg" style="font-size:16px">Ingrese sus datos para Iniciar Sesión</p>
                <script src="../dist/js/jquery-1.11.1.min.js"></script>                
                <script src="../dist/js/jquery-2.2.4.min.js"></script>                
                <script>
                  $(function(){
                  $("#btnAcceder").on("click", function(){
                                  var formData = new FormData($("#FrmAcceso")[0]);
                                  var ruta = "../dist/form/p_acceso.php";
                                  $.ajax({
                                      url: ruta,
                                      type: "POST",
                                      data: formData,
                                      contentType: false,
                                      processData: false,
                                      success: function(resp){
                                        if(resp=="Datos Correctos"){  
                                          location.href="registro";    
                                        }                                        
                                        else if(resp=="Datos Incorrectos")
                                        { 
                                          alert(resp)     
                                          return false;
                                        }                                           
                                      }
                                  });
                              });
                      });
                  </script>
    <form id="FrmAcceso" class="contact-form" name="contact-form" autocomplete="off">
      <div class="form-group has-feedback">
        <input type="text" id="txtDNI" name="txtDNI" class="form-control" maxlength="8" placeholder="Ingrese su DNI" style="font-size:16px" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>        
      </div>  

      <div class="form-group has-feedback">
        <input type="password" id="txtPassword" name="txtPassword" class="form-control" maxlength="8" placeholder="Ingrese su Contraseña" style="font-size:16px" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>  
      <div class="row">        
        <!-- /.col -->
        <div class="col-xs-4">
          <a id="btnAcceder" type="submit" class="btn btn-primary btn-block btn-flat" style="width:8em;"><img src="images/login.png"> Acceder</a>
        </div>
        <!-- /.col -->
      </div>
      <a href="manual/manual-sistema-tutoria.pdf" target="_blank">Descargar Manual de Usuario</a>
      
      
    </form>

    

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="../plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
