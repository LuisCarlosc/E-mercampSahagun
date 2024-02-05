<?php 
//activamos almacenamiento en el buffer
ob_start();
session_start();
if (!isset($_SESSION['nombre'])) {
  header("Location: login.html");
}else{

require 'header.php';
if ($_SESSION['mesa']==1) {
 ?>
    <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="row">
        <div class="col-md-12">
      <div class="box">
<div class="box-header with-border">
  <h1 class="box-title">Mi restaurante </h1>
  <div class="box-tools pull-right">
    
  </div>
</div>
<!--box-header-->
<!--centro-->




<div class="panel-body " id="formularioregistro">
<?php
        
			require_once("../../config/Conexion.php");  
		

			$sql = "SELECT clave FROM tienda where idtienda=".$_SESSION['idtienda']; 
            
            $resultado = $conexion->query($sql);

            if($conexion->errno){
               alert("Error en la consulta, Error: ".$conexion->error);
                exit();
               
            }    

            if($resultado->num_rows>0){
                $reg = $resultado->fetch_assoc();
  


	 ?>


<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">

<label>Clave de asistencia actual</label>
<input class="form-control" type="text" value="<?php echo $reg["clave"] ;  ?>" readonly="readonly" required>
</div>


  <form action="nuevaclave.php"  method="POST">
   
  <?php 

function genera_codigo ($longitud) {
    $caracteres = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
    $codigo = '';

    for ($i = 1; $i <= $longitud; $i++) {
        $codigo .= $caracteres[numero_aleatorio(0, 9)];
    }

    return $codigo;
}

function numero_aleatorio ($ninicial, $nfinal) {
    $numero = rand($ninicial, $nfinal);

    return $numero;
}
?>



  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
    <label>Nueva clave de asistencia</label>
    <input class="form-control" type="text" name="clave" id="clave" value="<?php echo genera_codigo(6);?>"readonly="readonly" required> 
   
    </div>
 
  
    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i>  Guardar contraseña</button>
    </div>
  </form>
</div>
<?php 

}else{
	echo " no tiene contraseña asignada  ";
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
}else{
 require 'noacceso.php'; 
}
require 'footer.php'
 ?>
 <script src="../public/js/JsBarcode.all.min.js"></script>
 <script src="../public/js/jquery.PrintArea.js"></script>
 <script src="scripts/categorisa.js"></script>
<script>

</script>
 <?php 
}

ob_end_flush();
  ?>