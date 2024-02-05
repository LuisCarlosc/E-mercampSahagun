<?php 
session_start();
require_once "../modelos/Cliente.php";

$usuario=new Cliente();

$idcliente=isset($_POST["idcliente"])? limpiarCadena($_POST["idcliente"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$email=isset($_POST["email"])? limpiarCadena($_POST["email"]):"";
$login=isset($_POST["login"])? limpiarCadena($_POST["login"]):"";
$clave=isset($_POST["clave"])? limpiarCadena($_POST["clave"]):"";


switch ($_GET["op"]) {
	case 'guardaryeditar':


	//Hash SHA256 para la contraseña
	$clavehash=hash("SHA256", $clave);
	if (empty($idusuario)) {
		$rspta=$usuario->insertar($nombre,$email, $login, $clavehash);
		echo $rspta ? "Datos registrados correctamente" : "No se pudo registrar todos los datos del usuario";
	}else{
		$rspta=$usuario->editar($idcliente,$nombre,$email, $login, $clavehash);
		echo $rspta ? "Datos actualizados correctamente" : "No se pudo actualizar los datos";
	}
	break;
	

	case 'desactivar':
	$rspta=$usuario->desactivar($idusuario);
	echo $rspta ? "Datos desactivados correctamente" : "No se pudo desactivar los datos";
	break;

	case 'activar':
	$rspta=$usuario->activar($idusuario);
	echo $rspta ? "Datos activados correctamente" : "No se pudo activar los datos";
	break;
	
	case 'mostrar':
	$rspta=$usuario->mostrar($idusuario);
	echo json_encode($rspta);
	break;

	case 'listar':
	$rspta=$usuario->listar();
	$data=Array();

	while ($reg=$rspta->fetch_object()) {
		$data[]=array(
			"0"=>($reg->condicion)?'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idusuario.')"><i class="fa fa-pencil"></i></button>'.' '.'<button class="btn btn-danger btn-xs" onclick="desactivar('.$reg->idusuario.')"><i class="fa fa-close"></i></button>':'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idusuario.')"><i class="fa fa-pencil"></i></button>'.' '.'<button class="btn btn-primary btn-xs" onclick="activar('.$reg->idusuario.')"><i class="fa fa-check"></i></button>',
			"1"=>$reg->restaurante,
			"2"=>$reg->nombre,
			"3"=>$reg->telefono,
			"4"=>$reg->cargo,
			"5"=>$reg->email,
			"6"=>"<img src='../../files/usuarios/".$reg->imagen."' height='50px' width='50px'>",
			"7"=>($reg->condicion)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>'
		);
	}

	$results=array(
             "sEcho"=>1,//info para datatables
             "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
             "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
             "aaData"=>$data); 
	echo json_encode($results);
	break;

	case 'permisos':
			//obtenemos toodos los permisos de la tabla permisos
	require_once "../modelos/Permiso.php";
	$permiso=new Permiso();
	$rspta=$permiso->listarUsers();
//obtener permisos asigandos
	$id=$_GET['id'];
	$marcados=$usuario->listarmarcados($id);
	$valores=array();

//almacenar permisos asigandos
	while ($per=$marcados->fetch_object()) {
		array_push($valores, $per->idpermiso);
	}
			//mostramos la lista de permisos
	while ($reg=$rspta->fetch_object()) {
		$sw=in_array($reg->idpermiso,$valores)?'checked':'';
		echo '<li><input type="checkbox" '.$sw.' name="permiso[]" value="'.$reg->idpermiso.'">'.$reg->nombre.'</li>';
	}
	break;

	case 'verificar':
	//validar si el usuario tiene acceso al sistema
	
	$logina=$_POST['logina'];
	$clavea=$_POST['clavea'];

	//Hash SHA256 en la contraseña
	
	
	$rspta=$usuario->verificar($logina, $clavea);

	$fetch=$rspta->fetch_object();
	if (isset($fetch)) {
		# Declaramos la variables de sesion
		$_SESSION['idcliente']=$fetch->idcliente;
		$_SESSION['nombre']=$fetch->nombre;
		$_SESSION['email']=$fetch->email;
		

	}
	echo json_encode($fetch);
	break;

	case 'select':
		require_once "../modelos/Restaurantes.php";
		$restaurante=new Restaurante();

		$rspta=$restaurante->select();

		while ($reg=$rspta->fetch_object()) {
			echo '<option value=' . $reg->idrestaurante.'>'.$reg->nombre.'</option>';
		}
		break;


	case 'salir':
	   //limpiamos la variables de la secion
	session_unset();

	  //destruimos la sesion
	session_destroy();
		  //redireccionamos al login
	header("Location: ../index.php");
	break;

	


	
}
?>

