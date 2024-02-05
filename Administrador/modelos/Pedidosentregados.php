<?php 

//incluir la conexion de base de datos
session_start();
require "../../config/Conexion.php";

class Venta{


	//implementamos nuestro constructor
public function __construct(){

}

//metodo insertar registro

public function anular($idpedido){
	$sql="UPDATE pedido INNER JOIN tienda ON tienda.idtienda= pedido.idtienda SET pedido.estadoPago='Pagado' WHERE pedido.idpedido='$idpedido'  AND tienda.idtienda=".$_SESSION['idtienda'];
	return ejecutarConsulta($sql);
}
public function cambiar($idpedido){
	$sql="UPDATE pedido INNER JOIN tienda ON tienda.idtienda= pedido.idtienda SET pedido.estadoPago='Pagado' WHERE pedido.idpedido='$idpedido'  AND tienda.idtienda=".$_SESSION['idtienda'];
	return ejecutarConsulta($sql);
}

public function desactivar($idpedido){
	$sql="UPDATE pedido INNER JOIN tienda ON tienda.idtienda= pedido.idtienda SET pedido.estado='En Espera' WHERE pedido.idpedido='$idpedido'  AND tienda.idtienda=".$_SESSION['idtienda'];
	return ejecutarConsulta($sql);
}


//implementar un metodopara mostrar los datos de unregistro a modificar
public function mostrar($idpedido){
	$sql="SELECT p.idpedido, t.nombre as tienda, c.nombre as cliente,TIMESTAMP(p.fechahora) as fechahora FROM pedido p INNER JOIN tienda t ON p.idtienda=t.idtienda INNER JOIN cliente c ON c.idcliente=p.idcliente WHERE p.idpedido='$idpedido' and r.idtienda=".$_SESSION['idtienda'];
	return ejecutarConsultaSimpleFila($sql);
}

public function listarDetalle($idpedido){
	$sql="SELECT dp.idpedido, c.nombre as categoria, pr.nombre as producto, pr.imagen, dp.cantidad,dp.precio,(dp.cantidad*dp.precio) as subtotal FROM detalle dp INNER JOIN pedido p ON dp.idpedido=p.idpedido INNER JOIN producto pr ON dp.idproducto=pr.idproducto INNER JOIN categoria c ON pr.idcategoria=c.idcategoria INNER JOIN tienda t ON c.idtienda=t.idtienda WHERE dp.idpedido='$idpedido' and t.idtienda=".$_SESSION['idtienda'];
	return ejecutarConsulta($sql);
}

//listar registros
public function listar(){
	$cliente=$_SESSION['idtienda'];
	$sql="SELECT p.idpedido, p.tipo,t.nombre as tienda, c.nombre as cliente, 
	TIMESTAMP(p.fechahora) as fechahora, p.total,p.estadoPago, p.estado 
	FROM pedido p INNER JOIN tienda t ON p.idtienda=t.idtienda INNER JOIN 
	cliente c ON c.idcliente=p.idcliente  WHERE p.estado='Confirmado' and 
	t.idtienda='$cliente' 
	order by p.fechahora,  p.idpedido DESC  ";
	return ejecutarConsulta($sql);
}


public function ventacabecera($idpedido){
	$sql= "SELECT p.idpedido, t.idtienda, t.nombre as tienda, t.telefono, t.email,  c.nombre AS cliente,  p.fechahora, p.total FROM pedido p INNER JOIN tienda t ON p.idtienda=t.idtienda INNER JOIN cliente c ON c.idcliente=p.idcliente WHERE p.idpedido='$idpedido' and t.idtienda=".$_SESSION['idtienda'];
	return ejecutarConsulta($sql);
}

public function ventadetalles($idpedido){
	$sql="SELECT dp.idpedido, c.nombre as categoria, pr.nombre as producto,  dp.cantidad,dp.precio,(dp.cantidad*dp.precio)  as subtotal, p.total FROM detalle dp INNER JOIN pedido p ON dp.idpedido=p.idpedido INNER JOIN producto pr ON dp.idproducto=pr.idproducto INNER JOIN categoria c ON pr.idcategoria=c.idcategoria INNER JOIN tienda t ON c.idtienda=t.idtienda WHERE dp.idpedido='$idpedido' and t.idtienda=".$_SESSION['idtienda'];
         return ejecutarConsulta($sql);
}





}

 ?>
