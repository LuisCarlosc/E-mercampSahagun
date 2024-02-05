

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Registrar </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../public/css/bootstrap.min.css">
  
  <!-- Font Awesome -->

  <link rel="stylesheet" href="../public/css/font-awesome.min.css">

  <link rel="stylesheet" href="../public/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../public/css/_all-skins.min.css">
  <!-- Morris chart --><!-- Daterange picker -->

<!-- DATATABLES-->
<link rel="stylesheet" href="../public/datatables/jquery.dataTables.min.css">
<link rel="stylesheet" href="../public/datatables/buttons.dataTables.min.css">
<link rel="stylesheet" href="../public/datatables/responsive.dataTables.min.css">
<link rel="stylesheet" href="../public/css/bootstrap-select.min.css">



</head>


 <META HTTP-EQUIV="REFRESH" CONTENT="1;URL=index.php">
<?php


include ("../config/Conexion.php");




$nombre = $_POST['nombre'];
$direccion = $_POST['direccion'];
$email = $_POST['email'];
$login = $_POST['login'];
$clave = $_POST['clave'];
 
$clavehash=hash("SHA256", $clave);
 
       
         $sql="INSERT INTO cliente (nombre,direccion,email,login,clave )
          VALUES ('$nombre','$direccion','$email','$login','$clavehash')";
           ejecutarConsulta($sql);

            if($conexion->errno){
              $errors[] = "Ocurrio un error. su email o usuarios ya se encuentran registrados. ".$conexion->error;
             
          }else{

            $messages[] = "Se ha registrado exitosamente.";

          }
      

  if (isset($errors)){
			
    ?>

   
<br>


</div>
<center>
<br>
<br>

<div class="form-group col-lg-12 col-md-12 col-xs-12">

<div class="form-group col-lg-6 col-md-6 col-xs-12">
    <div class="alert alert-danger" role="alert">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Error!</strong> 
        <?php
          foreach ($errors as $error) {
              echo $error;
            }
          ?>
    </div>
    </div>
  
    </center>

    <?php
    }
    if (isset($messages)){
      
      ?>

<center>

      <div class="form-group col-lg-10 col-md-10 col-xs-12">
      <div class="alert alert-success" role="alert">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>¡Bien hecho!</strong>
          <?php
            foreach ($messages as $message) {
                echo $message;
              }
            ?>
      </div>
      </div>
      </div>
      </center>
      <div class="form-group col-lg-2 col-md-2 col-xs-12">

    </div>
      <?php
    }


?>


