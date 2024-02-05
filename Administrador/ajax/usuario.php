<?php 
session_start();
require_once "../modelos/Usuario.php";

$usuario=new Usuario();

$iduser=isset($_POST["iduser"])? limpiarCadena($_POST["iduser"]):"";
$idtienda=isset($_POST["idtienda"])? limpiarCadena($_POST["idtienda"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$telefono=isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
$cargo=isset($_POST["cargo"])? limpiarCadena($_POST["cargo"]):"";
$email=isset($_POST["email"])? limpiarCadena($_POST["email"]):"";
$clave=isset($_POST["clave"])? limpiarCadena($_POST["clave"]):"";
$imagen=isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]):"";

switch ($_GET["op"]) {
	case 'guardaryeditar':

	if (!file_exists($_FILES['imagen']['tmp_name'])|| !is_uploaded_file($_FILES['imagen']['tmp_name'])) {
		$imagen=$_POST["imagenactual"];
	}else{
		$ext=explode(".", $_FILES["imagen"]["name"]);
		if ($_FILES['imagen']['type']=="image/jpg" || $_FILES['imagen']['type']=="image/jpeg" || $_FILES['imagen']['type']=="image/png") {
			$imagen=round(microtime(true)).'.'. end($ext);
			move_uploaded_file($_FILES["imagen"]["tmp_name"], "../../files/usuarios/".$imagen);
		}
	}

	//Hash SHA256 para la contraseña
	$clavehash=hash("SHA256", $clave);
	if (empty($iduser)) {
		$rspta=$usuario->insertar($idtienda,$nombre,$telefono,$cargo,$email,$clavehash,$imagen,$_POST['permisosusers']);
		echo $rspta ? "Usuario registrado correctamente" : "No se pudo registrar toda la información del usuario";
	}else{
		$rspta=$usuario->editar($iduser,$idtienda,$nombre,$telefono,$cargo,$email,$clavehash,$imagen,$_POST['permisosusers']);
		echo $rspta ? "Usuario actualizado correctamente" : "No se pudo actualizar la información";
	}
	break;
	

	case 'desactivar':
	$rspta=$usuario->desactivar($iduser);
	echo $rspta ? "Usuario desactivado correctamente" : "No se pudo desactivar el usuario";
	break;

	case 'activar':
	$rspta=$usuario->activar($iduser);
	echo $rspta ? "Usuario activado correctamente" : "No se pudo activar el usuario";
	break;
	
	case 'mostrar':
	$rspta=$usuario->mostrar($iduser);
	echo json_encode($rspta);
	break;

	case 'listar':
	$rspta=$usuario->listar();
	$data=Array();

	while ($reg=$rspta->fetch_object()) {
		$data[]=array(
			"0"=>($reg->condicion)?'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->iduser.')"><i class="fa fa-pencil"></i></button>'.' '.'<button class="btn btn-danger btn-xs" onclick="desactivar('.$reg->iduser.')"><i class="fa fa-close"></i></button>':'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->iduser.')"><i class="fa fa-pencil"></i></button>'.' '.'<button class="btn btn-primary btn-xs" onclick="activar('.$reg->iduser.')"><i class="fa fa-check"></i></button>',
			"1"=>$reg->tienda,
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
		echo '<li><input type="checkbox" '.$sw.' name="permisosusers[]" value="'.$reg->idpermiso.'">'.$reg->nombre.'</li>';
	}
	break;

	case 'verificar':
	//validar si el usuario tiene acceso al sistema
	$idtiendaa=$_POST['idtiendaa'];
	$logina=$_POST['logina'];
	$clavea=$_POST['clavea'];

	//Hash SHA256 en la contraseña
	$clavehash=hash("SHA256", $clavea);
	
	$rspta=$usuario->verificar($idtiendaa,$logina, $clavehash);

	$fetch=$rspta->fetch_object();
	if (isset($fetch)) {
		# Declaramos la variables de sesion
		$_SESSION['iduser']=$fetch->iduser;
		$_SESSION['idtienda']=$fetch->idtienda;
		$_SESSION['nombre']=$fetch->nombre;
		$_SESSION['imagen']=$fetch->imagen;
		

		//obtenemos los permisos
		$marcados=$usuario->listarmarcados($fetch->iduser);

		//declaramos el array para almacenar todos los permisos
		$valores=array();

		//almacenamos los permisos marcados en al array
		while ($per = $marcados->fetch_object()) {
			array_push($valores, $per->idpermiso);
		}

		//determinamos lo accesos al usuario
		in_array(1, $valores)?$_SESSION['escritorio']=1:$_SESSION['escritorio']=0;
		in_array(2, $valores)?$_SESSION['categoria']=1:$_SESSION['categoria']=0;
		in_array(3, $valores)?$_SESSION['producto']=1:$_SESSION['producto']=0;
		in_array(4, $valores)?$_SESSION['pedidos']=1:$_SESSION['pedidos']=0;
		in_array(5, $valores)?$_SESSION['reportes']=1:$_SESSION['reportes']=0;
		in_array(6, $valores)?$_SESSION['usuarios']=1:$_SESSION['usuarios']=0;

	}
	echo json_encode($fetch);
	break;

	case 'select':
		require_once "../modelos/Tiendas.php";
		$tienda=new tienda();

		$rspta=$tienda->select();

		while ($reg=$rspta->fetch_object()) {
			echo '<option value=' . $reg->idtienda.'>'.$reg->nombre.'</option>';
		}
		break;


	case 'salir':
	   //limpiamos la variables de la secion
	session_unset();

	  //destruimos la sesion
	session_destroy();
		  //redireccionamos al login
	header("Location: ../../index.html");
	break;

	


	
}
?>

