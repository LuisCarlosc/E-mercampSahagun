<?php 
require_once "../modelos/AtenderCita.php";
if (strlen(session_id())<1) 
	session_start();

$atender = new AtenderCita();

$idatender=isset($_POST["id_atender"])? limpiarCadena($_POST["id_atender"]):"";
$idcita=isset($_POST["id_cita"])? limpiarCadena($_POST["id_cita"]):"";
$fecha=isset($_POST["fecha"])? limpiarCadena($_POST["fecha"]):"";
$peso=isset($_POST["peso"])? limpiarCadena($_POST["peso"]):"";
$total_venta=isset($_POST["total"])? limpiarCadena($_POST["total"]):"";





switch ($_GET["op"]) {
	case 'guardaryeditar':
	if (empty($idventa)) {
		$rspta=$atender->insertar($idcita,$fecha,$peso,$total_venta,$_POST["id_servicio"],$_POST["precio"],$_POST["descuento"]); 
		
		echo $rspta ? "Datos registrados correctamente" : "No se pudo registrar los datos";
	}else{
        
	}
		break;
		
	case 'anular':
		$rspta=$atender->anular($idcita);
		echo $rspta ? "Ingreso anulado correctamente" : "No se pudo anular el ingreso";
		break;
	
	case 'mostrar':
		$rspta=$venta->mostrar($idventa);
		echo json_encode($rspta);
		break;

	case 'listarDetalle':
		//recibimos el idventa
		$id=$_GET['id'];

		$rspta=$venta->listarDetalle($id);
		$total=0;
		echo ' <thead style="background-color:#A9D0F5">
        <th>Opciones</th>
        <th>Articulo</th>
        <th>Cantidad</th>
        <th>Precio Venta</th>
        <th>Descuento</th>
        <th>Subtotal</th>
       </thead>';
		while ($reg=$rspta->fetch_object()) {
			echo '<tr class="filas">
			<td></td>
			<td>'.$reg->nombre.'</td>
			<td>'.$reg->cantidad.'</td>
			<td>'.$reg->precio_venta.'</td>
			<td>'.$reg->descuento.'</td>
			<td>'.$reg->subtotal.'</td></tr>';
			$total=  $total+($reg->precio-$reg->descuento);
		}
		echo '<tfoot>
         <th>TOTAL</th>
         <th></th>
         <th></th>
         <th></th>
         <th></th>
         <th><h4 id="total"> $ ' .$total.'</h4><input type="hidden" name="total_venta" id="total_venta"></th>
       </tfoot>';
		break;

    case 'listar':
		$rspta=$venta->listar();
		$data=Array();

		while ($reg=$rspta->fetch_object()) {
                 if ($reg->tipo_comprobante=='Ticket') {
                 	$url='../reportes/exTicket.php?id=';
                 }else{
                    $url='../reportes/exFactura.php?id=';
                 }

			$data[]=array(
            "0"=>(($reg->estado=='Aceptado')?'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idventa.')"><i class="fa fa-eye"></i></button>'.' '.'<button class="btn btn-danger btn-xs" onclick="anular('.$reg->idventa.')"><i class="fa fa-close"></i></button>':'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idventa.')"><i class="fa fa-eye"></i></button>').
            '<a target="_blank" href="'.$url.$reg->idventa.'"> <button class="btn btn-info btn-xs"><i class="fa fa-file"></i></button></a>',
            "1"=>$reg->fecha,
            "2"=>$reg->cliente,
            "3"=>$reg->usuario,
            "4"=>$reg->tipo_comprobante,
            "5"=>$reg->serie_comprobante. '-' .$reg->num_comprobante, 
            "6" =>$reg-> total_venta ,
            "7"=>($reg->estado=='Aceptado')?'<span class="label bg-green">Aceptado</span>':'<span class="label bg-red">Anulado</span>'
              );
		}
		$results=array(
             "sEcho"=>1,//info para datatables
             "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
             "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
             "aaData"=>$data); 
		echo json_encode($results);
		break;

		case 'selectCliente':
			require_once "../modelos/Persona.php";
			$persona = new Persona();

			$rspta = $persona->listarc();

			while ($reg = $rspta->fetch_object()) {
				echo '<option value='.$reg->idpersona.'>'.$reg->nombre.'</option>';
			}
			break;





			case 'listarArticulos':
			require_once "../modelos/Servicio.php";
			$articulo=new Servicio();

				$rspta=$articulo->listarServiciosActivos();
		$data=Array();

		while ($reg=$rspta->fetch_object()) {
			$data[]=array(
			"0"=>'<button class="btn btn-warning" onclick="agregarDetalle('.$reg->id_servicio.',\''.$reg->nombre.'\','.$reg->precio.')"><span class="fa fa-plus"></span></button>',
            "1"=>$reg->nombre,
            "2"=>$reg->descripcion,
            "3"=>$reg->precio,
			"4"=>($reg->condicion)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>'
          
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