<?php
 
 include ('header2.php')

  

 ?>

 <br><br>
 <br>
 <br><br>
 <br>

 <META HTTP-EQUIV="REFRESH" CONTENT="3;URL=solicitud.php">
<?php


include ("../config/Conexion.php");





$idtienda = $_POST['idtienda'];
    $tipo = $_POST['tipo'];
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $imagen="";
 


    $ext=explode(".", $_FILES["imagen"]["name"]);
		if ($_FILES['imagen']['type']=="image/jpg" || $_FILES['imagen']['type']=="image/jpeg" || $_FILES['imagen']['type']=="image/png") {
      $imagen=round(microtime(true)).'.'. end($ext);
     
      move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/tiendas/".$imagen);
     
		}


  
       
         $sql="INSERT INTO tienda (tipo,nombre,telefono,email,imagen,condicion  )
          VALUES ('$tipo','$nombre','$telefono','$email','$imagen','0')";
            $idatendernew=ejecutarConsulta_retornarID($sql);

            if($conexion->errno){
              $errors[] = "Ocurrio un error al subir sus informacion, su correo electronico ya se encuentra registrado. ".$conexion->error;
             
          }else{


            $sw=true;
      

       if($sw){
         $sql="INSERT INTO users (idtienda, nombre,telefono, email, imagen, condicion  )
         VALUES ('$idatendernew','$nombre','$telefono','$email','$imagen', '0')";
         
       ejecutarConsulta($sql) or $sw=false;
       
       $messages[] = "La solictud fue enviada con exito.";
         
         }else{
           $errors[] = "Ocurrio un error al subir sus informacion, vuelva intentarlo mas tarde o verifique bien los campos";
         }
         
       
          }







 
  if (isset($errors)){
			
    ?>

   


<div class="form-group col-lg-10 col-md-10 col-xs-12">
</div>
<center>
<br>
<br>
<div class="form-group col-lg-10 col-md-10 col-xs-12">
    <div class="alert alert-danger" role="alert">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Error!</strong> 
        <?php
          foreach ($errors as $error) {
              echo $error;
            }
          ?>
    </div>
    </div>
    <?php
    }
    if (isset($messages)){
      
      ?>
      <div class="form-group col-lg-10 col-md-10 col-xs-12">
      <div class="alert alert-success" role="alert">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>¡Bien hecho!</strong>
          <?php
            foreach ($messages as $message) {
                echo $message;
              }
            ?>
      </div>
      </div>
      </center>
      <div class="form-group col-lg-2 col-md-2 col-xs-12">

    </div>
      <?php
    }


?>


