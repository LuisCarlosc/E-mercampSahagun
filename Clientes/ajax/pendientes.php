<?php 
require_once "../modelos/Pendientes.php";

$categoria=new Categoria();

$idpedido=isset($_POST["idpedido"])? limpiarCadena($_POST["idpedido"]):"";
$idtienda=isset($_POST["idtienda"])? limpiarCadena($_POST["idtienda"]):"";
$tipo=isset($_POST["tipo"])? limpiarCadena($_POST["tipo"]):"";
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
		echo $rspta ? "Datos desactivados correctamente" : "No se pudo desactivar los datos";
		break;
		
	case 'activar':
		$rspta=$categoria->activar($idcategoria);
		echo $rspta ? "Datos activados correctamente" : "No se pudo activar los datos";
		break;
	
	case 'mostrar':
		$rspta=$categoria->mostrar($idpedido);
		echo json_encode($rspta);
		break;

    case 'listar':
		$rspta=$categoria->listar();
		$data=Array();

		while ($reg=$rspta->fetch_object()) {

			$data[]=array(
			"0"=>  '<a href="../vistas/verificar.php?id=('.$reg->idpedido.')  "class="btn btn-primary btn-xs">  <i class="fa fa-paypal"></i> </a> ' .'&nbsp'.' <button class="btn btn-danger btn-xs" onclick="desactivar('.$reg->idpedido.')"><i class="fa fa-close"></i></button>'         ,
            "1"=>$reg->tienda,
			"1"=>$reg->tipo,
			"2"=>(($reg->estado=='En Espera')?'<span class="label bg-yellow">Pendiente</span>' : '<span class="label bg-red">Pendiente</span>' )     
	
              );
		}
		$results=array(
             "sEcho"=>1,//info para datatables
             "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
             "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
             "aaData"=>$data); 
		echo json_encode($results);
		break;

		
		case 'listarDetalle':
			//recibimos el idventa
			$id=$_GET['id'];
	
			$rspta=$categoria->listarDetalle($id);
			$total=0;
			echo ' <thead style="background-color:#A9D0F5">
			<th></th>
			<th>Producto</th>
			
		   </thead>';
		   while ($reg=$rspta->fetch_object()) {
			echo '<tr class="filas">
			<td> '."<img src='../../files/producto/".$reg->imagen."' height='80px' width='80px'>" .' </td>
		
			<td> <strong>	<center>  '.$reg->producto.  '  </strong></center>

		<center>	<strong> cant: </strong>'.$reg->cantidad.' </center>
		<center>	<strong> precio: </strong>'.$reg->precio.'</center>
		<center>	<strong> subtotal: </strong>'.$reg->subtotal.'</center>
			</td>
			
			</tr>';
			$total=  $total+($reg->precio*$reg->cantidad);
		}
			echo '<tfoot>
			 <th>TOTAL</th>
	
			 <th><h4 id="total"> $ ' .$total.'</h4><input type="hidden" name="total" id="total"></th>
		   </tfoot>';
			break;



		case 'confirmado':
			$rspta=$categoria->confirmado();
			$data=Array();
	
			while ($reg=$rspta->fetch_object()) {
				$url='../vistas/recibop.php?id=';
				$data[]=array(
					"0"=>(($reg->estadoPago=='Pagado' & $reg->estadoPago=='Pendiente'  )?  '<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idpedido.')"><i class="fa fa-eye"></i></button>' : '<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idpedido.')"><i class="fa fa-eye"></i></button>' .''.'<a href="'.$url.$reg->idpedido.'"> <button class="btn btn-info btn-xs"><i class="fa fa-file"></i></button></a>') ,
					"1"=> $reg->tienda ,
					"2"=> $reg->fechahora ,
					"3"=> $reg->tipo ,
				"4"=> (($reg->estadoPago!='Pagado')?'<span class="label bg-yellow"">Sin pagar</span>' : '<span class="label bg-green" >Pago</span>' )     
			
		
				  );
			}
			$results=array(
				 "sEcho"=>1,//info para datatables
				 "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
				 "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
				 "aaData"=>$data); 
			echo json_encode($results);
			break;
	

			case 'cancelado':
				$rspta=$categoria->cancelado();
				$data=Array();
		
				while ($reg=$rspta->fetch_object()) {
				
					$data[]=array(
					"0"=>'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idpedido.')"><i class="fa fa-eye"></i></button>'    ,
					"1"=> $reg->tienda .   ' <br>  '.  $reg->fechahora   ,
					"2"=> (($reg->estado=='En espera')?'<span class="label bg-red"">En espera</span>' : '<span class="label bg-green" >Pagado</span>' )   
				
			
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