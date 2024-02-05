<?php 
require_once "../modelos/Pedidos.php";
if (strlen(session_id())<1) 
	session_start();

$venta = new Venta();

$idpedido=isset($_POST["idpedido"])? limpiarCadena($_POST["idpedido"]):"";
$idcliente=isset($_POST["idcliente"])? limpiarCadena($_POST["idcliente"]):"";
$idtienda=isset($_POST["idtienda"])? limpiarCadena($_POST["idtienda"]):"";
$fechahora=isset($_POST["fechahora"])? limpiarCadena($_POST["fechahora"]):"";
$total=isset($_POST["total"])? limpiarCadena($_POST["total"]):"";




switch ($_GET["op"]) {
	case 'guardaryeditar':
	if (empty($idventa)) {
		$rspta=$venta->insertar($idcliente,$idusuario,$tipo_comprobante,$serie_comprobante,$num_comprobante,$fechahora,$impuesto,$total_venta,$_POST["idarticulo"],$_POST["cantidad"],$_POST["precio_venta"],$_POST["descuento"]); 
		echo $rspta ? "Datos registrados correctamente" : "No se pudo registrar los datos";
	}else{
        
	}
		break;
	

	case 'anular':
		$rspta=$venta->anular($idpedido);
		echo $rspta ? "Ingreso anulado correctamente" : "No se pudo anular el ingreso";
		break;

		case 'cambiar':
			$rspta=$venta->cambiar($idpedido);
			echo $rspta ? "Ingreso anulado correctamente" : "No se pudo anular el ingreso";
			break;
		case 'desactivar':
			$rspta=$venta->desactivar($idpedido);
			echo $rspta ? "Pedido confirmado " : "No se pudo confirmar el pedido";
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
        <th></th>
        <th> Categoria</th>
        <th>Producto</th>
        <th>Unidades</th>
        <th>Precio</th>
        <th>Subtotal</th>
       </thead>';
	   while ($reg=$rspta->fetch_object()) {
		echo '<tr class="filas">
		<td> '."<img src='../../files/producto/".$reg->imagen."' height='80px' width='80px'>" .' </td>
		<td><center>'.$reg->categoria.'</center></td>
		<td>  <center>   '.$reg->producto.' </center></td>
		<td> <center>  '.$reg->cantidad.' </center> </td>
		<td><center>'.$reg->precio.'</center></td>
		<td><center>'.$reg->subtotal.'</center></td></tr>';
		$total=  $total+($reg->precio*$reg->cantidad);
	}
		echo '<tfoot>
         <th>TOTAL</th>
         <th></th>
         <th></th>
         <th></th>
         <th></th>
         <th><h4 id="total"> $ ' .$total.'</h4><input type="hidden" name="total" id="total"></th>
       </tfoot>';
		break;

	

    case 'listar':
		$rspta=$venta->listar();
		$data=Array();

		while ($reg=$rspta->fetch_object()) {

			$url='../reportes/recibo.php?id=';

			$data[]=array(
			"0"=>(($reg->estadoPago=='Pendiente'  )?  '<button class="btn btn-warning btn-xs" style="visibility: hidden" onclick="mostrar('.$reg->idpedido.')"><i class="fa fa-eye" ></i></button>'.' '.'<button class="btn btn-primary btn-xs" onclick="anular('.$reg->idpedido.')"><i class="fa fa-money"></i></button>' : '<button class="btn btn-warning btn-xs" style="visibility: hidden" onclick="mostrar('.$reg->idpedido.')"><i class="fa fa-eye"></i></button>'  ).'<a target="_blank" href="'.$url.$reg->idpedido.'"> <button class="btn btn-info btn-xs"><i class="fa fa-file"></i></button></a>' ,
            "1"=>$reg->tipo,
            "2"=>$reg->cliente,
            "3"=>$reg->fechahora,
            "4" =>$reg->total ,
			"5"=>(($reg->estadoPago=='Pagado')?'<span class="label bg-green">Pagado</span>':'<span class="label bg-yellow">Pendiente</span>'),       
			"6"=>'<span class="label bg-red">'.$reg->estado.'</span>',
			"7"=>(($reg->estado=='En Espera' or $reg->estado!=='En Espera' )?  '<button class="btn btn-success btn-xs" onclick="desactivar('.$reg->idpedido.')"><i class="fa fa-check"></i></button>' : '<button class="btn btn-warning btn-xs" onclick="desactivar('.$reg->idpedido.')"><i class="fa fa-music"></i></button>'  )
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
			require_once "../modelos/Mesas.php";
			$persona = new Mesas();

			$rspta = $persona->select();

			while ($reg = $rspta->fetch_object()) {
				echo '<option value='.$reg->idtienda.'>'.$reg->nombre.'</option>';
			}
			break;

			case 'listarArticulos':
			require_once "../modelos/Articulo.php";
			$articulo=new Articulo();

				$rspta=$articulo->listarActivosVenta();
		$data=Array();

		while ($reg=$rspta->fetch_object()) {
			$data[]=array(
            "0"=>'<button class="btn btn-warning" onclick="agregarDetalle('.$reg->idarticulo.',\''.$reg->nombre.'\','.$reg->precio_venta.')"><span class="fa fa-plus"></span></button>',
            "1"=>$reg->nombre,
            "2"=>$reg->categoria,
            "3"=>$reg->codigo,
            "4"=>$reg->stock,
            "5"=>$reg->precio_venta,
            "6"=>"<img src='../files/articulos/".$reg->imagen."' height='50px' width='50px'>"
          
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