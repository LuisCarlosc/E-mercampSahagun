<?php 
//incluir la conexion de base de datos
require "../../config/Conexion.php";
session_start();

class Categoria{


	//implementamos nuestro constructor
public function __construct(){
	
}

//metodo insertar regiustro


public function insertar($idrestaurante, $nombre,$descripcion){
	$sql="INSERT INTO categoria (idrestaurante,nombre,descripcion,estado) VALUES ('$idrestaurante','$nombre','$descripcion','1')";
	return ejecutarConsulta($sql);
}

public function editar($idcategoria,$idrestaurante,$nombre,$descripcion){
	$sql="UPDATE categoria SET  nombre='$nombre',descripcion='$descripcion' WHERE idcategoria='$idcategoria' AND idrestaurante=".$_SESSION['idrestaurante'];
	return ejecutarConsulta($sql);
}
public function desactivar($idcategoria){
	$sql="UPDATE categoria SET estado='0' WHERE idcategoria='$idcategoria' AND idrestaurante=".$_SESSION['idrestaurante'];
	return ejecutarConsulta($sql);
}
public function activar($idcategoria){
	$sql="UPDATE categoria SET estado='1' WHERE idcategoria='$idcategoria' AND idrestaurante=".$_SESSION['idrestaurante'];
	return ejecutarConsulta($sql);
}

//metodo para mostrar registros
public function mostrar($idpedido){
	$sql="SELECT p.idpedido, TIMESTAMP(p.fechahora) as fechahora FROM pedido p INNER JOIN tienda t ON p.idtienda=t.idtienda
 INNER JOIN cliente c ON c.idcliente=p.idcliente WHERE p.idpedido='$idpedido' and c.idcliente=".$_SESSION['idcliente'];
	return ejecutarConsultaSimpleFila($sql);
}
public function listarDetalle($idpedido){
	$sql="SELECT dp.idpedido, c.nombre as categoria, pr.nombre as producto, pr.imagen, 
	dp.cantidad,dp.precio,(dp.cantidad*dp.precio) as subtotal FROM detalle dp 
	INNER JOIN pedido p ON dp.idpedido=p.idpedido INNER JOIN cliente cl ON cl.idcliente=p.idcliente 
	INNER JOIN producto pr ON dp.idproducto=pr.idproducto INNER JOIN categoria c ON pr.idcategoria=c.idcategoria 
	INNER JOIN tienda t ON c.idtienda=t.idtienda 
	WHERE dp.idpedido='$idpedido' and cl.idcliente=".$_SESSION['idcliente'];
	return ejecutarConsulta($sql);
}
//listar registros

public function listar(){
	
	$sql="SELECT pedido.idpedido,tienda.nombre as tienda,  pedido.estado FROM tienda,pedido,cliente WHERE cliente.idcliente=pedido.idcliente and pedido.idtienda=tienda.idtienda  AND pedido.estadoPago='Pendiente' AND pedido.tipo='Paypal' AND cliente.idcliente=".$_SESSION['idcliente'];
	return ejecutarConsulta($sql);
}





public function confirmado(){
	$cliente=$_SESSION['idcliente'];
	$sql="SELECT p.idpedido, p.tipo,t.nombre as tienda, TIMESTAMP(p.fechahora) as fechahora, p.total,p.estadoPago, p.estado FROM pedido p INNER JOIN tienda t ON p.idtienda=t.idtienda INNER JOIN cliente c ON c.idcliente=p.idcliente WHERE p.estado='En espera' and c.idcliente='$cliente' 
	order by p.fechahora,  p.idpedido DESC    ";
	return ejecutarConsulta($sql);
}






public function cancelado(){
	$sql="SELECT pedido.idpedido,tienda.nombre as tienda, pedido.fechahora, pedido.estado, pedido.estadoPago FROM tienda,pedido,cliente WHERE cliente.idcliente=pedido.idcliente and pedido.idtienda=tienda.idtienda AND pedido.estado='Cancelado'  AND cliente.idcliente=".$_SESSION['idcliente'];
	return ejecutarConsulta($sql);
}
//listar y mostrar en selct





public function select(){
	$sql="SELECT categoria.idcategoria, categoria.nombre FROM categoria, tienda WHERE categoria.idtienda= tienda.idtienda AND categoria.estado=1 AND tienda.idtienda=".$_SESSION['idtienda'];
	return ejecutarConsulta($sql);
}
}

 ?>
