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
  <h1 class="box-title">Pedidos pendientes </h1>
  <div class="box-tools pull-right">
    
  </div>
</div>
<!--box-header-->
<!--centro-->
<div class="panel-body table-responsive" id="listadoregistros">
  <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
  <thead>
      <th>Opciones</th>
      <th>Tienda</th>
      <th>Fecha</th>
      <th>Tipo</th>
      <th>Estado de pago </th>
 
    </thead>
    <tbody>
    </tbody>
    <tfoot>
    <th>Opciones</th>
      <th>Tienda</th>
      <th>Fecha</th>
      <th>Tipo</th>
      <th>Estado de pago</th>
    
    </tfoot>     
  </table>
</div>
<div class="panel-body" id="formularioregistros">
<form action="" name="formulario" id="formulario" method="POST">
 

     <div class="form-group col-lg-6 col-md-12 col-xs-12">
      <label for="">Fecha pedido: </label>
      <input class="form-control" type="datetime" name="fechahora" id="fechahora"  readonly="readonly">
    </div>
    

    <br>
<br>
    <br>
<br>
    <div class="form-group col-lg-12 col-md-12 col-xs-12">
     <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
       <thead style="background-color:#A9D0F5">
        <th></th>
        <th></th>
        <th></th>
       
        <th></th>
       </thead>
       <tfoot>
         <th>TOTAL</th>
         <th></th>
     
         <th></th>
         <th></th>
         <th><h5 id="totales"> $ 0.00</h5><input type="hidden" name="total" id="total"></th>
       </tfoot>
       <tbody>
         
       </tbody>
     </table>
    </div>
    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
    
      <button class="btn btn-danger" onclick="cancelarform()" type="button" id="btnCancelar"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
    </div>
  </form>
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

require 'footer.php'
 ?>
 <script src="../public/js/JsBarcode.all.min.js"></script>
 <script src="../public/js/jquery.PrintArea.js"></script>
 <script src="scripts/pendientes.js"></script>
<script>

</script>
 <?php 
}

ob_end_flush();
  ?>