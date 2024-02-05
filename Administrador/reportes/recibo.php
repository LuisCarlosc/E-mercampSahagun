<?php 
//activamos almacenamiento en el buffer
ob_start();
if (strlen(session_id())<1) 
  session_start();

if (!isset($_SESSION['nombre'])) {
  echo "debe ingresar al sistema correctamente para vosualizar el reporte";
}else{

if ($_SESSION['pedidos']==1) {

?>

<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" href="../../public/css/ticket.css">
</head>
<body onload="windo=prindt()">
<?php
        if(!isset($_GET["id"])){
            header("location: index.php?error=eliminar_no_id");
            exit;    
        }
        else{
			require_once("../../config/Conexion.php");  
			$id=$_GET["id"];

			$sql = "SELECT p.idpedido, t.idtienda, t.nombre as tienda, t.telefono, t.email,  c.nombre AS cliente, c.direccion,  p.fechahora,  p.total FROM pedido p INNER JOIN tienda t ON p.idtienda=t.idtienda INNER JOIN cliente c ON c.idcliente=p.idcliente WHERE  p.idpedido='$id' and t.idtienda=".$_SESSION['idtienda']; 
            
            $resultado = $conexion->query($sql);

            if($conexion->errno){
               alert("Error en la consulta, Error: ".$conexion->error);
                exit();
               
            }    

            if($resultado->num_rows>0){
                $reg = $resultado->fetch_assoc();
  
$codigo= "00011" . $reg["idpedido"];

	 ?>




<div class="zona_impresion">
	<!--codigo imprimir-->
	<br>
	<table border="0" align="center" width="300px">
		<tr>
			<td align="center">
				<!--mostramos los datos de la empresa en el doc HTML-->
				.::<strong> <?php echo  $reg["tienda"]; ?></strong>::.<br>
				<?php echo $reg["idtienda"]; ?><br>
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
			<td>	<strong>Cliente:</strong> <?php echo $reg["cliente"]; ?>
			</td>
			
		</tr>
			
		<tr>
		<td>	<strong>Direccion:</strong> <?php echo $reg["direccion"]; ?>
		</td>
			</tr>
		<tr>
			<td>
			<strong>	Telefono:</strong>	<?php echo $reg["telefono"]; ?>
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
			<strong>Fecha de Realización:</strong> <?php echo $reg["fechahora"] ; ?>
			</td>
		</tr>

	</table>
	

	<br>
	

	<!--mostramos lod detalles de la venta -->

	<table border="0" align="center" width="300px">
		<tr>
			<td>CANT.</td>
			<td>PRODUCTOS</td>
			<td align="right">IMPORTE</td>
		</tr>
		<tr>
			<td colspan="3">=============================================</td>
		</tr>

		<?php
require_once("../../config/Conexion.php");  
$id=$_GET["id"];

$sql="SELECT dp.idpedido, c.nombre as categoria, pr.nombre as producto,  dp.cantidad,dp.precio,(dp.cantidad*dp.precio)  as subtotal, p.total FROM detalle dp INNER JOIN pedido p ON dp.idpedido=p.idpedido INNER JOIN producto pr ON dp.idproducto=pr.idproducto INNER JOIN categoria c ON pr.idcategoria=c.idcategoria INNER JOIN tienda t ON c.idtienda=t.idtienda
WHERE  dp.idpedido='$id' and t.idtienda=".$_SESSION['idtienda'];

$resultado = $conexion->query($sql);

if($conexion->errno){
   alert("Error en la consulta, Error: ".$conexion->error);
	exit();
   
}  
		



}else{
	echo "  <center> <h2> No se puede visualizar e imprimir el recibo de la venta  porque no se ha efectuado el pago del pedido </h2>  </center>         ";
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
			<td colspan="3">N° de productos comprados: <?php echo $cantidad; ?> </td>
		</tr>
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="3" align="center">¡Gracias por su compra!</td>
		</tr>
		<tr>
			<td colspan="3" align="center">---</td>
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
}




ob_end_flush();
  ?>