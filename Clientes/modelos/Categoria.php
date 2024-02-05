<?php 
//incluir la conexion de base de datos
require "../../config/Conexion.php";
session_start();
class Categoria{


	//implementamos nuestro constructor
public function __construct(){

}

//metodo insertar regiustro
public function insertar($idtienda, $nombre,$descripcion){
	$sql="INSERT INTO categoria (idtienda,nombre,descripcion,estado) VALUES ('$idtienda','$nombre','$descripcion','1')";
	return ejecutarConsulta($sql);
}

public function editar($idcategoria,$idtienda,$nombre,$descripcion){
	$sql="UPDATE categoria SET  nombre='$nombre',descripcion='$descripcion' WHERE idcategoria='$idcategoria' AND idtienda=".$_SESSION['idtienda'];
	return ejecutarConsulta($sql);
}
public function desactivar($idcategoria){
	$sql="UPDATE categoria SET estado='0' WHERE idcategoria='$idcategoria' AND idtienda=".$_SESSION['idtienda'];
	return ejecutarConsulta($sql);
}
public function activar($idcategoria){
	$sql="UPDATE categoria SET estado='1' WHERE idcategoria='$idcategoria' AND idtienda=".$_SESSION['idtienda'];
	return ejecutarConsulta($sql);
}

//metodo para mostrar registros
public function mostrar($idcategoria){
	$sql="SELECT * FROM categoria WHERE idcategoria='$idcategoria' and idtienda=".$_SESSION['idtienda'];
	return ejecutarConsultaSimpleFila($sql);
}

//listar registros

public function listar(){
	
	$sql="SELECT pedido.idpedido,tienda.nombre as tienda,  pedido.estado FROM tienda,pedido,cliente WHERE cliente.idcliente=pedido.idcliente and pedido.idtienda=tienda.idtienda  AND cliente.idcliente=".$_SESSION['idcliente'];
	return ejecutarConsulta($sql);
}


//listar y mostrar en selct
public function select(){
	$sql="SELECT DISTINCT tienda.idtienda, tienda.nombre FROM tienda,cliente,pedido WHERE cliente.idcliente =pedido.idcliente and tienda.idtienda=pedido.idtienda  AND tienda.condicion=1 AND cliente.idcliente=".$_SESSION['idcliente'];
	return ejecutarConsulta($sql);
}
}

 ?>
