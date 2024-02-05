<?php
//activamos almacenamiento en el buffer
ob_start();
session_start();
if (!isset($_SESSION['nombre'])) {
  header("Location: login.html");
}else{


require 'header.php';

if ($_SESSION['pedidos']==1) {

 ?>
    <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="row">
        <div class="col-md-12">
      <div class="box">
<div class="box-header with-border">
<h1 class="box-title">Detalle del pedido</h1>
  <div class="box-tools pull-right">
    
  </div>
</div>
<!--box-header-->
<!--centro-->
<div class="panel-body table-responsive" id="listadoregistros">
<br>

<div class="form-group col-lg-4 col-md-4 col-xs-6">
      <label for="">Nombre de la mesa</label>
      <input class="form-control" type="text" name="nombre" id="nombre" maxlength="256" >
    </div> 
     
   
    <div class="form-group col-lg-4 col-md-4 col-xs-6">
      <label for="">Cliente quien realiza el pedido</label>
      <input class="form-control" type="text" name="nombre" id="nombre" maxlength="256" >
    </div> 

 <div class="form-group col-lg-2 col-md-2 col-xs-6">
      <label for="">Fecha del pedido</label>
      <input class="form-control" type="date" name="nombre" id="nombre" maxlength="256" >
    </div> 
 <div class="form-group col-lg-2 col-md-2 col-xs-6">
      <label for="">Hora realizacion</label> 
      <input class="form-control" type="time" name="nombre" id="nombre" maxlength="256" >
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

  <!--Modal-->
  
  <!-- fin Modal-->
<?php 
}else{
 require 'noacceso.php'; 
}

require 'footer.php';
 ?>

<script >




</script>

 <?php 
}

ob_end_flush();
  ?>

