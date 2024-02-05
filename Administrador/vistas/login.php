<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../../public/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../public/css/font-awesome.min.css">

  <link rel="stylesheet" href="../../public/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../../public/css/_all-skins.min.css">
  <!-- Morris chart --><!-- Daterange picker -->
</head>
<body class="hold-transition login-page " style="background-image: radial-gradient(circle at 46.5% 9.99%, #cab3ff 0, #9f90f4 25%, #6c6cd8 50%, #274bbd 75%, #0030a5 100%);">
<div class="login-box" >
  <div class="login-logo">
    <a href="../../index.html" ><img src="../../images/tienda.png" alt=""  height='100px' width='180px'  ></a>
  </div><p class="login-box-msg">Administrador general</p>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Iniciar sesión</p>

    <form  method="post" id="frmAcceso">
      <div class="form-group has-feedback">
          <input type="text" id="logina" style="border-radius:8px" name="logina" class="form-control" placeholder="Correo Electronico" autocomplete="off"  style="color: rgb(117, 115, 115);" required >
        <span class="fa fa-user form-control-feedback"  style="color: blue; " ></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" id="clavea" style="border-radius:8px" name="clavea" class="form-control" placeholder="Password" style="color:rgb(117, 115, 115);" required>
        <span class="fa fa-lock form-control-feedback"  style="color: blue;"></span>
      </div>
      <div class="row">
        <div class="col-xs-6">
        
        </div>
        <!-- /.col -->
        <div class="col-xs-6">
          <button type="submit" class="btn btn-primary btn-block btn-flat "  style="color: #ffffff;  background: linear-gradient(to right, blue, rgb(79, 102, 235)); border-radius:8px" ><strong>Entrar</strong></button>
        </div>
        <!-- /.col -->
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="../../public/js/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<!-- Bootstrap 3.3.7 -->
<script src="../../public/js/bootstrap.min.js"></script>
<script src="../../public/js/bootbox.min.js"></script>
<script src="scripts/login.js"></script>
<!-- iCheck -->

</body>
</html>
