<?php 
require_once "../modelos/Categoria.php";

$categoria=new Categoria();

$idcategoria=isset($_POST["idcategoria"])? limpiarCadena($_POST["idcategoria"]):"";
$idtienda=isset($_POST["idtienda"])? limpiarCadena($_POST["idtienda"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";

switch ($_GET["op"]) {
	case 'guardaryeditar':
	if (empty($idcategoria)) {
		$rspta=$categoria->insertar($idtienda, $nombre,$descripcion);
		echo $rspta ? "Datos registrados correctamente" : "No se pudo registrar los datos";
	}else{
         $rspta=$categoria->editar($idcategoria, $idtienda,$nombre,$descripcion);
		echo $rspta ? "Datos actualizados correctamente" : "No se pudo actualizar los datos";
	}
		break;
	

	case 'desactivar':
		$rspta=$categoria->desactivar($idcategoria);
		echo $rspta ? "Categoría desactivada correctamente" : "No se pudo desactivar la categoría";
		break;
	case 'activar':
		$rspta=$categoria->activar($idcategoria);
		echo $rspta ? "Categoría activada correctamente" : "No se pudo activar la categoría";
		break;
	
	case 'mostrar':
		$rspta=$categoria->mostrar($idcategoria);
		echo json_encode($rspta);
		break;

    case 'listar':
		$rspta=$categoria->listar();
		$data=Array();

		while ($reg=$rspta->fetch_object()) {
			$data[]=array(
            "0"=>($reg->estado)?'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idcategoria.')"><i class="fa fa-pencil"></i></button>'.' '.'<button class="btn btn-danger btn-xs" onclick="desactivar('.$reg->idcategoria.')"><i class="fa fa-close"></i></button>':'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idcategoria.')"><i class="fa fa-pencil"></i></button>'.' '.'<button class="btn btn-primary btn-xs" onclick="activar('.$reg->idcategoria.')"><i class="fa fa-check"></i></button>',
            "1"=>$reg->nombre,
            "2"=>$reg->descripcion,
            "3"=>($reg->estado)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>'
              );
		}
		$results=array(
             "sEcho"=>1,//info para datatables
             "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
             "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
             "aaData"=>$data); 
		echo json_encode($results);
		break;

		
}
 ?>