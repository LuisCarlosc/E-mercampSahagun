<?php 
//activamos almacenamiento en el buffer
ob_start();
session_start();
if (!isset($_SESSION['nombre'])) {
  header("Location: login.html");
}else{

require 'header.php';
if ($_SESSION['usuarios']==1) {
 ?>
    <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="row">
        <div class="col-md-12">
      <div class="box">
<div class="box-header with-border">
  <h1 class="box-title"> Usuarios <button class="btn btn-success" style=" position: absolute; left:90%" onclick="mostrarform(true)" id="btnagregar"><i class="fa fa-plus"></i> Nuevo</button></h1>
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
      <th>Nombre</th>
      <th>Telefono</th>
      <th>Cargo</th>
      <th>Email</th>
      <th>Foto</th>
      <th>Estado</th>
    </thead>
    <tbody>
    </tbody>
    <tfoot>
      <th>Opciones</th>
      <th>Tienda</th>
      <th>Nombre</th>
      <th>Telefono</th>
      <th>Cargo</th>  
      <th>Email</th>
      <th>Foto</th>
      <th>Estado</th>
    </tfoot>   
  </table>
</div>
<div class="panel-body" id="formularioregistros">
  <form action="" name="formulario" id="formulario" method="POST">

  

 <div class="form-group col-lg-10 col-md-12 col-xs-12">
      <label for="">Nombre(*):</label>
      <input class="form-control" type="hidden" name="iduser" id="iduser">
      <input class="form-control" type="text" name="nombre" id="nombre" maxlength="100" placeholder="Nombre completo" required autocomplete="off">
    </div>
       
       <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Telefono</label>
      <input class="form-control" type="text" name="telefono" id="telefono" maxlength="20" placeholder="Número de telefono" required autocomplete="off">
    </div>

    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Cargo</label>
     <select name="cargo" id="cargo" class="form-control select-picker" required>
       <option value="Administrador">Administrador</option>
       <option value="Vendedor">Vendedor</option>
     </select>
    </div>

    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Email: </label>
      <input class="form-control" type="email" name="email" id="email" maxlength="70" placeholder="Email" required autocomplete="off">
    </div>
  
   
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Contraseña(*):</label>
      <input class="form-control" type="password" name="clave" id="clave" maxlength="64" placeholder="Contraseña" required autocomplete="off">
    </div>

    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Imagen:</label>
      <input class="form-control" type="file" name="imagen" id="imagen" required>
      <input type="hidden" name="imagenactual" id="imagenactual">
      <img src="" alt="" width="150px" height="120" id="imagenmuestra">
    </div>

    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label>Permisos</label>
      <ul id="permisosusers" style="list-style: none;">
      </ul>

    </div>
   
    
    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i>  Guardar</button>
      <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-ban"></i> Cancelar</button>
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
 <script src="scripts/usuario.js"></script>
 <?php 
}

ob_end_flush();
  ?>