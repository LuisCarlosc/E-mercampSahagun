<?php
 

 //activamos almacenamiento en el buffer
 ob_start();
 session_start();
 if (!isset($_SESSION['nombre'])) {
   header("Location: login.html");
 }else{
 
   
require 'header.php';


 ?>

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
    
 
  <!-- Morris chart --><!-- Daterange picker -->


    <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="row">
        <div class="col-md-12">
      <div class="box">
<div class="box-header with-border">
  <h1 class="box-title">Nueva Clave de asistencia </h1>
  <div class="box-tools pull-right">
    
  </div>
<br><br><br>
  <?php


include ("../../config/Conexion.php");

    $clave = $_POST['clave'];
 
			$sql="UPDATE restaurante set clave='$clave' where idrestaurante=".$_SESSION['idrestaurante'];
            
            $query_update = mysqli_query($conexion,$sql);
				if ($query_update){
               $messages[] = "Su clave de asistencia fue actualizada con exito, su nueva clave es :  "  .$clave;?>

                    <META HTTP-EQUIV="REFRESH" CONTENT="3;URL=escritorio.php">
                    <?php
				} else{
                    $errors []= "Lo siento algo ha salido mal, intenta nuevamente.".mysqli_error($conexion);?>

                  <?php    
				}
			
 
        
 
 
 
  if (isset($errors)){
			
    ?>

<div class="form-group col-lg-12 col-md-12 col-xs-12">
</div>
<center>
<br>
<br>
<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
    <?php
    }
    if (isset($messages)){
      
      ?>
      <div class="form-group col-lg-12 col-md-12 col-xs-12">
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
      </center>
      <div class="form-group col-lg-2 col-md-2 col-xs-12">

    </div>
   

</div>
<!--fin centro-->
      </div>
      </div>
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>



    <link rel="stylesheet" href="../public/css/font-awesome.min.css">
    <script src="../js/jquery.flexslider.js"></script>


    <?php   
require 'footer.php';
    }

  }
?>

