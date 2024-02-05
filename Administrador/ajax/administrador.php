<?php 
session_start();
require_once "../modelos/Administrador.php";

$usuario=new Administrador();

$idusuario=isset($_POST["idadmin"])? limpiarCadena($_POST["idadmin"]):"";
$num_documento=isset($_POST["cedula"])? limpiarCadena($_POST["cedula"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$telefono=isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
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
			move_uploaded_file($_FILES["imagen"]["tmp_name"], "../../files/administrador/".$imagen);
		}
	}

	//Hash SHA256 para la contraseña
	$clavehash=hash("SHA256", $clave);
	if (empty($idusuario)) {
		$rspta=$usuario->insertar($num_documento,$nombre,$telefono,$email,$clavehash,$imagen,$_POST['permisosadmin']);
		echo $rspta ? "Datos registrados correctamente" : "No se pudo registrar todos los datos del usuario";
	}else{
		$rspta=$usuario->editar($idusuario,$num_documento,$nombre,$telefono,$email,$clavehash,$imagen,$_POST['permisosadmin']);
		echo $rspta ? "Datos actualizados correctamente" : "No se pudo actualizar los datos";
	}
	break;
	

	case 'desactivar':
	$rspta=$usuario->desactivar($idusuario);
	echo $rspta ? "Administrador desactivado correctamente" : "No se pudo desactivar el administrador";
	break;

	case 'activar':
	$rspta=$usuario->activar($idusuario);
	echo $rspta ? "Administrador activado correctamente" : "No se pudo activar el administrador";
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
			"0"=>($reg->condicion)?'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idadmin.')"><i class="fa fa-pencil"></i></button>'.' '.'<button class="btn btn-danger btn-xs" onclick="desactivar('.$reg->idadmin.')"><i class="fa fa-close"></i></button>':'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idadmin.')"><i class="fa fa-pencil"></i></button>'.' '.'<button class="btn btn-primary btn-xs" onclick="activar('.$reg->idadmin.')"><i class="fa fa-check"></i></button>',
			"1"=>$reg->cedula,
			"2"=>$reg->nombre,
			"3"=>$reg->telefono,
			"4"=>$reg->email,
			"5"=>"<img src='../../files/administrador/".$reg->imagen."' height='50px' width='50px'>",
			"6"=>($reg->condicion)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>'
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
	$rspta=$permiso->listar();
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
		echo '<li><input type="checkbox" '.$sw.' name="permisosadmin[]" value="'.$reg->idpermiso.'" > ' .$reg->nombre. ' </li>';
	}
	break;

	case 'verificar':
	//validar si el usuario tiene acceso al sistema
	$logina=$_POST['logina'];
	$clavea=$_POST['clavea'];

	//Hash SHA256 en la contraseña
	$clavehash=hash("SHA256", $clavea);
	
	$rspta=$usuario->verificar($logina, $clavehash);

	$fetch=$rspta->fetch_object();
	if (isset($fetch)) {
		# Declaramos la variables de sesion
		$_SESSION['idadmin']=$fetch->idadmin;
		$_SESSION['nombre']=$fetch->nombre;
		$_SESSION['imagen']=$fetch->imagen;
		$_SESSION['email']=$fetch->email;

		//obtenemos los permisos
		$marcados=$usuario->listarmarcados($fetch->idadmin);

		//declaramos el array para almacenar todos los permisos
		$valores=array();

		//almacenamos los permisos marcados en al array
		while ($per = $marcados->fetch_object()) {
			array_push($valores, $per->idpermiso);
		}

		//determinamos lo accesos al usuario
		in_array(1, $valores)?$_SESSION['escritorio']=1:$_SESSION['escritorio']=0;
		in_array(2, $valores)?$_SESSION['administrador']=1:$_SESSION['administrador']=0;
		in_array(3, $valores)?$_SESSION['usuarios']=1:$_SESSION['usuarios']=0;
		in_array(4, $valores)?$_SESSION['tiendas']=1:$_SESSION['tiendas']=0;
	}
	echo json_encode($fetch);


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

