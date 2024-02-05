<?php

session_start();
if (!isset($_SESSION['nombre']) AND $_SESSION['nombre'] != 1) {
	header("location: ../login.php");
	exit;
}
	if (empty($_POST['claveactual'])) {
		   $errors[] = "campo clave actual esta vacío";
		   
        }else if (empty($_POST['nuevaclave'])) {
		   $errors[] = "campo nueva clave esta vacío";
		   
        }   else if (
			!empty($_POST['claveactual']) &&
			!empty($_POST['nuevaclave']) 
		){
		/* Connect To Database*/
		require_once ("../../config/Conexion.php");//Contiene las variables de configuracion para conectar a la base de datos

		// escaping, additionally removing everything that could be (html/javascript-) code
		$claveactual=mysqli_real_escape_string($conexion,(strip_tags($_POST["claveactual"],ENT_QUOTES)));
		$nuevaclave=mysqli_real_escape_string($conexion,(strip_tags($_POST["nuevaclave"],ENT_QUOTES)));
		
		$clavehash1=hash("SHA256", $claveactual);
		$clavehash2=hash("SHA256", $nuevaclave);

		$sql2="SELECT clave from cliente where idcliente=".$_SESSION['idcliente'];
        $query2=mysqli_query($conexion,$sql2);
        $row=mysqli_fetch_array($query2);

		if($row['clave'] == $clavehash1){
		 
			$sql="UPDATE cliente SET clave='".$clavehash2."' WHERE idcliente=".$_SESSION['idcliente'];
			$query_update = mysqli_query($conexion,$sql);
				if ($query_update){
					$messages[] = "La contraseña han sido actualizada correctamente.";
				} else{
					$errors []= "Lo siento, algo ha salido mal intenta nuevamente.".mysqli_error($conexion);
				}
			


		}else{
			$errors []= "la contraseña actual no coincide.".mysqli_error($conexion);
        }
    
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