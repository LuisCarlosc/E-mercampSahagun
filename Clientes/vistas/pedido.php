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
  
<h1 class="box-title"> <a href="tiendas.php" style="font-size:25px">  <i class="fa fa-arrow-left"></i> </a>  </h1> 
<?php
        if(!isset($_GET["id"])){
            header("location: index.php?error=eliminar_no_id");
            exit;    
        }
        else{
            require_once("../../config/Conexion.php");  

            $sql = "SELECT tienda.idtienda, tienda.imagen, cliente.direccion, cliente.idcliente FROM  tienda, cliente WHERE  tienda.idtienda=".$_GET["id"];
            
            $resultado = $conexion->query($sql);

            if($conexion->errno){
               alert("Error en la consulta, Error: ".$conexion->error);
                exit();
               
            }    

            if($resultado->num_rows>0){
                $registro = $resultado->fetch_assoc();
           
    ?>
  <div class="box-tools pull-right">
  <img  src='../../files/tiendas/<?php echo $registro["imagen"]; ?>'  height='60px' width='60px'   >
  <input class="form-control" type="hidden"    value="<?php echo $registro["idtienda"]; ?>"   name="idtienda" id="idtienda"      >
  </div>

  

<!--box-header-->
<!--centro-->
<br>

<br><br>
<div class="panel-body" style="height: 400px;" id="formularioros">
  <form action="" name="formulario" id="formulario" method="POST">
  <div class="form-group col-lg-4 col-md-4 col-xs-4" >
  
  </div>
  
  
  <div class="form-group col-lg-4 col-md-4 col-xs-4">
    <label for="">Tipo de Pago</label>
    <input class="form-control" type="type" name="fechahora" id="fechahora" required>
  <input class="form-control" type="" name="idtienda" id="idtienda"  value="<?php echo $registro["idtienda"]; ?>">
   
        <select name="tipo" id="tipo" class="form-control select-picker" required>
        <option value="Efectivo">Efectivo</option>
        <option value="Paypal">Paypal</option>
  
      </select>

    </div>
 

<br>
    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
  <center>   <a data-toggle="modal" href="#myModal">
       <button id="btnAgregarArt" type="button" class="btn btn-primary"><span class="fa fa-shopping-cart "> </span> Productos </button></center>
     </a>
    </div>

     <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
       <thead style="background-color:#A9D0F5">
        <th></th>
        <th>Productos</th>
    
       </thead>
       <tfoot>
         <th>TOTAL</th>
         <th><h4 id="totales"> $ 0.00</h4><input type="hidden" name="total" id="total"></th>
       </tfoot>
       <tbody>
         
       </tbody>
     </table>
   


    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i>  Guardar</button>
     
      
    </div>
  </form>

 
</div>
<!--fin centro-->
      </div>
      </div>
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>

  
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 100% !important;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Seleccionar productos </h4>
        </div>
        <div class="modal-body">
          <table id="tblarticulos" class="table table-striped table-bordered table-condensed table-hover">
            <thead>
            <th></th>
              <th>Nombre</th>
              <th>Precio</th>
              <th>Imagen</th>
            </thead>
            <tbody>
              
            </tbody>
            <tfoot>
            <th></th>
              <th>Nombre</th>
              <th>Precio</th>
              <th>Imagen</th>
            </tfoot>
          </table>
        </div>
        <div class="modal-footer">
          <button class="btn btn-default" type="button" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

  
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 100% !important;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Seleccionar productos </h4>
        </div>
        <div class="modal-body">
        <table id="producto" class="table table-striped table-bordered table-condensed table-hover">
       <thead style="background-color:#A9D0F5">
        <th></th>
        <th>Productos</th>
    
       </thead>
       <tfoot>
         <th>TOTAL</th>
       
       </tfoot>
       <tbody>
         
       </tbody>
     </table>
        </div>
        <div class="modal-footer">
          <button class="btn btn-default" type="button" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

  

  <!-- fin Modal-->
<?php 

require 'footer.php';

}        
       
}

 ?>
 

 <script src="scripts/atendercita.js"></script>
 <?php 
}

ob_end_flush();
  ?>

