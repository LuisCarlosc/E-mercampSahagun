<?php
//activamos almacenamiento en el buffer
ob_start();
session_start();
if (!isset($_SESSION['nombre'])) {
  session_destroy();
  header("Location: " . $_SERVER["HTTP_REFERER"]);
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
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
  <div class="small-box bg-transparent">
    <div class="inner">
    <p>Total de ventas del día</p>
      <h4 style="font-size: 17px;">

     <strong> <?php
   
   require_once("../../config/Conexion.php");  
  $cliente=$_SESSION['idtienda'];
   $sql = "SELECT IFNULL(SUM(total),0) as total   FROM pedido, tienda,cliente WHERE  cliente.idcliente=pedido.idcliente and pedido.idtienda=tienda.idtienda AND pedido.estadoPago='Pagado' and tienda.idtienda='$cliente'  and DATE(fechahora)=curdate() ";
   $result = mysqli_query($conexion, $sql);
   $fila = mysqli_fetch_assoc($result);
   echo  $fila['total'];
   ?></strong>

      </h4>
   
    </div>
    <div class="icon">
      <i class="fa fa-money"></i>
    </div>
    <a href="reportes.php" class="small-box-footer">Ventas diarias <i class="fa fa-arrow-circle-right"></i></a>
  </div>
</div>


<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
  <div class="small-box bg-transparent">
    <div class="inner">
    <p>Pedidos realizados hoy </p>
      <h4 style="font-size: 17px;">
      <strong>  <?php
   
   require_once("../../config/Conexion.php");  
  
  $sql = "SELECT COUNT(*) total FROM tienda, pedido,cliente WHERE cliente.idcliente=pedido.idcliente and pedido.idtienda=tienda.idtienda and pedido.estado='Confirmado' and pedido.estadoPago='Pagado'    and DATE(fechahora)=curdate() and tienda.idtienda= ".$_SESSION['idtienda'];
  ;
   $result = mysqli_query($conexion, $sql);
   $fila = mysqli_fetch_assoc($result);
   echo  $fila['total'];
   ?> </strong>

      </h4>
  
    </div>
    <div class="icon">
      <i class="fa fa-shopping-cart"></i>
    </div>
    <a href="pedidos.php" class="small-box-footer">Pedidos confirmados <i class="fa fa-arrow-circle-right"></i></a>
  </div>
</div>





<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
  <div class="small-box bg-transparent">
    <div class="inner">
    <p>Pedidos realizado en el mes</p>
      <h4 style="font-size: 17px;">
     <strong> <?php
   
   require_once("../../config/Conexion.php");  
  $cliente=$_SESSION['idtienda'];
   $sql = "SELECT COUNT(*) total , MONTHNAME(pedido.fechahora) AS mes FROM pedido, tienda,cliente WHERE  cliente.idcliente=pedido.idcliente AND pedido.idtienda=tienda.idtienda and pedido.estadoPago='Pagado' and tienda.idtienda='$cliente'";
   $result = mysqli_query($conexion, $sql);
   $fila = mysqli_fetch_assoc($result);
   echo  $fila['total'];
   ?></strong>



      </h4>
    
    </div>
    <div class="icon">
      <i class="fa fa-shopping-basket"></i>
    </div>
    <a href="reportes.php" class="small-box-footer">Pedidos mensuales <i class="fa fa-arrow-circle-right"></i></a>
  </div>
</div>



<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
  <div class="small-box bg-transparent">
    <div class="inner">
    <p>Total de ventas de este mes</p>
      <h4 style="font-size: 17px;">
     <strong> <?php
   
   require_once("../../config/Conexion.php");  
  $cliente=$_SESSION['idtienda'];
   $sql = "SELECT IFNULL(SUM(total),0) as total , MONTHNAME(pedido.fechahora) AS mes FROM pedido, tienda,cliente WHERE  cliente.idcliente=pedido.idcliente AND pedido.idtienda=tienda.idtienda and pedido.estadoPago='Pagado' and tienda.idtienda='$cliente' ";
   $result = mysqli_query($conexion, $sql);
   $fila = mysqli_fetch_assoc($result);
   echo  $fila['total'];
   ?></strong>
      </h4>
    
    </div>
    <div class="icon">
      <i class="fa fa-money"></i>
    </div>
    <a href="reportes.php" class="small-box-footer">Ventas Mensuales<i class="fa fa-arrow-circle-right"></i></a>
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

