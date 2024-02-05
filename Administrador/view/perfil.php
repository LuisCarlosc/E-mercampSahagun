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


<?php 
  include ("../../config/Conexion.php");  
  
$usuario= $_SESSION['iduser'];


  $sql="SELECT users.iduser,users.idtienda,users.nombre, users.cargo,users.telefono,users.email, users.imagen FROM users,tienda WHERE users.idtienda=tienda.idtienda AND users.iduser=$usuario AND tienda.idtienda=".$_SESSION['idtienda'];

  $sql_query=mysqli_query($conexion,$sql);


 while ($row=mysqli_fetch_array($sql_query)){?>



<div class="container">
      <div class="row">
      <form method="post" id="perfil">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10 " >
   
   
          <div class="panel panel-success"><br>
              <h2 class="panel-title"><center><font size="4"><i class='fa fa-user-circle-o'></i> PERFIL</font></center></h2>

            <div class="panel-body">
              <div class="row">
			  
                <div class="col-md-5 col-lg-5 " align="center"> 
				<div id="load_img">
					<img class="img-circle" width="200px" height="200px" src='../../files/usuarios/<?php echo $row['imagen'];?>' alt="Logo"  height='256px' width='256px'  >
					
				</div>
				<br>				
					<div class="row">
  						<div class="col-md-12">
							<div class="form-group">
								<input class='filestyle' data-buttonText="Foto" type="file" name="imagefile" id="imagefile" onchange="upload_image();">
							</div>
						</div>
						
					</div>
				</div>
                <div class=" col-md-7 col-lg-7 "> 
                  <table class="table table-condensed">
                    <tbody>
                      <tr>


                     

                        <td class='col-md-3'>Nombre:</td>
                        <td><input type="text" class="form-control input-sm" name="nombre" value="<?php echo $row['nombre']?>" required autocomplete="off"></td>
                      </tr>
                     

                      <tr>
                        <td>Telefono:</td>
                        <td><input type="text" class="form-control input-sm" required autocomplete="off" name="telefono" value="<?php echo $row['telefono']?>"></td>
                      </tr>

                     
                      <tr>
                        <td>Email:</td>
                        <td><input type="email" class="form-control input-sm" name="email" value="<?php echo $row['email']?>"  autocomplete="off" readonly="readonly" ></td>
                      </tr>
                      
                    </tbody>
                  </table>
                 
                  <div class='col-md-12' id="resultados_ajax"></div><!-- Carga los datos ajax -->
                  <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-pencil"></i> Actualizar datos</button>
               <div></div>
              </div>
             
            </div>
          
          </div>
       
        </div>
 
		</form>
   
     
    <div class="panel panel-success"><br>
              <h4><center><font size="4"><i class='fa fa-pencil-square-o'> &nbsp</i>ACTUALIZAR CONTRASEÑA</font></center></h4>
   
<br>

<div class="container">
      <div class="row">
     
      <form id="formulario"  method="POST">
  
      <div class="form-group col-lg-4 col-md-4 col-xs-12">
      <label for="">Contraseña actual: </label>
      <input type="password" class="form-control input-sm" id="claveactual" name="claveactual" placeholder="Ingrese la contraseña actual"  >
       </div>


     <div class="form-group col-lg-4 col-md-4 col-xs-12">
     <label for="">Nueva contraseña:  </label>
     <input type="password" class="form-control input-sm" id="nuevaclave" name="nuevaclave" placeholder="Ingrese la nueva contraseña" >
     </div>
 
 <br>
 
    
     <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
     <button type="submit"    class="btn btn-sm btn-success"><i class="fa fa-pencil"></i> Actualizar contraseña</button>
    
   </div>

   <div class="form-group col-lg-8 col-md-8 col-xs-12">
     
   <div class='col-md-12' id="resultado_ajax"></div><!-- Carga los datos ajax -->
     </div>


   </form>

    </div>
    </div> 
   
   
      <?php 
}


  ?>

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
$( "#perfil" ).submit(function( event ) {
  $('.guardar_datos').attr("disabled", true);
  
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "../ajax/perfil_Admin.php",
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



<script type="text/javascript" src="../../js/bootstrap-filestyle.js"> </script>
<script>


function limpiar(){

	$("#claveactual").val("");
	$("#nuevaclave").val("");

}

$( "#formulario" ).submit(function( event ) {
  $('.guardar_datos').attr("disabled", true);
  
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "../ajax/pass.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultado_ajax").html("Mensaje: Cargando...");
			  },
			success: function(datos){
			$("#resultado_ajax").html(datos);
			$('.guardar_datos').attr("disabled", false);

		  }
	});
  event.preventDefault();
  limpiar();
})
		
</script>

<script>
		function upload_image(){
				
				var inputFileImage = document.getElementById("imagefile");
				var file = inputFileImage.files[0];
				if( (typeof file === "object") && (file !== null) )
				{
					$("#load_img").text('Cargando...');	
					var data = new FormData();
					data.append('imagefile',file);
					
					
					$.ajax({
						url: "../ajax/imagen_users.php",        // Url to which the request is send
						type: "POST",             // Type of request to be send, called as method
						data: data, 			  // Data sent to server, a set of key/value pairs (i.e. form fields and values)
						contentType: false,       // The content type used when sending data to the server.
						cache: false,             // To unable request pages to be cached
						processData:false,        // To send DOMDocument or non processed data file it is set to false
						success: function(data)   // A function to be called if request succeeds
						{
							$("#load_img").html(data);
							
						}
					});	
				}
				
				
			}
    </script>


 <script src="scripts/perfil.js"></script>
 <?php 
}

ob_end_flush();
  ?>
