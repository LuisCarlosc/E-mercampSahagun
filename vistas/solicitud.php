<?php
 
 include ('header2.php')

  

 ?>





<div class="contenedor-solicitud">
<div class="box-header with-border" >


<div class="panel-body panel-solicitud" id="formularioregistros" >
  <form  action="respuesta.php" id="perfil" method="POST" enctype="multipart/form-data">

  

  


  <div  class="form-group col-lg-12 col-md-12 col-xs-12">
<center> <h4>Contactenos</h4>
</center>  <br> 
   

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
      <input class="form-control" type="text" name="nombre" id="nombre" maxlength="2512" placeholder="Nombre" autocomplete="off" required  >
    </div> 
    
    
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Telefono</label>
      <input class="form-control" type="text" name="telefono" id="telefono" maxlength="256" placeholder="Telefono" autocomplete="off" required  >
    </div>
   
  
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
       <label for="">Email</label>
      <input class="form-control" type="text" name="email" id="email" maxlength="2512" placeholder="email" autocomplete="off" required  >
     </div>
     <div class="form-group col-lg-6 col-md-6 col-xs-12">

<label for="">Imagen tienda (120px * 120px )</label>
<input class="form-control" type="file" name="imagen" id="imagen" required>
</div>

<br>
          
    <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
<center>
<br><br><br>
<input type="submit"  value="Solicitar"  class="btn  btn-primary"><i class="fa fa-"   > </i>
</center>
     

    </div>
          
 


</div>


 
</form>

   
</div>

</div>



</div>
<footer class="footer" style="background-image: radial-gradient(circle at 46.5% 9.99%, #cab3ff 0, #9f90f4 25%, #6c6cd8 50%, #274bbd 75%, #0030a5 100%)">
    		<div class="container-fluid">
    			<div class="col-xs-12 text-center">
    				<h3>Siguenos en</h3>
    				<ul class="list-unstyled list-social-icons">
    					<li >
    						<a href="#!">
                               <i class="fa fa-facebook" style="background-color: #3B5998;"></i> 
                            </a>
    					</li>
    					<li>
    						<a href="#!">
                                <i class="fa fa-google-plus" style="background-color: #DD4B39;"></i>
                            </a>
    					</li>
    					<li>
    						<a href="#!">
                                <i class="fa fa-twitter"  style="background-color: #56A3D9;"></i>
                            </a>
    					</li>
    					<li>
    						<a href="#!">
                                <i class="fa fa-youtube" style="background-color: #BF221F;"></i>
                            </a>
    					</li>
    				</ul>
    				<h4>E-mercamp Sahagún</h4>
    			</div>
    		</div>
    	</footer>
<?php
 
 
 ?>
<script type="text/javascript" src="../../js/bootstrap-filestyle.js"> </script>
<script src="../js/header.js"></script>
</script>