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
 <center> <h1 class="box-title">Actualizar estado de pago</h1></center>
 
</div>
<!--box-header-->
<!--centro-->

<div class="panel-body" id="formularioregistros">
<div class="contenedor-tienda" >

<br>
<br>

<?php
        if(!isset($_GET["id"])){
            header("location: index.php?error=eliminar_no_id");
            exit;    
        }
        else{
            require_once("../../config/Conexion.php");  
           
            $sql = "UPDATE pedido SET estadoPago='Pagado' WHERE idpedido= ".$_GET["id"];
            
            $resultado = $conexion->query($sql);

            
           
    ?>
  
  <!--$sql = "UPDATE pedido SET estadoPago='Pagado' WHERE idpedido= ".$_GET["id"];-->
<!--box-header-->
<!--centro-->
<br>

<h3>Estado actualizado</h3>
</div>
<?php 

require 'footer.php';

     
       
}

 ?>
<!--fin centro-->
      </div>
      </div>
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>

  
<?php 


 ?>


<script src="../public/js/Chart.bundle.min.js"></script>
 <script src="../public/js/Chart.min.js"></script>
 <?php 
}

ob_end_flush();
  ?>
  <meta http-equiv="refresh" content="1; url=http://localhost/tienda1/Clientes/vistas/tiendas.php">