<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="../../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../public/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../public/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../../public/css/_all-skins.min.css">
    <link rel="stylesheet" href="css.css">
    <link rel="stylesheet" href="../../css/login.css">
    <title>Document</title>
    
</head>
<body>
    <div class="container2" id="container2">
        
    <div class="login-derecho   form-group col-lg-7 col-md-4 col-xs-12"  >

    
    <div class="login-logo  form-group col-lg-12 col-md-12 col-xs-12">
      <h3>Bienvenido </h3>
      <a href="../../vistas/tienda.php" ><b style="color: rgba(245, 101, 5, 0.973); " >  </b> </a>

     
    </div>
    
    
    <!-- /.login-logo -->
    <div class="login-box-body form-group col-lg-12 col-md-8 col-xs-8">
      <p class="login-box-msg">Iniciar sesión</p>
   
     

      <form  method="post" id="formularioAcceso">

      <div class="form-group has-feedback">
        <input value="<?php echo $registro["idtienda"]; ?>" class="form-control" type="hidden" name="idrestaurantea" id="idrestaurantea">
        </div>
     
      <div class="form-group has-feedback">
      
            <input type="text" id="logina" name="logina" class="form-control" placeholder="Correo Electronico" autocomplete="off"  style="color:#000;" required>
          <span class="fa fa-user form-control-feedback"  style="color: blue; " ></span>
       
          </div>

        <div class="form-group has-feedback">
          <input type="password" id="clavea" name="clavea" class="form-control" placeholder="Password" style="color:#000;"required autocomplete="off">
          <span class="fa fa-key form-control-feedback"  style="color: blue;"></span>
        </div>
        <div class="row">
          <div class="col-xs-12">
          
          </div>
          <!-- /.col -->
          <div class="col-xs-12">
            <button type="submit" class="btn btn-primary btn-block btn-flat "  style="color: #ffffff;  background: linear-gradient(to right, blue, rgb(117, 115, 115));" >Ingresar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
  
    </div>
    <!-- /.login-box-body -->
  </div>
    </div>
</body>
</html>