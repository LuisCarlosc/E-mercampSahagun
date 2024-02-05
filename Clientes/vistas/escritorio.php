<?php
//activamos almacenamiento en el buffer
ob_start();
session_start();
if (!isset($_SESSION['nombre'])) {
  header("Location: login.html");
}else{

 
require 'header.php';


 ?>
    <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="row">
        <div class="col-md-12">
      <div class="box">
<div class="box-header with-border">
  <h1 class="box-title">Home</h1>
  <div class="box-tools pull-right">
    
  </div>
</div>
<!--box-header-->
<!--centro-->
<div class="panel-body">
<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
  <div class="small-box bg-blue">
    <div class="inner">
    <h5>Total De Compras por mes</h5>
      <h4 style="font-size: 17px;">
   
      <?php
   
   require_once("../../config/Conexion.php");  
  $cliente=$_SESSION['idcliente'];
   $sql = "SELECT IFNULL(SUM(total),0) as total , MONTHNAME(pedido.fechahora) AS mes FROM pedido, tienda,cliente
    WHERE  cliente.idcliente=pedido.idcliente  
    AND pedido.estadoPago='Pagado' and cliente.idcliente='$cliente' ";
   $result = mysqli_query($conexion, $sql);
   $fila = mysqli_fetch_assoc($result);
   echo  $fila['total'];
   ?>
      </h4>
 
    </div>
    <div class="icon">
      <i class="ion ion-bag"></i>
    </div>
    <a href="confirmado.php" class="small-box-footer">Compras <i class="fa fa-arrow-circle-right"></i></a>
  </div>
</div>

<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
  <div class="small-box bg-green">
    <div class="inner">
    <h5>Pedidos Confirmados</h5>
      <h4 style="font-size: 17px;">
   
      <?php
   
   require_once("../../config/Conexion.php");  
  $cliente=$_SESSION['idcliente'];
  $sql = "SELECT COUNT(*) total FROM tienda, pedido,cliente WHERE cliente.idcliente=pedido.idcliente and pedido.estado='Confirmado' AND cliente.idcliente=".$_SESSION['idcliente'];
   $result = mysqli_query($conexion, $sql);
   $fila = mysqli_fetch_assoc($result);
   echo  $fila['total'];
   ?>
      </h4>
 
    </div>
    <div class="icon">
      <i class="ion ion-bag"></i>
    </div>
    <a href="confirmado.php" class="small-box-footer">Confirmado <i class="fa fa-arrow-circle-right"></i></a>
  </div>
</div>

<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
  <div class="small-box bg-orange">
    <div class="inner">
    <h5>Pedidos En Espera</h5>
      <h4 style="font-size: 17px;">
    
      <?php
   
   require_once("../../config/Conexion.php");  
  
   $sql = "SELECT COUNT(*) total FROM tienda, pedido,cliente WHERE pedido.estado='En Espera' AND cliente.idcliente=".$_SESSION['idcliente'];
   $result = mysqli_query($conexion, $sql);
   $fila = mysqli_fetch_assoc($result);
   echo  $fila['total'];
   ?> 
      </h4>
 
    </div>
    <div class="icon">
      <i class="ion ion-bag"></i>
    </div>
    <a href="espera.php" class="small-box-footer">En Esperas <i class="fa fa-arrow-circle-right"></i></a>
  </div>
</div>





<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
  <div class="small-box bg-red">
    <div class="inner">
    <h5>Pedidos Cancelados</h5>
      <h4 style="font-size: 17px;">
      <?php
   
   require_once("../../config/Conexion.php");  
  
   $sql = "SELECT COUNT(*) total FROM tienda, pedido,cliente WHERE  pedido.estado='Cancelado' AND cliente.idcliente=".$_SESSION['idcliente'];
   $result = mysqli_query($conexion, $sql);
   $fila = mysqli_fetch_assoc($result);
   echo  $fila['total'];
   ?> 
      </h4>
    
    </div>
    
    <div class="icon">
      <i class="ion ion-bag"></i>
    </div>
    <a href="cancelado.php" class="small-box-footer">Cancelados <i class="fa fa-arrow-circle-right"></i></a>
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


require 'footer.php';
 ?>
 <script src="../public/js/Chart.bundle.min.js"></script>
 <script src="../public/js/Chart.min.js"></script>
 
 <?php 
}

ob_end_flush();
  ?>

