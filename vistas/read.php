<?php 
 include ("../config/Conexion.php");  
  
 if (!isset($_POST['buscar'])){
$_POST['buscar']= "";
$buscar=$_POST['buscar'];
    
}
$buscar=$_POST['buscar'];
    $sql="SELECT * from tienda where condicion=1 and (nombre or tipo LIKE '%".$buscar."%' ) ORDER BY nombre ASC";
  
    $sql_query=mysqli_query($conexion,$sql);


 
  ?>