<?php 
//incluir la conexion de base de datos
require "../../config/Conexion.php";

class Cliente{


	//implementamos nuestro constructor
public function __construct(){

}

//metodo insertar regiustro
public function insertar($nombre,$email,$login,$clave){
	$sql="INSERT INTO cliente (nombre,email,login,clave) VALUES ('$nombre','$email','$login','$clave')";
	return ejecutarConsulta($sql);
	
}

public function editar($idusuario,$idrestaurante,$nombre,$telefono,$cargo,$email,$clave,$imagen,$permisos){
	$sql="UPDATE usuario SET idrestaurante='$idrestaurante',nombre='$nombre',telefono='$telefono',cargo='$cargo',email='$email',clave='$clave',imagen='$imagen' 
	WHERE idusuario='$idusuario'";
	 ejecutarConsulta($sql);

	 //eliminar permisos asignados
	 $sqldel="DELETE FROM usuario_permiso WHERE idusuario='$idusuario'";
	 ejecutarConsulta($sqldel);

	 	 $num_elementos=0;
	 $sw=true;
	 while ($num_elementos < count($permisos)) {

	 	$sql_detalle="INSERT INTO usuario_permiso (idusuario,idpermiso) VALUES('$idusuario','$permisos[$num_elementos]')";

	 	ejecutarConsulta($sql_detalle) or $sw=false;

	 	$num_elementos=$num_elementos+1;
	 }
	 return $sw;
}
public function desactivar($idusuario){
	$sql="UPDATE usuario SET condicion='0' WHERE idusuario='$idusuario'";
	return ejecutarConsulta($sql);
}
public function activar($idusuario){
	$sql="UPDATE usuario SET condicion='1' WHERE idusuario='$idusuario'";
	return ejecutarConsulta($sql);
}

//metodo para mostrar registros
public function mostrar($idusuario){
	$sql="SELECT * FROM usuario WHERE idusuario='$idusuario'";
	return ejecutarConsultaSimpleFila($sql);
}

//listar registros
public function listar(){
	$sql="SELECT usuario.idusuario, restaurante.nombre as restaurante, usuario.nombre, usuario.telefono, usuario.cargo, usuario.email, usuario.imagen, usuario.condicion FROM restaurante, usuario WHERE usuario.idrestaurante= restaurante.idrestaurante ";
	return ejecutarConsulta($sql);
}

//metodo para listar permmisos marcados de un usuario especifico
public function listarmarcados($idusuario){
	$sql="SELECT * FROM usuario_permiso WHERE idusuario='$idusuario'";
	return ejecutarConsulta($sql);
}

//funcion que verifica el acceso al sistema

public function verificar($login,$clave){
	$sql="SELECT idcliente ,nombre,email,login FROM cliente WHERE login='$login' AND clave='$clave' ";
	 return ejecutarConsulta($sql);

}
}

 ?>
