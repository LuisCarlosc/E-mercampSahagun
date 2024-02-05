<?php
	
        require "../../config/Conexion.php";
        $id=$_GET["id"];
        $sql="SELECT producto.idproducto,producto.nombre as producto, producto.precio, producto.imagen , categoria.nombre as categoria
        FROM tienda,categoria,producto WHERE tienda.idtienda=categoria.idtienda
         AND categoria.idcategoria=producto.idcategoria AND producto.idproducto=4";
      
      global $conexion;
      $query=$conexion->query($sql);

        if($conexion->errno){
            die("Error en la consulta, Error: ".$conexion->error);
            exit();
        }  
   
    echo ' <thead style="background-color:#A9D0F5">
    <th></th>
    <th> Categoria</th>
    <th>Producto</th>
    <th>Unidades</th>
    <th>Precio</th>
    <th>Subtotal</th>
   </thead>';
   while ($reg=$query->fetch_object()) {
    echo '<tr class="filas">
    <td> '."<img src='../../files/producto/".$reg->imagen."' height='80px' width='80px'>" .' </td>
    <td><center>'.$reg->categoria.'</center></td>
    <td>  <center>   '.$reg->producto.' </center></td>
 
    <td><center>'.$reg->precio.'</center></td></tr>';
  
}
    echo '<tfoot>
     <th>TOTAL</th>
     <th></th>
     <th></th>
     <th></th>
     <th></th>
   
   </tfoot>';
    
?>