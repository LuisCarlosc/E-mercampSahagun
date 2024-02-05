<?php 

if(!isset($_GET["idrestaurante"])){
    header("location: index.php?error=eliminar_no_id");
    exit;    
}
else{
 $restaurante=$_GET["idrestaurante"];
    require_once("../config/Conexion.php");  


 if (!isset($_POST['buscar'])){
$_POST['buscar']= "";
$buscar=$_POST['buscar'];
    
}

$buscar=$_POST['buscar'];

$sql="SELECT producto.idproducto, categoria.nombre as categoria, producto.nombre, producto.descripcion,producto.precio,
 producto.imagen  FROM  restaurante,producto,categoria where 
  categoria.nombre LIKE '%".$buscar."%'  and categoria.idcategoria=producto.idcategoria AND 
     categoria.idrestaurante=restaurante.idrestaurante and producto.estado=1   AND restaurante.idrestaurante='$restaurante'   ORDER BY categoria.idcategoria ";

    $sql_query=mysqli_query($conexion,$sql);

}
 
  ?>