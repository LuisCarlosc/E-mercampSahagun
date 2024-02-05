<?php 
//incluir la conexion de base de datos
require "../../config/Conexion.php";

class Usuario{


	//implementamos nuestro constructor
public function __construct(){

}

//metodo insertar regiustro
public function insertar($idtienda,$nombre,$telefono,$cargo,$email,$clave,$imagen,$permisos){
	$sql="INSERT INTO users (idtienda,nombre,telefono,cargo,email,clave,imagen,condicion) VALUES ('$idtienda','$nombre','$telefono','$cargo','$email','$clave','$imagen','1')";
	//return ejecutarConsulta($sql);
	 $idusuarionew=ejecutarConsulta_retornarID($sql);
	 $num_elementos=0;
	 $sw=true;
	 while ($num_elementos < count($permisos)) {

	 	$sql_detalle="INSERT INTO usersper (iduser,idpermiso) VALUES('$idusuarionew','$permisos[$num_elementos]')";

	 	ejecutarConsulta($sql_detalle) or $sw=false;

	 	$num_elementos=$num_elementos+1;
	 }
	 return $sw;
}

public function editar($iduser,$idtienda,$nombre,$telefono,$cargo,$email,$clave,$imagen,$permisos){
	$sql="UPDATE users SET idtienda='$idtienda',nombre='$nombre',telefono='$telefono',cargo='$cargo',email='$email',clave='$clave',imagen='$imagen' 
	WHERE iduser='$iduser'";
	 ejecutarConsulta($sql);

	 //eliminar permisos asignados
	 $sqldel="DELETE FROM usersper WHERE iduser='$iduser'";
	 ejecutarConsulta($sqldel);

	 	 $num_elementos=0;
	 $sw=true;
	 while ($num_elementos < count($permisos)) {

	 	$sql_detalle="INSERT INTO usersper (iduser,idpermiso) VALUES('$iduser','$permisos[$num_elementos]')";

	 	ejecutarConsulta($sql_detalle) or $sw=false;

	 	$num_elementos=$num_elementos+1;
	 }
	 return $sw;
}
public function desactivar($iduser){
	$sql="UPDATE users SET condicion='0' WHERE iduser='$iduser'";
	return ejecutarConsulta($sql);
}
public function activar($iduser){
	$sql="UPDATE users SET condicion='1' WHERE iduser='$iduser'";
	return ejecutarConsulta($sql);
}

//metodo para mostrar registros
public function mostrar($iduser){
	$sql="SELECT * FROM users WHERE iduser='$iduser'";
	return ejecutarConsultaSimpleFila($sql);
}

//listar registros
public function listar(){
	$sql="SELECT users.iduser, tienda.nombre as tienda, users.nombre, users.telefono, users.cargo, users.email, users.imagen, users.condicion FROM tienda, users WHERE users.idtienda= tienda.idtienda order by tienda.idtienda";
	return ejecutarConsulta($sql);
}

//metodo para listar permmisos marcados de un usuario especifico
public function listarmarcados($iduser){
	$sql="SELECT * FROM usersper WHERE iduser='$iduser'";
	return ejecutarConsulta($sql);
}

//funcion que verifica el acceso al sistema

public function verificar($idtienda,$login,$clave){
	$sql="SELECT iduser,idtienda,nombre,telefono,email,cargo,imagen FROM users WHERE idtienda='$idtienda' AND  email='$login' AND clave='$clave' AND condicion=1";
	 return ejecutarConsulta($sql);

}
}

 ?>
