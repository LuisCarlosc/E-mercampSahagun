<?php 
//activamos almacenamiento en el buffer
ob_start();
session_start();
if (!isset($_SESSION['nombre'])) {
  header("Location: login.html");
}else{

require 'header.php';
if ($_SESSION['administrador']==1) {
 ?>
    <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="row">
        <div class="col-md-12">
      <div class="box">
<div class="box-header with-border">
  <h1 class="box-title">Administradores <button class="btn btn-success" onclick="mostrarform(true)" id="btnagregar" style=" position: absolute; left:90%"><i class="fa fa-plus"></i> Nuevo</button></h1>
  <div class="box-tools pull-right">
    
  </div>
</div>
<!--box-header-->
<!--centro-->
<div class="panel-body table-responsive" id="listadoregistros">
  <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
    <thead>
      <th>Opciones</th>
      <th>Documento</th>
      <th>Nombre</th>
      <th>Telefono</th>
      <th>Email</th>
      <th>Foto</th>
      <th>Estado</th>
    </thead>
    <tbody>
    </tbody>
    <tfoot>
    <th>Opciones</th>
      <th>Documento</th>
      <th>Nombre</th>
      <th>Telefono</th>
      <th>Email</th>
      <th>Foto</th>
      <th>Estado</th>
    </tfoot>   
  </table>
</div>
<div class="panel-body" id="formularioregistros">
  <form action="" name="formulario" id="formulario" method="POST">
  
    <div class="form-group col-lg-12 col-md-12 col-xs-12">
      <label for="">Nombre(*):</label>
      <input class="form-control" type="hidden" name="idadmin" id="idadmin">
      <input class="form-control" type="text" name="nombre" id="nombre" maxlength="100" placeholder="Nombre" required autocomplete="off">
    </div>
   
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Numero de Documento(*):</label>
      <input type="text" class="form-control" name="cedula" id="cedula" placeholder="Documento" maxlength="20" autocomplete="off" required>
    </div>
    
       <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Telefono</label>
      <input class="form-control" type="text" name="telefono" id="telefono" maxlength="20" placeholder="Número de telefono" required autocomplete="off">
    </div>
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Email: </label>
      <input class="form-control" type="email" name="email" id="email" maxlength="70" placeholder="email" required autocomplete="off">
    </div>
    
  
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Clave(*):</label>
      <input class="form-control" type="password" name="clave" id="clave" maxlength="64" placeholder="Clave" required autocomplete="off">
    </div>
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Imagen:</label>
      <input class="form-control" type="file" name="imagen" id="imagen">
      <input type="hidden" name="imagenactual" id="imagenactual" required>
      <img src="" alt="" width="150px" height="120" id="imagenmuestra">
    </div>
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label>Permisos</label>
      <ul id="permisosadmin" style="list-style: none;">
        
      </ul>
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
require 'footer.php';
 ?>
 <script src="scripts/administrador.js"></script>
 <?php 
}

ob_end_flush();
  ?>
