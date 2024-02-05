<?php
 

 //activamos almacenamiento en el buffer
 ob_start();
 session_start();
 if (!isset($_SESSION['nombre'])) {
   header("Location: login.html");
 }else{
 
   
require 'header.php';


 ?>

 <link rel="stylesheet" href="../public/css/bootstrap.min.css">
  
  <!-- Font Awesome -->

  <link rel="stylesheet" href="../public/css/font-awesome.min.css">

  <link rel="stylesheet" href="../public/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../public/css/_all-skins.min.css">
  <!-- Morris chart --><!-- Daterange picker -->

<!-- DATATABLES-->
<link rel="stylesheet" href="../public/datatables/jquery.dataTables.min.css">
<link rel="stylesheet" href="../public/datatables/buttons.dataTables.min.css">
<link rel="stylesheet" href="../public/datatables/responsive.dataTables.min.css">
<link rel="stylesheet" href="../public/css/bootstrap-select.min.css">
    
 
  <!-- Morris chart --><!-- Daterange picker -->


    <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="row">
        <div class="col-md-12">
      <div class="box">
<div class="box-header with-border">
  <h1 class="box-title">Escritorio</h1>
  <div class="box-tools pull-right">
    
  </div>
<br><br><br>
  <?php


include ("../../config/Conexion.php");





$idpedido = $_POST['idpedido'];
    $idmesa = $_POST['idmesa'];
    $clave = $_POST['clave'];
 

    $sql2 = "SELECT restaurante.clave FROM restaurante, mesa, pedido,cliente WHERE pedido.idmesa=mesa.idmesa AND pedido.idcliente= cliente.idcliente and mesa.idrestaurante=restaurante.idrestaurante AND pedido.idpedido='$idpedido' ";
        $query2=mysqli_query($conexion,$sql2);
        $row=mysqli_fetch_array($query2);

		if($row['clave'] == $clave){
		 
			$sql="UPDATE pedido INNER JOIN mesa ON pedido.idmesa= mesa.idmesa  INNER JOIN cliente ON cliente.idcliente=pedido.idcliente
                   INNER JOIN restaurante ON mesa.idrestaurante=restaurante.idrestaurante 
                     SET pedido.idmesa='$idmesa', pedido.estado='Confirmado' WHERE pedido.idpedido='$idpedido' and cliente.idcliente=".$_SESSION['idcliente'];
            
            $query_update = mysqli_query($conexion,$sql);

            $sql3="UPDATE mesa INNER JOIN pedido ON pedido.idmesa= mesa.idmesa  INNER JOIN cliente ON cliente.idcliente=pedido.idcliente
            INNER JOIN restaurante ON mesa.idrestaurante=restaurante.idrestaurante 
              SET mesa.estado=0 WHERE pedido.idpedido='$idpedido' and cliente.idcliente=".$_SESSION['idcliente'];
     
     $update = mysqli_query($conexion,$sql3);


				if ($query_update && $update){
               $messages[] = "Su pedido ha sido confirmado, se empezará su elaboracion en unos minutos .";?>

                    <META HTTP-EQUIV="REFRESH" CONTENT="3;URL=confirmado.php">
                    <?php
				} else{
                    $errors []= "Lo siento algo ha salido mal, intenta nuevamente.".mysqli_error($conexion);?>

<META HTTP-EQUIV="REFRESH" CONTENT="3;URL=verificar.php?id=<?php echo $idpedido?>" >
                  <?php    
				}
			
 
            }else{
                $errors []= "Clave incorrecta intentelo nuevamente.".mysqli_error($conexion);?>

<META HTTP-EQUIV="REFRESH" CONTENT="3;URL=verificar.php?id= <?php echo $idpedido  ?>" >
<?php 
            }
        
 
 
 
  if (isset($errors)){
			
    ?>

<div class="form-group col-lg-12 col-md-12 col-xs-12">
</div>
<center>
<br>
<br>
<div class="form-group col-lg-10 col-md-10 col-sm-12 col-xs-12">
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
   

</div>
<!--fin centro-->
      </div>
      </div>
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>



    <link rel="stylesheet" href="../public/css/font-awesome.min.css">
    <script src="../js/jquery.flexslider.js"></script>


    <?php   
require 'footer.php';
    }

  }
?>


