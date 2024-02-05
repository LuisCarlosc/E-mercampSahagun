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
<div class="box-header with-border">
 <center> <h1 class="box-title">Restaurantes visitados</h1></center>
 
</div>
<!--box-header-->
<!--centro-->

<div class="panel-body" id="formularioregistros">
<div class="contenedor-restaurante" >


<div class="row">
   <div class="col-sm-12">

   <table class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
 
   <?php 
    include ("../../config/Conexion.php");  
   $sql="SELECT DISTINCT tienda.idtienda, tienda.nombre,tienda.tipo,tienda.telefono,tienda.imagen FROM tienda,cliente,pedido WHERE cliente.idcliente =pedido.idcliente   AND tienda.condicion=1  AND cliente.idcliente=".$_SESSION['idcliente'];
  
   $sql_query=mysqli_query($conexion,$sql);
if($sql_query->num_rows>0){

while ($row=mysqli_fetch_array($sql_query)){?>
<tr>
           <td> 
           
<center>     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
       
     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
  <div class="small-box bg-white">
    <div class="inner">
    <a href="pedido.php?id=<?php echo $row["idtienda"]; ?>" class="small-box-footer" style="color:orangered; style=  border-radius: 70px;"> <img class="imagen-restaurantes" src='../../files/restaurantes/<?php echo $row["imagen"]; ?>'  height='80px' width='80px'   >
    <font style="text-transform: uppercase;"> <strong>  <p><?php echo $row["nombre"]; ?>  </strong>  </font> <p></p> &nbsp <?php echo $row["tipo"]; ?>&nbsp <br>  <?php echo $row["telefono"]; ?>   </p>   </a>

    </div>
    
</div>


    
</div>

</div>

</center>



     
   </td>
           </tr>

<?php
}


}else{
  echo "Usted no ha visitado ningun restaurante  ";

}
     ?>
           
            
       </table>
   
	</div>

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

  

</div>
<!--box-header-->
<!--
<?php 


require 'footer.php';
 ?>
 <script src="../public/js/Chart.bundle.min.js"></script>
 <script src="../public/js/Chart.min.js"></script>
 
 <?php 
}

ob_end_flush();
  ?>

