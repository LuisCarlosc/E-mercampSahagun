<?php
//activamos almacenamiento en el buffer
ob_start();
session_start();
if (!isset($_SESSION['nombre'])) {
  header("Location: login.php");
}else{

 
require 'header.php';

if ($_SESSION['escritorio']==1) {

 
 ?>
    <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="row">
        <div class="col-md-12">
      <div class="box">
<div class="box-header with-border">
  <h1 class="box-title">Panel de control</h1>
  <div class="box-tools pull-right">
    
  </div>
</div>
<!--box-header-->
<!--centro-->
<div class="panel-body">





<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
  <div class="small-box bg-transparent">
    <div class="inner">
      <h4 style="font-size: 17px;">
      <strong>
      <?php
   
   require_once("../../config/Conexion.php");  
  
  $sql = "SELECT COUNT(*) total FROM tienda ";
  ;
   $result = mysqli_query($conexion, $sql);
   $fila = mysqli_fetch_assoc($result);
   echo  $fila['total'];
   ?>
</strong>
      </h4>
      <p>Tiendas registradas</p>
    </div>
    <div class="icon">
    <i class="fa fa-check-circle-o"></i>
    </div>
    <a href="tiendas.php" class="small-box-footer">Tiendas registradas <i class="fa fa-arrow-circle-right"></i></a>
  </div>
</div>

<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
  <div class="small-box bg-transparent">
    <div class="inner">
      <h4 style="font-size: 17px;">
      <strong>   <?php
   
   require_once("../../config/Conexion.php");  
  
  $sql = "SELECT COUNT(*) total FROM users ";
  
   $result = mysqli_query($conexion, $sql);
   $fila = mysqli_fetch_assoc($result);
   echo  $fila['total'];
   ?></strong>
      </h4>
      <p>Usuarios de las tiendas registradas</p>
    </div>
    <div class="icon">
    <i class="fa fa-user"></i>
    </div>
    <a href="usuario.php" class="small-box-footer">Usarios de las tiendas<i class="fa fa-arrow-circle-right"></i></a>
  </div>
</div>


<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
  <div class="small-box bg-transparent">
    <div class="inner">
      <h4 style="font-size: 17px;">
       <strong>
      <?php
   
   require_once("../../config/Conexion.php");  
  
  $sql = "SELECT COUNT(*) total FROM tienda WHERE condicion=0  ";
  ;
   $result = mysqli_query($conexion, $sql);
   $fila = mysqli_fetch_assoc($result);
   echo  $fila['total'];
   ?>
</strong>


      </h4>
      <p>Tiendas desactivadas</p>
    </div>
    <div class="icon">
      <i class="fa fa-times-circle-o"></i>
    </div>
    <a href="tiendas.php" class="small-box-footer">Tiendas desactivadas <i class="fa fa-arrow-circle-right"></i></a>
  </div>
</div>

<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
  <div class="small-box bg-transparent">
    <div class="inner">
      <h4 style="font-size: 17px;">
        <strong>   <?php
   
   require_once("../../config/Conexion.php");  
  
  $sql = "SELECT COUNT(*) total FROM users where condicion=0";
  
   $result = mysqli_query($conexion, $sql);
   $fila = mysqli_fetch_assoc($result);
   echo  $fila['total'];
   ?></strong>
      </h4>
      <p>Usuarios desactivados</p>
    </div>
    <div class="icon">
    <i class="fa fa-user-times"></i>
    </div>
    <a href="usuario.php" class="small-box-footer">Usuarios <i class="fa fa-arrow-circle-right"></i></a>
  </div>
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
  
<?php 
}else{
 require 'noacceso.php'; 
}

require 'footer.php';
 ?>
 <script src="../public/js/Chart.bundle.min.js"></script>
 <script src="../public/js/Chart.min.js"></script>
 

 <?php 
}

ob_end_flush();
  ?>

