<?php 
require_once "../modelos/Tiendas.php";

$tienda=new Tienda();

$idtienda=isset($_POST["idtienda"])? limpiarCadena($_POST["idtienda"]):"";
$nit=isset($_POST["Nit"])? limpiarCadena($_POST["Nit"]):"";
$tipo=isset($_POST["tipo"])? limpiarCadena($_POST["tipo"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$telefono=isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
$imagen=isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]):"";
switch ($_GET["op"]) {
	case 'guardaryeditar':

	if (!file_exists($_FILES['imagen']['tmp_name'])|| !is_uploaded_file($_FILES['imagen']['tmp_name'])) {
		$imagen=$_POST["imagenactual"];
	}else{
		$ext=explode(".", $_FILES["imagen"]["name"]);
		if ($_FILES['imagen']['type']=="image/jpg" || $_FILES['imagen']['type']=="image/jpeg" || $_FILES['imagen']['type']=="image/png") {
			$imagen=round(microtime(true)).'.'. end($ext);
			move_uploaded_file($_FILES["imagen"]["tmp_name"], "../../files/tiendas/".$imagen);
		}
	}
	if (empty($idtienda)) {
		$rspta=$tienda->insertar($tipo,$nombre,$telefono,$imagen);
		echo $rspta ? "Tienda registrada correctamente" : "No se pudo registrar la tienda";
	}else{
         $rspta=$tienda->editar($idtienda,$tipo,$nombre,$telefono,$imagen);
		echo $rspta ? "Tienda actualizada correctamente" : "No se pudo actualizar la tienda";
	}
		break;
	
		case 'desactivar':
			$rspta=$tienda->desactivar($idtienda);
			echo $rspta ? "Tienda desactivada correctamente" : "No se pudo desactivar la tienda";
			break;
		
			case 'activar':
			$rspta=$tienda->activar($idtienda);
			echo $rspta ? "Tienda activada correctamente" : "No se pudo activar la tienda";
			break;



		case 'eliminar':
			$rspta=$tienda->eliminar($idtienda);
			echo $rspta ? "Datos eliminados correctamente" : "No se pudo eliminar los datos";
			break;
	
	case 'mostrar':
		$rspta=$tienda->mostrar($idtienda);
		echo json_encode($rspta);
		break;

    case 'listar':
		$rspta=$tienda->listar();
		$data=Array();

		while ($reg=$rspta->fetch_object()) {
			$data[]=array(
			"0"=>($reg->condicion)?'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idtienda.')"><i class="fa fa-pencil"></i></button>'.' '.'<button class="btn btn-danger btn-xs" onclick="desactivar('.$reg->idtienda.')"><i class="fa fa-close"></i></button>':'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idtienda.')"><i class="fa fa-pencil"></i></button>'.' '.'<button class="btn btn-primary btn-xs" onclick="activar('.$reg->idtienda.')"><i class="fa fa-check"></i></button>',
			"1"=>$reg->tipo,
            "2"=>$reg->nombre,
			"3"=>$reg->telefono,
			"4"=>"<img src='../../files/tiendas/".$reg->imagen."' height='50px' width='50px'>",
			"5"=>($reg->condicion)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>'
              );
		}
		$results=array(
             "sEcho"=>1,//info para datatables
             "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
             "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
             "aaData"=>$data); 
		echo json_encode($results);
		break;

		case 'select':
			require_once "../modelos/Tiendas.php";
			$categoria=new Tienda();

			$rspta=$categoria->select();

			while ($reg=$rspta->fetch_object()) {
				echo '<option value=' . $reg->idtienda.'>'.$reg->nombre.'</option>';
			}
			break;
}
 ?>