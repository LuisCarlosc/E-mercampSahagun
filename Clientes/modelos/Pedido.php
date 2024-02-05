<?php 
//incluir la conexion de base de datos
require "../../config/Conexion.php";
class Venta{


	//implementamos nuestro constructor
public function __construct(){

}

//metodo insertar registro
public function insertar($idcliente,$idusuario,$tipo_comprobante,$serie_comprobante,$num_comprobante,$fecha_hora,$impuesto,$total_venta,$idarticulo,$cantidad,$precio_venta,$descuento){
	$sql="INSERT INTO venta (idcliente,idusuario,tipo_comprobante,serie_comprobante,num_comprobante,fecha_hora,impuesto,total_venta,estado) VALUES ('$idcliente','$idusuario','$tipo_comprobante','$serie_comprobante','$num_comprobante','$fecha_hora','$impuesto','$total_venta','Aceptado')";
	//return ejecutarConsulta($sql);
	 $idventanew=ejecutarConsulta_retornarID($sql);
	 $num_elementos=0;
	 $sw=true;
	 while ($num_elementos < count($idarticulo)) {

	 	$sql_detalle="INSERT INTO detalle_venta (idventa,idarticulo,cantidad,precio_venta,descuento) VALUES('$idventanew','$idarticulo[$num_elementos]','$cantidad[$num_elementos]','$precio_venta[$num_elementos]','$descuento[$num_elementos]')";

	 	ejecutarConsulta($sql_detalle) or $sw=false;

	 	$num_elementos=$num_elementos+1;
	 }
	 return $sw;
}

public function anular($idventa){
	$sql="UPDATE venta SET estado='Anulado' WHERE idventa='$idventa'";
	return ejecutarConsulta($sql);
}

public function cancelar($idventa){
	$sql="UPDATE venta SET estado='Anulado' WHERE idventa='$idventa'";
	return ejecutarConsulta($sql);
}

//implementar un metodopara mostrar los datos de unregistro a modificar
public function mostrar($idventa){
	$sql="SELECT v.idventa,DATE(v.fecha_hora) as fecha,v.idcliente,p.nombre as cliente,u.idusuario,u.nombre as usuario, v.tipo_comprobante,v.serie_comprobante,v.num_comprobante,v.total_venta,v.impuesto,v.estado FROM venta v INNER JOIN persona p ON v.idcliente=p.idpersona INNER JOIN usuario u ON v.idusuario=u.idusuario WHERE idventa='$idventa'";
	return ejecutarConsultaSimpleFila($sql);
}

public function listarDetalle($idventa){
	$sql="SELECT dv.idventa,dv.idarticulo,a.nombre,dv.cantidad,dv.precio_venta,dv.descuento,(dv.cantidad*dv.precio_venta-dv.descuento) as subtotal FROM detalle_venta dv INNER JOIN articulo a ON dv.idarticulo=a.idarticulo WHERE dv.idventa='$idventa'";
	return ejecutarConsulta($sql);
}

//listar registros
public function listar(){
	$sql="SELECT v.idventa,DATE(v.fecha_hora) as fecha,v.idcliente,p.nombre as cliente,u.idusuario,u.nombre as usuario, v.tipo_comprobante,v.serie_comprobante,v.num_comprobante,v.total_venta,v.impuesto,v.estado FROM venta v INNER JOIN persona p ON v.idcliente=p.idpersona INNER JOIN usuario u ON v.idusuario=u.idusuario ORDER BY v.idventa DESC";
	return ejecutarConsulta($sql);
}


public function ventacabecera($idpedido){
	$sql= "SELECT p.idpedido, r.Nit, r.nombre as restaurante, r.direccion, r.telefono, r.email,  c.nombre AS cliente, m.nombre as mesa,  p.fecha, p.hora, p.total FROM pedido p INNER JOIN mesa m ON p.idmesa=m.idmesa INNER JOIN cliente c ON c.idcliente=p.idcliente INNER JOIN restaurante r ON r.idrestaurante=m.idrestaurante WHERE  p.idpedido='$idpedido' and c.idcliente=".$_SESSION['idcliente'];
		return ejecutarConsulta($sql);
}

public function ventadetalles($idpedido){
	$sql="SELECT dp.idpedido, c.nombre as categoria, pr.nombre as producto,  dp.cantidad,dp.precio,(dp.cantidad*dp.precio)  as subtotal, p.total FROM detalle dp INNER JOIN pedido p ON dp.idpedido=p.idpedido INNER JOIN cliente cl ON cl.idcliente=p.idcliente INNER JOIN producto pr ON dp.idproducto=pr.idproducto INNER JOIN categoria c ON pr.idcategoria=c.idcategoria
	 INNER JOIN restaurante r ON c.idrestaurante=r.idrestaurante WHERE p.estadoPago='Pagado' and  dp.idpedido='$idpedido' and cl.idcliente=".$_SESSION['idcliente'];
         return ejecutarConsulta($sql);
}



}

 ?>
