<?php
	
	require 'conexion.php';
	
	$id = $_POST['id'];
	$estadoPago = $_POST['estadoPago'];
	
	$arrayIntereses = null;
	
	$num_array = count($intereses);
	$contador = 0;
	
	if($num_array>0){
		foreach ($intereses as $key => $value) {
			if ($contador != $num_array-1)
			$arrayIntereses .= $value.' ';
			else
			$arrayIntereses .= $value;
			$contador++;
		}
	}
	
	$sql = "UPDATE pedido SET estadoPago='Pagado'WHERE idpedido = '$id'";
	$resultado = $mysqli->query($sql);
	
?>