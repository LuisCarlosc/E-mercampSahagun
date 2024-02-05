<?php 
//incluir la conexion de base de datos
require "../../config/Conexion.php";
session_start();

class Consultas{


	//implementamos nuestro constructor
public function __construct(){

}

//listar registros
public function comprasfecha($fecha_inicio,$fecha_fin){
	$sql="SELECT DATE(p.fechahora) as fechahora, c.nombre as cliente, p.total,p.estadoPago FROM pedido p INNER JOIN tienda t ON p.idtienda=t.idtienda INNER JOIN cliente c ON c.idcliente=p.idcliente  WHERE DATE(p.fechahora)>='$fecha_inicio' AND DATE(p.fechahora)<='$fecha_fin' and t.idtienda=".$_SESSION['idtienda'];
	return ejecutarConsulta($sql);
}


public function ventasfechacliente($idtienda){
	$sql="SELECT pedido.fechahora, tienda.nombre as tienda, pedido.total FROM tienda,pedido, cliente WHERE cliente.idcliente=pedido.idcliente and tienda.idtienda=pedido.idtienda  and pedido.estadoPago='Pagado' and cliente.idcliente=".$_SESSION['idcliente'];
	return ejecutarConsulta($sql);
}



}

 ?>
