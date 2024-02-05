<?php 
//incluir la conexion de base de datos
require "../../config/Conexion.php";
class Administrador{


	//implementamos nuestro constructor
public function __construct(){

}

//metodo insertar regiustro
public function insertar($num_documento,$nombre,$telefono,$email,$clave,$imagen,$permisos){
	$sql="INSERT INTO admingen (cedula,nombre,telefono,email,clave,imagen,condicion) 
	VALUES ('$num_documento','$nombre','$telefono','$email','$clave','$imagen','1')";
	//return ejecutarConsulta($sql);
	 $idusuarionew=ejecutarConsulta_retornarID($sql);
	 $num_elementos=0;
	 $sw=true;
	 while ($num_elementos < count($permisos)) {

	 	$sql_detalle="INSERT INTO admin_per (idadmin,idpermiso) VALUES('$idusuarionew','$permisos[$num_elementos]')";

	 	ejecutarConsulta($sql_detalle) or $sw=false;

	 	$num_elementos=$num_elementos+1;
	 }
	 return $sw;
}

public function editar($idusuario,$num_documento,$nombre,$telefono,$email,$clave,$imagen,$permisos){
	$sql="UPDATE admingen SET cedula='$num_documento',nombre='$nombre',telefono='$telefono',email='$email',clave='$clave',imagen='$imagen' 
	WHERE idadmin='$idusuario'";
	 ejecutarConsulta($sql);

	 //eliminar permisos asignados
	 $sqldel="DELETE FROM admin_per WHERE idadmin='$idusuario'";
	 ejecutarConsulta($sqldel);

	 	 $num_elementos=0;
	 $sw=true;
	 while ($num_elementos < count($permisos)) {

	 	$sql_detalle="INSERT INTO admin_per (idadmin,idpermiso) VALUES('$idusuario','$permisos[$num_elementos]')";

	 	ejecutarConsulta($sql_detalle) or $sw=false;

	 	$num_elementos=$num_elementos+1;
	 }
	 return $sw;
}
public function desactivar($idusuario){
	$sql="UPDATE admingen SET condicion='0' WHERE idadmin='$idusuario'";
	return ejecutarConsulta($sql);
}
public function activar($idusuario){
	$sql="UPDATE admingen SET condicion='1' WHERE idadmin='$idusuario'";
	return ejecutarConsulta($sql);
}

//metodo para mostrar registros
public function mostrar($idusuario){
	$sql="SELECT * FROM admingen WHERE idadmin='$idusuario'";
	return ejecutarConsultaSimpleFila($sql);
}

//listar registros
public function listar(){
	$sql="SELECT * FROM admingen ";
	return ejecutarConsulta($sql);
}

//metodo para listar permmisos marcados de un usuario especifico
public function listarmarcados($idusuario){
	$sql="SELECT * FROM admin_per WHERE idadmin='$idusuario'";
	return ejecutarConsulta($sql);
}

//funcion que verifica el acceso al sistema

public function verificar($login,$clave){

	$sql="SELECT idadmin,cedula,nombre,telefono,email,imagen FROM admingen WHERE email='$login' AND clave='$clave' AND condicion='1'";
	 return ejecutarConsulta($sql);

}
}

 ?>
