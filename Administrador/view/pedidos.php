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
<h1 class="box-title">Pedidos sin entregar</h1>
  <div class="box-tools pull-right">
    
  </div>
</div>
<!--box-header-->
<!--centro-->
<div class="panel-body table-responsive" id="listadoregistros">
  <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
    <thead>
      <th>Opciones</th>
      <th>Tipo</th>
      <th>Cliente</th>
      <th>Fecha</th>
      <th>Total</th>
      <th>Estado de Pago</th>
      <th>Estado de entrega</th>
      <th>Confirmar entrega</th>
    </thead>
    <tbody>
    </tbody>
    <tfoot>
    <th>Opciones</th>
      <th>Tipo</th>
      <th>Cliente</th>
      <th>Fecha</th>
      <th>Total</th>
      <th>Estado de Pago</th>
      <th>Estado de entrega</th>
      <th>Confirmar entrega</th>
    </tfoot>   
  </table>
</div>
<div class="panel-body" style="height: 400px;" id="formularioregistros">
<center> <h4> DETALLE DEL PEDIDO</h4></center>
<br>

  <form action="" name="formulario" id="formulario" method="POST">
    <div class="form-group col-lg-4 col-md-4 col-xs-12">
      <label for="">Cliente:</label>
      <input class="form-control" type="text" name="cliente" id="cliente" required readonly="readonly"  >
    </div>
      <div class="form-group col-lg-4 col-md-4 col-xs-12">
      <label for="">Nombre : </label>
      <input class="form-control" type="text" name="tienda" id="tienda" required  readonly="readonly"  >
    </div>

     <div class="form-group col-lg-2 col-md-2 col-xs-6">
      <label for="">Fecha realizacion: </label>
      <input class="form-control" type="datetime" name="fechahora" id="fechahora"  readonly="readonly">
    </div>
    

    <br>
<br>
    <br>
<br>
    <div class="form-group col-lg-12 col-md-12 col-xs-12">
     <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
       <thead style="background:linear-gradient(to right, orangered, rgb(117, 115, 115));">
        <th>Opciones</th>
        <th></th>
     
       </thead>
       <tfoot>
         <th>TOTAL</th>
         <th></th>
     
         <th></th>
         <th></th>
         <th><h4 id="totales"> $ 0.00</h4><input type="hidden" name="total" id="total"></th>
       </tfoot>
       <tbody>
         
       </tbody>
     </table>
    </div>
    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i>  Guardar</button>
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

  <!-- fin Modal-->
<?php 
}else{
 require 'noacceso.php'; 
}

require 'footer.php';
 ?>
 <script src="scripts/pedidos.js"></script>
 <?php 
}

ob_end_flush();
  ?>

