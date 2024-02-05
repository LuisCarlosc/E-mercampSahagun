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
 <center> <h1 class="box-title">Tiendas</h1></center>
 
</div>
<!--box-header-->
<!--centro-->

<div class="panel-body" id="formularioregistros">
<div class="contenedor-tienda" >

<br>
<center>
<form action="tiendas.php" method="POST">

<input type="text"  class="buscador-tienda"  name="buscar" style="width:50%; border-radius: 5px;border-top: none; 
                border-left: none; border-right:none;border-color: blue;height: 35px; font-size: 17px;" placeholder="Buscar..." autocomplete="off"  >
<button type="submit" class="btn btn-primary" style="border-radius: 8px">
                    <i class="fa fa-search"></i> Buscar...
                </button>
</form>
</center>
<br>

<div class="row">
            <div class="col-sm-12">
                <table class="listado">
                    <?php
                    include ("read.php");

                    if($sql_query->num_rows>0){
                        while($row=mysqli_fetch_array($sql_query)){?>
                            <tr>
                                <td>
                                    <div class="listado-tienda">
                                        <div class="logo-tienda">
                                        <center> <a href="pedido.php?id=<?php echo $row["idtienda"]; ?>" class="small-box-footer" style="color:blue; style=  border-radius: 70px;"> <img class="imagen-tiendas" src='../../files/tiendas/<?php echo $row["imagen"]; ?>'  height='80px' width='80px'   >
    <font style="text-transform: uppercase;"> <strong>  <p><?php echo $row["nombre"]; ?>  </strong>  </font> <br> &nbsp <?php echo $row["tipo"]; ?>&nbsp <br>  <?php echo $row["telefono"]; ?>   </p>   </a></center>
                                        </div>

                                        
                                            
                                        
                                    </div>
                                </td>
                            </tr>
                            <?php
                        }
                    }else{
                        echo "No hay coincidencia de su busqueda ";
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

  
<?php 


 ?>


<script src="../public/js/Chart.bundle.min.js"></script>
 <script src="../public/js/Chart.min.js"></script>
 <?php 
}

ob_end_flush();
  ?>