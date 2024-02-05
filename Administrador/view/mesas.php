<?php 
//activamos almacenamiento en el buffer
ob_start();
session_start();
if (!isset($_SESSION['nombre'])) {
  header("Location: login.html");
}else{

require 'header.php';
if ($_SESSION['mesa']==1) {
 ?>
    <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="row">
        <div class="col-md-12">
      <div class="box">
<div class="box-header with-border">
  <h1 class="box-title">Gestion de Mesas <button class="btn btn-success" onclick="mostrarform(true)" id="btnagregar"><i class="fa fa-plus-circle"></i>Agregar</button></h1>
  <div class="box-tools pull-right">
    
  </div>
</div>
<!--box-header-->
<!--centro-->
<div class="panel-body table-responsive" id="listadoregistros">
  <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
    <thead>
      <th>Opciones</th>
      <th>Nombre</th>
      <th>Tipo mesas</th>
      <th>Estado</th>
    </thead>
    <tbody>

    
    </tbody>
    <tfoot>
    <th>Opciones</th>
      <th>Nombre</th>
      <th>Tipo mesas</th>
      <th>Estado</th>
    </tfoot>   
  </table>
</div>
<div class="panel-body" id="formularioregistros">
  <form action="" name="formulario" id="formulario" method="POST">
   
 

  <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Nombre</label>
      <input class="form-control" type="hidden" name="idrestaurante" id="idrestaurante"  value="<?php echo $_SESSION['idrestaurante'];  ?>">
      <input class="form-control" type="hidden" name="idmesa" id="idmesa">
      <input class="form-control" type="text" name="nombre" id="nombre" maxlength="256" placeholder="Nombre de la mesa" required autocomplete="off">
    </div> 
    
    
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
    <label for="">Tipo de Mesa</label>
     <select class="form-control select-picker" name="tipo" id="tipo" required   >
       <option value="Mesa Normal">Mesa Normal</option>
       <option value="Mesa Familiar" >Mesa Familiar</option>
       
     </select>
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
 <script src="scripts/mesas.js"></script>
<script>

</script>
 <?php 
}

ob_end_flush();
  ?>