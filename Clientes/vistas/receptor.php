<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>

<?php
$baseUrl = 'http://localhost/tienda1/Clientes/vistas';

// Para cambiar al entorno de producción usar: www.paypal.com
$paypal_hostname = 'www.sandbox.paypal.com';

// El token lo obtenemos en las opciones de nuestra cuenta Paypal cuando activamos PDT
$pdt_identity_token = 'AclcZrtSWlUSgh4ggt4ZkTtFpYAlcjcY4Q29ctJA21Xmhlsq1qN5qb4Y6dkUmJjn6wp-S2lxFOrPEF-d';


$query = "cmd=_notify-synch=at=$pdt_identity_token";

$request = curl_init();
// Establecemos las opciones necesarias para realizar la solicitud a paypal
curl_setopt($request, CURLOPT_URL, "https://$paypal_hostname/cgi-bin/webscr");
curl_setopt($request, CURLOPT_POST, TRUE);
curl_setopt($request, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($request, CURLOPT_POSTFIELDS, $query);

// Opciones recomendadas especialmente en entornos de producción
curl_setopt($request, CURLOPT_SSL_VERIFYPEER, TRUE);
// Si tu servidor no incluye los certificados verisign predeterminados debes establecer
// la ruta del certificado verisign cacert.pem, lo puedes descargar en: https://curl.se/docs/caextract.html
//curl_setopt($request, CURLOPT_CAINFO, __DIR__ . '\cacert.pem');
curl_setopt($request, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($request, CURLOPT_HTTPHEADER, array("Host: $paypal_hostname"));

// Ejecutamos la solicitud
$response = curl_exec($request);
curl_close($request);

if (!$response) {
    //HTTP ERROR
    echo "Error";
    return;
}

// Dividimos $response por líneas
$lines = explode("\n", trim($response));
$keyarray = array();

// Validamos la respuesta
if (strcmp($lines[0], "SUCCESS") == 0) {
    for ($i = 1; $i < count($lines); $i++) {
        $temp = explode("=", $lines[$i], 2);
        $keyarray[urldecode($temp[0])] = urldecode($temp[1]);
    }

    // Verificamos que el estado de pago esté Completado
    // Comprobamos que txn_id no ha sido procesado previamente
    // Verificamos que el importe de pago y la moneda de pago sean correctos

    // En el siguiente enlace puedes encontrar una lista completa de Variables IPN y PDT.
    // https://developer.paypal.com/docs/api-basics/notifications/ipn/IPNandPDTVariables/

    $mc_gross = $keyarray['mc_gross'];
    $payment_status = $keyarray['payment_status'];
    $total = $keyarray['total'];
    $item_name = $keyarray['item_name'];


    if($payment_status=="Completed"){
    echo "<h1>¡Hemos procesado tu pago exitosamente!</h1> 
    Recibimos $mc_gross Euros en concepto de: $total $item_name.<hr>
    Vuelve a comprar dando clic <a href='$baseUrl/tiendas.php'>aquí</a>";
    return;
    }else{
        echo "El pago no fue completado";
        return;
    }
    
} else if (strcmp($lines[0], "FAIL") == 0) {
    // Registramos datos para realizar una investigación
    echo "FAIL";
    return;
}

//activamos almacenamiento en el buffer
ob_start();
session_start();
if (!isset($_SESSION['nombre'])) {
  header("Location: login.html");
}else{
?>
<h2>Pago exitoso</h2>
<?php
if(!isset($_GET["id"])){
    header("location: index.php?error=eliminar_no_id");
    exit;    
}
else{
    require_once("../../config/Conexion.php");  

    $sql = "SELECT tienda.idtienda, tienda.imagen, cliente.direccion, cliente.idcliente FROM  tienda, cliente WHERE  tienda.idtienda=".$_GET["id"];
    
    $resultado = $conexion->query($sql);

    if($conexion->errno){
       alert("Error en la consulta, Error: ".$conexion->error);
        exit();
       
    }    

    if($resultado->num_rows>0){
        $registro = $resultado->fetch_assoc();
    }
$sql="UPDATE pedido SET estadoPago='Pagado' WHERE idpedido=".$_GET["id"];
}?>
<meta http-equiv="refresh" content="1; url=http://localhost/tienda1/Clientes/vistas/tiendas.php">