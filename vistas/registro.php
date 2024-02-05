<?php
 
 include ('head.php')

  

 ?>





<div class="contenedor-solicitud">
<div class="box-header with-border" >


<div class="panel-body panel-solicitud" id="formularioregistros" >
  <form  id="perfil" method="POST" >

  


  <div  class="form-group col-lg-12 col-md-12 col-xs-12">
<br><br><br><br><br>
   

    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Nombre </label>
      <input class="form-control" type="text" name="nombre" id="nombre" maxlength="2512" placeholder="Nombre del restaurante" autocomplete="off" >
    </div> 
    

   
   
  
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
       <label for="">Correo Electronico</label>
      <input class="form-control" type="text" name="email" id="email" maxlength="2512" placeholder="Correo electronico" autocomplete="off"   >
     </div>
      
     <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Usuario</label>
      <input class="form-control" type="text" name="login" id="login" maxlength="256" placeholder="Direccion" autocomplete="off"   >
    </div>
        
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Clave</label>
      <input class="form-control" type="password" name="clave" id="clave" maxlength="256" placeholder="Direccion" autocomplete="off"   >
      <div class='col-md-12' id="resultado_ajax"></div><!-- Carga los datos ajax -->
     </div>
    </div>
    

<br>
          
    <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
<center>
<br>
<button type="submit" class="btn btn-sm btn-success"><i class="fa fa-refresh"></i> Actualizar</button>
</center>
     

    </div>
          
 


</div>


 
</form>

   
</div>

</div>



</div>

<script type="text/javascript" src="../js/bootstrap-filestyle.js"> </script>
<script>
$( "#perfil" ).submit(function( event ) {
  $('.guardar_datos').attr("disabled", true);
  
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "rspuesta_registro.php",
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


</script>




<script src="../js/header.js"></script>
</script>