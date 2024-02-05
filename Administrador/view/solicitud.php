<?php
 
 include ('header.php')

  

 ?>


<div class="contenedor-solicitud">
<div class="box-header with-border" >


<div class="panel-body panel-solicitud" id="formularioregistros" >
  <form action="" name="formulario" id="formulario" method="POST">
  <div class="form-group col-lg-6 col-md-6 col-xs-12">
    en la siguiente imagen 
    </div>



  <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">NIT(*):</label>
      <input class="form-control" type="hidden" name="idrestaurante" id="idrestaurante">
      <input class="form-control" type="text" name="Nit" id="Nit" maxlength="100" placeholder="Nit del restaurante" autocomplete="off" required>
    </div>
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
    
    </div>
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
    <label for="">Tipo de restaurantes</label>
     <select class="form-control select-picker" name="tipo" id="tipo" required   >
       <option value="Comida Rapidas">Comida Rapidas</option>
       <option value="Restaurante Bar" >Restaurante Bar</option>
       
     </select>
    </div>
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
    
    </div>

    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Nombre</label>
      <input class="form-control" type="text" name="nombre" id="nombre" maxlength="256" placeholder="Nombre del restaurante"autocomplete="off" required>
    </div> 
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
  
    </div>
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Direccion</label>
      <input class="form-control" type="text" name="direccion" id="direccion" maxlength="256" placeholder="Direccion" autocomplete="off" required>
    </div>
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
    
    </div>
       <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Telefono</label>
      <input class="form-control" type="text" name="telefono" id="telefono" maxlength="256" placeholder="Telefono" autocomplete="off" required>
    </div>
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
    
    </div>
        <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Logo restaurantes</label>
      <input class="form-control" type="file" name="imagen" id="imagen"required>
      <input type="hidden" name="imagenactual" id="imagenactual">
      
    </div>
    <div class="form-group col-lg-8 col-md-8 col-xs-12">
    
    </div>
    
    <div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
      <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Enviar </button>

     
    </div>
    <div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">

</div>

    
  </form>
</div>

</div>




</div>



<script src="../public/js/JsBarcode.all.min.js"></script>
 <script src="../public/js/jquery.PrintArea.js"></script>
 <script src="js/restaurante.js"></script>

























<script src="../js/header.js"></script>