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

<!--box-header-->
<!--centro-->



   
     
    <div class="panel panel-success"><br>
              <h4><center><font size="4"><i class='fa fa-key'> &nbsp</i>EDITAR CONTRASEÑA</font></center></h4>
   
<br>

<div class="container">
      <div class="row">
     
      <form id="pass"  method="POST">
    

      <div class="form-group col-lg-4 col-md-4 col-xs-12">
    
      <input type="password" class="form-control input-sm" name="claveactual" placeholder="Ingrese la contraseña actual"  >
       </div>

     
     <div class="form-group col-lg-4 col-md-4 col-xs-12">
     <input type="password" class="form-control input-sm" name="nuevaclave" placeholder="Ingrese la nueva contraseña" >
     </div>
 
 
    
     <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
     <button type="submit"    class="btn btn-sm btn-success"><i class="fa fa-refresh"></i> Editar contraseña</button>
          
   </div>
   
   <div class='col-md-12' id="resultados_ajax"></div><!-- Carga los datos ajax -->
   </form>


    </div>
    </div> 
   
   
   <br><br><br><br>

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

<script type="text/javascript" src="../../js/bootstrap-filestyle.js"> </script>
<script>
$( "#pass" ).submit(function( event ) {
  $('.guardar_datos').attr("disabled", true);
  
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "../ajax/password.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados_ajax").html("Mensaje: Cargando...");
			  },
			success: function(datos){
			$("#resultados_ajax").html(datos);
			$('.guardar_datos').attr("disabled", false);

		  }
	});
  event.preventDefault();
})



 <?php 
}

ob_end_flush();
  ?>
