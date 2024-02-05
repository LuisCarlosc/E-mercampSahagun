
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
//activamos almacenamiento en el buffer
ob_start();
session_start();
if (!isset($_SESSION['nombre'])) {
  header("Location: login.html");
}else{

require 'header.php';
 ?>
 

    <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="row">
        <div class="col-md-12">
      <div class="box">
<div class="box-header with-border">
  
<h1 class="box-title">Realizar pago</h1>
<?php
        if(!isset($_GET["id"])){
            header("location: index.php?error=eliminar_no_id");
            exit;    
        }
        else{
            require_once("../../config/Conexion.php");  

            $sql = "SELECT tienda.idtienda,pedido.idpedido, tienda.imagen, pedido.total, pedido.estadoPago, cliente.idcliente, cliente.nombre FROM tienda, pedido,cliente WHERE pedido.idtienda=tienda.idtienda AND pedido.idcliente= cliente.idcliente  AND pedido.idpedido= ".$_GET["id"];
            
            $resultado = $conexion->query($sql);

            if($conexion->errno){
               alert("Error en la consulta, Error: ".$conexion->error);
                exit();
               
            }    

            if($resultado->num_rows>0){
                $registro = $resultado->fetch_assoc();
           
    ?>
  <div class="box-tools pull-right">
  <img  src='../../files/tiendas/<?php echo $registro["imagen"]; ?>'  height='60px' width='60px'   >
  <input class="form-control" type="hidden"    value="<?php echo $registro["idtienda"]; ?>"   name="idtienda" id="idtienda"      >
  
  
  </div>

  

<!--box-header-->
<!--centro-->
<br>
<?php
$baseUrl = 'http://localhost/tienda1/Clientes/vistas';
?>
<br><br>

</form>  
<div id="smart-button-container">
  <script>
    
  </script>
</div>
<div id="smart-button-container"><br>
    <center><div style="text-align: center"><label for="description">Nombre :</label><input type="text" name="descriptionInput" id="description" maxlength="127" value="<?php echo $registro["nombre"];?>"></div>
      <p id="descriptionError" style="visibility: hidden; color:red; text-align: center;">Please enter a description</p>
    <div style="text-align: center"><label for="amount">Total: </label><input name="amountInput" readonly type="number" id="amount" value="<?php echo $registro["total"]; ?>" ><span> USD</span></div>
      <p id="priceLabelError" style="visibility: hidden; color:red; text-align: center;">Please enter a price</p>
    <div id="invoiceidDiv" style="text-align: center; display: none;"><label for="invoiceid"> </label><input name="invoiceid" maxlength="127" type="text" id="invoiceid" value="" ></div>
      <p id="invoiceidError" style="visibility: hidden; color:red; text-align: center;">Please enter an Invoice ID</p>
    <div style="text-align: center; margin-top: 0.625rem;" id="paypal-button-container"></div></center>
  </div>
  <script src="https://www.paypal.com/sdk/js?client-id=sb&enable-funding=venmo&currency=USD" data-sdk-integration-source="button-factory"></script>
  <script>
  function initPayPalButton() {
    var description = document.querySelector('#smart-button-container #description');
    var amount = document.querySelector('#smart-button-container #amount');
    var descriptionError = document.querySelector('#smart-button-container #descriptionError');
    var priceError = document.querySelector('#smart-button-container #priceLabelError');
    var invoiceid = document.querySelector('#smart-button-container #invoiceid');
    var invoiceidError = document.querySelector('#smart-button-container #invoiceidError');
    var invoiceidDiv = document.querySelector('#smart-button-container #invoiceidDiv');

    var elArr = [description, amount];

    if (invoiceidDiv.firstChild.innerHTML.length > 1) {
      invoiceidDiv.style.display = "block";
    }

    var purchase_units = [];
    purchase_units[0] = {};
    purchase_units[0].amount = {};

    function validate(event) {
      return event.value.length > 0;
    }

    paypal.Buttons({
      style: {
        color: 'blue',
        shape: 'pill',
        label: 'pay',
        layout: 'vertical',
        
      },

      onInit: function (data, actions) {
        actions.disable();

        if(invoiceidDiv.style.display === "block") {
          elArr.push(invoiceid);
        }

        elArr.forEach(function (item) {
          item.addEventListener('keyup', function (event) {
            var result = elArr.every(validate);
            if (result) {
              actions.enable();
            } else {
              actions.disable();
            }
          });
        });
      },

      onClick: function () {
        if (description.value.length < 1) {
          descriptionError.style.visibility = "visible";
        } else {
          descriptionError.style.visibility = "hidden";
        }

        if (amount.value.length < 1) {
          priceError.style.visibility = "visible";
        } else {
          priceError.style.visibility = "hidden";
        }

        if (invoiceid.value.length < 1 && invoiceidDiv.style.display === "block") {
          invoiceidError.style.visibility = "visible";
        } else {
          invoiceidError.style.visibility = "hidden";
        }

        purchase_units[0].description = description.value;
        purchase_units[0].amount.value = amount.value;

        if(invoiceid.value !== '') {
          purchase_units[0].invoice_id = invoiceid.value;
        }
      },

      createOrder: function (data, actions) {
        return actions.order.create({
          purchase_units: purchase_units,
        });
      },

      onApprove: function (data, actions) {
        return actions.order.capture().then(function (orderData) {

          // Full available details
          console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
          
          // Show a success message within this page, e.g.
          const element = document.getElementById('paypal-button-container');
          element.innerHTML = '';
          element.innerHTML = '<h3>Gracias por su compra</h3>';
          
          setTimeout("location.href='http://localhost/tienda1/Clientes/vistas/actualizar.php?id=<?php echo $_GET["id"]; ?>'", 1000);
          // Or go to another URL:  actions.redirect('thank_you.html');
          
        });
        
      },
      

      onError: function (err) {
        console.log(err);
      }
    }).render('#paypal-button-container');
  }
  initPayPalButton();
  </script>
<!--fin centro-->
      </div>
      </div>
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>

  

  <script type="text/javascript" src="../../js/bootstrap-filestyle.js"> </script>
<script>
$( "#perfil" ).submit(function( event ) {
  $('.guardar_datos').attr("disabled", true);
  
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "../ajax/validar.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultado_ajax").html("Mensaje: Cargando...");
			  },
			success: function(datos){
			$("#resultado_ajax").html(datos);
			$('.guardar_datos').attr("disabled", false);

		  }
	});
  event.preventDefault();

})


</script>  

  <!-- fin Modal-->
<?php 

require 'footer.php';

}        
       
}

 ?>
<button ></button>
 <script src="scripts/atendercita.js"></script>
 <?php 
}

ob_end_flush();
  ?>

</html>