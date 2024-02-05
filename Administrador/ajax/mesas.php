<?php 
require_once "../modelos/Mesas.php";

$mesas=new Mesas();

$idmesa=isset($_POST["idmesa"])? limpiarCadena($_POST["idmesa"]):"";
$idrestaurante=isset($_POST["idrestaurante"])? limpiarCadena($_POST["idrestaurante"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$tipo=isset($_POST["tipo"])? limpiarCadena($_POST["tipo"]):"";

switch ($_GET["op"]) {
	case 'guardaryeditar':
	if (empty($idmesa)) {
		$rspta=$mesas->insertar($idrestaurante, $nombre,$tipo);
		echo $rspta ? "Datos registrados correctamente" : "No se pudo registrar los datos";
	}else{
         $rspta=$mesas->editar($idmesa, $idrestaurante,$nombre,$tipo);
		echo $rspta ? "Datos actualizados correctamente" : "No se pudo actualizar los datos";
	}
		break;
	

	case 'desactivar':
		$rspta=$mesas->desactivar($idmesa);
		echo $rspta ? "Mesa desactivada correctamente" : "No se pudo desactivar la mesa";
		break;
	case 'activar':
		$rspta=$mesas->activar($idmesa);
		echo $rspta ? "Mesa activada correctamente" : "No se pudo activar la mesa";
		break;
	
	case 'mostrar':
		$rspta=$mesas->mostrar($idmesa);
		echo json_encode($rspta);
		break;

    case 'listar':
		$rspta=$mesas->listar();
		$data=Array();

		while ($reg=$rspta->fetch_object()) {
			$data[]=array(
            "0"=>($reg->estado)?'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idmesa.')"><i class="fa fa-pencil"></i></button>'.' '.'<button class="btn btn-danger btn-xs" onclick="desactivar('.$reg->idmesa.')"><i class="fa fa-close"></i></button>':'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idmesa.')"><i class="fa fa-pencil"></i></button>'.' '.'<button class="btn btn-primary btn-xs" onclick="activar('.$reg->idmesa.')"><i class="fa fa-check"></i></button>',
            "1"=>$reg->nombre,
            "2"=>$reg->tipo,
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

		case 'select':
			
			$rspta=$mesas->select();

			while ($reg = $rspta->fetch_object()) {
				echo '<option value='.$reg->idmesa.'>'.$reg->nombre.'</option>';
			}
			break;
}
 ?>