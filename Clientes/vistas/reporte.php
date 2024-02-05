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
  <h1 class="box-title">Reporte de compras</h1>
  <div class="box-tools pull-right">
    
  </div>
</div>
<!--box-header-->
<!--centro-->
<div class="panel-body table-responsive" id="listadoregistros" >
  <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12" >
    
    <input type="hidden" class="form-control" name="fecha_inicio" id="fecha_inicio" value="<?php echo date("Y-m-d"); ?>">
  </div>
  <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
    
    <input type="hidden" class="form-control" name="fecha_fin" id="fecha_fin" value="<?php echo date("Y-m-d"); ?>">
  </div>
  <div class="form-inline col-lg-6 col-md-6 col-sm-6 col-xs-12" style="display: none">
    <label>Tiendas</label>
    <select name="idtienda" id="idtienda" class="form-control selectpicker" data-live-search="true" required>
    </select>
    <br>
    <button class="btn btn-success" onclick="listar()" >
      Mostrar</button>
  </div>
  <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
    <thead>
    
      <th>Fecha</th>
      <th>Tienda</th>
      <th>Total compra</th>
     
    <tbody>
    </tbody>
    <tfoot>
    
    <th>Fecha</th>
      <th>Tienda</th>
      <th>Total compra</th>
    </tfoot>   
  </table>
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
 <script src="scripts/ventasfechacliente.js"></script>
 <?php 
}

ob_end_flush();
  ?>

