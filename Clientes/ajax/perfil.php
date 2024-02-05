<?php

session_start();
if (!isset($_SESSION['nombre']) AND $_SESSION['nombre'] != 1) {
	header("location: ../login.php");
	exit;
}
	if (empty($_POST['nombre'])) {
		   $errors[] = "El campo nombre esta vacío";
		   
        }else if (empty($_POST['direccion'])) {
		   $errors[] = "El campo direccion esta vacío";
		   
        } else if (empty($_POST['email'])) {
           $errors[] = "El campo correo esta vacío";

		} else if (empty($_POST['login'])) {
			$errors[] = "El campo usuario esta vacío";
			
      
        }   else if (
			!empty($_POST['nombre']) &&
			!empty($_POST['direccion']) &&
			!empty($_POST['email']) &&
			!empty($_POST['login']) 
		){
		/* Connect To Database*/
		require_once ("../../config/Conexion.php");//Contiene las variables de configuracion para conectar a la base de datos

		// escaping, additionally removing everything that could be (html/javascript-) code
		$nombre=mysqli_real_escape_string($conexion,(strip_tags($_POST["nombre"],ENT_QUOTES)));
		$direccion=mysqli_real_escape_string($conexion,(strip_tags($_POST["direccion"],ENT_QUOTES)));
		$correo=mysqli_real_escape_string($conexion,(strip_tags($_POST["email"],ENT_QUOTES)));
		$login=mysqli_real_escape_string($conexion,(strip_tags($_POST["login"],ENT_QUOTES)));
		
		
		$sql="UPDATE cliente SET nombre='".$nombre."', direccion='".$direccion."', email='".$correo."', login='".$login."' WHERE idcliente=".$_SESSION['idcliente'];
		$query_update = mysqli_query($conexion,$sql);
			if ($query_update){
				$messages[] = "Los datos han sido actualizados correctamente.";
			} else{
				$errors []= "Lo siento, algo ha salido mal intenta nuevamente.".mysqli_error($conexion);
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