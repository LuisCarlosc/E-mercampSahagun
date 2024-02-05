<?php 
//incluir la conexion de base de datos
require "../../config/Conexion.php";
session_start();

class Consultas{


	//implementamos nuestro constructor
public function __construct(){

}

//listar registros
public function comprasfecha($fecha_inicio,$fecha_fin){
	$sql="SELECT DATE(p.fechahora) as fechahora, c.nombre as cliente, p.total,p.estadoPago FROM pedido p INNER JOIN tienda t ON p.idtienda=t.idtienda INNER JOIN cliente c ON c.idcliente=p.idcliente WHERE DATE(p.fechahora)>='$fecha_inicio' AND DATE(p.fechahora)<='$fecha_fin' and t.idtienda=".$_SESSION['idtienda'];
	return ejecutarConsulta($sql);
}


public function ventasfechacliente($fecha_inicio,$fecha_fin,$idtienda){
	$sql="SELECT DATE(p.fechahora) as fechahora,  c.nombre as cliente,p.total,p.estadoPago FROM pedido p INNER JOIN tienda t ON p.idtienda=t.idtienda INNER JOIN cliente c ON c.idcliente=p.idcliente  WHERE p.estadoPago='Pagado'  and  DATE(p.fechahora)>='$fecha_inicio' AND DATE(p.fechahora)<='$fecha_fin'  and t.idtienda='$idtienda'       and t.idtienda=".$_SESSION['idtienda'];
	return ejecutarConsulta($sql);
}



public function totalventahoy(){
	$sql="SELECT IFNULL(SUM(total_venta),0) as total_venta FROM venta WHERE DATE(fecha_hora)=curdate()";
	return ejecutarConsulta($sql);
}

public function comprasultimos_10dias(){
	$sql=" SELECT CONCAT(DAY(fecha_hora),'-',MONTH(fecha_hora)) AS fecha, SUM(total_compra) AS total FROM ingreso GROUP BY fecha_hora ORDER BY fecha_hora DESC LIMIT 0,10";
	return ejecutarConsulta($sql);
}

public function ventasultimos_12meses(){
	$sql=" SELECT DATE_FORMAT(fecha_hora,'%M') AS fecha, SUM(total_venta) AS total FROM venta GROUP BY MONTH(fecha_hora) ORDER BY fecha_hora DESC LIMIT 0,12";
	return ejecutarConsulta($sql);
}


}

 ?>
