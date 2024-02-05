<?php 
require_once "../modelos/Producto.php";

$producto=new Producto();

$idproducto=isset($_POST["idproducto"])? limpiarCadena($_POST["idproducto"]):"";
$idcategoria=isset($_POST["idcategoria"])? limpiarCadena($_POST["idcategoria"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";
$precio=isset($_POST["precio"])? limpiarCadena($_POST["precio"]):"";
$imagen=isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]):"";

switch ($_GET["op"]) {
	case 'guardaryeditar':

	if (!file_exists($_FILES['imagen']['tmp_name'])|| !is_uploaded_file($_FILES['imagen']['tmp_name'])) {
		$imagen=$_POST["imagenactual"];
	}else{
		$ext=explode(".", $_FILES["imagen"]["name"]);
		if ($_FILES['imagen']['type']=="image/jpg" || $_FILES['imagen']['type']=="image/jpeg" || $_FILES['imagen']['type']=="image/png") {
			$imagen=round(microtime(true)).'.'. end($ext);
			move_uploaded_file($_FILES["imagen"]["tmp_name"], "../../files/producto/".$imagen);
		}
	}
	if (empty($idproducto)) {
		$rspta=$producto->insertar($idcategoria,$nombre,$descripcion,$precio,$imagen);
		echo $rspta ? "Datos registrados correctamente" : "No se pudo registrar los datos";
	}else{
         $rspta=$producto->editar($idproducto,$idcategoria,$nombre,$descripcion,$precio,$imagen);
		echo $rspta ? "Datos actualizados correctamente" : "No se pudo actualizar los datos";
	}
		break;
	

	case 'desactivar':
		$rspta=$producto->desactivar($idproducto);
		echo $rspta ? "Producto desactivado correctamente" : "No se pudo desactivar el producto";
		break;
	case 'activar':
		$rspta=$producto->activar($idproducto);
		echo $rspta ? "Producto activado correctamente" : "No se pudo activar el producto";
		break;
	
	case 'mostrar':
		$rspta=$producto->mostrar($idproducto);
		echo json_encode($rspta);
		break;

    case 'listar':
		$rspta=$producto->listar();
		$data=Array();

		while ($reg=$rspta->fetch_object()) {
			$data[]=array(
            "0"=>($reg->estado)?'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idproducto.')"><i class="fa fa-pencil"></i></button>'.' '.'<button class="btn btn-danger btn-xs" onclick="desactivar('.$reg->idproducto.')"><i class="fa fa-close"></i></button>':'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idproducto.')"><i class="fa fa-pencil"></i></button>'.' '.'<button class="btn btn-primary btn-xs" onclick="activar('.$reg->idproducto.')"><i class="fa fa-check"></i></button>',
            "1"=>$reg->categoria,
            "2"=>$reg->nombre,
            "3"=>$reg->descripcion,
            "4"=>$reg->precio,
            "5"=>"<img src='../../files/producto/".$reg->imagen."' height='50px' width='50px'>",
            
            "6"=>($reg->estado)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>'
              );
		}
		$results=array(
             "sEcho"=>1,//info para datatables
             "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
             "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
             "aaData"=>$data); 
		echo json_encode($results);
		break;

		case 'selectCategoria':
			require_once "../modelos/Categoria.php";
			$categoria=new Categoria();

			$rspta=$categoria->select();

			while ($reg=$rspta->fetch_object()) {
				echo '<option value=' . $reg->idcategoria.'>'.$reg->nombre.'</option>';
			}
			break;
}
 ?>