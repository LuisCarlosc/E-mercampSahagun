<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Administrador | Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../../public/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../css/login.css" type="text/css">
  <link rel="stylesheet" href="../../public/css/font-awesome.min.css">

  <link rel="stylesheet" href="../../public/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../../public/css/_all-skins.min.css">
  <!-- Morris chart --><!-- Daterange picker -->
</head>

<body >
 
<?php
        if(!isset($_GET["idtienda"])){
            header("location: index.php?error=eliminar_no_id");
            exit;    
        }
        else{
            require_once("../../config/Conexion.php");  

            $sql = "SELECT * FROM tienda WHERE idtienda=".$_GET["idtienda"];
            
            $resultado = $conexion->query($sql);

            if($conexion->errno){
               die("Error en la consulta, Error: ".$conexion->error);
                exit();
               
            }    

            if($resultado->num_rows>0){
                $registro = $resultado->fetch_assoc();
           
    ?>


  <div class="login-derecho   form-group col-lg-4 col-md-4 col-xs-12"  >

    <br><br><br>

    <div class="login-logo  form-group col-lg-12 col-md-12 col-xs-12">
      <h3>Bienvenido a tu plataforma </h3>
      <a href="../../index.php" ><b style="color: rgba(245, 101, 5, 0.973); " >Menu A </b> La Mano</a>

     
    </div>
    <div class="form-group col-lg-12 col-md-12 col-xs-12">
      <font style="text-transform: uppercase;"> <p class="nombre-restuarante"><?php echo $registro["nombre"]; ?></p></font>
    </div>
    
    <!-- /.login-logo -->
    <div class="login-box-body form-group col-lg-12 col-md-12 col-xs-12">
      <p class="login-box-msg">Ingresa tus datos de Acceso</p>
   
     

      <form  method="post" id="formularioAcceso">

      <div class="form-group has-feedback">
        <input value="<?php echo $registro["idtienda"]; ?>" class="form-control" type="hidden" name="idrestaurantea" id="idrestaurantea">
        </div>
     
      <div class="form-group has-feedback">
      
            <input type="text" id="logina" name="logina" class="form-control" placeholder="Correo Electronico" autocomplete="off"  style="color:#000;" required>
          <span class="fa fa-user form-control-feedback"  style="color: rgba(245, 101, 5, 0.973); " ></span>
       
          </div>

        <div class="form-group has-feedback">
          <input type="password" id="clavea" name="clavea" class="form-control" placeholder="Password" style="color:#000;"required>
          <span class="fa fa-key form-control-feedback"  style="color: rgba(245, 101, 5, 0.973);"></span>
        </div>
        <div class="row">
          <div class="col-xs-6">
          
          </div>
          <!-- /.col -->
          <div class="col-xs-6">
            <button type="submit" class="btn btn-primary btn-block btn-flat "  style="color: #ffffff;  background: linear-gradient(to right, orangered, rgb(117, 115, 115));" >Ingresar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
  
    </div>
    <!-- /.login-box-body -->
  </div>

  <div class="form-group col-lg-2 col-md-2 col-xs-3"  >
  </div>

  <div class="login-izq   form-group col-lg-4 col-md-4 col-xs-6"  >
    <img src='../../files/restaurantes/<?php echo $registro["imagen"]; ?>'  class="imagen-logo" alt="">
  
  </div>

 <div class="form-group col-lg-2 col-md-2 col-xs-3"  >
  </div>
  <?php
            }
          }
  ?>
<!-- jQuery 3 -->
<script src="../../public/js/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<!-- Bootstrap 3.3.7 -->
<script src="../../public/js/bootstrap.min.js"></script>
<script src="../../public/js/bootbox.min.js"></script>
<script src="scripts/loginUsers.js"></script>
<!-- iCheck -->

</body>
</html>
