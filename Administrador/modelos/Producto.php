<?php 
//incluir la conexion de base de datos
require "../../config/Conexion.php";
session_start();
class Producto{


	//implementamos nuestro constructor
public function __construct(){

}

//metodo insertar regiustro
public function insertar($idcategoria,$nombre,$descripcion,$precio,$imagen){
	$sql="INSERT INTO producto (idcategoria,nombre,descripcion,precio,imagen,estado)
	 VALUES ('$idcategoria','$nombre','$descripcion','$precio','$imagen','1')";
	return ejecutarConsulta($sql);
}

public function editar($idproducto,$idcategoria,$nombre,$descripcion,$precio,$imagen){
	$sql="UPDATE producto INNER JOIN categoria ON categoria.idcategoria= producto.idcategoria INNER JOIN tienda ON categoria.idtienda= tienda.idtienda 
	SET producto.idcategoria='$idcategoria', producto.nombre='$nombre',producto.descripcion='$descripcion',producto.precio='$precio',producto.imagen='$imagen' 
	WHERE  producto.idproducto='$idproducto'  AND tienda.idtienda=".$_SESSION['idtienda'];
	return ejecutarConsulta($sql);
}
public function desactivar($idproducto){
	$sql="UPDATE producto INNER JOIN categoria ON categoria.idcategoria= producto.idcategoria INNER JOIN tienda ON categoria.idtienda= tienda.idtienda SET producto.estado=0 WHERE producto.idproducto='$idproducto'  AND tienda.idtienda=".$_SESSION['idtienda'];
	return ejecutarConsulta($sql);
}
public function activar($idproducto){
	$sql="UPDATE producto INNER JOIN categoria ON categoria.idcategoria= producto.idcategoria INNER JOIN tienda ON categoria.idtienda= tienda.idtienda SET producto.estado=1 WHERE producto.idproducto='$idproducto'  AND tienda.idtienda=".$_SESSION['idtienda'];
	return ejecutarConsulta($sql);
}

//metodo para mostrar registros
public function mostrar($idproducto){
	$sql="SELECT producto.idproducto,producto.idcategoria,producto.nombre,producto.descripcion, producto.precio, producto.imagen, producto.estado FROM producto,categoria,tienda WHERE producto.idproducto= '$idproducto' AND producto.idcategoria=categoria.idcategoria and categoria.idtienda=tienda.idtienda AND tienda.idtienda=".$_SESSION['idtienda'];
	return ejecutarConsultaSimpleFila($sql);
}

//listar registros 
public function listar(){
	$sql="SELECT producto.idproducto, categoria.nombre as categoria, producto.nombre, producto.descripcion,producto.precio, producto.imagen , producto.estado FROM tienda,producto,categoria WHERE categoria.idcategoria=producto.idcategoria AND categoria.idtienda=tienda.idtienda AND tienda.idtienda=".$_SESSION['idtienda'];
	return ejecutarConsulta($sql);
}

//listar registros activos
public function listarActivos(){
	$sql="SELECT a.idarticulo,a.idcategoria,c.nombre as categoria,a.codigo, a.nombre,a.stock,a.descripcion,a.imagen,a.condicion FROM articulo a INNER JOIN Categoria c ON a.idcategoria=c.idcategoria WHERE a.condicion='1'";
	return ejecutarConsulta($sql);
}

//implementar un metodo para listar los activos, su ultimo precio y el stock(vamos a unir con el ultimo registro de la tabla detalle_ingreso)
public function listarActivosVenta(){
	$sql="SELECT a.idarticulo,a.idcategoria,c.nombre as categoria,a.codigo, a.nombre,a.stock,(SELECT precio_venta FROM detalle_ingreso WHERE idarticulo=a.idarticulo ORDER BY iddetalle_ingreso DESC LIMIT 0,1) AS precio_venta,a.descripcion,a.imagen,a.condicion FROM articulo a INNER JOIN Categoria c ON a.idcategoria=c.idcategoria WHERE a.condicion='1'";
	return ejecutarConsulta($sql);
}
}
 ?>
