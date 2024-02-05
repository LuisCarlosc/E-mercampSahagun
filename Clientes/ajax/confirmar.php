<?php
        if(!isset($_GET["id"])){
            header("location: index.php?error=eliminar_no_id");
            exit;    
        }
        else{
            require "../../config/Conexion.php";
            $sql="SELECT idtienda, nombre FROM tienda WHERE 
             idtienda=".$_GET['id'];
            global $conexion;
            $query=$conexion->query($sql);
          

            if($conexion->errno){
                die("Error en la consulta, Error: ".$conexion->error);
                exit();
            }    


			while ($reg = $query->fetch_object()) {
				echo '<option value='.$reg->idtienda.'>'.$reg->nombre.'</option>';
			}

            }  
    ?>