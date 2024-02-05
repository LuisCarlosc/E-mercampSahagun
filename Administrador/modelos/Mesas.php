<?php 
//incluir la conexion de base de datos
require "../../config/Conexion.php";
session_start();
class Mesas{


	//implementamos nuestro constructor
public function __construct(){

}

//metodo insertar regiustro
public function insertar($idrestaurante, $nombre,$tipo){
	$sql="INSERT INTO mesa (idrestaurante,nombre,tipo,estado) VALUES ('$idrestaurante','$nombre','$tipo','1')";
	return ejecutarConsulta($sql);
}

public function editar($idmesa,$idrestaurante,$nombre,$tipo){
	$sql="UPDATE mesa SET  nombre='$nombre',tipo='$tipo' WHERE idmesa='$idmesa' AND idrestaurante=".$_SESSION['idrestaurante'];
	return ejecutarConsulta($sql);
}
public function desactivar($idmesa){
	$sql="UPDATE mesa SET estado='0' WHERE idmesa='$idmesa' AND idrestaurante=".$_SESSION['idrestaurante'];
	return ejecutarConsulta($sql);
}
public function activar($idmesa){
	$sql="UPDATE mesa SET estado='1' WHERE idmesa='$idmesa' AND idrestaurante=".$_SESSION['idrestaurante'];
	return ejecutarConsulta($sql);
}

//metodo para mostrar registros
public function mostrar($idmesa){
	$sql="SELECT idmesa,nombre,tipo,estado FROM mesa WHERE idmesa='$idmesa' and idrestaurante=".$_SESSION['idrestaurante'];
	return ejecutarConsultaSimpleFila($sql);
}

//listar registros

public function listar(){
	
	$sql="SELECT mesa.idmesa, mesa.nombre,mesa.tipo, mesa.estado FROM restaurante, mesa WHERE restaurante.idrestaurante=mesa.idrestaurante and mesa.idrestaurante=".$_SESSION['idrestaurante'];
	return ejecutarConsulta($sql);
}


//listar y mostrar en selct
public function select(){
	$sql="SELECT mesa.idmesa, mesa.nombre FROM mesa, restaurante WHERE restaurante.idrestaurante=mesa.idrestaurante and restaurante.idrestaurante=".$_SESSION['idrestaurante'];
	return ejecutarConsulta($sql);
}



}

 ?>
