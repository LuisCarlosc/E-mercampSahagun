<?php
session_start();
require "../../config/Conexion.php";

	$sql = "SELECT mesa.idmesa, mesa.nombre,mesa.tipo, mesa.estado FROM restaurante, mesa WHERE restaurante.idrestaurante=mesa.idrestaurante and mesa.idrestaurante=".$_SESSION["idrestaurante"];
	$resultado = mysqli_query($conexion, $sql);


if(!$resultado){
die("Error");
}else{
	while($data=mysqli_fetch_assoc($resultado)){
		$arreglo["data"][]=$data;
	}
	echo json_encode($arreglo);
}
	
	mysqli_close($conexion);