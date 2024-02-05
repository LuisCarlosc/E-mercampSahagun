<?php 
//activamos almacenamiento en el buffer
ob_start();
session_start();
if (!isset($_SESSION['nombre'])) {
  header("Location: login.html");
}else{

require 'header.php';
if ($_SESSION['tiendas']==1) {
 ?>
    <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="row">
        <div class="col-md-12">
      <div class="box">
<div class="box-header with-border">
  <h1 class="box-title"> TIENDAS </h1><button class="btn btn-success" style=" position: absolute; left:90%" onclick="mostrarform(true)" id="btnagregar"><i class="fa fa-plus"> </i> Nuevo</button>
  <div class="box-tools pull-right">
    
  </div>
</div>
<!--box-header-->
<!--centro-->
<div class="panel-body table-responsive" id="listadoregistros">
  <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
    <thead>
      <th>Opciones</th>
      <th>Tipo de tienda</th>
      <th>Nombre</th>
      <th>Telefono</th>
      <th>Imagen</th>
      <th>Estado</th>
    </thead>
    <tbody>
    </tbody>
    <tfoot>
      <th>Opciones</th>
      <th>Tipo de tienda</th>
      <th>Nombre</th>
      <th>Telefono</th>
      <th>Imagen</th>
      <th>Estado</th>
    </tfoot>   
  </table>
</div>
<div class="panel-body" id="formularioregistros">
  <form action="" name="formulario" id="formulario" method="POST">
    
 
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
    <label for="">Tipo de tienda</label>
    <input class="form-control" type="hidden" name="idtienda" id="idtienda">
     <select class="form-control select-picker" name="tipo" id="tipo" required   >
       <option value="Campesino">Campesino</option>
       <option value="Local" >Local</option>
       
     </select>
    </div>



    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Nombre</label>
      <input    class="form-control" type="text" name="nombre" id="nombre" maxlength="256" placeholder="Nombre" autocomplete="off" required>
    </div> 
    
    
       <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Telefono</label>
      <input class="form-control" type="text" name="telefono" id="telefono" maxlength="256" placeholder="Telefono"autocomplete="off" required>
    </div>



        <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Logo tienda</label>
      <input class="form-control" type="file" name="imagen" id="imagen" required>
      <input type="hidden" name="imagenactual" id="imagenactual">
      <img src="" alt="" width="150px" height="120" id="imagenmuestra" required>
    </div>
   
    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i>  Guardar</button>

      <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
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
}else{
 require 'noacceso.php'; 
}
require 'footer.php'
 ?>
 <script src="../public/js/JsBarcode.all.min.js"></script>
 <script src="../public/js/jquery.PrintArea.js"></script>
 <script src="scripts/tiendas.js"></script>

 <?php 
}

ob_end_flush();
  ?>