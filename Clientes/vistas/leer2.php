<?php 
session_start();
 include ("../config/Conexion.php");  
  
 if (!isset($_POST['buscar'])){
$_POST['buscar']= "";
$buscar=$_POST['buscar'];
    
}
$buscar=$_POST['buscar'];
    $sql="SELECT DISTINCT restaurante.nombre,restaurante.direccion,restaurante.telefono,restaurante.imagen FROM restaurante,cliente,mesa,pedido WHERE cliente.idcliente =pedido.idcliente and mesa.idmesa=pedido.idmesa AND mesa.idrestaurante=restaurante.idrestaurante AND restaurante.condicion=1 and LIKE '%".$buscar."%' AND cliente.idcliente=".$_SESSION['idcliente'];
  
    $sql_query=mysqli_query($conexion,$sql);


 
  ?>