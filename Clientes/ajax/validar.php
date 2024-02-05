<?php

session_start();
if (!isset($_SESSION['nombre']) AND $_SESSION['nombre'] != 1) {
	header("location: ../login.php");
	exit;
}
	 if (empty($_POST['idmesa'])) {
		   $errors[] = "El campo Nombre  esta vacío";
	
		   
        } else if (empty($_POST['clave'])) {
           $errors[] = "El campo correo esta vacío";
        
      
        }   else if (
		
			!empty($_POST['idmesa']) &&
			!empty($_POST['clave']) 
		){
		/* Connect To Database*/
		require_once ("../config/Conexion.php");//Contiene las variables de configuracion para conectar a la base de datos

		// escaping, additionally removing everything that could be (html/javascript-) code
		$idpedido=mysqli_real_escape_string($conexion,(strip_tags($_POST["idpedido"],ENT_QUOTES)));
		$idmesa=mysqli_real_escape_string($conexion,(strip_tags($_POST["idmesa"],ENT_QUOTES)));
		$clave=mysqli_real_escape_string($conexion,(strip_tags($_POST["clave"],ENT_QUOTES)));
	
		
		
        $query_update = "UPDATE pedido INNER JOIN mesa ON pedido.idmesa= mesa.idmesa INNER JOIN restaurante ON mesa.idrestaurante=restaurante.idrestaurante SET pedido.idmesa='$idmesa', pedido.estado='Confirmado' WHERE pedido.idpedido='$idpedido' and restaurante.clave='$clave' ";
		$query_update = mysqli_query($conexion,$sql);
			if ($query_update){
				$messages[] = "Datos han sido actualizados satisfactoriamente.";
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($conexion);
			}
		} else {
			$errors []= "Error desconocido.";
		}
		
		if (isset($errors)){
			
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}
			if (isset($messages)){
				
				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Bien hecho!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}

?>