<?php 
//incluir la conexion de base de datos
require "../../config/Conexion.php";
class Administrador{


	//implementamos nuestro constructor
public function __construct(){

}

//metodo insertar regiustro
public function insertar($num_documento,$nombre,$telefono,$email,$clave,$imagen,$permisos){
	$sql="INSERT INTO administrador (cedula,nombre,telefono,correo,clave,imagen,condicion) 
	VALUES ('$num_documento','$nombre','$telefono','$email','$clave','$imagen','1')";
	//return ejecutarConsulta($sql);
	 $idusuarionew=ejecutarConsulta_retornarID($sql);
	 $num_elementos=0;
	 $sw=true;
	 while ($num_elementos < count($permisos)) {

	 	$sql_detalle="INSERT INTO administrador_permiso (id_administrador,idpermiso) VALUES('$idusuarionew','$permisos[$num_elementos]')";

	 	ejecutarConsulta($sql_detalle) or $sw=false;

	 	$num_elementos=$num_elementos+1;
	 }
	 return $sw;
}

public function editar($idusuario,$num_documento,$nombre,$telefono,$email,$clave,$imagen){
	$sql="UPDATE administrador SET cedula='$num_documento',nombre='$nombre',telefono='$telefono',correo='$email',clave='$clave',imagen='$imagen' 
	WHERE id_administrador='$idusuario'";
	 ejecutarConsulta($sql);

	
}
public function desactivar($idusuario){
	$sql="UPDATE administrador SET condicion='0' WHERE id_administrador='$idusuario'";
	return ejecutarConsulta($sql);
}
public function activar($idusuario){
	$sql="UPDATE administrador SET condicion='1' WHERE id_administrador='$idusuario'";
	return ejecutarConsulta($sql);
}

//metodo para mostrar registros
public function mostrar($idusuario){
	$sql="SELECT * FROM administrador WHERE id_administrador='$idusuario'";
	return ejecutarConsultaSimpleFila($sql);
}

//listar registros
public function listar(){
	$sql="SELECT * FROM administrador";
	return ejecutarConsulta($sql);
}

//metodo para listar permmisos marcados de un usuario especifico
public function listarmarcados($idusuario){
	$sql="SELECT * FROM administrador_permiso WHERE id_administrador='$idusuario'";
	return ejecutarConsulta($sql);
}

//funcion que verifica el acceso al sistema

public function verificar($login,$clave){

	$sql="SELECT id_administrador,cedula,nombre,telefono,correo,imagen FROM administrador WHERE correo='$login' AND clave='$clave' AND condicion='1'";
	 return ejecutarConsulta($sql);

}
}

 ?>
