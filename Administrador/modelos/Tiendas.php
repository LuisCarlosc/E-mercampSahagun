<?php 
//incluir la conexion de base de datos
require "../../config/Conexion.php";
class Tienda{


	//implementamos nuestro constructor
public function __construct(){

}

//metodo insertar regiustro
public function insertar($tipo,$nombre,$telefono,$imagen){
	$sql="INSERT INTO tienda (tipo,nombre,telefono,imagen,condicion)
	 VALUES ('$tipo','$nombre','$telefono','$imagen','1')";
	return ejecutarConsulta($sql);
}

public function editar($idtienda,$tipo,$nombre,$telefono,$imagen){
	$sql="UPDATE tienda SET tipo='$tipo', nombre='$nombre',telefono='$telefono',imagen='$imagen'  
	WHERE idtienda='$idtienda'";
	return ejecutarConsulta($sql);
}
public function eliminar($idtienda){
	$sql="DELETE FROM tienda WHERE idtienda='$idtienda'";
	return ejecutarConsulta($sql);
}
public function desactivar($idtienda){
	$sql="UPDATE tienda SET condicion='0' WHERE idtienda='$idtienda'";
	return ejecutarConsulta($sql);
}
public function activar($idtienda){
	$sql="UPDATE tienda SET condicion='1' WHERE idtienda='$idtienda'";
	return ejecutarConsulta($sql);
}
//metodo para mostrar registros
public function mostrar($idtienda){
	$sql="SELECT * FROM tienda WHERE idtienda='$idtienda'";
	return ejecutarConsultaSimpleFila($sql);
}

//listar registros 
public function listar(){
	$sql="SELECT * FROM tienda";
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


public function select(){
	$sql="SELECT * FROM tienda WHERE condicion=1 ";
	return ejecutarConsulta($sql);
}

}
 ?>
