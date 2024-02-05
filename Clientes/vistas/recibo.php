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
  <h1 class="box-title"> <a href="confirmado.php">  <i class="fa fa-arrow-left"></i> </a>  </h1>
  <div class="box-tools pull-right">
    
  </div>
</div>
<!--box-header-->
<!--centro-->
<div class="panel-body">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
 
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" href="../public/css/ticket.css">

	

<?php
        if(!isset($_GET["id"])){
            header("location: index.php?error=eliminar_no_id");
            exit;    
        }
        else{
			require_once("../../config/Conexion.php");  
			$id=$_GET["id"];

			$sql = "SELECT p.idpedido, t.idtienda, t.nombre as tienda, t.telefono, t.email,  c.nombre AS cliente, p.fechahora, p.total FROM pedido p INNER JOIN tienda t ON p.idtienda=t.idtienda INNER JOIN cliente c ON c.idcliente=p.idcliente WHERE p.estadoPago='Pagado' and p.idpedido='$id' and c.idcliente=".$_SESSION['idcliente']; 
            
            $resultado = $conexion->query($sql);

            if($conexion->errno){
               alert("Error en la consulta, Error: ".$conexion->error);
                exit();
               
            }    

            if($resultado->num_rows>0){
                $reg = $resultado->fetch_assoc();
  
$codigo= "0011" . $reg["idpedido"];

	 

	 ?>

<table border="0" align="center" width="100%">
		<tr>
			<td align="center">
				<!--mostramos los datos de la empresa en el doc HTML-->
				.::<strong> <?php echo  $reg["tienda"]; ?></strong>::.<br>
				<?php echo $reg["idtienda"]; ?><br>
				<?php echo $reg["telefono"]; ?>
				<br>
			</td>
		</tr>
		<tr>
			<td align="center"><?php echo $reg["fechahora"]; ?></td>
		</tr>
		<tr> 
			<td align="center"></td>
		</tr>
		<tr>
			<!--mostramos los datos del cliente -->
			<td> <br>	<strong>Cliente:</strong> <?php echo $reg["cliente"]; ?>
			</td>
		</tr>
		
		<tr>
			<td>
			<strong>	Tienda:</strong>	<?php echo $reg["tienda"]; ?>
			</td>
		</tr>
		<tr>
			<td>
			<strong>N° de venta:</strong> <?php echo $codigo ?>
			</td>
		</tr>

		<tr>
			<td>
			<strong>Fecha de Realización:</strong> <?php echo $reg["fechahora"]; ?>
			</td>
		</tr>

	</table>
	

	<br>
	

	<!--mostramos lod detalles de la venta -->

	<table border="0" align="center" width="100%">
		<tr>
			<td>CANT.</td>
			<td>PRODUCTOS</td>
			<td align="right">IMPORTE</td>
		</tr>
		<tr>
			<td colspan="3">==================================</td>
		</tr>

		<?php
require_once("../../config/Conexion.php");  
$id=$_GET["id"];

$sql="SELECT dp.idpedido, c.nombre as categoria, pr.nombre as producto, dp.cantidad,dp.precio,(dp.cantidad*dp.precio) as 
subtotal, p.total FROM detalle dp INNER JOIN pedido p ON dp.idpedido=p.idpedido INNER JOIN cliente cl ON p.idcliente=cl.idcliente
 INNER JOIN producto pr ON dp.idproducto=pr.idproducto INNER JOIN categoria c ON pr.idcategoria=c.idcategoria 
 INNER JOIN tienda t ON c.idtienda=t.idtienda WHERE dp.idpedido='$id' and cl.idcliente=".$_SESSION['idcliente'];

$resultado = $conexion->query($sql);

if($conexion->errno){
   alert("Error en la consulta, Error: ".$conexion->error);
	exit();
   
}  
		



}else{
	echo "  ";
}

			}

if($resultado->num_rows>0){



		$cantidad=0;
		while (	$regd = $resultado->fetch_assoc()) {
		 	echo "<tr>";
		 	echo "<td>".$regd["cantidad"]."</td>";
		 	echo "<td>".$regd["producto"]."</td>";
		 	echo "<td align='right'>$. ".$regd["subtotal"] ; "</td>";
		 	echo "</tr>";
		 	$cantidad+=$regd["cantidad"] ; 
		 } 

		 ?>
			
		 <!--mostramos los totales de la venta-->
		<tr>
			<td>&nbsp;</td>
			<td align="right"><b>TOTAL:</b></td>
			<td align="right"><b>$. <?php echo $reg["total"] ;  ?></b></td>
		</tr>
		
		<tr>
			<td colspan="3"> <br> <center>N° de productos comprados: <?php echo $cantidad; ?></center></td>
		</tr>
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="3" align="center">¡Gracias por su compra!</td>
		</tr>
		<tr>
			<td colspan="3" align="center">--</td>
		</tr>
		<tr>
			<td colspan="3" align="center">Sahagún- Cordoba </td>
		</tr>
	</table>
	<br>
</div>


<p>&nbsp;</p>
</body>
</html>



<?php


	}else{
echo "";
}

}





ob_end_flush();
  ?>