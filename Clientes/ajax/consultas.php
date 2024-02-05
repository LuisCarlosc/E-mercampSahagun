<?php 
require_once "../modelos/Consultas.php";

$consulta = new Consultas();

switch ($_GET["op"]) {
	

    case 'comprasfecha':
    $fecha_inicio=$_REQUEST["fecha_inicio"];
    $fecha_fin=$_REQUEST["fecha_fin"];

		$rspta=$consulta->comprasfecha($fecha_inicio,$fecha_fin);
		$data=Array();

		while ($reg=$rspta->fetch_object()) {
			$data[]=array(
            "0"=>$reg->fechahora.' - '.$reg->fechahora,
            "1"=>$reg->tienda,
            "2"=>$reg->cliente,
        
            "3"=>$reg->total,
       
            "4"=>($reg->estadoPago=='Pagado')?'<span class="label bg-green">Pagado</span>':'<span class="label bg-blue">Pendiente</span>'
              );
		}
		$results=array(
             "sEcho"=>1,//info para datatables
             "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
             "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
             "aaData"=>$data); 
		echo json_encode($results);
		break;

    case 'ventasfechacliente':
      $fecha_inicio=$_REQUEST["fecha_inicio"];
      $fecha_fin=$_REQUEST["fecha_fin"];
      $idtienda=$_REQUEST["idtienda"];
  
          $rspta=$consulta->ventasfechacliente($fecha_inicio,$fecha_fin,$idtienda);
          $data=Array();
  
          while ($reg=$rspta->fetch_object()) {
              $data[]=array(
                "0"=>$reg->fechahora.' - '.$reg->fechahora,
                "1"=>$reg->tienda,
                "2"=>$reg->total
              
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