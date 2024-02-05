<?php 
//incluir la conexion de base de datos
require "../../config/Conexion.php";
class Permiso{ 


	//implementamos nuestro constructor
public function __construct(){

}



//listar registros
public function listar(){
	$sql="SELECT * FROM permisosadmin";
	return ejecutarConsulta($sql);
}

public function listarUsers(){
	$sql="SELECT * FROM permisosusers";
	return ejecutarConsulta($sql);
}

}

 ?>
