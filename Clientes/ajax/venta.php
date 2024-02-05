<?php 
require_once "../modelos/Venta.php";
if (strlen(session_id())<1) 
	session_start();

$venta = new Venta();

$idpedido=isset($_POST["idpedido"])? limpiarCadena($_POST["idpedido"]):"";
$idtienda=isset($_POST["idtienda"])? limpiarCadena($_POST["idtienda"]):"";
$idcliente=$_SESSION['idcliente'];
$direccion=isset($_POST["direccion"])? liamparCadena($_POST["direccion"]):"";
$tipo=isset($_POST["tipo"])? limpiarCadena($_POST["tipo"]):"";
$fechahora=isset($_POST["fechahora"])? limpiarCadena($_POST["fechahora"]):"";
$total=isset($_POST["total"])? limpiarCadena($_POST["total"]):"";



switch ($_GET["op"]) {
	case 'guardaryeditar':
	if (empty($idpedido)) {
		$rspta=$venta->insertar($idtienda,$idcliente,$tipo,$direccion,
		$fechahora,$total,$_POST["idproducto"],$_POST["cantidad"],$_POST["precio"]); 
		echo $rspta ? "Su Pedido se ha registrado en estado de espera, presione ok para confirmarlo" : "No se pudo efectuar su pedido";
	}else{
        
	}
		break;
	

	case 'anular':
		$rspta=$venta->anular($idventa);
		echo $rspta ? "Ingreso anulado correctamente" : "No se pudo anular el ingreso";
		break;
	
		case 'desactivar':
			$rspta=$venta->desactivar($idpedido);
			echo $rspta ? "Ingreso anulado correctamente" : "No se pudo anular el ingreso";
			break;
		


	case 'mostrar':
		$rspta=$venta->mostrar($idpedido);
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
			$total=$total+($reg->precio_venta*$reg->cantidad-$reg->descuento);
		}
		echo '<tfoot>
         <th>TOTAL</th>
         <th></th>
         <th></th>
         <th></th>
         <th></th>
         <th><h4 id="total">S/. '.$total.'</h4><input type="hidden" name="total_venta" id="total_venta"></th>
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
            "6"=>$reg->total_venta,
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
			require_once "../modelos/Articulo.php";
			$articulo=new Articulo();
				$rspta=$articulo->listarActivosVenta();
		$data=Array();
		while ($reg=$rspta->fetch_object()) {
			$data[]=array(
            "0"=>'<button class="btn btn-warning btn-xs" onclick="agregarDetalle('.$reg->idproducto.',\''.$reg->producto.'\','.$reg->precio.')"><span class="fa fa-plus"></span></button>'  ,
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

				break;
}
 ?>