<?php
        if(!isset($_GET["id"])){
            header("location: index.php?error=eliminar_no_id");
            exit;    
        }
        else{
            require "../../config/Conexion.php";
            $id=$_GET["id"];
            $sql="SELECT producto.idproducto,producto.nombre as producto, producto.precio, producto.imagen , categoria.nombre as categoria
            FROM tienda,categoria,producto WHERE tienda.idtienda=categoria.idtienda
             AND categoria.idcategoria=producto.idcategoria AND tienda.idtienda='$id' order by categoria.idcategoria";
          
          global $conexion;
          $query=$conexion->query($sql);

            if($conexion->errno){
                die("Error en la consulta, Error: ".$conexion->error);
                exit();
            }    

            $data=Array();
            while ($reg=$query->fetch_object()) {
                $data[]=array(
                "0"=>'<button class="btn btn-success btn-xs" onclick="agregarDetalle('.$reg->idproducto.',\''.$reg->producto.'\','.$reg->precio.')"><span class="fa fa-plus"></span></button>'  .'  '. '<button class="btn btn-info btn-xs" onclick="listarArticulos()"><i class="fa fa-info"></i></button>',
                "1"=>$reg->producto,
                "2"=>$reg->precio,
                "3"=>"<img src='../../files/producto/".$reg->imagen."' height='50px' width='50px'>"
              
                  );
            }
            $results=array(
                 "sEcho"=>1,//info para datatables
                 "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
                 "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
                 "aaData"=>$data); 
            echo json_encode($results);

            }  
    ?>